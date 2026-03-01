# Contract: Producto

**ADR:** ADR-003
**Modelo:** `App\Models\Producto`
**Tabla:** `productos`

---

## Campos

| Campo | Tipo PHP | Cast | Fillable | Reglas de validación |
|-------|----------|------|----------|---------------------|
| `id` | int | — | NO | — |
| `nombre` | string | — | SÍ | `required|string|max:150` |
| `slug` | string | — | SÍ | `required|string|max:170|unique:productos,slug` |
| `subtitulo` | ?string | — | SÍ | `nullable|string|max:255` |
| `material` | ?string | — | SÍ | `nullable|string|max:80` |
| `descripcion` | ?string | — | SÍ | `nullable|string|max:5000` |
| `imagen` | ?string | — | SÍ | `nullable|string|max:255` |
| `caracteristicas` | ?array | `array` | SÍ | `nullable|array` / `caracteristicas.*` → `string|max:200` |
| `etiquetas` | ?array | `array` | SÍ | `nullable|array` / `etiquetas.*` → `string|max:100` |
| `presentacion` | ?string | — | SÍ | `nullable|string|max:2000` |
| `certificaciones` | ?string | — | SÍ | `nullable|string|max:2000` |
| `url_tienda` | ?string | — | SÍ | `nullable|url|max:255` |
| `url_ficha_tecnica` | ?string | — | SÍ | `nullable|url|max:255` |
| `activo` | bool | boolean | SÍ | `boolean` |
| `destacado` | bool | boolean | SÍ | `boolean` |
| `orden` | int | integer | SÍ | `integer|min:0` |

---

## Relaciones

| Método | Tipo | Modelo relacionado | Pivot / Detalles |
|--------|------|-------------------|-----------------|
| `categorias()` | belongsToMany | `Categoria` | `categoria_producto` |
| `tamanos()` | belongsToMany | `Tamano` | `producto_tamano` |
| `colores()` | belongsToMany | `Color` | `color_producto` → `withPivot('imagen')` |

---

## Scopes

| Scope | Query |
|-------|-------|
| `scopeActivo($q)` | `$q->where('activo', true)` |
| `scopeDestacado($q)` | `$q->where('destacado', true)` |
| `scopeOrdenado($q)` | `$q->orderBy('orden')->orderBy('nombre')` |
| `scopeDeCategoria($q, $categoriaSlug)` | `$q->whereHas('categorias', fn($q) => $q->where('slug', $categoriaSlug))` |

---

## Accessors

| Accessor | Retorna | Descripción |
|----------|---------|-------------|
| `imagen_url` | ?string | `$this->imagen ? Storage::url($this->imagen) : null` |

---

## Reglas de negocio

1. **Slug auto-generado**: Si no se proporciona, se genera desde `nombre` usando `Str::slug()` en evento `creating`/`saving`.
2. **Categorías requeridas**: Todo producto debe pertenecer a al menos una categoría. Validar en el formulario: `categorias` → `required|array|min:1`.
3. **Relaciones many-to-many**: Categorías, Tamaños y Colores se asignan vía `sync()` desde el formulario.
4. **Campos JSON**: `caracteristicas` y `etiquetas` se castean a `array` en el modelo. Se guardan como JSON en DB.
5. **Imágenes**: Se almacenan en `storage/app/public/productos/`. Se acceden vía `Storage::url()`.
6. **Imagen por color**: En la relación `colores()`, cada color puede tener una imagen específica del producto vía pivot `imagen`.
7. **Productos inactivos**: No aparecen en las páginas públicas pero sí en el admin.
8. **Botón "Comprar en línea"**: En la vista pública, solo se muestra si `url_tienda` tiene valor.
9. **Cascade**: Al eliminar registros de las tablas de catálogo (categorías, tamaños, colores), los registros pivot se eliminan automáticamente. Los productos en sí NO se eliminan (son muchos-a-muchos).

---

## Policy: `ProductoPolicy`

| Método | Permiso Spatie | Lógica adicional |
|--------|---------------|-----------------|
| `viewAny` | `productos.ver` | — |
| `view` | `productos.ver` | — |
| `create` | `productos.crear` | — |
| `update` | `productos.editar` | — |
| `delete` | `productos.eliminar` | — |
