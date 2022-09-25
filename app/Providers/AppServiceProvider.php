<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
     public function boot()
    {
        Schema::defaultStringLength(191);
        
        $this->app->bind('path.public', function() {
            return base_path().'/../public_html';
        });
        
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Sanctum::ignoreMigrations;
    }
}
