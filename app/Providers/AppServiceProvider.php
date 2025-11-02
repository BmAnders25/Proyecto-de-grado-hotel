<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        Configuracione::observe(BitacoraObserver::class);
    }
}
