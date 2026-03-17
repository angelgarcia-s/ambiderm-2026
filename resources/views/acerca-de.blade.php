<x-layouts.public title="Acerca de Ambiderm - Más de 30 años protegíendote">

    @php
        $hero     = $secciones->get('hero')?->contenido ?? [];
        $historia = $secciones->get('historia')?->contenido ?? [];
        $mision   = $secciones->get('mision')?->contenido ?? [];
        $vision   = $secciones->get('vision')?->contenido ?? [];
        $valores  = $secciones->get('valores')?->contenido ?? [];
    @endphp

    <!-- --- HERO SECTION --- -->
    @if ($secciones->has('hero'))
    <header class="relative pt-40 pb-20 md:pt-64 md:pb-32 px-6 text-center bg-brand-surface overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-blue-100 rounded-full blur-[120px] opacity-60 -z-10 pointer-events-none"></div>

        <div class="max-w-[1000px] mx-auto relative z-10">
            <div class="reveal reveal-fade-in">
                <p class="text-blue-600 font-bold uppercase tracking-widest text-xs mb-6">{{ $hero['badge'] }}</p>
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-black tracking-tighter mb-8 text-brand-ink">
                    {!! nl2br(e($hero['titulo'])) !!}
                </h1>
            </div>

            <div class="reveal reveal-fade-in" style="transition-delay: 200ms;">
                <p class="text-xl md:text-2xl text-gray-500 font-medium max-w-3xl mx-auto leading-relaxed">
                    {{ $hero['subtitulo'] }}
                </p>
            </div>
        </div>
    </header>
    @endif

    <!-- --- HISTORIA SECTION --- -->
    @if ($secciones->has('historia'))
    <section class="py-24 md:py-32 px-6 bg-white">
        <div class="max-w-[1200px] mx-auto">
            <div class="flex flex-col md:flex-row items-center gap-16 lg:gap-24">
                <!-- Image Side -->
                <div class="md:w-1/2 reveal reveal-scale-in">
                    <div class="relative rounded-[40px] overflow-hidden shadow-2xl rotate-1 hover:rotate-0 transition-all duration-700">
                        <img src="{{ $historia['imagen'] }}" alt="Historia Ambiderm"
                            class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-1000">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                        <div class="absolute bottom-8 left-8 text-white">
                            <p class="text-4xl font-black tracking-tighter">{{ $historia['anio'] }}</p>
                            <p class="text-sm font-medium opacity-90">{{ $historia['anio_etiqueta'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Content Side -->
                <div class="md:w-1/2 reveal reveal-fade-in">
                    <h2 class="text-4xl md:text-5xl font-black text-brand-ink mb-8 tracking-tight">{!! nl2br(e($historia['titulo'])) !!}</h2>
                    <div class="space-y-6 text-lg text-gray-500 leading-relaxed text-justify">
                        {!! $historia['parrafos'] !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- --- MISION & VISION (Cards) --- -->
    @if ($secciones->has('mision') || $secciones->has('vision'))
    <section class="py-24 bg-brand-surface px-6">
        <div class="max-w-[1200px] mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Misión -->                @if ($secciones->has('mision'))                <div class="bg-white p-12 rounded-[40px] shadow-[0_20px_50px_rgba(0,0,0,0.05)] reveal reveal-fade-in hover:-translate-y-2 transition-transform duration-500">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mb-8 text-blue-600">
                        <i data-lucide="{{ $mision['icono'] }}" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-brand-ink mb-6">{{ $mision['titulo'] }}</h3>
                    <p class="text-gray-500 text-lg leading-relaxed">
                        {!! $mision['texto'] !!}
                    </p>
                </div>
                @endif

                <!-- Visión -->
                @if ($secciones->has('vision'))
                <div class="bg-white p-12 rounded-[40px] shadow-[0_20px_50px_rgba(0,0,0,0.05)] reveal reveal-fade-in hover:-translate-y-2 transition-transform duration-500"
                    style="transition-delay: 100ms;">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mb-8 text-blue-600">
                        <i data-lucide="{{ $vision['icono'] }}" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-brand-ink mb-6">{{ $vision['titulo'] }}</h3>
                    <p class="text-gray-500 text-lg leading-relaxed">
                        {!! $vision['texto'] !!}
                    </p>
                </div>
                @endif

            </div>
        </div>
    </section>
    @endif

    <!-- --- VALORES & ECO (Green Section) --- -->
    @if ($secciones->has('valores'))
    <section class="py-32 bg-green-50/30 px-6 overflow-hidden">
        <div class="max-w-[1200px] mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-20 reveal reveal-fade-in">
                <span class="text-green-600 font-bold tracking-widest uppercase text-xs">{{ $valores['badge'] }}</span>
                <h2 class="text-4xl md:text-5xl font-black text-brand-ink mt-4 mb-6">{{ $valores['titulo'] }}</h2>
                <p class="text-gray-500 text-xl">{{ $valores['subtitulo'] }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($valores['items'] as $i => $valor)
                    <div class="reveal reveal-fade-in p-8 text-center" @if ($i > 0) style="transition-delay: {{ $i * 100 }}ms;" @endif>
                        <div class="w-20 h-20 mx-auto {{ $valor['color_bg'] }} rounded-full flex items-center justify-center {{ $valor['color_text'] }} mb-6">
                            <i data-lucide="{{ $valor['icono'] }}" class="w-10 h-10"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-4">{{ $valor['titulo'] }}</h4>
                        <p class="text-gray-500">{{ $valor['texto'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- --- LOCATIONS & CONTACT FOOTER --- -->
    @include('partials.footer')

    <x-slot:scripts>
        <script>
            // LOCATION MAP — sucursal-btn click handler
            const sucursalBtns = document.querySelectorAll('.sucursal-btn');
            const mainMapImg   = document.getElementById('main-map-img');
            const mainMapLink  = document.getElementById('main-map-link');

            sucursalBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    sucursalBtns.forEach(b => {
                        const label = b.querySelector('p:first-child');
                        if (label) label.classList.replace('text-brand-blue', 'text-gray-400');
                    });
                    const label = btn.querySelector('p:first-child');
                    if (label) label.classList.replace('text-gray-400', 'text-brand-blue');

                    mainMapImg.src  = btn.dataset.img;
                    mainMapLink.href = btn.dataset.url;
                });
            });
        </script>
    </x-slot:scripts>

</x-layouts.public>
