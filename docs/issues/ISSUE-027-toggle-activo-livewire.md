# ISSUE-027 — Toggle `activo` en Livewire `Paginas/Index`

**ADR:** [ADR-004](../adr/ADR-004-toggle-secciones-cms.md)
**Agente:** Backend
**Prioridad:** 1 de 4
**Rama:** `feature/adr004-toggle-secciones-cms`

---

## Descripción

Agregar el método `toggleActivo(int $id)` al componente Livewire `App\Livewire\Admin\Paginas\Index`. Este método es la pieza de backend que hace posible el toggle desde la UI.

---

## Criterios de aceptación

- [ ] Método `toggleActivo(int $id)` definido en `App\Livewire\Admin\Paginas\Index`
- [ ] El método verifica autorización con `$this->authorize('update', $seccionContenido)` antes de mutar
- [ ] Invierte el campo `activo` del registro (`!$seccionContenido->activo`)
- [ ] Llama a `ContenidoService::invalidarCache($seccionContenido->pagina)` tras el cambio
- [ ] No redirige — el componente se re-renderiza reactivamente (Livewire re-fetch automático)
- [ ] Si el usuario no tiene `paginas.editar`, lanza `AuthorizationException` (la Policy lo maneja)

---

## Implementación esperada

**Archivo:** `app/Livewire/Admin/Paginas/Index.php`

```php
use App\Services\ContenidoService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    // ... método getPaginasProperty() existente ...

    public function toggleActivo(int $id): void
    {
        $seccionContenido = SeccionContenido::findOrFail($id);

        $this->authorize('update', $seccionContenido);

        $seccionContenido->update([
            'activo' => ! $seccionContenido->activo,
        ]);

        ContenidoService::invalidarCache($seccionContenido->pagina);
    }

    // ... método render() existente ...
}
```

---

## Notas

- `AuthorizesRequests` ya se usa en `EditSeccion.php` — importarlo igual aquí
- La `SeccionContenidoPolicy@update` verifica `paginas.editar` — sin cambios en la Policy
- `ContenidoService::invalidarCache($pagina)` sin segundo argumento invalida toda la página (borra `contenido.{pagina}` y `contenido.{pagina}.*`)
