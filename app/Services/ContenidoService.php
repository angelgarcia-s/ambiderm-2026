<?php

namespace App\Services;

use App\Models\SeccionContenido;
use Illuminate\Support\Collection;

class ContenidoService
{
    /**
     * Contenido fallback por página/sección cuando la DB está vacía.
     * Evita errores "Undefined array key" en vistas públicas.
     */
    private static array $defaults = [
        'home' => [
            'hero' => ['titulo' => '', 'subtitulo' => '', 'imagen' => '', 'imagen_alt' => ''],
            'video_feature' => ['badge' => '', 'nombre_producto' => '', 'descripcion' => '', 'video_url' => '', 'cta_texto' => '', 'cta_url' => '#'],
            'coleccion' => ['titulo' => '', 'subtitulo' => '', 'ver_todos_url' => '/productos', 'ver_todos_texto' => 'Ver todos'],
            'soluciones_medicas' => ['titulo' => '', 'subtitulo' => '', 'items' => []],
            'eco_friendly' => ['badge' => '', 'titulo' => '', 'parrafo_principal' => '', 'parrafo_secundario' => '', 'imagen' => '', 'icono' => ''],
            'youtube_video' => ['video_id' => ''],
        ],
        'nosotros' => [
            'hero' => ['badge' => '', 'titulo' => '', 'subtitulo' => ''],
            'historia' => ['imagen' => '', 'anio' => '', 'anio_etiqueta' => '', 'titulo' => '', 'parrafos' => ''],
            'mision' => ['icono' => 'target', 'titulo' => 'Misión', 'texto' => ''],
            'vision' => ['icono' => 'eye', 'titulo' => 'Visión', 'texto' => ''],
            'valores' => ['badge' => '', 'titulo' => '', 'subtitulo' => '', 'items' => []],
        ],
        'footer' => [
            'redes_sociales' => ['logo' => '', 'titulo' => '', 'instagram_url' => '#', 'instagram_icono' => '', 'facebook_url' => '#', 'facebook_icono' => ''],
            'sucursales' => ['titulo' => '', 'items' => []],
            'contacto' => ['badge' => '', 'titulo' => '', 'subtitulo' => '', 'distribuidor_titulo' => '', 'distribuidor_subtitulo' => '', 'distribuidor_url' => '#', 'distribuidor_icono' => '', 'form_action_url' => '#', 'email' => ''],
            'copyright' => ['texto' => '', 'subtexto' => '', 'links' => []],
        ],
    ];

    /**
     * Obtener el contenido JSON de una sección específica (con caché de 24h).
     */
    public static function obtener(string $pagina, string $seccion): array
    {
        $cacheKey = "contenido.{$pagina}.{$seccion}";

        return cache()->remember($cacheKey, now()->addHours(24), function () use ($pagina, $seccion) {
            return SeccionContenido::obtener($pagina, $seccion)
                ?? self::$defaults[$pagina][$seccion]
                ?? [];
        });
    }

    /**
     * Obtener todas las secciones activas de una página, keyed por sección (con caché de 24h).
     * Si faltan secciones en la DB, se rellenan con contenido fallback.
     */
    public static function obtenerPagina(string $pagina): Collection
    {
        $cacheKey = "contenido.{$pagina}";

        return cache()->remember($cacheKey, now()->addHours(24), function () use ($pagina) {
            $secciones = SeccionContenido::pagina($pagina)->get()->keyBy('seccion');

            // Rellenar secciones faltantes con mocks fallback
            foreach (self::$defaults[$pagina] ?? [] as $seccion => $contenido) {
                if (! $secciones->has($seccion)) {
                    $mock = new SeccionContenido([
                        'pagina' => $pagina,
                        'seccion' => $seccion,
                        'titulo_admin' => ucfirst(str_replace('_', ' ', $seccion)),
                        'contenido' => $contenido,
                        'orden' => 99,
                        'activo' => true,
                    ]);
                    $secciones->put($seccion, $mock);
                }
            }

            return $secciones;
        });
    }

    /**
     * Invalidar caché de una sección o de toda la página.
     * Se llama automáticamente al guardar desde el panel admin.
     */
    public static function invalidarCache(string $pagina, ?string $seccion = null): void
    {
        if ($seccion) {
            cache()->forget("contenido.{$pagina}.{$seccion}");
        }

        cache()->forget("contenido.{$pagina}");
    }
}
