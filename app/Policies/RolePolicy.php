<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    /**
     * Ver listado de roles.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('roles.ver');
    }

    /**
     * Ver un rol específico.
     */
    public function view(User $user, Role $role): bool
    {
        return $user->can('roles.ver');
    }

    /**
     * Crear un rol.
     */
    public function create(User $user): bool
    {
        return $user->can('roles.crear');
    }

    /**
     * Editar un rol.
     */
    public function update(User $user, Role $role): bool
    {
        return $user->can('roles.editar');
    }

    /**
     * Eliminar un rol.
     * No se permite eliminar super_admin.
     */
    public function delete(User $user, Role $role): bool
    {
        if ($role->name === 'super_admin') {
            return false;
        }

        return $user->can('roles.eliminar');
    }
}
