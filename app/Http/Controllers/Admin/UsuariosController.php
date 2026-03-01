<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UsuariosController extends Controller
{
    /**
     * Listado de usuarios.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $usuarios = User::with('roles')->latest()->paginate(15);

        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Formulario de creación.
     */
    public function create()
    {
        $this->authorize('create', User::class);

        $roles = Role::where('guard_name', 'web')->pluck('name');

        return view('admin.usuarios.create', compact('roles'));
    }

    /**
     * Almacenar nuevo usuario.
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'exists:roles,name'],
        ]);

        $usuario = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $usuario->syncRoles([$validated['role']]);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Formulario de edición.
     */
    public function edit(User $usuario)
    {
        $this->authorize('update', $usuario);

        $roles = Role::where('guard_name', 'web')->pluck('name');

        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Actualizar usuario existente.
     */
    public function update(Request $request, User $usuario)
    {
        $this->authorize('update', $usuario);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($usuario->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'exists:roles,name'],
        ]);

        $usuario->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if (! empty($validated['password'])) {
            $usuario->update([
                'password' => Hash::make($validated['password']),
            ]);
        }

        $usuario->syncRoles([$validated['role']]);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Eliminar usuario.
     */
    public function destroy(User $usuario)
    {
        $this->authorize('delete', $usuario);

        $usuario->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}
