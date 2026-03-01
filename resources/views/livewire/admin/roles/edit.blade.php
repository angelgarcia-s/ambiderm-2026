<div class="space-y-8">

    {{-- Encabezado --}}
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl">Editar rol: {{ ucfirst(str_replace('_', ' ', $role->name)) }}</flux:heading>
            <flux:subheading>Selecciona los permisos que tendrá este rol.</flux:subheading>
        </div>

        <flux:button variant="ghost" icon="arrow-left" :href="route('admin.roles.index')" wire:navigate>
            Volver a roles
        </flux:button>
    </div>

    {{-- Grid de permisos agrupados por módulo --}}
    <div class="space-y-6">
        @foreach ($allPermissions as $modulo => $permisos)
            <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 p-5 space-y-4">
                <flux:heading size="sm" class="uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                    {{ ucfirst($modulo) }}
                </flux:heading>

                <div class="flex flex-wrap gap-4">
                    @foreach ($permisos as $permiso)
                        <label class="flex items-center gap-2 cursor-pointer">
                            <flux:checkbox
                                wire:model="selectedPermissions"
                                value="{{ $permiso }}"
                            />
                            <span class="text-sm text-zinc-700 dark:text-zinc-300">{{ $permiso }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    {{-- Acciones --}}
    <div class="flex items-center justify-end gap-3">
        <flux:button variant="ghost" :href="route('admin.roles.index')" wire:navigate>
            Cancelar
        </flux:button>
        <flux:button variant="primary" wire:click="save">
            Guardar cambios
        </flux:button>
    </div>

</div>
