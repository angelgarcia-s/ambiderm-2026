<?php

namespace App\Livewire\Admin\Productos;

use App\Models\Categoria;
use App\Models\Color;
use App\Models\Producto;
use App\Models\Tamano;
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
    public string $categoriaFilter = '';

    public bool $showDeleteModal = false;
    public ?int $deletingProductoId = null;

    public bool $showImportModal = false;
    public $archivoCsv = null;
    public array $importErrors   = [];
    public array $importWarnings = [];
    public int $importCount   = 0;
    public int $importSkipped = 0;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategoriaFilter(): void
    {
        $this->resetPage();
    }

    public function toggleActivo(int $id): void
    {
        $producto = Producto::findOrFail($id);
        $this->authorize('update', $producto);
        $producto->update(['activo' => ! $producto->activo]);
    }

    public function toggleDestacado(int $id): void
    {
        $producto = Producto::findOrFail($id);
        $this->authorize('update', $producto);
        $producto->update(['destacado' => ! $producto->destacado]);
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

        // Invalidar caches públicos que dependen de productos
        cache()->forget('home.productos_destacados');
        cache()->forget('nav.categorias');

        $this->showDeleteModal = false;
        $this->deletingProductoId = null;
        session()->flash('success', 'Producto eliminado.');
    }

    // — Exportar / Importar —

    #[Renderless]
    public function exportar(): StreamedResponse
    {
        $this->authorize('catalogos.exportar');

        $productos = Producto::with('categorias', 'tamanos', 'colores')->ordenado()->get();
        $tmp = tempnam(sys_get_temp_dir(), 'export_pro_') . '.xlsx';

        $headerStyle = (new Style())->withFontBold(true);
        $writer = new XlsxWriter();
        $writer->openToFile($tmp);
        $writer->addRow(Row::fromValuesWithStyle(
            ['nombre', 'slug', 'subtitulo', 'descripcion', 'material', 'url_tienda', 'categorias', 'tamanos', 'colores', 'activo', 'destacado', 'orden'],
            $headerStyle
        ));
        foreach ($productos as $p) {
            $writer->addRow(Row::fromValues([
                $p->nombre,
                $p->slug,
                $p->subtitulo ?? '',
                $p->descripcion ?? '',
                $p->material ?? '',
                $p->url_tienda ?? '',
                $p->categorias->pluck('slug')->implode('|'),
                $p->tamanos->pluck('nombre')->implode('|'),
                $p->colores->pluck('nombre')->implode('|'),
                $p->activo ? 1 : 0,
                $p->destacado ? 1 : 0,
                $p->orden,
            ]));
        }
        $writer->close();

        return response()->streamDownload(function () use ($tmp) {
            readfile($tmp);
            @unlink($tmp);
        }, 'productos.xlsx', ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
    }

    #[Renderless]
    public function descargarTemplate(): StreamedResponse
    {
        $this->authorize('catalogos.importar');

        $tmp = tempnam(sys_get_temp_dir(), 'tpl_pro_') . '.xlsx';
        $headerStyle = (new Style())->withFontBold(true);

        $writer = new XlsxWriter();
        $writer->openToFile($tmp);
        $writer->addRow(Row::fromValuesWithStyle(
            ['nombre', 'subtitulo', 'descripcion', 'material', 'url_tienda', 'categorias', 'tamanos', 'colores', 'activo', 'destacado', 'orden'],
            $headerStyle
        ));
        $writer->addRow(Row::fromValues(['Guante Látex', 'Para exploración médica', 'Guante de látex para uso médico.', 'Látex', '', 'guantes-medicos|dental', 'Chico|Mediano|Grande', 'Azul|Blanco', 1, 0, 1]));
        $writer->addRow(Row::fromValues(['Guante Nitrilo', 'Sin polvo, alta resistencia', '', 'Nitrilo', 'https://tienda.ambiderm.com/nitrilo', 'guantes-medicos', 'Mediano|Grande', 'Azul', 1, 1, 2]));
        $writer->close();

        return response()->streamDownload(function () use ($tmp) {
            readfile($tmp);
            @unlink($tmp);
        }, 'template-productos.xlsx', ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
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

                // Slug siempre generado internamente — el usuario no lo controla
                $slug = Str::slug($nombre);

                if (! Producto::where('slug', $slug)->exists()) {
                    $producto = Producto::create([
                        'nombre'      => $nombre,
                        'slug'        => $slug,
                        'subtitulo'   => $data['subtitulo'] ?? null ?: null,
                        'descripcion' => $data['descripcion'] ?? null ?: null,
                        'material'    => $data['material'] ?? null ?: null,
                        'url_tienda'  => $data['url_tienda'] ?? null ?: null,
                        'activo'      => (($data['activo'] ?? '1') === '1'),
                        'destacado'   => (($data['destacado'] ?? '0') === '1'),
                        'orden'       => (int) ($data['orden'] ?? 0),
                    ]);

                    if (! empty($data['categorias'])) {
                        $slugs = array_filter(array_map('trim', explode('|', $data['categorias'])));
                        $ids   = Categoria::whereIn('slug', $slugs)->pluck('id');
                        $producto->categorias()->attach($ids);
                    }

                    if (! empty($data['tamanos'])) {
                        $nombres = array_filter(array_map('trim', explode('|', $data['tamanos'])));
                        $ids     = Tamano::whereIn('nombre', $nombres)->pluck('id');
                        $producto->tamanos()->attach($ids);
                    }

                    if (! empty($data['colores'])) {
                        $nombres = array_filter(array_map('trim', explode('|', $data['colores'])));
                        $ids     = Color::whereIn('nombre', $nombres)->pluck('id');
                        $producto->colores()->attach($ids);
                    }

                    $count++;
                } else {
                    $warnings[] = "Fila {$line}: «{$nombre}» ya existe, omitido.";
                    $skipped++;
                }
            }
            break;
        }
        $reader->close();
        cache()->forget('home.productos_destacados');
        cache()->forget('nav.categorias');

        $this->importErrors   = $errors;
        $this->importWarnings = $warnings;
        $this->importCount    = $count;
        $this->importSkipped  = $skipped;
        $this->archivoCsv     = null;

        if (empty($errors) && empty($warnings)) {
            $this->showImportModal = false;
            $this->resetPage();
            session()->flash('success', $this->buildImportMessage($count, $skipped, 'producto', 'productos'));
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
