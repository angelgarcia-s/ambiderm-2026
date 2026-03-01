# Contract: Tamano

**ADR:** ADR-003
**Modelo:** `App\Models\Tamano`
**Tabla:** `tamanos`

---

## Campos

| Campo | Tipo PHP | Cast | Fillable | Reglas de validación |
|-------|----------|------|----------|---------------------|
| `id` | int | — | NO | — |
| `nombre` | string | — | SÍ | `required|string|max:50|unique:tamanos,nombre` |
| `abreviatura` | ?string | — | SÍ | `nullable|string|max:10` |
| `icono` | ?string | — | SÍ | `nullable|string|max:255` |
| `orden` | int | integer | SÍ | `integer|min:0` |

---

## Relaciones

| Método | Tipo | Modelo relacionado | Pivot |
|--------|------|-------------------|-------|
| `productos()` | belongsToMany | `Producto` | `producto_tamano` |

---

## Scopes

| Scope | Query |
|-------|-------|
| `scopeOrdenado($q)` | `$q->orderBy('orden')->orderBy('nombre')` |

---

## Reglas de negocio

1. **Nombre único**: No puede haber dos tamaños con el mismo nombre.
2. **No eliminar con productos**: Un tamaño no se puede eliminar si está asignado a algún producto (`productos()->count() > 0`).
3. **Sin permisos propios**: Se gestiona bajo permisos `productos.*` — si puedes crear/editar productos, puedes gestionar tamaños.
4. **Abreviatura**: Opcional, se usa para display compacto (ej: "M" en lugar de "Mediano").
5. **Icono**: Opcional. Si existe, se muestra en lugar de la abreviatura. Fallback: icono → abreviatura → nombre.
6. **Imágenes de icono**: Se almacenan en `storage/app/public/tamanos/`.
