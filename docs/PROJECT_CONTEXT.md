# PROJECT_CONTEXT — Ambiderm 2026

**Última actualización:** 2026-03-02
**Responsable:** Agent.Context
**Estado del proyecto:** ADR-001, ADR-002 y ADR-003 mergeados a main — panel admin con Usuarios/Roles/Permisos, CMS Páginas Públicas y Catálogo de Productos implementados

---

## 1. ¿Qué es Ambiderm?

**Ambiderm** es una empresa 100% mexicana con más de 30 años de trayectoria en la fabricación y comercialización de **guantes y productos desechables para el sector médico**.

- **Dominio actual:** ambiderm.com.mx
- **Tienda en línea:** shop.ambiderm.com.mx
- **Posicionamiento:** Líder nacional en su categoría

### Líneas de producto
| Línea | Descripción |
|-------|-------------|
| **Guantes de látex** | Fabricados con látex natural (Hevea Brasiliensis); mayor elasticidad y protección |
| **Guantes de nitrilo** | Alternativa sintética; resistencia química superior |
| **Guantes de vinyl** | Económicos; uso general y de bajo riesgo |
| **Dental** | Insumos especializados para clínicas dentales |
| **Insumos médicos** | Productos complementarios para el sector salud |
| **Ropa médica** | Prendas de protección y uso clínico |

---

## 2. ¿Qué es este proyecto?

**Ambiderm 2026** es el rediseño completo del sitio web corporativo, migrado de HTML estático a una aplicación Laravel con panel de administración.

### Objetivos
1. **Sitio público** modernizado — imagen premium "Apple-inspired", velocidad y SEO
2. **Panel de administración** — gestión interna de contenido, productos, usuarios y roles
3. **Base escalable** — arquitectura que permita agregar features sin deuda técnica

---

## 3. Stack tecnológico

| Capa | Tecnología | Versión |
|------|-----------|---------|
| Framework PHP | Laravel | 12.x |
| UI Server-Side | Livewire | 4.x |
| Componentes UI | Flux UI (by Livewire) | 2.9.x |
| Auth | Laravel Fortify | 1.30.x |
| Permisos | Spatie laravel-permission | 7.2.x |
| CSS | Tailwind CSS | 4.x (Vite plugin) |
| Build | Vite | 7.x |
| DB (producción) | MySQL | — |
| Iconos (público) | Lucide Icons | CDN |
| Iconos (admin) | Flux Icons (Heroicons) | — |

---

## 4. Arquitectura

### Estructura de la aplicación

