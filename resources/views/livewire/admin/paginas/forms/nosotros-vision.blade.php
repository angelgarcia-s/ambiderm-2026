{{-- NOSOTROS > Visión --}}
<flux:heading size="lg">Visión</flux:heading>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
    <flux:input wire:model="contenido.titulo" label="Título" placeholder="Visión" />
    <flux:input wire:model="contenido.icono" label="Icono Lucide" placeholder="eye" />
</div>
<p class="text-xs text-zinc-500">Nombre del icono Lucide (ej: target, eye, leaf). Ver <a href="https://lucide.dev/icons" target="_blank" class="underline">lucide.dev/icons</a></p>

<flux:textarea wire:model="contenido.texto" label="Texto (HTML permitido)" rows="5"
    placeholder="Ser la marca líder en guantes desechables..." />
<p class="text-xs text-zinc-500 mt-1">Puedes usar &lt;strong&gt; para negritas con clase de color.</p>
