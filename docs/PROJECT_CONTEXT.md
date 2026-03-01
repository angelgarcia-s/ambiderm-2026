# PROJECT_CONTEXT — Ambiderm 2026

**Última actualización:** 2026-03-01
**Responsable:** Agent.Orchestrator
**Estado del proyecto:** Fase inicial — infraestructura base lista, features del panel admin por definir

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
├── Actions/Fortify/     # Acciones de autenticación (CreateNewUser, ResetUserPassword)
├── Concerns/            # Traits de validación (PasswordValidationRules, ProfileValidationRules)
├── Http/Controllers/    # Controladores base
├── Livewire/            # Componentes Livewire (Actions: Logout)
├── Models/              # Modelos Eloquent
└── Providers/           # ServiceProviders (AppServiceProvider, FortifyServiceProvider)

resources/views/
├── layouts/
│   ├── app.blade.php         # Layout del panel admin (Flux sidebar)
│   └── auth.blade.php        # Layout de autenticación
├── pages/
│   ├── auth/                 # Login, register, 2FA, verify-email, etc.
│   └── settings/             # Perfil, password, appearance, two-factor
├── components/               # Componentes blade reutilizables
├── home.blade.php            # Página pública: inicio
├── acerca-de-ambiderm.blade.php  # Página pública: nosotros
├── productos-ambiderm.blade.php  # Página pública: catálogo de guantes
├── producto-detalle.blade.php    # Página pública: detalle de producto
└── guantes-vynil.blade.php       # Página pública: categoría vinyl

routes/
├── web.php       # Rutas públicas + dashboard
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
| Feature | Descripción | Estado |
|---------|-------------|--------|
| Infraestructura base | Laravel 12 + Livewire + Flux instalado | ✅ |
| Autenticación | Login, registro, 2FA, recuperar password, verify email | ✅ |
| Settings de usuario | Perfil, password, appearance, two-factor setup | ✅ |
| Dashboard base | Vista placeholder (sin contenido real) | ✅ (placeholder) |
| Rutas públicas | 5 páginas públicas sirviendo Blade | ✅ |
| Migration permisos | Tablas de Spatie creadas en DB | ✅ |

### Pendiente — Decisiones Arquitectónicas
| ADR | Decisión | Prioridad |
|-----|----------|-----------|
| ADR-001 | Sistema de roles y permisos de Ambiderm (qué roles existen) | ALTA |
| ADR-002 | Integración CSS: páginas públicas vía Vite (no CDN) | ALTA |
| ADR-003 | Alcance del panel admin (qué módulos tendrá) | ALTA |
| ADR-004 | Gestión de productos (CRUD en admin) | MEDIA |

### Deuda técnica
| Issue | Descripción | Severidad |
|-------|-------------|-----------|
| TD-001 | Páginas Blade públicas usan Tailwind CDN (no Vite) | 🟡 ALTO |
| TD-002 | `User` model no tiene `HasRoles` de Spatie | 🟡 ALTO |

---

## 6. Módulos del panel admin (por definir)

Los siguientes módulos están **pendientes de aprobación** por Angel Garcia. No implementar hasta tener ADR aprobado.

```
Panel Admin (propuesta inicial — sujeto a revisión):
├── Dashboard          — KPIs y resumen general
├── Productos          — CRUD de catálogo de productos
├── Usuarios           — Gestión de usuarios internos
└── Configuración      — Settings del sistema
```

---

## 7. Diseño y UI

### Estética del sitio público
- Inspiración: "Apple-inspired" — limpio, premium, minimalista
- Tipografía: **Inter** (Google Fonts)
- Colores principales:
  - Fondo: `#ffffff` / `#f5f5f7`
  - Texto: `#1d1d1f` (títulos) / `#86868b` (cuerpo)
  - Acción: `#0071e3` (azul de marca)
- Animaciones: Intersection Observer (reveal-fade-in, reveal-scale-in)
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
