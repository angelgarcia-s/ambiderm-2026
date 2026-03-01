# ISSUE-017 — Livewire: CRUD de Productos en Admin

**ADR:** ADR-003
**Tipo:** Frontend
**Prioridad:** Alta (depende de ISSUE-010, ISSUE-013, ISSUE-015, ISSUE-016)
**Contract:** [Producto.md](../contracts/Producto.md)

---

## Descripción

Implementar los componentes Livewire para la gestión completa de productos en el panel de administración. El formulario de crear/editar es complejo — se usa página dedicada (no modal).

---

## Tareas

1. **Componente Livewire — Index** `App\Livewire\Admin\Productos\Index`
   - Listado con tabla Flux: imagen (thumb), nombre, categorías (badges), material, estado, destacado, acciones
   - Filtro por categoría (select)
   - Buscador por nombre
   - Link a crear/editar (páginas separadas)
   - Confirmación para eliminar

2. **Componente Livewire — Form** `App\Livewire\Admin\Productos\Form`
   - Formulario en secciones:
     - **Info básica**: nombre, slug (auto), subtitulo, material, descripcion (textarea)
     - **Categorías**: checkboxes/select múltiple de categorías activas (mínimo 1 requerida)
     - **Multimedia**: imagen (upload + preview), url_tienda, url_ficha_tecnica
     - **Tamaños**: checkboxes del catálogo de tamaños
     - **Colores**: checkboxes del catálogo de colores + upload de imagen por cada color seleccionado
     - **Especificaciones**: caracteristicas (repeater de inputs), etiquetas (repeater de inputs)
     - **Presentación**: presentacion (textarea), certificaciones (textarea)
     - **Visibilidad**: activo (toggle), destacado (toggle), orden (input)
   - Modo: crear o editar (según si recibe `$productoId`)
   - Al guardar: `sync()` para categorías, tamaños y colores (con imagen pivot)

3. **Vistas Blade**
   - `resources/views/livewire/admin/productos/index.blade.php`
   - `resources/views/livewire/admin/productos/form.blade.php`
   - Wrappers: `resources/views/admin/productos/index.blade.php`, `create.blade.php`, `edit.blade.php`

---

## Criterios de aceptación

- [ ] El listado muestra productos con imagen, nombre, categorías (badges) y estado
- [ ] Se puede filtrar por categoría y buscar por nombre
- [ ] El formulario permite crear un producto con todos los campos del Contract
- [ ] Se puede asignar múltiples categorías (mínimo 1 requerida)
- [ ] Se puede asignar tamaños del catálogo vía checkboxes
- [ ] Se puede asignar colores del catálogo vía checkboxes + subir imagen por color
- [ ] Los repeaters (caracteristicas, etiquetas) permiten agregar/eliminar items
- [ ] La imagen principal se puede subir y previsualizar
- [ ] El slug se genera automáticamente al escribir el nombre
- [ ] Se puede eliminar un producto con confirmación
- [ ] Los botones de acción respetan los permisos del usuario (`@can`)
