<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Color extends Model
{
    protected $table = 'colores';

    protected $fillable = [
        'nombre',
        'hex',
        'icono',
        'orden',
    ];

    protected function casts(): array
    {
        return [
            'orden' => 'integer',
        ];
    }

    // — Relaciones —

    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'color_producto')->withPivot('imagen');
    }

    // — Scopes —

    public function scopeOrdenado($query)
    {
        return $query->orderBy('orden')->orderBy('nombre');
    }
}