```
app/
├── Actions/Fortify/              # Acciones de autenticación
├── Concerns/                     # Traits de validación
├── Http/Controllers/
│   ├── Controller.php            # Base controller
│   ├── HomeController.php        # Página inicio — usa ContenidoService
│   ├── NosotrosController.php    # Página nosotros — usa ContenidoService
│   ├── ProductosPublicController.php  # Catálogo público — Producto + Categoria
│   └── Admin/
│       ├── UsuariosController.php     # CRUD usuarios
│       ├── RolesController.php        # CRUD roles
│       ├── PermisosController.php     # Read-only permisos
│       ├── CategoriasController.php   # CRUD categorías (ADR-003)
│       ├── ProductosController.php    # CRUD productos (ADR-003)
│       ├── ColoresController.php      # CRUD colores (ADR-003)
│       ├── TamanosController.php      # CRUD tamaños (ADR-003)
│       └── PaginasController.php      # Index/Edit secciones CMS (ADR-002)
├── Livewire/
│   ├── Actions/Logout.php
│   └── Admin/
│       ├── Usuarios/Index.php         # CRUD usuarios con roles
│       ├── Roles/
│       │   ├── Index.php              # Listado + crear + eliminar roles
│       │   └── Edit.php               # Editar rol + checkboxes permisos
│       ├── Permisos/Index.php         # Read-only agrupado por módulo
│       ├── Categorias/Index.php       # CRUD categorías
│       ├── Productos/
│       │   ├── Index.php              # Listado productos con filtros
│       │   └── Form.php               # Crear/Editar producto
│       ├── Colores/Index.php          # CRUD colores
│       ├── Tamanos/Index.php          # CRUD tamaños
│       └── Paginas/
│           ├── Index.php              # Listado secciones agrupadas por página
│           └── EditSeccion.php        # Editor JSON con form partials por sección
├── Models/
│   ├── User.php               # HasRoles (Spatie)
│   ├── Categoria.php          # Modelo categorías de productos
│   ├── Producto.php           # Modelo productos con relaciones
│   ├── Color.php              # Catálogo colores
│   ├── Tamano.php             # Catálogo tamaños
│   └── SeccionContenido.php   # CMS — JSON contenido, scope pagina(), obtener()
├── Policies/
│   ├── UserPolicy.php
│   ├── RolePolicy.php
│   ├── CategoriaPolicy.php
│   ├── ProductoPolicy.php
│   └── SeccionContenidoPolicy.php
├── Services/
│   └── ContenidoService.php   # Cache 24h, obtener(), obtenerPagina(), fallback por defecto
└── Providers/
    ├── AppServiceProvider.php
    └── FortifyServiceProvider.php

database/
├── migrations/
│   ├── ...create_users_table.php
│   ├── ...create_permission_tables.php
│   ├── ...create_categorias_table.php
│   ├── ...create_colores_table.php
│   ├── ...create_tamanos_table.php
│   ├── ...create_productos_table.php
│   ├── ...create_producto_color_table.php
│   ├── ...create_producto_tamano_table.php
│   └── ...create_secciones_contenido_table.php
├── seeders/
│   ├── DatabaseSeeder.php
│   ├── RolesAndPermissionsSeeder.php    # 3 roles, 22 permisos, idempotente
│   └── SeccionesContenidoSeeder.php     # 15 secciones CMS (home/nosotros/footer)

resources/views/
├── layouts/
│   ├── app/
│   │   ├── sidebar.blade.php  # Sidebar con @can guards (Panel, Administración, Catálogo, Contenido)
│   │   └── header.blade.php
│   ├── app.blade.php          # Layout panel admin (Flux sidebar)
│   └── auth.blade.php         # Layout autenticación
├── components/layouts/
│   └── public.blade.php       # Layout compartido vistas públicas (nav, chatbot, lenis, JS)
├── admin/                     # Wrappers Livewire (categorias, colores, paginas, permisos, productos, roles, tamanos, usuarios)
├── livewire/admin/
│   ├── categorias/index.blade.php
│   ├── colores/index.blade.php
│   ├── tamanos/index.blade.php
│   ├── productos/
│   │   ├── index.blade.php
│   │   └── form.blade.php
│   ├── paginas/
│   │   ├── index.blade.php
│   │   ├── edit-seccion.blade.php
│   │   └── forms/             # 16 partials: home-hero, home-video-feature, home-coleccion,
│   │       │                  #   home-soluciones-medicas, home-eco-friendly, home-youtube-video,
│   │       │                  #   nosotros-hero, nosotros-historia, nosotros-mision, nosotros-vision,
│   │       │                  #   nosotros-valores, footer-redes-sociales, footer-sucursales,
│   │       │                  #   footer-contacto, footer-copyright, generic
│   ├── permisos/index.blade.php
│   ├── roles/
│   │   ├── index.blade.php
│   │   └── edit.blade.php
│   └── usuarios/index.blade.php
├── partials/
│   ├── footer.blade.php       # Footer compartido dinámico ($footer CMS)
│   └── head.blade.php
├── home.blade.php             # Página inicio — dinámico, $secciones CMS
├── acerca-de.blade.php        # Página nosotros — dinámico, $secciones CMS
├── productos-ambiderm.blade.php   # Catálogo público (ADR-003)
├── producto-detalle.blade.php     # Detalle de producto (ADR-003)
└── pages/
    ├── auth/                  # Login, register, 2FA, verify-email, etc.
    └── settings/              # Perfil, password, appearance, two-factor

routes/
├── web.php       # Rutas públicas + rutas admin (/admin/* auth + can middleware)
└── settings.php  # Rutas del panel de settings (auth)
```

### Patrones arquitectónicos
- **Sin módulos nwidart** — arquitectura plana estándar de Laravel
- **Livewire + Flux** para todas las vistas del panel admin
- **Blade puro** para páginas públicas (sin Livewire donde no se necesite interactividad)
- **Spatie Permission** para roles y permisos granulares
- **ContenidoService** — servicio estático con cache 24h y fallback automático para CMS

