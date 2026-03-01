# PROJECT_CONTEXT — Ambiderm 2026

**Última actualización:** 2026-03-01
**Responsable:** Agent.Context
**Estado del proyecto:** ADR-001 mergeado a main — panel admin con Usuarios/Roles/Permisos implementado

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
| Iconos (admin) | Flux Icons | — |

---

## 4. Arquitectura

### Estructura de la aplicación

```
app/
├── Actions/Fortify/          # Acciones de autenticación (CreateNewUser, ResetUserPassword)
├── Concerns/                 # Traits de validación (PasswordValidationRules, ProfileValidationRules)
├── Http/Controllers/
│   ├── Controller.php        # Base controller
│   └── Admin/
│       ├── UsuariosController.php   # CRUD + UserPolicy + syncRoles()
│       ├── RolesController.php      # CRUD + RolePolicy + syncPermissions()
│       └── PermisosController.php   # Solo index (read-only)
├── Livewire/
│   ├── Actions/              # Logout
│   └── Admin/
│       ├── Usuarios/
│       │   └── Index.php     # CRUD completo de usuarios con asignación de roles
│       ├── Roles/
│       │   ├── Index.php     # Listado + crear + eliminar roles
│       │   └── Edit.php      # Editar rol + asignar permisos (checkboxes + syncPermissions)
│       └── Permisos/
│           └── Index.php     # Read-only, agrupado por módulo
├── Models/                   # Modelos Eloquent
├── Policies/
│   ├── UserPolicy.php        # Delega a $user->can('usuarios.*')
│   └── RolePolicy.php        # Delega a $user->can('roles.*') + guard super_admin
└── Providers/                # AppServiceProvider (registra RolePolicy), FortifyServiceProvider

database/seeders/
├── DatabaseSeeder.php                 # Llama RolesAndPermissionsSeeder + crea super_admin
└── RolesAndPermissionsSeeder.php      # 3 roles, 14 permisos, idempotente (firstOrCreate)

resources/views/
├── layouts/
│   ├── app/
│   │   └── sidebar.blade.php # Sidebar con @can guards para módulos admin
│   ├── app.blade.php         # Layout del panel admin (Flux sidebar)
│   └── auth.blade.php        # Layout de autenticación
├── components/
│   └── layouts/
│       └── public.blade.php  # Layout compartido para vistas públicas (nav, chatbot, lenis, JS)
├── admin/
│   ├── usuarios/
│   │   └── index.blade.php   # Wrapper Livewire Usuarios
│   ├── roles/
│   │   ├── index.blade.php   # Wrapper Livewire Roles
│   │   └── edit.blade.php    # Wrapper Livewire Roles/Edit
│   └── permisos/
│       └── index.blade.php   # Wrapper Livewire Permisos
├── livewire/
│   └── admin/                # Vistas Blade de los componentes Livewire admin
├── pages/
│   ├── auth/                 # Login, register, 2FA, verify-email, etc.
│   └── settings/             # Perfil, password, appearance, two-factor
├── partials/
│   └── head.blade.php        # <head> para panel admin (Flux)
├── home.blade.php            # Página pública: inicio
├── acerca-de-ambiderm.blade.php  # Página pública: nosotros
├── productos-ambiderm.blade.php  # Página pública: catálogo de guantes
├── producto-detalle.blade.php    # Página pública: detalle de producto
└── guantes-vynil.blade.php       # Página pública: categoría vinyl

routes/
├── web.php       # Rutas públicas + rutas admin (/admin/* auth + can middleware)
└── settings.php  # Rutas del panel de settings (auth)
```

### Patrones arquitectónicos
- **Sin módulos nwidart** — arquitectura plana estándar de Laravel
- **Livewire + Flux** para todas las vistas del panel admin
- **Blade puro** para páginas públicas (sin Livewire donde no se necesite interactividad)
- **Spatie Permission** para roles y permisos granulares

---

## 5. Estado actual (2026-03-01)

