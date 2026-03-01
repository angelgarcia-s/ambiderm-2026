<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ambiderm - Innovación en Protección</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Lucide Icons CDN -->
  <script src="https://unpkg.com/lucide@latest"></script>
  <!-- Lenis Smooth Scroll -->
  <script src="https://unpkg.com/@studio-freight/lenis@1.0.33/dist/lenis.min.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

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
  </style>
</head>

<body
  class="font-sans text-[#1d1d1f] bg-white selection:bg-blue-200 selection:text-blue-900 overflow-x-hidden opacity-100">

  <!-- --- NAVIGATION --- -->
  <nav id="main-nav" class="fixed top-0 w-full z-50 transition-all duration-500 bg-transparent">
    <div class="max-w-[1024px] mx-auto px-6 h-12 flex items-center justify-between">
      <!-- Logo Oficial -->
      <a href="#" class="z-50 opacity-90 hover:opacity-100 transition-opacity">
        <img src="https://ambiderm.com.mx/img/new/logo-ambiderm-azul.svg" alt="Ambiderm Logo" class="h-8 w-auto">
      </a>

      <!-- Desktop Menu -->
      <div class="hidden md:flex items-center space-x-8 text-[12px] font-normal text-gray-800 tracking-tight h-full">
        <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors uppercase">INICIO</a>
        <a href="{{ route('nosotros') }}" class="hover:text-blue-600 transition-colors uppercase">NOSOTROS</a>

        <!-- Dropdown Productos -->
        <div class="relative group h-full flex items-center">
          <button class="hover:text-blue-600 transition-colors flex items-center gap-1 uppercase">
            PRODUCTOS <i data-lucide="chevron-down" class="w-3 h-3 transition-transform group-hover:rotate-180"></i>
          </button>
          <div
            class="absolute top-[48px] left-1/2 -translate-x-1/2 w-48 bg-white/90 backdrop-blur-xl border border-gray-100 rounded-2xl shadow-2xl py-4 flex flex-col gap-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 -translate-y-2">
            <a href="{{ route('productos') }}"
              class="px-6 py-2 hover:bg-gray-50 hover:text-blue-600 transition-colors font-bold">GUANTES</a>
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
        <a href="https://www.ambiderm.com.mx/catalogo/catalogo.pdf" target="_blank"
          class="hover:text-blue-600 transition-colors font-semibold text-blue-600 uppercase">CATÁLOGO</a>
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
        <a href="https://ambiderm.com.mx/categoria/insumos-medicos" class="text-gray-900 mobile-link pl-4">Insumos</a>
        <a href="https://ambiderm.com.mx/categoria/ropa-medica" class="text-gray-900 mobile-link pl-4">Ropa</a>
      </div>
      <div class="h-[1px] bg-gray-200 w-full my-4"></div>
      <a href="https://shop.ambiderm.com.mx/" class="text-gray-900 mobile-link">Tienda en Línea</a>
      <a href="#contacto" class="text-gray-900 mobile-link">Contacto</a>
      <a href="https://www.ambiderm.com.mx/catalogo/catalogo.pdf"
        class="text-blue-600 flex items-center gap-2 mt-4 font-bold">
        Descargar Catálogo <i data-lucide="download" class="w-5 h-5"></i>
      </a>
    </div>
  </nav>

  <!-- --- HERO SECTION --- -->
  <section class="relative pt-40 pb-12 md:pt-52 md:pb-20 px-6 text-center bg-[#f5f5f7] overflow-hidden">
    <div class="max-w-[1200px] mx-auto relative z-10">
      <div class="reveal reveal-fade-in" style="transition-delay: 200ms;">
        <h1 class="text-6xl md:text-8xl lg:text-9xl font-black tracking-tighter mb-6">
          <span
            class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-blue-400 to-cyan-400">Ambiderm</span>
        </h1>
      </div>

      <div class="reveal reveal-fade-in" style="transition-delay: 400ms;">
        <p class="text-xl md:text-3xl text-gray-500 font-medium max-w-2xl mx-auto leading-normal tracking-tight mb-16">
          Siente la diferencia. <br class="hidden md:block"> Seguridad clínica con tacto natural.
        </p>
      </div>

      <!-- Imagen Central Hero -->
      <div class="reveal reveal-scale-in max-w-[1000px] mx-auto" style="transition-delay: 600ms;">
        <img src="https://glucosacomunicacion.com/proyectos/ambiderm2026/colors.png" alt="Ambiderm Collection"
          class="w-full h-auto drop-shadow-[0_20px_50px_rgba(0,0,0,0.1)] hover:scale-[1.02] transition-transform duration-700">
      </div>
    </div>
  </section>

  <!-- --- VIDEO FEATURE CARD (2 COLUMNS) --- -->
  <section id="video-feature" class="py-12 md:py-24 px-6 bg-[#f5f5f7]">
    <div class="max-w-[1200px] mx-auto">
      <div
        class="reveal reveal-scale-in bg-white border border-gray-100 rounded-[50px] overflow-hidden shadow-[0_40px_100px_rgba(0,0,0,0.05)] flex flex-col md:flex-row items-stretch">

        <!-- Left: Video Content -->
        <div class="md:w-3/5 h-[400px] md:h-[600px] relative overflow-hidden">
          <video class="absolute inset-0 w-full h-full object-cover" autoplay muted loop playsinline>
            <source src="https://glucosacomunicacion.com/proyectos/ambiderm2026/vynil.mp4" type="video/mp4">
          </video>
        </div>

        <!-- Right: Action Content -->
        <div class="md:w-2/5 p-12 md:p-16 flex flex-col justify-center bg-white border-l border-gray-50">
          <div class="reveal reveal-fade-in text-left">
            <h2 class="text-4xl md:text-5xl font-black tracking-tighter leading-tight mb-6">
              <span
                class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-blue-400 to-cyan-400">NUEVO</span><br>
              <span class="text-[#1d1d1f]">Vynil Synmax</span>
            </h2>
            <p class="text-gray-500 text-lg md:text-xl font-medium leading-relaxed mb-10">
              Siente la revolución en protección clínica. Una nueva era de seguridad y confort táctil.
            </p>

            <div class="flex flex-col sm:flex-row gap-4">
              <a href="{{ route('guantes-vynil') }}"
                class="bg-[#0071e3] text-white px-10 py-4 rounded-full font-semibold hover:bg-[#0077ed] transition-all hover:scale-105 active:scale-95 shadow-lg shadow-blue-500/20 text-center">
                Comprar ahora
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- --- HORIZONTAL SCROLL COLLECTION --- -->
  <section class="bg-[#f5f5f7] pt-32 pb-16 border-t border-gray-100 overflow-hidden" id="productos">
    <div class="max-w-[1400px] mx-auto px-6">
      <div class="flex justify-between items-end mb-12">
        <div class="reveal reveal-fade-in">
          <h3 class="text-4xl md:text-5xl font-bold text-[#1d1d1f] tracking-tight">La Colección.</h3>
          <p class="text-gray-500 mt-2 text-lg">Encuentra el ajuste perfecto para ti.</p>
        </div>
        <div class="hidden md:flex gap-4 items-center">
          <a href="https://ambiderm.com.mx/categoria/guantes" target="_blank"
            class="mr-4 text-blue-600 font-bold hover:text-blue-700 transition-colors flex items-center gap-2 text-sm uppercase tracking-widest">
            Ver todos <i data-lucide="arrow-right" class="w-4 h-4"></i>
          </a>
          <button id="scroll-left"
            class="w-12 h-12 rounded-full bg-gray-200 text-gray-600 hover:bg-white hover:shadow-xl transition-all flex items-center justify-center">
            <i data-lucide="chevron-left" class="w-6 h-6"></i>
          </button>
          <button id="scroll-right"
            class="w-12 h-12 rounded-full bg-gray-200 text-gray-600 hover:bg-white hover:shadow-xl transition-all flex items-center justify-center">
            <i data-lucide="chevron-right" class="w-6 h-6"></i>
          </button>
        </div>
      </div>

      <div id="product-shelf"
        class="flex overflow-x-auto gap-4 md:gap-8 pb-12 -mx-6 px-6 md:mx-0 md:px-0 scrollbar-hide snap-x md:snap-none snap-proximity">

        <!-- Product 1 -->
        <div class="product-item flex-none w-[320px] md:w-[450px] aspect-square group cursor-pointer"
          onclick="openDetail('esteril', 'Estéril', 'Guante de látex quirúrgico esterilizado, diseñado para la máxima sensibilidad táctil y protección en quirófano. Su diseño ergonómico reduce la fatiga durante procedimientos prolongados.', 'https://ambiderm.com.mx/storage/productos/7OyCwjS7LYzZDXCWYYdEpHhnmjMjuigXOGnGIGmE.png')">
          <div
            class="relative w-full h-full rounded-[40px] bg-white p-8 md:p-12 flex flex-col justify-between transition-all duration-700 md:group-hover:shadow-2xl border border-gray-50 overflow-hidden snap-center md:snap-align-none">

            <div class="z-10 text-left">
              <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-1">Cirugía</p>
              <h4 class="text-2xl md:text-3xl font-bold text-[#1d1d1f]">Estéril</h4>
              <div class="flex gap-2 mt-3">
                <div class="w-4 h-4 rounded-full bg-gray-100 ring-1 ring-gray-200"></div>
              </div>
            </div>

            <div class="flex-1 w-full flex items-center justify-center relative">
              <img src="https://ambiderm.com.mx/storage/productos/7OyCwjS7LYzZDXCWYYdEpHhnmjMjuigXOGnGIGmE.png"
                alt="Estéril"
                class="w-full h-auto max-h-[160px] md:max-h-[240px] object-contain mix-blend-multiply transition-transform duration-700 md:group-hover:scale-110">
            </div>

            <div class="w-full h-12 flex items-center justify-center">
              <!-- Mobile: Static Content -->
              <div class="flex md:hidden w-full justify-between items-center">
                <span class="text-blue-600 font-bold text-sm">Comprar</span>
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white">
                  <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </div>
              </div>
              <div
                class="hidden md:flex w-full justify-center opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                <div
                  class="bg-blue-600 text-white px-10 py-3 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-blue-500/20">
                  Ver detalles
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 2 -->
        <div class="product-item flex-none w-[320px] md:w-[450px] aspect-square group cursor-pointer"
          onclick="openDetail('plus-negro', 'Plus Negro', 'Elegante y resistente, el Plus Negro es el favorito de los estudios de tatuaje y clínicas de alta gama. Máxima visibilidad y agarre superior.', 'https://ambiderm.com.mx/storage/productos/0yAxWIiIHSkm2v7G2Sad9cgRmihjI7Y3nWMha3CP.png')">
          <div
            class="relative w-full h-full rounded-[40px] bg-white p-8 md:p-12 flex flex-col justify-between transition-all duration-700 md:group-hover:shadow-2xl border border-gray-50 overflow-hidden snap-center md:snap-align-none">

            <div class="z-10 text-left">
              <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-1">Estilo</p>
              <h4 class="text-2xl md:text-3xl font-bold text-[#1d1d1f]">Plus Negro</h4>
              <div class="flex gap-2 mt-3">
                <div class="w-4 h-4 rounded-full bg-black ring-1 ring-gray-200 shadow-inner"></div>
              </div>
            </div>

            <div class="flex-1 w-full flex items-center justify-center relative">
              <img src="https://ambiderm.com.mx/storage/productos/0yAxWIiIHSkm2v7G2Sad9cgRmihjI7Y3nWMha3CP.png"
                alt="Plus Negro"
                class="w-full h-auto max-h-[160px] md:max-h-[240px] object-contain mix-blend-multiply transition-transform duration-700 md:group-hover:scale-110">
            </div>

            <div class="w-full h-12 flex items-center justify-center">
              <!-- Mobile: Static Content -->
              <div class="flex md:hidden w-full justify-between items-center">
                <span class="text-blue-600 font-bold text-sm">Comprar</span>
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white">
                  <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </div>
              </div>
              <div
                class="hidden md:flex w-full justify-center opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                <div
                  class="bg-blue-600 text-white px-10 py-3 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-blue-500/20">
                  Ver detalles
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 3 -->
        <div class="product-item flex-none w-[320px] md:w-[450px] aspect-square group cursor-pointer"
          onclick="openDetail('confort', 'Confort', 'Protección clásica con la suavidad del látex natural. Ideal para uso clínico diario donde la comodidad es tan importante como la seguridad.', 'https://ambiderm.com.mx/storage/productos/2Nen9Dz9AypEFaCapHIwHMe4eBaV6uMlgXLLFsWt.png')">
          <div
            class="relative w-full h-full rounded-[40px] bg-white p-8 md:p-12 flex flex-col justify-between transition-all duration-700 md:group-hover:shadow-2xl border border-gray-50 overflow-hidden snap-center md:snap-align-none">

            <div class="z-10 text-left">
              <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-1">Uso Diario</p>
              <h4 class="text-2xl md:text-3xl font-bold text-[#1d1d1f]">Confort</h4>
              <div class="flex gap-2 mt-3">
                <div class="w-4 h-4 rounded-full bg-yellow-50 ring-1 ring-gray-200"></div>
              </div>
            </div>

            <div class="flex-1 w-full flex items-center justify-center relative">
              <img src="https://ambiderm.com.mx/storage/productos/2Nen9Dz9AypEFaCapHIwHMe4eBaV6uMlgXLLFsWt.png"
                alt="Confort"
                class="w-full h-auto max-h-[160px] md:max-h-[240px] object-contain mix-blend-multiply transition-transform duration-700 md:group-hover:scale-110">
            </div>

            <div class="w-full h-12 flex items-center justify-center">
              <!-- Mobile: Static Content -->
              <div class="flex md:hidden w-full justify-between items-center">
                <span class="text-blue-600 font-bold text-sm">Comprar</span>
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white">
                  <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </div>
              </div>
              <div
                class="hidden md:flex w-full justify-center opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                <div
                  class="bg-blue-600 text-white px-10 py-3 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-blue-500/20">
                  Ver detalles
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 4 -->
        <div class="product-item flex-none w-[320px] md:w-[450px] aspect-square group cursor-pointer"
          onclick="openDetail('nitrilo', 'Nitrilo Azul', 'Libre de látex y altamente resistente. El guante de nitrilo Ambiderm ofrece la mejor barrera contra agentes químicos y punciones.', 'https://ambiderm.com.mx/storage/productos/BDOCYI3GixLQoC1nmI7oFe6ZJ2F8vPpvMgSA8E8i.png')">
          <div
            class="relative w-full h-full rounded-[40px] bg-white p-8 md:p-12 flex flex-col justify-between transition-all duration-700 md:group-hover:shadow-2xl border border-gray-50 overflow-hidden snap-center md:snap-align-none">

            <div class="z-10 text-left">
              <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-1">Resistencia</p>
              <h4 class="text-2xl md:text-3xl font-bold text-[#1d1d1f]">Nitrilo Azul</h4>
              <div class="flex gap-2 mt-3">
                <div class="w-4 h-4 rounded-full bg-blue-400 ring-1 ring-gray-200 shadow-inner"></div>
              </div>
            </div>

            <div class="flex-1 w-full flex items-center justify-center relative">
              <img src="https://ambiderm.com.mx/storage/productos/BDOCYI3GixLQoC1nmI7oFe6ZJ2F8vPpvMgSA8E8i.png"
                alt="Nitrilo Azul"
                class="w-full h-auto max-h-[160px] md:max-h-[240px] object-contain mix-blend-multiply transition-transform duration-700 md:group-hover:scale-110">
            </div>

            <div class="w-full h-12 flex items-center justify-center">
              <!-- Mobile: Static Content -->
              <div class="flex md:hidden w-full justify-between items-center">
                <span class="text-blue-600 font-bold text-sm">Comprar</span>
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white">
                  <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </div>
              </div>
              <div
                class="hidden md:flex w-full justify-center opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                <div
                  class="bg-blue-600 text-white px-10 py-3 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-blue-500/20">
                  Ver detalles
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 5 -->
        <div class="product-item flex-none w-[320px] md:w-[450px] aspect-square group cursor-pointer"
          onclick="openDetail('vinyl', 'Vinyl LP', 'Guantes de vinilo de alta calidad, ideales para el manejo de alimentos y tareas de limpieza ligera. Libres de látex y polvos.', 'https://ambiderm.com.mx/storage/productos/rXujaebKU43gVFnzmjwJ5bLi1h0KRmWhnGYgA801.png')">
          <div
            class="relative w-full h-full rounded-[40px] bg-white p-8 md:p-12 flex flex-col justify-between transition-all duration-700 md:group-hover:shadow-2xl border border-gray-50 overflow-hidden snap-center md:snap-align-none">

            <div class="z-10 text-left">
              <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-1">Protección</p>
              <h4 class="text-2xl md:text-3xl font-bold text-[#1d1d1f]">Vinyl LP</h4>
              <div class="flex gap-2 mt-3">
                <div class="w-4 h-4 rounded-full bg-gray-50 ring-1 ring-gray-200 shadow-inner"></div>
              </div>
            </div>

            <div class="flex-1 w-full flex items-center justify-center relative">
              <img src="https://ambiderm.com.mx/storage/productos/rXujaebKU43gVFnzmjwJ5bLi1h0KRmWhnGYgA801.png"
                alt="Vinyl LP"
                class="w-full h-auto max-h-[160px] md:max-h-[240px] object-contain mix-blend-multiply transition-transform duration-700 md:group-hover:scale-110">
            </div>

            <div class="w-full h-12 flex items-center justify-center">
              <!-- Mobile: Static Content -->
              <div class="flex md:hidden w-full justify-between items-center">
                <span class="text-blue-600 font-bold text-sm">Comprar</span>
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white">
                  <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </div>
              </div>
              <div
                class="hidden md:flex w-full justify-center opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                <div
                  class="bg-blue-600 text-white px-10 py-3 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-blue-500/20">
                  Ver detalles
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 6 -->
        <div class="product-item flex-none w-[320px] md:w-[450px] aspect-square group cursor-pointer"
          onclick="openDetail('kids', 'Kid Gloves', 'Especialmente diseñados para manos pequeñas. Brindan la misma protección clínica con un ajuste perfecto para los más jóvenes profesionales.', 'https://ambiderm.com.mx/storage/productos/qXdk8YkEfNw7smTDqlW1otPlR3ZXKZ50mnwJpLfz.png')">
          <div
            class="relative w-full h-full rounded-[40px] bg-white p-8 md:p-12 flex flex-col justify-between transition-all duration-700 md:group-hover:shadow-2xl border border-gray-50 overflow-hidden snap-center md:snap-align-none">

            <div class="z-10 text-left">
              <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-1">Infantil</p>
              <h4 class="text-2xl md:text-3xl font-bold text-[#1d1d1f]">Kid Gloves</h4>
              <div class="flex gap-2 mt-3">
                <div class="w-4 h-4 rounded-full bg-green-100 ring-1 ring-gray-200"></div>
              </div>
            </div>

            <div class="flex-1 w-full flex items-center justify-center relative">
              <img src="https://ambiderm.com.mx/storage/productos/qXdk8YkEfNw7smTDqlW1otPlR3ZXKZ50mnwJpLfz.png"
                alt="Kid Gloves"
                class="w-full h-auto max-h-[160px] md:max-h-[240px] object-contain mix-blend-multiply transition-transform duration-700 md:group-hover:scale-110">
            </div>

            <div class="w-full h-12 flex items-center justify-center">
              <!-- Mobile: Static Content -->
              <div class="flex md:hidden w-full justify-between items-center">
                <span class="text-blue-600 font-bold text-sm">Comprar</span>
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white">
                  <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </div>
              </div>
              <!-- Desktop: Button on Hover -->
              <div
                class="hidden md:flex opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500 w-full justify-center">
                <div
                  class="bg-blue-600 text-white px-10 py-3 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-blue-500/20">
                  Ver detalles
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Spacer for end of scroll -->
        <div class="flex-none w-[100px] md:w-[200px]"></div>
      </div>
    </div>
  </section>

  <!-- --- SOLUCIONES MÉDICAS (3 COLUMNS) --- -->
  <section class="py-32 bg-white px-6">
    <div class="max-w-[1400px] mx-auto mb-16 px-4">
      <div class="reveal reveal-fade-in">
        <h3 class="text-4xl md:text-5xl font-bold text-[#1d1d1f] tracking-tight">Soluciones médicas</h3>
        <p class="text-gray-500 mt-2 text-lg">Protección especializada para cada sector.</p>
      </div>
    </div>
    <div class="max-w-[1400px] mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Item Dental -->
      <a href="https://ambiderm.com.mx/categoria/dental"
        class="aspect-square group relative overflow-hidden rounded-[40px] bg-[#f5f5f7] reveal reveal-fade-in">
        <img src="https://ambiderm.com.mx/img/new/dental.png" alt="Dental"
          class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
        <div
          class="absolute inset-x-0 bottom-0 p-10 z-10 bg-gradient-to-t from-blue-950/90 via-blue-900/40 to-transparent flex flex-col items-start w-full">
          <p class="text-[10px] font-bold text-white/70 uppercase tracking-widest mb-1">Especialidad</p>
          <h4 class="text-3xl font-bold text-white mb-6">Dental</h4>
          <div
            class="bg-blue-600 text-white px-6 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500 shadow-lg">
            Ver productos
          </div>
        </div>
      </a>

      <!-- Item Ropa Médica -->
      <a href="https://ambiderm.com.mx/categoria/ropa-medica"
        class="aspect-square group relative overflow-hidden rounded-[40px] bg-[#f5f5f7] reveal reveal-fade-in"
        style="transition-delay: 100ms;">
        <img src="https://ambiderm.com.mx/img/new/ropa.png" alt="Ropa Médica"
          class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
        <div
          class="absolute inset-x-0 bottom-0 p-10 z-10 bg-gradient-to-t from-blue-950/90 via-blue-900/40 to-transparent flex flex-col items-start w-full">
          <p class="text-[10px] font-bold text-white/70 uppercase tracking-widest mb-1">Indumentaria</p>
          <h4 class="text-3xl font-bold text-white mb-6">Ropa Médica</h4>
          <div
            class="bg-blue-600 text-white px-6 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500 shadow-lg">
            Ver productos
          </div>
        </div>
      </a>

      <!-- Item Insumos -->
      <a href="https://ambiderm.com.mx/categoria/insumos-medicos"
        class="aspect-square group relative overflow-hidden rounded-[40px] bg-[#f5f5f7] reveal reveal-fade-in"
        style="transition-delay: 200ms;">
        <img src="https://ambiderm.com.mx/img/new/medico.png" alt="Insumos"
          class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
        <div
          class="absolute inset-x-0 bottom-0 p-10 z-10 bg-gradient-to-t from-blue-950/90 via-blue-900/40 to-transparent flex flex-col items-start w-full">
          <p class="text-[10px] font-bold text-white/70 uppercase tracking-widest mb-1">Esenciales</p>
          <h4 class="text-3xl font-bold text-white mb-6">Insumos Médicos</h4>
          <div
            class="bg-blue-600 text-white px-6 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500 shadow-lg">
            Ver productos
          </div>
        </div>
      </a>
    </div>
  </section>

  <!-- --- ECO-FRIENDLY SECTION --- -->
  <section class="py-32 bg-green-50/30 px-6 overflow-hidden">
    <div class="max-w-[1200px] mx-auto">
      <div class="flex flex-col md:flex-row items-center gap-16">
        <div class="md:w-1/2 reveal reveal-fade-in">
          <div class="flex items-center gap-4 mb-8">
            <img src="https://ambiderm.com.mx/img/new/eco-friendly-icon.png" alt="Eco Icon"
              class="w-16 h-16 object-contain">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-green-700">Responsabilidad Ambiental</span>
          </div>
          <h3 class="text-4xl md:text-6xl font-black text-green-900 mb-8 leading-tight tracking-tighter">
            100% LÁTEX <br> <span class="text-green-600">NATURAL</span>
          </h3>
          <p class="text-green-800/80 text-lg md:text-xl font-medium leading-relaxed mb-8">
            Gracias a su composición de origen natural nuestros guantes de látex Ambiderm se reintegran de una manera
            más rápida reduciendo el impacto en el medio ambiente.
          </p>
          <p class="text-green-800/60 text-base md:text-lg leading-relaxed">
            Nuestros guantes están fabricados con látex natural, provenientes del árbol del hule (Hevea Brasiliensis),
            que brinda mayor elasticidad y protección a comparación de otros tipos de guantes.
          </p>
        </div>
        <div class="md:w-1/2 flex justify-center mt-10 md:mt-0 reveal reveal-scale-in">
          <div class="relative">
            <div class="absolute inset-0 bg-green-200/50 rounded-full blur-3xl transform scale-150 animate-pulse"></div>
            <img src="https://ambiderm.com.mx/storage/productos/7OyCwjS7LYzZDXCWYYdEpHhnmjMjuigXOGnGIGmE.png"
              alt="Eco Guante" class="relative z-10 w-full max-w-[400px] drop-shadow-2xl mix-blend-multiply">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- --- YOUTUBE CINEMATIC SECTION --- -->
  <section class="w-full h-screen bg-black overflow-hidden relative">
    <div class="absolute inset-0 w-full h-full pointer-events-none">
      <iframe class="w-full h-full scale-[1.3] origin-center"
        src="https://www.youtube.com/embed/DkVU_4Mir6Y?autoplay=1&mute=1&loop=1&playlist=DkVU_4Mir6Y&controls=0&showinfo=0&rel=0&modestbranding=1&iv_load_policy=3&disablekb=1"
        frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
      </iframe>
    </div>
  </section>

  <!-- --- LOCATIONS & CONTACT FOOTER --- -->
  <footer class="bg-white pt-32 overflow-hidden" id="contacto">

    <!-- Redes Sociales & Logo -->
    <div class="max-w-[1200px] mx-auto px-6 mb-32">
      <div class="flex flex-col md:flex-row justify-between items-center gap-12">
        <div class="reveal reveal-fade-in">
          <img src="https://ambiderm.com.mx/img/new/logo-ambiderm-azul.svg" alt="Ambiderm Logo" class="h-12 md:h-16">
        </div>
        <div class="text-center md:text-right reveal reveal-fade-in">
          <h4 class="text-2xl md:text-4xl font-black tracking-tighter text-[#1d1d1f] mb-6">
            SÍGUENOS EN <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-400">REDES
              SOCIALES</span>
          </h4>
          <div class="flex justify-center md:justify-end gap-6">
            <a href="https://www.instagram.com/ambiderm/?hl=es-la" target="_blank"
              class="w-14 h-14 rounded-full bg-[#fbfbfd] border border-gray-100 flex items-center justify-center hover:scale-110 hover:shadow-xl transition-all">
              <img src="https://ambiderm.com.mx/img/new/instagram-icon.png" alt="Instagram" class="w-6 h-6">
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
            <h3 class="text-3xl md:text-5xl font-black tracking-tighter text-[#1d1d1f] mb-12">UBICACIONES <br>
              ESTRATÉGICAS</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
              <div class="group cursor-pointer sucursal-btn active" data-map="gdl"
                data-url="https://goo.gl/maps/kD76mn5gFhNue5X47">
                <p class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-3">Matriz</p>
                <h5 class="text-xl font-bold text-[#1d1d1f] mb-2 group-hover:text-blue-600 transition-colors">SAN ISIDRO
                </h5>
                <p class="text-gray-500 text-sm leading-relaxed">
                  Carr. a Bosques de San Isidro No. 1136<br>Zapopan, Jalisco<br>
                  <a href="tel:+523336566557" class="hover:text-blue-600 transition-colors font-semibold">+52 33 3656
                    6557</a>
                </p>
              </div>

              <div class="group cursor-pointer sucursal-btn" data-map="tijuana"
                data-url="https://goo.gl/maps/PEStmVVbnVFVpMvH9">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Norte</p>
                <h5 class="text-xl font-bold text-[#1d1d1f] mb-2 group-hover:text-blue-600 transition-colors">TIJUANA
                </h5>
                <p class="text-gray-500 text-sm leading-relaxed">
                  Calle Mariscal sucre No. 30 C<br>Fracc. Castro, Olivos<br>
                  <a href="tel:+526646081627" class="hover:text-blue-600 transition-colors font-semibold">+52 664 608
                    1627</a>
                </p>
              </div>

              <div class="group cursor-pointer sucursal-btn" data-map="costa-rica"
                data-url="https://goo.gl/maps/bCASmcuCuxvA9csg9">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Centro</p>
                <h5 class="text-xl font-bold text-[#1d1d1f] mb-2 group-hover:text-blue-600 transition-colors">COSTA RICA
                </h5>
                <p class="text-gray-500 text-sm leading-relaxed">
                  La Valencia de Heredia,<br>Oficentro Tech Park,<br>
                  <a href="tel:+50622373377" class="hover:text-blue-600 transition-colors font-semibold">+506 2237
                    3377</a>
                </p>
              </div>

              <div class="group cursor-pointer sucursal-btn" data-map="guatemala"
                data-url="https://goo.gl/maps/TNuRDPTZxkZqqU659">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Centro</p>
                <h5 class="text-xl font-bold text-[#1d1d1f] mb-2 group-hover:text-blue-600 transition-colors">GUATEMALA
                </h5>
                <p class="text-gray-500 text-sm leading-relaxed">
                  Calzada Atanasio Tzul 22-00<br>Empresarial cortijo II<br>
                  <a href="tel:+50222092000" class="hover:text-blue-600 transition-colors font-semibold">+502 2209
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
            <div class="absolute inset-0 bg-blue-100 blur-[100px] opacity-20 -z-10 transform scale-125"></div>
            <a id="main-map-link" href="https://goo.gl/maps/kD76mn5gFhNue5X47" target="_blank"
              class="block relative rounded-[40px] overflow-hidden shadow-2xl border border-white">
              <img id="main-map-img" src="https://ambiderm.com.mx/img/new/mapas/gdl.png" alt="Mapa Ubicación"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
              <div class="absolute inset-x-0 bottom-0 p-8 bg-gradient-to-t from-black/50 to-transparent">
                <span class="text-white font-bold bg-blue-600/80 px-4 py-2 rounded-full text-xs">ABRIR EN GOOGLE
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

          <div class="reveal reveal-fade-in">
            <h4 class="text-blue-600 font-bold uppercase tracking-widest text-xs mb-4">Mantenlo cerca</h4>
            <h3 class="text-3xl md:text-5xl font-black tracking-tighter text-[#1d1d1f] mb-8">¿TIENES ALGUNA <br> DUDA?
            </h3>
            <p class="text-gray-500 text-lg mb-12">Déjanos un mensaje y un especialista se pondrá en contacto contigo a
              la brevedad.</p>

            <a href="https://share.hsforms.com/1vl6EkSEKQBW_SNv3Im1qcA3qrdx" target="_blank"
              class="flex items-center gap-6 p-8 rounded-[30px] bg-blue-50 border border-blue-100 hover:bg-white hover:shadow-2xl transition-all group">
              <div
                class="w-16 h-16 rounded-2xl bg-blue-600 flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition-transform">
                <img src="https://ambiderm.com.mx/img/new/distribuidor-icon.svg" class="w-10 h-10 invert">
              </div>
              <div class="text-left">
                <strong class="text-blue-900 text-xl block leading-tight">QUIERO SER DISTRIBUIDOR</strong>
                <span class="text-blue-600/70 font-medium">Únete a la red Ambiderm</span>
              </div>
              <i data-lucide="chevron-right" class="w-8 h-8 text-blue-300 ml-auto mr-4"></i>
            </a>
          </div>

          <div class="reveal reveal-fade-in bg-[#fbfbfd] p-10 md:p-16 rounded-[40px] border border-gray-100 shadow-sm">
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
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 px-2">Mensaje</label>
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
          <p class="text-[10px] font-bold text-[#1d1d1f] tracking-widest mb-2 uppercase">COPYRIGHT © 2024 AMBIDERM S.A.
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

  <!-- --- PRODUCT DETAIL OVERLAY (MODAL) --- -->
  <div id="product-detail"
    class="fixed inset-0 z-[110] invisible opacity-0 transition-all duration-500 flex items-center justify-center p-4 md:p-10">
    <!-- Blur Background -->
    <div class="absolute inset-0 bg-white/80 backdrop-blur-3xl" onclick="closeDetail()"></div>

    <!-- Modal Container -->
    <div
      class="relative bg-white w-full max-w-[1100px] h-full max-h-[800px] rounded-[40px] shadow-[0_40px_100px_rgba(0,0,0,0.1)] border border-gray-100 overflow-hidden flex flex-col md:flex-row transform scale-95 transition-all duration-500">

      <!-- Close Button -->
      <button onclick="closeDetail()"
        class="absolute top-8 right-8 z-50 w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-colors">
        <i data-lucide="x" class="w-5 h-5"></i>
      </button>

      <!-- Left: Image Area -->
      <div class="md:w-1/2 bg-[#fbfbfd] p-12 flex items-center justify-center relative group">
        <img id="modal-img" src="" alt="Producto"
          class="w-full h-auto object-contain mix-blend-multiply drop-shadow-2xl transition-transform duration-1000 group-hover:scale-105">
      </div>

      <!-- Right: Content Area -->
      <div class="md:w-1/2 p-12 md:p-20 flex flex-col justify-center text-left">
        <span id="modal-tag" class="text-[#f56300] font-bold text-xs uppercase tracking-[0.2em] mb-4">Colección
          Pro</span>
        <h2 id="modal-title" class="text-4xl md:text-5xl font-bold text-[#1d1d1f] tracking-tight mb-6 text-left">Nombre
          del
          Producto</h2>
        <p id="modal-desc" class="text-gray-500 text-lg md:text-xl leading-relaxed mb-10 text-left">
          Descripción detallada del producto con los beneficios y especificaciones técnicas.
        </p>

        <div class="flex flex-col gap-6">
          <div class="flex items-center gap-4">
            <span class="text-sm font-semibold text-gray-400">Tallas disponibles:</span>
            <div class="flex gap-2">
              <span
                class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-[10px] font-bold uppercase">XS</span>
              <span
                class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-[10px] font-bold uppercase">S</span>
              <span
                class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-[10px] font-bold uppercase">M</span>
              <span
                class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-[10px] font-bold uppercase bg-blue-600 border-blue-600 text-white">L</span>
            </div>
          </div>

          <div class="h-[1px] bg-gray-100 w-full my-4"></div>

          <div class="flex items-center gap-4">
            <button
              class="flex-1 bg-[#0071e3] text-white px-10 py-4 rounded-full font-semibold hover:bg-[#0077ed] transition-all hover:scale-[1.02] active:scale-95 shadow-lg shadow-blue-500/20 text-center">
              Comprar en Tienda
            </button>
            <button
              class="w-14 h-14 rounded-full border-2 border-gray-100 flex items-center justify-center text-gray-400 hover:text-red-500 hover:border-red-100 transition-all">
              <i data-lucide="heart" class="w-6 h-6"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

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
      <i id="chat-icon-close" data-lucide="x" class="w-8 h-8 hidden group-hover:scale-110 transition-transform"></i>
      <!-- Badge de notificación -->
      <span class="absolute top-0 right-0 w-5 h-5 bg-red-500 border-2 border-white rounded-full"></span>
    </button>
  </div>


  <script>
    // --- NAVIGATION STATE ---
    const mainNav = document.getElementById('main-nav');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 20) {
        mainNav.classList.add('bg-white/70', 'backdrop-blur-xl', 'border-b', 'border-gray-200/50');
        mainNav.classList.remove('bg-transparent');
      } else {
        if (!document.getElementById('mobile-menu').classList.contains('active')) {
          mainNav.classList.remove('bg-white/70', 'backdrop-blur-xl', 'border-b', 'border-gray-200/50');
          mainNav.classList.add('bg-transparent');
        }
      }
    });

    // --- MOBILE MENU TOGGLE ---
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIconOpen = document.getElementById('menu-icon-open');
    const menuIconClose = document.getElementById('menu-icon-close');

    menuToggle.addEventListener('click', () => {
      const isOpen = mobileMenu.classList.toggle('active');
      if (isOpen) {
        menuIconOpen.classList.add('hidden');
        menuIconClose.classList.remove('hidden');
        mainNav.classList.add('bg-white');
        document.body.style.overflow = 'hidden';
      } else {
        menuIconOpen.classList.remove('hidden');
        menuIconClose.classList.add('hidden');
        if (window.scrollY <= 20) mainNav.classList.remove('bg-white');
        document.body.style.overflow = '';
      }
    });

    // --- LENIS SMOOTH SCROLL INITIALIZATION ---
    const lenis = new Lenis({
      duration: 1.5,
      easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
      direction: 'vertical',
      gestureDirection: 'vertical',
      smooth: true,
      mouseMultiplier: 1,
      smoothTouch: false,
      touchMultiplier: 2,
      infinite: false,
    });

    function raf(time) {
      lenis.raf(time);
      requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);

    // --- AUTO-SLIDE COLLECTION ---
    const shelf = document.getElementById('product-shelf');
    let isAutoScrolling = true;
    let scrollSpeed = 0.5;

    function autoScroll() {
      if (isAutoScrolling && window.innerWidth > 768) {
        shelf.scrollLeft += scrollSpeed;
        if (shelf.scrollLeft >= shelf.scrollWidth - shelf.clientWidth) {
          shelf.scrollLeft = 0;
        }
      }
      requestAnimationFrame(autoScroll);
    }
    autoScroll();

    shelf.addEventListener('mouseenter', () => isAutoScrolling = false);
    shelf.addEventListener('mouseleave', () => isAutoScrolling = true);

    // --- CAROUSEL BUTTONS ---
    const btnLeft = document.getElementById('scroll-left');
    const btnRight = document.getElementById('scroll-right');

    btnLeft.addEventListener('click', () => {
      lenis.scrollTo(shelf, { offset: -100 });
      shelf.scrollBy({ left: -450, behavior: 'smooth' });
    });

    btnRight.addEventListener('click', () => {
      shelf.scrollBy({ left: 450, behavior: 'smooth' });
    });

    // --- PRODUCT DETAIL LOGIC ---
    function openDetail(id, title, desc, img) {
      const modal = document.getElementById('product-detail');
      const inner = modal.querySelector('div:nth-child(2)');

      document.getElementById('modal-title').innerText = title;
      document.getElementById('modal-desc').innerText = desc;
      document.getElementById('modal-img').src = img;

      modal.classList.remove('invisible', 'opacity-0');
      inner.classList.remove('scale-95');
      inner.classList.add('scale-100');
      document.body.style.overflow = 'hidden';
      lenis.stop();
    }

    function closeDetail() {
      const modal = document.getElementById('product-detail');
      const inner = modal.querySelector('div:nth-child(2)');

      modal.classList.add('opacity-0');
      inner.classList.remove('scale-100');
      inner.classList.add('scale-95');

      setTimeout(() => {
        modal.classList.add('invisible');
        document.body.style.overflow = '';
        lenis.start();
      }, 500);
    }

    // --- LOCATION MAP LOGIC ---
    const sucursalBtns = document.querySelectorAll('.sucursal-btn');
    const mainMapImg = document.getElementById('main-map-img');
    const mainMapLink = document.getElementById('main-map-link');

    sucursalBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        // Remove active from all
        sucursalBtns.forEach(b => b.classList.remove('active'));

        // Add to clicked
        btn.classList.add('active');

        // Update Map
        const mapKey = btn.getAttribute('data-map');
        const mapUrl = btn.getAttribute('data-url');
        mainMapImg.src = `https://ambiderm.com.mx/img/new/mapas/${mapKey}.png`;
        mainMapLink.href = mapUrl;
      });
    });

    // --- INTERSECTION OBSERVER FOR REVEAL ANIMATIONS ---
    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('active');
        }
      });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));
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
      <i id="chat-icon-close" data-lucide="x" class="w-8 h-8 hidden group-hover:scale-110 transition-transform"></i>
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

</body>

</html>