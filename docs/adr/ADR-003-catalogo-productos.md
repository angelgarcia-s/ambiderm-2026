# ADR-003 — Catálogo de Productos (CMS Admin)

**Estado:** Aprobado
**Fecha:** 2026-03-01
**Autor:** Agent.Orchestrator
**Branch:** `feature/adr003-catalogo-productos`

---

## Contexto

El sitio público de Ambiderm muestra un catálogo de guantes y productos desechables que actualmente está hardcodeado en Blade. El objetivo de este ADR es crear un CMS en el panel de administración que permita gestionar Categorías, Productos, Tamaños y Colores desde la UI, y que las páginas públicas consuman estos datos dinámicamente desde la base de datos.

### Estado actual
- 5 páginas públicas en Blade puro (home, nosotros, productos, detalle, guantes vinyl)
- Productos hardcodeados con imágenes de `ambiderm.com.mx/storage/productos/`
- Categorías como filtros client-side: Guantes, Dental (las demás apuntan al sitio actual)
- Panel admin con Usuarios, Roles y Permisos (ADR-001 completado)
- El seeder ya tiene permisos `productos.*` reservados desde ADR-001

---

## Decisión

### Módulos del admin a implementar

| Módulo | Tipo | Ruta admin | Descripción |
|--------|------|-----------|-------------|
| Categorías | CRUD completo (Livewire) | `/admin/categorias` | Gestión de categorías de productos |
| Tamaños | CRUD completo (Livewire) | `/admin/tamanos` | Catálogo de tallas (XS, S, M, L, etc.) |
| Colores | CRUD completo (Livewire) | `/admin/colores` | Catálogo de colores con hex |
| Productos | CRUD completo (Livewire) | `/admin/productos` | Gestión del catálogo de productos |

### Páginas públicas que consumirán datos dinámicos

| Ruta pública | Vista | Cambio |
|-------------|-------|--------|
| `/productos` | `productos-ambiderm.blade.php` | Listado dinámico desde DB con filtro por categoría |
| `/productos/{slug}` | `producto-detalle.blade.php` | Detalle dinámico de un producto por slug |

> Las demás páginas públicas (home, nosotros, vinyl) no cambian en este ADR.

---

## Modelo de Datos

### Tabla: `categorias`

| Campo | Tipo | Nullable | Default | Descripción |
|-------|------|----------|---------|-------------|
| `id` | bigIncrements | — | — | PK |
| `nombre` | string(100) | NO | — | Nombre visible (ej: "Guantes", "Dental") |
| `slug` | string(120) | NO | — | URL-friendly, único (ej: "guantes", "dental") |
| `descripcion` | text | SÍ | null | Descripción opcional de la categoría |
| `imagen` | string(255) | SÍ | null | Ruta de imagen representativa |
| `activo` | boolean | NO | true | Si la categoría está visible en el público |
| `orden` | unsignedInteger | NO | 0 | Orden de aparición |
| `created_at` | timestamp | — | — | — |
| `updated_at` | timestamp | — | — | — |

**Índices:** `unique(slug)`, `index(activo, orden)`

---

### Tabla: `tamanos`

| Campo | Tipo | Nullable | Default | Descripción |
|-------|------|----------|---------|-------------|
| `id` | bigIncrements | — | — | PK |
| `nombre` | string(50) | NO | — | Nombre completo (ej: "Extra Chico", "Mediano", "Grande") |
| `abreviatura` | string(10) | SÍ | null | Abreviatura (ej: "XS", "S", "M", "L") |
| `icono` | string(255) | SÍ | null | Ruta de imagen/icono representativo del tamaño |
| `orden` | unsignedInteger | NO | 0 | Orden de aparición |
| `created_at` | timestamp | — | — | — |
| `updated_at` | timestamp | — | — | — |

**Índices:** `unique(nombre)`

---

### Tabla: `colores`

| Campo | Tipo | Nullable | Default | Descripción |
|-------|------|----------|---------|-------------|
| `id` | bigIncrements | — | — | PK |
| `nombre` | string(50) | NO | — | Nombre del color (ej: "Azul", "Rosa", "Negro") |
| `hex` | string(7) | NO | — | Código hexadecimal (ej: "#37b5e5") |
| `icono` | string(255) | SÍ | null | Ruta de imagen/icono representativo del color |
| `orden` | unsignedInteger | NO | 0 | Orden de aparición |
| `created_at` | timestamp | — | — | — |
| `updated_at` | timestamp | — | — | — |

**Índices:** `unique(nombre)`

---

### Tabla: `productos`

