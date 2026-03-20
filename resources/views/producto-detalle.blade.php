<x-layouts.public title="{{ $producto->nombre }} - Ambiderm">

    <!-- --- BREADCRUMB --- -->
    <div class="pt-24 pb-4 px-6 md:px-12 bg-white">
        <div class="max-w-[1240px] mx-auto flex items-center text-xs text-gray-400 uppercase tracking-widest gap-2">
            <a href="{{ route('home') }}" class="hover:text-brand-blue transition-colors">Inicio</a>
            <span class="text-gray-300">/</span>
            <a href="{{ route('productos') }}" class="hover:text-brand-blue transition-colors">Productos</a>
            <span class="text-gray-300">/</span>
            <span class="text-brand-blue font-bold">{{ $producto->nombre }}</span>
        </div>
    </div>

    <!-- --- PRODUCT DETAIL SECTION --- -->
    <section class="pb-24 px-6 md:px-12 bg-white">
        <div class="max-w-[1240px] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24">

            <!-- Column LEFT: Image Gallery -->
            <div class="relative">
                <div class="relative bg-brand-surface rounded-[40px] aspect-square flex items-center justify-center p-8 lg:p-16 overflow-hidden reveal reveal-scale-in">
                    <div class="absolute inset-0 bg-blue-100/50 blur-[80px] rounded-full scale-75 opacity-0 active-color-bg transition-opacity duration-500"></div>
                    @if ($producto->imagen)
                        <img id="main-product-image"
                            src="{{ Storage::url($producto->imagen) }}"
                            alt="{{ $producto->nombre }}"
                            class="w-full h-full object-contain mix-blend-multiply z-10 transition-transform duration-500 hover:scale-105">
                    @else
                        <div class="flex items-center justify-center w-full h-full z-10">
                            <i data-lucide="package" class="w-24 h-24 text-gray-300"></i>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Column RIGHT: Product Info -->
            <div class="flex flex-col justify-center reveal reveal-fade-in" style="transition-delay: 200ms;">
                {{-- Etiquetas --}}
                @if (!empty($producto->etiquetas))
                    <div class="mb-2 flex flex-wrap gap-2">
                        @foreach ($producto->etiquetas as $etiqueta)
                            <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-brand-blue text-[10px] font-bold uppercase tracking-widest border border-blue-100">{{ $etiqueta }}</span>
                        @endforeach
                    </div>
                @endif

                <h1 class="text-4xl md:text-5xl font-black text-brand-ink mb-2 tracking-tight">{{ $producto->nombre }}</h1>
                @if ($producto->subtitulo)
                    <p class="text-xl text-gray-500 font-medium mb-6">{{ $producto->subtitulo }}</p>
                @endif

                @if ($producto->descripcion)
                    <p class="text-gray-400 leading-6 mb-8 text-sm text-justify">{{ $producto->descripcion }}</p>
                @endif

                <!-- Selectors -->
                @if ($producto->colores->count() || $producto->tamanos->count())
                    <div class="space-y-8 mb-10 border-t border-b border-gray-100 py-8">

                        {{-- Color Selector --}}
                        @if ($producto->colores->count())
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Colores:</p>
                                {{-- <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Color Seleccionado:
                                    <span id="color-name" class="text-brand-ink">{{ $producto->colores->first()->nombre }}</span>
                                </p> --}}
                                <div class="flex flex-wrap gap-4">
                                    @foreach ($producto->colores as $i => $color)
                                        @php
                                            $pivotImg = $color->pivot->imagen ? Storage::url($color->pivot->imagen) : null;
                                        @endphp
                                        @if ($color->icono)
                                            <div class="flex flex-col items-center gap-1">
                                                <button
                                                    class="w-10 h-10 rounded-full overflow-hidden color-option {{ $i === 0 ? 'active ring-2 ring-offset-2 ring-transparent' : 'opacity-50 hover:opacity-100' }}"
                                                    data-color="{{ $color->nombre }}"
                                                    @if ($pivotImg) data-img="{{ $pivotImg }}" @endif
                                                    aria-label="{{ $color->nombre }}">
                                                    <img src="{{ Storage::url($color->icono) }}" alt="{{ $color->nombre }}" class="w-full h-full object-cover">
                                                </button>
                                                <span class="text-xs text-gray-500 text-center leading-tight">{{ $color->nombre }}</span>
                                            </div>
                                        @else
                                            <div class="flex flex-col items-center gap-1">
                                                <button
                                                    class="w-10 h-10 rounded-full color-option {{ $i === 0 ? 'active ring-2 ring-offset-2 ring-transparent' : 'opacity-50 hover:opacity-100' }}"
                                                    style="background-color: {{ $color->hex ?? '#ccc' }}"
                                                    data-color="{{ $color->nombre }}"
                                                    @if ($pivotImg) data-img="{{ $pivotImg }}" @endif
                                                    aria-label="{{ $color->nombre }}">
                                                    </button>
                                                    <span class="text-xs text-gray-500 text-center leading-tight">{{ $color->nombre }}</span>
                                                </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Size Selector --}}
                        @if ($producto->tamanos->count())
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Tamaños:</p>
                                <div class="flex flex-wrap gap-3">
                                    @foreach ($producto->tamanos as $j => $tamano)
                                        @php $abbr = $tamano->abreviatura ?? $tamano->nombre; @endphp
                                        <div class="flex flex-col items-center gap-1">
                                            <button class="size-option {{ (!$tamano->icono && strlen($abbr) > 4) ? 'w-24' : 'w-12' }} h-12 rounded-xl border font-bold flex items-center justify-center border-gray-200 text-gray-500 hover:bg-gray-50 {{ $j === 0 ? 'active' : '' }}">
                                                @if ($tamano->icono)
                                                    <img src="{{ Storage::url($tamano->icono) }}" alt="{{ $tamano->nombre }}" class="w-6 h-6 object-contain">
                                                @else
                                                    <div class="flex text-xs items-center justify-center px-2">{{ $abbr }}</div>
                                                @endif
                                            </button>
                                            {{-- <span class="text-xs text-gray-500 text-center leading-tight">{{ $tamano->nombre }}</span> --}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                {{-- Feature List (Características) --}}
                @if (!empty($producto->caracteristicas))
                    <ul class="space-y-1 mb-10">
                        @foreach ($producto->caracteristicas as $caracteristica)
                            <li class="flex items-center text-gray-600 font-medium">
                                <i data-lucide="check-circle-2" class="w-5 h-5 text-brand-blue mr-3"></i> {{ $caracteristica }}
                            </li>
                        @endforeach
                    </ul>
                @endif

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    @if ($producto->url_tienda)
                        <a href="{{ $producto->url_tienda }}"
                            target="_blank"
                            class="flex-1 bg-brand-blue text-white font-bold py-4 rounded-full text-center hover:bg-brand-blue-hover hover:shadow-lg hover:shadow-blue-500/30 transition-all transform active:scale-[0.98] flex items-center justify-center gap-2">
                            <i data-lucide="shopping-bag" class="w-5 h-5"></i> COMPRAR EN LÍNEA
                        </a>
                    @endif
                    @if ($producto->url_ficha_tecnica)
                        <a href="{{ $producto->url_ficha_tecnica }}" target="_blank"
                            class="flex-1 bg-gray-50 text-brand-ink font-bold py-4 rounded-full text-center border border-gray-200 hover:bg-gray-100 transition-all flex items-center justify-center gap-2">
                            <i data-lucide="file-text" class="w-5 h-5"></i> FICHA TÉCNICA
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- --- TECHNICAL DETAILS ACCORDION --- -->
    @if ($producto->presentacion || $producto->certificaciones)
        <section class="py-12 bg-[#fbfbfd] border-t border-gray-100">
            <div class="max-w-[800px] mx-auto px-6">

                @if ($producto->presentacion)
                    <div class="mb-4">
                        <button class="accordion-btn w-full bg-white p-6 rounded-2xl shadow-sm flex items-center justify-between hover:bg-gray-50 transition-colors">
                            <span class="font-bold text-lg text-brand-ink">Información de Presentación</span>
                            <i data-lucide="chevron-down" class="icon-chevron w-5 h-5 text-gray-400 transition-transform"></i>
                        </button>
                        <div class="accordion-content">
                            <div class="p-6 text-gray-600 leading-relaxed">
                                {!! nl2br(e($producto->presentacion)) !!}
                            </div>
                        </div>
                    </div>
                @endif

                @if ($producto->certificaciones)
                    <div class="mb-4">
                        <button class="accordion-btn w-full bg-white p-6 rounded-2xl shadow-sm flex items-center justify-between hover:bg-gray-50 transition-colors">
                            <span class="font-bold text-lg text-brand-ink">Normas y Certificaciones</span>
                            <i data-lucide="chevron-down" class="icon-chevron w-5 h-5 text-gray-400 transition-transform"></i>
                        </button>
                        <div class="accordion-content">
                            <div class="p-6 text-gray-600 leading-relaxed">
                                {!! nl2br(e($producto->certificaciones)) !!}
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </section>
    @endif

    <!-- --- RELATED PRODUCTS --- -->
    @if ($relacionados->count())
        <section class="py-24 px-6 bg-white">
            <div class="max-w-[1240px] mx-auto">
                <h2 class="text-2xl md:text-3xl font-black text-brand-ink mb-12 text-center">TAMBIÉN TE PUEDE INTERESAR</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach ($relacionados as $rel)
                        <a href="{{ route('producto.detalle', $rel->slug) }}"
                            class="group block relative bg-brand-surface rounded-[30px] p-8 transition-transform hover:-translate-y-2">
                            <div class="aspect-square flex items-center justify-center mb-6">
                                @if ($rel->imagen)
                                    <img src="{{ Storage::url($rel->imagen) }}"
                                        alt="{{ $rel->nombre }}"
                                        class="w-full h-full object-contain mix-blend-multiply transition-transform group-hover:scale-105">
                                @else
                                    <i data-lucide="package" class="w-16 h-16 text-gray-300"></i>
                                @endif
                            </div>
                            <div class="text-center">
                                <h4 class="font-bold text-lg text-brand-ink">{{ $rel->nombre }}</h4>
                                <p class="text-sm text-gray-500">{{ $rel->subtitulo ?? $rel->material }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- --- FOOTER --- -->
    <footer class="bg-white pt-10 overflow-hidden" id="contacto">
        <div class="max-w-[1200px] mx-auto px-6 mb-32">
            <div class="flex flex-col md:flex-row justify-between items-center gap-12">
                <div class="reveal reveal-fade-in">
                    <img src="https://ambiderm.com.mx/img/new/logo-ambiderm-azul.svg" alt="Ambiderm Logo"
                        class="h-12 md:h-16">
                </div>
                <div class="text-center md:text-right reveal reveal-fade-in">
                    <h4 class="text-2xl md:text-4xl font-black tracking-tighter text-brand-ink mb-6">
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

        <div class="py-12 px-6 border-t border-gray-100 bg-[#fbfbfd]">
            <div class="max-w-[1200px] mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="text-center md:text-left">
                    <p class="text-[10px] font-bold text-brand-ink tracking-widest mb-2 uppercase">COPYRIGHT © 2024
                        AMBIDERM S.A. DE C.V.</p>
                </div>
                <div class="flex flex-wrap justify-center gap-x-8 gap-y-2">
                    <a href="{{ route('terminos') }}" class="text-[10px] font-bold text-gray-400 hover:text-brand-blue transition-colors uppercase tracking-widest">Términos</a>
                    <a href="{{ route('privacidad') }}" class="text-[10px] font-bold text-gray-400 hover:text-brand-blue transition-colors uppercase tracking-widest">Privacidad</a>
                    <a href="{{ route('cookies') }}" class="text-[10px] font-bold text-gray-400 hover:text-brand-blue transition-colors uppercase tracking-widest">Cookies</a>
                    <a href="{{ route('bolsa-de-trabajo') }}" class="text-[10px] font-bold text-gray-400 hover:text-brand-blue transition-colors uppercase tracking-widest">Bolsa de Trabajo</a>
                </div>
            </div>
        </div>
    </footer>

    <x-slot:scripts>
        <style>
            .color-option { transition: transform 0.2s; }
            .color-option:hover, .color-option.active { transform: scale(1.1); }
            .size-option { transition: all 0.2s; }
            .size-option:hover { border-color: #0071e3; color: #0071e3; }
            .size-option.active { background-color: #0071e3; color: white; border-color: #0071e3; }
            .accordion-content { transition: max-height 0.3s ease-out; max-height: 0; overflow: hidden; }
            .accordion-btn.active .icon-chevron { transform: rotate(180deg); }
        </style>
        <script>
            // COLOR SELECTOR
            const colorBtns       = document.querySelectorAll('.color-option');
            const colorNameDisplay = document.getElementById('color-name');
            const mainImage        = document.getElementById('main-product-image');

            colorBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    colorBtns.forEach(b => {
                        b.classList.remove('active', 'ring-2', 'ring-offset-2', 'ring-transparent');
                        b.classList.add('opacity-50');
                    });
                    btn.classList.add('active', 'ring-2', 'ring-offset-2', 'ring-transparent');
                    btn.classList.remove('opacity-50');
                    colorNameDisplay.textContent = btn.dataset.color;
                    if (btn.dataset.img) mainImage.src = btn.dataset.img;
                });
            });

            // SIZE SELECTOR
            const sizeBtns = document.querySelectorAll('.size-option');
            sizeBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    sizeBtns.forEach(b => {
                        b.classList.remove('active');
                        b.classList.add('text-gray-500', 'border-gray-200');
                    });
                    btn.classList.add('active');
                    btn.classList.remove('text-gray-500', 'border-gray-200');
                });
            });

            // ACCORDION
            document.querySelectorAll('.accordion-btn').forEach(acc => {
                acc.addEventListener('click', () => {
                    acc.classList.toggle('active');
                    const panel = acc.nextElementSibling;
                    panel.style.maxHeight = panel.style.maxHeight ? null : panel.scrollHeight + 'px';
                });
            });
        </script>
    </x-slot:scripts>

</x-layouts.public>
