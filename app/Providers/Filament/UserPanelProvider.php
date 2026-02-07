<?php

namespace App\Providers\Filament;

use App\Filament\Auth\CustomLogin;
use App\Filament\Pages\Tentang;
use App\Filament\Resources\ApproverCategoryResource;
use App\Filament\Resources\ApproverResource;
use App\Filament\Resources\ApprovalLogResource;
use App\Filament\Resources\BagianResource;
use App\Filament\Resources\DriverResource;
use App\Filament\Resources\JabatanResource;
use App\Filament\Resources\KendaraanResource;
use App\Filament\Resources\KotaResource;
use App\Filament\Resources\NomorSuratResource;
use App\Filament\Resources\PegawaiResource;
use App\Filament\Resources\PendidikanTerakhirResource;
use App\Filament\Resources\PengajuanKegiatanResource;
use App\Filament\Resources\PengajuanKendaraanDinasResource;
use App\Filament\Resources\PengajuanRapatKonsumsiResource;
use App\Filament\Resources\PengajuanSPPDResource;
use App\Filament\Resources\UnitResource;
use App\Filament\Widgets\ApproverStatusWidget;
use App\Filament\Widgets\Kalender;
use App\Filament\Widgets\PegawaiRingkasanPermohonan;
use App\Filament\Widgets\Profile;
use App\Http\Middleware\RedirectIfAdmin;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('user')
            ->path('pegawai')
            ->darkMode(false)
            ->colors([
                'primary' => Color::Blue,
            ])
            ->pages([
                Pages\Dashboard::class,
                Tentang::class,
            ])
            ->resources([
                NomorSuratResource::class,
                PengajuanKegiatanResource::class,
                PengajuanKendaraanDinasResource::class,
                PengajuanRapatKonsumsiResource::class,
                PengajuanSPPDResource::class,
                ApproverResource::class,
                ApproverCategoryResource::class,
                ApprovalLogResource::class,
                BagianResource::class,
                DriverResource::class,
                JabatanResource::class,
                KendaraanResource::class,
                KotaResource::class,
                PegawaiResource::class,
                PendidikanTerakhirResource::class,
                UnitResource::class,
            ])
            ->widgets([
                Profile::class,
                Kalender::class,
                PegawaiRingkasanPermohonan::class,
                ApproverStatusWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
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
                \App\Http\Middleware\ForceLogin::class,
                RedirectIfAdmin::class,
            ])
            ->maxContentWidth(MaxWidth::Full)
            ->unsavedChangesAlerts()
            ->brandLogo(asset('storage/logo.png'))
            ->brandLogoHeight('3rem')
            ->brandName('SI P-MUM')
            // ->breadcrumbs(true)
            // ->topbar(false)
            ->profile()
            ->passwordReset()
            ->spa()
            ->topNavigation();
    }
}
