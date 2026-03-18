{{-- FOOTER > Contacto --}}
<flux:heading size="lg">Contacto y Distribuidor</flux:heading>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
    <flux:input wire:model="contenido.badge" label="Badge" placeholder="Mantenlo cerca" />
    <flux:input wire:model="contenido.titulo" label="Título" placeholder="¿TIENES ALGUNA DUDA?" />
</div>

<flux:textarea wire:model="contenido.subtitulo" label="Subtítulo" rows="2"
    placeholder="Déjanos un mensaje y un especialista se pondrá en contacto contigo..." />

<flux:input wire:model="contenido.email" label="Email de contacto" type="email" placeholder="info@ambiderm.com.mx" />

<div class="rounded-lg border border-zinc-200 dark:border-zinc-700 p-4 space-y-4 mt-4">
    <flux:heading size="sm">Sección Distribuidor</flux:heading>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <flux:input wire:model="contenido.distribuidor_titulo" label="Título" placeholder="QUIERO SER DISTRIBUIDOR" />
        <flux:input wire:model="contenido.distribuidor_subtitulo" label="Subtítulo" placeholder="Únete a la red Ambiderm" />
    </div>
    <flux:input wire:model="contenido.distribuidor_url" label="URL formulario distribuidor" type="url" placeholder="https://share.hsforms.com/..." />
    <flux:input wire:model="contenido.distribuidor_icono" label="URL icono distribuidor" type="url" placeholder="https://...distribuidor-icon.svg" />
</div>


