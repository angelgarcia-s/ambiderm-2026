# ISSUE-012 — CategoriasController + CategoriaPolicy

**ADR:** ADR-003
**Tipo:** Backend
**Prioridad:** Alta (depende de ISSUE-008, ISSUE-011)
**Contract:** [Categoria.md](../contracts/Categoria.md)

---

## Descripción

Crear el controller de administración de categorías y su Policy para proteger las acciones con permisos Spatie.

---

## Tareas

1. **Policy** `App\Policies\CategoriaPolicy`
   - `viewAny` → `categorias.ver`
   - `view` → `categorias.ver`
   - `create` → `categorias.crear`
   - `update` → `categorias.editar`
   - `delete` → `categorias.eliminar` + validar que `$categoria->productos()->count() === 0`

2. **Registrar Policy** en `AppServiceProvider` (o auto-discovery)

3. **Controller** `App\Http\Controllers\Admin\CategoriasController`
   - `index()` → vista wrapper para Livewire component
   - Aplicar `can` middleware en rutas

4. **Rutas** en `web.php` dentro del grupo admin:
   ```php
   Route::get('categorias', [CategoriasController::class, 'index'])
       ->middleware('can:categorias.ver')
       ->name('categorias.index');
   ```

---

## Criterios de aceptación

- [ ] La Policy verifica permisos Spatie (no roles directamente)
- [ ] No se puede eliminar una categoría con productos asociados
- [ ] Las rutas están protegidas con `auth`, `verified` y `can` middleware
- [ ] El controller solo sirve como wrapper — la lógica CRUD estará en Livewire (ISSUE-015)
