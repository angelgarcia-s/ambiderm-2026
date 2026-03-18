<x-layouts.public title="Ambiderm - Innovación en Protección" :nav-transparent="true">

@if ($secciones->has('hero'))
    @php $hero = $secciones['hero']->contenido; @endphp
    <!-- --- HERO SECTION --- -->
    <section class="relative pt-40 pb-12 md:pt-52 md:pb-20 px-6 text-center bg-brand-surface overflow-hidden">
        <div class="max-w-[1200px] mx-auto relative z-10">
            <div class="reveal reveal-fade-in" style="transition-delay: 200ms;">
                <h1 class="text-6xl md:text-8xl lg:text-9xl font-black tracking-tighter mb-6">
                    <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-blue-400 to-cyan-400">{{ $hero['titulo'] }}</span>
                </h1>
            </div>

            <div class="reveal reveal-fade-in" style="transition-delay: 400ms;">
                <p
                    class="text-xl md:text-3xl text-gray-500 font-medium max-w-2xl mx-auto leading-normal tracking-tight mb-16">
                    {{ $hero['subtitulo'] }}
                </p>
            </div>

            <!-- Imagen Central Hero -->
            <div class="reveal reveal-scale-in max-w-[1000px] mx-auto" style="transition-delay: 600ms;">
                <img src="{{ $hero['imagen'] }}" alt="{{ $hero['imagen_alt'] }}"
                    class="w-full h-auto drop-shadow-[0_20px_50px_rgba(0,0,0,0.1)] hover:scale-[1.02] transition-transform duration-700">
            </div>
        </div>
    </section>
@endif

@if ($secciones->has('video_feature'))
    @php $videoFeature = $secciones['video_feature']->contenido; @endphp
    <!-- --- VIDEO FEATURE CARD (2 COLUMNS) --- -->
    <section id="video-feature" class="py-12 md:py-24 px-6 bg-brand-surface">
        <div class="max-w-[1200px] mx-auto">
            <div
                class="reveal reveal-scale-in bg-white border border-gray-100 rounded-[50px] overflow-hidden shadow-[0_40px_100px_rgba(0,0,0,0.05)] flex flex-col md:flex-row items-stretch">

                <!-- Left: Video Content -->
                <div class="md:w-3/5 h-[400px] md:h-[600px] relative overflow-hidden">
                    <video class="absolute inset-0 w-full h-full object-cover" autoplay muted loop playsinline>
                        <source src="{{ $videoFeature['video_url'] }}" type="video/mp4">
                    </video>
                </div>

                <!-- Right: Action Content -->
                <div class="md:w-2/5 p-12 md:p-16 flex flex-col justify-center bg-white border-l border-gray-50">
                    <div class="reveal reveal-fade-in text-left">
                        <h2 class="text-4xl md:text-5xl font-black tracking-tighter leading-tight mb-6">
                            <span
                                class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-blue-400 to-cyan-400">{{ $videoFeature['badge'] }}</span><br>
                            <span class="text-brand-ink">{{ $videoFeature['nombre_producto'] }}</span>
                        </h2>
                        <p class="text-gray-500 text-lg md:text-xl font-medium leading-relaxed mb-10">
                            {{ $videoFeature['descripcion'] }}
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ $videoFeature['cta_url'] }}"
                                class="bg-brand-blue text-white px-10 py-4 rounded-full font-semibold hover:bg-brand-blue-hover transition-all hover:scale-105 active:scale-95 shadow-lg shadow-blue-500/20 text-center">
                                {{ $videoFeature['cta_texto'] }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

@if ($secciones->has('coleccion'))
    @php $coleccion = $secciones['coleccion']->contenido; @endphp
    <!-- --- HORIZONTAL SCROLL COLLECTION --- -->
    <section class="bg-brand-surface pt-32 pb-16 border-t border-gray-100 overflow-hidden" id="productos">
        <div class="max-w-[1400px] mx-auto px-6">
            <div class="flex justify-between items-end mb-12">
                <div class="reveal reveal-fade-in">
                    <h3 class="text-4xl md:text-5xl font-bold text-brand-ink tracking-tight">{{ $coleccion['titulo'] }}
                    </h3>
                    <p class="text-gray-500 mt-2 text-lg">{{ $coleccion['subtitulo'] }}</p>
                </div>
                <div class="hidden md:flex gap-4 items-center">
                    <a href="{{ $coleccion['ver_todos_url'] }}" target="_self"
                        class="mr-4 text-brand-blue font-bold hover:text-brand-blue-hover transition-colors flex items-center gap-2 text-sm uppercase tracking-widest">
                        {{ $coleccion['ver_todos_texto'] }} <i data-lucide="arrow-right" class="w-4 h-4"></i>
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

                @forelse ($productosDestacados as $producto)
                    <div class="product-item flex-none w-[320px] md:w-[450px] aspect-square group cursor-pointer"
                        onclick="openDetail('{{ $producto->slug }}', '{{ e($producto->nombre) }}', '{{ e($producto->descripcion) }}', '{{ $producto->imagen_url }}', '{{ e($producto->categorias->first()?->nombre ?? $producto->material) }}')">
                        <div
                            class="relative w-full h-full rounded-[40px] bg-white p-8 md:p-12 flex flex-col justify-between transition-all duration-700 md:group-hover:shadow-2xl border border-gray-50 overflow-hidden snap-center md:snap-align-none">
                            <div class="z-10 text-left">
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-1">
                                    {{ $producto->categorias->first()?->nombre ?? $producto->material }}</p>
                                <h4 class="text-2xl md:text-3xl font-bold text-brand-ink">{{ $producto->nombre }}</h4>
                                @if ($producto->colores->isNotEmpty())
                                    <div class="flex gap-2 mt-3">
                                        @foreach ($producto->colores->take(4) as $color)
                                            @if ($color->hex)
                                                <div class="w-4 h-4 rounded-full ring-1 ring-gray-200"
                                                    style="background-color: {{ $color->hex }}"></div>
                                            @elseif ($color->icono)
                                                <img src="{{ Storage::url($color->icono) }}"
                                                    alt="{{ $color->nombre }}"
                                                    class="w-4 h-4 rounded-full ring-1 ring-gray-200 object-cover">
                                            @else
                                                <div class="w-4 h-4 rounded-full bg-gray-100 ring-1 ring-gray-200">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 w-full flex items-center justify-center relative">
                                @if ($producto->imagen_url)
                                    <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}"
                                        class="w-full h-auto max-h-[160px] md:max-h-[240px] object-contain mix-blend-multiply transition-transform duration-700 md:group-hover:scale-110">
                                @endif
                            </div>
                            <div class="w-full h-12 flex items-center justify-center">
                                <div class="flex md:hidden w-full justify-between items-center">
                                    <span class="text-brand-blue font-bold text-sm">Ver detalles</span>
                                    <div
                                        class="w-10 h-10 rounded-full bg-brand-blue flex items-center justify-center text-white">
                                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                                    </div>
                                </div>
                                <div
                                    class="hidden md:flex w-full justify-center opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                                    <div
                                        class="bg-blue-600 text-white px-10 py-3 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-blue-500/20">
                                        Ver detalles</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex-none w-full text-center py-20 text-gray-400">
                        <p class="text-lg">Próximamente productos destacados.</p>
                    </div>
                @endforelse

                <!-- Spacer para fin de scroll -->
                <div class="flex-none w-[100px] md:w-[200px]"></div>
            </div>
        </div>
    </section>
