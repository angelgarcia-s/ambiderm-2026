<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Poblar la tabla categorias con las 4 categorías base de Ambiderm.
     *
     * Idempotente: usa updateOrCreate por slug.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Guantes',         'slug' => 'guantes',         'orden' => 1],
            ['nombre' => 'Dental',          'slug' => 'dental',          'orden' => 2],
            ['nombre' => 'Ropa Médica',     'slug' => 'ropa-medica',     'orden' => 3],
            ['nombre' => 'Dispositivos Médicos', 'slug' => 'dispositivos-medicos', 'orden' => 4],
        ];

        foreach ($categorias as $data) {
            Categoria::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'nombre' => $data['nombre'],
                    'orden'  => $data['orden'],
                    'activo' => true,
                ]
            );
        }
    }
}
