<div class="space-y-6">

    {{-- Encabezado --}}
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl">Productos</flux:heading>
            <flux:subheading>Gestión de productos del catálogo.</flux:subheading>
        </div>

        @can('productos.crear')
            <flux:button variant="primary" :href="route('admin.productos.create')" icon="plus" wire:navigate>
                Nuevo producto
            </flux:button>
        @endcan
    </div>

    {{-- Mensajes de feedback --}}
    @if (session('success'))
        <flux:callout variant="success" icon="check-circle">
            {{ session('success') }}
        </flux:callout>
    @endif

    {{-- Filtros --}}
    <div class="flex flex-col sm:flex-row gap-3">
        <div class="flex-1">
            <flux:input wire:model.live.debounce.300ms="search"
                        placeholder="Buscar por nombre…"
                        icon="magnifying-glass"
                        clearable />
        </div>
        <div class="w-full sm:w-64">
            <flux:select wire:model.live="categoriaFilter">
                <flux:select.option value="">Todas las categorías</flux:select.option>
                @foreach ($categorias as $slug => $nombre)
                    <flux:select.option value="{{ $slug }}">{{ $nombre }}</flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    {{-- Tabla --}}
    <flux:table :paginate="$productos">
        <flux:table.columns>
            <flux:table.column>Imagen</flux:table.column>
            <flux:table.column>Nombre</flux:table.column>
            <flux:table.column>Categorías</flux:table.column>
            <flux:table.column>Material</flux:table.column>
            <flux:table.column>Estado</flux:table.column>
            <flux:table.column>Destacado</flux:table.column>
            <flux:table.column align="end">Acciones</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse ($productos as $producto)
                <flux:table.row :key="$producto->id" wire:key="producto-{{ $producto->id }}">
                    <flux:table.cell>
                        @if ($producto->imagen)
                            <img src="{{ Storage::url($producto->imagen) }}"
                                 alt="{{ $producto->nombre }}"
                                 class="w-12 h-12 object-cover rounded" />
                        @else
                            <div class="w-12 h-12 bg-zinc-200 dark:bg-zinc-700 rounded flex items-center justify-center">
                                <flux:icon name="photo" class="w-5 h-5 text-zinc-400" />
                            </div>
                        @endif
                    </flux:table.cell>
                    <flux:table.cell>
                        <div>
                            <span class="font-medium">{{ $producto->nombre }}</span>
                            @if ($producto->subtitulo)
                                <span class="block text-sm text-zinc-500">{{ Str::limit($producto->subtitulo, 40) }}</span>
                            @endif
                        </div>
                    </flux:table.cell>
                    <flux:table.cell>
                        <div class="flex flex-wrap gap-1">
                            @foreach ($producto->categorias as $cat)
                                <flux:badge color="blue" size="sm">{{ $cat->nombre }}</flux:badge>
                            @endforeach
                        </div>
                    </flux:table.cell>
                    <flux:table.cell class="text-zinc-500">{{ $producto->material ?? '—' }}</flux:table.cell>
                    <flux:table.cell>
                        @if ($producto->activo)
                            <flux:badge color="green" size="sm">Activo</flux:badge>
                        @else
                            <flux:badge color="zinc" size="sm">Inactivo</flux:badge>
                        @endif
                    </flux:table.cell>
                    <flux:table.cell>
                        @if ($producto->destacado)
                            <flux:badge color="amber" size="sm">Sí</flux:badge>
                        @else
                            <span class="text-zinc-400">—</span>
                        @endif
                    </flux:table.cell>
                    <flux:table.cell align="end">
                        <div class="flex items-center justify-end gap-2">
                            @can('productos.editar')
                                <flux:button size="sm" variant="ghost" icon="pencil"
                                             :href="route('admin.productos.edit', $producto)" wire:navigate>
                                    Editar
                                </flux:button>
                            @endcan
                            @can('productos.eliminar')
                                <flux:button size="sm" variant="ghost" icon="trash"
                                             wire:click="confirmDelete({{ $producto->id }})"
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
                        No se encontraron productos.
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    {{-- Modal: Confirmar eliminación --}}
    <flux:modal wire:model="showDeleteModal" class="max-w-md w-full">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">¿Eliminar producto?</flux:heading>
                <flux:subheading>Esta acción no se puede deshacer. Se eliminarán también las relaciones con categorías, tamaños y colores.</flux:subheading>
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
