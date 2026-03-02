# ADR-002 — CMS de Páginas Públicas (Home y Acerca de)

**Estado:** Borrador
**Fecha:** 2026-03-01
**Autor:** Agent.Orchestrator
**Branch:** `feature/adr002-cms-paginas-publicas`

---

## Contexto

Las páginas públicas del sitio Ambiderm 2026 (Home y Acerca de) están actualmente servidas como Blade estático con contenido hardcodeado. El equipo de marketing y dirección necesita poder editar textos, imágenes, URLs y videos de estas páginas **sin intervención de un desarrollador**.

### Estado actual
- `home.blade.php` y `acerca-de.blade.php` renderizan contenido hardcodeado en Blade
- El layout público compartido (`components/layouts/public.blade.php`) maneja nav, chatbot y Lenis
- El footer con ubicaciones, redes sociales y formulario de contacto está duplicado en cada vista estática
- Panel admin tiene Usuarios, Roles y Permisos (ADR-001 completado)
- ADR-003 (Catálogo de Productos) completado — la sección "La Colección" del home consumirá datos de la tabla `productos` como atributo "Destacado"

### Secciones editables identificadas

**Página HOME** (`/`):
1. **Hero** — título, subtítulo, imagen hero
2. **Producto Destacado (Video Card)** — badge, nombre producto, descripción, video URL, texto CTA, URL CTA
3. **La Colección** — título, subtítulo (los productos vienen de DB vía ADR-003)
4. **Soluciones Médicas** — título, subtítulo, 4 tarjetas (etiqueta, título, imagen, URL)
5. **Eco-Friendly** — badge, título, párrafo principal, párrafo secundario, imagen
6. **Video YouTube** — ID del video de YouTube
7. **Footer compartido** — se comparte con todas las páginas públicas

**Página ACERCA DE** (`/nosotros`):
1. **Hero** — badge, título, subtítulo
2. **Historia** — imagen, año, etiqueta año, título, párrafos (HTML)
3. **Misión** — icono, título, texto
4. **Visión** — icono, título, texto
5. **Valores** — título, subtítulo, 3 tarjetas de valor (icono, título, texto)

**Footer compartido** (todas las páginas):
- Redes sociales (URLs de Instagram, Facebook)
- 4 sucursales (nombre, región, dirección, teléfono, URL mapa, imagen mapa)
- Sección contacto (título, subtítulo, URL distribuidor)
- Texto de copyright

---

## Decisión

### Estrategia: Tabla `secciones_contenido` con JSON flexible

Cada sección editable de cada página se almacena como un registro en una tabla de contenido. El campo `contenido` es JSON, cuya estructura varía según la sección. **Las vistas Blade definen el diseño y layout; la DB solo provee el contenido editable.**

Este enfoque es:
- **Simple** — una sola tabla, sin relaciones complejas
- **Flexible** — cada sección define su propio schema JSON
- **Performante** — se puede cachear por página completa
- **Mantenible** — el seeder define la estructura inicial; el admin solo edita valores

---

## Modelo de Datos

### Tabla: `secciones_contenido`

| Campo | Tipo | Nullable | Default | Descripción |
|-------|------|----------|---------|-------------|
| `id` | bigIncrements | — | — | PK |
| `pagina` | string(50) | NO | — | Identificador de la página (ej: `home`, `nosotros`, `footer`) |
| `seccion` | string(80) | NO | — | Identificador de la sección (ej: `hero`, `video_feature`, `mision`) |
| `titulo_admin` | string(150) | NO | — | Nombre legible para el panel admin (ej: "Hero — Página de Inicio") |
| `contenido` | json | NO | — | Datos editables de la sección |
| `orden` | unsignedInteger | NO | 0 | Orden de la sección dentro de la página |
| `activo` | boolean | NO | true | Si la sección se muestra en el público |
| `created_at` | timestamp | — | — | — |
| `updated_at` | timestamp | — | — | — |

