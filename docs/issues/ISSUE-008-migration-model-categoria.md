# ISSUE-008 — Migration + Model Categoria

**ADR:** ADR-003
**Tipo:** Backend
**Prioridad:** Alta (prerequisito de ISSUE-010)
**Contract:** [Categoria.md](../contracts/Categoria.md)

---

## Descripción

Crear la migración para la tabla `categorias` y el modelo Eloquent `Categoria` con sus relaciones, scopes, casts y fillable según el Contract.

---

## Tareas

1. **Migración** `create_categorias_table`
   - Campos: `nombre` string(100), `slug` string(120) unique, `descripcion` text nullable, `imagen` string(255) nullable, `activo` boolean default true, `orden` unsignedInteger default 0
   - Índices: `unique(slug)`, `index(activo, orden)`
   - Timestamps

2. **Modelo** `App\Models\Categoria`
   - `$table = 'categorias'`
   - `$fillable`: nombre, slug, descripcion, imagen, activo, orden
   - `$casts`: `activo` → boolean, `orden` → integer
   - Relación: `productos()` → belongsToMany(Producto::class, 'categoria_producto')
   - Scopes: `scopeActivo()`, `scopeOrdenado()`
   - Boot: auto-generar slug desde `nombre` si no se proporciona (`Str::slug()` en `creating`/`saving`)

---

## Criterios de aceptación

- [ ] `php artisan migrate` ejecuta sin error
- [ ] El modelo tiene los fillable, casts, relación y scopes definidos en el Contract
- [ ] El slug se auto-genera si se crea una Categoria sin slug explícito
- [ ] `Categoria::activo()->ordenado()->get()` retorna solo categorías activas ordenadas
- [ ] Todos los campos están en español
