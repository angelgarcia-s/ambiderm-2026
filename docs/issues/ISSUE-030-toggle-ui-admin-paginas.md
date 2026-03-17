# ISSUE-030 — UI: botón toggle Activo/Inactivo en listado de páginas admin

**ADR:** [ADR-004](../adr/ADR-004-toggle-secciones-cms.md)
**Agente:** Frontend
**Prioridad:** 4 de 4
**Rama:** `feature/adr004-toggle-secciones-cms`
**Depende de:** ISSUE-027 (el método `toggleActivo()` debe existir antes de conectar la UI)

---

## Descripción

Reemplazar el badge estático de "Activo/Inactivo" en `livewire/admin/paginas/index.blade.php` por un control interactivo que llame a `wire:click="toggleActivo({{ $seccion->id }})"`. El cambio de estado debe ser visible inmediatamente sin recarga de página.

---

## Archivo a modificar

`resources/views/livewire/admin/paginas/index.blade.php`

---

## Criterios de aceptación

- [ ] El badge Activo/Inactivo es reemplazado por un `<flux:button>` con `wire:click`
- [ ] El botón muestra color verde + texto "Activo" cuando `$seccion->activo = true`
- [ ] El botón muestra color zinc/gris + texto "Inactivo" cuando `$seccion->activo = false`
- [ ] El control solo se muestra con `@can('paginas.editar')` — usuarios sin permiso ven el badge original (read-only)
- [ ] Al hacer click, el componente Livewire se actualiza reactivamente (sin navegación)
- [ ] El botón tiene `wire:loading.attr="disabled"` para evitar doble-click durante el request

---

## Implementación esperada

```blade
{{-- Columna Estado — reemplazar el bloque actual --}}
<flux:table.cell>
    @can('paginas.editar')
        <flux:button
            variant="ghost"
            size="xs"
            wire:click="toggleActivo({{ $seccion->id }})"
            wire:loading.attr="disabled"
            wire:target="toggleActivo({{ $seccion->id }})"
        >
            @if ($seccion->activo)
                <flux:badge size="sm" color="green" inset="top bottom">Activo</flux:badge>
            @else
                <flux:badge size="sm" color="zinc" inset="top bottom">Inactivo</flux:badge>
            @endif
        </flux:button>
    @else
        {{-- Solo lectura para usuarios sin permiso --}}
        @if ($seccion->activo)
            <flux:badge size="sm" color="green" inset="top bottom">Activo</flux:badge>
        @else
            <flux:badge size="sm" color="zinc" inset="top bottom">Inactivo</flux:badge>
        @endif
    @endcan
</flux:table.cell>
```

---

## Notas

- `variant="ghost"` en el botón evita que parezca un botón de acción primaria — el badge interior da el feedback visual
- `wire:target="toggleActivo({{ $seccion->id }})"` + `wire:loading.attr="disabled"` deshabilita solo el botón que está procesando (no todos los de la tabla)
- La columna de encabezado "Estado" no cambia
- No agregar modal de confirmación — el cambio es inmediato y reversible con otro click
