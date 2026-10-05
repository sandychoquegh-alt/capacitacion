<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\SeccionInicio;
use App\Models\Info;
use App\Models\SobreNosotros;
use App\Models\SeccionEmpresarial;
use App\Models\SeccionEmpresa;

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
        View::share(
            'secciones',
            SeccionInicio::orderBy('id')->get()
        );

        View::share(
            'infors',
            Info::all()
        );

        View::share(
            'sobreNosotros',
            SobreNosotros::orderBy('id')->get()
        );
        View::share(
    'seccionesEmpresariales',
    SeccionEmpresarial::all()
);
     

View::share(
    'seccionesEmpresas',
    SeccionEmpresa::with('imagenes')->orderBy('id')->get()
);
    }
}


