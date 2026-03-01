# ISSUE-016 — Livewire: CRUD de Tamaños y Colores en Admin

**ADR:** ADR-003
**Tipo:** Frontend
**Prioridad:** Alta (depende de ISSUE-009, ISSUE-013)
**Contracts:** [Tamano.md](../contracts/Tamano.md), [Color.md](../contracts/Color.md)

---

## Descripción

Implementar los componentes Livewire para la gestión de los catálogos auxiliares de Tamaños y Colores. Son CRUDs simples con modal, sin permisos propios (se gestionan bajo `productos.*`).

---

## Tareas

### Tamaños

1. **Componente Livewire** `App\Livewire\Admin\Tamanos\Index`
   - Listado con tabla Flux: nombre, abreviatura, orden, productos count, acciones
   - Modal para crear/editar tamaño
   - Confirmación para eliminar (solo si no está asignado a productos)
   - Campos: nombre, abreviatura, icono (upload con preview), orden
   - Si tiene icono se muestra en el listado; si no, se muestra la abreviatura

2. **Vista Blade** `resources/views/livewire/admin/tamanos/index.blade.php`
3. **Vista wrapper** `resources/views/admin/tamanos/index.blade.php`

### Colores

4. **Componente Livewire** `App\Livewire\Admin\Colores\Index`
   - Listado con tabla Flux: muestra de color (círculo con hex), nombre, hex, orden, productos count, acciones
   - Modal para crear/editar color
   - Color picker o input para `hex`
   - Confirmación para eliminar (solo si no está asignado a productos)
   - Campos: nombre, hex, icono (upload con preview), orden
   - Si tiene icono se muestra en el listado; si no, se muestra el círculo hex

5. **Vista Blade** `resources/views/livewire/admin/colores/index.blade.php`
6. **Vista wrapper** `resources/views/admin/colores/index.blade.php`

---

## Criterios de aceptación

### Tamaños
- [ ] El listado muestra tamaños con conteo de productos asignados
- [ ] Se puede crear un tamaño con nombre, abreviatura, icono (opcional) y orden
- [ ] Si el tamaño tiene icono, se muestra el icono; si no, la abreviatura; si tampoco, el nombre
- [ ] Se puede editar un tamaño existente
- [ ] Se puede eliminar un tamaño sin productos (muestra error si tiene productos)
- [ ] El nombre es único (validación)

### Colores
- [ ] El listado muestra colores con muestra visual (círculo hex) y conteo de productos
- [ ] Se puede crear un color con nombre, hex, icono (opcional) y orden
- [ ] Si el color tiene icono, se muestra el icono; si no, el círculo hex
- [ ] Se puede editar un color existente
- [ ] Se puede eliminar un color sin productos (muestra error si tiene productos)
- [ ] El nombre es único y el hex es válido (#RRGGBB)
