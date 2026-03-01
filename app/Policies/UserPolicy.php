<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Ver listado de usuarios.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('usuarios.ver');
    }

    /**
     * Ver un usuario específico.
     */
    public function view(User $user, User $model): bool
    {
        return $user->can('usuarios.ver');
    }

    /**
     * Crear un usuario.
     */
    public function create(User $user): bool
    {
        return $user->can('usuarios.crear');
    }

    /**
     * Editar un usuario.
     */
    public function update(User $user, User $model): bool
    {
        return $user->can('usuarios.editar');
    }

    /**
     * Eliminar un usuario.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->can('usuarios.eliminar');
    }
}
