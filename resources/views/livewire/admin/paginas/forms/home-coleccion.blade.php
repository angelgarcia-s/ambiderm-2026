{{-- HOME > La Colección (encabezado) --}}
<flux:heading size="lg">La Colección (Encabezado)</flux:heading>
<p class="text-sm text-zinc-500 mb-4">Los productos del carrusel vienen de la tabla de productos. Aquí solo se edita el título y subtítulo de la sección.</p>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
    <flux:input wire:model="contenido.titulo" label="Título" placeholder="La Colección." />
    <flux:input wire:model="contenido.ver_todos_texto" label="Texto botón 'Ver todos'" placeholder="Ver todos" />
</div>

<flux:input wire:model="contenido.subtitulo" label="Subtítulo" placeholder="Encuentra el ajuste perfecto para ti." />
<flux:input wire:model="contenido.ver_todos_url" label="URL 'Ver todos'" type="url" placeholder="https://ambiderm.com.mx/categoria/guantes" />
