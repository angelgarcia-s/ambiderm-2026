# Contract: Categoria

**ADR:** ADR-003
**Modelo:** `App\Models\Categoria`
**Tabla:** `categorias`

---

## Campos

| Campo | Tipo PHP | Cast | Fillable | Reglas de validación |
|-------|----------|------|----------|---------------------|
| `id` | int | — | NO | — |
| `nombre` | string | — | SÍ | `required|string|max:100` |
| `slug` | string | — | SÍ | `required|string|max:120|unique:categorias,slug` |
| `descripcion` | ?string | — | SÍ | `nullable|string|max:500` |
| `imagen` | ?string | — | SÍ | `nullable|string|max:255` |
| `activo` | bool | boolean | SÍ | `boolean` |
| `orden` | int | integer | SÍ | `integer|min:0` |

---

## Relaciones

| Método | Tipo | Modelo relacionado | Pivot |
|--------|------|-------------------|-------|
| `productos()` | belongsToMany | `Producto` | `categoria_producto` |

---

## Scopes

| Scope | Query |
|-------|-------|
| `scopeActivo($q)` | `$q->where('activo', true)` |
| `scopeOrdenado($q)` | `$q->orderBy('orden')->orderBy('nombre')` |

---

## Reglas de negocio

1. **Slug auto-generado**: Si no se proporciona, se genera desde `nombre` usando `Str::slug()` en evento `creating`/`saving`.
2. **No eliminar con productos**: Una categoría no se puede eliminar si tiene productos asociados (`productos()->count() > 0`). El controller/Livewire debe validar antes de `delete()`.
3. **Categorías inactivas**: No aparecen en las páginas públicas pero sí en el admin.
4. **Imágenes**: Se almacenan en `storage/app/public/categorias/`. Se acceden vía `Storage::url()`.

---

## Policy: `CategoriaPolicy`

| Método | Permiso Spatie | Lógica adicional |
|--------|---------------|-----------------|
| `viewAny` | `categorias.ver` | — |
| `view` | `categorias.ver` | — |
| `create` | `categorias.crear` | — |
| `update` | `categorias.editar` | — |
| `delete` | `categorias.eliminar` | Solo si `$categoria->productos()->count() === 0` |
