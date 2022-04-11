<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
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
        // $this->app->singleton(\Faker\Generator::class, function () {
        //     return \Faker\Factory::create('pt_BR');
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Configurando para a paginação das páginas utilizem o Bootstrap
        Paginator::useBootstrap();

        // Forcing HTTPS to files path if in production
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
