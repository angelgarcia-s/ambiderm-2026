<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Todos los permisos del sistema — convención: modulo.accion
     */
    private array $permissions = [
        // Dashboard
        'dashboard.ver',

        // Usuarios
        'usuarios.ver',
        'usuarios.crear',
        'usuarios.editar',
        'usuarios.eliminar',

        // Roles
        'roles.ver',
        'roles.crear',
        'roles.editar',
        'roles.eliminar',

        // Permisos
        'permisos.ver',

        // Productos (reservado para ADR-003)
        'productos.ver',
        'productos.crear',
        'productos.editar',
        'productos.eliminar',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar caché de permisos de Spatie
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->seedPermissions();
        $this->seedRoles();
        $this->assignAllToSuperAdmin();
        $this->assignPermissions();
    }

    /**
     * Crear o sincronizar todos los permisos del array.
     */
    private function seedPermissions(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }

    /**
     * Crear los tres roles del sistema.
     */
    private function seedRoles(): void
    {
        $roles = ['super_admin', 'admin', 'editor'];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'web',
            ]);
        }
    }

    /**
     * super_admin recibe TODOS los permisos existentes.
     */
    private function assignAllToSuperAdmin(): void
    {
        $superAdmin = Role::findByName('super_admin', 'web');
        $superAdmin->syncPermissions(Permission::all());
    }

    /**
     * Asignar permisos específicos a admin y editor.
     */
    private function assignPermissions(): void
    {
        // admin: gestión operativa completa
        $admin = Role::findByName('admin', 'web');
        $admin->syncPermissions([
            'dashboard.ver',
            'usuarios.ver',
            'usuarios.crear',
            'usuarios.editar',
            'usuarios.eliminar',
            'roles.ver',
            'roles.crear',
            'roles.editar',
            'roles.eliminar',
            'permisos.ver',
            'productos.ver',
            'productos.crear',
            'productos.editar',
            'productos.eliminar',
        ]);

        // editor: solo contenido
        $editor = Role::findByName('editor', 'web');
        $editor->syncPermissions([
            'dashboard.ver',
            'productos.ver',
            'productos.editar',
        ]);
    }
}