### Completado
| Feature | Descripción | Branch/Estado |
|---------|-------------|---------------|
| Infraestructura base | Laravel 12 + Livewire + Flux instalado | ✅ main |
| Autenticación | Login, registro, 2FA, recuperar password, verify email | ✅ main |
| Settings de usuario | Perfil, password, appearance, two-factor setup | ✅ main |
| Dashboard base | Vista placeholder (sin contenido real) | ✅ main (placeholder) |
| Rutas públicas | 5 páginas públicas sirviendo Blade | ✅ main |
| Migration permisos | Tablas de Spatie creadas en DB | ✅ main |
| Brand tokens CSS | `@theme` en app.css con paleta completa de Ambiderm | ✅ main |
| Layout público compartido | `components/layouts/public.blade.php` con nav, chatbot, lenis | ✅ main |
| Migración CDN → Vite | Todas las vistas públicas usan pipeline Vite | ✅ main |
| **ADR-001 — Roles y Permisos** | 3 roles, 14 permisos, seeder idempotente | ✅ **main (PR #1 mergeado)** |
| **Panel admin: Usuarios** | CRUD Livewire + UserPolicy + syncRoles | ✅ **main** |
| **Panel admin: Roles** | CRUD Livewire + RolePolicy + syncPermissions (checkboxes) | ✅ **main** |
| **Panel admin: Permisos** | Listado read-only Livewire agrupado por módulo | ✅ **main** |

### ADRs — Estado
| ADR | Descripción | Estado |
|-----|-------------|--------|
| ADR-001 | Sistema de roles y permisos (Spatie) | ✅ Completo — mergeado a main |
| ADR-003 | Alcance del panel admin (qué módulos tendrá) | ⏳ Pendiente |
| ADR-004 | Gestión de productos (CRUD en admin) | ⏳ Pendiente |

### Deuda técnica
| Issue | Descripción | Severidad |
|-------|-------------|-----------|
| TD-002 | `User` model no tenía `HasRoles` de Spatie | ✅ Resuelto (2026-03-01) |

---

## 6. Módulos del panel admin

### Implementados (ADR-001)
```
/admin/usuarios    — CRUD de usuarios internos + asignación de rol
/admin/roles       — CRUD de roles + asignación de permisos via checkboxes
/admin/permisos    — Listado read-only de permisos, agrupados por módulo
```

### Pendientes (requieren ADR aprobado)
```
Panel Admin — módulos futuros:
├── Dashboard          — KPIs y resumen general (ADR-003)
├── Productos          — CRUD de catálogo de productos (ADR-004)
└── Configuración      — Settings del sistema (ADR futuro)
```

### ADR-001 — Reglas del sistema de permisos
- Convención: `modulo.accion` (ej: `usuarios.crear`, `roles.editar`)
- **Permisos son inmutables desde UI** — solo se crean/eliminan en `RolesAndPermissionsSeeder`
- **Asignación de permisos a roles sí es editable** desde `/admin/roles/{id}/edit`
- `super_admin` recibe todos los permisos automáticamente vía seeder
- Las Policies verifican permisos Spatie, no roles directamente

---

## 7. Diseño y UI

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
- Consistente con los defaults de Livewire Flux

---

## 8. Rutas públicas

| URL | Vista | Descripción |
|-----|-------|-------------|
| `/` | `home.blade.php` | Página principal |
| `/nosotros` | `acerca-de-ambiderm.blade.php` | Historia y misión |
| `/productos` | `productos-ambiderm.blade.php` | Catálogo de guantes |
| `/producto-detalle` | `producto-detalle.blade.php` | Detalle de producto |
| `/guantes-vynil` | `guantes-vynil.blade.php` | Categoría: guantes de vinyl |
| `/dashboard` | `dashboard.blade.php` | Panel admin (auth + verified) |

---

## 9. Convenciones clave

- **Namespaces**: PSR-4, siempre mayúscula — `App\Models\User`, `App\Http\Controllers\...`
- **Commits**: En español — `feat(productos): se implementa CRUD (ADR-004)`
- **Branches**: Una por ADR — `feature/adr001-roles-permisos`
- **NO CDN en vistas nuevas**: Usar Vite pipeline para CSS/JS
- **Workflow**: Backend → revisión → Frontend → revisión → commit (solo con autorización de Angel)
