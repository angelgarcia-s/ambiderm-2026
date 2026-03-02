{{-- FOOTER > Copyright --}}
<flux:heading size="lg">Copyright y Links Legales</flux:heading>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
    <flux:input wire:model="contenido.texto" label="Texto copyright" placeholder="COPYRIGHT © 2026 AMBIDERM S.A. DE C.V." />
    <flux:input wire:model="contenido.subtexto" label="Subtexto" placeholder="TODOS LOS DERECHOS RESERVADOS" />
</div>

{{-- Links repetibles --}}
<div class="space-y-4 mt-6">
    <div class="flex items-center justify-between">
        <flux:heading size="sm">Links del footer</flux:heading>
        <flux:button size="sm" variant="ghost" icon="plus" wire:click="addLink">
            Agregar link
        </flux:button>
    </div>

    @foreach ($contenido['links'] ?? [] as $i => $link)
        <div class="flex items-end gap-4" wire:key="link-{{ $i }}">
            <div class="flex-1">
                <flux:input wire:model="contenido.links.{{ $i }}.texto" label="Texto" placeholder="Términos" />
            </div>
            <div class="flex-1">
                <flux:input wire:model="contenido.links.{{ $i }}.url" label="URL" placeholder="#" />
            </div>
            <flux:button size="sm" variant="danger" icon="trash"
                wire:click="removeLink({{ $i }})"
                wire:confirm="¿Eliminar este link?">
            </flux:button>
        </div>
    @endforeach
</div>
