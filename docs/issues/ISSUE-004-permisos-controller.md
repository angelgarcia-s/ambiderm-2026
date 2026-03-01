# ISSUE-004 — PermisosController + Policy

**ADR:** [ADR-001](../adr/ADR-001-roles-y-permisos.md)
**Agente:** Backend
**Branch:** `feature/adr001-roles-y-permisos`
**Depende de:** ISSUE-001
**Estado:** Pendiente

---

## Descripción

Crear el controlador `PermisosController` para el panel admin. Este módulo es **solo listado** — los permisos no se pueden crear, editar ni eliminar desde la UI, únicamente desde el seeder.

---

## Criterios de aceptación

- [ ] Existe `App\Http\Controllers\Admin\PermisosController`
- [ ] Solo existe la acción `index` — no hay create/store/edit/update/destroy
- [ ] `index()` retorna todos los permisos agrupados por módulo
- [ ] La ruta está protegida con el permiso `permisos.ver`
- [ ] La agrupación por módulo se obtiene del prefijo antes del punto (`dashboard`, `usuarios`, etc.)

### Rutas requeridas

| Método | URI | Acción | Permiso |
|--------|-----|--------|---------|
| GET | `/admin/permisos` | `index` | `permisos.ver` |

### Agrupación esperada

```php
// Resultado esperado para la vista:
[
    'dashboard'  => ['dashboard.ver'],
    'usuarios'   => ['usuarios.ver', 'usuarios.crear', 'usuarios.editar', 'usuarios.eliminar'],
    'roles'      => ['roles.ver', 'roles.crear', 'roles.editar', 'roles.eliminar'],
    'permisos'   => ['permisos.ver'],
    'productos'  => ['productos.ver', 'productos.crear', 'productos.editar', 'productos.eliminar'],
]
```

---

## Archivos a crear/modificar

| Acción | Archivo |
|--------|---------|
| CREAR | `app/Http/Controllers/Admin/PermisosController.php` |
| MODIFICAR | `routes/web.php` — agregar ruta admin de permisos |

---

## Notas de implementación

- No crear `PermisionPolicy` separada — usar middleware de ruta con `can:permisos.ver` directamente
- La agrupación se puede hacer con `Permission::all()->groupBy(fn($p) => explode('.', $p->name)[0])`
- No hay vista de detalle ni acciones — solo el `index`
