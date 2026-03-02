{{-- HOME > Hero --}}
<flux:heading size="lg">Hero — Página de Inicio</flux:heading>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
    <flux:input wire:model="contenido.titulo" label="Título" placeholder="Ambiderm" />
    <flux:input wire:model="contenido.imagen_alt" label="Alt de imagen" placeholder="Ambiderm Collection" />
</div>

<flux:textarea wire:model="contenido.subtitulo" label="Subtítulo" rows="2"
    placeholder="Siente la diferencia. Seguridad clínica con tacto natural." />

<flux:input wire:model="contenido.imagen" label="URL de imagen hero" type="url"
    placeholder="https://..." />

@if (!empty($contenido['imagen']))
    <div class="mt-2">
        <p class="text-xs text-zinc-500 mb-2">Vista previa:</p>
        <img src="{{ $contenido['imagen'] }}" alt="Preview" class="max-h-48 rounded-lg border border-zinc-200">
    </div>
@endif
