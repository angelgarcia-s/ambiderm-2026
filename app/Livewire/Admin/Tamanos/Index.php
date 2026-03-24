<?php

namespace App\Livewire\Admin\Tamanos;

use App\Models\Tamano;
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

    public bool $showModal = false;
    public bool $showDeleteModal = false;
    public bool $isEditing = false;
    public bool $showImportModal = false;

    // Importación CSV
    public $archivoCsv = null;
    public array $importErrors   = [];
    public array $importWarnings = [];
    public int $importCount   = 0;
    public int $importUpdated = 0;
    public int $importSkipped = 0;

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
            'abreviatura' => ['nullable', 'string', 'max:12'],
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

    // — Exportar / Importar —

    #[Renderless]
    public function exportar(): StreamedResponse
    {
        $this->authorize('catalogos.exportar');

        $tamanos = Tamano::ordenado()->get(['nombre', 'abreviatura', 'icono', 'orden']);
        $tmp = tempnam(sys_get_temp_dir(), 'export_tam_') . '.xlsx';

        $headerStyle = (new Style())->withFontBold(true);
        $writer = new XlsxWriter();
        $writer->openToFile($tmp);
        $writer->addRow(Row::fromValuesWithStyle(['nombre', 'abreviatura', 'icono', 'orden'], $headerStyle));
        foreach ($tamanos as $tamano) {
            $writer->addRow(Row::fromValues([$tamano->nombre, $tamano->abreviatura ?? '', $tamano->icono ?? '', $tamano->orden]));
        }
        $writer->close();

        return response()->streamDownload(function () use ($tmp) {
            readfile($tmp);
            @unlink($tmp);
        }, 'tamanos.xlsx', ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
    }

    #[Renderless]
    public function descargarTemplate(): StreamedResponse
    {
        $this->authorize('catalogos.importar');

        $tmp = tempnam(sys_get_temp_dir(), 'tpl_tam_') . '.xlsx';
        $headerStyle = (new Style())->withFontBold(true);

        $writer = new XlsxWriter();
        $writer->openToFile($tmp);
        $writer->addRow(Row::fromValuesWithStyle(['nombre', 'abreviatura', 'icono', 'orden'], $headerStyle));
        $writer->addRow(Row::fromValues(['Extra Chico', 'XS', '', 1]));
        $writer->addRow(Row::fromValues(['Chico', 'S', '', 2]));
        $writer->addRow(Row::fromValues(['Mediano', 'M', '', 3]));
        $writer->close();

        return response()->streamDownload(function () use ($tmp) {
            readfile($tmp);
            @unlink($tmp);
        }, 'template-tamanos.xlsx', ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
    }

    public function abrirImport(): void
    {
        $this->authorize('catalogos.importar');
        $this->archivoCsv     = null;
        $this->importErrors   = [];
        $this->importWarnings = [];
        $this->importCount    = 0;
        $this->importUpdated  = 0;
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
        $updated  = 0;
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
                $attrs = [
                    'nombre'      => $nombre,
                    'abreviatura' => $data['abreviatura'] ?? null ?: null,
                    'icono'       => $data['icono'] ?? null ?: null,
                    'orden'       => (int) ($data['orden'] ?? 0),
                ];

                $existing = Tamano::where('nombre', $nombre)->first();

                if (! $existing) {
                    Tamano::create($attrs);
                    $count++;
                } else {
                    $existing->update($attrs);
                    $updated++;
                }
            }
            break;
        }
        $reader->close();

        $this->importErrors   = $errors;
        $this->importWarnings = $warnings;
        $this->importCount    = $count;
        $this->importUpdated  = $updated;
        $this->importSkipped  = $skipped;
        $this->archivoCsv     = null;

        if (empty($errors) && empty($warnings)) {
            $this->showImportModal = false;
            $this->resetPage();
            session()->flash('success', $this->buildImportMessage($count, $updated, $skipped, 'tamaño', 'tamaños'));
        }
    }

    private function buildImportMessage(int $count, int $updated, int $skipped, string $singular, string $plural): string
    {
        $parts = [];
        if ($count > 0) {
            $parts[] = "{$count} " . ($count === 1 ? "{$singular} nuevo importado" : "{$plural} nuevos importados");
        }
        if ($updated > 0) {
            $parts[] = "{$updated} " . ($updated === 1 ? 'actualizado' : 'actualizados');
        }
        if ($count === 0 && $updated === 0) {
            $parts[] = 'Ningún cambio realizado';
        }
        if ($skipped > 0) {
            $parts[] = "{$skipped} " . ($skipped === 1 ? 'con error, omitido' : 'con errores, omitidos');
        }
        return implode(' — ', $parts) . '.';
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
