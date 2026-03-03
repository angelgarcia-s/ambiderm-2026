<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name', 'Ambiderm') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,900" rel="stylesheet" />

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Lenis Smooth Scroll -->
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.33/dist/lenis.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-brand-ink bg-white selection:bg-blue-200 selection:text-blue-900 overflow-x-hidden">

    <!-- --- NAVIGATION --- -->
    @php
        $navBase = $navTransparent ?? false
            ? 'bg-transparent'
            : 'bg-white/80 backdrop-blur-xl border-b border-gray-100';

        $isHome      = request()->routeIs('home');
        $isNosotros  = request()->routeIs('nosotros');
        $isProductos = request()->routeIs('productos', 'producto.detalle');

        $linkBase   = 'transition-colors uppercase text-[12px] font-normal tracking-tight';
        $linkActive = 'text-brand-blue font-bold';
        $linkIdle   = 'text-gray-800 hover:text-brand-blue';
    @endphp

    <nav id="main-nav" class="fixed top-0 w-full z-50 transition-all duration-500 {{ $navBase }}">
        <div class="max-w-[1024px] mx-auto px-6 h-12 flex items-center justify-between">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="z-50 opacity-90 hover:opacity-100 transition-opacity">
                <img src="https://ambiderm.com.mx/img/new/logo-ambiderm-azul.svg" alt="Ambiderm Logo" class="h-8 w-auto">
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8 h-full {{ $linkBase }}">
                <a href="{{ route('home') }}" class="{{ $isHome ? $linkActive : $linkIdle }}">INICIO</a>
                <a href="{{ route('nosotros') }}" class="{{ $isNosotros ? $linkActive : $linkIdle }}">NOSOTROS</a>

                <!-- Dropdown Productos -->
                <div class="relative group h-full flex items-center">
                    <button class="{{ $isProductos ? $linkActive : $linkIdle }} flex items-center gap-1">
                        PRODUCTOS <i data-lucide="chevron-down" class="w-3 h-3 transition-transform group-hover:rotate-180"></i>
                    </button>
                    <div class="absolute top-[48px] left-1/2 -translate-x-1/2 w-48 bg-white/90 backdrop-blur-xl border border-gray-100 rounded-2xl shadow-2xl py-4 flex flex-col gap-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 -translate-y-2">
                        @foreach ($categoriasNav as $cat)
                            <a href="{{ route('productos', ['categoria' => $cat->slug]) }}" class="px-6 py-2 hover:bg-gray-50 hover:text-brand-blue transition-colors {{ request('categoria') === $cat->slug ? 'font-bold text-brand-blue' : '' }}">{{ mb_strtoupper($cat->nombre) }}</a>
                        @endforeach
                    </div>
                </div>

                <a href="https://shop.ambiderm.com.mx/" target="_blank" class="{{ $linkIdle }}">TIENDA EN LÍNEA</a>
                <a href="{{ route('home') }}#contacto" class="{{ $linkIdle }}">CONTACTO</a>
                <a href="https://www.ambiderm.com.mx/catalogo/catalogo.pdf" target="_blank" class="font-semibold text-brand-blue uppercase text-[12px] tracking-tight hover:text-brand-blue-hover transition-colors">CATÁLOGO</a>
            </div>

            <!-- Desktop Icons -->
            <div class="hidden md:flex items-center gap-6 text-gray-800">
                <a href="https://shop.ambiderm.com.mx/" class="hover:text-brand-blue transition-colors">
                    <i data-lucide="shopping-bag" class="w-4 h-4 stroke-[1.5]"></i>
                </a>
            </div>

            <!-- Hamburger -->
            <button id="menu-toggle" class="md:hidden z-50 text-gray-800 focus:outline-none">
                <i data-lucide="menu" id="menu-icon-open"></i>
                <i data-lucide="x" id="menu-icon-close" class="hidden"></i>
            </button>
        </div>

        <!-- Mobile Dropdown -->
        <div id="mobile-menu" class="fixed inset-0 w-full h-screen bg-white pt-24 px-10 flex flex-col gap-6 text-xl font-medium md:hidden overflow-y-auto">
            <a href="{{ route('home') }}" class="text-gray-900">Inicio</a>
            <a href="{{ route('nosotros') }}" class="text-gray-900">Nosotros</a>
            <div class="flex flex-col gap-4">
                <p class="text-[12px] font-bold text-gray-400 uppercase tracking-widest mt-4">Categorías</p>
                @foreach ($categoriasNav as $cat)
                    <a href="{{ route('productos', ['categoria' => $cat->slug]) }}" class="{{ request('categoria') === $cat->slug ? 'text-brand-blue font-bold' : 'text-gray-900' }} pl-4">{{ $cat->nombre }}</a>
                @endforeach
            </div>
            <div class="h-[1px] bg-gray-200 w-full my-4"></div>
            <a href="https://shop.ambiderm.com.mx/" class="text-gray-900">Tienda en Línea</a>
            <a href="{{ route('home') }}#contacto" class="text-gray-900">Contacto</a>
            <a href="https://www.ambiderm.com.mx/catalogo/catalogo.pdf" class="text-brand-blue flex items-center gap-2 mt-4 font-bold">
                Descargar Catálogo <i data-lucide="download" class="w-5 h-5"></i>
            </a>
        </div>
    </nav>

    <!-- ===== CONTENIDO DE LA PÁGINA ===== -->
    {{ $slot }}

    <!-- ===== SCRIPTS ESPECÍFICOS DE PÁGINA ===== -->
    {{ $scripts ?? '' }}

    <!-- --- CHATBOT FLOTANTE --- -->
    <div class="fixed bottom-8 right-8 z-[100] flex flex-col items-end gap-4">
        <!-- Ventana de Chat -->
        <div id="chat-window" class="w-[350px] bg-white rounded-[30px] border border-gray-100 shadow-[0_20px_50px_rgba(0,113,227,0.15)] overflow-hidden hidden opacity-0 translate-y-10 transition-all duration-500 transform origin-bottom-right">
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
                    <button class="w-full p-4 text-left border border-gray-100 rounded-xl hover:bg-blue-50 hover:border-blue-100 transition-all text-sm font-semibold text-gray-700 flex items-center justify-between group">
                        Quiero ser distribuidor
                        <i data-lucide="chevron-right" class="w-4 h-4 text-gray-300 group-hover:text-brand-blue transition-colors"></i>
                    </button>
                    <button class="w-full p-4 text-left border border-gray-100 rounded-xl hover:bg-blue-50 hover:border-blue-100 transition-all text-sm font-semibold text-gray-700 flex items-center justify-between group">
                        Comprar en línea
                        <i data-lucide="chevron-right" class="w-4 h-4 text-gray-300 group-hover:text-brand-blue transition-colors"></i>
                    </button>
                    <button class="w-full p-4 text-left border border-gray-100 rounded-xl hover:bg-blue-50 hover:border-blue-100 transition-all text-sm font-semibold text-gray-700 flex items-center justify-between group">
                        Contactar a un asesor
                        <i data-lucide="chevron-right" class="w-4 h-4 text-gray-300 group-hover:text-brand-blue transition-colors"></i>
                    </button>
                </div>
            </div>

            <!-- Footer del Chat -->
            <div class="p-4 bg-gray-50 text-center">
                <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">Respuesta en menos de 2 min</p>
            </div>
        </div>

        <!-- Botón Flotante -->
        <button id="chat-toggle" class="w-16 h-16 rounded-full bg-gradient-to-r from-blue-600 via-blue-400 to-cyan-400 text-white flex items-center justify-center shadow-2xl hover:scale-110 active:scale-95 transition-all shadow-blue-500/40 relative group focus:outline-none">
            <i id="chat-icon-open" data-lucide="message-circle" class="w-8 h-8 group-hover:rotate-12 transition-transform"></i>
            <i id="chat-icon-close" data-lucide="x" class="w-8 h-8 hidden group-hover:scale-110 transition-transform"></i>
            <span class="absolute top-0 right-0 w-5 h-5 bg-red-500 border-2 border-white rounded-full"></span>
        </button>
    </div>

    <script>
        // --- LUCIDE ICONS INIT ---
        lucide.createIcons();

        // --- NAVIGATION STATE (solo en nav transparente) ---
        const mainNav = document.getElementById('main-nav');
        if (mainNav.classList.contains('bg-transparent')) {
            window.addEventListener('scroll', () => {
                const mobileMenuOpen = document.getElementById('mobile-menu').classList.contains('active');
                if (window.scrollY > 20) {
                    mainNav.classList.add('bg-white/70', 'backdrop-blur-xl', 'border-b', 'border-gray-200/50');
                    mainNav.classList.remove('bg-transparent');
                } else if (!mobileMenuOpen) {
                    mainNav.classList.remove('bg-white/70', 'backdrop-blur-xl', 'border-b', 'border-gray-200/50');
                    mainNav.classList.add('bg-transparent');
                }
            });
        }

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

        // --- LENIS SMOOTH SCROLL ---
        window.lenis = new Lenis({
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
            window.lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);

        // --- INTERSECTION OBSERVER — REVEAL ANIMATIONS ---
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

        // --- CHATBOT TOGGLE ---
        const chatToggle = document.getElementById('chat-toggle');
        const chatWindow = document.getElementById('chat-window');
        const chatIconOpen = document.getElementById('chat-icon-open');
        const chatIconClose = document.getElementById('chat-icon-close');

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
    </script>

</body>
</html>