**Índices:** `unique(pagina, seccion)`, `index(pagina, orden)`

---

### Estructura JSON por sección

#### HOME — `hero`
```json
{
  "titulo": "Ambiderm",
  "subtitulo": "Siente la diferencia. Seguridad clínica con tacto natural.",
  "imagen": "https://glucosacomunicacion.com/proyectos/ambiderm2026/colors.png",
  "imagen_alt": "Ambiderm Collection"
}
```

#### HOME — `video_feature`
```json
{
  "badge": "NUEVO",
  "nombre_producto": "Vynil Synmax",
  "descripcion": "Siente la revolución en protección clínica. Una nueva era de seguridad y confort táctil.",
  "video_url": "https://glucosacomunicacion.com/proyectos/ambiderm2026/vynil.mp4",
  "cta_texto": "Comprar ahora",
  "cta_url": "/productos"
}
```

#### HOME — `coleccion`
```json
{
  "titulo": "La Colección.",
  "subtitulo": "Encuentra el ajuste perfecto para ti.",
  "ver_todos_url": "https://ambiderm.com.mx/categoria/guantes",
  "ver_todos_texto": "Ver todos"
}
```

> **Nota:** Los productos del carrusel vendrán de la tabla `productos` (ADR-003) filtrando por `activo = true`. Este ADR solo gestiona el título/subtítulo de la sección.

#### HOME — `soluciones_medicas`
```json
{
  "titulo": "Soluciones médicas",
  "subtitulo": "Protección especializada para cada sector.",
  "items": [
    {
      "etiqueta": "Especialidad",
      "titulo": "Guantes",
      "imagen": "https://ambiderm.com.mx/img/new/guantes.png",
      "url": "https://ambiderm.com.mx/categoria/guantes"
    },
    {
      "etiqueta": "Especialidad",
      "titulo": "Dental",
      "imagen": "https://ambiderm.com.mx/img/new/dental.png",
      "url": "https://ambiderm.com.mx/categoria/dental"
    },
    {
      "etiqueta": "Indumentaria",
      "titulo": "Ropa Médica",
      "imagen": "https://ambiderm.com.mx/img/new/ropa.png",
      "url": "https://ambiderm.com.mx/categoria/ropa-medica"
    },
    {
      "etiqueta": "Esenciales",
      "titulo": "Insumos Médicos",
      "imagen": "https://ambiderm.com.mx/img/new/medico.png",
      "url": "https://ambiderm.com.mx/categoria/insumos-medicos"
    }
  ]
}
```

#### HOME — `eco_friendly`
```json
{
  "badge": "Responsabilidad Ambiental",
  "titulo": "100% LÁTEX NATURAL",
  "parrafo_principal": "Gracias a su composición de origen natural nuestros guantes de látex Ambiderm se reintegran de una manera más rápida reduciendo el impacto en el medio ambiente.",
  "parrafo_secundario": "Nuestros guantes están fabricados con látex natural, provenientes del árbol del hule (Hevea Brasiliensis), que brinda mayor elasticidad y protección a comparación de otros tipos de guantes.",
  "imagen": "https://ambiderm.com.mx/storage/productos/7OyCwjS7LYzZDXCWYYdEpHhnmjMjuigXOGnGIGmE.png",
  "icono": "https://ambiderm.com.mx/img/new/eco-friendly-icon.png"
}
```

#### HOME — `youtube_video`
```json
{
  "video_id": "DkVU_4Mir6Y"
}
```

#### NOSOTROS — `hero`
```json
{
  "badge": "Nuestra Esencia",
  "titulo": "Más de 30 años protegiéndote.",
  "subtitulo": "Innovación mexicana al servicio de la salud. Desde 1988, garantizamos seguridad y calidad en cada producto."
}
```

