<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tamano extends Model
{
    protected $table = 'tamanos';

    protected $fillable = [
        'nombre',
        'abreviatura',
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
        return $this->belongsToMany(Producto::class, 'producto_tamano');
    }

    // — Scopes —

    public function scopeOrdenado($query)
    {
        return $query->orderBy('orden')->orderBy('nombre');
    }
}
