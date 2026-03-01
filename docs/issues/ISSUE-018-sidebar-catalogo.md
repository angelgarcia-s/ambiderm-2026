# ISSUE-018 — Actualizar Sidebar con Grupo "Catálogo"

**ADR:** ADR-003
**Tipo:** Frontend
**Prioridad:** Media (depende de ISSUE-012, ISSUE-013)

---

## Descripción

Agregar el grupo "Catálogo" al sidebar del panel admin con los enlaces a Categorías, Productos, Tamaños y Colores, protegidos por `@can`.

---

## Tareas

1. **Editar** `resources/views/layouts/app/sidebar.blade.php`
2. Agregar después del grupo "Administración":

```blade
@canany(['categorias.ver', 'productos.ver'])
    <flux:sidebar.group heading="Catálogo" class="grid">
        @can('categorias.ver')
            <flux:sidebar.item icon="folder"
                              :href="route('admin.categorias.index')"
                              :current="request()->routeIs('admin.categorias.*')"
                              wire:navigate>
                Categorías
            </flux:sidebar.item>
        @endcan
        @can('productos.ver')
            <flux:sidebar.item icon="package"
                              :href="route('admin.productos.index')"
                              :current="request()->routeIs('admin.productos.*')"
                              wire:navigate>
                Productos
            </flux:sidebar.item>
        @endcan
        @can('productos.crear')
            <flux:sidebar.item icon="ruler"
                              :href="route('admin.tamanos.index')"
                              :current="request()->routeIs('admin.tamanos.*')"
                              wire:navigate>
                Tamaños
            </flux:sidebar.item>
            <flux:sidebar.item icon="palette"
                              :href="route('admin.colores.index')"
                              :current="request()->routeIs('admin.colores.*')"
                              wire:navigate>
                Colores
            </flux:sidebar.item>
        @endcan
    </flux:sidebar.group>
@endcanany
```

---

## Criterios de aceptación

- [ ] El sidebar muestra el grupo "Catálogo" con Categorías, Productos, Tamaños y Colores
- [ ] Categorías y Productos se muestran según sus permisos respectivos
- [ ] Tamaños y Colores solo se muestran si el usuario puede crear productos
- [ ] El `current` state se activa correctamente en cada sección
- [ ] El grupo completo se oculta si el usuario no tiene ninguno de los permisos
