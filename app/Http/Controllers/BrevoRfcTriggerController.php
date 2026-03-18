<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BrevoRfcTriggerController extends Controller
{
    /**
     * Ventana anti re-disparo (días).
     */
    private int $cooldownDays = 60;

    /**
     * Handle the RFC trigger request.
     */
    public function handle(Request $request)
    {
        // 1. Validate Input
        $request->validate([
            'rfc' => 'required|string',
            'razon_social' => 'required|string',
            // producto (hidden input)
            'producto' => 'required|string',
            'landing_identifier' => 'nullable|string',
        ]);

        $rawRfc = $request->input('rfc');
        $rawRazonSocial = $request->input('razon_social');
        $producto = trim((string) $request->input('producto')); // valor constante por landing
        
        // Determine event name
        $landingIdentifier = $request->input('landing_identifier');
        $eventName = 'muestra_solicitada'; // Default (vinyl_synmax falls here)

        if ($landingIdentifier === 'toallitas') {
            $eventName = 'toallitas';
        }

        // 2. Normalize RFC
        $rfc = $this->normalizeRfc($rawRfc);

        // 3. Validate RFC Format (Mexico)
        if (!$this->isValidRfc($rfc)) {
            return $this->response([
                'success' => false,
                'message' => 'El formato del RFC no es válido.',
                'debug' => [
                    'normalized_rfc' => $rfc,
                ],
            ], 422);
        }

        // 4. Search Contact in Brevo
        $apiKey = config('services.brevo.api_key');
        if (!$apiKey) {
            return $this->response([
                'success' => false,
                'message' => 'Configuración de API de Brevo faltante.',
            ], 500);
        }

        try {
            // 4.1 Search contacts using RFC attribute
            $searchResponse = Http::withHeaders([
                'api-key' => $apiKey,
                'accept'  => 'application/json',
            ])->get('https://api.brevo.com/v3/contacts', [
                'limit'  => 50,
                'filter' => "equals(RFC,\"$rfc\")",
            ]);

            if (!$searchResponse->successful()) {
                return $this->response([
                    'success' => false,
                    'message' => 'Error al consultar el servidor.',
                    'brevo_error' => $searchResponse->json(),
                    'debug_normalized_rfc' => $rfc,
                ], $searchResponse->status());
            }

            $contactsData = $searchResponse->json();
            $allContacts = $contactsData['contacts'] ?? [];

            // 4.2 Apply manual filter to ensure EXACT RFC matches
            $contacts = array_values(array_filter($allContacts, function ($c) use ($rfc) {
                $contactRfc = $c['attributes']['RFC'] ?? '';
                $normalizedContactRfc = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', trim($contactRfc)));
                return $normalizedContactRfc === $rfc;
            }));

            if (empty($contacts)) {
                return $this->response([
                    'success' => false,
                    'message' => 'No se encontró ningún contacto con ese RFC.',
                    'debug' => [
                        'normalized_rfc' => $rfc,
                    ],
                ], 404);
            }

            // 5. Select Best Match using RAZON_SOCIAL
            $selectedContact = $this->selectBestMatch($contacts, $rawRazonSocial);

            $email = $selectedContact['email'] ?? null;
            if (!$email) {
                return $this->response([
                    'success' => false,
                    'message' => 'Contacto encontrado pero sin email (Contacta a tu Ejecutivo).',
                    'contact_found' => [
                        'id' => $selectedContact['id'] ?? null,
                        'attributes' => $selectedContact['attributes'] ?? [],
                    ],
                ], 409);
            }

            // =========================================================
            // 9) NUEVO Anti re-disparo simple (solo 2 campos)
            // Reglas:
            // - Si MUESTRA_PRODUCTO no existe -> lanzar evento
            // - Si existe pero MUESTRA_ULTIMA_AT está fuera de cooldownDays -> lanzar evento
            // - Si existe y está dentro de cooldownDays -> NO lanzar
            // =========================================================
            $attrs = $selectedContact['attributes'] ?? [];
            $muestraProducto = $attrs['MUESTRA_PRODUCTO'] ?? null;      // string
            $muestraUltimaAt = $attrs['MUESTRA_ULTIMA_AT'] ?? null;     // date (ISO o string)

            $cooldownDays = (int) (config('services.brevo.sample_cooldown_days') ?? $this->cooldownDays);

            $canTrigger = false;
            $reason = null;

            if (empty($muestraProducto)) {
                // Nunca ha solicitado (o no existe el atributo aún)
                $canTrigger = true;
                $reason = 'NO_PREVIOUS_SAMPLE';
            } else {
                if($muestraProducto != $producto){
                    $canTrigger = true;
                    $reason = 'DIFFERENT_PRODUCT';
                } else {
                    // Existe muestra_producto; revisamos fecha
                    if (empty($muestraUltimaAt)) {
                        // No hay fecha: tratamos como permitido
                        $canTrigger = true;
                        $reason = 'NO_LAST_DATE';
                    } else {
                        $lastTs = strtotime((string) $muestraUltimaAt);
                        if ($lastTs === false) {
                            // Fecha inválida: permitimos (mejor no bloquear por dato corrupto)
                            $canTrigger = true;
                            $reason = 'INVALID_LAST_DATE';
                        } else {
                            $diffDays = (time() - $lastTs) / 86400;
                            if ($diffDays >= $cooldownDays) {
                                $canTrigger = true;
                                $reason = 'COOLDOWN_PASSED';
                            } else {
                                // Bloqueado por cooldown
                                return $this->response([
                                    'success' => true,
                                    'message' => 'Ya existe una solicitud previa reciente. Intenta más adelante.',
                                    'email_used' => $email,
                                    'cooldown_days' => $cooldownDays,
                                    'muestra_producto_actual' => $muestraProducto,
                                    'muestra_ultima_at' => $muestraUltimaAt,
                                    'brevo_update' => 'SKIPPED_COOLDOWN',
                                ]);
                            }
                        }
                    }
                }
            }

            if (!$canTrigger) {
                // Por seguridad: si algo raro pasa, bloqueamos con mensaje genérico.
                return $this->response([
                    'success' => true,
                    'message' => 'Ya existe una solicitud previa reciente. Intenta más adelante.',
                    'email_used' => $email,
                    'brevo_update' => 'SKIPPED_UNKNOWN',
                ]);
            }

            // =========================================================
            // 10) Update attributes en Brevo (solo los 2 campos + RFC_VALIDADO estable)
            // =========================================================
            $nowIso = now()->toIso8601String();

            $updatePayload = [
                'attributes' => [
                    // Estado estable (ya no bloquea nada)
                    'RFC_VALIDADO' => true,
                    'RFC_VALIDADO_AT' => $attrs['RFC_VALIDADO_AT'] ?? $nowIso,

                    // Solo estos 2 campos de muestras (pisables)
                    'MUESTRA_PRODUCTO' => $producto,
                    'MUESTRA_ULTIMA_AT' => $nowIso,
                ],
            ];

            $updateResponse = Http::withHeaders([
                'api-key' => $apiKey,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ])->put('https://api.brevo.com/v3/contacts/' . urlencode($email), $updatePayload);

            if (!$updateResponse->successful()) {
                return $this->response([
                    'success' => false,
                    'message' => 'Contacto encontrado, pero falló la solicitud.',
                    'email_used' => $email,
                    'brevo_error' => $updateResponse->json(),
                ], $updateResponse->status());
            }

            // =========================================================
            // 11) Trigger REAL: evento personalizado (automation inicia aquí)
            // =========================================================
            $eventResponse = Http::withHeaders([
                'api-key' => $apiKey,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ])->post('https://api.brevo.com/v3/events', [
                'event_name' => $eventName,
                'identifiers' => [
                    'email_id' => $email,
                ],
                'event_date' => $nowIso,
                'event_properties' => [
                    'rfc' => $rfc,
                    'razon_social' => $rawRazonSocial,
                    'producto' => $producto,
                    'requested_at' => $nowIso,
                    'reason' => $reason, // NO_PREVIOUS_SAMPLE | NO_LAST_DATE | INVALID_LAST_DATE | COOLDOWN_PASSED
                ],
            ]);

            $eventOk = $eventResponse->successful() || $eventResponse->status() === 204;

            return $this->response([
                'success' => true,
                'message' => 'Solicitud registrada. Gracias, te contactaremos.',
                'email_used' => $email,
                'producto' => $producto,
                'cooldown_days' => $cooldownDays,
                'brevo_update' => 'OK',
                'brevo_event' => $eventOk
                    ? ($eventResponse->status() === 204 ? 'Event Created' : $eventResponse->json())
                    : [
                        'warning' => 'Atributos OK, pero el evento (trigger) falló.',
                        'status' => $eventResponse->status(),
                        'error' => $eventResponse->json(),
                    ],
            ]);

        } catch (\Exception $e) {
            return $this->response([
                'success' => false,
                'message' => 'Excepción durante el proceso.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Normalize RFC: trim, uppercase, remove spaces/dashes.
     */
    private function normalizeRfc($rfc)
    {
        return strtoupper(preg_replace('/[^A-Za-z0-9]/', '', trim($rfc)));
    }

    /**
     * Basic RFC validation for Mexico.
     * Persona Moral: 12 chars
     * Persona Física: 13 chars
     */
    private function isValidRfc($rfc)
    {
        $regex = '/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/';
        return preg_match($regex, $rfc);
    }

    /**
     * Select the best contact match based on RAZON_SOCIAL attribute.
     */
    private function selectBestMatch($contacts, $targetRazonSocial)
    {
        if (count($contacts) === 1) {
            return $contacts[0];
        }

        $bestMatch = $contacts[0];
        $highestSimilarity = -1;

        foreach ($contacts as $contact) {
            $razonSocial = $contact['attributes']['RAZON_SOCIAL'] ?? '';
            similar_text(strtoupper($razonSocial), strtoupper($targetRazonSocial), $percent);
            if ($percent > $highestSimilarity) {
                $highestSimilarity = $percent;
                $bestMatch = $contact;
            }
        }

        return $bestMatch;
    }

    /**
     * Standard response helper.
     */
    private function response($data, $status = 200)
    {
        if (config('app.debug')) {
            $data['env'] = 'development';
            $data['timestamp'] = now()->toDateTimeString();
        }

        return response()->json($data, $status);
    }
}