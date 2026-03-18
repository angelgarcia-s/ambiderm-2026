<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Primero crear roles y permisos (antes de asignar roles a usuarios)
        $this->call(RolesAndPermissionsSeeder::class);

        // Super Admin de Ambiderm
        $admin = User::firstOrCreate(
            ['email' => 'admin@ambiderm.com.mx'],
            [
                'name' => 'Admin Ambiderm',
                'password' => bcrypt(env('SUPERADMIN_PASSWORD', 'changeme')),
            ]
        );
        $admin->syncRoles(['super_admin']);

        // Categorías base del catálogo
        $this->call(CategoriasSeeder::class);
        
        // Contenido de páginas públicas (ADR-002)
        $this->call(SeccionesContenidoSeeder::class);

    }
}
