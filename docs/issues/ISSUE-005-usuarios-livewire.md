# ISSUE-005 — Livewire: Gestión de Usuarios

**ADR:** [ADR-001](../adr/ADR-001-roles-y-permisos.md)
**Agente:** Frontend
**Branch:** `feature/adr001-roles-y-permisos`
**Depende de:** ISSUE-002 (backend usuarios)
**Estado:** Completado

---

## Descripción

Crear el componente Livewire + vistas Blade para el CRUD completo de usuarios en el panel admin. Incluye listado con búsqueda, modal de creación, modal de edición y confirmación de eliminación.

---

## Criterios de aceptación

- [ ] Ruta `/admin/usuarios` muestra el listado de usuarios con su rol asignado
- [ ] El listado tiene búsqueda en tiempo real (por nombre o email) via Livewire
- [ ] Existe un modal (Flux) para crear usuario: campos name, email, password, password_confirmation, role (select)
- [ ] Existe un modal (Flux) para editar usuario: mismos campos, password opcional
- [ ] Existe confirmación de eliminación (modal Flux o `flux:modal.confirmation`)
- [ ] Las acciones (botones crear/editar/eliminar) solo se muestran si el usuario tiene el permiso correspondiente (`@can`)
- [ ] Los errores de validación se muestran inline en los campos del formulario
- [ ] Feedback visual al guardar/eliminar (toast o mensaje inline)

---

## Archivos a crear

| Archivo | Descripción |
|---------|-------------|
| `app/Livewire/Admin/Usuarios/Index.php` | Componente Livewire principal |
| `resources/views/livewire/admin/usuarios/index.blade.php` | Vista del listado |
| `resources/views/admin/usuarios/index.blade.php` | Layout blade que embebe el componente |

---

## Especificación del componente Livewire

### Propiedades
```php
public string $search = '';
public bool $showCreateModal = false;
public bool $showEditModal = false;
public ?int $editingUserId = null;

// Campos del formulario
public string $name = '';
public string $email = '';
public string $password = '';
public string $password_confirmation = '';
public string $role = '';
```

### Métodos
```
render()       → retorna usuarios paginados filtrados por $search + colección de roles disponibles
create()       → abre modal de creación
store()        → valida y crea usuario, asigna rol, cierra modal
edit($id)      → carga datos del usuario, abre modal de edición
update()       → valida y actualiza usuario, cierra modal
confirmDelete($id) → abre confirmación
delete()       → elimina usuario
```

---

## UI / Diseño

- Usar componentes `<flux:*>` para tabla, modales, inputs, botones, select
- Columnas de la tabla: Nombre | Email | Rol | Fecha creación | Acciones
- El selector de rol en los modales es un `<flux:select>` con los roles disponibles
- Paginación con Livewire pagination (Flux styled)
- Layout padre: `<x-layouts.app>` (panel admin)

---

## Notas

- La búsqueda filtra por `name` y `email` con `LIKE %search%`
- Al crear usuario, el password es obligatorio. Al editar, solo se actualiza si se provee uno nuevo.
- Mostrar el nombre del rol con `ucfirst(str_replace('_', ' ', $role))` para UI más limpia (ej: "Super Admin")
