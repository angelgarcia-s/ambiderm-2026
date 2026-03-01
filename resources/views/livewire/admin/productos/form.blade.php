<div class="space-y-8">

    {{-- Encabezado --}}
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl">{{ $productoId ? 'Editar producto' : 'Nuevo producto' }}</flux:heading>
            <flux:subheading>{{ $productoId ? 'Modifica los datos del producto.' : 'Completa los datos para crear un producto.' }}</flux:subheading>
        </div>

        <flux:button variant="ghost" :href="route('admin.productos.index')" icon="arrow-left" wire:navigate>
            Volver al listado
        </flux:button>
    </div>

    <form wire:submit="save" class="space-y-8">

        {{-- ═══════════════════════════════════════════ --}}
        {{-- SECCIÓN: Información básica --}}
        {{-- ═══════════════════════════════════════════ --}}
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 p-6 space-y-4">
            <flux:heading size="lg">Información básica</flux:heading>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input wire:model.live.debounce.300ms="nombre" label="Nombre" type="text"
                            placeholder="Ej. Guante de Látex Ambiderm" required />

                <flux:input wire:model="slug" label="Slug" type="text"
                            placeholder="Se genera automáticamente" required />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input wire:model="subtitulo" label="Subtítulo" type="text"
                            placeholder="Ej. Alta sensibilidad y resistencia" />

                <flux:input wire:model="material" label="Material" type="text"
                            placeholder="Ej. Látex, Vinilo, Nitrilo" />
            </div>

            <flux:textarea wire:model="descripcion" label="Descripción" rows="4"
                           placeholder="Descripción detallada del producto" />
        </div>

        {{-- ═══════════════════════════════════════════ --}}
        {{-- SECCIÓN: Categorías --}}
        {{-- ═══════════════════════════════════════════ --}}
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 p-6 space-y-4">
            <flux:heading size="lg">Categorías</flux:heading>
            <flux:subheading>Selecciona al menos una categoría.</flux:subheading>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                @foreach ($todasCategorias as $cat)
                    <label class="flex items-center gap-2 cursor-pointer p-2 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition">
                        <input type="checkbox" value="{{ $cat->id }}"
                               wire:model="categoriasSeleccionadas"
                               class="rounded border-zinc-300 dark:border-zinc-600 text-blue-600 focus:ring-blue-500" />
                        <span class="text-sm">{{ $cat->nombre }}</span>
                    </label>
                @endforeach
            </div>
            @error('categoriasSeleccionadas') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- ═══════════════════════════════════════════ --}}
        {{-- SECCIÓN: Multimedia --}}
        {{-- ═══════════════════════════════════════════ --}}
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 p-6 space-y-4">
            <flux:heading size="lg">Multimedia y enlaces</flux:heading>

            <div>
                <flux:label>Imagen principal</flux:label>
                @if ($imagenActual && !$imagen)
                    <div class="mt-2 flex items-center gap-3">
                        <img src="{{ Storage::url($imagenActual) }}" class="w-32 h-32 object-cover rounded-lg" alt="Imagen actual" />
                        <span class="text-sm text-zinc-500">Imagen actual</span>
                    </div>
                @endif
                <input type="file" wire:model="imagen" accept="image/*"
                       class="mt-2 block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200 dark:file:bg-zinc-700 dark:file:text-zinc-300" />
                @error('imagen') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                @if ($imagen)
                    <img src="{{ $imagen->temporaryUrl() }}" class="mt-2 w-32 h-32 object-cover rounded-lg" alt="Preview" />
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input wire:model="url_tienda" label="URL Tienda en línea" type="url"
                            placeholder="https://tienda.ambiderm.com/..." />

                <flux:input wire:model="url_ficha_tecnica" label="URL Ficha técnica" type="url"
                            placeholder="https://ambiderm.com/fichas/..." />
            </div>
        </div>

        {{-- ═══════════════════════════════════════════ --}}
        {{-- SECCIÓN: Tamaños --}}
        {{-- ═══════════════════════════════════════════ --}}
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 p-6 space-y-4">
            <flux:heading size="lg">Tamaños disponibles</flux:heading>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                @foreach ($todosTamanos as $tamano)
                    <label class="flex items-center gap-2 cursor-pointer p-2 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition">
                        <input type="checkbox" value="{{ $tamano->id }}"
                               wire:model="tamanosSeleccionados"
                               class="rounded border-zinc-300 dark:border-zinc-600 text-blue-600 focus:ring-blue-500" />
                        <span class="text-sm flex items-center gap-1">
                            @if ($tamano->icono)
                                <img src="{{ Storage::url($tamano->icono) }}" class="w-5 h-5 object-contain" />
                            @elseif ($tamano->abreviatura)
                                <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-zinc-200 dark:bg-zinc-700 text-[10px] font-bold">{{ $tamano->abreviatura }}</span>
                            @endif
                            {{ $tamano->nombre }}
                        </span>
                    </label>
                @endforeach
            </div>
        </div>

        {{-- ═══════════════════════════════════════════ --}}
        {{-- SECCIÓN: Colores --}}
        {{-- ═══════════════════════════════════════════ --}}
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 p-6 space-y-4">
            <flux:heading size="lg">Colores disponibles</flux:heading>
            <flux:subheading>Selecciona los colores y opcionalmente sube una imagen por cada variante de color.</flux:subheading>

            <div class="space-y-4">
                @foreach ($todosColores as $color)
                    <div class="flex items-start gap-3 p-3 rounded-lg border border-zinc-100 dark:border-zinc-800">
                        <label class="flex items-center gap-2 cursor-pointer min-w-[160px]">
                            <input type="checkbox" value="{{ $color->id }}"
                                   wire:model.live="coloresSeleccionados"
                                   class="rounded border-zinc-300 dark:border-zinc-600 text-blue-600 focus:ring-blue-500" />
                            <span class="flex items-center gap-2 text-sm">
                                @if ($color->icono)
                                    <img src="{{ Storage::url($color->icono) }}" class="w-5 h-5 object-contain" />
                                @elseif ($color->hex)
                                    <span class="inline-block w-5 h-5 rounded-full border border-zinc-300"
                                          style="background-color: {{ $color->hex }}"></span>
                                @endif
                                {{ $color->nombre }}
                            </span>
                        </label>

                        @if (in_array($color->id, $this->coloresSeleccionados))
                            <div class="flex-1">
                                @if (isset($imagenesPorColorActuales[$color->id]) && !isset($imagenesPorColor[$color->id]))
                                    <div class="flex items-center gap-2 mb-1">
                                        <img src="{{ Storage::url($imagenesPorColorActuales[$color->id]) }}"
                                             class="w-10 h-10 object-cover rounded" alt="Imagen color" />
                                        <span class="text-xs text-zinc-500">Imagen actual</span>
                                    </div>
                                @endif
                                <input type="file" wire:model="imagenesPorColor.{{ $color->id }}" accept="image/*"
                                       class="block w-full text-xs text-zinc-500 file:mr-2 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-zinc-100 file:text-zinc-600 dark:file:bg-zinc-700 dark:file:text-zinc-300" />
                                @if (isset($imagenesPorColor[$color->id]) && $imagenesPorColor[$color->id])
                                    <img src="{{ $imagenesPorColor[$color->id]->temporaryUrl() }}"
                                         class="mt-1 w-10 h-10 object-cover rounded" alt="Preview" />
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ═══════════════════════════════════════════ --}}
        {{-- SECCIÓN: Especificaciones (repeaters) --}}
        {{-- ═══════════════════════════════════════════ --}}
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 p-6 space-y-6">
            <flux:heading size="lg">Especificaciones</flux:heading>

            {{-- Características --}}
            <div class="space-y-3">
                <flux:label>Características</flux:label>
                @foreach ($caracteristicas as $index => $item)
                    <div class="flex items-center gap-2" wire:key="caract-{{ $index }}">
                        <flux:input wire:model="caracteristicas.{{ $index }}" type="text"
                                    placeholder="Ej. Ambidiestro, Libre de polvo" class="flex-1" />
                        @if (count($caracteristicas) > 1)
                            <flux:button size="sm" variant="ghost" icon="x-mark"
                                         wire:click="removeCaracteristica({{ $index }})"
                                         class="text-red-500 shrink-0" />
                        @endif
                    </div>
                @endforeach
                <flux:button size="sm" variant="ghost" icon="plus" wire:click="addCaracteristica">
                    Agregar característica
                </flux:button>
            </div>

            {{-- Etiquetas --}}
            <div class="space-y-3">
                <flux:label>Etiquetas</flux:label>
                @foreach ($etiquetas as $index => $item)
                    <div class="flex items-center gap-2" wire:key="etiq-{{ $index }}">
                        <flux:input wire:model="etiquetas.{{ $index }}" type="text"
                                    placeholder="Ej. Uso médico, Desechable" class="flex-1" />
                        @if (count($etiquetas) > 1)
                            <flux:button size="sm" variant="ghost" icon="x-mark"
                                         wire:click="removeEtiqueta({{ $index }})"
                                         class="text-red-500 shrink-0" />
                        @endif
                    </div>
                @endforeach
                <flux:button size="sm" variant="ghost" icon="plus" wire:click="addEtiqueta">
                    Agregar etiqueta
                </flux:button>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════ --}}
        {{-- SECCIÓN: Presentación y certificaciones --}}
        {{-- ═══════════════════════════════════════════ --}}
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 p-6 space-y-4">
            <flux:heading size="lg">Presentación y certificaciones</flux:heading>

            <flux:textarea wire:model="presentacion" label="Presentación" rows="3"
                           placeholder="Información sobre presentación del producto (caja, paquete, etc.)" />

            <flux:textarea wire:model="certificaciones" label="Certificaciones" rows="3"
                           placeholder="Certificaciones y estándares que cumple el producto" />
        </div>

        {{-- ═══════════════════════════════════════════ --}}
        {{-- SECCIÓN: Visibilidad --}}
        {{-- ═══════════════════════════════════════════ --}}
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 p-6 space-y-4">
            <flux:heading size="lg">Visibilidad</flux:heading>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                <flux:input wire:model="orden" label="Orden" type="number" min="0" />

                <div class="flex items-center gap-6 py-2">
                    <flux:switch wire:model="activo" label="Activo" />
                    <flux:switch wire:model="destacado" label="Destacado" />
                </div>
            </div>
        </div>

        {{-- Botón guardar --}}
        <div class="flex justify-end gap-3">
            <flux:button variant="ghost" :href="route('admin.productos.index')" wire:navigate>
                Cancelar
            </flux:button>
            <flux:button variant="primary" type="submit">
                {{ $productoId ? 'Guardar cambios' : 'Crear producto' }}
            </flux:button>
        </div>

    </form>

</div>
