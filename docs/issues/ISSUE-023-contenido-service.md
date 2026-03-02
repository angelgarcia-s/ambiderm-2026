# ISSUE-023 — ContenidoService (servicio con caché)

**ADR:** [ADR-002](../adr/ADR-002-cms-paginas-publicas.md)
**Agente:** Backend
**Branch:** `feature/adr002-cms-paginas-publicas`
**Estado:** Pendiente
**Depende de:** ISSUE-020

---

## Descripción

Crear `App\Services\ContenidoService` con métodos estáticos para obtener contenido de secciones con caché de 24 horas, y poder invalidar el caché al editar desde el panel admin.

---

## Criterios de aceptación

- [ ] Existe `app/Services/ContenidoService.php`
- [ ] Método `obtener(string $pagina, string $seccion): array` — retorna el JSON de una sección, cacheado 24h
- [ ] Método `obtenerPagina(string $pagina): Collection` — retorna todas las secciones activas de una página, keyed por `seccion`, cacheado 24h
- [ ] Método `invalidarCache(string $pagina, ?string $seccion = null): void` — invalida caché de una sección o de toda la página
- [ ] Si la sección no existe o no está activa, `obtener()` retorna `[]`
- [ ] Las claves de caché siguen el formato `contenido.{pagina}.{seccion}` y `contenido.{pagina}`
- [ ] Se importa correctamente `Illuminate\Support\Collection` y `App\Models\SeccionContenido`

---

## Archivos a crear/modificar

| Acción | Archivo |
|--------|---------|
| CREAR | `app/Services/ContenidoService.php` |

---

## Notas de implementación

- Usar `cache()->remember()` con TTL de `now()->addHours(24)`
- `obtenerPagina()` retorna una Collection keyed por `seccion` para acceso tipo `$secciones['hero']`
- `invalidarCache()` debe invalidar tanto la clave individual como la clave de página completa
- En desarrollo (SQLite), el caché funciona con el driver `file` por defecto — no requiere Redis