@endif

@if ($secciones->has('soluciones_medicas'))
    @php $soluciones = $secciones['soluciones_medicas']->contenido; @endphp
    <!-- --- SOLUCIONES MÉDICAS (4 COLUMNS) --- -->
    <section class="py-32 bg-white px-6">
        <div class="max-w-[1400px] mx-auto mb-16 px-4">
            <div class="reveal reveal-fade-in">
                <h3 class="text-4xl md:text-5xl font-bold text-brand-ink tracking-tight">{{ $soluciones['titulo'] }}
                </h3>
                <p class="text-gray-500 mt-2 text-lg">{{ $soluciones['subtitulo'] }}</p>
            </div>
        </div>
        <div class="max-w-[1400px] mx-auto grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($soluciones['items'] as $i => $item)
                <a href="{{ $item['url'] }}"
                    class="aspect-square group relative overflow-hidden rounded-[40px] bg-brand-surface reveal reveal-fade-in"
                    @if ($i > 0) style="transition-delay: {{ $i * 100 }}ms;" @endif>
                    <img src="{{ $item['imagen'] }}" alt="{{ $item['titulo'] }}"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                    <div
                        class="absolute inset-0 md:inset-x-0 md:inset-y-auto md:bottom-0 p-10 z-10 bg-gradient-to-t from-blue-950/90 via-blue-900/40 to-transparent flex flex-col items-center justify-center md:items-start md:justify-end w-full h-full md:h-auto">
                        <p class="hidden md:block text-[10px] font-bold text-white/70 uppercase tracking-widest mb-1">
                            {{ $item['etiqueta'] }}</p>
                        <h4 class="text-3xl font-bold text-white mb-6 text-center md:text-left">{{ $item['titulo'] }}
                        </h4>
                        <div
                            class="bg-blue-600 text-white px-6 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500 shadow-lg">
                            Ver productos</div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endif

