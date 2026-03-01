# ISSUE-011 — Actualizar RolesAndPermissionsSeeder

**ADR:** ADR-003
**Tipo:** Backend
**Prioridad:** Alta (prerequisito de ISSUE-012)

---

## Descripción

Agregar los 4 permisos de `categorias.*` al `RolesAndPermissionsSeeder` y actualizar las asignaciones de roles `admin` y `editor`.

---

## Tareas

1. **Agregar permisos** al array `$permissions`:
   ```php
   // Categorías
   'categorias.ver',
   'categorias.crear',
   'categorias.editar',
   'categorias.eliminar',
   ```

2. **Actualizar asignación de `admin`**: agregar los 4 permisos de categorías
   ```php
   'categorias.ver',
   'categorias.crear',
   'categorias.editar',
   'categorias.eliminar',
   ```

3. **Actualizar asignación de `editor`**: agregar solo `categorias.ver`
   ```php
   'categorias.ver',
   ```

4. **Actualizar comentario** del bloque de productos: eliminar `(reservado para ADR-003)` — ya no es reservado

---

## Después de implementar

Ejecutar: `php artisan db:seed --class=RolesAndPermissionsSeeder`

---

## Criterios de aceptación

- [ ] El seeder tiene 18 permisos en total (14 existentes + 4 nuevos de categorías)
- [ ] `super_admin` recibe los 18 permisos automáticamente
- [ ] `admin` recibe los 4 permisos de categorías
- [ ] `editor` recibe solo `categorias.ver`
- [ ] El seeder sigue siendo idempotente (puede re-ejecutarse sin duplicar)
