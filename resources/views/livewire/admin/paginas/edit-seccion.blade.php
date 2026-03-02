<div class="space-y-8">

    {{-- Encabezado --}}
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl">{{ $seccionContenido->titulo_admin }}</flux:heading>
            <flux:subheading>Página: {{ ucfirst($seccionContenido->pagina) }} · Sección: {{ $seccionContenido->seccion }}</flux:subheading>
        </div>
        <flux:button variant="ghost" icon="arrow-left" :href="route('admin.paginas.index')" wire:navigate>
            Volver a páginas
        </flux:button>
    </div>

    {{-- Mensajes --}}
    @if (session('success'))
        <flux:callout variant="success" icon="check-circle">{{ session('success') }}</flux:callout>
    @endif

    @if ($errors->any())
        <flux:callout variant="danger" icon="x-circle">
            <p>Corrige los errores antes de guardar.</p>
        </flux:callout>
    @endif

    {{-- Formulario dinámico por sección --}}
    <form wire:submit="save" class="space-y-6">
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 p-6 space-y-6">
            @include('livewire.admin.paginas.forms.' . $this->formPartial)
        </div>

        {{-- Acciones --}}
        <div class="flex items-center justify-end gap-3">
            <flux:button variant="ghost" :href="route('admin.paginas.index')" wire:navigate>
                Cancelar
            </flux:button>
            <flux:button type="submit" variant="primary">
                Guardar cambios
            </flux:button>
        </div>
    </form>

</div>
