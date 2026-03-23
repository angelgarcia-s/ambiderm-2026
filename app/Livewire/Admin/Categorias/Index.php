<?php

namespace App\Livewire\Admin\Categorias;

use App\Models\Categoria;
use Illuminate\Support\Str;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Common\Entity\Style\Style;
use OpenSpout\Reader\CSV\Options as CsvReadOptions;
use OpenSpout\Reader\CSV\Reader as CsvReader;
use OpenSpout\Reader\XLSX\Reader as XlsxReader;
use OpenSpout\Writer\XLSX\Writer as XlsxWriter;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public string $search = '';

    public bool $showCreateModal = false;
    public bool $showEditModal = false;
    public bool $showDeleteModal = false;
    public bool $showImportModal = false;

    // Importación CSV
    public $archivoCsv = null;
    public array $importErrors   = [];
    public array $importWarnings = [];
    public int $importCount   = 0;
    public int $importSkipped = 0;

    public ?int $editingCategoriaId = null;
    public ?int $deletingCategoriaId = null;

    // Campos del formulario
    public string $nombre = '';
    public string $slug = '';
    public ?string $descripcion = '';
    public $imagen = null;
    public ?string $imagenActual = null;
    public bool $activo = true;
    public bool $requiereVerificacion = false;
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
            'nombre'                 => $this->nombre,
            'slug'                   => $this->slug,
            'descripcion'            => $this->descripcion ?: null,
            'activo'                 => $this->activo,
            'requiere_verificacion'  => $this->requiereVerificacion,
            'orden'                  => $this->orden,
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
        $this->requiereVerificacion = $categoria->requiere_verificacion;
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
            'nombre'                 => $this->nombre,
            'slug'                   => $this->slug,
            'descripcion'            => $this->descripcion ?: null,
            'activo'                 => $this->activo,
            'requiere_verificacion'  => $this->requiereVerificacion,
            'orden'                  => $this->orden,
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

    // — Exportar / Importar —

    #[Renderless]
    public function exportar(): StreamedResponse
    {
        $this->authorize('catalogos.exportar');

        $categorias = Categoria::ordenado()->get(['nombre', 'slug', 'descripcion', 'imagen', 'activo', 'requiere_verificacion', 'orden']);
        $tmp = tempnam(sys_get_temp_dir(), 'export_cat_') . '.xlsx';

        $headerStyle = (new Style())->withFontBold(true);
        $writer = new XlsxWriter();
        $writer->openToFile($tmp);
        $writer->addRow(Row::fromValuesWithStyle(['nombre', 'slug', 'descripcion', 'imagen', 'activo', 'requiere_verificacion', 'orden'], $headerStyle));
        foreach ($categorias as $cat) {
            $writer->addRow(Row::fromValues([
                $cat->nombre, $cat->slug, $cat->descripcion ?? '',
                $cat->imagen ?? '', $cat->activo ? 1 : 0,
                $cat->requiere_verificacion ? 1 : 0, $cat->orden,
            ]));
        }
        $writer->close();

        return response()->streamDownload(function () use ($tmp) {
            readfile($tmp);
            @unlink($tmp);
        }, 'categorias.xlsx', ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
    }

    #[Renderless]
    public function descargarTemplate(): StreamedResponse
    {
        $this->authorize('catalogos.importar');

        $tmp = tempnam(sys_get_temp_dir(), 'tpl_cat_') . '.xlsx';
        $headerStyle = (new Style())->withFontBold(true);

        $writer = new XlsxWriter();
        $writer->openToFile($tmp);
        $writer->addRow(Row::fromValuesWithStyle(['nombre', 'descripcion', 'imagen', 'activo', 'requiere_verificacion', 'orden'], $headerStyle));
        $writer->addRow(Row::fromValues(['Guantes de Látex', 'Guantes de látex para uso médico', '', 1, 0, 1]));
        $writer->addRow(Row::fromValues(['Guantes de Nitrilo', 'Guantes de nitrilo sin polvo', '', 1, 0, 2]));
        $writer->close();

        return response()->streamDownload(function () use ($tmp) {
            readfile($tmp);
            @unlink($tmp);
        }, 'template-categorias.xlsx', ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
    }

    public function abrirImport(): void
    {
        $this->authorize('catalogos.importar');
        $this->archivoCsv     = null;
        $this->importErrors   = [];
        $this->importWarnings = [];
        $this->importCount    = 0;
        $this->importSkipped  = 0;
        $this->resetValidation('archivoCsv');
        $this->showImportModal = true;
    }

    public function procesarImportacion(): void
    {
        $this->authorize('catalogos.importar');

        $this->validate(
            ['archivoCsv' => ['required', 'file', 'mimes:xlsx,csv,txt', 'max:4096']],
            [
                'archivoCsv.required' => 'Selecciona un archivo.',
                'archivoCsv.mimes'    => 'El archivo debe ser XLSX o CSV.',
                'archivoCsv.max'      => 'El archivo no puede pesar más de 4 MB.',
            ]
        );

        $path = $this->archivoCsv->getRealPath();
        $ext  = strtolower($this->archivoCsv->getClientOriginalExtension());

        $count    = 0;
        $skipped  = 0;
        $errors   = [];
        $warnings = [];

        if ($ext === 'xlsx') {
            $reader = new XlsxReader();
        } else {
            $opts = new CsvReadOptions();
            $opts->ENCODING = 'UTF-8';
            $reader = new CsvReader($opts);
        }

        $reader->open($path);
        $header = null;
        $line   = 0;

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                $line++;
                $values = array_map(
                    fn ($v) => trim((string) $v),
                    $row->toArray()
                );

                if ($header === null) {
                    $header = array_map('strtolower', $values);
                    continue;
                }
                if (count($values) !== count($header)) {
                    $errors[] = "Fila {$line}: número de columnas incorrecto.";
                    continue;
                }
                $data   = array_combine($header, $values);
                $nombre = $data['nombre'] ?? '';
                if ($nombre === '') {
                    $errors[] = "Fila {$line}: el campo 'nombre' está vacío.";
                    continue;
                }
                $slug = Str::slug($nombre);
                if (! Categoria::where('slug', $slug)->exists()) {
                    Categoria::create([
                        'nombre'                => $nombre,
                        'descripcion'           => $data['descripcion'] ?? null ?: null,
                        'activo'                => (($data['activo'] ?? '1') === '1'),
                        'requiere_verificacion' => (($data['requiere_verificacion'] ?? '0') === '1'),
                        'orden'                 => (int) ($data['orden'] ?? 0),
                    ]);
                    $count++;
                } else {
                    $warnings[] = "Fila {$line}: «{$nombre}» ya existe, omitido.";
                    $skipped++;
                }
            }
            break; // solo primera hoja
        }
        $reader->close();
        cache()->forget('nav.categorias');

        $this->importErrors   = $errors;
        $this->importWarnings = $warnings;
        $this->importCount    = $count;
        $this->importSkipped  = $skipped;
        $this->archivoCsv     = null;

        if (empty($errors) && empty($warnings)) {
            $this->showImportModal = false;
            $this->resetPage();
            session()->flash('success', $this->buildImportMessage($count, $skipped, 'categoría', 'categorías'));
        }
    }

    private function buildImportMessage(int $count, int $skipped, string $singular, string $plural): string
    {
        $parts = [];
        if ($count > 0) {
            $parts[] = "{$count} " . ($count === 1 ? "{$singular} nuevo importado" : "{$plural} nuevos importados");
        } else {
            $parts[] = 'Ningún registro nuevo importado';
        }
        if ($skipped > 0) {
            $parts[] = "{$skipped} " . ($skipped === 1 ? 'ya existía y fue omitido' : 'ya existían y fueron omitidos');
        }
        return implode(' — ', $parts) . '.';
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
            'nombre'               => ['required', 'string', 'max:100'],
            'slug'                 => ['required', 'string', 'max:120', $slugUnique],
            'descripcion'          => ['nullable', 'string', 'max:500'],
            'imagen'               => ['nullable', 'image', 'max:2048'],
            'activo'               => ['boolean'],
            'requiereVerificacion' => ['boolean'],
            'orden'                => ['integer', 'min:0'],
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
        $this->requiereVerificacion = false;
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
