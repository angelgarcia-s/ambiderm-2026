<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\SeccionContenido;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'productos_activos'  => Producto::activo()->count(),
            'productos_total'    => Producto::count(),
            'categorias'         => Categoria::count(),
            'usuarios'           => User::count(),
            'secciones_activas'  => SeccionContenido::where('activo', true)->count(),
            'secciones_total'    => SeccionContenido::count(),
        ];

        $secciones_recientes = SeccionContenido::orderByDesc('updated_at')
            ->limit(6)
            ->get();

        return view('dashboard', compact('stats', 'secciones_recientes'));
    }
}
