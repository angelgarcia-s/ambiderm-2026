<div class="space-y-6">

    {{-- Encabezado + botón crear --}}
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl">Roles</flux:heading>
            <flux:subheading>Gestión de roles del panel admin.</flux:subheading>
        </div>

        @can('roles.crear')
            <flux:button variant="primary" wire:click="create" icon="plus">
                Nuevo rol
            </flux:button>
        @endcan
    </div>

    {{-- Mensajes de feedback --}}
    @if (session('success'))
        <flux:callout variant="success" icon="check-circle">
            {{ session('success') }}
        </flux:callout>
    @endif

    {{-- Tabla --}}
    <flux:table :paginate="$roles">
        <flux:table.columns>
            <flux:table.column>Nombre</flux:table.column>
            <flux:table.column>Permisos</flux:table.column>
            <flux:table.column>Usuarios</flux:table.column>
            <flux:table.column align="end">Acciones</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse ($roles as $rol)
                <flux:table.row :key="$rol->id" wire:key="rol-{{ $rol->id }}">
                    <flux:table.cell>
                        <flux:badge color="{{ $rol->name === 'super_admin' ? 'red' : 'zinc' }}" size="sm">
                            {{ ucfirst(str_replace('_', ' ', $rol->name)) }}
                        </flux:badge>
                    </flux:table.cell>
                    <flux:table.cell>{{ $rol->permissions_count }}</flux:table.cell>
                    <flux:table.cell>{{ $rol->users_count }}</flux:table.cell>
                    <flux:table.cell align="end">
                        <div class="flex items-center justify-end gap-2">
                            @can('roles.editar')
                                <flux:button size="sm" variant="ghost" icon="pencil"
                                             :href="route('admin.roles.edit', $rol)" wire:navigate>
                                    Editar
                                </flux:button>
                            @endcan
                            @can('roles.eliminar')
                                @if ($rol->name !== 'super_admin')
                                    <flux:button size="sm" variant="ghost" icon="trash"
                                                 wire:click="confirmDelete({{ $rol->id }})"
                                                 class="text-red-600 hover:text-red-700">
                                        Eliminar
                                    </flux:button>
                                @endif
                            @endcan
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="4" class="text-center text-zinc-500 py-8">
                        No hay roles registrados.
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    {{-- Modal: Crear rol --}}
    <flux:modal wire:model="showCreateModal" class="max-w-md w-full">
        <form wire:submit="store" class="space-y-6">
            <div>
                <flux:heading size="lg">Nuevo rol</flux:heading>
                <flux:subheading>
                    Usa minúsculas y guiones bajos. Ejemplo: <code>editor_contenido</code>
                </flux:subheading>
            </div>

            <flux:input wire:model="name" label="Nombre del rol" type="text"
                        placeholder="ej. editor_contenido" required autofocus />

            <div class="flex justify-end gap-3">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>
                <flux:button variant="primary" type="submit">Crear rol</flux:button>
            </div>
        </form>
    </flux:modal>

    {{-- Modal: Confirmar eliminación --}}
    <flux:modal wire:model="showDeleteModal" class="max-w-md w-full">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">¿Eliminar rol?</flux:heading>
                <flux:subheading>Esta acción no se puede deshacer. Los usuarios con este rol quedarán sin rol asignado.</flux:subheading>
            </div>

            <div class="flex justify-end gap-3">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>
                <flux:button variant="danger" wire:click="delete">
                    Sí, eliminar
                </flux:button>
            </div>
        </div>
    </flux:modal>

</div>
