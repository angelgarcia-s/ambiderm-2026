{{-- HOME > YouTube Video --}}
<flux:heading size="lg">Video YouTube</flux:heading>

<flux:input wire:model="contenido.video_id" label="ID del video de YouTube" placeholder="DkVU_4Mir6Y" class="mt-4" />

<p class="text-sm text-zinc-500 mt-2">Solo el ID del video, no la URL completa. Ejemplo: para <code>https://youtube.com/watch?v=DkVU_4Mir6Y</code> el ID es <code>DkVU_4Mir6Y</code></p>

@if (!empty($contenido['video_id']))
    <div class="mt-4">
        <p class="text-xs text-zinc-500 mb-2">Vista previa:</p>
        <div class="aspect-video max-w-lg rounded-lg overflow-hidden border border-zinc-200">
            <iframe class="w-full h-full"
                src="https://www.youtube.com/embed/{{ $contenido['video_id'] }}"
                frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
@endif
