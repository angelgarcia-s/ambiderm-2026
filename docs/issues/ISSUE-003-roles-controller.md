# ISSUE-003 — RolesController + Policy

**ADR:** [ADR-001](../adr/ADR-001-roles-y-permisos.md)
**Agente:** Backend
**Branch:** `feature/adr001-roles-y-permisos`
**Depende de:** ISSUE-001
**Estado:** Pendiente

---

## Descripción

Crear el controlador `RolesController` para el CRUD de roles en el panel admin. Incluye la capacidad de asignar/remover permisos a un rol desde la vista de edición. Crear `RolePolicy` para control de acceso.

---

## Criterios de aceptación

- [ ] Existe `App\Http\Controllers\Admin\RolesController`
- [ ] Existe `App\Policies\RolePolicy`
- [ ] Las rutas están definidas bajo middleware `auth` y `verified`
- [ ] Se puede crear, editar y eliminar un rol
- [ ] Al editar un rol se puede modificar qué permisos tiene (via `syncPermissions()`)
- [ ] No se puede eliminar el rol `super_admin`

### Rutas requeridas

| Método | URI | Acción | Permiso |
|--------|-----|--------|---------|
| GET | `/admin/roles` | `index` | `roles.ver` |
| GET | `/admin/roles/crear` | `create` | `roles.crear` |
| POST | `/admin/roles` | `store` | `roles.crear` |
| GET | `/admin/roles/{rol}/editar` | `edit` | `roles.editar` |
| PUT | `/admin/roles/{rol}` | `update` | `roles.editar` |
| DELETE | `/admin/roles/{rol}` | `destroy` | `roles.eliminar` |

### Validaciones en `store` y `update`

| Campo | Reglas |
|-------|--------|
| `name` | required, string, max:100, unique:roles (ignorar propio en update) |
| `permissions` | nullable, array |
| `permissions.*` | exists:permissions,name |

---

## Archivos a crear/modificar

| Acción | Archivo |
|--------|---------|
| CREAR | `app/Http/Controllers/Admin/RolesController.php` |
| CREAR | `app/Policies/RolePolicy.php` |
| MODIFICAR | `routes/web.php` — agregar rutas admin de roles |

---

## Notas de implementación

- En `edit()`, pasar al view: el rol con sus permisos actuales + todos los permisos disponibles agrupados por módulo (para los checkboxes del frontend)
- En `update()`, usar `$role->syncPermissions($request->permissions ?? [])`
- En `destroy()`: verificar `$role->name !== 'super_admin'` — abortar con 403 si se intenta eliminar
- El nombre del rol no debe tener espacios — validar con `regex:/^[a-z_]+$/`
- `RolePolicy` verifica permisos `roles.*` del usuario autenticado
