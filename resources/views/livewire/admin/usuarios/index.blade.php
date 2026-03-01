<div class="space-y-6">

    {{-- Encabezado + botón crear --}}
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl">Usuarios</flux:heading>
            <flux:subheading>Gestión de usuarios del panel admin.</flux:subheading>
        </div>

        @can('usuarios.crear')
            <flux:button variant="primary" wire:click="create" icon="plus">
                Nuevo usuario
            </flux:button>
        @endcan
    </div>

    {{-- Mensajes de feedback --}}
    @if (session('success'))
        <flux:callout variant="success" icon="check-circle">
            {{ session('success') }}
        </flux:callout>
    @endif

    {{-- Buscador --}}
    <flux:input wire:model.live.debounce.300ms="search"
                placeholder="Buscar por nombre o email…"
                icon="magnifying-glass"
                clearable />

    {{-- Tabla --}}
    <flux:table :paginate="$usuarios">
        <flux:table.columns>
            <flux:table.column>Nombre</flux:table.column>
            <flux:table.column>Email</flux:table.column>
            <flux:table.column>Rol</flux:table.column>
            <flux:table.column>Registrado</flux:table.column>
            <flux:table.column align="end">Acciones</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse ($usuarios as $usuario)
                <flux:table.row :key="$usuario->id" wire:key="usuario-{{ $usuario->id }}">
                    <flux:table.cell>{{ $usuario->name }}</flux:table.cell>
                    <flux:table.cell>{{ $usuario->email }}</flux:table.cell>
                    <flux:table.cell>
                        @if ($roleName = $usuario->roles->first()?->name)
                            <flux:badge color="blue" size="sm">
                                {{ ucfirst(str_replace('_', ' ', $roleName)) }}
                            </flux:badge>
                        @else
                            <flux:badge color="zinc" size="sm">Sin rol</flux:badge>
                        @endif
                    </flux:table.cell>
                    <flux:table.cell>{{ $usuario->created_at->format('d/m/Y') }}</flux:table.cell>
                    <flux:table.cell align="end">
                        <div class="flex items-center justify-end gap-2">
                            @can('usuarios.editar')
                                <flux:button size="sm" variant="ghost" icon="pencil"
                                             wire:click="edit({{ $usuario->id }})">
                                    Editar
                                </flux:button>
                            @endcan
                            @can('usuarios.eliminar')
                                <flux:button size="sm" variant="ghost" icon="trash"
                                             wire:click="confirmDelete({{ $usuario->id }})"
                                             class="text-red-600 hover:text-red-700">
                                    Eliminar
                                </flux:button>
                            @endcan
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="5" class="text-center text-zinc-500 py-8">
                        No se encontraron usuarios.
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    {{-- Modal: Crear usuario --}}
    <flux:modal wire:model="showCreateModal" class="max-w-lg w-full">
        <form wire:submit="store" class="space-y-6">
            <div>
                <flux:heading size="lg">Nuevo usuario</flux:heading>
                <flux:subheading>Completa los datos para crear un usuario interno.</flux:subheading>
            </div>

            <flux:input wire:model="name" label="Nombre" type="text"
                        placeholder="Ej. María García" required autofocus />

            <flux:input wire:model="email" label="Correo electrónico" type="email"
                        placeholder="usuario@ambiderm.mx" required />

            <flux:input wire:model="password" label="Contraseña" type="password"
                        placeholder="Mínimo 8 caracteres" required />

            <flux:input wire:model="password_confirmation" label="Confirmar contraseña"
                        type="password" required />

            <flux:select wire:model="role" label="Rol" required>
                <flux:select.option value="">— Seleccionar rol —</flux:select.option>
                @foreach ($roles as $roleName)
                    <flux:select.option value="{{ $roleName }}">
                        {{ ucfirst(str_replace('_', ' ', $roleName)) }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            <div class="flex justify-end gap-3">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>
                <flux:button variant="primary" type="submit">Crear usuario</flux:button>
            </div>
        </form>
    </flux:modal>

    {{-- Modal: Editar usuario --}}
    <flux:modal wire:model="showEditModal" class="max-w-lg w-full">
        <form wire:submit="update" class="space-y-6">
            <div>
                <flux:heading size="lg">Editar usuario</flux:heading>
                <flux:subheading>Deja la contraseña en blanco para mantener la actual.</flux:subheading>
            </div>

            <flux:input wire:model="name" label="Nombre" type="text" required />

            <flux:input wire:model="email" label="Correo electrónico" type="email" required />

            <flux:input wire:model="password" label="Nueva contraseña (opcional)" type="password"
                        placeholder="Dejar en blanco para no cambiar" />

            <flux:input wire:model="password_confirmation" label="Confirmar nueva contraseña"
                        type="password" />

            <flux:select wire:model="role" label="Rol" required>
                <flux:select.option value="">— Seleccionar rol —</flux:select.option>
                @foreach ($roles as $roleName)
                    <flux:select.option value="{{ $roleName }}">
                        {{ ucfirst(str_replace('_', ' ', $roleName)) }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            <div class="flex justify-end gap-3">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>
                <flux:button variant="primary" type="submit">Guardar cambios</flux:button>
            </div>
        </form>
    </flux:modal>

    {{-- Modal: Confirmar eliminación --}}
    <flux:modal wire:model="showDeleteModal" class="max-w-md w-full">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">¿Eliminar usuario?</flux:heading>
                <flux:subheading>Esta acción no se puede deshacer.</flux:subheading>
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
