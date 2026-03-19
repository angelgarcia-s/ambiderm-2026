<div class="space-y-6">

    {{-- Encabezado + botón crear --}}
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl">Tamaños</flux:heading>
            <flux:subheading>Catálogo de tamaños disponibles para productos.</flux:subheading>
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
                <flux:button variant="primary" wire:click="create" icon="plus">
                    Nuevo tamaño
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
    <flux:table :paginate="$tamanos">
        <flux:table.columns>
            <flux:table.column>Icono/Abrev.</flux:table.column>
            <flux:table.column>Nombre</flux:table.column>
            <flux:table.column>Abreviatura</flux:table.column>
            <flux:table.column>Productos</flux:table.column>
            <flux:table.column>Orden</flux:table.column>
            <flux:table.column align="end">Acciones</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse ($tamanos as $tamano)
                <flux:table.row :key="$tamano->id" wire:key="tamano-{{ $tamano->id }}">
                    <flux:table.cell>
                        @if ($tamano->icono)
                            <img src="{{ Storage::url($tamano->icono) }}"
                                 alt="{{ $tamano->nombre }}"
                                 class="w-8 h-8 object-contain" />
                        @elseif ($tamano->abreviatura)
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded bg-zinc-200 dark:bg-zinc-700 text-xs font-bold">
                                {{ $tamano->abreviatura }}
                            </span>
                        @else
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded bg-zinc-100 dark:bg-zinc-800 text-xs text-zinc-400">
                                —
                            </span>
                        @endif
                    </flux:table.cell>
                    <flux:table.cell class="font-medium">{{ $tamano->nombre }}</flux:table.cell>
                    <flux:table.cell class="text-zinc-500">{{ $tamano->abreviatura ?? '—' }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:badge color="zinc" size="sm">{{ $tamano->productos_count }}</flux:badge>
                    </flux:table.cell>
                    <flux:table.cell>{{ $tamano->orden }}</flux:table.cell>
                    <flux:table.cell align="end">
                        <div class="flex items-center justify-end gap-2">
                            @can('productos.editar')
                                <flux:button size="sm" variant="ghost" icon="pencil"
                                             wire:click="edit({{ $tamano->id }})">
                                    Editar
                                </flux:button>
                            @endcan
                            @can('productos.eliminar')
                                <flux:button size="sm" variant="ghost" icon="trash"
                                             wire:click="confirmDelete({{ $tamano->id }})"
                                             class="text-red-600 hover:text-red-700">
                                    Eliminar
                                </flux:button>
                            @endcan
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="6" class="text-center text-zinc-500 py-8">
                        No hay tamaños registrados.
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    {{-- Modal: Crear/Editar tamaño --}}
    <flux:modal wire:model="showModal" class="max-w-md w-full" :dismissible="false">
        <form wire:submit="save" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $isEditing ? 'Editar tamaño' : 'Nuevo tamaño' }}</flux:heading>
                <flux:subheading>{{ $isEditing ? 'Modifica los datos del tamaño.' : 'Completa los datos para crear un tamaño.' }}</flux:subheading>
            </div>

            <flux:input wire:model="nombre" label="Nombre" type="text"
                        placeholder="Ej. Chico, Mediano, Grande" required autofocus />

            <flux:input wire:model="abreviatura" label="Abreviatura" type="text"
                        placeholder="Ej. CH, M, G" />

            <div>
                <flux:label>Icono (opcional)</flux:label>
                @if ($iconoActual && !$icono)
                    <div class="mt-2 flex items-center gap-3">
                        <img src="{{ Storage::url($iconoActual) }}" class="w-12 h-12 object-contain" alt="Icono actual" />
                        <span class="text-sm text-zinc-500">Icono actual</span>
                    </div>
                @endif
                <input type="file" wire:model="icono" accept="image/*"
                       class="mt-2 block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200 dark:file:bg-zinc-700 dark:file:text-zinc-300" />
                @error('icono') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                @if ($icono)
                    <img src="{{ $icono->temporaryUrl() }}" class="mt-2 w-12 h-12 object-contain" alt="Preview" />
                @endif
            </div>

            <flux:input wire:model="orden" label="Orden" type="number" min="0" />

            <div class="flex justify-end gap-3">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>
                <flux:button variant="primary" type="submit">
                    {{ $isEditing ? 'Guardar cambios' : 'Crear tamaño' }}
                </flux:button>
            </div>
        </form>
    </flux:modal>

    {{-- Modal: Confirmar eliminación --}}
    <flux:modal wire:model="showDeleteModal" class="max-w-md w-full" :dismissible="false">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">¿Eliminar tamaño?</flux:heading>
                <flux:subheading>Esta acción no se puede deshacer. Solo se puede eliminar si no está asignado a productos.</flux:subheading>
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

    {{-- Modal: Importar--}}
    <flux:modal wire:model="showImportModal" class="max-w-lg w-full" :dismissible="false">
        <form wire:submit="procesarImportacion" class="space-y-6">
            <div>
                <flux:heading size="lg">Importar tamaños</flux:heading>
                <flux:subheading>Solo se crearán registros nuevos. Los que ya existan (mismo nombre) <strong>no serán modificados</strong>. Columnas requeridas: <code>nombre, abreviatura, orden</code>.</flux:subheading>
            </div>

            <div class="flex items-center gap-3 p-4 rounded-lg bg-zinc-50 dark:bg-zinc-800">
                <flux:icon.table-cells class="size-5 text-zinc-400 shrink-0" />
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Plantilla de ejemplo</p>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Columnas: nombre, abreviatura, orden</p>
                </div>
                <flux:button wire:click="descargarTemplate" size="sm" variant="ghost" icon="arrow-down-tray">
                    Descargar .xlsx
                </flux:button>
            </div>

            <div>
                <flux:label>Archivo</flux:label>
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
