# ISSUE-006 — Livewire: Gestión de Roles

**ADR:** [ADR-001](../adr/ADR-001-roles-y-permisos.md)
**Agente:** Frontend
**Branch:** `feature/adr001-roles-y-permisos`
**Depende de:** ISSUE-003 (backend roles)
**Estado:** Completado

---

## Descripción

Crear el componente Livewire + vistas Blade para el CRUD de roles. La vista de edición incluye checkboxes para asignar/remover permisos al rol, agrupados por módulo.

---

## Criterios de aceptación

- [ ] Ruta `/admin/roles` muestra listado de roles con cantidad de permisos y usuarios asignados
- [ ] Existe modal (Flux) para crear rol: solo campo `name`
- [ ] Existe vista de edición de rol (página dedicada, no modal) con checkboxes de permisos agrupados por módulo
- [ ] Los checkboxes muestran los permisos actuales del rol correctamente pre-seleccionados
- [ ] Al guardar edición, se llama `syncPermissions()` vía backend
- [ ] El rol `super_admin` no muestra botón eliminar
- [ ] Las acciones respetan directivas `@can`
- [ ] Feedback visual al guardar

---

## Archivos a crear

| Archivo | Descripción |
|---------|-------------|
| `app/Livewire/Admin/Roles/Index.php` | Componente listado |
| `app/Livewire/Admin/Roles/Edit.php` | Componente edición con permisos |
| `resources/views/livewire/admin/roles/index.blade.php` | Vista listado |
| `resources/views/livewire/admin/roles/edit.blade.php` | Vista edición |
| `resources/views/admin/roles/index.blade.php` | Layout blade listado |
| `resources/views/admin/roles/edit.blade.php` | Layout blade edición |

---

## Especificación del componente Edit

### Propiedades
```php
public Role $role;
public array $selectedPermissions = []; // nombres de permisos seleccionados
public array $allPermissions = [];      // todos los permisos agrupados por módulo
```

### Métodos
```
mount(Role $role) → carga el rol, sus permisos actuales y todos los permisos agrupados
save()            → llama $role->syncPermissions($this->selectedPermissions), feedback, redirect
```

---

## UI / Diseño

### Listado (`/admin/roles`)
- Columnas: Nombre | Permisos asignados (count) | Usuarios con este rol (count) | Acciones
- Botones: Editar (→ `/admin/roles/{rol}/editar`), Eliminar (modal confirmación)

### Edición (`/admin/roles/{rol}/editar`)
- Título: "Editar rol: {nombre}"
- Grid de checkboxes agrupados por módulo:
  ```
  [Módulo: Dashboard]
    ☑ dashboard.ver

  [Módulo: Usuarios]
    ☑ usuarios.ver  ☑ usuarios.crear  ☑ usuarios.editar  ☑ usuarios.eliminar

  [Módulo: Productos]
    ☐ productos.ver  ☐ productos.crear  ...
  ```
- Botón "Guardar cambios" con `<flux:button>`
- Botón "Cancelar" → vuelve al listado

---

## Notas

- La edición de permisos es una página dedicada (no modal) porque la cantidad de checkboxes lo justifica
- `super_admin` no debería necesitar editar permisos (los tiene todos), pero la UI lo permite — el seeder se encargará de restaurarlos si se re-ejecuta
- Mostrar nombre del módulo capitalizado: `ucfirst($modulo)`
