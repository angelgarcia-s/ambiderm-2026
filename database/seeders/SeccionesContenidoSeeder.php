<?php

namespace Database\Seeders;

use App\Models\SeccionContenido;
use Illuminate\Database\Seeder;

class SeccionesContenidoSeeder extends Seeder
{
    /**
     * Poblar la tabla secciones_contenido con el contenido inicial
     * de las páginas públicas (Home, Nosotros, Footer).
     *
     * Idempotente: usa updateOrCreate por [pagina, seccion].
     */
    public function run(): void
    {
        $secciones = $this->getSecciones();

        foreach ($secciones as $seccion) {
            SeccionContenido::updateOrCreate(
                [
                    'pagina' => $seccion['pagina'],
                    'seccion' => $seccion['seccion'],
                ],
                [
                    'titulo_admin' => $seccion['titulo_admin'],
                    'contenido' => $seccion['contenido'],
                    'orden' => $seccion['orden'],
                    'activo' => $seccion['activo'] ?? true,
                ]
            );
        }
    }

    /**
     * Definir todas las secciones con su contenido inicial.
     */
    private function getSecciones(): array
    {
        return [
            // ==========================================
            // HOME
            // ==========================================
            [
                'pagina' => 'home',
                'seccion' => 'hero',
                'titulo_admin' => 'Hero — Página de Inicio',
                'orden' => 1,
                'contenido' => [
                    'titulo' => 'Ambiderm',
                    'subtitulo' => 'Siente la diferencia. Seguridad clínica con tacto natural.',
                    'imagen' => '/images/hero-colores.png',
                    'imagen_alt' => 'Ambiderm Collection',
                ],
            ],
            [
                'pagina' => 'home',
                'seccion' => 'video_feature',
                'titulo_admin' => 'Producto Destacado (Video)',
                'orden' => 2,
                'contenido' => [
                    'badge' => 'NUEVO',
                    'nombre_producto' => 'Vinyl Synmax',
                    'descripcion' => 'Siente la revolución en protección clínica. Una nueva era de seguridad y confort táctil.',
                    'video_url' => '/videos/vinyl.mp4',
                    'cta_texto' => 'Comprar ahora',
                    'cta_url' => '/productos',
                ],
            ],
            [
                'pagina' => 'home',
                'seccion' => 'coleccion',
                'titulo_admin' => 'Los Destacados (Encabezado)',
                'orden' => 3,
                'contenido' => [
                    'titulo' => 'Los Destacados.',
                    'subtitulo' => 'Encuentra el ajuste perfecto para ti.',
                    'ver_todos_url' => '/productos',
                    'ver_todos_texto' => 'Ver todos',
                ],
            ],
            [
                'pagina' => 'home',
                'seccion' => 'soluciones_medicas',
                'titulo_admin' => 'Soluciones Médicas',
                'orden' => 4,
                'contenido' => [
                    'titulo' => 'Soluciones médicas',
                    'subtitulo' => 'Protección especializada para cada sector.',
                    'items' => [
                        [
                            'etiqueta' => 'Especialidad',
                            'titulo' => 'Guantes',
                            'imagen' => '/images/guantes.png',
                            'url' => '/productos?categoria=guantes',
                        ],
                        [
                            'etiqueta' => 'Especialidad',
                            'titulo' => 'Dental',
                            'imagen' => '/images/dental.png',
                            'url' => '/productos?categoria=dental',
                        ],
                        [
                            'etiqueta' => 'Indumentaria',
                            'titulo' => 'Ropa Médica',
                            'imagen' => '/images/ropa.png',
                            'url' => '/productos?categoria=ropa-medica',
                        ],
                        [
                            'etiqueta' => 'Esenciales',
                            'titulo' => 'Dispositivos Médicos',
                            'imagen' => '/images/medico.png',
                            'url' => '/productos?categoria=dispositivos-medicos',
                        ],
                    ],
                ],
            ],
            [
                'pagina' => 'home',
                'seccion' => 'eco_friendly',
                'titulo_admin' => 'Eco-Friendly',
                'orden' => 5,
                'contenido' => [
                    'badge' => 'Responsabilidad Ambiental',
                    'titulo' => '100% LÁTEX NATURAL',
                    'parrafo_principal' => 'Gracias a su composición de origen natural nuestros guantes de látex Ambiderm se reintegran de una manera más rápida reduciendo el impacto en el medio ambiente.',
                    'parrafo_secundario' => 'Nuestros guantes están fabricados con látex natural, provenientes del árbol del hule (Hevea Brasiliensis), que brinda mayor elasticidad y protección a comparación de otros tipos de guantes.',
                    'imagen' => '/images/eco-foto.png',
                    'icono' => '/images/eco-friendly-icon.png',
                ],
            ],
            [
                'pagina' => 'home',
                'seccion' => 'youtube_video',
                'titulo_admin' => 'Video YouTube',
                'orden' => 6,
                'contenido' => [
                    'video_id' => 'DkVU_4Mir6Y',
                ],
            ],

            // ==========================================
            // NOSOTROS
            // ==========================================
            [
                'pagina' => 'nosotros',
                'seccion' => 'hero',
                'titulo_admin' => 'Hero — Nosotros',
                'orden' => 1,
                'contenido' => [
                    'badge' => 'Nuestra Esencia',
                    'titulo' => 'Más de 30 años protegiéndote.',
                    'subtitulo' => 'Innovación mexicana al servicio de la salud. Desde 1988, garantizamos seguridad y calidad en cada producto.',
                ],
            ],
            [
                'pagina' => 'nosotros',
                'seccion' => 'historia',
                'titulo_admin' => 'Nuestra Historia',
                'orden' => 2,
                'contenido' => [
                    'imagen' => '/images/guantes-agua.jpeg',
                    'anio' => '1988',
                    'anio_etiqueta' => 'Fundación en México',
                    'titulo' => 'Orgullosamente Mexicanos',
                    'parrafos' => '<p><strong class="text-[#1d1d1f]">Ambiderm se fundó en 1988</strong>, iniciando operaciones como pioneros en la fabricación de guantes de látex en el país. Nuestra visión siempre fue clara: ofrecer productos que combinaran máxima protección con un confort excepcional.</p><p>En 1998, consolidamos nuestra fortaleza al fusionarnos con <strong class="text-[#1d1d1f]">Supertex Industrial</strong>, creando un grupo sólido que hoy lidera el mercado nacional. Somos una empresa 100% mexicana, comprometida con el desarrollo de nuestra industria y el bienestar de quienes confían sus manos a nuestra tecnología.</p>',
                ],
            ],
            [
                'pagina' => 'nosotros',
                'seccion' => 'mision',
                'titulo_admin' => 'Misión',
                'orden' => 3,
                'contenido' => [
                    'icono' => 'target',
                    'titulo' => 'Misión',
                    'texto' => 'Ser líder nacional en la fabricación y comercialización de guantes y productos desechables para la industria dental y médica. Garantizamos la <strong class="text-blue-600">segura protección, comodidad y mejor desempeño</strong> de nuestros usuarios, ofreciendo calidad superior y el mejor servicio a nuestros socios comerciales.',
                ],
            ],
            [
                'pagina' => 'nosotros',
                'seccion' => 'vision',
                'titulo_admin' => 'Visión',
                'orden' => 4,
                'contenido' => [
                    'icono' => 'eye',
                    'titulo' => 'Visión',
                    'texto' => 'Ser la marca líder en guantes desechables <strong class="text-blue-600">más confiable en México y Centroamérica</strong>, y el proveedor más completo de soluciones para la industria médica y dental. Buscamos trascender a través de la innovación y la confianza que generamos en cada procedimiento.',
                ],
            ],
            [
                'pagina' => 'nosotros',
                'seccion' => 'valores',
                'titulo_admin' => 'Nuestros Valores',
                'orden' => 5,
                'contenido' => [
                    'badge' => 'Nuestros Valores',
                    'titulo' => 'Compromiso Total',
                    'subtitulo' => 'Nos regimos por estándares internacionales para cuidar de ti y del planeta.',
                    'items' => [
                        [
                            'icono' => 'leaf',
                            'titulo' => 'Eco-Friendly',
                            'texto' => 'Nuestros guantes de látex natural se reintegran más rápido al medio ambiente, reduciendo la huella ecológica.',
                            'color_bg' => 'bg-green-100',
                            'color_text' => 'text-green-600',
                        ],
                        [
                            'icono' => 'award',
                            'titulo' => 'Calidad Certificada',
                            'texto' => 'Cumplimos con normas internacionales y contamos con certificaciones nacionales que validan nuestra seguridad.',
                            'color_bg' => 'bg-blue-100',
                            'color_text' => 'text-blue-600',
                        ],
                        [
                            'icono' => 'users',
                            'titulo' => 'Capital Humano',
                            'texto' => 'Contribuimos al desarrollo profesional de nuestros colaboradores y al crecimiento de las comunidades donde operamos.',
                            'color_bg' => 'bg-purple-100',
                            'color_text' => 'text-purple-600',
                        ],
                    ],
                ],
            ],

            // ==========================================
            // FOOTER
            // ==========================================
            [
                'pagina' => 'footer',
                'seccion' => 'redes_sociales',
                'titulo_admin' => 'Redes Sociales y Logo',
                'orden' => 1,
                'contenido' => [
                    'logo' => '/images/logo-azul.svg',
                    'titulo' => 'SÍGUENOS EN REDES SOCIALES',
                    'instagram_url' => 'https://www.instagram.com/ambiderm/?hl=es-la',
                    'instagram_icono' => '/images/instagram-icon.png',
                    'facebook_url' => 'https://www.facebook.com/Ambiderm/',
                    'facebook_icono' => '/images/facebook-icon.png',
                ],
            ],
            [
                'pagina' => 'footer',
                'seccion' => 'sucursales',
                'titulo_admin' => 'Sucursales / Ubicaciones',
                'orden' => 2,
                'contenido' => [
                    'titulo' => 'UBICACIONES ESTRATÉGICAS',
                    'items' => [
                        [
                            'region' => 'Matriz',
                            'nombre' => 'SAN ISIDRO',
                            'direccion' => "Carr. a Bosques de San Isidro No. 1136\nZapopan, Jalisco",
                            'telefono' => '+52 33 3656 6557',
                            'mapa_url' => 'https://goo.gl/maps/kD76mn5gFhNue5X47',
                            'mapa_imagen' => '/images/gdl.png',
                            'mapa_key' => 'gdl',
                        ],
                        [
                            'region' => 'Norte',
                            'nombre' => 'TIJUANA',
                            'direccion' => "Calle Mariscal sucre No. 30 C\nFracc. Castro, Olivos",
                            'telefono' => '+52 664 608 1627',
                            'mapa_url' => 'https://goo.gl/maps/PEStmVVbnVFVpMvH9',
                            'mapa_imagen' => '/images/tijuana.png',
                            'mapa_key' => 'tijuana',
                        ],
                        [
                            'region' => 'Centro',
                            'nombre' => 'COSTA RICA',
                            'direccion' => "La Valencia de Heredia,\nOficentro Tech Park",
                            'telefono' => '+506 2237 3377',
                            'mapa_url' => 'https://goo.gl/maps/bCASmcuCuxvA9csg9',
                            'mapa_imagen' => '/images/costa-rica.png',
                            'mapa_key' => 'costa-rica',
                        ],
                        [
                            'region' => 'Centro',
                            'nombre' => 'GUATEMALA',
                            'direccion' => "Calzada Atanasio Tzul 22-00\nEmpresarial cortijo II",
                            'telefono' => '+502 2209 2000',
                            'mapa_url' => 'https://goo.gl/maps/TNuRDPTZxkZqqU659',
                            'mapa_imagen' => '/images/guatemala.png',
                            'mapa_key' => 'guatemala',
                        ],
                    ],
                ],
            ],
            [
                'pagina' => 'footer',
                'seccion' => 'contacto',
                'titulo_admin' => 'Contacto y Distribuidor',
                'orden' => 3,
                'contenido' => [
                    'badge' => 'Mantenlo cerca',
                    'titulo' => '¿TIENES ALGUNA DUDA?',
                    'subtitulo' => 'Déjanos un mensaje y un especialista se pondrá en contacto contigo a la brevedad.',
                    'distribuidor_titulo' => 'QUIERO SER DISTRIBUIDOR',
                    'distribuidor_subtitulo' => 'Únete a la red Ambiderm',
                    'distribuidor_url' => 'https://share.hsforms.com/1vl6EkSEKQBW_SNv3Im1qcA3qrdx',
                    'distribuidor_icono' => '/images/distribuidor-icon.svg',
                    'email' => 'info@ambiderm.com.mx',
                ],
            ],
            [
                'pagina' => 'footer',
                'seccion' => 'copyright',
                'titulo_admin' => 'Copyright y Links Legales',
                'orden' => 4,
                'contenido' => [
                    'texto' => 'COPYRIGHT © 2026 AMBIDERM S.A. DE C.V.',
                    'subtexto' => 'TODOS LOS DERECHOS RESERVADOS',
                    'links' => [
                        ['texto' => 'Términos', 'url' => '/terminos-y-condiciones'],
                        ['texto' => 'Privacidad', 'url' => '/aviso-de-privacidad'],
                        ['texto' => 'Cookies', 'url' => '/politica-de-cookies'],
                        ['texto' => 'Bolsa de Trabajo', 'url' => '/bolsa-de-trabajo'],
                    ],
                ],
            ],
        ];
    }
}
