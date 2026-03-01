<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'imagen',
        'activo',
        'orden',
    ];

    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
            'orden' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Categoria $categoria) {
            if (empty($categoria->slug)) {
                $categoria->slug = Str::slug($categoria->nombre);
            }
        });

        static::saving(function (Categoria $categoria) {
            if ($categoria->isDirty('nombre') && ! $categoria->isDirty('slug')) {
                $categoria->slug = Str::slug($categoria->nombre);
            }
        });
    }

    // — Relaciones —

    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'categoria_producto');
    }

    // — Scopes —

    public function scopeActivo($query)
    {
        return $query->where('activo', true);
    }

    public function scopeOrdenado($query)
    {
        return $query->orderBy('orden')->orderBy('nombre');
    }
}
