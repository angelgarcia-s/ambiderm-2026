# ISSUE-029 — Vistas públicas: renderizado condicional por sección

**ADR:** [ADR-004](../adr/ADR-004-toggle-secciones-cms.md)
**Agente:** Frontend
**Prioridad:** 3 de 4
**Rama:** `feature/adr004-toggle-secciones-cms`
**Depende de:** ISSUE-028 (el fix de `ContenidoService` hace que `$secciones` ya no garantice todas las claves)

---

## Descripción

Envolver cada bloque de sección en las tres vistas públicas con un guard `@if ($secciones->has('clave'))` para que, si una sección está desactivada (y por tanto ausente en `$secciones`), su bloque HTML simplemente no se renderice.

---

## Archivos a modificar

### 1. `resources/views/home.blade.php` — 6 secciones

| Sección | Clave | Bloque a envolver |
|---------|-------|-------------------|
| Hero | `hero` | `<section class="relative pt-40 ...">` |
| Producto Destacado | `video_feature` | `<section id="video-feature" ...>` |
| La Colección | `coleccion` | `<section id="coleccion" ...>` |
| Soluciones Médicas | `soluciones_medicas` | `<section ...>` (las 4 tarjetas) |
| Eco-Friendly | `eco_friendly` | `<section ...>` |
| Video YouTube | `youtube_video` | `<section ...>` |

### 2. `resources/views/acerca-de.blade.php` — 5 secciones

| Sección | Clave |
|---------|-------|
| Hero | `hero` |
| Historia | `historia` |
| Misión | `mision` |
| Visión | `vision` |
| Valores | `valores` |

### 3. `resources/views/partials/footer.blade.php` — 4 secciones

| Sección | Clave |
|---------|-------|
| Redes Sociales | `redes_sociales` |
| Sucursales | `sucursales` |
| Contacto | `contacto` |
| Copyright | `copyright` |

---

## Patrón de implementación

```blade
{{-- Antes --}}
@php $hero = $secciones['hero']->contenido; @endphp
<section class="relative pt-40 ...">
    ...
</section>

{{-- Después --}}
@if ($secciones->has('hero'))
    @php $hero = $secciones['hero']->contenido; @endphp
    <section class="relative pt-40 ...">
        ...
    </section>
@endif
```

El `@php` de extracción del contenido debe quedar **dentro** del bloque `@if`, no fuera.

---

## Criterios de aceptación

- [ ] Cada sección en `home.blade.php` está envuelta en `@if ($secciones->has('clave'))`
- [ ] Cada sección en `acerca-de.blade.php` está envuelta en `@if ($secciones->has('clave'))`
- [ ] Cada sección en `partials/footer.blade.php` está envuelta en `@if ($secciones->has('clave'))`
- [ ] Si todas las secciones están activas, la página se ve idéntica a antes (comportamiento sin regresión)
- [ ] Si se desactiva una sección, su bloque desaparece limpiamente sin errores PHP ni HTML vacío visible

---

## Notas

- Usar `$secciones->has('clave')` en lugar de `isset($secciones['clave'])` — ambos funcionan con Collection pero `has()` es más expresivo
- El footer es un partial incluido en el layout — aplica exactamente igual
- No modificar la lógica interna de cada sección, solo agregar el wrapper `@if/@endif`
