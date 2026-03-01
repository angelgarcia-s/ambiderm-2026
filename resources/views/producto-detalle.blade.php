<x-layouts.public title="Guantes Colorfull - Ambiderm">

    <!-- --- BREADCRUMB --- -->
    <div class="pt-24 pb-4 px-6 md:px-12 bg-white">
        <div class="max-w-[1240px] mx-auto flex items-center text-xs text-gray-400 uppercase tracking-widest gap-2">
            <a href="{{ route('home') }}" class="hover:text-brand-blue transition-colors">Inicio</a>
            <span class="text-gray-300">/</span>
            <a href="{{ route('productos') }}" class="hover:text-brand-blue transition-colors">Productos</a>
            <span class="text-gray-300">/</span>
            <span class="text-brand-blue font-bold">Guantes Colorfull</span>
        </div>
    </div>

    <!-- --- PRODUCT DETAIL SECTION --- -->
    <section class="pb-24 px-6 md:px-12 bg-white">
        <div class="max-w-[1240px] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24">

            <!-- Column LEFT: Image Gallery -->
            <div class="relative">
                <div class="relative bg-brand-surface rounded-[40px] aspect-square flex items-center justify-center p-8 lg:p-16 overflow-hidden reveal reveal-scale-in">
                    <div class="absolute inset-0 bg-blue-100/50 blur-[80px] rounded-full scale-75 opacity-0 active-color-bg transition-opacity duration-500"></div>
                    <img id="main-product-image"
                        src="https://ambiderm.com.mx/storage/productos/C4NnlHYzhDvxIsaApvd49fzzIiZcScrqES12GI4N.png"
                        alt="Guante Colorfull"
                        class="w-full h-full object-contain mix-blend-multiply z-10 transition-transform duration-500 hover:scale-105">
                </div>
            </div>

            <!-- Column RIGHT: Product Info -->
            <div class="flex flex-col justify-center reveal reveal-fade-in" style="transition-delay: 200ms;">
                <div class="mb-2">
                    <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-brand-blue text-[10px] font-bold uppercase tracking-widest border border-blue-100">Más Vendido</span>
                    <span class="inline-block px-3 py-1 rounded-full bg-purple-50 text-purple-600 text-[10px] font-bold uppercase tracking-widest border border-purple-100 ml-2">Colores Divertidos</span>
                </div>

                <h1 class="text-4xl md:text-5xl font-black text-brand-ink mb-2 tracking-tight">Colorfull</h1>
                <p class="text-xl text-gray-500 font-medium mb-6">Guantes de látex para exploración</p>

                <p class="text-gray-600 leading-relaxed mb-8 text-lg">
                    Una opción vibrante y práctica para diversas aplicaciones. Diseñados para brindar protección y
                    estilo, con un acabado sedoso que facilita la colocación y minimiza la fatiga manual. Ideal para
                    odontología y procedimientos no estériles.
                </p>

                <!-- Selectors -->
                <div class="space-y-8 mb-10 border-t border-b border-gray-100 py-8">

                    <!-- Color Selector -->
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Color Seleccionado:
                            <span id="color-name" class="text-brand-ink">Surtido</span>
                        </p>
                        <div class="flex gap-4">
                            <button
                                class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-pink-400 ring-2 ring-offset-2 ring-brand-blue color-option active"
                                data-color="Surtido"
                                data-img="https://ambiderm.com.mx/storage/productos/C4NnlHYzhDvxIsaApvd49fzzIiZcScrqES12GI4N.png"></button>
                            <button
                                class="w-10 h-10 rounded-full bg-[#37b5e5] color-option opacity-50 hover:opacity-100"
                                data-color="Azul" aria-label="Azul"></button>
                            <button
                                class="w-10 h-10 rounded-full bg-[#ff70a6] color-option opacity-50 hover:opacity-100"
                                data-color="Rosa" aria-label="Rosa"></button>
                            <button
                                class="w-10 h-10 rounded-full bg-[#a3cf62] color-option opacity-50 hover:opacity-100"
                                data-color="Verde" aria-label="Verde"></button>
                        </div>
                    </div>

                    <!-- Size Selector -->
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Talla</p>
                        <div class="flex gap-3">
                            <button class="size-option w-12 h-12 rounded-xl border border-gray-200 text-gray-500 font-bold hover:bg-gray-50 flex items-center justify-center">XS</button>
                            <button class="size-option w-12 h-12 rounded-xl border border-gray-200 text-gray-500 font-bold hover:bg-gray-50 flex items-center justify-center">S</button>
                            <button class="size-option w-12 h-12 rounded-xl bg-brand-ink text-white border border-brand-ink font-bold flex items-center justify-center ring-2 ring-offset-2 ring-transparent active">M</button>
                            <button class="size-option w-12 h-12 rounded-xl border border-gray-200 text-gray-500 font-bold hover:bg-gray-50 flex items-center justify-center">L</button>
                        </div>
                    </div>
                </div>

                <!-- Feature List -->
                <ul class="space-y-3 mb-10">
                    <li class="flex items-center text-gray-600 font-medium">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-brand-blue mr-3"></i> No estéril
                    </li>
                    <li class="flex items-center text-gray-600 font-medium">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-brand-blue mr-3"></i> Ambidiestro y liso
                    </li>
                    <li class="flex items-center text-gray-600 font-medium">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-brand-blue mr-3"></i> Bajo contenido de polvo
                    </li>
                    <li class="flex items-center text-gray-600 font-medium">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-brand-blue mr-3"></i> Cumple Normas Oficiales
                    </li>
                </ul>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="https://shop.ambiderm.com.mx/collections/guantes-de-latex/products/colorfull"
                        target="_blank"
                        class="flex-1 bg-brand-blue text-white font-bold py-4 rounded-full text-center hover:bg-brand-blue-hover hover:shadow-lg hover:shadow-blue-500/30 transition-all transform active:scale-[0.98] flex items-center justify-center gap-2">
                        <i data-lucide="shopping-bag" class="w-5 h-5"></i> COMPRAR EN LÍNEA
                    </a>
                    <a href="https://www.ambiderm.com.mx/catalogo/catalogo.pdf" target="_blank"
                        class="flex-1 bg-gray-50 text-brand-ink font-bold py-4 rounded-full text-center border border-gray-200 hover:bg-gray-100 transition-all flex items-center justify-center gap-2">
                        <i data-lucide="file-text" class="w-5 h-5"></i> FICHA TÉCNICA
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- --- TECHNICAL DETAILS ACCORDION --- -->
    <section class="py-12 bg-[#fbfbfd] border-t border-gray-100">
        <div class="max-w-[800px] mx-auto px-6">

            <div class="mb-4">
                <button class="accordion-btn w-full bg-white p-6 rounded-2xl shadow-sm flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-bold text-lg text-brand-ink">Información de Presentación</span>
                    <i data-lucide="chevron-down" class="icon-chevron w-5 h-5 text-gray-400 transition-transform"></i>
                </button>
                <div class="accordion-content">
                    <div class="p-6 text-gray-600 leading-relaxed">
                        <p class="mb-2"><strong>Junior:</strong> Caja con 100 guantes (50 pares al peso).</p>
                        <p><strong>Master:</strong> Corrugado con 10 cajas (1,000 guantes en total).</p>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <button class="accordion-btn w-full bg-white p-6 rounded-2xl shadow-sm flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-bold text-lg text-brand-ink">Normas y Certificaciones</span>
                    <i data-lucide="chevron-down" class="icon-chevron w-5 h-5 text-gray-400 transition-transform"></i>
                </button>
                <div class="accordion-content">
                    <div class="p-6 text-gray-600 leading-relaxed">
                        <p>Cumple con las Normas Oficiales Mexicanas y estándares internacionales de calidad para
                            guantes de exploración médica de un solo uso.</p>
                        <ul class="list-disc pl-5 mt-2 space-y-1">
                            <li>ISO 9001:2015</li>
                            <li>Registro COFEPRIS Vigente</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- --- RELATED PRODUCTS --- -->
    <section class="py-24 px-6 bg-white">
        <div class="max-w-[1240px] mx-auto">
            <h2 class="text-2xl md:text-3xl font-black text-brand-ink mb-12 text-center">TAMBIÉN TE PUEDE INTERESAR</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

                <a href="https://ambiderm.com.mx/productos/guantes/esteril"
                    class="group block relative bg-brand-surface rounded-[30px] p-8 transition-transform hover:-translate-y-2">
                    <div class="aspect-square flex items-center justify-center mb-6">
                        <img src="https://ambiderm.com.mx/storage/productos/7OyCwjS7LYzZDXCWYYdEpHhnmjMjuigXOGnGIGmE.png"
                            class="w-full h-full object-contain mix-blend-multiply transition-transform group-hover:scale-105">
                    </div>
                    <div class="text-center">
                        <h4 class="font-bold text-lg text-brand-ink">Estéril</h4>
                        <p class="text-sm text-gray-500">Para cirugía menor</p>
                    </div>
                </a>

                <a href="https://ambiderm.com.mx/productos/guantes/nitrilo"
                    class="group block relative bg-brand-surface rounded-[30px] p-8 transition-transform hover:-translate-y-2">
                    <div class="aspect-square flex items-center justify-center mb-6">
                        <img src="https://ambiderm.com.mx/storage/productos/BDOCYI3GixLQoC1nmI7oFe6ZJ2F8vPpvMgSA8E8i.png"
                            class="w-full h-full object-contain mix-blend-multiply transition-transform group-hover:scale-105">
                    </div>
                    <div class="text-center">
                        <h4 class="font-bold text-lg text-brand-ink">Nitrilo</h4>
                        <p class="text-sm text-gray-500">Alternativa libre de látex</p>
                    </div>
                </a>

                <a href="https://ambiderm.com.mx/productos/guantes/kid-gloves"
                    class="group block relative bg-brand-surface rounded-[30px] p-8 transition-transform hover:-translate-y-2">
                    <div class="aspect-square flex items-center justify-center mb-6">
                        <img src="https://ambiderm.com.mx/storage/productos/qXdk8YkEfNw7smTDqlW1otPlR3ZXKZ50mnwJpLfz.png"
                            class="w-full h-full object-contain mix-blend-multiply transition-transform group-hover:scale-105">
                    </div>
                    <div class="text-center">
                        <h4 class="font-bold text-lg text-brand-ink">Kid Gloves</h4>
                        <p class="text-sm text-gray-500">Pediátrico</p>
                    </div>
                </a>

            </div>
        </div>
    </section>

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
                    <a href="#" class="text-[10px] font-bold text-gray-400 hover:text-brand-blue transition-colors uppercase tracking-widest">Aviso de Privacidad</a>
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
            .size-option.active { background-color: #1d1d1f; color: white; border-color: #1d1d1f; }
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
                        b.classList.remove('active', 'ring-2', 'ring-offset-2', 'ring-brand-blue');
                        b.classList.add('opacity-50');
                    });
                    btn.classList.add('active', 'ring-2', 'ring-offset-2', 'ring-brand-blue');
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