| Campo | Tipo | Nullable | Default | Descripción |
|-------|------|----------|---------|-------------|
| `id` | bigIncrements | — | — | PK |
| `nombre` | string(150) | NO | — | Nombre del producto (ej: "Colorfull") |
| `slug` | string(170) | NO | — | URL-friendly, único (ej: "colorfull") |
| `subtitulo` | string(255) | SÍ | null | Subtítulo (ej: "Guantes de látex para exploración") |
| `material` | string(80) | SÍ | null | Material principal (ej: "Látex", "Nitrilo", "Vinyl") |
| `descripcion` | text | SÍ | null | Descripción larga del producto |
| `imagen` | string(255) | SÍ | null | Imagen principal del producto |
| `caracteristicas` | json | SÍ | null | Array de características (ej: `["No estéril", "Ambidiestro"]`) |
| `etiquetas` | json | SÍ | null | Badges/tags (ej: `["Más Vendido", "Nuevo"]`) |
| `presentacion` | text | SÍ | null | Info de presentación (junior/master) |
| `certificaciones` | text | SÍ | null | Normas y certificaciones |
| `url_tienda` | string(255) | SÍ | null | Link a tienda en línea (shop.ambiderm.com.mx) |
| `url_ficha_tecnica` | string(255) | SÍ | null | Link a ficha técnica PDF |
| `activo` | boolean | NO | true | Si el producto se muestra en el público |
| `destacado` | boolean | NO | false | Si aparece destacado (home, banners) |
| `orden` | unsignedInteger | NO | 0 | Orden de aparición |
| `created_at` | timestamp | — | — | — |
| `updated_at` | timestamp | — | — | — |

**Índices:** `unique(slug)`, `index(activo, orden)`, `index(destacado)`

---

### Tabla pivot: `categoria_producto`

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | bigIncrements | PK |
| `categoria_id` | foreignId | FK → `categorias.id` cascadeOnDelete |
| `producto_id` | foreignId | FK → `productos.id` cascadeOnDelete |

**Índices:** `unique(categoria_id, producto_id)`

> Un producto puede pertenecer a múltiples categorías (ej: un guante puede estar en "Guantes" y en "Dental").

---

### Tabla pivot: `producto_tamano`

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | bigIncrements | PK |
| `producto_id` | foreignId | FK → `productos.id` cascadeOnDelete |
| `tamano_id` | foreignId | FK → `tamanos.id` cascadeOnDelete |

**Índices:** `unique(producto_id, tamano_id)`

> Un producto puede tener múltiples tamaños del catálogo.

---

### Tabla pivot: `color_producto`

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | bigIncrements | PK |
| `color_id` | foreignId | FK → `colores.id` cascadeOnDelete |
| `producto_id` | foreignId | FK → `productos.id` cascadeOnDelete |
| `imagen` | string(255) nullable | Imagen específica del producto en este color |

**Índices:** `unique(color_id, producto_id)`

> Cada relación color-producto puede tener una imagen específica que se muestra al seleccionar ese color en el detalle del producto.

---

### Relaciones

```
Categoria  belongsToMany  Producto  (pivot: categoria_producto)
Producto   belongsToMany  Categoria (pivot: categoria_producto)
Producto   belongsToMany  Tamano    (pivot: producto_tamano)
Producto   belongsToMany  Color     (pivot: color_producto, con campo: imagen)
Tamano     belongsToMany  Producto  (pivot: producto_tamano)
Color      belongsToMany  Producto  (pivot: color_producto, con campo: imagen)
```

### Decisiones sobre campos JSON vs. tablas separadas

| Campo | Decisión | Razón |
|-------|---------|-------|
| `categorias` | **Tabla + pivot many-to-many** | Un producto puede pertenecer a varias categorías |
| `tamanos` | **Tabla catálogo + pivot** | Catálogo reutilizable, NO hardcodeado |
| `colores` | **Tabla catálogo + pivot con imagen** | Catálogo reutilizable + imagen por variante |
| `caracteristicas` | JSON en productos | Lista simple de strings, no requiere queries independientes |
| `etiquetas` | JSON en productos | Badges visuales, no se filtran por ellas |

---

## Permisos

### Permisos existentes (ya en seeder — ADR-001)

```
productos.ver, productos.crear, productos.editar, productos.eliminar
```

### Permisos nuevos a agregar al seeder

```
categorias.ver, categorias.crear, categorias.editar, categorias.eliminar
```

> **Tamaños y Colores** no tienen permisos separados — se gestionan bajo los permisos de `productos.*`. Si puedes crear/editar productos, puedes gestionar los catálogos auxiliares.

### Asignación actualizada por rol

