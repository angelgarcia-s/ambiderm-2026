# Contract — RolesAndPermissionsSeeder

**Versión:** 1.0
**ADR:** [ADR-001](../adr/ADR-001-roles-y-permisos.md)
**Última actualización:** 2026-03-01

---

## Responsabilidad

Crear y sincronizar en base de datos todos los roles, permisos y sus asignaciones. Debe ser **idempotente** — ejecutable múltiples veces sin duplicar datos.

---

## Clase

```
database/seeders/RolesAndPermissionsSeeder.php
```

Namespace: `Database\Seeders`
Extiende: `Seeder`

---

## Array de permisos

```php
private array $permissions = [
    // Dashboard
    'dashboard.ver',

    // Usuarios
    'usuarios.ver',
    'usuarios.crear',
    'usuarios.editar',
    'usuarios.eliminar',

    // Roles
    'roles.ver',
    'roles.crear',
    'roles.editar',
    'roles.eliminar',

    // Permisos
    'permisos.ver',

    // Productos (reservado para ADR-003)
    'productos.ver',
    'productos.crear',
    'productos.editar',
    'productos.eliminar',
];
```

> Convención obligatoria: `modulo.accion` en minúsculas con punto como separador.

---

## Métodos obligatorios

### `run(): void`
Punto de entrada. Llama en orden:
1. `seedPermissions()`
2. `seedRoles()`
3. `assignAllToSuperAdmin()`
4. `assignPermissions()`

Debe llamar `app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions()` al inicio.

---

### `private seedPermissions(): void`
- Itera `$this->permissions`
- Usa `Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web'])`
- **No elimina** permisos existentes que no estén en el array

---

### `private seedRoles(): void`
- Crea los tres roles con `Role::firstOrCreate(['name' => $rol, 'guard_name' => 'web'])`:
  - `super_admin`
  - `admin`
  - `editor`

---

### `private assignAllToSuperAdmin(): void`
- Obtiene el rol `super_admin`
- Llama `$role->syncPermissions(Permission::all())`
- Garantiza que super_admin SIEMPRE tenga todos los permisos existentes

---

### `private assignPermissions(): void`
Define y aplica los permisos para `admin` y `editor` usando `syncPermissions()`.

**admin** recibe:
```
dashboard.ver, usuarios.*, roles.*, permisos.ver, productos.*
```

**editor** recibe:
```
dashboard.ver, productos.ver, productos.editar
```

---

## Reglas

- `syncPermissions()` sobre `givePermissionTo()` — garantiza idempotencia
- No crear usuarios semilla en este seeder — responsabilidad de `DatabaseSeeder` o seeder dedicado
- El seeder debe registrarse en `DatabaseSeeder::run()` antes de cualquier seeder que cree usuarios con roles

---

## Cómo agregar permisos futuros

1. Agregar la entrada al array `$permissions`
2. Re-ejecutar: `php artisan db:seed --class=RolesAndPermissionsSeeder`
3. Añadir los nuevos permisos al método `assignPermissions()` para `admin`/`editor` según corresponda
