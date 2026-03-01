<?php

namespace App\Livewire\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public Role $role;

    public array $selectedPermissions = [];

    public array $allPermissions = [];

    public function mount(Role $rol): void
    {
        $this->role = $rol;

        $this->selectedPermissions = $rol->permissions->pluck('name')->toArray();

        $this->allPermissions = Permission::where('guard_name', 'web')
            ->get()
            ->groupBy(fn ($p) => explode('.', $p->name)[0])
            ->map(fn ($group) => $group->pluck('name')->toArray())
            ->toArray();
    }

    public function save(): void
    {
        $this->authorize('update', $this->role);

        $this->validate([
            'selectedPermissions'   => ['nullable', 'array'],
            'selectedPermissions.*' => ['exists:permissions,name'],
        ]);

        $this->role->syncPermissions($this->selectedPermissions);

        session()->flash('success', 'Permisos del rol actualizados.');
        $this->redirect(route('admin.roles.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.roles.edit');
    }
}
