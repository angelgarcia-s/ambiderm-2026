# ISSUE-021 — SeccionesContenidoSeeder

**ADR:** [ADR-002](../adr/ADR-002-cms-paginas-publicas.md)
**Agente:** Backend
**Branch:** `feature/adr002-cms-paginas-publicas`
**Estado:** Pendiente
**Depende de:** ISSUE-020

---

## Descripción

Crear el seeder `SeccionesContenidoSeeder` que puebla la tabla `secciones_contenido` con las 15 secciones definidas en el ADR-002, usando el contenido actual hardcodeado de las vistas Blade como datos iniciales. El seeder debe ser idempotente.

---

## Criterios de aceptación

- [ ] Existe `database/seeders/SeccionesContenidoSeeder.php`
- [ ] El seeder crea 15 registros (6 home + 5 nosotros + 4 footer)
- [ ] Cada registro tiene `pagina`, `seccion`, `titulo_admin`, `contenido` (JSON), `orden`, `activo`
- [ ] El JSON de cada sección coincide con la estructura definida en ADR-002
- [ ] El seeder usa `updateOrCreate` por `['pagina' => ..., 'seccion' => ...]` — es idempotente
- [ ] El seeder está registrado en `DatabaseSeeder::run()`
- [ ] `php artisan db:seed --class=SeccionesContenidoSeeder` ejecuta sin errores
- [ ] Ejecutar el seeder dos veces NO duplica registros

---

## Secciones a crear

| Página | Sección | titulo_admin | Orden |
|--------|---------|-------------|-------|
| `home` | `hero` | Hero — Página de Inicio | 1 |
| `home` | `video_feature` | Producto Destacado (Video) | 2 |
| `home` | `coleccion` | La Colección (Encabezado) | 3 |
| `home` | `soluciones_medicas` | Soluciones Médicas | 4 |
| `home` | `eco_friendly` | Eco-Friendly | 5 |
| `home` | `youtube_video` | Video YouTube | 6 |
| `nosotros` | `hero` | Hero — Nosotros | 1 |
| `nosotros` | `historia` | Nuestra Historia | 2 |
| `nosotros` | `mision` | Misión | 3 |
| `nosotros` | `vision` | Visión | 4 |
| `nosotros` | `valores` | Nuestros Valores | 5 |
| `footer` | `redes_sociales` | Redes Sociales y Logo | 1 |
| `footer` | `sucursales` | Sucursales / Ubicaciones | 2 |
| `footer` | `contacto` | Contacto y Distribuidor | 3 |
| `footer` | `copyright` | Copyright y Links Legales | 4 |

---

## Archivos a crear/modificar

| Acción | Archivo |
|--------|---------|
| CREAR | `database/seeders/SeccionesContenidoSeeder.php` |
| MODIFICAR | `database/seeders/DatabaseSeeder.php` — registrar el seeder |

---

## Notas de implementación

- Los valores JSON de cada sección están definidos en la sección "Estructura JSON por sección" del ADR-002
- Usar `updateOrCreate` con key `['pagina', 'seccion']` para idempotencia
- El field `contenido` se pasa como array PHP — Eloquent lo castea a JSON automáticamente
- Los campos HTML (como `historia.parrafos`, `mision.texto`) se almacenan tal cual con las clases Tailwind inline
