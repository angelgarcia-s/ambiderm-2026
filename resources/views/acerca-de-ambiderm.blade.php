<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de Ambiderm - Más de 30 años protegíendote</title>
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
                <a href="{{ route('nosotros') }}"
                    class="text-blue-600 font-bold transition-colors uppercase">NOSOTROS</a>

                <!-- Dropdown Productos -->
                <div class="relative group h-full flex items-center">
                    <button class="hover:text-blue-600 transition-colors flex items-center gap-1 uppercase">
                        PRODUCTOS <i data-lucide="chevron-down"
                            class="w-3 h-3 transition-transform group-hover:rotate-180"></i>
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
                <a href="{{ route('home') }}#contacto"
                    class="hover:text-blue-600 transition-colors uppercase">CONTACTO</a>
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
            <a href="{{ route('nosotros') }}" class="text-blue-600 font-bold mobile-link">Nosotros</a>
            <div class="flex flex-col gap-4">
                <p class="text-[12px] font-bold text-gray-400 uppercase tracking-widest mt-4">Categorías</p>
                <a href="{{ route('productos') }}" class="text-gray-900 mobile-link pl-4">Guantes</a>
                <a href="https://ambiderm.com.mx/categoria/dental" class="text-gray-900 mobile-link pl-4">Dental</a>
                <a href="https://ambiderm.com.mx/categoria/insumos-medicos"
                    class="text-gray-900 mobile-link pl-4">Insumos</a>
                <a href="https://ambiderm.com.mx/categoria/ropa-medica" class="text-gray-900 mobile-link pl-4">Ropa</a>
            </div>
            <div class="h-[1px] bg-gray-200 w-full my-4"></div>
            <a href="https://shop.ambiderm.com.mx/" class="text-gray-900 mobile-link">Tienda en Línea</a>
            <a href="{{ route('home') }}#contacto" class="text-gray-900 mobile-link">Contacto</a>
        </div>
    </nav>

    <!-- --- HERO SECTION --- -->
    <header class="relative pt-40 pb-20 md:pt-64 md:pb-32 px-6 text-center bg-[#f5f5f7] overflow-hidden">
        <!-- Background blurred blob -->
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-blue-100 rounded-full blur-[120px] opacity-60 -z-10 pointer-events-none">
        </div>

        <div class="max-w-[1000px] mx-auto relative z-10">
            <div class="reveal reveal-fade-in">
                <p class="text-blue-600 font-bold uppercase tracking-widest text-xs mb-6">Nuestra Esencia</p>
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-black tracking-tighter mb-8 text-[#1d1d1f]">
                    Más de 30 años <br>
                    <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-blue-400 to-cyan-400">protegiéndote.</span>
                </h1>
            </div>

            <div class="reveal reveal-fade-in" style="transition-delay: 200ms;">
                <p class="text-xl md:text-2xl text-gray-500 font-medium max-w-3xl mx-auto leading-relaxed">
                    Innovación mexicana al servicio de la salud. Desde 1988, garantizamos seguridad y calidad en cada
                    producto.
                </p>
            </div>
        </div>
    </header>

    <!-- --- HISTORIA SECTION --- -->
    <section class="py-24 md:py-32 px-6 bg-white">
        <div class="max-w-[1200px] mx-auto">
            <div class="flex flex-col md:flex-row items-center gap-16 lg:gap-24">
                <!-- Image Side -->
                <div class="md:w-1/2 reveal reveal-scale-in">
                    <div
                        class="relative rounded-[40px] overflow-hidden shadow-2xl rotate-1 hover:rotate-0 transition-all duration-700">
                        <img src="https://ambiderm.com.mx/img/new/30-years-guantes.jpeg" alt="Historia Ambiderm"
                            class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-1000">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                        <div class="absolute bottom-8 left-8 text-white">
                            <p class="text-4xl font-black tracking-tighter">1988</p>
                            <p class="text-sm font-medium opacity-90">Fundación en México</p>
                        </div>
                    </div>
                </div>

                <!-- Content Side -->
                <div class="md:w-1/2 reveal reveal-fade-in">
                    <h2 class="text-4xl md:text-5xl font-black text-[#1d1d1f] mb-8 tracking-tight">Orgullosamente
                        <br>Mexicanos
                    </h2>
                    <div class="space-y-6 text-lg text-gray-500 leading-relaxed text-justify">
                        <p>
                            <strong class="text-[#1d1d1f]">Ambiderm se fundó en 1988</strong>, iniciando operaciones
                            como pioneros en la fabricación de guantes de látex en el país. Nuestra visión siempre fue
                            clara: ofrecer productos que combinaran máxima protección con un confort excepcional.
                        </p>
                        <p>
                            En 1998, consolidamos nuestra fortaleza al fusionarnos con <strong
                                class="text-[#1d1d1f]">Supertex Industrial</strong>, creando un grupo sólido que hoy
                            lidera el mercado nacional. Somos una empresa 100% mexicana, comprometida con el desarrollo
                            de nuestra industria y el bienestar de quienes confían sus manos a nuestra tecnología.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- --- MISION & VISION (Cards) --- -->
    <section class="py-24 bg-[#f5f5f7] px-6">
        <div class="max-w-[1200px] mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Misión -->
                <div
                    class="bg-white p-12 rounded-[40px] shadow-[0_20px_50px_rgba(0,0,0,0.05)] reveal reveal-fade-in hover:-translate-y-2 transition-transform duration-500">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mb-8 text-blue-600">
                        <i data-lucide="target" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-[#1d1d1f] mb-6">Misión</h3>
                    <p class="text-gray-500 text-lg leading-relaxed">
                        Ser líder nacional en la fabricación y comercialización de guantes y productos desechables para
                        la industria dental y médica. Garantizamos la <strong class="text-blue-600">segura protección,
                            comodidad y mejor desempeño</strong> de nuestros usuarios, ofreciendo calidad superior y el
                        mejor servicio a nuestros socios comerciales.
                    </p>
                </div>

                <!-- Visión -->
                <div class="bg-white p-12 rounded-[40px] shadow-[0_20px_50px_rgba(0,0,0,0.05)] reveal reveal-fade-in hover:-translate-y-2 transition-transform duration-500"
                    style="transition-delay: 100ms;">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mb-8 text-blue-600">
                        <i data-lucide="eye" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-[#1d1d1f] mb-6">Visión</h3>
                    <p class="text-gray-500 text-lg leading-relaxed">
                        Ser la marca líder en guantes desechables <strong class="text-blue-600">más confiable en México
                            y Centroamérica</strong>, y el proveedor más completo de soluciones para la industria médica
                        y dental. Buscamos trascender a través de la innovación y la confianza que generamos en cada
                        procedimiento.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- --- VALORES & ECO (Green Section) --- -->
    <section class="py-32 bg-green-50/30 px-6 overflow-hidden">
        <div class="max-w-[1200px] mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-20 reveal reveal-fade-in">
                <span class="text-green-600 font-bold tracking-widest uppercase text-xs">Nuestros Valores</span>
                <h2 class="text-4xl md:text-5xl font-black text-[#1d1d1f] mt-4 mb-6">Compromiso Total</h2>
                <p class="text-gray-500 text-xl">Nos regimos por estándares internacionales para cuidar de ti y del
                    planeta.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Value 1 -->
                <div class="reveal reveal-fade-in p-8 text-center">
                    <div
                        class="w-20 h-20 mx-auto bg-green-100 rounded-full flex items-center justify-center text-green-600 mb-6">
                        <i data-lucide="leaf" class="w-10 h-10"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-4">Eco-Friendly</h4>
                    <p class="text-gray-500">Nuestros guantes de látex natural se reintegran más rápido al medio
                        ambiente, reduciendo la huella ecológica.</p>
                </div>

                <!-- Value 2 -->
                <div class="reveal reveal-fade-in p-8 text-center" style="transition-delay: 100ms;">
                    <div
                        class="w-20 h-20 mx-auto bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mb-6">
                        <i data-lucide="award" class="w-10 h-10"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-4">Calidad Certificada</h4>
                    <p class="text-gray-500">Cumplimos con normas internacionales y contamos con certificaciones de la
                        UNAM que validan nuestra seguridad.</p>
                </div>

                <!-- Value 3 -->
                <div class="reveal reveal-fade-in p-8 text-center" style="transition-delay: 200ms;">
                    <div
                        class="w-20 h-20 mx-auto bg-purple-100 rounded-full flex items-center justify-center text-purple-600 mb-6">
                        <i data-lucide="users" class="w-10 h-10"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-4">Capital Humano</h4>
                    <p class="text-gray-500">Contribuimos al desarrollo profesional de nuestros colaboradores y al
                        crecimiento de las comunidades donde operamos.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- --- LOCATIONS & CONTACT FOOTER --- -->
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
        const mobileLinks = document.querySelectorAll('.mobile-link');

        function toggleMenu() {
            const isActive = mobileMenu.classList.contains('active');

            if (isActive) {
                mobileMenu.classList.remove('active');
                menuIconOpen.classList.remove('hidden');
                menuIconClose.classList.add('hidden');
                document.body.style.overflow = '';
            } else {
                mobileMenu.classList.add('active');
                menuIconOpen.classList.add('hidden');
                menuIconClose.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        menuToggle.addEventListener('click', toggleMenu);

        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (mobileMenu.classList.contains('active')) toggleMenu();
            });
        });
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

</body>

</html>