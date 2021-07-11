<?php

namespace App\Providers;

use App\Interfaces\HorarioServicioInterface;
use App\Servicios\HorarioServicio;
use Illuminate\Support\ServiceProvider;

class HorarioServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HorarioServicioInterface::class,HorarioServicio::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
