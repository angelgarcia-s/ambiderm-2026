{{-- HOME > Soluciones Médicas --}}
<flux:heading size="lg">Soluciones Médicas</flux:heading>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
    <flux:input wire:model="contenido.titulo" label="Título" placeholder="Soluciones médicas" />
    <flux:input wire:model="contenido.subtitulo" label="Subtítulo" placeholder="Protección especializada para cada sector." />
</div>

{{-- Items repetibles --}}
<div class="space-y-4 mt-6">
    <div class="flex items-center justify-between">
        <flux:heading size="sm">Tarjetas de solución</flux:heading>
        <flux:button size="sm" variant="ghost" icon="plus"
            wire:click="addItem('items', {{ json_encode(['etiqueta' => '', 'titulo' => '', 'imagen' => '', 'url' => '']) }})">
            Agregar tarjeta
        </flux:button>
    </div>

    @foreach ($contenido['items'] ?? [] as $i => $item)
        <div class="rounded-lg border border-zinc-200 dark:border-zinc-700 p-4 space-y-4" wire:key="sol-item-{{ $i }}">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-zinc-500">Tarjeta {{ $i + 1 }}</span>
                <flux:button size="sm" variant="danger" icon="trash"
                    wire:click="removeItem('items', {{ $i }})"
                    wire:confirm="¿Eliminar esta tarjeta?">
                    Eliminar
                </flux:button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input wire:model="contenido.items.{{ $i }}.etiqueta" label="Etiqueta" placeholder="Especialidad" />
                <flux:input wire:model="contenido.items.{{ $i }}.titulo" label="Título" placeholder="Dental" />
                <flux:input wire:model="contenido.items.{{ $i }}.url" label="Ruta destino" type="text" placeholder="/productos?categoria=guantes" />
                <div class="col-span-1">
                    <flux:label>Imagen</flux:label>
                    @if (!empty($contenido['items'][$i]['imagen']) && empty($imagenesItems[$i]))
                        <div class="flex items-center gap-3 mb-2">
                            <img src="{{ $contenido['items'][$i]['imagen'] }}" alt="Imagen actual"
                                class="w-20 h-20 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700">
                            <span class="text-sm text-zinc-500">Imagen actual</span>
                        </div>
                    @endif
                    <input type="file" wire:model="imagenesItems.{{ $i }}" accept="image/*"
                        class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200 cursor-pointer dark:file:bg-zinc-700 dark:file:text-zinc-300">
                    @error("imagenesItems.{$i}") <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    @if (isset($imagenesItems[$i]) && $imagenesItems[$i])
                        <img src="{{ $imagenesItems[$i]->temporaryUrl() }}" alt="Preview"
                            class="mt-2 w-20 h-20 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700">
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
