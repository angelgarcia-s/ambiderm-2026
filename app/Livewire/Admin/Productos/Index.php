<?php

namespace App\Livewire\Admin\Productos;

use App\Models\Producto;
use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $categoriaFilter = '';

    public bool $showDeleteModal = false;
    public ?int $deletingProductoId = null;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategoriaFilter(): void
    {
        $this->resetPage();
    }

    public function confirmDelete(int $id): void
    {
        $producto = Producto::findOrFail($id);
        $this->authorize('delete', $producto);
        $this->deletingProductoId = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $producto = Producto::findOrFail($this->deletingProductoId);
        $this->authorize('delete', $producto);

        $producto->categorias()->detach();
        $producto->tamanos()->detach();
        $producto->colores()->detach();
        $producto->delete();

        $this->showDeleteModal = false;
        $this->deletingProductoId = null;
        session()->flash('success', 'Producto eliminado.');
    }

    public function render()
    {
        $query = Producto::with('categorias')
            ->withCount('categorias');

        if ($this->search) {
            $query->where('nombre', 'like', '%' . $this->search . '%');
        }

        if ($this->categoriaFilter) {
            $query->deCategoria($this->categoriaFilter);
        }

        return view('livewire.admin.productos.index', [
            'productos'  => $query->ordenado()->paginate(15),
            'categorias' => Categoria::ordenado()->pluck('nombre', 'slug'),
        ]);
    }
}
