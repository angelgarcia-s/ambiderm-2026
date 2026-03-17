# ISSUE-028 — Fix `ContenidoService::obtenerPagina()` — fallback no reemplaza inactivas

**ADR:** [ADR-004](../adr/ADR-004-toggle-secciones-cms.md)
**Agente:** Backend
**Prioridad:** 2 de 4
**Rama:** `feature/adr004-toggle-secciones-cms`

---

## Descripción

Corregir el bug en `ContenidoService::obtenerPagina()` donde el loop de fallback inyecta un mock (con `activo = true`) para secciones que **existen en DB pero están inactivas**, en lugar de solo hacerlo para secciones que **no existen en absoluto**.

### Bug actual

```php
// El scope excluye las inactivas → $secciones solo tiene las activas
$secciones = SeccionContenido::pagina($pagina)->get()->keyBy('seccion');

// El loop comprueba si $secciones (solo activas) tiene la clave
// Si una sección existe en DB con activo=false, NO está en $secciones
// → el loop la inyecta como mock con activo=true y contenido vacío ← BUG
foreach (self::$defaults[$pagina] ?? [] as $seccion => $contenido) {
    if (! $secciones->has($seccion)) {  // ← compara contra activas solamente
        $secciones->put($seccion, $mock);
    }
}
```

### Fix requerido

Comparar contra **todas las secciones existentes en DB** (activas e inactivas), no solo las activas.

---

## Criterios de aceptación

- [ ] El fallback solo se aplica a secciones que NO existen como registro en `secciones_contenido`
- [ ] Una sección con `activo = false` en DB NO es reemplazada por un mock en el resultado
- [ ] Una sección que nunca fue creada en DB sigue recibiendo el fallback (comportamiento actual para secciones nuevas)
- [ ] El resultado de `obtenerPagina()` no incluye la sección inactiva — `$secciones->has('hero')` retorna `false` si el hero está desactivado

---

## Implementación esperada

**Archivo:** `app/Services/ContenidoService.php`

```php
public static function obtenerPagina(string $pagina): Collection
{
    $cacheKey = "contenido.{$pagina}";

    return cache()->remember($cacheKey, now()->addHours(24), function () use ($pagina) {
        // Solo secciones activas (las que se renderizan)
        $secciones = SeccionContenido::pagina($pagina)->get()->keyBy('seccion');

        // IDs de secciones que EXISTEN en DB (activas o inactivas)
        // para no inyectar fallback sobre inactivas
        $existentesEnDB = SeccionContenido::where('pagina', $pagina)
            ->pluck('seccion')
            ->toArray();

        // Fallback solo para secciones que nunca fueron creadas en DB
        foreach (self::$defaults[$pagina] ?? [] as $seccion => $contenido) {
            if (! in_array($seccion, $existentesEnDB)) {
                $mock = new SeccionContenido([
                    'pagina'        => $pagina,
                    'seccion'       => $seccion,
                    'titulo_admin'  => ucfirst(str_replace('_', ' ', $seccion)),
                    'contenido'     => $contenido,
                    'orden'         => 99,
                    'activo'        => true,
                ]);
                $secciones->put($seccion, $mock);
            }
        }

        return $secciones;
    });
}
```

---

## Notas

- La segunda query (`pluck('seccion')`) es ligera: solo trae una columna de máximo ~15 filas
- La caché encapsula ambas queries — el overhead es solo en el primer hit
- Este fix no cambia el comportamiento observable cuando todas las secciones están activas
