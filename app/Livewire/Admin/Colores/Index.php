<?php

namespace App\Livewire\Admin\Colores;

use App\Models\Color;
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

    // — Exportar / Importar —

    #[Renderless]
    public function exportar(): StreamedResponse
    {
        $this->authorize('catalogos.exportar');

        $colores = Color::ordenado()->get(['nombre', 'hex', 'icono', 'orden']);
        $tmp = tempnam(sys_get_temp_dir(), 'export_col_') . '.xlsx';

        $headerStyle = (new Style())->withFontBold(true);
        $writer = new XlsxWriter();
        $writer->openToFile($tmp);
        $writer->addRow(Row::fromValuesWithStyle(['nombre', 'hex', 'icono', 'orden'], $headerStyle));
        foreach ($colores as $color) {
            $writer->addRow(Row::fromValues([$color->nombre, $color->hex ?? '', $color->icono ?? '', $color->orden]));
        }
        $writer->close();

        return response()->streamDownload(function () use ($tmp) {
            readfile($tmp);
            @unlink($tmp);
        }, 'colores.xlsx', ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
    }

    #[Renderless]
    public function descargarTemplate(): StreamedResponse
    {
        $this->authorize('catalogos.importar');

        $tmp = tempnam(sys_get_temp_dir(), 'tpl_col_') . '.xlsx';
        $headerStyle = (new Style())->withFontBold(true);

        $writer = new XlsxWriter();
        $writer->openToFile($tmp);
        $writer->addRow(Row::fromValuesWithStyle(['nombre', 'hex', 'icono', 'orden'], $headerStyle));
        $writer->addRow(Row::fromValues(['Azul marino', '#003087', '', 1]));
        $writer->addRow(Row::fromValues(['Blanco', '#ffffff', '', 2]));
        $writer->close();

        return response()->streamDownload(function () use ($tmp) {
            readfile($tmp);
            @unlink($tmp);
        }, 'template-colores.xlsx', ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
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
                $hex = $data['hex'] ?? '';
                if ($hex && ! preg_match('/^#[0-9A-Fa-f]{6}$/', $hex)) {
                    $errors[] = "Fila {$line}: hex '{$hex}' inválido (formato #RRGGBB).";
                    continue;
                }
                $attrs = [
                    'nombre' => $nombre,
                    'hex'    => $hex ?: null,
                    'icono'  => $data['icono'] ?? null ?: null,
                    'orden'  => (int) ($data['orden'] ?? 0),
                ];

                $existing = Color::where('nombre', $nombre)->first();

                if (! $existing) {
                    Color::create($attrs);
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
            session()->flash('success', $this->buildImportMessage($count, $updated, $skipped, 'color', 'colores'));
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
        $query = Color::withCount('productos');

        if ($this->search !== '') {
            $query->where('nombre', 'like', '%' . $this->search . '%');
        }

        return view('livewire.admin.colores.index', [
            'colores' => $query->ordenado()->paginate(15),
        ]);
    }
}
