<?php

namespace App\Providers\Filament;

use App\Filament\Auth\CustomLogin;
use App\Filament\Widgets\DaftarUnit;
use App\Filament\Widgets\JenjangPegawai;
use App\Filament\Widgets\JumlahPegawai;
use App\Filament\Widgets\Kalender;
use App\Filament\Widgets\Profile;
use App\Http\Middleware\RedirectIfPegawai;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(CustomLogin::class)
            ->colors([
                'primary' => Color::Blue,
            ])
            ->darkMode(false)
            ->https(false)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                Profile::class,
                Kalender::class,
                JumlahPegawai::class,
                DaftarUnit::class,
                JenjangPegawai::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                RedirectIfPegawai::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->font('Inter', provider: GoogleFontProvider::class)
            ->authMiddleware([
                Authenticate::class,
            ])
            ->maxContentWidth(MaxWidth::Full)
            ->unsavedChangesAlerts()
            ->brandLogo(asset('storage/logo.png'))
            ->brandLogoHeight('2rem')
            ->brandName('SI P-MUM')
            // ->breadcrumbs(true)
            // ->topbar(false)
            ->profile()
            ->passwordReset()
            ->spa();
    }
}
