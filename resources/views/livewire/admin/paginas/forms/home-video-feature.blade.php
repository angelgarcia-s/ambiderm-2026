{{-- HOME > Video Feature --}}
<flux:heading size="lg">Producto Destacado (Video)</flux:heading>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
    <flux:input wire:model="contenido.badge" label="Badge" placeholder="NUEVO" />
    <flux:input wire:model="contenido.nombre_producto" label="Nombre del producto" placeholder="Vynil Synmax" />
</div>

<flux:textarea wire:model="contenido.descripcion" label="Descripción" rows="3"
    placeholder="Siente la revolución en protección clínica..." />

<flux:input wire:model="contenido.video_url" label="URL del video (MP4)" type="url"
    placeholder="https://...vynil.mp4" />

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <flux:input wire:model="contenido.cta_texto" label="Texto del botón CTA" placeholder="Comprar ahora" />
    <flux:input wire:model="contenido.cta_url" label="URL del CTA" placeholder="/productos" />
</div>
