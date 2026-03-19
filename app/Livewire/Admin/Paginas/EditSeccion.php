<?php

namespace App\Livewire\Admin\Paginas;

use App\Models\SeccionContenido;
use App\Services\ContenidoService;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditSeccion extends Component
{
    use WithFileUploads;

    public SeccionContenido $seccionContenido;

    /** Contenido editable (copia del JSON) */
    public array $contenido = [];

    /** Imágenes temporales para items con upload (ej. soluciones_medicas) */
    public array $imagenesItems = [];

    /** Video temporal para el upload del video feature */
    public $videoFeatureFile = null;

    public function mount(SeccionContenido $seccionContenido): void
    {
        $this->seccionContenido = $seccionContenido;
        $this->contenido = $seccionContenido->contenido ?? [];
    }

    /**
     * Guardar los cambios en el contenido de la sección.
     */
    public function save(): void
    {
        $this->authorize('update', $this->seccionContenido);

        // Procesar upload de video para home.video_feature
        if (
            $this->seccionContenido->pagina === 'home' &&
            $this->seccionContenido->seccion === 'video_feature' &&
            $this->videoFeatureFile
        ) {
            $this->validate(['videoFeatureFile' => 'required|mimes:mp4,webm,mov|max:102400']);
            $path = $this->videoFeatureFile->store('secciones/videos', 'public');
            $this->contenido['video_url'] = Storage::url($path);
        }

        // Procesar uploads de imágenes para items con file upload
        if (!empty($this->imagenesItems)) {
            $fileRules = [];
            foreach ($this->imagenesItems as $i => $file) {
                if ($file) {
                    $fileRules["imagenesItems.{$i}"] = 'image|max:2048';
                }
            }
            if (!empty($fileRules)) {
                $this->validate($fileRules);
            }
            foreach ($this->imagenesItems as $i => $file) {
                if ($file) {
                    $path = $file->store('secciones', 'public');
                    $this->contenido['items'][$i]['imagen'] = Storage::url($path);
                }
            }
        }

        $this->validate($this->getRulesForSection());

        $this->seccionContenido->update([
            'contenido' => $this->contenido,
        ]);

        // Invalidar caché de la página y de la sección específica
        ContenidoService::invalidarCache(
            $this->seccionContenido->pagina,
            $this->seccionContenido->seccion
        );

        session()->flash('success', 'Contenido actualizado correctamente.');
        $this->redirect(route('admin.paginas.index'), navigate: true);
    }

    /**
     * Agregar un item a un array dentro del contenido.
     */
    public function addItem(string $key, array $template): void
    {
        $this->contenido[$key][] = $template;
    }

    /**
     * Eliminar un item de un array dentro del contenido.
     */
    public function removeItem(string $key, int $index): void
    {
        unset($this->contenido[$key][$index]);
        $this->contenido[$key] = array_values($this->contenido[$key]);
    }

    /**
     * Agregar un link al array de links (footer copyright).
     */
    public function addLink(): void
    {
        $this->contenido['links'][] = ['texto' => '', 'url' => '#'];
    }

    /**
     * Eliminar un link del array de links.
     */
    public function removeLink(int $index): void
    {
        unset($this->contenido['links'][$index]);
        $this->contenido['links'] = array_values($this->contenido['links']);
    }

    /**
     * Obtener el nombre del partial Blade para esta sección.
     */
    public function getFormPartialProperty(): string
    {
        $key = $this->seccionContenido->pagina . '.' . $this->seccionContenido->seccion;

        $map = [
            'home.hero' => 'home-hero',
            'home.video_feature' => 'home-video-feature',
            'home.coleccion' => 'home-coleccion',
            'home.soluciones_medicas' => 'home-soluciones-medicas',
            'home.eco_friendly' => 'home-eco-friendly',
            'home.youtube_video' => 'home-youtube-video',
            'nosotros.hero' => 'nosotros-hero',
            'nosotros.historia' => 'nosotros-historia',
            'nosotros.mision' => 'nosotros-mision',
            'nosotros.vision' => 'nosotros-vision',
            'nosotros.valores' => 'nosotros-valores',
            'footer.redes_sociales' => 'footer-redes-sociales',
            'footer.sucursales' => 'footer-sucursales',
            'footer.contacto' => 'footer-contacto',
            'footer.copyright' => 'footer-copyright',
        ];

        return $map[$key] ?? 'generic';
    }

    /**
     * Reglas de validación por sección.
     */
    private function getRulesForSection(): array
    {
        $key = $this->seccionContenido->pagina . '.' . $this->seccionContenido->seccion;

        $rules = [
            'home.hero' => [
                'contenido.titulo' => 'required|string|max:100',
                'contenido.subtitulo' => 'required|string|max:300',
                'contenido.imagen' => 'required|string|max:500',
                'contenido.imagen_alt' => 'required|string|max:150',
            ],
            'home.video_feature' => [
                'contenido.badge' => 'required|string|max:50',
                'contenido.nombre_producto' => 'required|string|max:100',
                'contenido.descripcion' => 'required|string|max:500',
                'contenido.video_url' => 'required|string|max:500',
                'contenido.cta_texto' => 'required|string|max:50',
                'contenido.cta_url' => 'required|string|max:300',
            ],
            'home.coleccion' => [
                'contenido.titulo' => 'required|string|max:100',
                'contenido.subtitulo' => 'required|string|max:300',
                'contenido.ver_todos_url' => 'required|string|max:500',
                'contenido.ver_todos_texto' => 'required|string|max:50',
            ],
            'home.soluciones_medicas' => [
                'contenido.titulo' => 'required|string|max:100',
                'contenido.subtitulo' => 'required|string|max:300',
                'contenido.items' => 'required|array|min:1|max:6',
                'contenido.items.*.etiqueta' => 'required|string|max:50',
                'contenido.items.*.titulo' => 'required|string|max:100',
                'contenido.items.*.imagen' => 'nullable|string|max:500',
                'contenido.items.*.url' => 'required|string|max:500',
            ],
            'home.eco_friendly' => [
                'contenido.badge' => 'required|string|max:100',
                'contenido.titulo' => 'required|string|max:100',
                'contenido.parrafo_principal' => 'required|string|max:1000',
                'contenido.parrafo_secundario' => 'required|string|max:1000',
                'contenido.imagen' => 'required|string|max:500',
                'contenido.icono' => 'required|string|max:500',
            ],
            'home.youtube_video' => [
                'contenido.video_id' => 'required|string|max:50',
            ],
            'nosotros.hero' => [
                'contenido.badge' => 'required|string|max:50',
                'contenido.titulo' => 'required|string|max:200',
                'contenido.subtitulo' => 'required|string|max:500',
            ],
            'nosotros.historia' => [
                'contenido.imagen' => 'required|string|max:500',
                'contenido.anio' => 'required|string|max:10',
                'contenido.anio_etiqueta' => 'required|string|max:100',
                'contenido.titulo' => 'required|string|max:200',
                'contenido.parrafos' => 'required|string',
            ],
            'nosotros.mision' => [
                'contenido.icono' => 'required|string|max:50',
                'contenido.titulo' => 'required|string|max:100',
                'contenido.texto' => 'required|string',
            ],
            'nosotros.vision' => [
                'contenido.icono' => 'required|string|max:50',
                'contenido.titulo' => 'required|string|max:100',
                'contenido.texto' => 'required|string',
            ],
            'nosotros.valores' => [
                'contenido.badge' => 'required|string|max:50',
                'contenido.titulo' => 'required|string|max:100',
                'contenido.subtitulo' => 'required|string|max:300',
                'contenido.items' => 'required|array|min:1|max:6',
                'contenido.items.*.icono' => 'required|string|max:50',
                'contenido.items.*.titulo' => 'required|string|max:100',
                'contenido.items.*.texto' => 'required|string|max:500',
                'contenido.items.*.color_bg' => 'required|string|max:50',
                'contenido.items.*.color_text' => 'required|string|max:50',
            ],
            'footer.redes_sociales' => [
                'contenido.logo' => 'required|string|max:500',
                'contenido.titulo' => 'required|string|max:200',
                'contenido.instagram_url' => 'required|url|max:500',
                'contenido.instagram_icono' => 'required|string|max:500',
                'contenido.facebook_url' => 'required|url|max:500',
                'contenido.facebook_icono' => 'required|string|max:500',
            ],
            'footer.sucursales' => [
                'contenido.titulo' => 'required|string|max:200',
                'contenido.items' => 'required|array|min:1|max:8',
                'contenido.items.*.region' => 'required|string|max:50',
                'contenido.items.*.nombre' => 'required|string|max:100',
                'contenido.items.*.direccion' => 'required|string|max:300',
                'contenido.items.*.telefono' => 'required|string|max:50',
                'contenido.items.*.mapa_url' => 'required|string|max:500',
                'contenido.items.*.mapa_imagen' => 'required|string|max:500',
                'contenido.items.*.mapa_key' => 'required|string|max:50',
            ],
            'footer.contacto' => [
                'contenido.badge' => 'required|string|max:100',
                'contenido.titulo' => 'required|string|max:200',
                'contenido.subtitulo' => 'required|string|max:500',
                'contenido.distribuidor_titulo' => 'required|string|max:200',
                'contenido.distribuidor_subtitulo' => 'required|string|max:200',
                'contenido.distribuidor_url' => 'required|url|max:500',
                'contenido.distribuidor_icono' => 'required|string|max:500',
                'contenido.email' => 'required|email|max:200',
            ],
            'footer.copyright' => [
                'contenido.texto' => 'required|string|max:200',
                'contenido.subtexto' => 'required|string|max:200',
                'contenido.links' => 'required|array|min:1|max:8',
                'contenido.links.*.texto' => 'required|string|max:100',
                'contenido.links.*.url' => 'required|string|max:500',
            ],
        ];

        return $rules[$key] ?? ['contenido' => 'required|array'];
    }

    public function render()
    {
        return view('livewire.admin.paginas.edit-seccion');
    }
}
