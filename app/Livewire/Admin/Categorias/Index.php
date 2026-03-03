<?php

namespace App\Livewire\Admin\Categorias;

use App\Models\Categoria;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public string $search = '';

    public bool $showCreateModal = false;
    public bool $showEditModal = false;
    public bool $showDeleteModal = false;

    public ?int $editingCategoriaId = null;
    public ?int $deletingCategoriaId = null;

    // Campos del formulario
    public string $nombre = '';
    public string $slug = '';
    public ?string $descripcion = '';
    public $imagen = null;
    public ?string $imagenActual = null;
    public bool $activo = true;
    public int $orden = 0;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatedNombre(string $value): void
    {
        if (! $this->editingCategoriaId || $this->slug === Str::slug($this->nombre)) {
            $this->slug = Str::slug($value);
        }
    }

    public function create(): void
    {
        $this->authorize('create', Categoria::class);
        $this->resetForm();
        $this->showCreateModal = true;
    }

    public function store(): void
    {
        $this->authorize('create', Categoria::class);

        $this->validate($this->rules(), $this->messages());

        $data = [
            'nombre'     => $this->nombre,
            'slug'       => $this->slug,
            'descripcion' => $this->descripcion ?: null,
            'activo'     => $this->activo,
            'orden'      => $this->orden,
        ];

        if ($this->imagen) {
            $data['imagen'] = $this->imagen->store('categorias', 'public');
        }

        Categoria::create($data);

        cache()->forget('nav.categorias');

        $this->showCreateModal = false;
        $this->resetForm();
        session()->flash('success', 'Categoría creada exitosamente.');
    }

    public function edit(int $id): void
    {
        $categoria = Categoria::findOrFail($id);
        $this->authorize('update', $categoria);

        $this->editingCategoriaId = $id;
        $this->nombre = $categoria->nombre;
        $this->slug = $categoria->slug;
        $this->descripcion = $categoria->descripcion ?? '';
        $this->imagenActual = $categoria->imagen;
        $this->imagen = null;
        $this->activo = $categoria->activo;
        $this->orden = $categoria->orden;
        $this->resetValidation();
        $this->showEditModal = true;
    }

    public function update(): void
    {
        $categoria = Categoria::findOrFail($this->editingCategoriaId);
        $this->authorize('update', $categoria);

        $this->validate($this->rules(isUpdate: true), $this->messages());

        $data = [
            'nombre'     => $this->nombre,
            'slug'       => $this->slug,
            'descripcion' => $this->descripcion ?: null,
            'activo'     => $this->activo,
            'orden'      => $this->orden,
        ];

        if ($this->imagen) {
            $data['imagen'] = $this->imagen->store('categorias', 'public');
        }

        $categoria->update($data);

        cache()->forget('nav.categorias');

        $this->showEditModal = false;
        $this->editingCategoriaId = null;
        $this->resetForm();
        session()->flash('success', 'Categoría actualizada exitosamente.');
    }

    public function confirmDelete(int $id): void
    {
        $categoria = Categoria::findOrFail($id);
        $this->authorize('delete', $categoria);
        $this->deletingCategoriaId = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $categoria = Categoria::findOrFail($this->deletingCategoriaId);
        $this->authorize('delete', $categoria);

        if ($categoria->productos()->count() > 0) {
            session()->flash('error', 'No se puede eliminar una categoría con productos asociados.');
            $this->showDeleteModal = false;
            $this->deletingCategoriaId = null;
            return;
        }

        $categoria->delete();

        cache()->forget('nav.categorias');

        $this->showDeleteModal = false;
        $this->deletingCategoriaId = null;
        session()->flash('success', 'Categoría eliminada.');
    }

    private function messages(): array
    {
        return [
            'nombre.required'     => 'El nombre es obligatorio.',
            'nombre.max'          => 'El nombre no puede exceder 100 caracteres.',
            'slug.required'       => 'El slug es obligatorio.',
            'slug.unique'         => 'Ya existe una categoría con ese slug.',
            'descripcion.max'     => 'La descripción no puede exceder 500 caracteres.',
            'imagen.image'        => 'La imagen debe ser un archivo de imagen válido.',
            'imagen.max'          => 'La imagen no puede pesar más de 2 MB.',
            'orden.integer'       => 'El orden debe ser un número entero.',
            'orden.min'           => 'El orden no puede ser negativo.',
        ];
    }

    private function rules(bool $isUpdate = false): array
    {
        $slugUnique = $isUpdate
            ? 'unique:categorias,slug,' . $this->editingCategoriaId
            : 'unique:categorias,slug';

        return [
            'nombre'     => ['required', 'string', 'max:100'],
            'slug'       => ['required', 'string', 'max:120', $slugUnique],
            'descripcion' => ['nullable', 'string', 'max:500'],
            'imagen'     => ['nullable', 'image', 'max:2048'],
            'activo'     => ['boolean'],
            'orden'      => ['integer', 'min:0'],
        ];
    }

    private function resetForm(): void
    {
        $this->nombre = '';
        $this->slug = '';
        $this->descripcion = '';
        $this->imagen = null;
        $this->imagenActual = null;
        $this->activo = true;
        $this->orden = 0;
        $this->editingCategoriaId = null;
        $this->deletingCategoriaId = null;
        $this->resetValidation();
    }

    public function render()
    {
        $query = Categoria::withCount('productos');

        if ($this->search !== '') {
            $query->where('nombre', 'like', '%' . $this->search . '%');
        }

        return view('livewire.admin.categorias.index', [
            'categorias' => $query->ordenado()->paginate(15),
        ]);
    }
}
