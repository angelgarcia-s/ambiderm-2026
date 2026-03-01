<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Listado de roles.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Role::class);

        $roles = Role::where('guard_name', 'web')
            ->withCount('permissions')
            ->latest()
            ->paginate(15);

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Formulario de creación.
     */
    public function create()
    {
        $this->authorize('create', Role::class);

        $permisosAgrupados = Permission::where('guard_name', 'web')
            ->get()
            ->groupBy(fn ($p) => explode('.', $p->name)[0]);

        return view('admin.roles.create', compact('permisosAgrupados'));
    }

    /**
     * Almacenar nuevo rol.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Role::class);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:roles,name', 'regex:/^[a-z_]+$/'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['exists:permissions,name'],
        ]);

        $role = Role::create([
            'name' => $validated['name'],
            'guard_name' => 'web',
        ]);

        $role->syncPermissions($validated['permissions'] ?? []);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol creado exitosamente.');
    }

    /**
     * Formulario de edición.
     */
    public function edit(Role $rol)
    {
        $this->authorize('update', $rol);

        $permisosAgrupados = Permission::where('guard_name', 'web')
            ->get()
            ->groupBy(fn ($p) => explode('.', $p->name)[0]);

        $permisosDelRol = $rol->permissions->pluck('name')->toArray();

        return view('admin.roles.edit', compact('rol', 'permisosAgrupados', 'permisosDelRol'));
    }

    /**
     * Actualizar rol existente.
     */
    public function update(Request $request, Role $rol)
    {
        $this->authorize('update', $rol);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:roles,name,' . $rol->id, 'regex:/^[a-z_]+$/'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['exists:permissions,name'],
        ]);

        $rol->update(['name' => $validated['name']]);
        $rol->syncPermissions($validated['permissions'] ?? []);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol actualizado exitosamente.');
    }

    /**
     * Eliminar rol.
     */
    public function destroy(Role $rol)
    {
        $this->authorize('delete', $rol);

        // Protección adicional: no eliminar super_admin
        if ($rol->name === 'super_admin') {
            abort(403, 'No se puede eliminar el rol super_admin.');
        }

        $rol->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol eliminado exitosamente.');
    }
}
