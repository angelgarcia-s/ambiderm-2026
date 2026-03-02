{{-- NOSOTROS > Valores --}}
<flux:heading size="lg">Nuestros Valores</flux:heading>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
    <flux:input wire:model="contenido.badge" label="Badge" placeholder="Nuestros Valores" />
    <flux:input wire:model="contenido.titulo" label="Título" placeholder="Compromiso Total" />
    <flux:input wire:model="contenido.subtitulo" label="Subtítulo" placeholder="Nos regimos por estándares..." />
</div>

{{-- Items repetibles --}}
<div class="space-y-4 mt-6">
    <div class="flex items-center justify-between">
        <flux:heading size="sm">Tarjetas de valor</flux:heading>
        <flux:button size="sm" variant="ghost" icon="plus"
            wire:click="addItem('items', {{ json_encode(['icono' => '', 'titulo' => '', 'texto' => '', 'color_bg' => 'bg-blue-100', 'color_text' => 'text-blue-600']) }})">
            Agregar valor
        </flux:button>
    </div>

    @foreach ($contenido['items'] ?? [] as $i => $item)
        <div class="rounded-lg border border-zinc-200 dark:border-zinc-700 p-4 space-y-4" wire:key="val-item-{{ $i }}">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-zinc-500">Valor {{ $i + 1 }}</span>
                <flux:button size="sm" variant="danger" icon="trash"
                    wire:click="removeItem('items', {{ $i }})"
                    wire:confirm="¿Eliminar este valor?">
                    Eliminar
                </flux:button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input wire:model="contenido.items.{{ $i }}.icono" label="Icono Lucide" placeholder="leaf" />
                <flux:input wire:model="contenido.items.{{ $i }}.titulo" label="Título" placeholder="Eco-Friendly" />
            </div>
            <flux:textarea wire:model="contenido.items.{{ $i }}.texto" label="Texto" rows="2" placeholder="Descripción del valor..." />
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input wire:model="contenido.items.{{ $i }}.color_bg" label="Clase CSS fondo" placeholder="bg-green-100" />
                <flux:input wire:model="contenido.items.{{ $i }}.color_text" label="Clase CSS texto" placeholder="text-green-600" />
            </div>
        </div>
    @endforeach
</div>
