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
                'password' => bcrypt('12345678'),
            ]
        );
        $admin->syncRoles(['super_admin']);
    }
}
