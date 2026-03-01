<?php

namespace App\Livewire\Admin\Usuarios;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public bool $showCreateModal = false;
    public bool $showEditModal = false;
    public bool $showDeleteModal = false;

    public ?int $editingUserId = null;
    public ?int $deletingUserId = null;

    // Campos del formulario
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function create(): void
    {
        $this->authorize('create', User::class);
        $this->resetForm();
        $this->showCreateModal = true;
    }

    public function store(): void
    {
        $this->authorize('create', User::class);

        $this->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'email', 'unique:users,email'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string'],
            'role'                  => ['required', 'string', 'exists:roles,name'],
        ]);

        $usuario = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $usuario->syncRoles([$this->role]);

        $this->showCreateModal = false;
        $this->resetForm();
        session()->flash('success', 'Usuario creado exitosamente.');
    }

    public function edit(int $id): void
    {
        $usuario = User::findOrFail($id);
        $this->authorize('update', $usuario);

        $this->editingUserId = $id;
        $this->name = $usuario->name;
        $this->email = $usuario->email;
        $this->password = '';
        $this->password_confirmation = '';
        $this->role = $usuario->roles->first()?->name ?? '';
        $this->showEditModal = true;
    }

    public function update(): void
    {
        $usuario = User::findOrFail($this->editingUserId);
        $this->authorize('update', $usuario);

        $this->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'email', Rule::unique('users', 'email')->ignore($this->editingUserId)],
            'password'              => ['nullable', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['nullable', 'string'],
            'role'                  => ['required', 'string', 'exists:roles,name'],
        ]);

        $usuario->update([
            'name'  => $this->name,
            'email' => $this->email,
        ]);

        if (! empty($this->password)) {
            $usuario->update(['password' => Hash::make($this->password)]);
        }

        $usuario->syncRoles([$this->role]);

        $this->showEditModal = false;
        $this->editingUserId = null;
        $this->resetForm();
        session()->flash('success', 'Usuario actualizado exitosamente.');
    }

    public function confirmDelete(int $id): void
    {
        $usuario = User::findOrFail($id);
        $this->authorize('delete', $usuario);
        $this->deletingUserId = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $usuario = User::findOrFail($this->deletingUserId);
        $this->authorize('delete', $usuario);
        $usuario->delete();
        $this->showDeleteModal = false;
        $this->deletingUserId = null;
        session()->flash('success', 'Usuario eliminado.');
    }

    private function resetForm(): void
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->role = '';
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.usuarios.index', [
            'usuarios' => User::with('roles')
                ->where(fn ($q) => $q
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                )
                ->latest()
                ->paginate(15),
            'roles' => Role::where('guard_name', 'web')->pluck('name'),
        ]);
    }
}
