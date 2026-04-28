{{-- FOOTER > Sucursales --}}
<flux:heading size="lg">Sucursales / Ubicaciones</flux:heading>

<flux:input wire:model="contenido.titulo" label="Título de la sección" placeholder="UBICACIONES ESTRATÉGICAS" class="mt-4" />

{{-- Items repetibles --}}
<div class="space-y-4 mt-6">
    <div class="flex items-center justify-between">
        <flux:heading size="sm">Sucursales</flux:heading>
        <flux:button size="sm" variant="ghost" icon="plus"
            wire:click="addItem('items', {{ json_encode(['region' => '', 'nombre' => '', 'direccion' => '', 'telefono' => '', 'mapa_url' => '', 'mapa_imagen' => '', 'mapa_key' => '']) }})">
            Agregar sucursal
        </flux:button>
    </div>

    @foreach ($contenido['items'] ?? [] as $i => $item)
        <div class="rounded-lg border border-zinc-200 dark:border-zinc-700 p-4 space-y-4" wire:key="suc-item-{{ $i }}">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-zinc-500">{{ $item['nombre'] ?: 'Sucursal ' . ($i + 1) }}</span>
                <flux:button size="sm" variant="danger" icon="trash"
                    wire:click="removeItem('items', {{ $i }})"
                    wire:confirm="¿Eliminar esta sucursal?">
                    Eliminar
                </flux:button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <flux:input wire:model="contenido.items.{{ $i }}.region" label="Región" placeholder="Matriz" />
                <flux:input wire:model="contenido.items.{{ $i }}.nombre" label="Nombre" placeholder="SAN ISIDRO" />
                <flux:input wire:model="contenido.items.{{ $i }}.mapa_key" label="Clave mapa" placeholder="gdl" />
            </div>
            <flux:textarea wire:model="contenido.items.{{ $i }}.direccion" label="Dirección" rows="2" placeholder="Carr. a Bosques de San Isidro..." />
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <flux:input wire:model="contenido.items.{{ $i }}.telefono" label="Teléfono" placeholder="+52 33 3656 6557" />
                <flux:input wire:model="contenido.items.{{ $i }}.mapa_url" label="URL Google Maps" type="url" placeholder="https://goo.gl/maps/..." />
                <flux:input wire:model="contenido.items.{{ $i }}.mapa_imagen" label="Ruta imagen mapa" type="text" placeholder="/images/gdl.png" />
            </div>
            @if (!empty($contenido['items'][$i]['mapa_imagen']))
                <img src="{{ $contenido['items'][$i]['mapa_imagen'] }}" alt="Mapa preview" class="max-h-24 rounded-lg border border-zinc-200">
            @endif
        </div>
    @endforeach
</div>
