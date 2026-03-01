<?php

namespace App\Policies;

use App\Models\Categoria;
use App\Models\User;

class CategoriaPolicy
{
    /**
     * Ver listado de categorías.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('categorias.ver');
    }

    /**
     * Ver una categoría específica.
     */
    public function view(User $user, Categoria $categoria): bool
    {
        return $user->can('categorias.ver');
    }

    /**
     * Crear una categoría.
     */
    public function create(User $user): bool
    {
        return $user->can('categorias.crear');
    }

    /**
     * Editar una categoría.
     */
    public function update(User $user, Categoria $categoria): bool
    {
        return $user->can('categorias.editar');
    }

    /**
     * Eliminar una categoría.
     * No se permite si tiene productos asociados.
     */
    public function delete(User $user, Categoria $categoria): bool
    {
        if ($categoria->productos()->count() > 0) {
            return false;
        }

        return $user->can('categorias.eliminar');
    }
}
