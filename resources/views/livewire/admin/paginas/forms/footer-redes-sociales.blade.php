{{-- FOOTER > Redes Sociales --}}
<flux:heading size="lg">Redes Sociales y Logo</flux:heading>

<flux:input wire:model="contenido.titulo" label="Título" placeholder="SÍGUENOS EN REDES SOCIALES" class="mt-4" />

<div>
    <flux:input wire:model="contenido.logo" label="URL logo" type="url" placeholder="https://...logo-ambiderm-azul.svg" />
    @if (!empty($contenido['logo']))
        <img src="{{ $contenido['logo'] }}" alt="Logo preview" class="max-h-12 mt-2">
    @endif
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="space-y-3">
        <flux:heading size="sm">Instagram</flux:heading>
        <flux:input wire:model="contenido.instagram_url" label="URL perfil" type="url" placeholder="https://www.instagram.com/ambiderm/" />
        <flux:input wire:model="contenido.instagram_icono" label="URL icono" type="url" placeholder="https://...instagram-icon.png" />
    </div>
    <div class="space-y-3">
        <flux:heading size="sm">Facebook</flux:heading>
        <flux:input wire:model="contenido.facebook_url" label="URL perfil" type="url" placeholder="https://www.facebook.com/Ambiderm/" />
        <flux:input wire:model="contenido.facebook_icono" label="URL icono" type="url" placeholder="https://...facebook-icon.png" />
    </div>
</div>