@if ($secciones->has('eco_friendly'))
    @php $eco = $secciones['eco_friendly']->contenido; @endphp
    <!-- --- ECO-FRIENDLY SECTION --- -->
    <section class="py-32 bg-green-50/30 px-6 overflow-hidden">
        <div class="max-w-[1200px] mx-auto">
            <div class="flex flex-col md:flex-row items-center gap-16">
                <div class="md:w-1/2 reveal reveal-fade-in">
                    <div class="flex items-center gap-4 mb-8">
                        <img src="{{ $eco['icono'] }}" alt="Eco Icon" class="w-16 h-16 object-contain">
                        <span
                            class="text-xs font-bold uppercase tracking-[0.2em] text-green-700">{{ $eco['badge'] }}</span>
                    </div>
                    <h3 class="text-4xl md:text-6xl font-black text-green-900 mb-8 leading-tight tracking-tighter">
                        {!! nl2br(e($eco['titulo'])) !!}
                    </h3>
                    <p class="text-green-800/80 text-lg md:text-xl font-medium leading-relaxed mb-8">
                        {{ $eco['parrafo_principal'] }}
                    </p>
                    <p class="text-green-800/60 text-base md:text-lg leading-relaxed">
                        {{ $eco['parrafo_secundario'] }}
                    </p>
                </div>
                <div class="md:w-1/2 flex justify-center mt-10 md:mt-0 reveal reveal-scale-in">
                    <div class="relative">
                        <div
                            class="absolute inset-0 bg-green-200/50 rounded-full blur-3xl transform scale-150 animate-pulse">
                        </div>
                        <img src="{{ $eco['imagen'] }}" alt="Eco Guante"
                            class="relative z-10 w-full max-w-[400px] drop-shadow-2xl mix-blend-multiply">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

@if ($secciones->has('youtube_video'))
    @php $ytVideo = $secciones['youtube_video']->contenido; @endphp
    <!-- --- YOUTUBE CINEMATIC SECTION --- -->
    <section class="w-full h-screen bg-black overflow-hidden relative">
        <div class="absolute inset-0 w-full h-full pointer-events-none">
            <iframe class="w-full h-full scale-[1.3] origin-center"
                src="https://www.youtube.com/embed/{{ $ytVideo['video_id'] }}?autoplay=1&mute=1&loop=1&playlist={{ $ytVideo['video_id'] }}&controls=0&showinfo=0&rel=0&modestbranding=1&iv_load_policy=3&disablekb=1"
                frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
            </iframe>
        </div>
    </section>
