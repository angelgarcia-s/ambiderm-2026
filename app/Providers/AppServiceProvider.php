<?php

namespace App\Providers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\SeccionContenido;
use App\Policies\CategoriaPolicy;
use App\Policies\ProductoPolicy;
use App\Policies\RolePolicy;
use App\Policies\SeccionContenidoPolicy;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
        $this->configurePolicies();
        $this->configureViewComposers();

        // ===== DIAGNÓSTICO TEMPORAL — ELIMINAR DESPUÉS =====
        \Livewire\on('checksum.generate', function ($checksum, $snapshot) {
            if (($snapshot['memo']['name'] ?? '') !== 'admin.productos.form') return;

            $json = json_encode($snapshot);

            if (! request()->isMethod('POST')) {
                file_put_contents(storage_path('logs/lw_render_raw.txt'), $json);
            } else {
                file_put_contents(storage_path('logs/lw_post_raw.txt'), $json);
            }
        });
        // ===== FIN DIAGNÓSTICO =====
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }

    /**
     * Register policies for models that don't follow Laravel's auto-discovery convention.
     */
    protected function configurePolicies(): void
    {
        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(Categoria::class, CategoriaPolicy::class);
        Gate::policy(Producto::class, ProductoPolicy::class);
        Gate::policy(SeccionContenido::class, SeccionContenidoPolicy::class);
    }

    /**
     * Share dynamic navigation data with public layout views.
     */
    protected function configureViewComposers(): void
    {
        View::composer('components.layouts.public', function ($view) {
            $view->with('categoriasNav', cache()->remember('nav.categorias', now()->addHours(24), function () {
                return Categoria::where('activo', true)
                    ->orderBy('orden')
                    ->get(['nombre', 'slug']);
            }));
        });
    }
}
