<?php

namespace App\Livewire\Admin\Colores;

use App\Models\Color;
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
    public string $hex = '';
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
        $color = Color::findOrFail($id);

        $this->editingId = $id;
        $this->isEditing = true;
        $this->nombre = $color->nombre;
        $this->hex = $color->hex ?? '';
        $this->iconoActual = $color->icono;
        $this->icono = null;
        $this->orden = $color->orden;
        $this->resetValidation();
        $this->showModal = true;
    }

    public function save(): void
    {
        $rules = [
            'nombre' => ['required', 'string', 'max:50', $this->isEditing ? 'unique:colores,nombre,' . $this->editingId : 'unique:colores,nombre'],
            'hex'    => ['nullable', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'icono'  => ['nullable', 'image', 'max:1024'],
            'orden'  => ['integer', 'min:0'],
        ];

        $this->validate($rules, [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max'      => 'El nombre no puede exceder 50 caracteres.',
            'nombre.unique'   => 'Ya existe un color con ese nombre.',
            'hex.regex'       => 'El código hex debe tener formato #RRGGBB (ej. #FF0000).',
            'icono.image'     => 'El icono debe ser una imagen válida.',
            'icono.max'       => 'El icono no puede pesar más de 1 MB.',
            'orden.integer'   => 'El orden debe ser un número entero.',
            'orden.min'       => 'El orden no puede ser negativo.',
        ]);

        $data = [
            'nombre' => $this->nombre,
            'hex'    => $this->hex ?: null,
            'orden'  => $this->orden,
        ];

        if ($this->icono) {
            $data['icono'] = $this->icono->store('colores', 'public');
        }

        if ($this->isEditing) {
            $color = Color::findOrFail($this->editingId);
            $color->update($data);
            session()->flash('success', 'Color actualizado exitosamente.');
        } else {
            Color::create($data);
            session()->flash('success', 'Color creado exitosamente.');
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
        $color = Color::findOrFail($this->deletingId);

        if ($color->productos()->count() > 0) {
            session()->flash('error', 'No se puede eliminar un color asignado a productos.');
            $this->showDeleteModal = false;
            $this->deletingId = null;
            return;
        }

        $color->delete();
        $this->showDeleteModal = false;
        $this->deletingId = null;
        session()->flash('success', 'Color eliminado.');
    }

    private function resetForm(): void
    {
        $this->nombre = '';
        $this->hex = '';
        $this->icono = null;
        $this->iconoActual = null;
        $this->orden = 0;
        $this->editingId = null;
        $this->deletingId = null;
        $this->resetValidation();
    }

    public function render()
    {
        $query = Color::withCount('productos');

        if ($this->search !== '') {
            $query->where('nombre', 'like', '%' . $this->search . '%');
        }

        return view('livewire.admin.colores.index', [
            'colores' => $query->ordenado()->paginate(15),
        ]);
    }
}
