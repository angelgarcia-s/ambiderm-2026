<div class="space-y-6">

    {{-- Encabezado --}}
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl">Productos</flux:heading>
            <flux:subheading>Gestión de productos del catálogo.</flux:subheading>
        </div>

        <div class="flex items-center gap-2">
            @can('catalogos.exportar')
                <flux:button variant="ghost" wire:click="exportar" icon="arrow-down-tray">
                    Exportar
                </flux:button>
            @endcan
            @can('catalogos.importar')
                <flux:button variant="ghost" wire:click="abrirImport" icon="arrow-up-tray">
                    Importar
                </flux:button>
            @endcan
            @can('productos.crear')
                <flux:button variant="primary" :href="route('admin.productos.create')" icon="plus" wire:navigate>
                    Nuevo producto
                </flux:button>
            @endcan
        </div>
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
            <flux:table.column>Orden</flux:table.column>
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
                            <span class="font-medium">{{ $producto->orden }}</span>
                        </div>
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
                        @can('productos.editar')
                            <flux:button
                                variant="ghost"
                                size="xs"
                                wire:click="toggleActivo({{ $producto->id }})"
                                wire:loading.attr="disabled"
                                wire:target="toggleActivo({{ $producto->id }})">
                                @if ($producto->activo)
                                    <flux:badge color="green" size="sm" inset="top bottom">Activo</flux:badge>
                                @else
                                    <flux:badge color="zinc" size="sm" inset="top bottom">Inactivo</flux:badge>
                                @endif
                            </flux:button>
                        @else
                            @if ($producto->activo)
                                <flux:badge color="green" size="sm">Activo</flux:badge>
                            @else
                                <flux:badge color="zinc" size="sm">Inactivo</flux:badge>
                            @endif
                        @endcan
                    </flux:table.cell>
                    <flux:table.cell>
                        @can('productos.editar')
                            <flux:button
                                variant="ghost"
                                size="xs"
                                wire:click="toggleDestacado({{ $producto->id }})"
                                wire:loading.attr="disabled"
                                wire:target="toggleDestacado({{ $producto->id }})">
                                @if ($producto->destacado)
                                    <flux:badge color="amber" size="sm" inset="top bottom">Sí</flux:badge>
                                @else
                                    <flux:badge color="zinc" size="sm" inset="top bottom">No</flux:badge>
                                @endif
                            </flux:button>
                        @else
                            @if ($producto->destacado)
                                <flux:badge color="amber" size="sm">Sí</flux:badge>
                            @else
                                <flux:badge color="zinc" size="sm">No</flux:badge>
                            @endif
                        @endcan
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
    <flux:modal wire:model="showDeleteModal" class="max-w-md w-full" :dismissible="false">
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

    {{-- Modal: Importar CSV --}}
    <flux:modal wire:model="showImportModal" class="max-w-lg w-full" :dismissible="false">
        <form wire:submit="procesarImportacion" class="space-y-6">
            <div>
                <flux:heading size="lg">Importar productos desde CSV</flux:heading>
                <flux:subheading>Solo se crearán registros nuevos. Los que ya existan (mismo nombre) <strong>no serán modificados</strong>. El slug se genera automáticamente. La columna <code>categorias</code> acepta slugs separados por <code>|</code>.</flux:subheading>
            </div>

            <div class="flex items-center gap-3 p-4 rounded-lg bg-zinc-50 dark:bg-zinc-800">
                <flux:icon.table-cells class="size-5 text-zinc-400 shrink-0" />
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Plantilla de ejemplo</p>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Columnas: nombre, subtitulo, descripcion, material, url_tienda, url_ficha_tecnica, categorias, tamanos, colores, caracteristicas, etiquetas, presentacion, certificaciones, activo, destacado, orden</p>
                </div>
                <flux:button wire:click="descargarTemplate" size="sm" variant="ghost" icon="arrow-down-tray">
                    Descargar .xlsx
                </flux:button>
            </div>

            <div>
                <flux:label>Archivo CSV</flux:label>
                <input type="file" wire:model="archivoCsv" accept=".xlsx,.csv,text/csv"
                       class="mt-1 block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200 dark:file:bg-zinc-700 dark:file:text-zinc-300" />
                @error('archivoCsv') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            @if (!empty($importErrors))
                <div class="rounded-lg border border-red-200 bg-red-50 dark:bg-red-900/20 dark:border-red-800 p-4 space-y-1">
                    <p class="text-sm font-semibold text-red-700 dark:text-red-400">{{ count($importErrors) }} error(es) encontrado(s):</p>
                    <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-300 max-h-40 overflow-y-auto">
                        @foreach ($importErrors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (!empty($importWarnings))
                <div class="rounded-lg border border-amber-200 bg-amber-50 dark:bg-amber-900/20 dark:border-amber-700 p-4 space-y-1">
                    <p class="text-sm font-semibold text-amber-700 dark:text-amber-400">{{ count($importWarnings) }} registro(s) omitido(s) por ya existir:</p>
                    <ul class="list-disc list-inside text-sm text-amber-700 dark:text-amber-300 max-h-40 overflow-y-auto">
                        @foreach ($importWarnings as $warning)
                            <li>{{ $warning }}</li>
                        @endforeach
                    </ul>
                </div>
                @if ($importCount > 0)
                    <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $importCount }} {{ $importCount === 1 ? 'registro nuevo creado correctamente' : 'registros nuevos creados correctamente' }}.</p>
                @endif
            @endif

            <div class="flex justify-end gap-3">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>
                <flux:button variant="primary" type="submit" icon="arrow-up-tray">
                    Importar
                </flux:button>
            </div>
        </form>
    </flux:modal>

</div>
