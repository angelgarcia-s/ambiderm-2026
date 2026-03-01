# Instrucciones para Claude Code

Este archivo se carga automáticamente al inicio de cada sesión. Léelo completo antes de cualquier acción.

---

## 1. Proyecto

**Ambiderm 2026** es el sitio web corporativo y panel de administración de Ambiderm — empresa 100% mexicana con más de 30 años fabricando y comercializando guantes y productos desechables para el sector médico.

- **Stack Backend**: Laravel 12 + Livewire v4 + Flux UI + Fortify
- **Stack Frontend**: Tailwind CSS v4 (pipeline Vite) + Lucide Icons
- **Auth**: Laravel Fortify (login, registro, 2FA, recuperación de contraseña)
- **Permisos**: Spatie laravel-permission v7
- **Build**: Vite v7
- **DB (dev)**: SQLite

---

## 2. Reglas de Oro (NO negociables)

### Commits — NUNCA sin autorización de Angel
El flujo obligatorio es: **Implementar → Reportar → Esperar revisión → Esperar "aprobado para commit" → Commit**

### Branches — Una por ADR completo
- Formato: `feature/adrXXX-nombre-completo`
- Backend implementa todos sus issues → Frontend continúa en la misma branch
- Un solo PR al final del ADR completo
- **NO** crear branches por issue individual

### Scope — Solo lo que pide el Issue activo
No adelantar funcionalidades, no refactorizar código no relacionado, no agregar features extra.

---

## 3. Roles disponibles

Al inicio de cada sesión, Angel indicará qué rol toma Claude Code:

| Rol | Qué hace | Qué NO hace |
|-----|----------|-------------|
| **Orchestrator** | Crea/revisa ADRs y Contracts, coordina workflow | NO implementa código |
| **Backend** | Migrations, Models, Services, Controllers, Policies | NO cambia frontend |
| **Frontend** | Views Blade/Livewire, Componentes Flux, UI/UX | NO cambia backend |
| **QA** | Revisa tests, detecta edge cases, valida criterios | NO implementa features |
| **Context** | Actualiza `PROJECT_CONTEXT.md` post-merge | NO implementa código |
| **FeatureDocs** | Documenta features en `docs/features/` | NO implementa código |

---

## 4. Documentación clave

| Recurso | Ruta |
|---------|------|
| Contexto del proyecto | `docs/PROJECT_CONTEXT.md` |
| Sistema de agentes y workflow | `docs/.agents/agentes.md` |
| ADRs (decisiones arquitectónicas) | `docs/adr/` |
| Contracts (modelos y reglas) | `docs/contracts/` |
| Issues activos | `docs/issues/` |
| Features documentadas | `docs/features/` |
| Guía de estilos UI | `_backup_static/GUIA_ESTILO.md` |

---

## 5. Convenciones de código

### Commits (en español)
```
<tipo>(<módulo>): <descripción en español> (<referencia>)
```
Ejemplos:
- `feat(productos): se implementa catálogo de productos en panel admin (ADR-004)`
- `fix(auth): se corrige redirección post-login (BUG-001)`
- `docs(adr): se documenta ADR-002 sistema de roles`

Tipos válidos: `feat`, `fix`, `refactor`, `docs`, `test`, `chore`

### PHP (Laravel)
- Namespaces PSR-4 con mayúscula: `App\Models\...`, `App\Http\Controllers\...`
- Permisos vía `spatie/laravel-permission` con `HasRoles` en el modelo User
- Livewire components en `app/Livewire/`
- Views Blade en `resources/views/`

### Frontend (Blade + Livewire + Flux)
- Componentes Flux: `<flux:button>`, `<flux:input>`, `<flux:modal>`, etc.
- Layouts: `<x-layouts::app>` para panel admin, `<x-layouts::auth>` para auth
- Tailwind v4 via pipeline Vite — **NO usar CDN de Tailwind** en vistas nuevas
- Iconos: Lucide Icons (via CDN en páginas públicas, via Flux en panel admin)
- Tipografía: Inter, estética "Apple-inspired" (ver `_backup_static/GUIA_ESTILO.md`)

---
