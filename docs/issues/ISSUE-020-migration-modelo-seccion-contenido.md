# ISSUE-020 — Migration + Modelo SeccionContenido

**ADR:** [ADR-002](../adr/ADR-002-cms-paginas-publicas.md)
**Agente:** Backend
**Branch:** `feature/adr002-cms-paginas-publicas`
**Estado:** Pendiente

---

## Descripción

Crear la migración para la tabla `secciones_contenido` y el modelo Eloquent `SeccionContenido` con scopes, casts y helper estático.

---

## Criterios de aceptación

- [ ] Existe la migración `create_secciones_contenido_table`
- [ ] La tabla tiene los campos: `id`, `pagina`, `seccion`, `titulo_admin`, `contenido` (json), `orden`, `activo`, `timestamps`
- [ ] Índice `unique(pagina, seccion)`
- [ ] Índice `index(pagina, orden)`
- [ ] Default: `orden = 0`, `activo = true`
- [ ] Existe el modelo `App\Models\SeccionContenido`
- [ ] El modelo tiene `$table = 'secciones_contenido'`
- [ ] El modelo tiene `$fillable` con todos los campos editables
- [ ] El modelo tiene `$casts = ['contenido' => 'array', 'activo' => 'boolean']`
- [ ] Scope `scopePagina($query, string $pagina)` filtra por página, activo y ordena por `orden`
- [ ] Método estático `obtener(string $pagina, string $seccion): ?array` retorna el contenido de una sección
- [ ] `php artisan migrate` ejecuta sin errores

---

## Archivos a crear/modificar

| Acción | Archivo |
|--------|---------|
| CREAR | `database/migrations/2026_03_01_XXXXXX_create_secciones_contenido_table.php` |
| CREAR | `app/Models/SeccionContenido.php` |

---

## Notas de implementación

- El campo `contenido` es `json` NOT NULL — siempre debe tener un JSON válido (al menos `{}`)
- El scope `scopePagina` filtra `activo = true` automáticamente
- El método estático `obtener()` también filtra por `activo = true`
- No se necesita SoftDeletes — las secciones son inmutables desde la UI
