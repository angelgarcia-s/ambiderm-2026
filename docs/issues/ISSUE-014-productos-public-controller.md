# ISSUE-014 — ProductosPublicController (Rutas públicas dinámicas)

**ADR:** ADR-003
**Tipo:** Backend
**Prioridad:** Media (depende de ISSUE-008, ISSUE-009, ISSUE-010)

---

## Descripción

Crear el controller público que sirve el catálogo de productos y el detalle de producto, consultando datos desde la base de datos en lugar del HTML hardcodeado.

---

## Tareas

1. **Controller** `App\Http\Controllers\ProductosPublicController`
   - `index(Request $request)`:
     - Obtener categorías activas para el filtro de navegación
     - Query: `Producto::activo()->ordenado()->with('categorias')`
     - Si `$request->categoria`, filtrar por slug de categoría vía scope `deCategoria()`
     - Retornar vista `productos-ambiderm` con `$productos` y `$categorias`
   - `show(string $slug)`:
     - Query: `Producto::where('slug', $slug)->activo()->with(['categorias', 'tamanos', 'colores'])->firstOrFail()`
     - Productos relacionados: comparten al menos una categoría, excluyendo actual, limit 4
     - Retornar vista `producto-detalle` con `$producto` y `$relacionados`

2. **Actualizar rutas** en `web.php`:
   ```php
   // Reemplazar Route::view existentes
   Route::get('/productos', [ProductosPublicController::class, 'index'])->name('productos');
   Route::get('/productos/{slug}', [ProductosPublicController::class, 'show'])->name('producto.detalle');

   // Eliminar:
   // Route::view('/producto-detalle', ...);
   // Route::view('/guantes-vynil', ...);
   ```

3. **Redirect legacy** (opcional): redirect 301 de `/producto-detalle` y `/guantes-vynil` a `/productos`

---

## Nota sobre botón "Comprar en línea"

En la vista pública de detalle, el botón "COMPRAR EN LÍNEA" **solo se muestra si `$producto->url_tienda` tiene valor**:

```blade
@if($producto->url_tienda)
    <a href="{{ $producto->url_tienda }}" target="_blank" class="...">
        COMPRAR EN LÍNEA
    </a>
@endif
```

---

## Criterios de aceptación

- [ ] `GET /productos` retorna listado con productos de la DB
- [ ] `GET /productos?categoria=guantes` filtra por categoría correctamente
- [ ] `GET /productos/{slug}` muestra detalle del producto con categorías, tamaños y colores
- [ ] `GET /productos/slug-inexistente` retorna 404
- [ ] Las rutas públicas NO requieren autenticación
- [ ] Las vistas reciben `$productos`, `$categorias`, `$producto`, `$relacionados`
- [ ] El botón "Comprar en línea" no aparece si `url_tienda` es null/vacío
