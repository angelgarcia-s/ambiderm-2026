# ISSUE-025 — HomeController + NosotrosController (públicos)

**ADR:** [ADR-002](../adr/ADR-002-cms-paginas-publicas.md)
**Agente:** Backend
**Branch:** `feature/adr002-cms-paginas-publicas`
**Estado:** Pendiente
**Depende de:** ISSUE-020, ISSUE-023

---

## Descripción

Crear los controladores públicos `HomeController` y `NosotrosController` que reemplazan las rutas `Route::view()` actuales, inyectando contenido dinámico desde `ContenidoService`.

---

## Criterios de aceptación

- [ ] Existe `app/Http/Controllers/HomeController.php`
- [ ] `HomeController@index` carga secciones de `home` y `footer` vía `ContenidoService::obtenerPagina()`
- [ ] `HomeController@index` pasa `$secciones` y `$footer` a la vista `home`
- [ ] Existe `app/Http/Controllers/NosotrosController.php`
- [ ] `NosotrosController@index` carga secciones de `nosotros` y `footer` vía `ContenidoService::obtenerPagina()`
- [ ] `NosotrosController@index` pasa `$secciones` y `$footer` a la vista `acerca-de`
- [ ] Las rutas en `web.php` cambian de `Route::view('/', 'home')` a `Route::get('/', [HomeController::class, 'index'])`
- [ ] Las rutas en `web.php` cambian de `Route::view('/nosotros', 'acerca-de')` a `Route::get('/nosotros', [NosotrosController::class, 'index'])`
- [ ] Los nombres de ruta se mantienen: `home` y `nosotros`
- [ ] Las páginas públicas siguen renderizando correctamente (con los mismos datos hardcodeados, ahora desde DB)

---

## Archivos a crear/modificar

| Acción | Archivo |
|--------|---------|
| CREAR | `app/Http/Controllers/HomeController.php` |
| CREAR | `app/Http/Controllers/NosotrosController.php` |
| MODIFICAR | `routes/web.php` — reemplazar `Route::view()` por controladores |

---

## Notas de implementación

- Ambos controladores usan `ContenidoService::obtenerPagina()` que ya maneja el caché
- La variable `$secciones` es una Collection keyed por `seccion` — acceso: `$secciones['hero']->contenido['titulo']`
- La variable `$footer` es igual — keyed por sección de footer
- Las vistas Blade se refactorizarán en ISSUE-029 y ISSUE-030 (frontend) para consumir `$secciones` — pero los controladores ya deben pasar los datos
- Mientras el frontend no haga el refactor, las vistas seguirán mostrando el contenido hardcodeado
