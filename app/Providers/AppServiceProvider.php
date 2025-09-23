<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Gasto;
use App\Models\Configuracione;
use App\Observers\BitacoraObserver;

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
        Gasto::observe(BitacoraObserver::class);
        Configuracione::observe(BitacoraObserver::class);
    }
}
