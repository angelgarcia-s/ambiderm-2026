<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">

        {{-- Bienvenida --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <flux:heading size="xl">Bienvenido, {{ auth()->user()->name }}</flux:heading>
                <flux:subheading>
                    {{ now()->isoFormat('dddd D [de] MMMM, YYYY') }}
                    &mdash;
                    <span class="capitalize">{{ auth()->user()->getRoleNames()->first() ?? 'Sin rol' }}</span>
                </flux:subheading>
            </div>
            <flux:button variant="ghost" icon="arrow-top-right-on-square" href="/" target="_blank" size="sm">
                Ver sitio público
            </flux:button>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

            @can('productos.ver')
            <a href="{{ route('admin.productos.index') }}" wire:navigate
               class="group rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 p-6 hover:border-blue-300 dark:hover:border-blue-600 hover:shadow-md transition-all">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center">
                        <flux:icon name="cube" variant="outline" class="size-5 text-blue-600 dark:text-blue-400" />
                    </div>
                    <flux:badge size="sm" color="blue">{{ $stats['productos_activos'] }} activos</flux:badge>
                </div>
                <p class="text-3xl font-bold text-zinc-900 dark:text-white mb-1">{{ $stats['productos_total'] }}</p>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Productos</p>
            </a>
            @endcan

            @can('categorias.ver')
            <a href="{{ route('admin.categorias.index') }}" wire:navigate
               class="group rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 p-6 hover:border-violet-300 dark:hover:border-violet-600 hover:shadow-md transition-all">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 rounded-lg bg-violet-50 dark:bg-violet-900/30 flex items-center justify-center">
                        <flux:icon name="folder" variant="outline" class="size-5 text-violet-600 dark:text-violet-400" />
                    </div>
                </div>
                <p class="text-3xl font-bold text-zinc-900 dark:text-white mb-1">{{ $stats['categorias'] }}</p>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Categorías</p>
            </a>
            @endcan

            @can('paginas.ver')
            <a href="{{ route('admin.paginas.index') }}" wire:navigate
               class="group rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 p-6 hover:border-green-300 dark:hover:border-green-600 hover:shadow-md transition-all">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 rounded-lg bg-green-50 dark:bg-green-900/30 flex items-center justify-center">
                        <flux:icon name="document-text" variant="outline" class="size-5 text-green-600 dark:text-green-400" />
                    </div>
                    <flux:badge size="sm" color="green">{{ $stats['secciones_activas'] }} activas</flux:badge>
                </div>
                <p class="text-3xl font-bold text-zinc-900 dark:text-white mb-1">{{ $stats['secciones_total'] }}</p>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Secciones CMS</p>
            </a>
            @endcan

            @can('usuarios.ver')
            <a href="{{ route('admin.usuarios.index') }}" wire:navigate
               class="group rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 p-6 hover:border-amber-300 dark:hover:border-amber-600 hover:shadow-md transition-all">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 rounded-lg bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center">
                        <flux:icon name="users" variant="outline" class="size-5 text-amber-600 dark:text-amber-400" />
                    </div>
                </div>
                <p class="text-3xl font-bold text-zinc-900 dark:text-white mb-1">{{ $stats['usuarios'] }}</p>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Usuarios</p>
            </a>
            @endcan

        </div>

        {{-- Fila inferior: Accesos rápidos + Actividad reciente --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Accesos rápidos --}}
            <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 p-6 flex flex-col gap-4">
                <flux:heading size="lg">Accesos rápidos</flux:heading>

                <div class="flex flex-col gap-2">

                    @can('productos.crear')
                    <flux:button variant="ghost" icon="plus-circle" :href="route('admin.productos.create')" wire:navigate class="justify-start">
                        Nuevo producto
                    </flux:button>
                    @endcan

                    @can('productos.ver')
                    <flux:button variant="ghost" icon="cube" :href="route('admin.productos.index')" wire:navigate class="justify-start">
                        Ver catálogo
                    </flux:button>
                    @endcan

                    @can('paginas.editar')
                    <flux:button variant="ghost" icon="document-text" :href="route('admin.paginas.index')" wire:navigate class="justify-start">
                        Editar páginas
                    </flux:button>
                    @endcan

                    @can('categorias.ver')
                    <flux:button variant="ghost" icon="folder" :href="route('admin.categorias.index')" wire:navigate class="justify-start">
                        Categorías
                    </flux:button>
                    @endcan

                    @can('usuarios.ver')
                    <flux:button variant="ghost" icon="users" :href="route('admin.usuarios.index')" wire:navigate class="justify-start">
                        Usuarios
                    </flux:button>
                    @endcan

                </div>
            </div>

            {{-- Actividad reciente --}}
            @can('paginas.ver')
            <div class="lg:col-span-2 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 overflow-hidden">
                <div class="px-6 py-4 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                    <flux:heading size="lg">Secciones CMS recientes</flux:heading>
                    <flux:button variant="ghost" size="sm" :href="route('admin.paginas.index')" wire:navigate>Ver todas</flux:button>
                </div>
                <flux:table class="p-4">
                    <flux:table.columns>
                        <flux:table.column>Sección</flux:table.column>
                        <flux:table.column>Página</flux:table.column>
                        <flux:table.column>Estado</flux:table.column>
                        <flux:table.column>Editada</flux:table.column>
                    </flux:table.columns>
                    <flux:table.rows>
                        @foreach ($secciones_recientes as $seccion)
                            <flux:table.row wire:key="dash-sec-{{ $seccion->id }}">
                                <flux:table.cell class="font-medium text-sm">
                                    {{ $seccion->titulo_admin }}
                                </flux:table.cell>
                                <flux:table.cell>
                                    <flux:badge size="sm" color="zinc" inset="top bottom">{{ $seccion->pagina }}</flux:badge>
                                </flux:table.cell>
                                <flux:table.cell>
                                    @if ($seccion->activo)
                                        <flux:badge size="sm" color="green" inset="top bottom">Activo</flux:badge>
                                    @else
                                        <flux:badge size="sm" color="zinc" inset="top bottom">Inactivo</flux:badge>
                                    @endif
                                </flux:table.cell>
                                <flux:table.cell class="text-zinc-400 text-sm">
                                    {{ $seccion->updated_at->diffForHumans() }}
                                </flux:table.cell>
                            </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </flux:table>
            </div>
            @endcan

        </div>

    </div>
</x-layouts::app>
