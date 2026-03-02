{{-- HOME > Eco-Friendly --}}
<flux:heading size="lg">Eco-Friendly</flux:heading>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
    <flux:input wire:model="contenido.badge" label="Badge" placeholder="Responsabilidad Ambiental" />
    <flux:input wire:model="contenido.titulo" label="Título" placeholder="100% LÁTEX NATURAL" />
</div>

<flux:textarea wire:model="contenido.parrafo_principal" label="Párrafo principal" rows="3"
    placeholder="Gracias a su composición de origen natural..." />

<flux:textarea wire:model="contenido.parrafo_secundario" label="Párrafo secundario" rows="3"
    placeholder="Nuestros guantes están fabricados con látex natural..." />

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <flux:input wire:model="contenido.imagen" label="URL imagen producto" type="url" placeholder="https://..." />
        @if (!empty($contenido['imagen']))
            <img src="{{ $contenido['imagen'] }}" alt="Preview" class="max-h-32 rounded-lg border border-zinc-200 mt-2">
        @endif
    </div>
    <div>
        <flux:input wire:model="contenido.icono" label="URL icono eco" type="url" placeholder="https://..." />
        @if (!empty($contenido['icono']))
            <img src="{{ $contenido['icono'] }}" alt="Preview" class="max-h-16 rounded-lg border border-zinc-200 mt-2">
        @endif
    </div>
</div>
