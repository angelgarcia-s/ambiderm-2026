# Instrucciones para Claude Code

Este archivo se carga automáticamente al inicio de cada sesión. Léelo completo antes de cualquier acción.

---

## 1. Proyecto

**Proyecto** es una plataforma.

- **Stack**: Laravel 10 + 
- **Estilos**: Tailwind CSS v 


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
| **Frontend** | Pages Inertia, Components Vue, UI/UX | NO cambia backend |
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

---

## 5. Convenciones de código

### Commits (en español)
```
<tipo>(<módulo>): <descripción en español> (<referencia>)
```
Ejemplos:
- `feat(saas): se implementa administración de roles (ADR-005)`
- `fix(core): se corrige asignación de permisos en seeders (BUG-001)`
- `docs(adr): se documenta enmienda 2 de ADR-005`

Tipos válidos: `feat`, `fix`, `refactor`, `docs`, `test`, `chore`

### PHP (Laravel)
- Namespaces con mayúscula: `Modules\Core\...`, no `modules\core\...`
- Permisos: `spatie/laravel-permission` con `categoria`

###  (Frontend)

---

