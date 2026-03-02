# ISSUE-026 — Refactorizar footer a partial compartido

**ADR:** [ADR-002](../adr/ADR-002-cms-paginas-publicas.md)
**Agente:** Backend
**Branch:** `feature/adr002-cms-paginas-publicas`
**Estado:** Pendiente
**Depende de:** ISSUE-020, ISSUE-023

---

## Descripción

Extraer el footer de las vistas públicas a un partial Blade compartido (`partials/footer.blade.php`) que reciba los datos del footer como parámetro, preparando la estructura para que el frontend lo consuma desde la DB.

---

## Criterios de aceptación

- [ ] Existe `resources/views/partials/footer.blade.php`
- [ ] El partial recibe `$footer` como variable (Collection de secciones de footer)
- [ ] El partial contiene la estructura HTML del footer actual (redes sociales, sucursales, contacto, copyright)
- [ ] El partial es incluido desde `home.blade.php` y `acerca-de.blade.php` vía `@include('partials.footer', ['footer' => $footer])`
- [ ] El HTML del footer se elimina de `home.blade.php` y `acerca-de.blade.php` (dejan de tenerlo inline)
- [ ] Las páginas públicas siguen renderizando el footer correctamente

---

## Archivos a crear/modificar

| Acción | Archivo |
|--------|---------|
| CREAR | `resources/views/partials/footer.blade.php` |
| MODIFICAR | `resources/views/home.blade.php` — reemplazar footer inline por `@include` |
| MODIFICAR | `resources/views/acerca-de.blade.php` — reemplazar footer inline por `@include` |

---

## Notas de implementación

- El partial inicialmente puede tener el contenido hardcodeado idéntico al actual — el frontend lo refactorizará en ISSUE-031 para consumir `$footer`
- La idea del backend es crear la estructura del partial y eliminar la duplicación
- El footer incluye 4 sub-secciones: redes sociales + logo, sucursales con mapas, contacto + distribuidor, copyright
- Opcional: también se puede manejar desde el layout público (`components/layouts/public.blade.php`) si tiene más sentido como slot del layout
