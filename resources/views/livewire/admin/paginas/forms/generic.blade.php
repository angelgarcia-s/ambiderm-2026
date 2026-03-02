{{-- Formulario genérico (fallback) --}}
<flux:heading size="lg">Editor genérico</flux:heading>
<p class="text-sm text-zinc-500 mb-4">No se encontró un formulario específico para esta sección. Edita el JSON directamente.</p>

<flux:textarea wire:model="contenido" label="Contenido JSON" rows="20"
    placeholder='{"clave": "valor"}' />
