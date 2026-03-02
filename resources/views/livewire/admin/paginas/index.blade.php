<div class="space-y-6">

    {{-- Encabezado --}}
    <div>
        <flux:heading size="xl">Páginas Públicas</flux:heading>
        <flux:subheading>Edita el contenido de las páginas del sitio web.</flux:subheading>
    </div>

    {{-- Secciones agrupadas por página --}}
    @foreach ($this->paginas as $pagina => $meta)
        @if (isset($secciones[$pagina]))
            <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                {{-- Cabecera del grupo --}}
                <div class="bg-zinc-50 dark:bg-zinc-800 px-6 py-4 flex items-center gap-3 border-b border-zinc-200 dark:border-zinc-700">
                    <flux:icon :name="$meta['icono']" variant="outline" class="size-5 text-zinc-500" />
                    <flux:heading size="lg">{{ $meta['nombre'] }}</flux:heading>
                    <flux:badge size="sm" color="zinc" class="ml-auto">{{ $secciones[$pagina]->count() }} secciones</flux:badge>
                </div>

                {{-- Tabla de secciones --}}
                <flux:table class="p-4">
                    <flux:table.columns>
                        <flux:table.column>Sección</flux:table.column>
                        <flux:table.column>Identificador</flux:table.column>
                        <flux:table.column>Estado</flux:table.column>
                        <flux:table.column>Última edición</flux:table.column>
                        <flux:table.column align="end">Acciones</flux:table.column>
                    </flux:table.columns>

                    <flux:table.rows>
                        @foreach ($secciones[$pagina] as $seccion)
                            <flux:table.row wire:key="seccion-{{ $seccion->id }}">
                                <flux:table.cell class="font-medium">
                                    {{ $seccion->titulo_admin }}
                                </flux:table.cell>
                                <flux:table.cell>
                                    <flux:badge size="sm" color="zinc" inset="top bottom">{{ $seccion->seccion }}</flux:badge>
                                </flux:table.cell>
                                <flux:table.cell>
                                    @if ($seccion->activo)
                                        <flux:badge size="sm" color="green" inset="top bottom">Activo</flux:badge>
                                    @else
                                        <flux:badge size="sm" color="zinc" inset="top bottom">Inactivo</flux:badge>
                                    @endif
                                </flux:table.cell>
                                <flux:table.cell class="text-zinc-500 text-sm">
                                    {{ $seccion->updated_at->diffForHumans() }}
                                </flux:table.cell>
                                <flux:table.cell align="end">
                                    @can('paginas.editar')
                                        <flux:button variant="ghost" size="sm" icon="pencil-square"
                                            :href="route('admin.paginas.edit', [$seccion->pagina, $seccion->seccion])"
                                            wire:navigate>
                                            Editar
                                        </flux:button>
                                    @endcan
                                </flux:table.cell>
                            </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </flux:table>
            </div>
        @endif
    @endforeach

</div>
