{{-- Footer compartido: Redes sociales, Sucursales, Contacto, Copyright --}}
@php
    $redes = $footer['redes_sociales']->contenido;
    $sucursales = $footer['sucursales']->contenido;
    $contacto = $footer['contacto']->contenido;
    $copyright = $footer['copyright']->contenido;
@endphp

<footer class="bg-white pt-32 overflow-hidden" id="contacto">

  <!-- Redes Sociales & Logo -->
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

  <!-- Mapas & Sucursales -->
  <div class="bg-[#fbfbfd] py-32 border-t border-gray-100">
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
          <div class="mt-16 reveal reveal-fade-in">
            <a href="mailto:{{ $contacto['email'] }}" class="inline-flex items-center gap-4 text-brand-ink font-bold text-2xl hover:text-brand-blue transition-all">
              {{ $contacto['email'] }}
              <i data-lucide="arrow-up-right" class="w-6 h-6"></i>
            </a>
          </div>
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
  </div>

  <!-- Formulario de Contacto & Distribuidor -->
  <div class="bg-white py-32">
    <div class="max-w-[1200px] mx-auto px-6">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
        <div class="reveal reveal-fade-in">
          <h4 class="text-brand-blue font-bold uppercase tracking-widest text-xs mb-4">{{ $contacto['badge'] }}</h4>
          <h3 class="text-3xl md:text-5xl font-black tracking-tighter text-brand-ink mb-8">{!! nl2br(e($contacto['titulo'])) !!}</h3>
          <p class="text-gray-500 text-lg mb-12">{{ $contacto['subtitulo'] }}</p>

          <a href="{{ $contacto['distribuidor_url'] }}" target="_blank"
            class="flex items-center gap-6 p-8 rounded-[30px] bg-blue-50 border border-blue-100 hover:bg-white hover:shadow-2xl transition-all group">
            <div class="w-16 h-16 rounded-2xl bg-blue-600 flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition-transform">
              <img src="{{ $contacto['distribuidor_icono'] }}" class="w-10 h-10 invert">
            </div>
            <div class="text-left">
              <strong class="text-blue-900 text-xl block leading-tight">{{ $contacto['distribuidor_titulo'] }}</strong>
              <span class="text-blue-600/70 font-medium">{{ $contacto['distribuidor_subtitulo'] }}</span>
            </div>
            <i data-lucide="chevron-right" class="w-8 h-8 text-blue-300 ml-auto mr-4"></i>
          </a>
        </div>

        <div class="reveal reveal-fade-in bg-[#fbfbfd] p-10 md:p-16 rounded-[40px] border border-gray-100 shadow-sm">
          <form action="{{ $contacto['form_action_url'] }}" method="POST" class="space-y-6">
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
        <p class="text-[10px] font-bold text-brand-ink tracking-widest mb-2 uppercase">{{ $copyright['texto'] }}</p>
        <p class="text-gray-400 text-[10px]">{{ $copyright['subtexto'] }}</p>
      </div>
      <div class="flex flex-wrap justify-center gap-x-8 gap-y-2">
        @foreach ($copyright['links'] as $link)
          <a href="{{ $link['url'] }}" class="text-[10px] font-bold text-gray-400 hover:text-brand-blue transition-colors uppercase tracking-widest">{{ $link['texto'] }}</a>
        @endforeach
      </div>
    </div>
  </div>
</footer>
