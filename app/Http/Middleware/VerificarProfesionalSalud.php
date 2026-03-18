<?php

namespace App\Http\Middleware;

use App\Models\Categoria;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarProfesionalSalud
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->cookie('profesional_salud') === '1') {
            return $next($request);
        }

        if ($this->requiereVerificacion($request)) {
            $request->session()->put('url.intended_profesional', url()->full());
            return redirect()->route('verificacion-profesional');
        }

        return $next($request);
    }

    private function requiereVerificacion(Request $request): bool
    {
        $slug = $request->route('slug');

        // Detalle de producto — verificar si alguna de sus categorías requiere verificación
        if ($slug) {
            return Categoria::where('requiere_verificacion', true)
                ->whereHas('productos', fn ($q) => $q->where('slug', $slug))
                ->exists();
        }

        // Catálogo con categoría específica — verificar solo esa categoría
        $categoriaSlug = $request->query('categoria');
        if ($categoriaSlug) {
            $categoria = Categoria::where('slug', $categoriaSlug)->first();
            return $categoria?->requiere_verificacion ?? false;
        }

        // Catálogo general sin categoría — siempre requiere verificación
        return true;
    }
}
