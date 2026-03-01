<?php

namespace App\Livewire\Admin\Tamanos;

use App\Models\Tamano;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public string $search = '';

    public bool $showModal = false;
    public bool $showDeleteModal = false;
    public bool $isEditing = false;

    public ?int $editingId = null;
    public ?int $deletingId = null;

    // Campos del formulario
    public string $nombre = '';
    public ?string $abreviatura = '';
    public $icono = null;
    public ?string $iconoActual = null;
    public int $orden = 0;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function create(): void
    {
        $this->resetForm();
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function edit(int $id): void
    {
        $tamano = Tamano::findOrFail($id);

        $this->editingId = $id;
        $this->isEditing = true;
        $this->nombre = $tamano->nombre;
        $this->abreviatura = $tamano->abreviatura ?? '';
        $this->iconoActual = $tamano->icono;
        $this->icono = null;
        $this->orden = $tamano->orden;
        $this->resetValidation();
        $this->showModal = true;
    }

    public function save(): void
    {
        $rules = [
            'nombre'      => ['required', 'string', 'max:50', $this->isEditing ? 'unique:tamanos,nombre,' . $this->editingId : 'unique:tamanos,nombre'],
            'abreviatura' => ['nullable', 'string', 'max:10'],
            'icono'       => ['nullable', 'image', 'max:1024'],
            'orden'       => ['integer', 'min:0'],
        ];

        $this->validate($rules, [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max'      => 'El nombre no puede exceder 50 caracteres.',
            'nombre.unique'   => 'Ya existe un tamaño con ese nombre.',
            'icono.image'     => 'El icono debe ser una imagen válida.',
            'icono.max'       => 'El icono no puede pesar más de 1 MB.',
            'orden.integer'   => 'El orden debe ser un número entero.',
            'orden.min'       => 'El orden no puede ser negativo.',
        ]);

        $data = [
            'nombre'      => $this->nombre,
            'abreviatura' => $this->abreviatura ?: null,
            'orden'       => $this->orden,
        ];

        if ($this->icono) {
            $data['icono'] = $this->icono->store('tamanos', 'public');
        }

        if ($this->isEditing) {
            $tamano = Tamano::findOrFail($this->editingId);
            $tamano->update($data);
            session()->flash('success', 'Tamaño actualizado exitosamente.');
        } else {
            Tamano::create($data);
            session()->flash('success', 'Tamaño creado exitosamente.');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function confirmDelete(int $id): void
    {
        $this->deletingId = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $tamano = Tamano::findOrFail($this->deletingId);

        if ($tamano->productos()->count() > 0) {
            session()->flash('error', 'No se puede eliminar un tamaño asignado a productos.');
            $this->showDeleteModal = false;
            $this->deletingId = null;
            return;
        }

        $tamano->delete();
        $this->showDeleteModal = false;
        $this->deletingId = null;
        session()->flash('success', 'Tamaño eliminado.');
    }

    private function resetForm(): void
    {
        $this->nombre = '';
        $this->abreviatura = '';
        $this->icono = null;
        $this->iconoActual = null;
        $this->orden = 0;
        $this->editingId = null;
        $this->deletingId = null;
        $this->resetValidation();
    }

    public function render()
    {
        $query = Tamano::withCount('productos');

        if ($this->search !== '') {
            $query->where('nombre', 'like', '%' . $this->search . '%');
        }

        return view('livewire.admin.tamanos.index', [
            'tamanos' => $query->ordenado()->paginate(15),
        ]);
    }
}
