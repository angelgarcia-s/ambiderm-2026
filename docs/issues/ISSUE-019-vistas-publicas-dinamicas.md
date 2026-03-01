# ISSUE-019 — Conectar Vistas Públicas con Datos de DB

**ADR:** ADR-003
**Tipo:** Frontend
**Prioridad:** Media (depende de ISSUE-014, ISSUE-015, ISSUE-016, ISSUE-017)

---

## Descripción

Actualizar las vistas Blade públicas (`productos-ambiderm.blade.php` y `producto-detalle.blade.php`) para consumir datos dinámicos del controller `ProductosPublicController` en lugar de tener productos hardcodeados.

---

## Tareas

1. **Refactorizar** `resources/views/productos-ambiderm.blade.php`
   - Recibir `$productos` y `$categorias` del controller
   - Renderizar categorías dinámicamente como filtros (botones pill)
   - Renderizar grid de productos con `@foreach`
   - Cada card: imagen, material, nombre, link a `/productos/{slug}`
   - El filtro por categoría puede ser server-side (links a `/productos?categoria={slug}`) o client-side (Alpine.js)
   - Buscador: mantener client-side con Alpine.js
   - Mantener la estética Apple-inspired existente (animaciones reveal, rounded cards, etc.)
   - Estado vacío si no hay productos

2. **Refactorizar** `resources/views/producto-detalle.blade.php`
   - Recibir `$producto` y `$relacionados` del controller
   - Renderizar datos dinámicos: nombre, subtitulo, descripcion, imagen, caracteristicas, etiquetas
   - Selector de colores funcional: `@foreach($producto->colores as $color)` con imagen pivot
   - Selector de tamaños visual: `@foreach($producto->tamanos as $tamano)` — si tiene icono se muestra el icono, si no la abreviatura, si no el nombre
   - Accordions: presentacion, certificaciones
   - **Botón "Comprar en línea"**: solo visible si `$producto->url_tienda` tiene valor
   - Botón "Ficha técnica": solo visible si `$producto->url_ficha_tecnica` tiene valor
   - Breadcrumb: Inicio > Productos > {{ $producto->nombre }}
   - Sección "También te puede interesar" con `$relacionados`

3. **Eliminar** la vista `guantes-vynil.blade.php` (absorbida por filtro de categoría)

4. **Actualizar** nav de páginas públicas si es necesario (dropdown de categorías dinámico)

---

## Nota importante sobre botón "Comprar en línea"

```blade
{{-- Solo se muestra si url_tienda tiene valor --}}
@if($producto->url_tienda)
    <a href="{{ $producto->url_tienda }}" target="_blank" class="...">
        <i data-lucide="shopping-bag" class="w-5 h-5"></i> COMPRAR EN LÍNEA
    </a>
@endif

{{-- Solo se muestra si url_ficha_tecnica tiene valor --}}
@if($producto->url_ficha_tecnica)
    <a href="{{ $producto->url_ficha_tecnica }}" target="_blank" class="...">
        <i data-lucide="file-text" class="w-5 h-5"></i> FICHA TÉCNICA
    </a>
@endif
```

---

## Criterios de aceptación

- [ ] `/productos` muestra el catálogo con datos de la DB
- [ ] `/productos?categoria=guantes` filtra correctamente
- [ ] `/productos/{slug}` muestra el detalle completo del producto
- [ ] Las animaciones y estética se mantienen fieles al diseño estático original
- [ ] Los tamaños se muestran con fallback: icono → abreviatura → nombre
- [ ] Los colores se muestran con fallback: icono → círculo hex; con imagen por variante al hacer click
- [ ] El botón "Comprar en línea" **NO aparece** si `url_tienda` es null/vacío
- [ ] El botón "Ficha técnica" **NO aparece** si `url_ficha_tecnica` es null/vacío
- [ ] Los productos relacionados se muestran en el detalle
- [ ] La vista maneja gracefully el caso de 0 productos (estado vacío)
- [ ] El SEO se mantiene (titles, meta, breadcrumbs)
