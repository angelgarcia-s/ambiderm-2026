# Contract: Color

**ADR:** ADR-003
**Modelo:** `App\Models\Color`
**Tabla:** `colores`

---

## Campos

| Campo | Tipo PHP | Cast | Fillable | Reglas de validación |
|-------|----------|------|----------|---------------------|
| `id` | int | — | NO | — |
| `nombre` | string | — | SÍ | `required|string|max:50|unique:colores,nombre` |
| `hex` | string | — | SÍ | `required|string|regex:/^#[0-9A-Fa-f]{6}$/` |
| `icono` | ?string | — | SÍ | `nullable|string|max:255` |
| `orden` | int | integer | SÍ | `integer|min:0` |

---

## Relaciones

| Método | Tipo | Modelo relacionado | Pivot |
|--------|------|-------------------|-------|
| `productos()` | belongsToMany | `Producto` | `color_producto` con campo `imagen` |

---

## Scopes

| Scope | Query |
|-------|-------|
| `scopeOrdenado($q)` | `$q->orderBy('orden')->orderBy('nombre')` |

---

## Reglas de negocio

1. **Nombre único**: No puede haber dos colores con el mismo nombre.
2. **Hex válido**: Debe ser un código hexadecimal de 7 caracteres (#RRGGBB).
3. **No eliminar con productos**: Un color no se puede eliminar si está asignado a algún producto (`productos()->count() > 0`).
4. **Sin permisos propios**: Se gestiona bajo permisos `productos.*`.
5. **Icono**: Opcional. Si existe, se muestra en lugar del círculo hex. Fallback: icono → círculo hex.
6. **Imágenes de icono**: Se almacenan en `storage/app/public/colores/`.
7. **Imagen por variante**: En la tabla pivot `color_producto`, el campo `imagen` almacena la imagen específica del producto en ese color. Se muestra al seleccionar el color en el detalle público.
