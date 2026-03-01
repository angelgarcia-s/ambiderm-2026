<div class="space-y-6">

    {{-- Encabezado --}}
    <div>
        <flux:heading size="xl">Permisos del sistema</flux:heading>
        <flux:subheading>Listado de permisos disponibles, agrupados por módulo.</flux:subheading>
    </div>

    {{-- Nota informativa --}}
    <flux:callout variant="info" icon="information-circle">
        Los permisos del sistema se definen en el seeder. Para agregar nuevos permisos,
        actualiza <code class="text-xs font-mono bg-zinc-100 dark:bg-zinc-800 px-1 rounded">RolesAndPermissionsSeeder</code>
        y vuelve a ejecutarlo.
    </flux:callout>

    {{-- Tarjetas por módulo --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($permissionsByModule as $modulo => $permisos)
            <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 p-5 space-y-3">
                <flux:heading size="sm" class="uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                    {{ ucfirst($modulo) }}
                </flux:heading>

                <div class="flex flex-wrap gap-2">
                    @foreach ($permisos as $permiso)
                        <flux:badge color="zinc" size="sm">{{ $permiso }}</flux:badge>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center text-zinc-500 py-12">
                No hay permisos registrados. Ejecuta el seeder <code class="text-xs font-mono">RolesAndPermissionsSeeder</code>.
            </div>
        @endforelse
    </div>

</div>
