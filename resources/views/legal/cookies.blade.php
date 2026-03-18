<x-layouts.public title="Política de Cookies - Ambiderm">

    <!-- --- HERO --- -->
    <header class="pt-40 pb-20 px-6 bg-brand-surface text-center">
        <div class="max-w-[800px] mx-auto">
            <p class="text-blue-600 font-bold uppercase tracking-widest text-xs mb-4">Legal</p>
            <h1 class="text-5xl md:text-6xl font-black tracking-tighter text-brand-ink mb-6">
                Política de Cookies
            </h1>
            <p class="text-gray-400 text-sm">Última actualización: {{ now()->format('d/m/Y') }}</p>
        </div>
    </header>

    <!-- --- CONTENIDO --- -->
    <section class="py-20 px-6">
        <div class="max-w-[800px] mx-auto">

            <p class="text-xl font-bold text-brand-ink mb-8">Ambiderm, S.A. de C.V.</p>

            <div class="space-y-5 text-gray-600 leading-relaxed">
                <p>En cumplimiento de lo dispuesto por la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, su Reglamento de desarrollo y los Lineamientos del Aviso de Privacidad emitidos por el Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales y resto de normativa aplicable, el responsable titular del sitio web www.ambiderm.com.mx (en adelante, el “sitio web”), informa que:</p>
                <p>Para las finalidades a continuación indicadas, utilizamos tecnología conocida como cookies y web beacons (conjuntamente, “cookies”):</p>
                <ol>
                        <li>Habilitar funcionalidades del sitio web.</li>
                        <li> Analizar el uso que los usuarios y/o visitantes de sitio efectúan del mismo.</li>
                        <li>Recordar las preferencias de navegación de dichos usuarios y/o visitantes.</li>
                        <li>Registrar los sitios que ha visitado y generar anuncios con contenido relevante para usted.</li>
                        <li> Recabar datos estadísticos de navegación, origen y transacciones.</li>
                </ol>
                <p>Para alcanzar estas finalidades, utilizamos cookies clasificables como:</p>
                <ul>
                        <li><strong>Cookies estrictamente necesarias:</strong> Son aquellas requeridas para la operación del sitio web. Este tipo de cookies incluyen aquellas que permiten registrarse de forma segura en sitios específicos del sitio web.</li>
                        <li><strong>Cookies analíticas:</strong> Son aquellas que nos permiten reconocer y contabilizar el número de usuarios de nuestro sitio web, así como analizar la navegación dentro del mismo. Estas cookies permiten mejorar la funcionalidad del sitio web, identificando zonas o información que los usuarios buscan dentro del mismo.</li>
                        <li><strong>Cookies funcionales:</strong> Son aquellas que permiten mejorar el funcionamiento del sitio web y facilitar su uso. Por ejemplo, mediante el registro de visitas previas o su registro anterior en nuestros servicios.</li>
                        <li><strong>Targeting/Marketing Cookies:</strong> Son aquellas que registran su visita al sitio web, las páginas que ha visitado y los enlaces que ha elegido. Estas cookies permiten la generación de anuncios basados en sus intereses o preferencias más relevantes.</li>
                </ul>
                <p>Podemos almacenar cookies estrictamente necesarias en su dispositivo, para que el sitio web funcione correctamente. En función del lugar desde el que nos visite, requeriremos de su consentimiento para el uso del resto de cookies antes indicadas.</p>
                <p>En cualquier momento puede cambiar o revocar su consentimiento para el uso de cookies que no sean estrictamente necesarias.</p>
                <p>El presente Aviso de Cookies forma parte del Aviso de Privacidad Integral y regula el uso de mecanismos en medios remotos o locales de comunicación electrónica que permiten al responsable recabar datos considerados como personales de manera automática y simultánea al tiempo que el titular hace contacto con dichos medios.</p>
            </div>
        </div>
    </section>

    @include('partials.footer')

</x-layouts.public>
