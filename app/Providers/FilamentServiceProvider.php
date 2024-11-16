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
        Filament::serving(function () {
            if (auth()->check()) {
                // Check the user's role and apply the appropriate panel
                if (auth()->user()->is_admin) {
                    Filament::panel('admin');
                } else {
                    Filament::panel('user');
                }
            }
        });
    }
}
