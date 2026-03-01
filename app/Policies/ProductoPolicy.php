<?php

namespace App\Policies;

use App\Models\Producto;
use App\Models\User;

class ProductoPolicy
{
    /**
     * Ver listado de productos.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('productos.ver');
    }

    /**
     * Ver un producto específico.
     */
    public function view(User $user, Producto $producto): bool
    {
        return $user->can('productos.ver');
    }

    /**
     * Crear un producto.
     */
    public function create(User $user): bool
    {
        return $user->can('productos.crear');
    }

    /**
     * Editar un producto.
     */
    public function update(User $user, Producto $producto): bool
    {
        return $user->can('productos.editar');
    }

    /**
     * Eliminar un producto.
     */
    public function delete(User $user, Producto $producto): bool
    {
        return $user->can('productos.eliminar');
    }
}
