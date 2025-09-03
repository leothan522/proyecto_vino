<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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
        //Configuring Livewire's update endpoint
        if (env('APP_ASSET_LIVEWIRE', false)){
            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/'.env('APP_ASSET_LIVEWIRE').'/livewire/update', $handle)->name('assetlivewire.update');
            });
            Livewire::setScriptRoute(function ($handle) {
                return Route::get('/'.env('APP_ASSET_LIVEWIRE').'/livewire/livewire.js', $handle);
            });
        }

    }
}