#### NOSOTROS — `historia`
```json
{
  "imagen": "https://ambiderm.com.mx/img/new/30-years-guantes.jpeg",
  "anio": "1988",
  "anio_etiqueta": "Fundación en México",
  "titulo": "Orgullosamente Mexicanos",
  "parrafos": "<p><strong class=\"text-[#1d1d1f]\">Ambiderm se fundó en 1988</strong>, iniciando operaciones como pioneros en la fabricación de guantes de látex en el país. Nuestra visión siempre fue clara: ofrecer productos que combinaran máxima protección con un confort excepcional.</p><p>En 1998, consolidamos nuestra fortaleza al fusionarnos con <strong class=\"text-[#1d1d1f]\">Supertex Industrial</strong>, creando un grupo sólido que hoy lidera el mercado nacional. Somos una empresa 100% mexicana, comprometida con el desarrollo de nuestra industria y el bienestar de quienes confían sus manos a nuestra tecnología.</p>"
}
```

#### NOSOTROS — `mision`
```json
{
  "icono": "target",
  "titulo": "Misión",
  "texto": "Ser líder nacional en la fabricación y comercialización de guantes y productos desechables para la industria dental y médica. Garantizamos la <strong class=\"text-blue-600\">segura protección, comodidad y mejor desempeño</strong> de nuestros usuarios, ofreciendo calidad superior y el mejor servicio a nuestros socios comerciales."
}
```

#### NOSOTROS — `vision`
```json
{
  "icono": "eye",
  "titulo": "Visión",
  "texto": "Ser la marca líder en guantes desechables <strong class=\"text-blue-600\">más confiable en México y Centroamérica</strong>, y el proveedor más completo de soluciones para la industria médica y dental. Buscamos trascender a través de la innovación y la confianza que generamos en cada procedimiento."
}
```

#### NOSOTROS — `valores`
```json
{
  "badge": "Nuestros Valores",
  "titulo": "Compromiso Total",
  "subtitulo": "Nos regimos por estándares internacionales para cuidar de ti y del planeta.",
  "items": [
    {
      "icono": "leaf",
      "titulo": "Eco-Friendly",
      "texto": "Nuestros guantes de látex natural se reintegran más rápido al medio ambiente, reduciendo la huella ecológica.",
      "color_bg": "bg-green-100",
      "color_text": "text-green-600"
    },
    {
      "icono": "award",
      "titulo": "Calidad Certificada",
      "texto": "Cumplimos con normas internacionales y contamos con certificaciones de la UNAM que validan nuestra seguridad.",
      "color_bg": "bg-blue-100",
      "color_text": "text-blue-600"
    },
    {
      "icono": "users",
      "titulo": "Capital Humano",
      "texto": "Contribuimos al desarrollo profesional de nuestros colaboradores y al crecimiento de las comunidades donde operamos.",
      "color_bg": "bg-purple-100",
      "color_text": "text-purple-600"
    }
  ]
}
```

#### FOOTER — `redes_sociales`
```json
{
  "logo": "https://ambiderm.com.mx/img/new/logo-ambiderm-azul.svg",
  "titulo": "SÍGUENOS EN REDES SOCIALES",
  "instagram_url": "https://www.instagram.com/ambiderm/?hl=es-la",
  "instagram_icono": "https://ambiderm.com.mx/img/new/instagram-icon.png",
  "facebook_url": "https://www.facebook.com/Ambiderm/",
  "facebook_icono": "https://ambiderm.com.mx/img/new/facebook-icon.png"
}
```

