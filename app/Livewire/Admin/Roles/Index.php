<?php

namespace App\Livewire\Admin\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination;

    public bool $showCreateModal = false;
    public bool $showDeleteModal = false;

    public ?int $deletingRoleId = null;

    // Formulario creación
    public string $name = '';

    public function create(): void
    {
        $this->authorize('create', Role::class);
        $this->name = '';
        $this->resetValidation();
        $this->showCreateModal = true;
    }

    public function store(): void
    {
        $this->authorize('create', Role::class);

        $this->validate([
            'name' => ['required', 'string', 'max:100', 'unique:roles,name', 'regex:/^[a-z_]+$/'],
        ], [
            'name.regex' => 'El nombre solo puede contener letras minúsculas y guiones bajos.',
        ]);

        Role::create([
            'name'       => $this->name,
            'guard_name' => 'web',
        ]);

        $this->showCreateModal = false;
        $this->name = '';
        session()->flash('success', 'Rol creado exitosamente.');
    }

    public function confirmDelete(int $id): void
    {
        $rol = Role::findOrFail($id);
        $this->authorize('delete', $rol);
        $this->deletingRoleId = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $rol = Role::findOrFail($this->deletingRoleId);
        $this->authorize('delete', $rol);
        $rol->delete();
        $this->showDeleteModal = false;
        $this->deletingRoleId = null;
        session()->flash('success', 'Rol eliminado.');
    }

    public function render()
    {
        return view('livewire.admin.roles.index', [
            'roles' => Role::where('guard_name', 'web')
                ->withCount(['permissions', 'users'])
                ->latest()
                ->paginate(15),
        ]);
    }
}
