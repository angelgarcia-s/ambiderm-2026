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
                <flux:input wire:model="contenido.items.{{ $i }}.imagen" label="URL imagen" type="url" placeholder="https://..." />
                <flux:input wire:model="contenido.items.{{ $i }}.url" label="URL destino" type="url" placeholder="https://..." />
            </div>
            @if (!empty($contenido['items'][$i]['imagen']))
                <img src="{{ $contenido['items'][$i]['imagen'] }}" alt="Preview" class="max-h-24 rounded-lg border border-zinc-200">
            @endif
        </div>
    @endforeach
</div>
