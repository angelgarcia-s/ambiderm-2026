<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AMBIDERM | Toallitas húmedas</title>
  <meta name="description" content="Landing Toallitas AMBIDERM" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'ambiderm-primary': '#0284C7', // Sky 600
            'ambiderm-dark': '#0369a1',    // Sky 700
            'ambiderm-light': '#E0F2FE',   // Sky 100
            'title': '#0284C7',       // Sky 600
            'body': '#475569',        // Slate 600
            'surface-light': '#F8FAFC',    // Slate 50
            'surface-blue': '#F5FBFF',
            'border-base': '#E2E8F0',      // Slate 200
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

  <!-- Bootstrap 5 CSS (For Navbar) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    body { font-family: "Inter", sans-serif;
          color: #0F172A; 
          overflow-x: hidden;
          padding-top: 80px;
    }

    .premium-nav {
            background: white !important;
            box-shadow: 0 4px 20px rgba(2, 132, 199, 0.15); /* Sky blue shadow */
            z-index: 9999 !important;
        }

        .nav-link-premium {
            font-weight: 500 !important;
            color: #0F172A !important; /* Slate 900 */
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.1em;
            padding: 0.5rem 0.5rem !important;
            opacity: 1 !important;
            display: block !important;
        }
        
        .nav-link-premium:hover {
            color: #0284C7 !important; /* Sky 600 */
        }

        .navbar-collapse.collapse {
            visibility: visible !important;
        }

		.vinetas{
			color: 
		}

        @media (max-width: 991px) {
            .navbar-collapse.collapse:not(.show) {
                display: none !important;
            }
        }
  </style>

  <!-- Google Analytics -->
  @include('partials.google-analytics')
