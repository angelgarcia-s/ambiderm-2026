<?php

namespace App\Services;

use App\Models\SeccionContenido;
use Illuminate\Support\Collection;

class ContenidoService
{
    /**
     * Obtener el contenido JSON de una sección específica (con caché de 24h).
     */
    public static function obtener(string $pagina, string $seccion): array
    {
        $cacheKey = "contenido.{$pagina}.{$seccion}";

        return cache()->remember($cacheKey, now()->addHours(24), function () use ($pagina, $seccion) {
            return SeccionContenido::obtener($pagina, $seccion) ?? [];
        });
    }

    /**
     * Obtener todas las secciones activas de una página, keyed por sección (con caché de 24h).
     */
    public static function obtenerPagina(string $pagina): Collection
    {
        $cacheKey = "contenido.{$pagina}";

        return cache()->remember($cacheKey, now()->addHours(24), function () use ($pagina) {
            return SeccionContenido::pagina($pagina)->get()->keyBy('seccion');
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