---

## 5. Estado actual (2026-03-02)

### Completado
| Feature | Descripción | Branch/Estado |
|---------|-------------|---------------|
| Infraestructura base | Laravel 12 + Livewire + Flux instalado | ✅ main |
| Autenticación | Login, registro, 2FA, recuperar password, verify email | ✅ main |
| Settings de usuario | Perfil, password, appearance, two-factor setup | ✅ main |
| Dashboard base | Vista placeholder (sin contenido real) | ✅ main (placeholder) |
| Rutas públicas | Páginas públicas con controllers y contenido dinámico CMS | ✅ main |
| Migration permisos | Tablas de Spatie creadas en DB | ✅ main |
| Brand tokens CSS | `@theme` en app.css con paleta completa de Ambiderm | ✅ main |
| Layout público compartido | `components/layouts/public.blade.php` con nav, chatbot, lenis | ✅ main |
| Migración CDN → Vite | Todas las vistas públicas usan pipeline Vite | ✅ main |
| **ADR-001 — Roles y Permisos** | 3 roles, 22 permisos, seeder idempotente | ✅ **main (PR #1)** |
| **Panel admin: Usuarios** | CRUD Livewire + UserPolicy + syncRoles | ✅ **main** |
| **Panel admin: Roles** | CRUD Livewire + RolePolicy + syncPermissions (checkboxes) | ✅ **main** |
| **Panel admin: Permisos** | Listado read-only Livewire agrupado por módulo | ✅ **main** |
| **ADR-002 — CMS Páginas Públicas** | 15 secciones editables, ContenidoService con cache y fallback | ✅ **main (PR #3)** |
| **Panel admin: Páginas** | Index agrupado por página + EditSeccion con 16 form partials | ✅ **main** |
| **Vistas públicas dinámicas** | home.blade.php, acerca-de.blade.php, footer.blade.php usan CMS | ✅ **main** |
| **ADR-003 — Catálogo de Productos** | CRUD productos, categorías, colores, tamaños | ✅ **main (PR #2)** |
| **Catálogo público** | ProductosPublicController con filtro por categoría | ✅ **main** |

### ADRs — Estado
| ADR | Descripción | Estado |
|-----|-------------|--------|
| ADR-001 | Sistema de roles y permisos (Spatie) | ✅ Completo — PR #1 mergeado |
| ADR-002 | CMS páginas públicas (contenido dinámico) | ✅ Completo — PR #3 mergeado |
| ADR-003 | Catálogo de productos (CRUD admin + público) | ✅ Completo — PR #2 mergeado |

---

## 6. Módulos del panel admin

### Implementados
```
/admin/usuarios          — CRUD de usuarios internos + asignación de rol (ADR-001)
/admin/roles             — CRUD de roles + asignación de permisos via checkboxes (ADR-001)
/admin/permisos          — Listado read-only agrupado por módulo (ADR-001)
/admin/categorias        — CRUD categorías de productos (ADR-003)
/admin/productos         — CRUD productos + crear/editar con form completo (ADR-003)
/admin/tamanos           — CRUD tamaños (ADR-003)
/admin/colores           — CRUD colores (ADR-003)
/admin/paginas           — Listado secciones CMS + edición por sección (ADR-002)
```

### Sidebar (4 grupos)
```
Panel         → Dashboard
Administración → Usuarios, Roles, Permisos
Catálogo      → Productos, Categorías, Tamaños, Colores
Contenido     → Páginas
```

### Sistema de permisos (22 permisos, 3 roles)
- Convención: `modulo.accion` (ej: `usuarios.crear`, `paginas.editar`)
- **Permisos son inmutables desde UI** — solo se crean/eliminan en `RolesAndPermissionsSeeder`
- **Asignación de permisos a roles sí es editable** desde `/admin/roles/{id}/edit`
- `super_admin` recibe todos los permisos automáticamente vía seeder
- `admin` recibe todos menos eliminar roles
- `editor` recibe: dashboard.ver, categorias.ver, productos.ver/editar, paginas.ver/editar
- Las Policies verifican permisos Spatie, no roles directamente

---

## 7. CMS — Contenido dinámico (ADR-002)

### Modelo `SeccionContenido`
- Tabla: `secciones_contenido`
- Columnas: `pagina`, `seccion` (unique pair), `titulo_admin`, `contenido` (JSON), `orden`, `activo`
- 15 secciones iniciales: 6 home + 5 nosotros + 4 footer

### ContenidoService
- `obtener(pagina, seccion)`: JSON de una sección (cache 24h)
- `obtenerPagina(pagina)`: Collection keyed por sección (cache 24h)
- `invalidarCache(pagina, seccion?)`: invalidación manual (se llama al guardar desde admin)
- **Fallback automático**: si una sección falta en DB, retorna mock `SeccionContenido` con contenido vacío

### Flujo de datos: DB → Cache → Controller → Vista
```
SeccionContenido (DB) → ContenidoService (cache 24h) → HomeController/NosotrosController
    → $secciones['hero']->contenido → {{ $hero['titulo'] }} en Blade
    → $footer['redes_sociales']->contenido → {{ $redes['logo'] }} en footer partial
```

---

## 8. Rutas

### Rutas públicas
| URL | Controller | Vista | Descripción |
|-----|-----------|-------|-------------|
| `/` | `HomeController@index` | `home.blade.php` | Página principal (CMS dinámico) |
| `/nosotros` | `NosotrosController@index` | `acerca-de.blade.php` | Historia y misión (CMS dinámico) |
| `/productos` | `ProductosPublicController@index` | `productos-ambiderm.blade.php` | Catálogo con filtro ?categoria= |
| `/productos/{slug}` | `ProductosPublicController@show` | `producto-detalle.blade.php` | Detalle de producto |
| `/producto-detalle` | redirect 301 → `/productos` | — | Legacy redirect |
| `/guantes-vynil` | redirect 301 → `/productos` | — | Legacy redirect |
| `/dashboard` | View | `dashboard.blade.php` | Panel admin (auth + verified) |

### Rutas admin (auth + verified + can middleware)
| URL | Controller | Permiso |
|-----|-----------|---------|
| `/admin/usuarios` | UsuariosController | (auth) |
| `/admin/roles` | RolesController | (auth) |
| `/admin/permisos` | PermisosController | `permisos.ver` |
| `/admin/categorias` | CategoriasController | `categorias.ver` |
| `/admin/productos` | ProductosController | `productos.ver` |
| `/admin/tamanos` | TamanosController | `productos.crear` |
| `/admin/colores` | ColoresController | `productos.crear` |
| `/admin/paginas` | PaginasController | `paginas.ver` |
| `/admin/paginas/{pagina}/{seccion}/editar` | PaginasController | `paginas.editar` |

---

## 9. Diseño y UI

### Estética del sitio público
- Inspiración: "Apple-inspired" — limpio, premium, minimalista
- Tipografía: **Inter** (bunny.net CDN)
- Colores principales (Tailwind v4 `@theme` tokens):
  - `brand-surface`: `#f5f5f7` — fondos alternos, hero sections
  - `brand-ink`: `#1d1d1f` — texto títulos, negro profundo
  - `brand-subtle`: `#86868b` — texto cuerpo, gris refinado
  - `brand-blue`: `#0071e3` — acción primaria, botones, links
  - `brand-blue-hover`: `#0077ed` — estado hover
- Animaciones: Intersection Observer (`.reveal`, `.reveal-fade-in`, `.reveal-scale-in`, `.reveal.active`)
- Smooth scroll: Lenis (`window.lenis` expuesto globalmente)
- Ver guía completa: [`_backup_static/GUIA_ESTILO.md`](../_backup_static/GUIA_ESTILO.md)

### Estética del panel admin
- Flux UI con tema dark/light automático
- Heroicons (via Flux) para iconografía admin
- Consistente con los defaults de Livewire Flux

---

## 10. Convenciones clave

- **Namespaces**: PSR-4, siempre mayúscula — `App\Models\User`, `App\Http\Controllers\...`
- **Commits**: En español — `feat(productos): se implementa CRUD (ADR-004)`
- **Branches**: Una por ADR — `feature/adr001-roles-permisos`
- **NO CDN en vistas nuevas**: Usar Vite pipeline para CSS/JS
- **Workflow**: Backend → revisión → Frontend → revisión → commit (solo con autorización de Angel)