</head>
<body class="bg-white">
  <main class="w-full">
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top premium-nav py-4">
        <div class="container">
            <a class="navbar-brand p-0" href="#">
                <img src="{{ asset('images/logo-azul.svg') }}" alt="Ambiderm Logo" class="h-8 lg:h-10">
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#premiumNavbar">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#0284C7" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>

            <div class="collapse navbar-collapse" id="premiumNavbar">
                <ul class="navbar-nav ms-auto items-center gap-2 lg:gap-4 list-none p-0 m-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-premium" href="#beneficios">Beneficios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-premium" href="#productos">Presentaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-premium" href="#contacto">Contacto</a>
                    </li>
                    <li class="nav-item ms-lg-4">
                        <a href="#contacto"
                            class="bg-[#0284C7] text-white font-black py-2 px-6 rounded-full uppercase tracking-widest text-[0.7rem] shadow-xl shadow-sky-600/20 hover:bg-[#0369a1] transition-all no-underline">
                            Contactar Vendedor
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="w-full" style="background: linear-gradient(180deg, #FFFFFF 0%, #E0F2FE 100%);">
      <div class="max-w-7xl mx-auto px-6 lg:px-20 py-20 grid grid-cols-1 lg:grid-cols-12 items-center gap-10 lg:gap-16">
        <div class="w-full lg:col-span-7 flex flex-col gap-5">
          <h1 class="text-title text-4xl lg:text-6xl leading-tight font-extrabold">Toallitas Húmedas Ambiderm</h1>
          <p class="text-title text-2xl font-semibold">Cuidado, bienestar y confianza para el día a día.</p>
          <p class="text-body text-lg">Una nueva línea pensada para acompañar momentos reales: hogar, negocio y atención al cliente.</p>
          <div class="flex gap-3">
            <a href="#productos" class="inline-flex items-center justify-center rounded-2xl border border-border-base bg-white px-5 py-3 text-sm font-semibold text-title hover:bg-surface-light transition">Ver productos</a>
          </div>
        </div>
        <div class="w-full lg:col-span-5 h-[500px] rounded-[28px]  border-border-base bg-transparent p-2">
          <!-- <div class="w-full h-full rounded-[20px] border border-border-base overflow-hidden bg-white"> -->
            <img src="{{ asset('images/landing/toallitas/toallitas.png') }}" alt="Hero image" class="w-full h-full object-contain" />
          <!-- </div> -->
        </div>
      </div>
    </section>

    <section class="w-full bg-[#f5fbff] border-t border-slate-200">
      <div class="max-w-7xl mx-auto px-6 lg:px-20 py-14 flex flex-col-reverse lg:flex-row items-center gap-10 lg:gap-9">
        <div class="w-full lg:w-96 h-auto lg:h-64 rounded-3xl overflow-hidden">
          <img src="{{ asset('images/landing/toallitas/Baby.png') }}" alt="Engagement" class="w-full h-full object-cover" />
        </div>
        <div class="w-full flex flex-col gap-4">
          <h2 class="text-3xl lg:text-4xl leading-tight font-extrabold text-title">Más que limpieza: tranquilidad</h2>
          <p class="text-lg text-[#475569]">Cuando cuidas a tu gente —familia, pacientes o clientes— la confianza lo cambia todo. Estas toallitas están pensadas para que cada momento se sienta más seguro, más cómodo y más humano.</p>
        </div>
      </div>
    </section>

    <section id="beneficios" class="w-full bg-white/40 border-b border-slate-200 scroll-mt-16">
      <div class="max-w-7xl mx-auto px-6 lg:px-20 py-16 flex flex-col gap-5">
        <h2 class="text-3xl lg:text-4xl font-extrabold text-title">Beneficios</h2>
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <article class="w-full rounded-3xl border border-slate-200 bg-white p-4 flex flex-col gap-2.5">
            <div class="w-full h-32 rounded-[14px] overflow-hidden"><img src="{{ asset('images/landing/toallitas/hidrata.svg') }}" alt="Fresco Aroma" class="w-full h-full object-cover" /></div>
            <h3 class="text-lg font-bold text-title">Fresco Aroma</h3>
            <p class="text-sm text-[#475569]">Su aroma fresco te encantara</p>
          </article>
          <article class="w-full rounded-3xl border border-slate-200 bg-white p-4 flex flex-col gap-2.5">
            <div class="w-full h-32 rounded-[14px] overflow-hidden"><img src="{{ asset('images/landing/toallitas/limpia.svg') }}" alt="Limpia y desinfecta" class="w-full h-full object-cover" /></div>
            <h3 class="text-lg font-bold text-title">Limpia y desinfecta</h3>
            <p class="text-sm text-[#475569]">Ideal para uso personal con un poderoso desinfectante.</p>
          </article>
          <article class="w-full rounded-3xl border border-slate-200 bg-white p-4 flex flex-col gap-2.5">
            <div class="w-full h-32 rounded-[14px] overflow-hidden"><img src="{{ asset('images/landing/toallitas/suave.svg') }}" alt="Suave" class="w-full h-full object-cover" /></div>
            <h3 class="text-lg font-bold text-title">Suave</h3>
            <p class="text-sm text-[#475569]">Pensadas para rutinas frecuentes de cuidado.</p>
          </article>
          <article class="w-full rounded-3xl border border-slate-200 bg-white p-4 flex flex-col gap-2.5">
            <div class="w-full h-32 rounded-[14px] overflow-hidden"><img src="{{ asset('images/landing/toallitas/vitamina_E.svg') }}" alt="Con Vitamina E / Aloe Vera" class="w-full h-full object-cover" /></div>
            <h3 class="text-lg font-bold text-title">Con Vitamina E / Aloe Vera</h3>
            <p class="text-sm text-[#475569]">Mantiene tu piel suave y con una sensación agradable.</p>
          </article>
        </div>
      </div>
    </section>

    <section id="productos" class="w-full bg-[#f5fbff] border-y border-slate-200 scroll-mt-16">
      <div class="max-w-7xl mx-auto px-6 lg:px-20 py-16 flex flex-col gap-3">
        <h2 class="text-3xl lg:text-4xl font-extrabold text-title">Conoce las presentaciones</h2>
        <p class="text-lg text-[#475569]">Una presentacion para cada ocasion.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
          <article class="rounded-3xl border border-slate-200 bg-white p-4 flex flex-col gap-3">
            <div class="w-full h-44 rounded-2xl  border-slate-200 overflow-hidden"><img src="{{ asset('images/landing/toallitas/bolsa_10.png') }}" alt="Bolsa 10" class="w-full h-full object-contain" /></div>
            <h3 class="text-lg font-semibold text-title leading-tight">Toallitas Húmedas Antibacteriales<br/>Bolsa 10</h3>
            <p class="text-sm text-[#475569]">Bolsa con cierre adhesivo.</p>
            <div class="text-xs text-[#334155] leading-relaxed">
              <p>• Llévalas contigo a todos lados.</p>
              <p>• Con vitamina E y Aloe Vera.</p>
              <p>• Higiene inmediata siempre contigo.</p>
            </div>
            <a href="#bolsa" class="rounded-2xl bg-sky-600 px-5 py-3 text-sm font-semibold text-white">Ver producto</a>
          </article>

          <article class="rounded-3xl border border-slate-200 bg-white p-4 flex flex-col gap-3">
            <div class="w-full h-44 rounded-2xl  border-slate-200 overflow-hidden"><img src="{{ asset('images/landing/toallitas/junior_16.png') }}" alt="Caja 16" class="w-full h-full object-contain" /></div>
            <h3 class="text-lg font-semibold text-title leading-tight">Toallitas Húmedas Antibacteriales<br/>Caja 16 individuales</h3>
            <p class="text-sm text-[#475569]">Sobres individuales para el día a día.</p>
            <div class="text-xs text-[#334155] leading-relaxed">
              <p>• Fácil transporte.</p>
              <p>• Con vitamina E y Aloe Vera.</p>
              <p>• Conveniente para toda la familia.</p>
            </div>
            <a href="#caja" class="rounded-2xl bg-sky-600 px-5 py-3 text-sm font-semibold text-white">Ver producto</a>
          </article>

          <article class="rounded-3xl border border-slate-200 bg-white p-4 flex flex-col gap-3">
            <div class="w-full h-44 rounded-2xl  border-slate-200 overflow-hidden"><img src="{{ asset('images/landing/toallitas/baby.png') }}" alt="Baby 80" class="w-full h-full object-contain" /></div>
            <h3 class="text-lg font-semibold text-title leading-tight">Toallitas Húmedas<br/> Ambiderm Baby<br/>Paquete 80</h3>
            <p class="text-sm text-[#475569]">Para cuidar a quien mas amas.</p>
            <div class="text-xs text-[#334155] leading-relaxed">
              <p>• Suaves con la piel de tu bebe.</p>
              <p>• Sin alcohol.</p>
              <p>• Sin aroma.</p>
            </div>
            <a href="#baby" class="rounded-2xl bg-sky-600 px-5 py-3 text-sm font-semibold text-white">Ver producto</a>
          </article>
        </div>
      </div>
    </section>

    <!-- Detalle Producto: Bolsa 10 -->
    <section id="bolsa" class="w-full bg-[#F8FAFC] border-b border-slate-200 scroll-mt-16">
      <div class="max-w-7xl mx-auto px-6 lg:px-20 py-14 flex flex-col lg:flex-row items-center gap-8">
        <div class="w-full lg:w-1/2 h-80 lg:h-[32rem] rounded-[28px] borders border-slate-200 overflow-hidden bg-transparent">
          <img src="{{ asset('images/landing/toallitas/mochila_10.png') }}" alt="Bolsa 10" class="w-full h-full object-contain" />
        </div>
        <div class="w-full lg:w-1/2 flex flex-col gap-8 justify-center">
          <p class="text-sky-600 font-extrabold text-sm uppercase tracking-wide">BOLSA 10</p>
          <div class="flex flex-wrap gap-2.5">
             <div class="rounded-full bg-sky-100/80 px-3 py-2 text-xs font-semibold text-sky-900">Compacta</div>
             <div class="rounded-full bg-cyan-100/80 px-3 py-2 text-xs font-semibold text-cyan-900">Práctica</div>
             <div class="rounded-full bg-sky-50/80 px-3 py-2 text-xs font-semibold text-sky-800">Cierre adhesivo</div>
          </div>
          <h2 class="text-title text-4xl lg:text-5xl font-extrabold leading-tight">Siempre lista<br/>para salir contigo</h2>
          <div class="flex flex-col gap-2">
            <p class="text-body text-lg font-bold">• Compacta</p>
            <p class="text-body text-lg font-bold">• Aloe Vera + Vitamina E</p>
            <p class="text-body text-lg font-bold">• Higiene inmediata</p>
          </div>
          <div>
            <a href="#bolsa" class="rounded-2xl bg-sky-600 px-6 py-3.5 text-[15px] font-bold text-white hover:bg-sky-700 transition">Quiero esta presentación</a>
          </div>
        </div>
      </div>
    </section>

    <section class="w-full bg-[#F0F9FF] border-b border-slate-200">
      <div class="max-w-7xl mx-auto px-6 lg:px-20 py-14 flex flex-col gap-3">
        <h3 class="text-title text-4xl font-extrabold">Practicas para llevar</h3>
        <div class="grid grid-cols-3 sm:grid-cols-3 gap-3">
          <div class="h-80 rounded-3xl border border-slate-200 overflow-hidden bg-white">
            <img src="{{ asset('images/landing/toallitas/guantera.png') }}" alt="Detalle 1" class="w-full h-full object-cover" />
          </div>
          <div class="h-80 rounded-3xl border border-slate-200 overflow-hidden bg-white">
            <img src="{{ asset('images/landing/toallitas/mochila.png') }}" alt="Detalle 2" class="w-full h-full object-cover" />
          </div>
          <div class="h-80 rounded-3xl border border-slate-200 overflow-hidden bg-white">
            <img src="{{ asset('images/landing/toallitas/cosmetiquera.png') }}" alt="Detalle 3" class="w-full h-full object-cover" />
          </div>
        </div>
      </div>
    </section>

    <!-- <section class="w-full bg-white border-b border-slate-200">
      <div class="max-w-7xl mx-auto px-6 lg:px-20 py-14 flex flex-col gap-5">
        <h3 class="text-title text-4xl font-extrabold">Casos de uso</h3>
        <div class="w-full h-96 lg:h-[26rem] rounded-3xl border border-slate-200 overflow-hidden relative group">
           <img src="{{ asset('images/landing/toallitas/Bolsa10.png') }}" alt="Uso Bolsa 10" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
           <div class="absolute inset-0 bg-linear-to-t from-sky/60 to-transparent p-8 flex items-end">
              <p class="text-white text-3xl lg:text-4xl font-extrabold">Siempre lista para salir contigo</p>
           </div>
        </div>
      </div>
    </section> -->

    <!-- Detalle Producto: Caja 16 -->
    <section id="caja" class="w-full bg-[#F0F9FF] border-b border-slate-200 scroll-mt-16">
      <div class="max-w-7xl mx-auto px-6 lg:px-20 py-14 flex flex-col lg:flex-row-reverse items-center gap-8">
        <div class="w-full lg:w-1/2 h-80 lg:h-[32rem] rounded-[28px]  border-slate-200 overflow-hidden bg-transparent">
          <img src="{{ asset('images/landing/toallitas/bolsillo.png') }}" alt="Caja 16" class="w-full h-full object-contain" />
        </div>
        <div class="w-full lg:w-1/2 flex flex-col gap-8 justify-center">
          <p class="text-sky-600 font-extrabold text-sm uppercase tracking-wide">CAJA 16 INDIVIDUALES</p>
          <div class="flex flex-wrap gap-2.5">
             <div class="rounded-full bg-sky-100/80 px-3 py-2 text-xs font-semibold text-sky-900">Individuales</div>
             <div class="rounded-full bg-cyan-100/80 px-3 py-2 text-xs font-semibold text-cyan-900">Portátiles</div>
             <div class="rounded-full bg-sky-50/80 px-3 py-2 text-xs font-semibold text-sky-800">Caja display</div>
          </div>
          <h2 class="text-title text-4xl lg:text-5xl font-extrabold leading-tight">Tu ritmo diario<br/>en sobres individuales</h2>
          <div class="flex flex-col gap-2">
            <p class="text-body text-lg font-bold">• Fácil de llevar</p>
            <p class="text-body text-lg font-bold">• Uso rápido</p>
            <p class="text-body text-lg font-bold">• Ideal para oficina o escuela</p>
          </div>
          <div>
            <button class="rounded-2xl bg-sky-600 px-6 py-3.5 text-[15px] font-bold text-white hover:bg-sky-700 transition">Quiero esta presentación</button>
          </div>
        </div>
      </div>
    </section>

    <section class="w-full bg-[#F0F9FF] border-b border-slate-200">
      <div class="max-w-7xl mx-auto px-6 lg:px-20 py-14 flex flex-col gap-5">
        <h3 class="text-title text-4xl font-extrabold">Llevalas contigo siempre</h3>
        <div class="grid grid-cols-3 sm:grid-cols-3 gap-3">
          <div class="h-80 rounded-3xl border border-slate-200 overflow-hidden bg-white">
            <img src="{{ asset('images/landing/toallitas/bolsa_viaje.png') }}" alt="Detalle 1" class="w-full h-full object-cover" />
          </div>
          <div class="h-80 rounded-3xl border border-slate-200 overflow-hidden bg-white">
            <img src="{{ asset('images/landing/toallitas/cartera.png') }}" alt="Detalle 2" class="w-full h-full object-cover" />
          </div>
          <div class="h-80 rounded-3xl border border-slate-200 overflow-hidden bg-white">
            <img src="{{ asset('images/landing/toallitas/restaurante.png') }}" alt="Detalle 3" class="w-full h-full object-cover" />
          </div>
        </div>
      </div>
    </section>

    <!-- <section class="w-full bg-white border-b border-slate-200">
      <div class="max-w-7xl mx-auto px-6 lg:px-20 py-14 flex flex-col gap-5">
        <h3 class="text-title text-4xl font-extrabold">Casos de uso</h3>
        <div class="w-full h-96 lg:h-[26rem] rounded-3xl border border-slate-200 overflow-hidden relative group">
           <img src="{{ asset('images/landing/toallitas/junior16.png') }}" alt="Uso Caja 16" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
           <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent p-8 flex items-end">
              <p class="text-white text-3xl lg:text-4xl font-extrabold">Tu ritmo diario en sobres individuales</p>
           </div>
        </div>
      </div>
    </section> -->


    <!-- Detalle Producto: Baby 80 -->
    <section id="baby" class="w-full bg-[#F8FAFC] border-b border-slate-200 scroll-mt-16">
      <div class="max-w-7xl mx-auto px-6 lg:px-20 py-14 flex flex-col lg:flex-row items-center gap-8">
        <div class="w-full lg:w-1/2 h-80 lg:h-[32rem] rounded-[28px] border border-slate-200 overflow-hidden bg-white">
          <img src="{{ asset('images/landing/toallitas/bebe.png') }}" alt="Baby 80" class="w-full h-full object-cover" />
        </div>
        <div class="w-full lg:w-1/2 flex flex-col gap-8 justify-center">
          <p class="text-sky-600 font-extrabold text-sm uppercase tracking-wide">BABY PAQUETE 80</p>
          <div class="flex flex-wrap gap-2.5">
             <div class="rounded-full bg-sky-100/80 px-3 py-2 text-xs font-semibold text-sky-900">Suaves</div>
             <div class="rounded-full bg-cyan-100/80 px-3 py-2 text-xs font-semibold text-cyan-900">Sin alcohol</div>
             <div class="rounded-full bg-sky-50/80 px-3 py-2 text-xs font-semibold text-sky-800">Hipoalergénicas</div>
          </div>
          <h2 class="text-title text-4xl lg:text-5xl font-extrabold leading-tight">Más cuidado<br/>para tu bebé</h2>
          <div class="flex flex-col gap-2">
            <p class="text-body text-lg font-bold">• Sin alcohol</p>
            <p class="text-body text-lg font-bold">• Sin aroma</p>
            <p class="text-body text-lg font-bold">• Suaves con su piel</p>
          </div>
          <div>
            <button class="rounded-2xl bg-sky-600 px-6 py-3.5 text-[15px] font-bold text-white hover:bg-sky-700 transition">Quiero esta presentación</button>
          </div>
        </div>
      </div>
    </section>

    <section class="w-full bg-[#F0F9FF] border-b border-slate-200">
      <div class="max-w-7xl mx-auto px-6 lg:px-20 py-14 flex flex-col gap-5">
        <h3 class="text-title text-4xl font-extrabold">Para el cuidado de quien mas amas</h3>
        <div class="grid grid-cols-3 sm:grid-cols-3 gap-3">
          <div class="h-80 rounded-3xl border border-slate-200 overflow-hidden bg-white">
            <img src="{{ asset('images/landing/toallitas/panalera.png') }}" alt="Detalle 1" class="w-full h-full object-cover" />
          </div>
          <div class="h-80 rounded-3xl border border-slate-200 overflow-hidden bg-white">
            <img src="{{ asset('images/landing/toallitas/cajon.png') }}" alt="Detalle 2" class="w-full h-full object-cover" />
          </div>
          <div class="h-80 rounded-3xl border border-slate-200 overflow-hidden bg-white">
            <img src="{{ asset('images/landing/toallitas/bebe-limpieza.png') }}" alt="Detalle 3" class="w-full h-full object-cover" />
          </div>
        </div>
      </div>
    </section>

    <!-- <section class="w-full bg-white border-b border-slate-200">
      <div class="max-w-7xl mx-auto px-6 lg:px-20 py-14 flex flex-col gap-5">
        <h3 class="text-title text-4xl font-extrabold">Casos de uso</h3>
        <div class="w-full h-96 lg:h-[26rem] rounded-3xl border border-slate-200 overflow-hidden relative group">
           <img src="{{ asset('images/landing/toallitas/bebe.png') }}" alt="Uso Baby" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
           <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent p-8 flex items-end">
              <p class="text-white text-3xl lg:text-4xl font-extrabold">Cuidado y amor para los más pequeños</p>
           </div>
        </div>
      </div>
    </section> -->

    <section id="contacto" class="w-full bg-[#F8FAFC] border-b border-slate-200 scroll-mt-32">
      <div class="max-w-7xl mx-auto px-6 lg:px-20 py-20 flex flex-col md:flex-row gap-8 items-start">
        <div class="w-full md:w-1/2 flex flex-col gap-4">
          <h2 class="text-4xl font-extrabold text-title">Contacta a tu vendedor</h2>
          <p class="text-lg text-[#475569]">Déjanos tus datos para coordinar visita y enviarte información de la nueva línea.</p>
        </div>

        <form id="rfc-trigger-form" class="w-full rounded-3xl border border-slate-200 bg-white p-5 flex flex-col gap-3">
          @csrf
          <input type="hidden" name="producto" value="TOALLITAS">
          <input type="hidden" name="landing_identifier" value="toallitas">

          <div class="w-full flex flex-col gap-1.5">
            <label class="text-xs font-semibold text-[#334155]">Razón social</label>
            <input type="text" name="razon_social" required
                class="h-12 w-full rounded-2xl border border-slate-200 bg-white px-3.5 text-sm text-slate-700 outline-none focus:border-sky-500 transition"
                placeholder="Ej. Distribuidora XYZ">
          </div>

          <div class="w-full flex flex-col gap-1.5">
            <label class="text-xs font-semibold text-[#334155]">RFC</label>
            <input type="text" name="rfc" required
                class="h-12 w-full rounded-2xl border border-slate-200 bg-white px-3.5 text-sm text-slate-700 uppercase outline-none focus:border-sky-500 transition"
                placeholder="ABCD123456XYZ">
          </div>

          <button id="submit-btn" type="submit" class="w-full rounded-2xl bg-sky-600 px-5 py-3 text-sm font-semibold text-white hover:bg-sky-700 transition">
            Enviar y contactar a mi vendedor
          </button>
          
          <div id="status-display" class="hidden mt-2 p-3 rounded-2xl font-bold text-center text-xs"></div>
        </form>
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
            <p class="text-[0.6rem] font-bold text-gray-400 uppercase tracking-widest">© {{ date('Y') }} Ambiderm. Todos los derechos reservados.</p>
        </footer>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('rfc-trigger-form');
        const submitBtn = document.getElementById('submit-btn');
        const statusDisplay = document.getElementById('status-display');

        if (form) {
            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                submitBtn.disabled = true;
                const originalBtnText = submitBtn.textContent;
                submitBtn.textContent = 'Procesando...';
                statusDisplay.classList.add('hidden');
                statusDisplay.className = 'hidden mt-2 p-3 rounded-2xl font-bold text-center text-xs'; // reset classes

                const formData = new FormData(form);
                const data = {
                    rfc: formData.get('rfc'),
                    razon_social: formData.get('razon_social'),
                    producto: formData.get('producto'),
                    landing_identifier: formData.get('landing_identifier'),
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
                    if(result.success) {
                        statusDisplay.classList.add('bg-emerald-50', 'text-emerald-800', 'border', 'border-emerald-100');
                        statusDisplay.innerHTML = `<strong>¡Éxito!</strong> ${result.message}`;
                        form.reset();
                    } else {
                         statusDisplay.classList.add('bg-rose-50', 'text-rose-800', 'border', 'border-rose-100');
                         statusDisplay.innerHTML = `<strong>Aviso:</strong> ${result.message}`;
                    }

                } catch (error) {
                    statusDisplay.classList.remove('hidden');
                    statusDisplay.classList.add('bg-rose-500', 'text-white');
                    statusDisplay.textContent = 'Error crítico: ' + error.message;
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalBtnText;
                }
            });
        }
    });
  </script>
</body>
</html>
