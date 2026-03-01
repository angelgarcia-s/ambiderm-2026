<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisosController extends Controller
{
    /**
     * Listado de permisos agrupados por módulo.
     */
    public function index(Request $request)
    {
        $permisosAgrupados = Permission::where('guard_name', 'web')
            ->get()
            ->groupBy(fn ($p) => explode('.', $p->name)[0]);

        return view('admin.permisos.index', compact('permisosAgrupados'));
    }
}
