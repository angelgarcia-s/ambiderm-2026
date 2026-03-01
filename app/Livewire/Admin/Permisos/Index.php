<?php

namespace App\Livewire\Admin\Permisos;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    public array $permissionsByModule = [];

    public function mount(): void
    {
        $this->permissionsByModule = Permission::where('guard_name', 'web')
            ->get()
            ->groupBy(fn ($p) => explode('.', $p->name)[0])
            ->map(fn ($group) => $group->pluck('name')->toArray())
            ->toArray();
    }

    public function render()
    {
        return view('livewire.admin.permisos.index');
    }
}
