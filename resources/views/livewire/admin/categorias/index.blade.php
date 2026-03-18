<div class="space-y-6">

    {{-- Encabezado + botón crear --}}
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl">Categorías</flux:heading>
            <flux:subheading>Gestión de categorías de productos.</flux:subheading>
        </div>

        @can('categorias.crear')
            <flux:button variant="primary" wire:click="create" icon="plus">
                Nueva categoría
            </flux:button>
        @endcan
    </div>

    {{-- Mensajes de feedback --}}
    @if (session('success'))
        <flux:callout variant="success" icon="check-circle">
            {{ session('success') }}
        </flux:callout>
    @endif

    @if (session('error'))
        <flux:callout variant="danger" icon="x-circle">
            {{ session('error') }}
        </flux:callout>
    @endif

    {{-- Búsqueda --}}
    <flux:input wire:model.live.debounce.300ms="search"
                placeholder="Buscar por nombre…"
                icon="magnifying-glass"
                clearable />

    {{-- Tabla --}}
    <flux:table :paginate="$categorias">
        <flux:table.columns>
            <flux:table.column>Imagen</flux:table.column>
            <flux:table.column>Nombre</flux:table.column>
            <flux:table.column>Slug</flux:table.column>
            <flux:table.column>Productos</flux:table.column>
            <flux:table.column>Estado</flux:table.column>
            <flux:table.column>Orden</flux:table.column>
            <flux:table.column align="end">Acciones</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse ($categorias as $categoria)
                <flux:table.row :key="$categoria->id" wire:key="categoria-{{ $categoria->id }}">
                    <flux:table.cell>
                        @if ($categoria->imagen)
                            <img src="{{ Storage::url($categoria->imagen) }}"
                                 alt="{{ $categoria->nombre }}"
                                 class="w-10 h-10 object-cover rounded" />
                        @else
                            <div class="w-10 h-10 bg-zinc-200 dark:bg-zinc-700 rounded flex items-center justify-center">
                                <flux:icon name="photo" class="w-5 h-5 text-zinc-400" />
                            </div>
                        @endif
                    </flux:table.cell>
                    <flux:table.cell class="font-medium">{{ $categoria->nombre }}</flux:table.cell>
                    <flux:table.cell class="text-zinc-500">{{ $categoria->slug }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:badge color="zinc" size="sm">{{ $categoria->productos_count }}</flux:badge>
                    </flux:table.cell>
                    <flux:table.cell>
                        @if ($categoria->activo)
                            <flux:badge color="green" size="sm">Activo</flux:badge>
                        @else
                            <flux:badge color="zinc" size="sm">Inactivo</flux:badge>
                        @endif
                    </flux:table.cell>
                    <flux:table.cell>{{ $categoria->orden }}</flux:table.cell>
                    <flux:table.cell align="end">
                        <div class="flex items-center justify-end gap-2">
                            @can('categorias.editar')
                                <flux:button size="sm" variant="ghost" icon="pencil"
                                             wire:click="edit({{ $categoria->id }})">
                                    Editar
                                </flux:button>
                            @endcan
                            @can('categorias.eliminar')
                                <flux:button size="sm" variant="ghost" icon="trash"
                                             wire:click="confirmDelete({{ $categoria->id }})"
                                             class="text-red-600 hover:text-red-700">
                                    Eliminar
                                </flux:button>
                            @endcan
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="7" class="text-center text-zinc-500 py-8">
                        No hay categorías registradas.
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    {{-- Modal: Crear categoría --}}
    <flux:modal wire:model="showCreateModal" class="max-w-lg w-full" :dismissible="false">
        <form wire:submit="store" class="space-y-6">
            <div>
                <flux:heading size="lg">Nueva categoría</flux:heading>
                <flux:subheading>Completa los datos para crear una categoría de productos.</flux:subheading>
            </div>

            <flux:input wire:model.live.debounce.300ms="nombre" label="Nombre" type="text"
                        placeholder="Ej. Guantes de látex" required autofocus />

            <flux:input wire:model="slug" label="Slug" type="text"
                        placeholder="Se genera automáticamente" required />

            <flux:textarea wire:model="descripcion" label="Descripción" rows="3"
                           placeholder="Descripción breve de la categoría (opcional)" />

            <div>
                <flux:label>Imagen</flux:label>
                <input type="file" wire:model="imagen" accept="image/*"
                       class="mt-1 block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200 dark:file:bg-zinc-700 dark:file:text-zinc-300" />
                @error('imagen') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                @if ($imagen)
                    <img src="{{ $imagen->temporaryUrl() }}" class="mt-2 w-24 h-24 object-cover rounded" alt="Preview" />
                @endif
            </div>

            <div class="grid grid-cols-2 gap-4">
                <flux:input wire:model="orden" label="Orden" type="number" min="0" />
                <div class="flex items-end pb-1">
                    <flux:switch wire:model="activo" label="Activo" />
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>
                <flux:button variant="primary" type="submit">Crear categoría</flux:button>
            </div>
        </form>
    </flux:modal>

    {{-- Modal: Editar categoría --}}
    <flux:modal wire:model="showEditModal" class="max-w-lg w-full" :dismissible="false">
        <form wire:submit="update" class="space-y-6">
            <div>
                <flux:heading size="lg">Editar categoría</flux:heading>
                <flux:subheading>Modifica los datos de la categoría.</flux:subheading>
            </div>

            <flux:input wire:model.live.debounce.300ms="nombre" label="Nombre" type="text" required />

            <flux:input wire:model="slug" label="Slug" type="text" required />

            <flux:textarea wire:model="descripcion" label="Descripción" rows="3" />

            <div>
                <flux:label>Imagen</flux:label>
                @if ($imagenActual && !$imagen)
                    <div class="mt-2 flex items-center gap-3">
                        <img src="{{ Storage::url($imagenActual) }}" class="w-24 h-24 object-cover rounded" alt="Imagen actual" />
                        <span class="text-sm text-zinc-500">Imagen actual</span>
                    </div>
                @endif
                <input type="file" wire:model="imagen" accept="image/*"
                       class="mt-2 block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200 dark:file:bg-zinc-700 dark:file:text-zinc-300" />
                @error('imagen') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                @if ($imagen)
                    <img src="{{ $imagen->temporaryUrl() }}" class="mt-2 w-24 h-24 object-cover rounded" alt="Preview nueva imagen" />
                @endif
            </div>

            <div class="grid grid-cols-2 gap-4">
                <flux:input wire:model="orden" label="Orden" type="number" min="0" />
                <div class="flex items-end pb-1">
                    <flux:switch wire:model="activo" label="Activo" />
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>
                <flux:button variant="primary" type="submit">Guardar cambios</flux:button>
            </div>
        </form>
    </flux:modal>

    {{-- Modal: Confirmar eliminación --}}
    <flux:modal wire:model="showDeleteModal" class="max-w-md w-full" :dismissible="false">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">¿Eliminar categoría?</flux:heading>
                <flux:subheading>Esta acción no se puede deshacer. Solo se puede eliminar si no tiene productos asociados.</flux:subheading>
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
