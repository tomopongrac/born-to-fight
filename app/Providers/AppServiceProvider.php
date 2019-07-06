<?php

namespace App\Providers;

use App\Service\ConfigUnitsLoader;
use App\Service\UnitsLoaderInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UnitsLoaderInterface::class, ConfigUnitsLoader::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