@endif

    <!-- --- REDES SOCIALES --- -->
    @if ($footer->has('redes_sociales'))
    @php $redes = $footer->get('redes_sociales')->contenido; @endphp
    <section class="bg-white pt-32 overflow-hidden">
      <div class="max-w-[1200px] mx-auto px-6 mb-32">
        <div class="flex flex-col md:flex-row justify-between items-center gap-12">
          <div class="reveal reveal-fade-in">
            <img src="{{ $redes['logo'] }}" alt="Ambiderm Logo" class="h-12 md:h-16">
          </div>
          <div class="text-center md:text-right reveal reveal-fade-in">
            <h4 class="text-2xl md:text-4xl font-black tracking-tighter text-brand-ink mb-6">
              {!! nl2br(e($redes['titulo'])) !!}
            </h4>
            <div class="flex justify-center md:justify-end gap-6">
              <a href="{{ $redes['instagram_url'] }}" target="_blank"
                class="w-14 h-14 rounded-full bg-[#fbfbfd] border border-gray-100 flex items-center justify-center hover:scale-110 hover:shadow-xl transition-all">
                <img src="{{ $redes['instagram_icono'] }}" alt="Instagram" class="w-6 h-6">
              </a>
              <a href="{{ $redes['facebook_url'] }}" target="_blank"
                class="w-14 h-14 rounded-full bg-[#fbfbfd] border border-gray-100 flex items-center justify-center hover:scale-110 hover:shadow-xl transition-all">
                <img src="{{ $redes['facebook_icono'] }}" alt="Facebook" class="w-6 h-6">
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif

    <!-- --- SUCURSALES & MAPA --- -->
    @if ($footer->has('sucursales'))
    @php
        $sucursales = $footer->get('sucursales')->contenido;
        $contacto   = $footer->get('contacto')?->contenido ?? [];
    @endphp
    <section class="bg-[#fbfbfd] py-32 border-t border-gray-100">
      <div class="max-w-[1200px] mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
          <div class="reveal reveal-fade-in">
            <h3 class="text-3xl md:text-5xl font-black tracking-tighter text-brand-ink mb-12">{!! nl2br(e($sucursales['titulo'])) !!}</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
              @foreach ($sucursales['items'] as $i => $sucursal)
                <div class="group cursor-pointer sucursal-btn {{ $i === 0 ? 'active' : '' }}" data-map="{{ $sucursal['mapa_key'] }}" data-url="{{ $sucursal['mapa_url'] }}" data-img="{{ $sucursal['mapa_imagen'] }}">
                  <p class="text-xs font-bold {{ $i === 0 ? 'text-brand-blue' : 'text-gray-400' }} uppercase tracking-widest mb-3">{{ $sucursal['region'] }}</p>
                  <h5 class="text-xl font-bold text-brand-ink mb-2 group-hover:text-brand-blue transition-colors">{{ $sucursal['nombre'] }}</h5>
                  <p class="text-gray-500 text-sm leading-relaxed">
                    {!! nl2br(e($sucursal['direccion'])) !!}<br>
                    <a href="tel:{{ preg_replace('/[^+0-9]/', '', $sucursal['telefono']) }}" class="hover:text-brand-blue transition-colors font-semibold">{{ $sucursal['telefono'] }}</a>
                  </p>
                </div>
              @endforeach
            </div>
            @if (!empty($contacto['email']))
            <div class="mt-16 reveal reveal-fade-in">
              <a href="mailto:{{ $contacto['email'] }}" class="inline-flex items-center gap-4 text-brand-ink font-bold text-2xl hover:text-brand-blue transition-all">
                {{ $contacto['email'] }}
                <i data-lucide="arrow-up-right" class="w-6 h-6"></i>
              </a>
            </div>
            @endif
          </div>
          <!-- Mapa Interactivo -->
          <div class="reveal reveal-scale-in relative group">
            <div class="absolute inset-0 bg-blue-100 blur-[100px] opacity-20 -z-10 transform scale-125"></div>
            <a id="main-map-link" href="{{ $sucursales['items'][0]['mapa_url'] }}" target="_blank"
              class="block relative rounded-[40px] overflow-hidden shadow-2xl border border-white">
              <img id="main-map-img" src="{{ $sucursales['items'][0]['mapa_imagen'] }}" alt="Mapa Ubicación"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
              <div class="absolute inset-x-0 bottom-0 p-8 bg-gradient-to-t from-black/50 to-transparent">
                <span class="text-white font-bold bg-blue-600/80 px-4 py-2 rounded-full text-xs">ABRIR EN GOOGLE MAPS</span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>
    @endif

    <!-- --- CONTACT FOOTER --- -->
    @include('partials.footer')

    <!-- --- PRODUCT DETAIL OVERLAY (MODAL) --- -->
    <div id="product-detail"
        class="fixed inset-0 z-[110] invisible opacity-0 transition-all duration-500 flex items-center justify-center p-4 md:p-10">
        <div class="absolute inset-0 bg-white/80 backdrop-blur-3xl" onclick="closeDetail()"></div>
        <div
            class="relative bg-white w-full max-w-[1100px] h-full max-h-[800px] rounded-[40px] shadow-[0_40px_100px_rgba(0,0,0,0.1)] border border-gray-100 overflow-hidden flex flex-col md:flex-row transform scale-95 transition-all duration-500">
            <button onclick="closeDetail()"
                class="absolute top-8 right-8 z-50 w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
            <div class="md:w-1/2 bg-[#fbfbfd] p-12 flex items-center justify-center relative group">
                <img id="modal-img" src="" alt="Producto"
                    class="w-full h-auto object-contain mix-blend-multiply drop-shadow-2xl transition-transform duration-1000 group-hover:scale-105">
            </div>
            <div class="md:w-1/2 p-12 md:p-20 flex flex-col justify-center text-left">
                <span id="modal-tag"
                    class="text-[#f56300] font-bold text-xs uppercase tracking-[0.2em] mb-4">Colección Pro</span>
                <h2 id="modal-title"
                    class="text-4xl md:text-5xl font-bold text-brand-ink tracking-tight mb-6 text-left">Nombre del
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
                            class="flex-1 bg-brand-blue text-white px-10 py-4 rounded-full font-semibold hover:bg-brand-blue-hover transition-all hover:scale-[1.02] active:scale-95 shadow-lg shadow-blue-500/20 text-center">
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
                shelf.scrollBy({
                    left: -450,
                    behavior: 'smooth'
                });
            });

            btnRight.addEventListener('click', () => {
                shelf.scrollBy({
                    left: 450,
                    behavior: 'smooth'
                });
            });

            // --- PRODUCT DETAIL MODAL ---
            function openDetail(id, title, desc, img, tag) {
                const modal = document.getElementById('product-detail');
                const inner = modal.querySelector('div:nth-child(2)');

                document.getElementById('modal-title').innerText = title;
                document.getElementById('modal-desc').innerText = desc;
                document.getElementById('modal-img').src = img;
                if (tag) document.getElementById('modal-tag').innerText = tag;

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
                    const mapImg = btn.getAttribute('data-img');
                    mainMapImg.src = mapImg;
                    mainMapLink.href = mapUrl;
                });
            });
        </script>
    </x-slot:scripts>

</x-layouts.public>
