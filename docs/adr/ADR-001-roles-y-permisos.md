# ADR-001 — Sistema de Roles y Permisos

**Estado:** Aprobado
**Fecha:** 2026-03-01
**Autor:** Agent.Orchestrator
**Branch:** `feature/adr001-roles-y-permisos`

---

## Contexto

El proyecto Ambiderm 2026 requiere un panel de administración para personal interno exclusivamente. Spatie `laravel-permission` v7 ya está instalado y el modelo `User` ya tiene el trait `HasRoles`. Es necesario formalizar qué roles existen, cómo se estructuran los permisos, y qué vistas del panel admin gestionan usuarios, roles y permisos.

---

## Decisión

### Roles

| Rol | Descripción |
|-----|-------------|
| `super_admin` | Acceso total. Recibe TODOS los permisos automáticamente. |
| `admin` | Gestión operativa: usuarios, roles, productos y dashboard. |
| `editor` | Gestión de contenido: productos (ver y editar) y dashboard. |

> Solo personal interno. No existen roles para clientes externos.

---

### Estructura de Permisos

Los permisos siguen la convención `modulo.accion` y se definen **únicamente en el seeder** — no son modificables desde la UI.

```
Módulo         | Permisos
-------------- | ------------------------------------------------
dashboard      | dashboard.ver
usuarios       | usuarios.ver, usuarios.crear, usuarios.editar, usuarios.eliminar
roles          | roles.ver, roles.crear, roles.editar, roles.eliminar
permisos       | permisos.ver
productos      | productos.ver, productos.crear, productos.editar, productos.eliminar
```

> Los permisos de módulos futuros (ej: `productos`) se agregan al array del seeder cuando se implemente el módulo correspondiente.

---

### Asignación de permisos por rol

| Permiso | super_admin | admin | editor |
|---------|:-----------:|:-----:|:------:|
| `dashboard.ver` | ✅ | ✅ | ✅ |
| `usuarios.ver` | ✅ | ✅ | ❌ |
| `usuarios.crear` | ✅ | ✅ | ❌ |
| `usuarios.editar` | ✅ | ✅ | ❌ |
| `usuarios.eliminar` | ✅ | ✅ | ❌ |
| `roles.ver` | ✅ | ✅ | ❌ |
| `roles.crear` | ✅ | ✅ | ❌ |
| `roles.editar` | ✅ | ✅ | ❌ |
| `roles.eliminar` | ✅ | ✅ | ❌ |
| `permisos.ver` | ✅ | ✅ | ❌ |
| `productos.ver` | ✅ | ✅ | ✅ |
| `productos.crear` | ✅ | ✅ | ❌ |
| `productos.editar` | ✅ | ✅ | ✅ |
| `productos.eliminar` | ✅ | ✅ | ❌ |

---

### RolesAndPermissionsSeeder — Estructura

El seeder implementa tres métodos privados:

```
seedPermissions()      → Crea/sincroniza todos los permisos del array
assignAllToSuperAdmin() → Asigna todos los permisos existentes a super_admin
assignPermissions()     → Asigna permisos específicos a admin y editor
```

> Estrategia: `Permission::firstOrCreate()` — el seeder es **idempotente** (puede ejecutarse múltiples veces sin duplicar).

---

### Panel Admin — Módulos de este ADR

| Módulo | Tipo | Ruta |
|--------|------|------|
| Usuarios | CRUD completo (Livewire) | `/admin/usuarios` |
| Roles | CRUD completo + asignación de permisos (Livewire) | `/admin/roles` |
| Permisos | Solo listado (Livewire) | `/admin/permisos` |

---

## Issues

### Backend

| Issue | Descripción |
|-------|-------------|
| [ISSUE-001](../issues/ISSUE-001-roles-permissions-seeder.md) | `RolesAndPermissionsSeeder` — definir permisos, roles y asignaciones |
| [ISSUE-002](../issues/ISSUE-002-usuarios-controller.md) | `UsuariosController` + Policy — CRUD de usuarios con roles |
| [ISSUE-003](../issues/ISSUE-003-roles-controller.md) | `RolesController` + Policy — CRUD de roles + asignar/remover permisos |
| [ISSUE-004](../issues/ISSUE-004-permisos-controller.md) | `PermisosController` + Policy — solo listado de permisos |

### Frontend

| Issue | Descripción |
|-------|-------------|
| [ISSUE-005](../issues/ISSUE-005-usuarios-livewire.md) | Livewire: listado, crear, editar, eliminar usuarios |
| [ISSUE-006](../issues/ISSUE-006-roles-livewire.md) | Livewire: listado, crear, editar roles + checkbox de permisos |
| [ISSUE-007](../issues/ISSUE-007-permisos-livewire.md) | Livewire: listado de permisos (read-only, agrupado por módulo) |

---

## Consecuencias

- Los permisos no se pueden crear/eliminar desde la UI — solo desde el seeder. Esto garantiza consistencia total entre entornos.
- Para agregar un nuevo módulo, se agrega su grupo de permisos al array del seeder y se re-ejecuta.
- `super_admin` siempre tiene todos los permisos vía `assignAllToSuperAdmin()` — no requiere listado manual.
- Las Policies verifican permisos de Spatie, no roles directamente (más granular y flexible).

---

## Decisiones descartadas

| Alternativa | Razón de descarte |
|-------------|-------------------|
| Gestionar permisos desde UI | Riesgo de inconsistencia entre entornos, complejidad innecesaria para el alcance actual |
| Usar `Gate::before()` para super_admin | No es necesario si el seeder asigna todos los permisos explícitamente |
