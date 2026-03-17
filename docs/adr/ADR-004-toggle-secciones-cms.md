# ADR-004 — Toggle Activar/Desactivar Secciones CMS

**Estado:** Borrador
**Fecha:** 2026-03-17
**Autor:** Agent.Orchestrator
**Branch:** `feature/adr004-toggle-secciones-cms`

---

## Contexto

El CMS de páginas públicas (ADR-002) almacena cada sección editable como un registro en `secciones_contenido` con la columna booleana `activo`. Sin embargo, **el panel admin no expone ningún control para cambiar ese valor** — el toggle existe en el modelo pero no en la UI.

### Problema adicional detectado

`ContenidoService::obtenerPagina()` aplica el scope `pagina()` que filtra `activo = true`. Hasta aquí correcto. El problema está en el loop de fallback que viene después: si una sección existe en DB con `activo = false`, el scope la excluye del resultado, **pero el loop de fallback la detecta como "sección faltante" y la inyecta de vuelta** como un mock con `activo = true` y contenido vacío. En consecuencia, las secciones desactivadas se siguen renderizando en el sitio público (con contenido vacío).

### Estado actual
- `secciones_contenido.activo` — columna boolean, default `true`, ya migrada
- `SeccionContenido::scopePagina()` — filtra `activo = true`
- `ContenidoService::obtenerPagina()` — bug: fallback no distingue "no existe en DB" vs "existe pero inactiva"
- Panel admin `/admin/paginas/index` — muestra badge Activo/Inactivo pero sin acción de toggle
- Vistas públicas (`home.blade.php`, `acerca-de.blade.php`, `footer.blade.php`) — asumen que `$secciones` siempre contiene todas las secciones

---

## Decisión

### 1. Toggle en el panel admin (Livewire)

Agregar un método `toggleActivo(int $id)` al componente `App\Livewire\Admin\Paginas\Index`. El método:
- Verifica autorización `paginas.editar`
- Invierte el booleano `activo` del registro
- Invalida la caché de la página afectada via `ContenidoService::invalidarCache()`
- No redirige — el componente se re-renderiza in situ

En la vista `livewire/admin/paginas/index.blade.php`, el badge **Activo/Inactivo** se convierte en un `<flux:button>` de tipo toggle con confirmación visual (color/label cambia de verde a zinc).

**Permiso requerido:** `paginas.editar`  
**Sin nueva migración** — `activo` ya existe.

### 2. Fix en `ContenidoService::obtenerPagina()`

Corregir el loop de fallback para que **solo añada mocks para secciones que no existan en absoluto en la DB**, independientemente de su estado `activo`.

```php
// Antes (buggy): el fallback compara contra $secciones (solo activas)
if (! $secciones->has($seccion)) { ... }

// Después (correcto): comparar contra todas las secciones en DB (activas + inactivas)
$existentesEnDB = SeccionContenido::where('pagina', $pagina)
    ->pluck('seccion')
    ->toArray();

foreach (self::$defaults[$pagina] ?? [] as $seccion => $contenido) {
    if (! in_array($seccion, $existentesEnDB)) {
        // Sección nunca creada en DB → inyectar fallback
        $secciones->put($seccion, $mock);
    }
    // Si existe en DB pero inactiva → no se inyecta, no aparece en $secciones
}
```

### 3. Condicionar renderizado en vistas públicas

Las vistas públicas deben validar que la sección existe antes de renderizarla. Se usa `@isset` (o `$secciones->has('clave')`) para cada bloque de sección.

```blade
{{-- Antes --}}
@php $hero = $secciones['hero']->contenido; @endphp
<section>...</section>

{{-- Después --}}
@if ($secciones->has('hero'))
    @php $hero = $secciones['hero']->contenido; @endphp
    <section>...</section>
@endif
```

Aplica a: `home.blade.php` (6 secciones), `acerca-de.blade.php` (5 secciones), `partials/footer.blade.php` (4 secciones).

> **Comportamiento esperado al desactivar una sección:**
> El bloque HTML correspondiente desaparece del sitio público. El layout de la página fluye normalmente sin ese bloque. No hay errores ni contenido vacío visible.

---

## Issues

| Issue | Agente | Descripción |
|-------|--------|-------------|
| [ISSUE-027](../issues/ISSUE-027-toggle-activo-livewire.md) | Backend | Método `toggleActivo()` en `Paginas/Index.php` + autorización + invalidación caché |
| [ISSUE-028](../issues/ISSUE-028-fix-contenido-service-fallback.md) | Backend | Fix en `ContenidoService::obtenerPagina()` — no inyectar fallback si sección existe en DB inactiva |
| [ISSUE-029](../issues/ISSUE-029-vistas-publicas-secciones-condicionales.md) | Frontend | Envolver cada sección de `home.blade.php`, `acerca-de.blade.php` y `footer.blade.php` con check `$secciones->has()` |
| [ISSUE-030](../issues/ISSUE-030-toggle-ui-admin-paginas.md) | Frontend | Badge toggle en `livewire/admin/paginas/index.blade.php` — botón que llame a `toggleActivo()` |

**Orden de implementación:** ISSUE-027 → ISSUE-028 → ISSUE-029 → ISSUE-030

---

## Criterios de aceptación

- [ ] El listado `/admin/paginas` muestra un control clickeable de Activo/Inactivo por sección
- [ ] Al hacer click, el estado cambia en DB y la caché de la página se invalida
- [ ] Una sección desactivada no aparece en el sitio público (su bloque HTML no se renderiza)
- [ ] Una sección desactivada que se reactiva vuelve a aparecer correctamente en el público
- [ ] El fallback del `ContenidoService` solo aplica para secciones que nunca han sido creadas en DB
- [ ] Solo usuarios con permiso `paginas.editar` pueden cambiar el estado
- [ ] El cambio de estado no navega a otra página — el componente Livewire se actualiza in situ

---

## Consecuencias

### Positivas
- Los editores pueden ocultar secciones temporalmente sin eliminar su contenido (útil para campañas, mantenimiento de secciones, A/B)
- Se corrige un bug silencioso del `ContenidoService` que permitía que secciones inactivas siguieran siendo visibles con contenido vacío

### Negativas / Riesgos
- Las vistas públicas deben ser actualizadas para no asumir que `$secciones` siempre tiene todas las claves. **Si se añaden secciones futuras sin el guard `has()`, el bug puede reaparecer.**
- Si se desactiva el Hero de inicio, la página queda sin hero — no hay fallback visual. Es responsabilidad del editor no dejar páginas incompletas.

---

## Alternativas descartadas

| Alternativa | Razón del descarte |
|-------------|-------------------|
| Toggle desde la vista de edición de la sección | Requeriría entrar a editar cada sección. El toggle desde el listado es más eficiente. |
| Soft delete en lugar de campo `activo` | `activo` ya está implementado y semánticamente es más correcto para contenido que se oculta temporalmente. |
| No corregir el bug del fallback en este ADR | El bug hace que la feature de toggle no funcione correctamente. Son cambios acoplados. |
