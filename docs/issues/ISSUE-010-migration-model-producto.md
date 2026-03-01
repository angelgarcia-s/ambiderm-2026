# ISSUE-010 — Migration + Model Producto + Tablas Pivot

**ADR:** ADR-003
**Tipo:** Backend
**Prioridad:** Alta (depende de ISSUE-008, ISSUE-009)
**Contract:** [Producto.md](../contracts/Producto.md)

---

## Descripción

Crear la migración para la tabla `productos`, las 3 tablas pivot (categoria_producto, producto_tamano, color_producto) y el modelo Eloquent `Producto` con relaciones many-to-many, scopes, casts y accessors.

---

## Tareas

### 1. Migración `create_productos_table`

Campos: `nombre` string(150), `slug` string(170) unique, `subtitulo` string(255) nullable, `material` string(80) nullable, `descripcion` text nullable, `imagen` string(255) nullable, `caracteristicas` json nullable, `etiquetas` json nullable, `presentacion` text nullable, `certificaciones` text nullable, `url_tienda` string(255) nullable, `url_ficha_tecnica` string(255) nullable, `activo` boolean default true, `destacado` boolean default false, `orden` unsignedInteger default 0

Índices: `unique(slug)`, `index(activo, orden)`, `index(destacado)`

### 2. Migración `create_categoria_producto_table`

- `categoria_id` foreignId → `categorias.id` cascadeOnDelete
- `producto_id` foreignId → `productos.id` cascadeOnDelete
- `unique(categoria_id, producto_id)`

### 3. Migración `create_producto_tamano_table`

- `producto_id` foreignId → `productos.id` cascadeOnDelete
- `tamano_id` foreignId → `tamanos.id` cascadeOnDelete
- `unique(producto_id, tamano_id)`

### 4. Migración `create_color_producto_table`

- `color_id` foreignId → `colores.id` cascadeOnDelete
- `producto_id` foreignId → `productos.id` cascadeOnDelete
- `imagen` string(255) nullable
- `unique(color_id, producto_id)`

### 5. Modelo `App\Models\Producto`

- `$table = 'productos'`
- `$fillable`: todos los campos según Contract
- `$casts`: `caracteristicas` → array, `etiquetas` → array, `activo` → boolean, `destacado` → boolean, `orden` → integer
- Relaciones:
  - `categorias()` → belongsToMany(Categoria::class, 'categoria_producto')
  - `tamanos()` → belongsToMany(Tamano::class, 'producto_tamano')
  - `colores()` → belongsToMany(Color::class, 'color_producto')->withPivot('imagen')
- Scopes: `scopeActivo()`, `scopeDestacado()`, `scopeOrdenado()`, `scopeDeCategoria($slug)`
- Accessor: `imagen_url` → `Storage::url($this->imagen)` si imagen existe
- Boot: auto-generar slug desde `nombre`

---

## Criterios de aceptación

- [ ] `php artisan migrate` ejecuta todas las tablas y pivots sin error
- [ ] `Producto::activo()->destacado()->ordenado()->get()` funciona
- [ ] `Producto::deCategoria('guantes')->get()` filtra por slug de categoría
- [ ] `$producto->categorias` retorna colección de Categoria
- [ ] `$producto->tamanos` retorna colección de Tamano
- [ ] `$producto->colores` retorna colección de Color con `pivot->imagen`
- [ ] Al eliminar una categoría, solo se eliminan los registros pivot (NO los productos)
- [ ] Todos los campos están en español
