# ISSUE-022 — Actualizar RolesAndPermissionsSeeder (permisos de páginas)

**ADR:** [ADR-002](../adr/ADR-002-cms-paginas-publicas.md)
**Agente:** Backend
**Branch:** `feature/adr002-cms-paginas-publicas`
**Estado:** Pendiente

---

## Descripción

Agregar los permisos `paginas.ver` y `paginas.editar` al `RolesAndPermissionsSeeder` existente, y asignarlos a los tres roles (`super_admin`, `admin`, `editor`).

---

## Criterios de aceptación

- [ ] El array `$permissions` del seeder incluye `paginas.ver` y `paginas.editar`
- [ ] `super_admin` recibe ambos permisos vía `syncPermissions(Permission::all())`
- [ ] `admin` recibe `paginas.ver` y `paginas.editar`
- [ ] `editor` recibe `paginas.ver` y `paginas.editar`
- [ ] `php artisan db:seed --class=RolesAndPermissionsSeeder` ejecuta sin errores
- [ ] Ejecutar el seeder dos veces NO duplica permisos

---

## Archivos a crear/modificar

| Acción | Archivo |
|--------|---------|
| MODIFICAR | `database/seeders/RolesAndPermissionsSeeder.php` — agregar permisos al array y asignación a roles |

---

## Notas de implementación

- Simplemente agregar `'paginas.ver'` y `'paginas.editar'` al array `$permissions` existente
- Agregar ambos al array de permisos de `admin` y `editor` en `assignPermissions()`
- `super_admin` los recibe automáticamente vía `syncPermissions(Permission::all())`
- No crear permisos `paginas.crear` ni `paginas.eliminar` — las secciones son inmutables desde la UI
