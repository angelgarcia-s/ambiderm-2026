# ISSUE-007 — Livewire: Listado de Permisos (read-only)

**ADR:** [ADR-001](../adr/ADR-001-roles-y-permisos.md)
**Agente:** Frontend
**Branch:** `feature/adr001-roles-y-permisos`
**Depende de:** ISSUE-004 (backend permisos)
**Estado:** Completado

---

## Descripción

Crear el componente Livewire + vista Blade para el listado de permisos del sistema. Es una vista informativa de solo lectura — no hay acciones CRUD. Los permisos se muestran agrupados por módulo.

---

## Criterios de aceptación

- [ ] Ruta `/admin/permisos` muestra todos los permisos agrupados por módulo
- [ ] No existen botones de crear, editar ni eliminar
- [ ] Se muestra una nota informativa indicando que los permisos se gestionan desde el seeder
- [ ] La vista es accesible solo para usuarios con `permisos.ver`
- [ ] Diseño limpio tipo tabla o card-grid con Flux

---

## Archivos a crear

| Archivo | Descripción |
|---------|-------------|
| `app/Livewire/Admin/Permisos/Index.php` | Componente Livewire (simple) |
| `resources/views/livewire/admin/permisos/index.blade.php` | Vista del listado |
| `resources/views/admin/permisos/index.blade.php` | Layout blade|

---

## Especificación del componente

### Propiedades
```php
public array $permissionsByModule = [];
```

### Métodos
```
mount() → carga Permission::all() agrupados por módulo (prefijo antes del punto)
```

> Componente sin estado reactivo — no necesita propiedades con `#[Reactive]` ni `wire:model`.

---

## UI / Diseño

- Cada módulo en una tarjeta o sección con encabezado
- Los permisos del módulo como badges o pills dentro de la tarjeta
- Ejemplo visual:
  ```
  ┌─ Dashboard ──────────────────────────┐
  │  dashboard.ver                        │
  └───────────────────────────────────────┘

  ┌─ Usuarios ───────────────────────────┐
  │  usuarios.ver  usuarios.crear         │
  │  usuarios.editar  usuarios.eliminar   │
  └───────────────────────────────────────┘
  ```
- Nota informativa arriba de las tarjetas:
  > "Los permisos del sistema se definen en el seeder. Para agregar nuevos permisos, actualiza `RolesAndPermissionsSeeder`."

---

## Notas

- Sin paginación — la lista de permisos es corta y fija
- Sin búsqueda — innecesario para el scope actual
- Usar `<flux:badge>` para los permisos individuales si está disponible, o `<span>` con clases Tailwind
