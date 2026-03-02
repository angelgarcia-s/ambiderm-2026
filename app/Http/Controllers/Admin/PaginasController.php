<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeccionContenido;

class PaginasController extends Controller
{
    /**
     * Listado de páginas con sus secciones editables.
     */
    public function index()
    {
        $this->authorize('viewAny', SeccionContenido::class);

        $secciones = SeccionContenido::orderBy('pagina')
            ->orderBy('orden')
            ->get()
            ->groupBy('pagina');

        return view('admin.paginas.index', compact('secciones'));
    }

    /**
     * Formulario de edición de una sección.
     */
    public function edit(string $pagina, string $seccion)
    {
        $seccionContenido = SeccionContenido::where('pagina', $pagina)
            ->where('seccion', $seccion)
            ->firstOrFail();

        $this->authorize('update', $seccionContenido);

        return view('admin.paginas.edit', compact('seccionContenido'));
    }
}