#### FOOTER — `sucursales`
```json
{
  "titulo": "UBICACIONES ESTRATÉGICAS",
  "items": [
    {
      "region": "Matriz",
      "nombre": "SAN ISIDRO",
      "direccion": "Carr. a Bosques de San Isidro No. 1136\nZapopan, Jalisco",
      "telefono": "+52 33 3656 6557",
      "mapa_url": "https://goo.gl/maps/kD76mn5gFhNue5X47",
      "mapa_imagen": "https://ambiderm.com.mx/img/new/mapas/gdl.png",
      "mapa_key": "gdl"
    },
    {
      "region": "Norte",
      "nombre": "TIJUANA",
      "direccion": "Calle Mariscal sucre No. 30 C\nFracc. Castro, Olivos",
      "telefono": "+52 664 608 1627",
      "mapa_url": "https://goo.gl/maps/PEStmVVbnVFVpMvH9",
      "mapa_imagen": "https://ambiderm.com.mx/img/new/mapas/tijuana.png",
      "mapa_key": "tijuana"
    },
    {
      "region": "Centro",
      "nombre": "COSTA RICA",
      "direccion": "La Valencia de Heredia,\nOficentro Tech Park",
      "telefono": "+506 2237 3377",
      "mapa_url": "https://goo.gl/maps/bCASmcuCuxvA9csg9",
      "mapa_imagen": "https://ambiderm.com.mx/img/new/mapas/costa-rica.png",
      "mapa_key": "costa-rica"
    },
    {
      "region": "Centro",
      "nombre": "GUATEMALA",
      "direccion": "Calzada Atanasio Tzul 22-00\nEmpresarial cortijo II",
      "telefono": "+502 2209 2000",
      "mapa_url": "https://goo.gl/maps/TNuRDPTZxkZqqU659",
      "mapa_imagen": "https://ambiderm.com.mx/img/new/mapas/guatemala.png",
      "mapa_key": "guatemala"
    }
  ]
}
```

#### FOOTER — `contacto`
```json
{
  "badge": "Mantenlo cerca",
  "titulo": "¿TIENES ALGUNA DUDA?",
  "subtitulo": "Déjanos un mensaje y un especialista se pondrá en contacto contigo a la brevedad.",
  "distribuidor_titulo": "QUIERO SER DISTRIBUIDOR",
  "distribuidor_subtitulo": "Únete a la red Ambiderm",
  "distribuidor_url": "https://share.hsforms.com/1vl6EkSEKQBW_SNv3Im1qcA3qrdx",
  "distribuidor_icono": "https://ambiderm.com.mx/img/new/distribuidor-icon.svg",
  "form_action_url": "https://ambiderm.com.mx/contacto-enviar",
  "email": "info@ambiderm.com.mx"
}
```

#### FOOTER — `copyright`
```json
{
  "texto": "COPYRIGHT © 2026 AMBIDERM S.A. DE C.V.",
  "subtexto": "TODOS LOS DERECHOS RESERVADOS",
  "links": [
    {"texto": "Términos", "url": "#"},
    {"texto": "Privacidad", "url": "#"},
    {"texto": "Cookies", "url": "#"},
    {"texto": "Bolsa de Trabajo", "url": "#"}
  ]
}
```

---

## Modelo Eloquent

### `SeccionContenido`

```php
namespace App\Models;

class SeccionContenido extends Model
{
    protected $table = 'secciones_contenido';

    protected $fillable = [
        'pagina', 'seccion', 'titulo_admin',
        'contenido', 'orden', 'activo',
    ];

    protected $casts = [
        'contenido' => 'array',
        'activo' => 'boolean',
    ];

    // Scopes
    public function scopePagina($query, string $pagina)
    {
        return $query->where('pagina', $pagina)->where('activo', true)->orderBy('orden');
    }

    // Helper: obtener una sección específica
    public static function obtener(string $pagina, string $seccion): ?array
    {
        $registro = static::where('pagina', $pagina)
            ->where('seccion', $seccion)
            ->where('activo', true)
            ->first();

        return $registro?->contenido;
    }
}
```

---

## Permisos

### Permisos nuevos a agregar al seeder

```
paginas.ver          — Ver listado de páginas y sus secciones
paginas.editar       — Editar contenido de las secciones
```

> No se necesitan `paginas.crear` ni `paginas.eliminar` — las secciones se crean/eliminan solo vía seeder.

### Asignación por rol

