{{-- HOME > Video Feature --}}
<flux:heading size="lg">Producto Destacado (Video)</flux:heading>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
    <flux:input wire:model="contenido.badge" label="Badge" placeholder="NUEVO" />
    <flux:input wire:model="contenido.nombre_producto" label="Nombre del producto" placeholder="Vynil Synmax" />
</div>

<flux:textarea wire:model="contenido.descripcion" label="Descripción" rows="3"
    placeholder="Siente la revolución en protección clínica..." />

{{-- Upload de video --}}
<div>
    <flux:label>Video (MP4 / WebM / MOV)</flux:label>

    @if (!empty($contenido['video_url']))
        <div class="mt-2 space-y-1">
            <video controls class="w-full max-w-lg rounded-lg border border-zinc-200 dark:border-zinc-700" style="max-height:220px;">
                <source src="{{ $contenido['video_url'] }}" type="video/mp4" />
            </video>
            <p class="text-xs text-zinc-500">Video actual — sube uno nuevo para reemplazarlo.</p>
        </div>
    @endif

    <input type="file" wire:model="videoFeatureFile" accept="video/mp4,video/webm,video/quicktime"
           class="mt-2 block w-full text-sm text-zinc-500
                  file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                  file:text-sm file:font-semibold file:bg-zinc-100 file:text-zinc-700
                  hover:file:bg-zinc-200 dark:file:bg-zinc-700 dark:file:text-zinc-300" />

    <div wire:loading wire:target="videoFeatureFile" class="mt-1 text-xs text-blue-500">
        Subiendo video...
    </div>

    @error('videoFeatureFile')
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror

    <p class="mt-1 text-xs text-zinc-400">Formatos aceptados: MP4, WebM, MOV. Máximo 100&nbsp;MB.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <flux:input wire:model="contenido.cta_texto" label="Texto del botón CTA" placeholder="Comprar ahora" />
    <flux:input wire:model="contenido.cta_url" label="URL del CTA" placeholder="/productos" />
</div>
