<?php

namespace App\Policies;

use App\Models\SeccionContenido;
use App\Models\User;

class SeccionContenidoPolicy
{
    /**
     * Ver listado de páginas y secciones.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('paginas.ver');
    }

    /**
     * Editar el contenido de una sección.
     */
    public function update(User $user, SeccionContenido $seccionContenido): bool
    {
        return $user->can('paginas.editar');
    }
}
