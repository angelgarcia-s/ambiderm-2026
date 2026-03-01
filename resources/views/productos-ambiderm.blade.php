<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Ambiderm - Calidad y Protección</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Lenis Smooth Scroll -->
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.33/dist/lenis.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap');

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Reveal Animations */
        .reveal {
            opacity: 0;
            transition: all 1000ms ease-out;
        }

        .reveal-fade-in {
            transform: translateY(3rem);
        }

        .reveal-scale-in {
            transform: scale(0.9);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* Mobile Menu Animation */
        #mobile-menu {
            transition: opacity 300ms ease-in-out, transform 300ms ease-in-out;
            pointer-events: none;
            opacity: 0;
            transform: translateY(-10px);
        }

        #mobile-menu.active {
            pointer-events: auto;
            opacity: 1;
            transform: translateY(0);
        }

        .product-card-hover:hover .product-image {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="font-sans text-[#1d1d1f] bg-white selection:bg-blue-200 selection:text-blue-900 overflow-x-hidden">

    <!-- --- NAVIGATION --- -->
    <nav id="main-nav"
        class="fixed top-0 w-full z-50 transition-all duration-500 bg-white/80 backdrop-blur-xl border-b border-gray-100">
        <div class="max-w-[1024px] mx-auto px-6 h-12 flex items-center justify-between">
            <!-- Logo Oficial -->
            <a href="{{ route('home') }}" class="z-50 opacity-90 hover:opacity-100 transition-opacity">
                <img src="https://ambiderm.com.mx/img/new/logo-ambiderm-azul.svg" alt="Ambiderm Logo"
                    class="h-8 w-auto">
            </a>

            <!-- Desktop Menu -->
            <div
                class="hidden md:flex items-center space-x-8 text-[12px] font-normal text-gray-800 tracking-tight h-full">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors uppercase">INICIO</a>
                <a href="{{ route('nosotros') }}" class="hover:text-blue-600 transition-colors uppercase">NOSOTROS</a>

                <!-- Dropdown Productos -->
                <div class="relative group h-full flex items-center">
                    <button class="text-blue-600 font-bold transition-colors flex items-center gap-1 uppercase">
                        PRODUCTOS <i data-lucide="chevron-down"
                            class="w-3 h-3 transition-transform group-hover:rotate-180"></i>
                    </button>
                    <div
                        class="absolute top-[48px] left-1/2 -translate-x-1/2 w-48 bg-white/90 backdrop-blur-xl border border-gray-100 rounded-2xl shadow-2xl py-4 flex flex-col gap-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 -translate-y-2">
                        <a href="{{ route('productos') }}"
                            class="px-6 py-2 bg-blue-50 text-blue-600 font-bold transition-colors">GUANTES</a>
                        <a href="https://ambiderm.com.mx/categoria/dental"
                            class="px-6 py-2 hover:bg-gray-50 hover:text-blue-600 transition-colors">DENTAL</a>
                        <a href="https://ambiderm.com.mx/categoria/insumos-medicos"
                            class="px-6 py-2 hover:bg-gray-50 hover:text-blue-600 transition-colors">INSUMOS MÉDICOS</a>
                        <a href="https://ambiderm.com.mx/categoria/ropa-medica"
                            class="px-6 py-2 hover:bg-gray-50 hover:text-blue-600 transition-colors">ROPA MÉDICA</a>
                    </div>
                </div>

                <a href="https://shop.ambiderm.com.mx/" target="_blank"
                    class="hover:text-blue-600 transition-colors uppercase">TIENDA EN LÍNEA</a>
                <a href="#contacto" class="hover:text-blue-600 transition-colors uppercase">CONTACTO</a>
            </div>

            <div class="hidden md:flex items-center gap-6 text-gray-800">
                <a href="https://shop.ambiderm.com.mx/" class="hover:text-blue-600 transition-colors">
                    <i data-lucide="shopping-bag" class="w-4 h-4 stroke-[1.5]"></i>
                </a>
            </div>

            <button id="menu-toggle" class="md:hidden z-50 text-gray-800 focus:outline-none">
                <i data-lucide="menu" id="menu-icon-open"></i>
                <i data-lucide="x" id="menu-icon-close" class="hidden"></i>
            </button>
        </div>

        <!-- Mobile Dropdown -->
        <div id="mobile-menu"
            class="fixed inset-0 w-full h-screen bg-white pt-24 px-10 flex flex-col gap-6 text-xl font-medium md:hidden overflow-y-auto">
            <a href="{{ route('home') }}" class="text-gray-900 mobile-link">Inicio</a>
            <a href="{{ route('nosotros') }}" class="text-gray-900 mobile-link">Nosotros</a>
            <div class="flex flex-col gap-4">
                <p class="text-[12px] font-bold text-gray-400 uppercase tracking-widest mt-4">Categorías</p>
                <a href="{{ route('productos') }}" class="text-blue-600 font-bold mobile-link pl-4">Guantes</a>
                <a href="https://ambiderm.com.mx/categoria/dental" class="text-gray-900 mobile-link pl-4">Dental</a>
                <a href="https://ambiderm.com.mx/categoria/insumos-medicos"
                    class="text-gray-900 mobile-link pl-4">Insumos</a>
                <a href="https://ambiderm.com.mx/categoria/ropa-medica" class="text-gray-900 mobile-link pl-4">Ropa</a>
            </div>
            <div class="h-[1px] bg-gray-200 w-full my-4"></div>
            <a href="https://shop.ambiderm.com.mx/" class="text-gray-900 mobile-link">Tienda en Línea</a>
            <a href="#contacto" class="text-gray-900 mobile-link">Contacto</a>
        </div>
    </nav>

    <!-- --- HERO SECTION --- -->
    <header class="relative pt-40 pb-20 md:pt-48 md:pb-24 px-6 text-center bg-[#fbfbfd] overflow-hidden">
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[800px] bg-blue-100 rounded-full blur-[120px] opacity-40 -z-10 pointer-events-none">
        </div>

        <div class="max-w-[1000px] mx-auto relative z-10">
            <div class="reveal reveal-fade-in">
                <p class="text-blue-600 font-bold uppercase tracking-widest text-xs mb-4">Catálogo 2026</p>
                <h1 class="text-4xl md:text-6xl font-black tracking-tighter mb-6 text-[#1d1d1f]">
                    Nuestros <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-cyan-400">Guantes</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-500 font-medium max-w-2xl mx-auto leading-relaxed">
                    Protección superior con tecnología de vanguardia. Encuentra el guante perfecto para cada
                    procedimiento médico, dental o industrial.
                </p>
            </div>
        </div>
    </header>

    <!-- --- CATEGORY NAV --- -->
    <div
        class="sticky top-12 z-40 bg-white/80 backdrop-blur-xl border-b border-gray-100 py-4 overflow-x-auto scrollbar-hide">
        <div class="max-w-[1024px] mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex gap-2 md:gap-4 overflow-x-auto min-w-max pb-2 md:pb-0 scrollbar-hide">
                <button data-filter="all"
                    class="category-btn px-6 py-2 rounded-full bg-[#1d1d1f] text-white font-bold text-xs md:text-sm tracking-wide shadow-lg transform scale-105 transition-all">TODOS</button>
                <button data-filter="guantes"
                    class="category-btn px-6 py-2 rounded-full bg-gray-100 text-gray-500 font-bold text-xs md:text-sm hover:bg-gray-200 hover:text-gray-900 transition-all">GUANTES</button>
                <button data-filter="dental"
                    class="category-btn px-6 py-2 rounded-full bg-gray-100 text-gray-500 font-bold text-xs md:text-sm hover:bg-gray-200 hover:text-gray-900 transition-all">DENTAL</button>
                <a href="https://ambiderm.com.mx/categoria/insumos-medicos"
                    class="px-6 py-2 rounded-full bg-gray-100 text-gray-500 font-bold text-xs md:text-sm hover:bg-gray-200 hover:text-gray-900 transition-all">MÉDICO</a>
                <a href="https://ambiderm.com.mx/categoria/ropa-medica"
                    class="px-6 py-2 rounded-full bg-gray-100 text-gray-500 font-bold text-xs md:text-sm hover:bg-gray-200 hover:text-gray-900 transition-all">ROPA</a>
            </div>

            <!-- Search Bar -->
            <div class="relative w-full md:w-auto min-w-[300px]">
                <input type="text" id="product-search" placeholder="Buscar producto o material (ej. Latex)..."
                    class="w-full px-5 py-2.5 rounded-full bg-gray-100 border-none text-sm font-medium focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all outline-none pl-10">
                <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
            </div>
        </div>
    </div>

    <!-- --- PRODUCTS GRID --- -->
    <section class="py-16 md:py-24 px-6 bg-white">
        <div class="max-w-[1240px] mx-auto">
            <div id="products-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-10">

                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="guantes">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/7OyCwjS7LYzZDXCWYYdEpHhnmjMjuigXOGnGIGmE.png"
                            alt="Guante Estéril"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-blue-600 uppercase tracking-widest mb-1 block">Látex</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Estéril</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto 2: Plus Negro -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="guantes">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/0yAxWIiIHSkm2v7G2Sad9cgRmihjI7Y3nWMha3CP.png"
                            alt="Guante Plus Negro"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 block">Látex
                            Negro</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Plus Negro</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto 3: Plus -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="guantes">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/UIAimBjIselhHxc2KpWKtGzpa6LL9mhI7tqoqGYq.png"
                            alt="Guante Plus"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 block">Látex</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Plus</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto 4: Confort -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="guantes">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/2Nen9Dz9AypEFaCapHIwHMe4eBaV6uMlgXLLFsWt.png"
                            alt="Guante Confort"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 block">Látex
                            Bajo Polvo</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Confort</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto 5: Extra -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="guantes">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/dHPu3Vr1HiyQi6BGX8QKQ4g0v9xZwX0GdZ7S1RJU.png"
                            alt="Guante Extra"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 block">Látex</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Extra</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto 6: Maxter Mentolado -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="guantes">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/Ji8Rn0bq9QT63NhZ5R2MkQm2DXMzGKQjWhGiWmBT.png"
                            alt="Maxter Mentolado"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-green-600 uppercase tracking-widest mb-1 block">Mentolado</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Maxter</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto 7: Colorfull -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="guantes">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/C4NnlHYzhDvxIsaApvd49fzzIiZcScrqES12GI4N.png"
                            alt="Colorfull"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-purple-500 uppercase tracking-widest mb-1 block">Colores</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Colorfull</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto 8: Kid Gloves -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="guantes">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/qXdk8YkEfNw7smTDqlW1otPlR3ZXKZ50mnwJpLfz.png"
                            alt="Kid Gloves"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-pink-500 uppercase tracking-widest mb-1 block">Pediátrico</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Kid Gloves</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto 9: Nitrilo -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="guantes">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/BDOCYI3GixLQoC1nmI7oFe6ZJ2F8vPpvMgSA8E8i.png"
                            alt="Nitrilo Azul"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-blue-500 uppercase tracking-widest mb-1 block">Nitrilo</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Nitrilo</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto 10: Vinyl LP -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="guantes">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/rXujaebKU43gVFnzmjwJ5bLi1h0KRmWhnGYgA801.png"
                            alt="Vinyl LP"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 block">Vinilo</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Vinyl LP</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto 11: Polietileno -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="guantes">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/QkXrYaiF6oth7KVYfKzsUYVlvjuEjtR18KA77UFZ.png"
                            alt="Polietileno"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 block">Polietileno</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Polietileno</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto 12: Satinado -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="guantes">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/iXrIRO6ACbkmpuLWB0PdIMN5GOpwbF5DHuCydrKJ.png"
                            alt="Satinado"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 block">Doméstico</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Satinado</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto 13: Afelpado -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="guantes">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/V1mhmGhZjrKt68CnP5r06hhtukILc1PSj7ads74u.png"
                            alt="Afelpado"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 block">Doméstico</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Afelpado</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto 14: Elite -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="guantes">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/lXIX9CNxb3bos94PVIVOWBgDPsl55WGo7eYStJRX.png"
                            alt="Elite"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 block">Examen</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Elite</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto 15: Nitrilo 10 -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="guantes">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/wCVdQPnRog5P4aXpDox9wlrpWWm7I62Ok8Clq1uW.jpg"
                            alt="Nitrilo 10"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl"
                            style="mix-blend-mode: normal; border-radius: 20px;">
                    </div>
                    <div class="text-center">
                        <span class="text-[10px] font-bold text-blue-500 uppercase tracking-widest mb-1 block">Pack
                            x10</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Nitrilo Box</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>


                <!-- --- DENTAL PRODUCTS --- -->
                <!-- Producto: Cubrebocas Adulto -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="dental">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/UooxhwjFtnmCc32hXShZDn0bwepxHaapLrJVomFj.png"
                            alt="Cubrebocas Adulto"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-cyan-500 uppercase tracking-widest mb-1 block">Dental</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Cubrebocas Adulto</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto: Rollo de Algodón -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="dental">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/PmQszJarehV2bk7d1YSzdiLDp1IvgTQsnkQQXzax.png"
                            alt="Rollo de Algodón"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-cyan-500 uppercase tracking-widest mb-1 block">Dental</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Rollo de Algodón</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto: Campos Dentales Colores -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="dental">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/g6BiHEZIP8waIEa4oGrFQ8JwSecs9smpYTjc6gVO.png"
                            alt="Campos Dentales Colores"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-cyan-500 uppercase tracking-widest mb-1 block">Dental</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Campos Dentales Colores</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto: Eyector de Saliva -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="dental">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/a08eD2nJWr984fVNGRb5QWxr4CcK4HHTEg3HEH9e.png"
                            alt="Eyector de Saliva"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-cyan-500 uppercase tracking-widest mb-1 block">Dental</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Eyector de Saliva</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto: Campos Dentales -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="dental">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/WMZlpQ8jSfOIj4wkB0EfFi4AEGHEjvvnTOB4BHHq.png"
                            alt="Campos Dentales"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-cyan-500 uppercase tracking-widest mb-1 block">Dental</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Campos Dentales</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto: Campos Dentales Negro -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="dental">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/klgRWof8j1UDD86RAcP7oYqX4N7s6twlCGpE96eR.png"
                            alt="Campos Dentales Negro"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-cyan-500 uppercase tracking-widest mb-1 block">Dental</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Campos Dentales Negro</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto: Gasa Dental -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="dental">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/nncGw8KcuwKOlPbDtzHDsnCswLPU8u8CDhZLUAXy.png"
                            alt="Gasa Dental"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-cyan-500 uppercase tracking-widest mb-1 block">Dental</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Gasa Dental</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto: Cubrebocas bolsa -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="dental">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/gVYhvmJl1XtCxPiiFX5hggSFWHYCcbzHTA3IiLgz.png"
                            alt="Cubrebocas bolsa"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-cyan-500 uppercase tracking-widest mb-1 block">Dental</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Cubrebocas bolsa</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto: Pañuelos Desechables -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="dental">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/DUvMx1x35lFo6d9tjzfx2Y7xErAPzbcxOj6NYpWB.png"
                            alt="Pañuelos Desechables"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-cyan-500 uppercase tracking-widest mb-1 block">Dental</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Pañuelos Desechables</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto: Aguja Dental -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="dental">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/BdDgjYonL3U1EAx8L94uH5XPR3kGaxzsmlrBLc9E.png"
                            alt="Aguja Dental"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-cyan-500 uppercase tracking-widest mb-1 block">Dental</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Aguja Dental</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Producto: Cubrebocas Infantil -->
                <div class="group product-card-hover cursor-pointer reveal reveal-fade-in" data-category="dental">
                    <div
                        class="relative aspect-square bg-[#f5f5f7] rounded-[30px] overflow-hidden mb-6 flex items-center justify-center p-6 transition-colors group-hover:bg-blue-50/50">
                        <img src="https://ambiderm.com.mx/storage/productos/JDPoFURjBsYPG0Xw7nEubzXtNgdIFKDI1XvwRJbs.png"
                            alt="Cubrebocas Infantil"
                            class="product-image w-full h-auto object-contain mix-blend-multiply transition-transform duration-500 drop-shadow-xl">
                    </div>
                    <div class="text-center">
                        <span
                            class="text-[10px] font-bold text-cyan-500 uppercase tracking-widest mb-1 block">Dental</span>
                        <h3 class="text-lg md:text-xl font-bold text-[#1d1d1f] mb-2">Cubrebocas Infantil</h3>
                        <a href="{{ route('producto-detalle') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-400 group-hover:text-blue-600 transition-colors">
                            Ver detalles <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                </div>

            </div>
    </section>

    <!-- --- FOOTER --- -->
    <footer class="bg-white pt-32 overflow-hidden" id="contacto">

        <!-- Redes Sociales & Logo -->
        <div class="max-w-[1200px] mx-auto px-6 mb-32">
            <div class="flex flex-col md:flex-row justify-between items-center gap-12">
                <div class="reveal reveal-fade-in">
                    <img src="https://ambiderm.com.mx/img/new/logo-ambiderm-azul.svg" alt="Ambiderm Logo"
                        class="h-12 md:h-16">
                </div>
                <div class="text-center md:text-right reveal reveal-fade-in">
                    <h4 class="text-2xl md:text-4xl font-black tracking-tighter text-[#1d1d1f] mb-6">
                        SÍGUENOS EN <span
                            class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-400">REDES
                            SOCIALES</span>
                    </h4>
                    <div class="flex justify-center md:justify-end gap-6">
                        <a href="https://www.instagram.com/ambiderm/?hl=es-la" target="_blank"
                            class="w-14 h-14 rounded-full bg-[#fbfbfd] border border-gray-100 flex items-center justify-center hover:scale-110 hover:shadow-xl transition-all">
                            <img src="https://ambiderm.com.mx/img/new/instagram-icon.png" alt="Instagram"
                                class="w-6 h-6">
                        </a>
                        <a href="https://www.facebook.com/Ambiderm/" target="_blank"
                            class="w-14 h-14 rounded-full bg-[#fbfbfd] border border-gray-100 flex items-center justify-center hover:scale-110 hover:shadow-xl transition-all">
                            <img src="https://ambiderm.com.mx/img/new/facebook-icon.png" alt="Facebook" class="w-6 h-6">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mapas & Sucursales -->
        <div class="bg-[#fbfbfd] py-32 border-t border-gray-100">
            <div class="max-w-[1200px] mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">

                    <!-- Lado Izquierdo: Directorio -->
                    <div class="reveal reveal-fade-in">
                        <h3 class="text-3xl md:text-5xl font-black tracking-tighter text-[#1d1d1f] mb-12">UBICACIONES
                            <br>
                            ESTRATÉGICAS
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
                            <div class="group cursor-pointer sucursal-btn active" data-map="gdl"
                                data-url="https://goo.gl/maps/kD76mn5gFhNue5X47">
                                <p class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-3">Matriz</p>
                                <h5
                                    class="text-xl font-bold text-[#1d1d1f] mb-2 group-hover:text-blue-600 transition-colors">
                                    SAN ISIDRO
                                </h5>
                                <p class="text-gray-500 text-sm leading-relaxed">
                                    Carr. a Bosques de San Isidro No. 1136<br>Zapopan, Jalisco<br>
                                    <a href="tel:+523336566557"
                                        class="hover:text-blue-600 transition-colors font-semibold">+52 33 3656
                                        6557</a>
                                </p>
                            </div>

                            <div class="group cursor-pointer sucursal-btn" data-map="tijuana"
                                data-url="https://goo.gl/maps/PEStmVVbnVFVpMvH9">
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Norte</p>
                                <h5
                                    class="text-xl font-bold text-[#1d1d1f] mb-2 group-hover:text-blue-600 transition-colors">
                                    TIJUANA
                                </h5>
                                <p class="text-gray-500 text-sm leading-relaxed">
                                    Calle Mariscal sucre No. 30 C<br>Fracc. Castro, Olivos<br>
                                    <a href="tel:+526646081627"
                                        class="hover:text-blue-600 transition-colors font-semibold">+52 664 608
                                        1627</a>
                                </p>
                            </div>

                            <div class="group cursor-pointer sucursal-btn" data-map="costa-rica"
                                data-url="https://goo.gl/maps/bCASmcuCuxvA9csg9">
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Centro</p>
                                <h5
                                    class="text-xl font-bold text-[#1d1d1f] mb-2 group-hover:text-blue-600 transition-colors">
                                    COSTA RICA
                                </h5>
                                <p class="text-gray-500 text-sm leading-relaxed">
                                    La Valencia de Heredia,<br>Oficentro Tech Park,<br>
                                    <a href="tel:+50622373377"
                                        class="hover:text-blue-600 transition-colors font-semibold">+506 2237
                                        3377</a>
                                </p>
                            </div>

                            <div class="group cursor-pointer sucursal-btn" data-map="guatemala"
                                data-url="https://goo.gl/maps/TNuRDPTZxkZqqU659">
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Centro</p>
                                <h5
                                    class="text-xl font-bold text-[#1d1d1f] mb-2 group-hover:text-blue-600 transition-colors">
                                    GUATEMALA
                                </h5>
                                <p class="text-gray-500 text-sm leading-relaxed">
                                    Calzada Atanasio Tzul 22-00<br>Empresarial cortijo II<br>
                                    <a href="tel:+50222092000"
                                        class="hover:text-blue-600 transition-colors font-semibold">+502 2209
                                        2000</a>
                                </p>
                            </div>
                        </div>

                        <div class="mt-16 reveal reveal-fade-in">
                            <a href="mailto:info@ambiderm.com.mx"
                                class="inline-flex items-center gap-4 text-[#1d1d1f] font-bold text-2xl hover:text-blue-600 transition-all">
                                info@ambiderm.com.mx
                                <i data-lucide="arrow-up-right" class="w-6 h-6"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Lado Derecho: Mapa Interactivo -->
                    <div class="reveal reveal-scale-in relative group">
                        <div class="absolute inset-0 bg-blue-100 blur-[100px] opacity-20 -z-10 transform scale-125">
                        </div>
                        <a id="main-map-link" href="https://goo.gl/maps/kD76mn5gFhNue5X47" target="_blank"
                            class="block relative rounded-[40px] overflow-hidden shadow-2xl border border-white">
                            <img id="main-map-img" src="https://ambiderm.com.mx/img/new/mapas/gdl.png"
                                alt="Mapa Ubicación"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-x-0 bottom-0 p-8 bg-gradient-to-t from-black/50 to-transparent">
                                <span class="text-white font-bold bg-blue-600/80 px-4 py-2 rounded-full text-xs">ABRIR
                                    EN GOOGLE
                                    MAPS</span>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <!-- Formulario de Contacto & Distribuidor -->
        <div class="bg-white py-32">
            <div class="max-w-[1200px] mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">

                    <!-- Left Info -->
                    <div class="reveal reveal-fade-in">
                        <h4 class="text-blue-600 font-bold uppercase tracking-widest text-xs mb-4">Mantenlo cerca</h4>
                        <h3 class="text-3xl md:text-5xl font-black tracking-tighter text-[#1d1d1f] mb-8">¿TIENES ALGUNA
                            <br> DUDA?
                        </h3>
                        <p class="text-gray-500 text-lg mb-12">Déjanos un mensaje y un especialista se pondrá en
                            contacto contigo a
                            la brevedad.</p>

                        <a href="https://share.hsforms.com/1vl6EkSEKQBW_SNv3Im1qcA3qrdx" target="_blank"
                            class="flex items-center gap-6 p-8 rounded-[30px] bg-blue-50 border border-blue-100 hover:bg-white hover:shadow-2xl transition-all group">
                            <div
                                class="w-16 h-16 rounded-2xl bg-blue-600 flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition-transform">
                                <img src="https://ambiderm.com.mx/img/new/distribuidor-icon.svg"
                                    class="w-10 h-10 invert">
                            </div>
                            <div class="text-left">
                                <strong class="text-blue-900 text-xl block leading-tight">QUIERO SER
                                    DISTRIBUIDOR</strong>
                                <span class="text-blue-600/70 font-medium">Únete a la red Ambiderm</span>
                            </div>
                            <i data-lucide="chevron-right" class="w-8 h-8 text-blue-300 ml-auto mr-4"></i>
                        </a>
                    </div>

                    <!-- Right Form -->
                    <div
                        class="reveal reveal-fade-in bg-[#fbfbfd] p-10 md:p-16 rounded-[40px] border border-gray-100 shadow-sm">
                        <form action="https://ambiderm.com.mx/contacto-enviar" method="POST" class="space-y-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 px-2">Nombre</label>
                                    <input type="text" placeholder="Tu nombre"
                                        class="w-full bg-white border border-gray-100 rounded-2xl px-6 py-4 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 px-2">Correo</label>
                                    <input type="email" placeholder="email@ejemplo.com"
                                        class="w-full bg-white border border-gray-100 rounded-2xl px-6 py-4 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 px-2">Mensaje</label>
                                <textarea rows="4" placeholder="¿En qué podemos ayudarte?"
                                    class="w-full bg-white border border-gray-100 rounded-2xl px-6 py-4 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all resize-none"></textarea>
                            </div>
                            <button
                                class="w-full bg-[#1d1d1f] text-white py-5 rounded-full font-bold text-lg hover:bg-blue-600 hover:shadow-2xl shadow-blue-500/30 transition-all transform active:scale-[0.98]">
                                ENVIAR MENSAJE
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Copyright Bar -->
        <div class="py-12 px-6 border-t border-gray-100 bg-[#fbfbfd]">
            <div class="max-w-[1200px] mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="text-center md:text-left">
                    <p class="text-[10px] font-bold text-[#1d1d1f] tracking-widest mb-2 uppercase">COPYRIGHT © 2024
                        AMBIDERM S.A.
                        DE C.V.</p>
                    <p class="text-gray-400 text-[10px]">TODOS LOS DERECHOS RESERVADOS</p>
                </div>
                <div class="flex flex-wrap justify-center gap-x-8 gap-y-2">
                    <a href="#"
                        class="text-[10px] font-bold text-gray-400 hover:text-blue-600 transition-colors uppercase tracking-widest">Términos</a>
                    <a href="#"
                        class="text-[10px] font-bold text-gray-400 hover:text-blue-600 transition-colors uppercase tracking-widest">Privacidad</a>
                    <a href="#"
                        class="text-[10px] font-bold text-gray-400 hover:text-blue-600 transition-colors uppercase tracking-widest">Cookies</a>
                    <a href="#"
                        class="text-[10px] font-bold text-gray-400 hover:text-blue-600 transition-colors uppercase tracking-widest">Bolsa
                        de Trabajo</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Initialize Lenis Smooth Scroll
        const lenis = new Lenis();
        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);

        // Reveal Animation Observer
        const revealElements = document.querySelectorAll('.reveal');
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.1 });

        revealElements.forEach(el => revealObserver.observe(el));

        // Mobile Menu Logic
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIconOpen = document.getElementById('menu-icon-open');
        const menuIconClose = document.getElementById('menu-icon-close');

        menuToggle.addEventListener('click', () => {
            const isOpen = mobileMenu.classList.toggle('active');
            if (isOpen) {
                menuIconOpen.classList.add('hidden');
                menuIconClose.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                menuIconOpen.classList.remove('hidden');
                menuIconClose.classList.add('hidden');
                document.body.style.overflow = '';
            }
        });

        // Location Map Logic (reused from index/acerca)
        const sucursalBtns = document.querySelectorAll('.sucursal-btn');
        const mainMapImg = document.getElementById('main-map-img');
        const mainMapLink = document.getElementById('main-map-link');

        sucursalBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active from all
                sucursalBtns.forEach(b => b.classList.remove('active', 'border-blue-600/30'));
                sucursalBtns.forEach(b => b.querySelector('p').classList.replace('text-blue-600', 'text-gray-400'));

                // Add to clicked
                btn.classList.add('active');
                btn.querySelector('p').classList.replace('text-gray-400', 'text-blue-600');

                // Update Map
                const mapKey = btn.getAttribute('data-map');
                const mapUrl = btn.getAttribute('data-url');
                mainMapImg.src = `https://ambiderm.com.mx/img/new/mapas/${mapKey}.png`;
                mainMapLink.href = mapUrl;
            });
        });

        // --- PRODUCT SEARCH LOGIC ---
        const searchInput = document.getElementById('product-search');
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                const searchTerm = e.target.value.toLowerCase().trim();
                const products = document.querySelectorAll('#products-grid > .group');

                products.forEach(product => {
                    const title = product.querySelector('h3') ? product.querySelector('h3').textContent.toLowerCase() : '';
                    const category = product.querySelector('span') ? product.querySelector('span').textContent.toLowerCase() : '';

                    if (searchTerm === '' || title.includes(searchTerm) || category.includes(searchTerm)) {
                        product.classList.remove('hidden');
                    } else {
                        product.classList.add('hidden');
                    }
                });
            });
        }
    </script>
    <!-- --- CHATBOT FLOTANTE --- -->
    <div class="fixed bottom-8 right-8 z-[100] flex flex-col items-end gap-4">
        <!-- Ventana de Chat -->
        <div id="chat-window"
            class="w-[350px] bg-white rounded-[30px] border border-gray-100 shadow-[0_20px_50px_rgba(0,113,227,0.15)] overflow-hidden hidden opacity-0 translate-y-10 transition-all duration-500 transform origin-bottom-right">
            <!-- Header del Chat -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-400 p-8 text-white">
                <div class="flex items-center gap-4 mb-2">
                    <div class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center">
                        <i data-lucide="message-circle" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg leading-tight">Asistente Ambiderm</h4>
                        <p class="text-white/80 text-xs">En línea ahora</p>
                    </div>
                </div>
            </div>

            <!-- Contenido del Chat -->
            <div class="p-6 space-y-6">
                <div class="bg-gray-50 p-4 rounded-2xl rounded-tl-none text-gray-700 text-sm leading-relaxed text-left">
                    ¡Hola! 👋 Bienvenido a Ambiderm. ¿En qué podemos ayudarte hoy? Selecciona una opción:
                </div>

                <div class="space-y-3">
                    <button
                        class="w-full p-4 text-left border border-gray-100 rounded-xl hover:bg-blue-50 hover:border-blue-100 transition-all text-sm font-semibold text-gray-700 flex items-center justify-between group">
                        Quiero ser distribuidor
                        <i data-lucide="chevron-right"
                            class="w-4 h-4 text-gray-300 group-hover:text-blue-500 transition-colors"></i>
                    </button>
                    <button
                        class="w-full p-4 text-left border border-gray-100 rounded-xl hover:bg-blue-50 hover:border-blue-100 transition-all text-sm font-semibold text-gray-700 flex items-center justify-between group">
                        Comprar en línea
                        <i data-lucide="chevron-right"
                            class="w-4 h-4 text-gray-300 group-hover:text-blue-500 transition-colors"></i>
                    </button>
                    <button
                        class="w-full p-4 text-left border border-gray-100 rounded-xl hover:bg-blue-50 hover:border-blue-100 transition-all text-sm font-semibold text-gray-700 flex items-center justify-between group">
                        Contactar a un asesor
                        <i data-lucide="chevron-right"
                            class="w-4 h-4 text-gray-300 group-hover:text-blue-500 transition-colors"></i>
                    </button>
                </div>
            </div>

            <!-- Footer del Chat -->
            <div class="p-4 bg-gray-50 text-center">
                <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">Respuesta en menos de 2 min</p>
            </div>
        </div>

        <!-- Botón Flotante -->
        <button id="chat-toggle"
            class="w-16 h-16 rounded-full bg-gradient-to-r from-blue-600 via-blue-400 to-cyan-400 text-white flex items-center justify-center shadow-2xl hover:scale-110 active:scale-95 transition-all shadow-blue-500/40 relative group focus:outline-none">
            <i id="chat-icon-open" data-lucide="message-circle"
                class="w-8 h-8 group-hover:rotate-12 transition-transform"></i>
            <i id="chat-icon-close" data-lucide="x"
                class="w-8 h-8 hidden group-hover:scale-110 transition-transform"></i>
            <!-- Badge de notificación -->
            <span class="absolute top-0 right-0 w-5 h-5 bg-red-500 border-2 border-white rounded-full"></span>
        </button>
    </div>

    <script>
        // --- CHATBOT TOGGLE ---
        const chatToggle = document.getElementById('chat-toggle');
        const chatWindow = document.getElementById('chat-window');
        const chatIconOpen = document.getElementById('chat-icon-open');
        const chatIconClose = document.getElementById('chat-icon-close');

        if (chatToggle) {
            chatToggle.addEventListener('click', () => {
                const isHidden = chatWindow.classList.contains('hidden');

                if (isHidden) {
                    chatWindow.classList.remove('hidden');
                    setTimeout(() => {
                        chatWindow.classList.replace('opacity-0', 'opacity-100');
                        chatWindow.classList.replace('translate-y-10', 'translate-y-0');
                    }, 10);
                    chatIconOpen.classList.add('hidden');
                    chatIconClose.classList.remove('hidden');
                } else {
                    chatWindow.classList.replace('opacity-100', 'opacity-0');
                    chatWindow.classList.replace('translate-y-0', 'translate-y-10');
                    setTimeout(() => chatWindow.classList.add('hidden'), 500);
                    chatIconOpen.classList.remove('hidden');
                    chatIconClose.classList.add('hidden');
                }
            });
        }
    </script>

    <script>
        // --- CATEGORY FILTERING ---
        const filterButtons = document.querySelectorAll('[data-filter]');
        const productCards = document.querySelectorAll('[data-category]');

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                const filter = button.dataset.filter;

                // 1. Update Active State
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-[#1d1d1f]', 'text-white', 'shadow-lg', 'transform', 'scale-105');
                    btn.classList.add('bg-gray-100', 'text-gray-500', 'hover:bg-gray-200', 'hover:text-gray-900');
                });
                button.classList.remove('bg-gray-100', 'text-gray-500', 'hover:bg-gray-200', 'hover:text-gray-900');
                button.classList.add('bg-[#1d1d1f]', 'text-white', 'shadow-lg', 'transform', 'scale-105');

                // 2. Filter Products
                productCards.forEach(card => {
                    if (filter === 'all' || card.dataset.category === filter) {
                        card.classList.remove('hidden');
                        card.classList.add('reveal-fade-in'); // Re-trigger fade
                    } else {
                        card.classList.add('hidden');
                        card.classList.remove('reveal-fade-in');
                    }
                });
            });
        });
    </script>
</body>

</html>