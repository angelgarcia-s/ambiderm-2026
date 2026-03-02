<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeccionContenido extends Model
{
    protected $table = 'secciones_contenido';

    protected $fillable = [
        'pagina',
        'seccion',
        'titulo_admin',
        'contenido',
        'orden',
        'activo',
    ];

    protected $casts = [
        'contenido' => 'array',
        'activo' => 'boolean',
    ];

    /**
     * Scope: obtener secciones activas de una página, ordenadas.
     */
    public function scopePagina($query, string $pagina)
    {
        return $query->where('pagina', $pagina)
            ->where('activo', true)
            ->orderBy('orden');
    }

    /**
     * Helper: obtener el contenido JSON de una sección específica.
     */
    public static function obtener(string $pagina, string $seccion): ?array
    {
        $registro = static::where('pagina', $pagina)
            ->where('seccion', $seccion)
            ->where('activo', true)
            ->first();

        return $registro?->contenido;
    }
}
