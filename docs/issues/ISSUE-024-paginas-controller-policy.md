# ISSUE-024 — PaginasController (Admin) + SeccionContenidoPolicy

**ADR:** [ADR-002](../adr/ADR-002-cms-paginas-publicas.md)
**Agente:** Backend
**Branch:** `feature/adr002-cms-paginas-publicas`
**Estado:** Pendiente
**Depende de:** ISSUE-020, ISSUE-022

---

## Descripción

Crear el controlador admin `PaginasController` con acciones `index` y `edit`, la policy `SeccionContenidoPolicy`, y registrar las rutas en `web.php`.

---

## Criterios de aceptación

- [ ] Existe `app/Http/Controllers/Admin/PaginasController.php`
- [ ] Método `index()` — autoriza con `paginas.ver`, retorna vista con las 3 páginas y sus secciones
- [ ] Método `edit(string $pagina, string $seccion)` — autoriza con `paginas.editar`, retorna vista de edición
- [ ] Existe `app/Policies/SeccionContenidoPolicy.php`
- [ ] Policy `viewAny()` → `$user->can('paginas.ver')`
- [ ] Policy `update()` → `$user->can('paginas.editar')`
- [ ] La policy está registrada en `AppServiceProvider` (o auto-discovered)
- [ ] Rutas registradas en `web.php` bajo el grupo admin:
  - `GET /admin/paginas` → `PaginasController@index` con middleware `can:paginas.ver`
  - `GET /admin/paginas/{pagina}/{seccion}/editar` → `PaginasController@edit` con middleware `can:paginas.editar`

---

## Archivos a crear/modificar

| Acción | Archivo |
|--------|---------|
| CREAR | `app/Http/Controllers/Admin/PaginasController.php` |
| CREAR | `app/Policies/SeccionContenidoPolicy.php` |
| MODIFICAR | `routes/web.php` — agregar rutas admin de páginas |
| MODIFICAR | `app/Providers/AppServiceProvider.php` — registrar policy (si no es auto-discovered) |

---

## Notas de implementación

- El `index()` agrupa las secciones por página para mostrar: Home (6), Nosotros (5), Footer (4)
- El `edit()` recibe `$pagina` y `$seccion` como strings, busca el registro por esos campos
- Si la sección no existe, retornar 404
- Las vistas Blade del admin serán creadas por el frontend en ISSUE-027 y ISSUE-028 — el controlador solo prepara los datos
- Crear las vistas wrapper mínimas (`admin/paginas/index.blade.php` y `admin/paginas/edit.blade.php`) que renderizan componentes Livewire