| Permiso | super_admin | admin | editor |
|---------|:-----------:|:-----:|:------:|
| `paginas.ver` | ✅ | ✅ | ✅ |
| `paginas.editar` | ✅ | ✅ | ✅ |

---

## Panel Admin — Módulos de este ADR

### Ruta admin

| Módulo | Ruta | Descripción |
|--------|------|-------------|
| Páginas (listado) | `/admin/paginas` | Listado de páginas con sus secciones editables |
| Editar sección | `/admin/paginas/{pagina}/{seccion}/editar` | Formulario dinámico para editar el JSON de una sección |

### UX del Editor

El editor del panel admin mostrará:

1. **Lista de páginas** — Home, Nosotros, Footer (compartido)
2. **Al hacer clic en una página** → listado de sus secciones con nombre legible (`titulo_admin`)
3. **Al hacer clic en una sección** → formulario con campos renderizados dinámicamente según la estructura del JSON:
   - Strings cortos → `<flux:input>`
   - Strings largos / HTML → `<flux:textarea>` o editor WYSIWYG básico
   - URLs → `<flux:input type="url">`
   - Imágenes → `<flux:input>` con preview + opción de subir archivo
   - Arrays de items → Formulario repetible (agregar/eliminar items)
   - Booleanos → `<flux:switch>`

> **Decisión clave:** El formulario NO se genera a partir del JSON dinámicamente. Cada sección tiene su propio componente Blade/Livewire con campos específicos y validación. Esto garantiza UX óptima y validación robusta.

---

## Servicio de Caché

Para evitar queries en cada request público:

```php
namespace App\Services;

class ContenidoService
{
    public static function obtener(string $pagina, string $seccion): array
    {
        $cacheKey = "contenido.{$pagina}.{$seccion}";

        return cache()->remember($cacheKey, now()->addHours(24), function () use ($pagina, $seccion) {
            return SeccionContenido::obtener($pagina, $seccion) ?? [];
        });
    }

    public static function obtenerPagina(string $pagina): Collection
    {
        $cacheKey = "contenido.{$pagina}";

        return cache()->remember($cacheKey, now()->addHours(24), function () use ($pagina) {
            return SeccionContenido::pagina($pagina)->get()->keyBy('seccion');
        });
    }

    public static function invalidarCache(string $pagina, ?string $seccion = null): void
    {
        if ($seccion) {
            cache()->forget("contenido.{$pagina}.{$seccion}");
        }
        cache()->forget("contenido.{$pagina}");
    }
}
```

> El caché se invalida automáticamente al guardar desde el panel admin.

---

## Controladores

### `PaginasController` (Admin)

```
App\Http\Controllers\Admin\PaginasController

index()  → Muestra las 3 páginas (home, nosotros, footer) y sus secciones
edit()   → Muestra el formulario de edición para una sección específica
```

> No necesita `create`, `store`, `destroy` — las secciones se administran solo vía el seeder.

### `HomeController` (Público) — refactor de Route::view

```
App\Http\Controllers\HomeController

index()  → Carga secciones de página 'home' + 'footer', pasa a vista
```

### `NosotrosController` (Público) — refactor de Route::view

```
App\Http\Controllers\NosotrosController

index()  → Carga secciones de página 'nosotros' + 'footer', pasa a vista
```

> Las rutas públicas dejan de ser `Route::view()` y pasan a usar controladores que inyectan el contenido dinámico.

---

## Policy

### `SeccionContenidoPolicy`

```php
viewAny()  → $user->can('paginas.ver')
update()   → $user->can('paginas.editar')
```

> No hay `create` ni `delete` — las secciones son inmutables desde la UI.

---

## Seeder

### `SeccionesContenidoSeeder`

El seeder crea todas las secciones con el contenido hardcodeado actual (extraído de las vistas Blade). Es **idempotente** (`updateOrCreate` por `pagina` + `seccion`).

Secciones a crear:

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

