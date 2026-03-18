<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vinyl Synmax | Ambiderm</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Landing page for Vinyl Synmax">
    <meta name="keywords" content="gloves, vinyl, synmax, premium">
    <meta name="robots" content="index, follow">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-blue': '#A0D8F1',
                        'dark-blue': '#004F9F',
                        'deep-blue': '#002D5A',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Brevo -->
    <script src="https://cdn.brevo.com/js/sdk-loader.js" async></script>
    <script>
        // Version: 2.0
        window.Brevo = window.Brevo || [];
        Brevo.push([
            "init",
            {
                client_key: "qopiwr92io9xn9mdqo5cqwta",
                // Optional: Add other initialization options, see documentation
            }
        ]);
    </script>

    <!-- Bootstrap 5 CSS (For Modals & Grid Compatibility) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            color: #002D5A;
            overflow-x: hidden;
            padding-top: 80px;
            /* Space for fixed nav */
        }

        /* --- PREMIUM EFFECTS --- */
        .hero-section {
            background: linear-gradient(180deg, #00A3FF 0%, #0076D6 100%);
            position: relative;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
        }

        .hero-bg-image {
            background-image: url('{{ asset('images/landing/synmax/hero-bg.png') }}');
        }

        .colores-bg-image-wrapper {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .text-outline {
            -webkit-text-stroke: 1px rgba(255, 255, 255, 0.3);
            color: transparent;
            font-size: 10rem;
            line-height: 1;
            position: absolute;
            right: -5%;
            top: 20%;
            z-index: -1;
            user-select: none;
        }

        .glass-button {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .animate-bounce-slow {
            animation: bounce 3s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        /* Existing premium effects */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .modal-content {
            border-radius: 30px !important;
            border: none !important;
            overflow: hidden !important;
        }

        .modal-backdrop {
            background-color: rgba(0, 45, 90, 0.5) !important;
        }

        .premium-nav {
            background: white !important;
            box-shadow: 0 4px 20px rgba(0, 79, 159, 0.8);
            z-index: 9999 !important;
        }

        .nav-link-premium {
            font-weight: 500 !important;
            color: #004F9F !important;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.1em;
            padding: 0.5rem 0.5rem !important;
            opacity: 1 !important;
            display: block !important;
        }

        .navbar-collapse.collapse {
            visibility: visible !important;
        }

        @media (max-width: 991px) {
            .navbar-collapse.collapse:not(.show) {
                display: none !important;
            }

            .text-outline {
                font-size: 6rem;
                right: 0;
            }
        }
    </style>
</head>

<body class="bg-white">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top premium-nav py-4">
        <div class="container">
            <a class="navbar-brand p-0" href="#">
                <img src="{{ asset('images/logo-azul.svg') }}" alt="Ambiderm Logo" class="h-8 lg:h-10">
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#premiumNavbar">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#004F9F" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>

            <div class="collapse navbar-collapse" id="premiumNavbar">
                <ul class="navbar-nav ms-auto items-center gap-2 lg:gap-4 list-none p-0 m-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-premium" href="#info">Conoce Synmax</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-premium" href="#info">Características</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-premium" href="#familia">Familia Vinyl</a>
                    </li>
                    <li class="nav-item ms-lg-4">
                        <a href="https://share.hsforms.com/1vl6EkSEKQBW_SNv3Im1qcA3qrdx" target="_blank"
                            class="bg-primary-blue text-dark-blue font-black py-2 px-6 rounded-full uppercase tracking-widest text-[0.7rem] shadow-xl shadow-primary-blue/20 hover:bg-dark-blue hover:text-white transition-all">
                            Quiero vender Synmax
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="landing-wrapper font-sans text-white">
        <!-- HERO -->
        <section
            class="hero-section hero-bg-image relative min-h-[calc(100vh-80px)] flex items-stretch  overflow-hidden">

            <!-- Contenedor de dos columnas -->
            <div class="w-full flex flex-col lg:flex-row">

                <!-- Columna Izquierda: Imagen del producto desde el top -->
                <div class="lg:w-3/5 flex items-start justify-center">
                    <img src="{{ asset('images/landing/synmax/hero-product.png') }}" alt="Vinyl Synmax Hands"
                        class="h-100 md:h-[80vh] w-full md:w-[100vh] object-contain object-top transform lg:scale-110">
                </div>

                <!-- Columna Derecha: Imagen de título y texto centrados -->
                <div class="lg:w-2/5 flex items-center justify-center p-6 md:p-10 xl:p-20 mt-0 md:mt-10 lg:mt-0">
                    <div class="text-center w-full max-w-2xl justify-center">
                        <!-- PNG del título -->
                        <img src="{{ asset('images/landing/synmax/hero-titulo.png') }}" alt="NUEVO Vinyl Synmax"
                            class="mx-auto w-80 sm:w-full h-auto md:mb-8 mb-2  drop-shadow-2xl">

                        <p
                            class="text-2xl md:text-2xl lg:text-3xl font-bold mb-8 md:mb-12 tracking-tight drop-shadow-lg">
                            La Nueva Generación del Vinyl
                        </p>

                        <button
                            class="glass-button text-white font-black py-2 px-3 rounded-full uppercase tracking-[0.2em] text-sm md:px-4 lg:text-base hover:bg-white hover:text-dark-blue transition-all duration-500 transform hover:scale-105 active:scale-95 shadow-2xl"
                            data-bs-toggle="modal" data-bs-target="#registerModal">
                            Solicita tus muestras gratis
                        </button>
                    </div>
                </div>

            </div>

            <!-- Flecha de Scroll -->
            <div class="absolute bottom-1 md:bottom-10 left-1/2 -ml-4 -translate-x-1/2 animate-bounce-slow lg:block">
                <a href="#info" class="text-white hover:opacity-70 transition-opacity">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7 13l5 5 5-5M7 6l5 5 5-5" />
                    </svg>
                </a>
            </div>
        </section>

        <!-- ABOUT -->
        <section id="info" class="py-24 bg-white text-center">
            <div class="container mx-auto px-6 max-w-6xl">
                <h2 class="text-4xl md:text-5xl font-black text-dark-blue mb-8 uppercase tracking-wide">Conoce El Nuevo
                    Vinyl</h2>
                <div class="mb-10">
                    <h4 class="text-2xl md:text-3xl font-bold mb-6 text-primary-blue">Synmax <span
                            class="font-light text-primary-blue">reivindica ese material olvidado:<br>Flexible,
                            Económico y Libre de Látex</span></h4>
                    <div class="w-64 sm:w-96 h-1 bg-primary-blue mx-auto rounded-full"></div>
                </div>
                <p class="text-lg md:text-xl text-gray-500 leading-relaxed font-light mb-2">
                    Los guantes regulares de vinyl están fabricados de <span
                        class="font-bold text-dark-blue bg-sky-50 px-2 py-1 rounded">PVC</span>, Ambiderm Vinyl Synmax,
                    agrega a su formulación polímeros que lo hacen más <span
                        class="font-bold text-dark-blue bg-sky-50 px-2 py-1 rounded">flexible</span> y <span
                        class="font-bold text-dark-blue bg-sky-50 px-2 py-1 rounded">resistente</span>.
                </p>
                <p class="text-lg md:text-xl text-gray-500 leading-relaxed font-light mb-8">
                    El Vinyl no contiene proteínas. El Vinyl resulta más <span
                        class="font-bold text-dark-blue bg-sky-50 px-2 py-1 rounded">económico</span> que las otras
                    opciones sintéticas, lo que lo hace práctico para situaciones de uso frecuente.
                </p>
                <h2 class="text-3xl md:text-4xl font-light text-dark-blue mb-8 tracking-wide"> <span
                        class="font-bold text-dark-blue bg-sky-50 px-2 py-1 rounded">MÁS FLEXIBLE</span>
                    que el Vinyl Regular</h2>
                <h2 class="text-3xl md:text-4xl font-light text-dark-blue mb-8 tracking-wide">
                    <span class="text-6xl font-bold text-dark-blue bg-sky-50 px-2 py-1 rounded">10x </span>
                    más resistente a la abrasión que el nitrilo
                </h2>
            </div>
        </section>

        <!-- SHOWCASE -->
        <section class="colores-bg-image-wrapper">
            <!-- La imagen dicta el alto de la sección proporcionalmente -->
            <img src="{{ asset('images/landing/synmax/colores-bg.png') }}" class="w-full h-auto" alt="Vinyl Colors">

            <!-- Contenido overlay -->
            <!-- <div class="absolute inset-0 flex items-center justify-center p-6">
                <div class="container mx-auto text-center">
                    <div class="flex flex-col md:flex-row items-center justify-center gap-8"> -->
            <!-- Card Central -->
            <!--<div class="px-8 py-4 border border-dashed border-gray-300 rounded-2xl bg-white/80 backdrop-blur-sm shadow-sm inline-block transform translate-y-4">
                            <h3 class="text-2xl font-black text-dark-blue leading-none uppercase">Colores</h3>
                            <small class="text-gray-400 font-bold tracking-[0.4em] uppercase">Vinyl Synmax</small>
                        </div>
                    </div>
                </div>
            </div> -->
        </section>

        <!-- ICONS GRID -->
        <section class="py-24 container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8">
                <!-- Icon 1 -->
                <div class="flex flex-col items-center group cursor-default">
                    <div
                        class="w-20 h-20 bg-[#f8fbff] border border-sky-100 rounded-2xl flex items-center justify-center mb-4 transition-all duration-300 group-hover:bg-dark-blue group-hover:border-dark-blue group-hover:-translate-y-2 shadow-sm group-hover:shadow-lg">
                        <img src="{{ asset('images/landing/synmax/icono-liso.svg') }}"
                            class="w-16 h-16 object-contain group-hover:brightness-0 group-hover:invert transition-all"
                            alt="Ambiderm Use">
                    </div>
                    <div
                        class="text-[0.65rem] font-light text-dark-blue text-center leading-tight tracking-[0.1em] uppercase px-1 opacity-80 group-hover:opacity-100">
                        Acabado liso</div>
                </div>

                <!-- Icon 2 -->
                <div class="flex flex-col items-center group cursor-default">
                    <div
                        class="w-20 h-20 bg-[#f8fbff] border border-sky-100 rounded-2xl flex items-center justify-center mb-4 transition-all duration-300 group-hover:bg-dark-blue group-hover:border-dark-blue group-hover:-translate-y-2 shadow-sm group-hover:shadow-lg">
                        <img src="{{ asset('images/landing/synmax/icono-polimeros.svg') }}"
                            class="w-16 h-16 object-contain group-hover:brightness-0 group-hover:invert transition-all"
                            alt="Polímero">
                    </div>
                    <div
                        class="text-[0.65rem] font-light text-dark-blue text-center leading-tight tracking-[0.1em] uppercase px-1 opacity-80 group-hover:opacity-100">
                        pvc + polímeros</div>
                </div>

                <!-- Icon 3 -->
                <div class="flex flex-col items-center group cursor-default">
                    <div
                        class="w-20 h-20 bg-[#f8fbff] border border-sky-100 rounded-2xl flex items-center justify-center mb-4 transition-all duration-300 group-hover:bg-dark-blue group-hover:border-dark-blue group-hover:-translate-y-2 shadow-sm group-hover:shadow-lg">
                        <img src="{{ asset('images/landing/synmax/icono-flexible.svg') }}"
                            class="w-16 h-16 object-contain group-hover:brightness-0 group-hover:invert transition-all "
                            alt="Flexible">
                    </div>
                    <div
                        class="text-[0.65rem] font-light text-dark-blue text-center leading-tight tracking-[0.1em] uppercase px-1 opacity-80 group-hover:opacity-100">
                        MÁS FLEXIBLE</div>
                </div>

                <!-- Icon 4 -->
                <div class="flex flex-col items-center group cursor-default">
                    <div
                        class="w-20 h-20 bg-[#f8fbff] border border-sky-100 rounded-2xl flex items-center justify-center mb-4 transition-all duration-300 group-hover:bg-dark-blue group-hover:border-dark-blue group-hover:-translate-y-2 shadow-sm group-hover:shadow-lg">
                        <img src="{{ asset('images/landing/synmax/icono-resistencia.svg') }}"
                            class="w-16 h-16 object-contain group-hover:brightness-0 group-hover:invert transition-all"
                            alt="Resistente">
                    </div>
                    <div
                        class="text-[0.65rem] font-light text-dark-blue text-center leading-tight tracking-[0.1em] uppercase px-1 opacity-80 group-hover:opacity-100">
                        RESISTENTE A PERFORACIONES</div>
                </div>

                <!-- Icon 5 -->
                <div class="flex flex-col items-center group cursor-default">
                    <div
                        class="w-20 h-20 bg-[#f8fbff] border border-sky-100 rounded-2xl flex items-center justify-center mb-4 transition-all duration-300 group-hover:bg-dark-blue group-hover:border-dark-blue group-hover:-translate-y-2 shadow-sm group-hover:shadow-lg">
                        <img src="{{ asset('images/landing/synmax/icono-libre_de_polvo.svg') }}"
                            class="w-16 h-16 object-contain group-hover:brightness-0 group-hover:invert transition-all"
                            alt="Libre de Polvo">
                    </div>
                    <div
                        class="text-[0.65rem] font-light text-dark-blue text-center leading-tight tracking-[0.1em] uppercase px-1 opacity-80 group-hover:opacity-100">
                        LIBRE DE POLVO</div>
                </div>

                <!-- Icon 6 -->
                <div class="flex flex-col items-center group cursor-default">
                    <div
                        class="w-20 h-20 bg-[#f8fbff] border border-sky-100 rounded-2xl flex items-center justify-center mb-4 transition-all duration-300 group-hover:bg-dark-blue group-hover:border-dark-blue group-hover:-translate-y-2 shadow-sm group-hover:shadow-lg">
                        <img src="{{ asset('images/landing/synmax/icono_elongacion.svg') }}"
                            class="w-16 h-16 object-contain group-hover:brightness-0 group-hover:invert transition-all"
                            alt="Elongación">
                    </div>
                    <div
                        class="text-[0.65rem] font-light text-dark-blue text-center leading-tight tracking-[0.1em] uppercase px-1 opacity-80 group-hover:opacity-100">
                        ELONGACIÓN DE >400%</div>
                </div>
            </div>
        </section>

        <!-- FAMILY -->
        <section id="familia" class="py-24 bg-gradient-to-b from-sky-50 to-sky-100">
            <div class="container mx-auto px-6">
                <h2 class="text-4xl font-extrabold text-dark-blue text-center mb-16 uppercase tracking-widest">Familia
                    Vinyl</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <!-- Card 1: Vinyl Light -->
                    <div
                        class="glass-card p-10 rounded-[2.5rem] flex flex-col items-center transition-all duration-500 scale-90 hover:bg-white hover:shadow-2xl group">
                        <div
                            class="w-64 h-64 bg-white border border-gray-100 rounded-full flex items-center justify-center p-4 mb-8 shadow-sm group-hover:scale-105 transition-transform duration-500 overflow-hidden">
                            <img src="{{ asset('images/landing/synmax/Caja-Vinyl-Light.png') }}"
                                class="w-full h-full object-contain" alt="Vinyl Light">
                        </div>
                        <h4
                            class="text-2xl font-black text-dark-blue uppercase tracking-tight mb-4 text-center scale-110">
                            Vinyl Light</h4>
                        <div class="text-xs font-semibold text-gray-400 text-center leading-loose scale-110">
                            Elongación >300%<br>
                            Espesor 0.05mm<br>
                            Tensión >11 MPa<br>
                            Largo 240mm<br>
                            Sin polvo
                        </div>
                    </div>

                    <!-- Card 2: Vinyl Synmax -->
                    <div
                        class="glass-card p-10 rounded-[2.5rem] flex flex-col items-center transition-all duration-500 hover:bg-white hover:shadow-2xl group ring-1 ring-azul-300">
                        <div
                            class="w-64 h-64 bg-white border border-gray-100 rounded-full flex items-center justify-center p-4 mb-8 shadow-sm group-hover:scale-105 transition-transform duration-500 overflow-hidden">
                            <img src="{{ asset('images/landing/synmax/Caja-Vinyl-Synmax.png') }}"
                                class="w-full h-full object-contain" alt="Vinyl Synmax">
                        </div>
                        <h4 class="text-2xl font-black text-dark-blue uppercase tracking-tight mb-4 text-center">Vinyl
                            Synmax</h4>
                        <div class="text-xs font-semibold text-gray-400 text-center leading-loose">
                            Elongación >400%<br>
                            Espesor 0.06mm<br>
                            Tensión >18 MPa<br>
                            Largo 240mm<br>
                            Sin polvo
                        </div>
                    </div>

                    <!-- Card 3: Vinyl LP -->
                    <div
                        class="glass-card p-10 rounded-[2.5rem] flex flex-col items-center transition-all duration-500 scale-90 hover:bg-white hover:shadow-2xl group">
                        <div
                            class="w-64 h-64 bg-white border border-gray-100 rounded-full flex items-center justify-center p-4 mb-8 shadow-sm group-hover:scale-105 transition-transform duration-500 overflow-hidden">
                            <img src="{{ asset('images/landing/synmax/Caja-Vinyl-LP.png') }}"
                                class="w-full h-full object-contain" alt="Vinyl LP">
                        </div>
                        <h4
                            class="text-2xl font-black text-dark-blue uppercase tracking-tight mb-4 text-center scale-110">
                            Vinyl LP</h4>
                        <div class="text-xs font-semibold text-gray-400 text-center leading-loose scale-110">
                            Elongación >350%<br>
                            Espesor 0.08mm<br>
                            Tensión >12 MPa<br>
                            Largo 240mm<br>
                            Sin polvo
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECONDARY CTA -->
        <section class="py-0 lg:px-24 container mx-auto px-6 overflow-hidden">
            <div class="flex flex-col lg:flex-row items-start justify-between gap-16">
                <div class="lg:w-1/2 md:py-16 xl:py-24 text-left lg:text-left">
                    <h2 class="text-4xl md:text-5xl font-black text-dark-blue mb-8 leading-tight">Conoce la nueva <br
                            class="hidden lg:block"> generación del vinyl</h2>
                    <p class="text-xl text-gray-400 font-light mb-10">Solicita tus muestras gratis.</p>
                    <button
                        class="bg-primary-blue text-dark-blue font-extrabold py-3 px-6 rounded-full uppercase tracking-widest text-sm shadow-xl shadow-primary-blue/30 transition-all hover:-translate-y-1 hover:bg-dark-blue hover:text-white"
                        data-bs-toggle="modal" data-bs-target="#registerModal">
                        Solicitar Muestras
                    </button>
                </div>

                <div class="lg:w-1/2 relative flex justify-center lg:justify-end">
                    <!-- Imagen Principal (Producto/Dispositivo) -->
                    <div class="relative z-10 w-full max-w-lg hidden md:block">
                        <img src="{{ asset('images/landing/synmax/cta-main.png') }}" alt="Vinyl Synmax Experience"
                            class="h-full w-full object-contain object-top transform lg:scale-150 origin-top">
                    </div>
                    <div class="relative z-10 w-full max-w-lg block md:hidden">
                        <img src="{{ asset('images/landing/synmax/hero-titulo.png') }}" alt="Vinyl Synmax Experience"
                            class="h-full w-full object-contain object-top transform lg:scale-150 origin-top">
                    </div>
                    <!-- Ilustración Flotante -->
                    <div class="absolute top-10 z-20 w-48 h-48 hidden md:block">
                        <img src="{{ asset('images/landing/synmax/hero-titulo.png') }}" alt="Synmax Illustration"
                            class="w-full h-auto drop-shadow-xl bg-white/20">
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER RECRUITMENT -->
        <section class="bg-gradient-to-br from-dark-blue to-deep-blue text-white py-16 text-center">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl md:text-3xl font-bold mb-4 leading-tight tracking-tight">¿Te interesa formar parte
                    de <br class="hidden md:block"> nuestra red de distribuidores?</h2>
                <p class="text-xl md:text-xl text-sky-200/70 max-w-4xl mx-auto mb-16 font-light">Completa el formulario
                    y únete a la Familia Ambiderm</p>
                <a href="https://share.hsforms.com/1vl6EkSEKQBW_SNv3Im1qcA3qrdx" target="_blank"
                    class="relative inline-flex items-center justify-center px-6 py-2 mb-2 mr-2 overflow-hidden text-sm font-medium rounded-full bg-gradient-to-br from-primary-blue to-sky-400 group-hover:from-primary-blue group-hover:to-sky-400 focus:ring-4 focus:outline-none focus:ring-sky-200">
                    Quiero ser distribuidor</a>
            </div>
        </section>

        <footer class="py-8 bg-white text-center border-t border-gray-100">
            <p class="text-[0.6rem] font-bold text-gray-400 uppercase tracking-widest">© {{ date('Y') }} Ambiderm. All
                Rights Reserved.</p>
        </footer>
    </div>

    <!-- REGISTRATION MODAL -->
    <div class="modal fade" id="registerModal" tabindex="-1">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content shadow-2xl border-none">
                <div class="modal-header bg-dark-blue text-white p-8 border-none flex justify-between items-center">
                    <h3 class="text-xl font-black uppercase tracking-widest leading-none">Validación de cliente</h3>
                    <button type="button" class="text-white hover:opacity-50 transition-opacity"
                        data-bs-dismiss="modal">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="modal-body p-12">
                    <p class="text-gray-400 font-medium mb-10 text-center">Ingresa tus datos para validar que ya
                        eres un distribuidor autorizado y recibir tus muestras.</p>

                    <form id="rfc-trigger-form" class="space-y-8">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <input type="hidden" name="producto" value="SYNMAX">
                                <label
                                    class="block text-md font-bold text-dark-blue tracking-[0.2em] mb-3 ml-2">RFC</label>
                                <input type="text" name="rfc" required
                                    class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-3 px-6 uppercase focus:ring-4 focus:ring-primary-blue/30 outline-none transition-all font-light"
                                    placeholder="ABCD123456XYZ">
                                <small
                                    class="text-gray-300 font-bold text-[0.6rem] ml-2 block mt-2 uppercase italic text-center">Persona
                                    física o moral.</small>
                            </div>
                            <div>
                                <label class="block text-md font-bold text-dark-blue tracking-[0.2em] mb-3 ml-2">Razón
                                    Social</label>
                                <input type="text" name="razon_social" required
                                    class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-3 px-6 uppercase focus:ring-4 focus:ring-primary-blue/30 outline-none transition-all font-light"
                                    placeholder="Nombre completo">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" id="submit-btn"
                                class="bg-primary-blue text-dark-blue font-black py-2 px-8 rounded-xl tracking-widest text-sm shadow-lg shadow-blue-100 transition-all hover:scale-[1.02] active:scale-95">
                                Validar
                            </button>
                        </div>
                    </form>

                    <div id="status-display" class="mt-8 hidden">
                        <div id="status-alert" class="p-6 rounded-2xl font-bold text-center"></div>
                    </div>

                    <!-- <div id="debug-container" class="mt-8 hidden">
                        <h5
                            class="flex items-center justify-center gap-2 text-[0.55rem] font-black text-gray-300 uppercase tracking-widest mb-3 px-2">
                            Backend Signal (JSON)
                        </h5>
                        <pre id="json-debug"
                            class="bg-gray-900 text-emerald-400/80 p-6 rounded-2xl text-[0.7rem] overflow-auto max-h-48 font-mono shadow-inner"></pre>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts: Bootstrap 5 (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('rfc-trigger-form');
            const submitBtn = document.getElementById('submit-btn');
            const statusDisplay = document.getElementById('status-display');
            const statusAlert = document.getElementById('status-alert');
            /* const debugContainer = document.getElementById('debug-container');
            const jsonDebug = document.getElementById('json-debug'); */

            if (form) {
                form.addEventListener('submit', async function (e) {
                    e.preventDefault();

                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="inline-block animate-spin mr-3">◌</span> Procesando...';
                    statusDisplay.classList.add('hidden');
                    // debugContainer.classList.add('hidden');

                    const formData = new FormData(form);
                    const data = {
                        rfc: formData.get('rfc'),
                        razon_social: formData.get('razon_social'),
                        producto: formData.get('producto'),
                    };

                    try {
                        const response = await fetch('{{ route('brevo.rfc-trigger') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify(data)
                        });

                        const result = await response.json();

                        statusDisplay.classList.remove('hidden');
                        statusAlert.className = `p-6 rounded-2xl font-bold text-center ${result.success ? 'bg-emerald-50 text-emerald-800 border border-emerald-100' : 'bg-rose-50 text-rose-800 border border-rose-100'}`;
                        statusAlert.innerHTML = `<strong>${result.success ? '¡Éxito!' : 'Aviso'}</strong>: ${result.message}`;

                        /* debugContainer.classList.remove('hidden');
                        jsonDebug.textContent = JSON.stringify(result, null, 4); */

                    } catch (error) {
                        statusDisplay.classList.remove('hidden');
                        statusAlert.className = 'p-6 rounded-2xl font-bold bg-rose-500 text-white text-center';
                        statusAlert.textContent = 'Error crítico: ' + error.message;

                        /* debugContainer.classList.remove('hidden');
                        jsonDebug.textContent = 'Error: ' + error.message; */

                    } finally {
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Validar y Solicitar Muestras';
                    }
                });
            }
        });
    </script>
</body>

</html>