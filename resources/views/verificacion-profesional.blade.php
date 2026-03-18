<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso para Profesionales de la Salud — {{ config('app.name', 'Ambiderm') }}</title>
    <link rel="icon" href="/favicon.png" sizes="any">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,900" rel="stylesheet" />
    @vite(['resources/css/app.css'])
</head>

<body class="font-sans min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    {{-- Fondo con imagen y blur --}}
    <div class="fixed inset-0 -z-10">
        <img src="{{ asset('images/medico.png') }}"
             alt=""
             class="w-full h-full object-cover"
             aria-hidden="true">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
    </div>

    {{-- Tarjeta modal --}}
    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-md px-10 py-12 flex flex-col items-center text-center">

        {{-- Ícono caduceo --}}
        <div class="mb-6 text-brand-blue">
            <svg class="w-20 h-20 mx-auto" viewBox="0 0 64 84" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                {{-- Bastón central --}}
                <line x1="32" y1="6" x2="32" y2="80" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                {{-- Cabeza / orbe superior --}}
                <circle cx="32" cy="8" r="5" stroke="currentColor" stroke-width="2.5" fill="none"/>
                {{-- Ala izquierda --}}
                <path d="M32 20 C22 13 8 15 6 23 C10 21 18 21 24 27" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                {{-- Ala derecha --}}
                <path d="M32 20 C42 13 56 15 58 23 C54 21 46 21 40 27" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                {{-- Serpiente izquierda --}}
                <path d="M29 28 C20 34 20 43 29 49 C38 55 38 64 29 70" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                {{-- Serpiente derecha --}}
                <path d="M35 28 C44 34 44 43 35 49 C26 55 26 64 35 70" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" fill="none"/>
            </svg>
        </div>

        {{-- Título --}}
        <h1 class="text-2xl font-bold text-gray-900 leading-snug mb-8">
            Esta sección es exclusiva para<br>
            <span class="text-brand-blue">Profesionales de la salud.</span>
        </h1>

        {{-- Formulario --}}
        <form method="POST"
              action="{{ route('verificacion-profesional.aceptar') }}"
              class="w-full flex flex-col items-center gap-6">
            @csrf

            {{-- Checkbox --}}
            <label class="flex items-center gap-3 cursor-pointer group">
                <input
                    type="checkbox"
                    name="acepta"
                    value="1"
                    id="acepta"
                    class="w-4 h-4 rounded border-gray-300 cursor-pointer accent-[#0071e3]"
                    required
                    aria-describedby="acepta-error">
                <span class="text-sm text-gray-700 select-none group-hover:text-gray-900 transition-colors">
                    Acepto que soy un profesional de la salud
                </span>
            </label>

            @error('acepta')
                <p id="acepta-error" class="text-red-500 text-sm -mt-4">{{ $message }}</p>
            @enderror

            {{-- Botones --}}
            <div class="flex gap-3 w-full justify-center">
                <button
                    type="submit"
                    class="flex-1 max-w-[160px] bg-brand-blue hover:bg-brand-blue-hover text-white font-semibold text-sm py-3 px-6 rounded-full transition-colors duration-200 cursor-pointer">
                    Aceptar
                </button>

                <a
                    href="{{ route('home') }}"
                    class="flex-1 max-w-[160px] bg-brand-blue hover:bg-brand-blue-hover text-white font-semibold text-sm py-3 px-6 rounded-full transition-colors duration-200 text-center">
                    Cancelar
                </a>
            </div>
        </form>

    </div>
</body>
</html>