| Permiso | super_admin | admin | editor |
|---------|:-----------:|:-----:|:------:|
| `categorias.ver` | ✅ | ✅ | ✅ |
| `categorias.crear` | ✅ | ✅ | ❌ |
| `categorias.editar` | ✅ | ✅ | ❌ |
| `categorias.eliminar` | ✅ | ✅ | ❌ |
| `productos.ver` | ✅ | ✅ | ✅ |
| `productos.crear` | ✅ | ✅ | ❌ |
| `productos.editar` | ✅ | ✅ | ✅ |
| `productos.eliminar` | ✅ | ✅ | ❌ |

> `editor` puede ver categorías y ver/editar productos (y sus tamaños/colores), pero NO crear ni eliminar.

---

## Panel Admin — Vistas

### Categorías (`/admin/categorias`)

**Listado (Index)**
- Tabla con: nombre, slug, productos count, estado (activo/inactivo), orden
- Acciones: crear, editar, eliminar
- Eliminar solo si la categoría no tiene productos asociados

**Crear/Editar (Modal)**
- Campos: nombre, slug (auto-generado), descripción, imagen, activo, orden
- Validaciones: nombre required max:100, slug unique

### Tamaños (`/admin/tamanos`)

**Listado (Index)**
- Tabla con: nombre, abreviatura, orden, productos count
- Acciones: crear, editar, eliminar
- Eliminar solo si el tamaño no está asignado a ningún producto

**Crear/Editar (Modal)**
- Campos: nombre, abreviatura, icono (upload), orden
- Si tiene icono se muestra el icono; si no, se muestra la abreviatura; si tampoco tiene, el nombre
- Validaciones: nombre required unique max:50, abreviatura max:10

### Colores (`/admin/colores`)

**Listado (Index)**
- Tabla con: muestra de color (círculo hex), nombre, hex, orden, productos count
- Acciones: crear, editar, eliminar
- Eliminar solo si el color no está asignado a ningún producto

**Crear/Editar (Modal)**
- Campos: nombre, hex (color picker), icono (upload), orden
- Si tiene icono se muestra el icono; si no, se muestra el círculo con hex
- Validaciones: nombre required unique max:50, hex required regex:/^#[0-9A-Fa-f]{6}$/

### Productos (`/admin/productos`)

**Listado (Index)**
- Tabla con: imagen (thumb), nombre, categorías (badges), material, estado, destacado
- Filtro por categoría
- Buscador por nombre/material
- Acciones: crear, editar, eliminar

**Crear/Editar (Página dedicada)**
- Sección 1 — Info básica: nombre, slug (auto), subtitulo, material, descripcion
- Sección 2 — Categorías: checkboxes/select múltiple de categorías activas
- Sección 3 — Multimedia: imagen principal (upload), url_tienda, url_ficha_tecnica
- Sección 4 — Tamaños: checkboxes del catálogo de tamaños
- Sección 5 — Colores: checkboxes del catálogo de colores + upload de imagen por color
- Sección 6 — Especificaciones: caracteristicas (repeater), etiquetas (repeater)
- Sección 7 — Presentación: presentacion (textarea), certificaciones (textarea)
- Sección 8 — Visibilidad: activo, destacado, orden
- Validaciones: nombre required max:150, slug unique, al menos 1 categoría

---

## Páginas Públicas — Cambios

### `/productos` → Listado dinámico

**Antes:** HTML hardcodeado con `data-category` para filtrado JS.
**Después:** Controller que consulta productos activos de la DB.

- Ruta: `GET /productos` → `ProductosPublicController@index`
- Query: `Producto::active()->ordered()->with('categorias')->get()`
- Filtro por categoría vía query string: `/productos?categoria=guantes`
- Buscador server-side opcional (puede seguir siendo client-side)

### `/productos/{slug}` → Detalle dinámico

**Antes:** Página estática con datos de un solo producto hardcodeado.
**Después:** Controller que busca el producto por slug.

- Ruta: `GET /productos/{slug}` → `ProductosPublicController@show`
- Query: `Producto::where('slug', $slug)->active()->with(['categorias', 'tamanos', 'colores'])->firstOrFail()`
- Productos relacionados: mismas categorías, excluyendo el actual, limit 4
- **Botón "Comprar en línea"**: solo visible si `url_tienda` tiene valor

> La ruta actual `/producto-detalle` (sin slug) se reemplaza por `/productos/{slug}`.
> La ruta `/guantes-vynil` se elimina — será `/productos?categoria=guantes` filtrado.

---

## Sidebar Admin — Actualización

Se agrega un nuevo grupo "Catálogo" en el sidebar:

