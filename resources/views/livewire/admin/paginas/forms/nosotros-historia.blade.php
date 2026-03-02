{{-- NOSOTROS > Historia --}}
<flux:heading size="lg">Nuestra Historia</flux:heading>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
    <flux:input wire:model="contenido.titulo" label="Título" placeholder="Orgullosamente Mexicanos" />
    <flux:input wire:model="contenido.anio" label="Año" placeholder="1988" />
</div>

<flux:input wire:model="contenido.anio_etiqueta" label="Etiqueta del año" placeholder="Fundación en México" />

<div>
    <flux:input wire:model="contenido.imagen" label="URL imagen historia" type="url" placeholder="https://..." />
    @if (!empty($contenido['imagen']))
        <img src="{{ $contenido['imagen'] }}" alt="Preview" class="max-h-32 rounded-lg border border-zinc-200 mt-2">
    @endif
</div>

<div>
    <flux:heading size="sm" class="mb-2">Contenido (HTML permitido)</flux:heading>
    <flux:textarea wire:model="contenido.parrafos" label="Párrafos (HTML)" rows="8"
        placeholder="<p><strong>Ambiderm se fundó en 1988</strong>...</p>" />
    <p class="text-xs text-zinc-500 mt-1">Puedes usar etiquetas HTML como &lt;p&gt;, &lt;strong&gt;, &lt;br&gt;.</p>
</div>
