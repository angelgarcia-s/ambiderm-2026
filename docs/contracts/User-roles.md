# Contract — User (Roles y Permisos)

**Versión:** 1.0
**ADR:** [ADR-001](../adr/ADR-001-roles-y-permisos.md)
**Última actualización:** 2026-03-01

---

## Modelo

`App\Models\User`

---

## Traits requeridos

```php
use Spatie\Permission\Traits\HasRoles; // ✅ ya implementado
```

---

## Reglas del modelo

- Un usuario tiene **exactamente un rol** activo (aunque Spatie soporta múltiples, el sistema Ambiderm asigna uno).
- La asignación de roles se hace con `$user->assignRole($roleName)`.
- La verificación de permisos se hace mediante `$user->can('permiso.accion')` o `$user->hasPermissionTo('permiso.accion')`.
- **No** usar `$user->hasRole('super_admin')` para controlar acceso en Policies — usar permisos granulares.

---

## Campos obligatorios (tabla `users`)

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | unsignedBigInteger | PK |
| `name` | string | Nombre completo |
| `email` | string | Email único |
| `password` | string | Hash |
| `email_verified_at` | timestamp nullable | Fortify |
| `remember_token` | string nullable | Auth |
| `created_at` / `updated_at` | timestamps | — |

> No agregar campos adicionales al modelo sin un ADR que lo justifique.

---

## Relaciones con Spatie

Las tablas `roles`, `permissions`, `model_has_roles`, `model_has_permissions`, `role_has_permissions` son gestionadas exclusivamente por Spatie. No crear relaciones Eloquent manuales hacia estas tablas.

---

## Guard

Todos los roles y permisos de este sistema usan el guard `web`.