```blade
@canany(['categorias.ver', 'productos.ver'])
    <flux:sidebar.group heading="Catálogo" class="grid">
        @can('categorias.ver')
            <flux:sidebar.item icon="folder" ...>Categorías</flux:sidebar.item>
        @endcan
        @can('productos.ver')
            <flux:sidebar.item icon="package" ...>Productos</flux:sidebar.item>
        @endcan
        @can('productos.crear')
            <flux:sidebar.item icon="ruler" ...>Tamaños</flux:sidebar.item>
            <flux:sidebar.item icon="palette" ...>Colores</flux:sidebar.item>
        @endcan
    </flux:sidebar.group>
@endcanany
```

---

## Upload de Imágenes

- Storage disk: `public` (Laravel default)
- Path: `productos/{filename}` para imágenes de productos y variantes de color
- Path: `categorias/{filename}` para imágenes de categorías
- Symlink: `php artisan storage:link` (ya debería existir)
- Validación: max 2MB, formatos jpeg/png/webp
- En la vista pública se usa `Storage::url()` o `asset('storage/...')`

---

## Issues

### Backend

| Issue | Descripción |
|-------|-------------|
| [ISSUE-008](../issues/ISSUE-008-migration-model-categoria.md) | Migration + Model `Categoria` |
| [ISSUE-009](../issues/ISSUE-009-migrations-tamano-color.md) | Migrations + Models `Tamano` y `Color` |
| [ISSUE-010](../issues/ISSUE-010-migration-model-producto.md) | Migration + Model `Producto` + tablas pivot |
| [ISSUE-011](../issues/ISSUE-011-actualizar-seeder-permisos.md) | Actualizar `RolesAndPermissionsSeeder` con permisos de categorías |
| [ISSUE-012](../issues/ISSUE-012-categorias-controller-policy.md) | `CategoriasController` + `CategoriaPolicy` |
| [ISSUE-013](../issues/ISSUE-013-productos-controller-policy.md) | `ProductosController` + `ProductoPolicy` |
| [ISSUE-014](../issues/ISSUE-014-productos-public-controller.md) | `ProductosPublicController` — rutas públicas dinámicas |

### Frontend

| Issue | Descripción |
|-------|-------------|
| [ISSUE-015](../issues/ISSUE-015-categorias-livewire.md) | Livewire: CRUD de categorías en admin |
| [ISSUE-016](../issues/ISSUE-016-tamanos-colores-livewire.md) | Livewire: CRUD de tamaños y colores en admin |
| [ISSUE-017](../issues/ISSUE-017-productos-livewire.md) | Livewire: CRUD de productos en admin |
| [ISSUE-018](../issues/ISSUE-018-sidebar-catalogo.md) | Actualizar sidebar con grupo "Catálogo" |
| [ISSUE-019](../issues/ISSUE-019-vistas-publicas-dinamicas.md) | Conectar vistas públicas con datos de DB |

---

## Consecuencias

- Los productos dejan de estar hardcodeados — el admin controla qué se muestra en el sitio público.
- Se agregan 3 tablas de catálogo (`categorias`, `tamanos`, `colores`) y 3 tablas pivot.
- La relación Producto ↔ Categoría es **many-to-many** (un producto puede estar en varias categorías).
- Tamaños y Colores son catálogos reutilizables (no hardcodeados) con relaciones many-to-many.
- La tabla pivot `color_producto` incluye campo `imagen` para variantes visuales por color.
- Los campos JSON (`caracteristicas`, `etiquetas`) se mantienen solo para datos simples no consultables.
- La ruta `/producto-detalle` se reemplaza por `/productos/{slug}` (SEO-friendly).
- La ruta `/guantes-vynil` se elimina y se absorbe en `/productos?categoria=guantes`.
- El seeder se actualiza con 4 permisos nuevos de `categorias.*` — totalizando 18 permisos.
- El botón "Comprar en línea" solo se muestra si `url_tienda` tiene valor.

---

## Decisiones descartadas

| Alternativa | Razón de descarte |
|-------------|-------------------|
| Categorías 1:N (un producto = una categoría) | Requieren M:N — un guante puede ser "Guantes" y "Dental" |
| Tallas como JSON hardcodeado | Se necesita catálogo reutilizable y consistente entre productos |
| Colores como JSON hardcodeado | Se necesita catálogo reutilizable + imagen por variante de color |
| Tabla `product_variants` (SKU por talla/color) | Sobreingeniería — no hay inventario ni stock |
| Spatie Media Library para imágenes | Dependencia adicional innecesaria — upload básico de Laravel es suficiente |
| Permisos separados para tamaños/colores | Complejidad innecesaria — se gestionan bajo `productos.*` |
| Inertia/Vue para el admin | El proyecto usa Livewire + Flux — mantener consistencia |
