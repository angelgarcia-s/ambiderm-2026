{{-- Footer compartido: Redes sociales, Sucursales, Contacto, Copyright --}}
@php
    $contacto   = $footer->get('contacto')?->contenido ?? [];
    $copyright  = $footer->get('copyright')?->contenido ?? [];
@endphp

<footer class="bg-white pt-32 overflow-hidden" id="contacto">

  <!-- Formulario de Contacto & Distribuidor -->
  @if ($footer->has('contacto'))
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
          @if (session('contacto_enviado'))
            <div class="flex flex-col items-center justify-center py-12 text-center gap-4">
              <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center">
                <i data-lucide="check" class="w-8 h-8 text-green-600"></i>
              </div>
              <h4 class="text-xl font-bold text-brand-ink">¡Mensaje enviado!</h4>
              <p class="text-gray-500">Un especialista se pondrá en contacto contigo a la brevedad.</p>
            </div>
          @else
          <form action="{{ route('contacto.send') }}" method="POST" class="space-y-6">
            @csrf
            {{-- Honeypot anti-spam: oculto para humanos, los bots lo llenan --}}
            <div aria-hidden="true" style="display:none;">
              <input type="text" name="website" value="" autocomplete="off" tabindex="-1">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
              <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 px-2">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Tu nombre" class="w-full bg-white border @error('nombre') border-red-400 @else border-gray-100 @enderror rounded-2xl px-6 py-4 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                @error('nombre') <p class="mt-1 px-2 text-xs text-red-500">{{ $message }}</p> @enderror
              </div>
              <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 px-2">Correo</label>
                <input type="email" name="correo" value="{{ old('correo') }}" placeholder="email@ejemplo.com" class="w-full bg-white border @error('correo') border-red-400 @else border-gray-100 @enderror rounded-2xl px-6 py-4 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                @error('correo') <p class="mt-1 px-2 text-xs text-red-500">{{ $message }}</p> @enderror
              </div>
            </div>
            <div>
              <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 px-2">Mensaje</label>
              <textarea rows="4" name="mensaje" placeholder="¿En qué podemos ayudarte?" class="w-full bg-white border @error('mensaje') border-red-400 @else border-gray-100 @enderror rounded-2xl px-6 py-4 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all resize-none">{{ old('mensaje') }}</textarea>
              @error('mensaje') <p class="mt-1 px-2 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
            <button type="submit"
              onclick="this.disabled=true; this.innerText='Enviando…'; this.form.submit();"
              class="w-full bg-brand-ink text-white py-5 rounded-full font-bold text-lg hover:bg-brand-blue hover:shadow-2xl shadow-blue-500/30 transition-all transform active:scale-[0.98] disabled:opacity-60 disabled:cursor-not-allowed">
              ENVIAR MENSAJE
            </button>
          </form>
          @endif
        </div>
      </div>
    </div>
  </div>
  @endif

  <!-- Copyright Bar -->
  @if ($footer->has('copyright'))
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
  @endif
</footer>
