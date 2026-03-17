<?php

namespace App\Livewire\Admin\Paginas;

use App\Models\SeccionContenido;
use App\Services\ContenidoService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Index extends Component
{
    use AuthorizesRequests;

    /**
     * Nombres legibles y iconos para cada grupo de página.
     */
    public function getPaginasProperty(): array
    {
        return [
            'home' => ['nombre' => 'Página de Inicio', 'icono' => 'home'],
            'nosotros' => ['nombre' => 'Acerca de Nosotros', 'icono' => 'information-circle'],
            'footer' => ['nombre' => 'Footer (compartido)', 'icono' => 'rectangle-group'],
        ];
    }

    public function toggleActivo(int $id): void
    {
        $seccionContenido = SeccionContenido::findOrFail($id);

        $this->authorize('update', $seccionContenido);

        $seccionContenido->update([
            'activo' => ! $seccionContenido->activo,
        ]);

        ContenidoService::invalidarCache($seccionContenido->pagina);
    }

    public function render()
    {
        $secciones = SeccionContenido::orderBy('pagina')
            ->orderBy('orden')
            ->get()
            ->groupBy('pagina');

        return view('livewire.admin.paginas.index', compact('secciones'));
    }
}
