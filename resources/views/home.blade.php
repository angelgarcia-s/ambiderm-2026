<x-layouts.public title="Ambiderm - Innovación en Protección" :nav-transparent="true">

  <!-- --- HERO SECTION --- -->
  <section class="relative pt-40 pb-12 md:pt-52 md:pb-20 px-6 text-center bg-brand-surface overflow-hidden">
    <div class="max-w-[1200px] mx-auto relative z-10">
      <div class="reveal reveal-fade-in" style="transition-delay: 200ms;">
        <h1 class="text-6xl md:text-8xl lg:text-9xl font-black tracking-tighter mb-6">
          <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-blue-400 to-cyan-400">Ambiderm</span>
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
  <section id="video-feature" class="py-12 md:py-24 px-6 bg-brand-surface">
    <div class="max-w-[1200px] mx-auto">
      <div class="reveal reveal-scale-in bg-white border border-gray-100 rounded-[50px] overflow-hidden shadow-[0_40px_100px_rgba(0,0,0,0.05)] flex flex-col md:flex-row items-stretch">

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
              <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-blue-400 to-cyan-400">NUEVO</span><br>
              <span class="text-brand-ink">Vynil Synmax</span>
            </h2>
            <p class="text-gray-500 text-lg md:text-xl font-medium leading-relaxed mb-10">
              Siente la revolución en protección clínica. Una nueva era de seguridad y confort táctil.
            </p>

            <div class="flex flex-col sm:flex-row gap-4">
              <a href="{{ route('guantes-vynil') }}"
                class="bg-brand-blue text-white px-10 py-4 rounded-full font-semibold hover:bg-brand-blue-hover transition-all hover:scale-105 active:scale-95 shadow-lg shadow-blue-500/20 text-center">
                Comprar ahora
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- --- HORIZONTAL SCROLL COLLECTION --- -->
  <section class="bg-brand-surface pt-32 pb-16 border-t border-gray-100 overflow-hidden" id="productos">
    <div class="max-w-[1400px] mx-auto px-6">
      <div class="flex justify-between items-end mb-12">
        <div class="reveal reveal-fade-in">
          <h3 class="text-4xl md:text-5xl font-bold text-brand-ink tracking-tight">La Colección.</h3>
          <p class="text-gray-500 mt-2 text-lg">Encuentra el ajuste perfecto para ti.</p>
        </div>
        <div class="hidden md:flex gap-4 items-center">
          <a href="https://ambiderm.com.mx/categoria/guantes" target="_blank"
            class="mr-4 text-brand-blue font-bold hover:text-brand-blue-hover transition-colors flex items-center gap-2 text-sm uppercase tracking-widest">
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
          <div class="relative w-full h-full rounded-[40px] bg-white p-8 md:p-12 flex flex-col justify-between transition-all duration-700 md:group-hover:shadow-2xl border border-gray-50 overflow-hidden snap-center md:snap-align-none">
            <div class="z-10 text-left">
              <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-1">Cirugía</p>
              <h4 class="text-2xl md:text-3xl font-bold text-brand-ink">Estéril</h4>
              <div class="flex gap-2 mt-3">
                <div class="w-4 h-4 rounded-full bg-gray-100 ring-1 ring-gray-200"></div>
              </div>
            </div>
            <div class="flex-1 w-full flex items-center justify-center relative">
              <img src="https://ambiderm.com.mx/storage/productos/7OyCwjS7LYzZDXCWYYdEpHhnmjMjuigXOGnGIGmE.png" alt="Estéril"
                class="w-full h-auto max-h-[160px] md:max-h-[240px] object-contain mix-blend-multiply transition-transform duration-700 md:group-hover:scale-110">
            </div>
            <div class="w-full h-12 flex items-center justify-center">
              <div class="flex md:hidden w-full justify-between items-center">
                <span class="text-brand-blue font-bold text-sm">Comprar</span>
                <div class="w-10 h-10 rounded-full bg-brand-blue flex items-center justify-center text-white">
                  <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </div>
              </div>
              <div class="hidden md:flex w-full justify-center opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                <div class="bg-blue-600 text-white px-10 py-3 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-blue-500/20">Ver detalles</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 2 -->
        <div class="product-item flex-none w-[320px] md:w-[450px] aspect-square group cursor-pointer"
          onclick="openDetail('plus-negro', 'Plus Negro', 'Elegante y resistente, el Plus Negro es el favorito de los estudios de tatuaje y clínicas de alta gama. Máxima visibilidad y agarre superior.', 'https://ambiderm.com.mx/storage/productos/0yAxWIiIHSkm2v7G2Sad9cgRmihjI7Y3nWMha3CP.png')">
          <div class="relative w-full h-full rounded-[40px] bg-white p-8 md:p-12 flex flex-col justify-between transition-all duration-700 md:group-hover:shadow-2xl border border-gray-50 overflow-hidden snap-center md:snap-align-none">
            <div class="z-10 text-left">
              <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-1">Estilo</p>
              <h4 class="text-2xl md:text-3xl font-bold text-brand-ink">Plus Negro</h4>
              <div class="flex gap-2 mt-3">
                <div class="w-4 h-4 rounded-full bg-black ring-1 ring-gray-200 shadow-inner"></div>
              </div>
            </div>
            <div class="flex-1 w-full flex items-center justify-center relative">
              <img src="https://ambiderm.com.mx/storage/productos/0yAxWIiIHSkm2v7G2Sad9cgRmihjI7Y3nWMha3CP.png" alt="Plus Negro"
                class="w-full h-auto max-h-[160px] md:max-h-[240px] object-contain mix-blend-multiply transition-transform duration-700 md:group-hover:scale-110">
            </div>
            <div class="w-full h-12 flex items-center justify-center">
              <div class="flex md:hidden w-full justify-between items-center">
                <span class="text-brand-blue font-bold text-sm">Comprar</span>
                <div class="w-10 h-10 rounded-full bg-brand-blue flex items-center justify-center text-white">
                  <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </div>
              </div>
              <div class="hidden md:flex w-full justify-center opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                <div class="bg-blue-600 text-white px-10 py-3 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-blue-500/20">Ver detalles</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 3 -->
        <div class="product-item flex-none w-[320px] md:w-[450px] aspect-square group cursor-pointer"
          onclick="openDetail('confort', 'Confort', 'Protección clásica con la suavidad del látex natural. Ideal para uso clínico diario donde la comodidad es tan importante como la seguridad.', 'https://ambiderm.com.mx/storage/productos/2Nen9Dz9AypEFaCapHIwHMe4eBaV6uMlgXLLFsWt.png')">
          <div class="relative w-full h-full rounded-[40px] bg-white p-8 md:p-12 flex flex-col justify-between transition-all duration-700 md:group-hover:shadow-2xl border border-gray-50 overflow-hidden snap-center md:snap-align-none">
            <div class="z-10 text-left">
              <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-1">Uso Diario</p>
              <h4 class="text-2xl md:text-3xl font-bold text-brand-ink">Confort</h4>
              <div class="flex gap-2 mt-3">
                <div class="w-4 h-4 rounded-full bg-yellow-50 ring-1 ring-gray-200"></div>
              </div>
            </div>
            <div class="flex-1 w-full flex items-center justify-center relative">
              <img src="https://ambiderm.com.mx/storage/productos/2Nen9Dz9AypEFaCapHIwHMe4eBaV6uMlgXLLFsWt.png" alt="Confort"
                class="w-full h-auto max-h-[160px] md:max-h-[240px] object-contain mix-blend-multiply transition-transform duration-700 md:group-hover:scale-110">
            </div>
            <div class="w-full h-12 flex items-center justify-center">
              <div class="flex md:hidden w-full justify-between items-center">
                <span class="text-brand-blue font-bold text-sm">Comprar</span>
                <div class="w-10 h-10 rounded-full bg-brand-blue flex items-center justify-center text-white">
                  <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </div>
              </div>
              <div class="hidden md:flex w-full justify-center opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                <div class="bg-blue-600 text-white px-10 py-3 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-blue-500/20">Ver detalles</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 4 -->
        <div class="product-item flex-none w-[320px] md:w-[450px] aspect-square group cursor-pointer"
          onclick="openDetail('nitrilo', 'Nitrilo Azul', 'Libre de látex y altamente resistente. El guante de nitrilo Ambiderm ofrece la mejor barrera contra agentes químicos y punciones.', 'https://ambiderm.com.mx/storage/productos/BDOCYI3GixLQoC1nmI7oFe6ZJ2F8vPpvMgSA8E8i.png')">
          <div class="relative w-full h-full rounded-[40px] bg-white p-8 md:p-12 flex flex-col justify-between transition-all duration-700 md:group-hover:shadow-2xl border border-gray-50 overflow-hidden snap-center md:snap-align-none">
            <div class="z-10 text-left">
              <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-1">Resistencia</p>
              <h4 class="text-2xl md:text-3xl font-bold text-brand-ink">Nitrilo Azul</h4>
              <div class="flex gap-2 mt-3">
                <div class="w-4 h-4 rounded-full bg-blue-400 ring-1 ring-gray-200 shadow-inner"></div>
              </div>
            </div>
            <div class="flex-1 w-full flex items-center justify-center relative">
              <img src="https://ambiderm.com.mx/storage/productos/BDOCYI3GixLQoC1nmI7oFe6ZJ2F8vPpvMgSA8E8i.png" alt="Nitrilo Azul"
                class="w-full h-auto max-h-[160px] md:max-h-[240px] object-contain mix-blend-multiply transition-transform duration-700 md:group-hover:scale-110">
            </div>
            <div class="w-full h-12 flex items-center justify-center">
              <div class="flex md:hidden w-full justify-between items-center">
                <span class="text-brand-blue font-bold text-sm">Comprar</span>
                <div class="w-10 h-10 rounded-full bg-brand-blue flex items-center justify-center text-white">
                  <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </div>
              </div>
              <div class="hidden md:flex w-full justify-center opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                <div class="bg-blue-600 text-white px-10 py-3 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-blue-500/20">Ver detalles</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 5 -->
        <div class="product-item flex-none w-[320px] md:w-[450px] aspect-square group cursor-pointer"
          onclick="openDetail('vinyl', 'Vinyl LP', 'Guantes de vinilo de alta calidad, ideales para el manejo de alimentos y tareas de limpieza ligera. Libres de látex y polvos.', 'https://ambiderm.com.mx/storage/productos/rXujaebKU43gVFnzmjwJ5bLi1h0KRmWhnGYgA801.png')">
          <div class="relative w-full h-full rounded-[40px] bg-white p-8 md:p-12 flex flex-col justify-between transition-all duration-700 md:group-hover:shadow-2xl border border-gray-50 overflow-hidden snap-center md:snap-align-none">
            <div class="z-10 text-left">
              <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-1">Protección</p>
              <h4 class="text-2xl md:text-3xl font-bold text-brand-ink">Vinyl LP</h4>
              <div class="flex gap-2 mt-3">
                <div class="w-4 h-4 rounded-full bg-gray-50 ring-1 ring-gray-200 shadow-inner"></div>
              </div>
            </div>
            <div class="flex-1 w-full flex items-center justify-center relative">
              <img src="https://ambiderm.com.mx/storage/productos/rXujaebKU43gVFnzmjwJ5bLi1h0KRmWhnGYgA801.png" alt="Vinyl LP"
                class="w-full h-auto max-h-[160px] md:max-h-[240px] object-contain mix-blend-multiply transition-transform duration-700 md:group-hover:scale-110">
            </div>
            <div class="w-full h-12 flex items-center justify-center">
              <div class="flex md:hidden w-full justify-between items-center">
                <span class="text-brand-blue font-bold text-sm">Comprar</span>
                <div class="w-10 h-10 rounded-full bg-brand-blue flex items-center justify-center text-white">
                  <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </div>
              </div>
              <div class="hidden md:flex w-full justify-center opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                <div class="bg-blue-600 text-white px-10 py-3 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-blue-500/20">Ver detalles</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 6 -->
        <div class="product-item flex-none w-[320px] md:w-[450px] aspect-square group cursor-pointer"
          onclick="openDetail('kids', 'Kid Gloves', 'Especialmente diseñados para manos pequeñas. Brindan la misma protección clínica con un ajuste perfecto para los más jóvenes profesionales.', 'https://ambiderm.com.mx/storage/productos/qXdk8YkEfNw7smTDqlW1otPlR3ZXKZ50mnwJpLfz.png')">
          <div class="relative w-full h-full rounded-[40px] bg-white p-8 md:p-12 flex flex-col justify-between transition-all duration-700 md:group-hover:shadow-2xl border border-gray-50 overflow-hidden snap-center md:snap-align-none">
            <div class="z-10 text-left">
              <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-1">Infantil</p>
              <h4 class="text-2xl md:text-3xl font-bold text-brand-ink">Kid Gloves</h4>
              <div class="flex gap-2 mt-3">
                <div class="w-4 h-4 rounded-full bg-green-100 ring-1 ring-gray-200"></div>
              </div>
            </div>
            <div class="flex-1 w-full flex items-center justify-center relative">
              <img src="https://ambiderm.com.mx/storage/productos/qXdk8YkEfNw7smTDqlW1otPlR3ZXKZ50mnwJpLfz.png" alt="Kid Gloves"
                class="w-full h-auto max-h-[160px] md:max-h-[240px] object-contain mix-blend-multiply transition-transform duration-700 md:group-hover:scale-110">
            </div>
            <div class="w-full h-12 flex items-center justify-center">
              <div class="flex md:hidden w-full justify-between items-center">
                <span class="text-brand-blue font-bold text-sm">Comprar</span>
                <div class="w-10 h-10 rounded-full bg-brand-blue flex items-center justify-center text-white">
                  <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </div>
              </div>
              <div class="hidden md:flex opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500 w-full justify-center">
                <div class="bg-blue-600 text-white px-10 py-3 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-blue-500/20">Ver detalles</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Spacer para fin de scroll -->
        <div class="flex-none w-[100px] md:w-[200px]"></div>
      </div>
    </div>
  </section>

  <!-- --- SOLUCIONES MÉDICAS (3 COLUMNS) --- -->
  <section class="py-32 bg-white px-6">
    <div class="max-w-[1400px] mx-auto mb-16 px-4">
      <div class="reveal reveal-fade-in">
        <h3 class="text-4xl md:text-5xl font-bold text-brand-ink tracking-tight">Soluciones médicas</h3>
        <p class="text-gray-500 mt-2 text-lg">Protección especializada para cada sector.</p>
      </div>
    </div>
    <div class="max-w-[1400px] mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
      <a href="https://ambiderm.com.mx/categoria/dental" class="aspect-square group relative overflow-hidden rounded-[40px] bg-brand-surface reveal reveal-fade-in">
        <img src="https://ambiderm.com.mx/img/new/dental.png" alt="Dental" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
        <div class="absolute inset-x-0 bottom-0 p-10 z-10 bg-gradient-to-t from-blue-950/90 via-blue-900/40 to-transparent flex flex-col items-start w-full">
          <p class="text-[10px] font-bold text-white/70 uppercase tracking-widest mb-1">Especialidad</p>
          <h4 class="text-3xl font-bold text-white mb-6">Dental</h4>
          <div class="bg-blue-600 text-white px-6 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500 shadow-lg">Ver productos</div>
        </div>
      </a>

      <a href="https://ambiderm.com.mx/categoria/ropa-medica" class="aspect-square group relative overflow-hidden rounded-[40px] bg-brand-surface reveal reveal-fade-in" style="transition-delay: 100ms;">
        <img src="https://ambiderm.com.mx/img/new/ropa.png" alt="Ropa Médica" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
        <div class="absolute inset-x-0 bottom-0 p-10 z-10 bg-gradient-to-t from-blue-950/90 via-blue-900/40 to-transparent flex flex-col items-start w-full">
          <p class="text-[10px] font-bold text-white/70 uppercase tracking-widest mb-1">Indumentaria</p>
          <h4 class="text-3xl font-bold text-white mb-6">Ropa Médica</h4>
          <div class="bg-blue-600 text-white px-6 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500 shadow-lg">Ver productos</div>
        </div>
      </a>

      <a href="https://ambiderm.com.mx/categoria/insumos-medicos" class="aspect-square group relative overflow-hidden rounded-[40px] bg-brand-surface reveal reveal-fade-in" style="transition-delay: 200ms;">
        <img src="https://ambiderm.com.mx/img/new/medico.png" alt="Insumos" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
        <div class="absolute inset-x-0 bottom-0 p-10 z-10 bg-gradient-to-t from-blue-950/90 via-blue-900/40 to-transparent flex flex-col items-start w-full">
          <p class="text-[10px] font-bold text-white/70 uppercase tracking-widest mb-1">Esenciales</p>
          <h4 class="text-3xl font-bold text-white mb-6">Insumos Médicos</h4>
          <div class="bg-blue-600 text-white px-6 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500 shadow-lg">Ver productos</div>
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
            <img src="https://ambiderm.com.mx/img/new/eco-friendly-icon.png" alt="Eco Icon" class="w-16 h-16 object-contain">
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
          <h4 class="text-2xl md:text-4xl font-black tracking-tighter text-brand-ink mb-6">
            SÍGUENOS EN <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-400">REDES SOCIALES</span>
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
          <div class="reveal reveal-fade-in">
            <h3 class="text-3xl md:text-5xl font-black tracking-tighter text-brand-ink mb-12">UBICACIONES <br> ESTRATÉGICAS</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
              <div class="group cursor-pointer sucursal-btn active" data-map="gdl" data-url="https://goo.gl/maps/kD76mn5gFhNue5X47">
                <p class="text-xs font-bold text-brand-blue uppercase tracking-widest mb-3">Matriz</p>
                <h5 class="text-xl font-bold text-brand-ink mb-2 group-hover:text-brand-blue transition-colors">SAN ISIDRO</h5>
                <p class="text-gray-500 text-sm leading-relaxed">
                  Carr. a Bosques de San Isidro No. 1136<br>Zapopan, Jalisco<br>
                  <a href="tel:+523336566557" class="hover:text-brand-blue transition-colors font-semibold">+52 33 3656 6557</a>
                </p>
              </div>
              <div class="group cursor-pointer sucursal-btn" data-map="tijuana" data-url="https://goo.gl/maps/PEStmVVbnVFVpMvH9">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Norte</p>
                <h5 class="text-xl font-bold text-brand-ink mb-2 group-hover:text-brand-blue transition-colors">TIJUANA</h5>
                <p class="text-gray-500 text-sm leading-relaxed">
                  Calle Mariscal sucre No. 30 C<br>Fracc. Castro, Olivos<br>
                  <a href="tel:+526646081627" class="hover:text-brand-blue transition-colors font-semibold">+52 664 608 1627</a>
                </p>
              </div>
              <div class="group cursor-pointer sucursal-btn" data-map="costa-rica" data-url="https://goo.gl/maps/bCASmcuCuxvA9csg9">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Centro</p>
                <h5 class="text-xl font-bold text-brand-ink mb-2 group-hover:text-brand-blue transition-colors">COSTA RICA</h5>
                <p class="text-gray-500 text-sm leading-relaxed">
                  La Valencia de Heredia,<br>Oficentro Tech Park,<br>
                  <a href="tel:+50622373377" class="hover:text-brand-blue transition-colors font-semibold">+506 2237 3377</a>
                </p>
              </div>
              <div class="group cursor-pointer sucursal-btn" data-map="guatemala" data-url="https://goo.gl/maps/TNuRDPTZxkZqqU659">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Centro</p>
                <h5 class="text-xl font-bold text-brand-ink mb-2 group-hover:text-brand-blue transition-colors">GUATEMALA</h5>
                <p class="text-gray-500 text-sm leading-relaxed">
                  Calzada Atanasio Tzul 22-00<br>Empresarial cortijo II<br>
                  <a href="tel:+50222092000" class="hover:text-brand-blue transition-colors font-semibold">+502 2209 2000</a>
                </p>
              </div>
            </div>
            <div class="mt-16 reveal reveal-fade-in">
              <a href="mailto:info@ambiderm.com.mx" class="inline-flex items-center gap-4 text-brand-ink font-bold text-2xl hover:text-brand-blue transition-all">
                info@ambiderm.com.mx
                <i data-lucide="arrow-up-right" class="w-6 h-6"></i>
              </a>
            </div>
          </div>

          <!-- Mapa Interactivo -->
          <div class="reveal reveal-scale-in relative group">
            <div class="absolute inset-0 bg-blue-100 blur-[100px] opacity-20 -z-10 transform scale-125"></div>
            <a id="main-map-link" href="https://goo.gl/maps/kD76mn5gFhNue5X47" target="_blank"
              class="block relative rounded-[40px] overflow-hidden shadow-2xl border border-white">
              <img id="main-map-img" src="https://ambiderm.com.mx/img/new/mapas/gdl.png" alt="Mapa Ubicación"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
              <div class="absolute inset-x-0 bottom-0 p-8 bg-gradient-to-t from-black/50 to-transparent">
                <span class="text-white font-bold bg-blue-600/80 px-4 py-2 rounded-full text-xs">ABRIR EN GOOGLE MAPS</span>
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
            <h4 class="text-brand-blue font-bold uppercase tracking-widest text-xs mb-4">Mantenlo cerca</h4>
            <h3 class="text-3xl md:text-5xl font-black tracking-tighter text-brand-ink mb-8">¿TIENES ALGUNA <br> DUDA?</h3>
            <p class="text-gray-500 text-lg mb-12">Déjanos un mensaje y un especialista se pondrá en contacto contigo a la brevedad.</p>

            <a href="https://share.hsforms.com/1vl6EkSEKQBW_SNv3Im1qcA3qrdx" target="_blank"
              class="flex items-center gap-6 p-8 rounded-[30px] bg-blue-50 border border-blue-100 hover:bg-white hover:shadow-2xl transition-all group">
              <div class="w-16 h-16 rounded-2xl bg-blue-600 flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition-transform">
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
                  <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 px-2">Nombre</label>
                  <input type="text" placeholder="Tu nombre" class="w-full bg-white border border-gray-100 rounded-2xl px-6 py-4 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                </div>
                <div>
                  <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 px-2">Correo</label>
                  <input type="email" placeholder="email@ejemplo.com" class="w-full bg-white border border-gray-100 rounded-2xl px-6 py-4 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                </div>
              </div>
              <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 px-2">Mensaje</label>
                <textarea rows="4" placeholder="¿En qué podemos ayudarte?" class="w-full bg-white border border-gray-100 rounded-2xl px-6 py-4 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all resize-none"></textarea>
              </div>
              <button class="w-full bg-brand-ink text-white py-5 rounded-full font-bold text-lg hover:bg-brand-blue hover:shadow-2xl shadow-blue-500/30 transition-all transform active:scale-[0.98]">
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
          <p class="text-[10px] font-bold text-brand-ink tracking-widest mb-2 uppercase">COPYRIGHT © 2024 AMBIDERM S.A. DE C.V.</p>
          <p class="text-gray-400 text-[10px]">TODOS LOS DERECHOS RESERVADOS</p>
        </div>
        <div class="flex flex-wrap justify-center gap-x-8 gap-y-2">
          <a href="#" class="text-[10px] font-bold text-gray-400 hover:text-brand-blue transition-colors uppercase tracking-widest">Términos</a>
          <a href="#" class="text-[10px] font-bold text-gray-400 hover:text-brand-blue transition-colors uppercase tracking-widest">Privacidad</a>
          <a href="#" class="text-[10px] font-bold text-gray-400 hover:text-brand-blue transition-colors uppercase tracking-widest">Cookies</a>
          <a href="#" class="text-[10px] font-bold text-gray-400 hover:text-brand-blue transition-colors uppercase tracking-widest">Bolsa de Trabajo</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- --- PRODUCT DETAIL OVERLAY (MODAL) --- -->
  <div id="product-detail" class="fixed inset-0 z-[110] invisible opacity-0 transition-all duration-500 flex items-center justify-center p-4 md:p-10">
    <div class="absolute inset-0 bg-white/80 backdrop-blur-3xl" onclick="closeDetail()"></div>
    <div class="relative bg-white w-full max-w-[1100px] h-full max-h-[800px] rounded-[40px] shadow-[0_40px_100px_rgba(0,0,0,0.1)] border border-gray-100 overflow-hidden flex flex-col md:flex-row transform scale-95 transition-all duration-500">
      <button onclick="closeDetail()" class="absolute top-8 right-8 z-50 w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-colors">
        <i data-lucide="x" class="w-5 h-5"></i>
      </button>
      <div class="md:w-1/2 bg-[#fbfbfd] p-12 flex items-center justify-center relative group">
        <img id="modal-img" src="" alt="Producto" class="w-full h-auto object-contain mix-blend-multiply drop-shadow-2xl transition-transform duration-1000 group-hover:scale-105">
      </div>
      <div class="md:w-1/2 p-12 md:p-20 flex flex-col justify-center text-left">
        <span id="modal-tag" class="text-[#f56300] font-bold text-xs uppercase tracking-[0.2em] mb-4">Colección Pro</span>
        <h2 id="modal-title" class="text-4xl md:text-5xl font-bold text-brand-ink tracking-tight mb-6 text-left">Nombre del Producto</h2>
        <p id="modal-desc" class="text-gray-500 text-lg md:text-xl leading-relaxed mb-10 text-left">
          Descripción detallada del producto con los beneficios y especificaciones técnicas.
        </p>
        <div class="flex flex-col gap-6">
          <div class="flex items-center gap-4">
            <span class="text-sm font-semibold text-gray-400">Tallas disponibles:</span>
            <div class="flex gap-2">
              <span class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-[10px] font-bold uppercase">XS</span>
              <span class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-[10px] font-bold uppercase">S</span>
              <span class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-[10px] font-bold uppercase">M</span>
              <span class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-[10px] font-bold uppercase bg-blue-600 border-blue-600 text-white">L</span>
            </div>
          </div>
          <div class="h-[1px] bg-gray-100 w-full my-4"></div>
          <div class="flex items-center gap-4">
            <button class="flex-1 bg-brand-blue text-white px-10 py-4 rounded-full font-semibold hover:bg-brand-blue-hover transition-all hover:scale-[1.02] active:scale-95 shadow-lg shadow-blue-500/20 text-center">
              Comprar en Tienda
            </button>
            <button class="w-14 h-14 rounded-full border-2 border-gray-100 flex items-center justify-center text-gray-400 hover:text-red-500 hover:border-red-100 transition-all">
              <i data-lucide="heart" class="w-6 h-6"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- === JS específico de esta página === --}}
  <x-slot:scripts>
    <script>
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
        shelf.scrollBy({ left: -450, behavior: 'smooth' });
      });

      btnRight.addEventListener('click', () => {
        shelf.scrollBy({ left: 450, behavior: 'smooth' });
      });

      // --- PRODUCT DETAIL MODAL ---
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
        window.lenis.stop();
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
          window.lenis.start();
        }, 500);
      }

      // --- LOCATION MAP ---
      const sucursalBtns = document.querySelectorAll('.sucursal-btn');
      const mainMapImg = document.getElementById('main-map-img');
      const mainMapLink = document.getElementById('main-map-link');

      sucursalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          sucursalBtns.forEach(b => b.classList.remove('active'));
          btn.classList.add('active');
          const mapKey = btn.getAttribute('data-map');
          const mapUrl = btn.getAttribute('data-url');
          mainMapImg.src = `https://ambiderm.com.mx/img/new/mapas/${mapKey}.png`;
          mainMapLink.href = mapUrl;
        });
      });
    </script>
  </x-slot:scripts>

</x-layouts.public>