## Flujo de datos en vistas públicas

```
Request GET /
  → HomeController@index
    → ContenidoService::obtenerPagina('home')   ← caché 24h
    → ContenidoService::obtenerPagina('footer')  ← caché 24h
    → return view('home', compact('secciones', 'footer'))

Vista home.blade.php:
  {{ $secciones['hero']->contenido['titulo'] }}
  {{ $secciones['hero']->contenido['subtitulo'] }}
  ...etc
```

---

## Issues

### Backend

| Issue | Descripción |
|-------|-------------|
| ISSUE-020 | Migration `secciones_contenido` + Modelo `SeccionContenido` + scopes + casts |
| ISSUE-021 | `SeccionesContenidoSeeder` — poblar todas las secciones con contenido actual |
| ISSUE-022 | Actualizar `RolesAndPermissionsSeeder` — agregar permisos `paginas.ver`, `paginas.editar` |
| ISSUE-023 | `ContenidoService` — servicio con caché para obtener/invalidar contenido |
| ISSUE-024 | `PaginasController` (admin) + `SeccionContenidoPolicy` |
| ISSUE-025 | `HomeController` + `NosotrosController` (públicos) — refactorizar de `Route::view` a controladores con datos dinámicos |
| ISSUE-026 | Refactorizar footer a partial compartido que consume datos de `footer.*` |

### Frontend

| Issue | Descripción |
|-------|-------------|
| ISSUE-027 | Livewire: `Admin\Paginas\Index` — listado de páginas y sus secciones |
| ISSUE-028 | Livewire: `Admin\Paginas\EditSeccion` — editor por sección con formularios específicos |
| ISSUE-029 | Refactorizar `home.blade.php` — reemplazar hardcoded por `$secciones[...]->contenido[...]` |
| ISSUE-030 | Refactorizar `acerca-de.blade.php` — reemplazar hardcoded por `$secciones[...]->contenido[...]` |
| ISSUE-031 | Refactorizar footer compartido en layout público — consumir datos de `$footer` |
| ISSUE-032 | Sidebar admin — agregar enlace "Páginas" con guard `@can('paginas.ver')` |

---

## Consecuencias

- Todo el contenido visible en Home y Nosotros será editable sin deploy.
- El footer se convierte en un partial compartido que consume datos de DB, eliminando duplicación.
- Las vistas Blade mantienen el control total del diseño — el CMS solo gestiona los textos/imágenes/URLs.
- El seeder garantiza que siempre existan todas las secciones necesarias en cualquier entorno.
- El caché de 24h reduce queries a cero en producción; se invalida automáticamente al editar.
- Los campos HTML (como `historia.parrafos` y `mision.texto`) se renderizan con `{!! !!}` — el panel admin debe sanitizar el input.

---

## Decisiones descartadas

| Alternativa | Razón de descarte |
|-------------|-------------------|
| Tabla key-value plana (`settings`) | Pierde la agrupación por sección; difícil de gestionar con arrays/objetos complejos como `sucursales.items` |
| Una tabla por sección (`home_hero`, `home_eco`, etc.) | Demasiadas tablas, todas con 1 solo registro; no escala si se agregan más páginas |
| CMS externo (Strapi, WordPress headless) | Complejidad excesiva; el contenido es estático y cambia rara vez |
| Formulario genérico auto-generado desde JSON schema | UX deficiente; los formularios específicos por sección garantizan mejor validación y experiencia |
| Filament / Nova como panel admin | El proyecto ya usa Livewire + Flux; agregar otro framework de admin sería redundante |

---

## Dependencias

| Depende de | Descripción |
|-----------|-------------|
| ADR-001 | Sistema de permisos Spatie — necesario para `paginas.ver` y `paginas.editar` |

| Es dependencia de | Descripción |
|-------------------|-------------|
| ADR-003 | La sección "La Colección" del home eventualmente mostrará productos de la DB en lugar de hardcoded |
