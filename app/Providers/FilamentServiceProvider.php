<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // FilamentAsset::register([
        //     Css::make('custom-stylesheet', 'https://unpkg.com/aos@2.3.1/dist/aos.css'),
        //     Js::make('custom-stylesheet', 'https://unpkg.com/aos@2.3.1/dist/aos.js'),
        // ]);
    }
}
