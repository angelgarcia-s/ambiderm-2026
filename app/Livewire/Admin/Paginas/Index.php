<?php

namespace App\Livewire\Admin\Paginas;

use App\Models\SeccionContenido;
use Livewire\Component;

class Index extends Component
{
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

    public function render()
    {
        $secciones = SeccionContenido::orderBy('pagina')
            ->orderBy('orden')
            ->get()
            ->groupBy('pagina');

        return view('livewire.admin.paginas.index', compact('secciones'));
    }
}
