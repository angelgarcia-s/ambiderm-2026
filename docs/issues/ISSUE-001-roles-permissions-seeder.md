# ISSUE-001 — RolesAndPermissionsSeeder

**ADR:** [ADR-001](../adr/ADR-001-roles-y-permisos.md)
**Contrato:** [RolesAndPermissionsSeeder.md](../contracts/RolesAndPermissionsSeeder.md)
**Agente:** Backend
**Branch:** `feature/adr001-roles-y-permisos`
**Estado:** Pendiente

---

## Descripción

Crear el seeder `RolesAndPermissionsSeeder` que define todos los permisos del sistema, crea los tres roles (`super_admin`, `admin`, `editor`) y les asigna sus permisos correspondientes de forma idempotente.

---

## Criterios de aceptación

- [ ] Existe el archivo `database/seeders/RolesAndPermissionsSeeder.php`
- [ ] El seeder implementa los métodos: `seedPermissions()`, `seedRoles()`, `assignAllToSuperAdmin()`, `assignPermissions()`
- [ ] El array `$permissions` contiene todos los permisos definidos en el ADR-001 con convención `modulo.accion`
- [ ] `super_admin` recibe TODOS los permisos via `syncPermissions(Permission::all())`
- [ ] `admin` recibe los permisos definidos en el ADR-001
- [ ] `editor` recibe los permisos definidos en el ADR-001
- [ ] El seeder es idempotente — ejecutar dos veces no duplica datos
- [ ] El seeder está registrado en `DatabaseSeeder::run()`
- [ ] `php artisan db:seed --class=RolesAndPermissionsSeeder` ejecuta sin errores

---

## Archivos a crear/modificar

| Acción | Archivo |
|--------|---------|
| CREAR | `database/seeders/RolesAndPermissionsSeeder.php` |
| MODIFICAR | `database/seeders/DatabaseSeeder.php` — registrar el seeder |

---

## Notas de implementación

- Usar `Permission::firstOrCreate()` y `Role::firstOrCreate()` — nunca `create()` directamente
- Llamar `app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions()` al inicio del `run()`
- Usar `syncPermissions()` en lugar de `givePermissionTo()` para garantizar idempotencia
- Los permisos de `productos.*` se incluyen en el array aunque el módulo Productos sea ADR-003 — así el seeder está listo cuando se implemente
