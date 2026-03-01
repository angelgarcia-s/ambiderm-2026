# ISSUE-015 — Livewire: CRUD de Categorías en Admin

**ADR:** ADR-003
**Tipo:** Frontend
**Prioridad:** Alta (depende de ISSUE-008, ISSUE-012)
**Contract:** [Categoria.md](../contracts/Categoria.md)

---

## Descripción

Implementar el componente Livewire para la gestión completa de categorías en el panel de administración, siguiendo el patrón existente de Usuarios/Roles (Flux UI).

---

## Tareas

1. **Componente Livewire** `App\Livewire\Admin\Categorias\Index`
   - Listado con tabla Flux: nombre, slug, productos count, estado, orden, acciones
   - Modal para crear categoría
   - Modal para editar categoría
   - Confirmación para eliminar (solo si no tiene productos)
   - Upload de imagen con preview
   - Toggle para `activo`
   - Input numérico para `orden`
   - Auto-generación de slug desde `nombre` (con debounce)

2. **Vista Blade** `resources/views/livewire/admin/categorias/index.blade.php`
   - Usar componentes Flux (`<flux:table>`, `<flux:modal>`, `<flux:input>`, etc.)
   - Guards con `@can` para botones de crear/editar/eliminar

3. **Vista wrapper** `resources/views/admin/categorias/index.blade.php`
   ```blade
   <x-layouts::app title="Categorías">
       <livewire:admin.categorias.index />
   </x-layouts::app>
   ```

---

## Criterios de aceptación

- [ ] El listado muestra todas las categorías con conteo de productos
- [ ] Se puede crear una categoría con nombre, descripcion, imagen, activo y orden
- [ ] Se puede editar todos los campos de una categoría existente
- [ ] Se puede eliminar una categoría sin productos (muestra error si tiene productos)
- [ ] El slug se genera automáticamente al escribir el nombre
- [ ] La imagen se puede subir y previsualizar
- [ ] Los botones de acción respetan los permisos del usuario
