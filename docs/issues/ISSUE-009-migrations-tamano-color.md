# ISSUE-009 — Migrations + Models Tamano y Color

**ADR:** ADR-003
**Tipo:** Backend
**Prioridad:** Alta (prerequisito de ISSUE-010)
**Contracts:** [Tamano.md](../contracts/Tamano.md), [Color.md](../contracts/Color.md)

---

## Descripción

Crear las migraciones y modelos para las tablas catálogo `tamanos` y `colores`, que serán usadas como relaciones many-to-many con productos.

---

## Tareas

### Tabla `tamanos`

1. **Migración** `create_tamanos_table`
   - Campos: `nombre` string(50) unique, `abreviatura` string(10) nullable, `icono` string(255) nullable, `orden` unsignedInteger default 0
   - Índice: `unique(nombre)`
   - Timestamps

2. **Modelo** `App\Models\Tamano`
   - `$table = 'tamanos'`
   - `$fillable`: nombre, abreviatura, icono, orden
   - `$casts`: `orden` → integer
   - Relación: `productos()` → belongsToMany(Producto::class, 'producto_tamano')
   - Scope: `scopeOrdenado()`

### Tabla `colores`

3. **Migración** `create_colores_table`
   - Campos: `nombre` string(50) unique, `hex` string(7), `icono` string(255) nullable, `orden` unsignedInteger default 0
   - Índice: `unique(nombre)`
   - Timestamps

4. **Modelo** `App\Models\Color`
   - `$table = 'colores'`
   - `$fillable`: nombre, hex, icono, orden
   - `$casts`: `orden` → integer
   - Relación: `productos()` → belongsToMany(Producto::class, 'color_producto')->withPivot('imagen')
   - Scope: `scopeOrdenado()`

---

## Criterios de aceptación

- [ ] `php artisan migrate` ejecuta ambas tablas sin error
- [ ] `Tamano::ordenado()->get()` retorna tamaños ordenados
- [ ] `Color::ordenado()->get()` retorna colores ordenados
- [ ] Los nombres son únicos en ambas tablas
- [ ] Todos los campos están en español
