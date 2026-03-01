# ISSUE-002 — UsuariosController + Policy

**ADR:** [ADR-001](../adr/ADR-001-roles-y-permisos.md)
**Agente:** Backend
**Branch:** `feature/adr001-roles-y-permisos`
**Depende de:** ISSUE-001 (seeder debe ejecutarse primero)
**Estado:** Pendiente

---

## Descripción

Crear el controlador `UsuariosController` para el CRUD de usuarios en el panel admin, con su `UserPolicy` para control de acceso basado en permisos de Spatie.

---

## Criterios de aceptación

- [ ] Existe `App\Http\Controllers\Admin\UsuariosController`
- [ ] Existe `App\Policies\UserPolicy`
- [ ] `UserPolicy` registrada en `AppServiceProvider` (o via convención automática de Laravel)
- [ ] Las rutas están definidas en `routes/web.php` bajo middleware `auth` y `verified`
- [ ] Las rutas protegen cada acción con el permiso correspondiente via Policy

### Rutas requeridas

| Método | URI | Acción | Permiso |
|--------|-----|--------|---------|
| GET | `/admin/usuarios` | `index` | `usuarios.ver` |
| GET | `/admin/usuarios/crear` | `create` | `usuarios.crear` |
| POST | `/admin/usuarios` | `store` | `usuarios.crear` |
| GET | `/admin/usuarios/{usuario}/editar` | `edit` | `usuarios.editar` |
| PUT | `/admin/usuarios/{usuario}` | `update` | `usuarios.editar` |
| DELETE | `/admin/usuarios/{usuario}` | `destroy` | `usuarios.eliminar` |

### Validaciones en `store` y `update`

| Campo | Reglas |
|-------|--------|
| `name` | required, string, max:255 |
| `email` | required, email, unique:users (ignorar propio en update) |
| `password` | required en create, nullable en update, min:8, confirmed |
| `role` | required, string, exists:roles,name |

---

## Archivos a crear/modificar

| Acción | Archivo |
|--------|---------|
| CREAR | `app/Http/Controllers/Admin/UsuariosController.php` |
| CREAR | `app/Policies/UserPolicy.php` |
| MODIFICAR | `routes/web.php` — agregar rutas admin de usuarios |

---

## Notas de implementación

- El controlador NO renderiza vistas directamente — retorna datos al componente Livewire o responde a requests de Livewire. Evaluar si el CRUD se maneja 100% en Livewire (ver ISSUE-005) — en ese caso este controlador puede ser solo para rutas de display y el Livewire maneja store/update/destroy.
- `UserPolicy` verifica `$user->can('usuarios.ver')` etc. — NO `$user->hasRole()`
- Al crear usuario, asignar el rol seleccionado con `$usuario->syncRoles([$request->role])`
- No enviar email de verificación al crear usuario desde admin (admin crea cuentas internas)
- Hash de password con `bcrypt()` o `Hash::make()`
