<?php

namespace App\Providers;

use App\Http\Responses\LoginResponse;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            LoginResponse::class,
            \App\Http\Responses\LoginResponse::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                'Tamu',
                'Permohonan',
                'Instansi',
                'Lainnya',
            ]);
        });
        FilamentAsset::register([
            Js::make('calendar-time-widget', 'public/js/app/calendar-time-widget.js'),
        ]);
        FilamentAsset::register([
            Css::make('calendar-time-widget-css', 'public/css/app/calendar-time-widget-css.css'),
        ]);
        FilamentAsset::register([
            Css::make('vanilla-calendar-css', 'https://cdn.jsdelivr.net/npm/vanilla-calendar-pro/build/vanilla-calendar.min.css'),
        ]);
        FilamentAsset::register([
            Js::make('vanilla-calendar-js', 'https://cdn.jsdelivr.net/npm/vanilla-calendar-pro/build/vanilla-calendar.min.js'),
        ]);
        FilamentAsset::register([
            Js::make('fullcalendar', 'https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'),
        ]);
    }
}
