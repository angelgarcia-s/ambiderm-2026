<?php

namespace App\Livewire\Admin\Productos;

use App\Models\Categoria;
use App\Models\Color;
use App\Models\Producto;
use App\Models\Tamano;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public ?int $productoId = null;

    // Info básica
    public string $nombre = '';
    public string $slug = '';
    public ?string $subtitulo = '';
    public ?string $material = '';
    public ?string $descripcion = '';

    // Multimedia
    public $imagen = null;
    public ?string $imagenActual = null;
    public ?string $url_tienda = '';
    public ?string $url_ficha_tecnica = '';

    // Relaciones
    public array $categoriasSeleccionadas = [];
    public array $tamanosSeleccionados = [];
    public array $coloresSeleccionados = [];

    // Imágenes por color (pivot)
    public array $imagenesPorColor = [];
    public array $imagenesPorColorActuales = [];

    // Especificaciones (repeaters)
    public array $caracteristicas = [''];
    public array $etiquetas = [''];

    // Presentación
    public ?string $presentacion = '';
    public ?string $certificaciones = '';

    // Visibilidad
    public bool $activo = true;
    public bool $destacado = false;
    public int $orden = 0;

    public function mount(?int $productoId = null): void
    {
        if ($productoId) {
            $this->productoId = $productoId;
            $producto = Producto::with(['categorias', 'tamanos', 'colores'])->findOrFail($productoId);

            $this->nombre = $producto->nombre;
            $this->slug = $producto->slug;
            $this->subtitulo = $producto->subtitulo ?? '';
            $this->material = $producto->material ?? '';
            $this->descripcion = $producto->descripcion ?? '';
            $this->imagenActual = $producto->imagen;
            $this->url_tienda = $producto->url_tienda ?? '';
            $this->url_ficha_tecnica = $producto->url_ficha_tecnica ?? '';
            $this->categoriasSeleccionadas = $producto->categorias->pluck('id')->toArray();
            $this->tamanosSeleccionados = $producto->tamanos->pluck('id')->toArray();
            $this->coloresSeleccionados = $producto->colores->pluck('id')->toArray();

            // Cargar imágenes pivot de colores
            foreach ($producto->colores as $color) {
                if ($color->pivot->imagen) {
                    $this->imagenesPorColorActuales[$color->id] = $color->pivot->imagen;
                }
            }

            $this->caracteristicas = $producto->caracteristicas ?? [''];
            if (empty($this->caracteristicas)) {
                $this->caracteristicas = [''];
            }
            $this->etiquetas = $producto->etiquetas ?? [''];
            if (empty($this->etiquetas)) {
                $this->etiquetas = [''];
            }

            $this->presentacion = $producto->presentacion ?? '';
            $this->certificaciones = $producto->certificaciones ?? '';
            $this->activo = $producto->activo;
            $this->destacado = $producto->destacado;
            $this->orden = $producto->orden;
        }
    }

    public function updatedNombre(string $value): void
    {
        if (! $this->productoId || $this->slug === Str::slug($this->nombre)) {
            $this->slug = Str::slug($value);
        }
    }

    // Repeater: Características
    public function addCaracteristica(): void
    {
        $this->caracteristicas[] = '';
    }

    public function removeCaracteristica(int $index): void
    {
        unset($this->caracteristicas[$index]);
        $this->caracteristicas = array_values($this->caracteristicas);
        if (empty($this->caracteristicas)) {
            $this->caracteristicas = [''];
        }
    }

    // Repeater: Etiquetas
    public function addEtiqueta(): void
    {
        $this->etiquetas[] = '';
    }

    public function removeEtiqueta(int $index): void
    {
        unset($this->etiquetas[$index]);
        $this->etiquetas = array_values($this->etiquetas);
        if (empty($this->etiquetas)) {
            $this->etiquetas = [''];
        }
    }

    public function save()
    {
        $isUpdate = (bool) $this->productoId;

        if ($isUpdate) {
            $producto = Producto::findOrFail($this->productoId);
            $this->authorize('update', $producto);
        } else {
            $this->authorize('create', Producto::class);
        }

        $slugUnique = $isUpdate
            ? 'unique:productos,slug,' . $this->productoId
            : 'unique:productos,slug';

        $this->validate([
            'nombre'                    => ['required', 'string', 'max:150'],
            'slug'                      => ['required', 'string', 'max:170', $slugUnique],
            'subtitulo'                 => ['nullable', 'string', 'max:255'],
            'material'                  => ['nullable', 'string', 'max:80'],
            'descripcion'               => ['nullable', 'string', 'max:5000'],
            'imagen'                    => ['nullable', 'image', 'max:4096'],
            'url_tienda'                => ['nullable', 'url', 'max:255'],
            'url_ficha_tecnica'         => ['nullable', 'url', 'max:255'],
            'categoriasSeleccionadas'   => ['required', 'array', 'min:1'],
            'categoriasSeleccionadas.*' => ['integer', 'exists:categorias,id'],
            'tamanosSeleccionados'      => ['nullable', 'array'],
            'tamanosSeleccionados.*'    => ['integer', 'exists:tamanos,id'],
            'coloresSeleccionados'      => ['nullable', 'array'],
            'coloresSeleccionados.*'    => ['integer', 'exists:colores,id'],
            'caracteristicas'           => ['nullable', 'array'],
            'caracteristicas.*'         => ['nullable', 'string', 'max:200'],
            'etiquetas'                 => ['nullable', 'array'],
            'etiquetas.*'               => ['nullable', 'string', 'max:100'],
            'presentacion'              => ['nullable', 'string', 'max:2000'],
            'certificaciones'           => ['nullable', 'string', 'max:2000'],
            'activo'                    => ['boolean'],
            'destacado'                 => ['boolean'],
            'orden'                     => ['integer', 'min:0'],
        ]);

        $data = [
            'nombre'           => $this->nombre,
            'slug'             => $this->slug,
            'subtitulo'        => $this->subtitulo ?: null,
            'material'         => $this->material ?: null,
            'descripcion'      => $this->descripcion ?: null,
            'url_tienda'       => $this->url_tienda ?: null,
            'url_ficha_tecnica' => $this->url_ficha_tecnica ?: null,
            'caracteristicas'  => array_values(array_filter($this->caracteristicas, fn ($v) => trim($v) !== '')),
            'etiquetas'        => array_values(array_filter($this->etiquetas, fn ($v) => trim($v) !== '')),
            'presentacion'     => $this->presentacion ?: null,
            'certificaciones'  => $this->certificaciones ?: null,
            'activo'           => $this->activo,
            'destacado'        => $this->destacado,
            'orden'            => $this->orden,
        ];

        if ($this->imagen) {
            $data['imagen'] = $this->imagen->store('productos', 'public');
        }

        if ($isUpdate) {
            $producto->update($data);
        } else {
            $producto = Producto::create($data);
        }

        // Sync relaciones
        $producto->categorias()->sync($this->categoriasSeleccionadas);
        $producto->tamanos()->sync($this->tamanosSeleccionados);

        // Colores con imagen pivot
        $coloresSync = [];
        foreach ($this->coloresSeleccionados as $colorId) {
            $pivotData = [];

            if (isset($this->imagenesPorColor[$colorId]) && $this->imagenesPorColor[$colorId]) {
                $pivotData['imagen'] = $this->imagenesPorColor[$colorId]->store('productos/colores', 'public');
            } elseif (isset($this->imagenesPorColorActuales[$colorId])) {
                $pivotData['imagen'] = $this->imagenesPorColorActuales[$colorId];
            }

            $coloresSync[$colorId] = $pivotData;
        }
        $producto->colores()->sync($coloresSync);

        // Invalidar caches públicos que dependen de productos
        cache()->forget('home.productos_destacados');
        cache()->forget('nav.categorias');

        $action = $isUpdate ? 'actualizado' : 'creado';
        session()->flash('success', "Producto {$action} exitosamente.");

        return $this->redirect(route('admin.productos.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.productos.form', [
            'todasCategorias' => Categoria::activo()->ordenado()->get(),
            'todosTamanos'    => Tamano::ordenado()->get(),
            'todosColores'    => Color::ordenado()->get(),
        ]);
    }
}
