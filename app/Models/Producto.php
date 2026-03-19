<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'slug',
        'subtitulo',
        'material',
        'descripcion',
        'imagen',
        'caracteristicas',
        'etiquetas',
        'presentacion',
        'certificaciones',
        'url_tienda',
        'url_ficha_tecnica',
        'activo',
        'destacado',
        'orden',
    ];

    protected function casts(): array
    {
        return [
            'caracteristicas' => 'array',
            'etiquetas' => 'array',
            'activo' => 'boolean',
            'destacado' => 'boolean',
            'orden' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Producto $producto) {
            if (empty($producto->slug)) {
                $producto->slug = Str::slug($producto->nombre);
            }
        });

        static::saving(function (Producto $producto) {
            if ($producto->isDirty('nombre') && ! $producto->isDirty('slug')) {
                $producto->slug = Str::slug($producto->nombre);
            }
        });
    }

    // — Accessors —

    public function getImagenUrlAttribute(): ?string
    {
        return $this->imagen ? Storage::url($this->imagen) : null;
    }

    // — Relaciones —

    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Categoria::class, 'categoria_producto');
    }

    public function tamanos(): BelongsToMany
    {
        return $this->belongsToMany(Tamano::class, 'producto_tamano')
            ->orderBy('orden')
            ->orderBy('nombre');
    }

    public function colores(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'color_producto')
            ->withPivot('imagen')
            ->orderBy('orden')
            ->orderBy('nombre');
    }

    // — Scopes —

    public function scopeActivo($query)
    {
        return $query->where('activo', true);
    }

    public function scopeDestacado($query)
    {
        return $query->where('destacado', true);
    }

    public function scopeOrdenado($query)
    {
        return $query->orderBy('orden')->orderBy('nombre');
    }

    public function scopeDeCategoria($query, string $categoriaSlug)
    {
        return $query->whereHas('categorias', fn ($q) => $q->where('slug', $categoriaSlug));
    }
}
