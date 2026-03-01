# ISSUE-013 — ProductosController + ProductoPolicy

**ADR:** ADR-003
**Tipo:** Backend
**Prioridad:** Alta (depende de ISSUE-010, ISSUE-011)
**Contract:** [Producto.md](../contracts/Producto.md)

---

## Descripción

Crear el controller de administración de productos y su Policy para proteger las acciones con permisos Spatie. También incluye las rutas para los catálogos auxiliares (tamaños y colores) que se gestionan bajo permisos de `productos.*`.

---

## Tareas

1. **Policy** `App\Policies\ProductoPolicy`
   - `viewAny` → `productos.ver`
   - `view` → `productos.ver`
   - `create` → `productos.crear`
   - `update` → `productos.editar`
   - `delete` → `productos.eliminar`

2. **Registrar Policy** en `AppServiceProvider` (o auto-discovery)

3. **Controller** `App\Http\Controllers\Admin\ProductosController`
   - `index()` → vista wrapper para Livewire component
   - `create()` → vista wrapper para Livewire form component
   - `edit(Producto $producto)` → vista wrapper para Livewire form component
   - Aplicar `can` middleware en rutas

4. **Controllers auxiliares** (thin wrappers)
   - `App\Http\Controllers\Admin\TamanosController` → `index()` wrapper Livewire
   - `App\Http\Controllers\Admin\ColoresController` → `index()` wrapper Livewire

5. **Rutas** en `web.php` dentro del grupo admin:
   ```php
   // Productos
   Route::get('productos', [ProductosController::class, 'index'])
       ->middleware('can:productos.ver')
       ->name('productos.index');
   Route::get('productos/crear', [ProductosController::class, 'create'])
       ->middleware('can:productos.crear')
       ->name('productos.create');
   Route::get('productos/{producto}/editar', [ProductosController::class, 'edit'])
       ->middleware('can:productos.editar')
       ->name('productos.edit');

   // Catálogos auxiliares (bajo permisos de productos)
   Route::get('tamanos', [TamanosController::class, 'index'])
       ->middleware('can:productos.crear')
       ->name('tamanos.index');
   Route::get('colores', [ColoresController::class, 'index'])
       ->middleware('can:productos.crear')
       ->name('colores.index');
   ```

---

## Criterios de aceptación

- [ ] La Policy verifica permisos Spatie (no roles directamente)
- [ ] Las rutas de productos están protegidas con `can:productos.*`
- [ ] Las rutas de tamaños y colores están protegidas con `can:productos.crear`
- [ ] Los controllers solo sirven como wrappers — la lógica CRUD estará en Livewire
