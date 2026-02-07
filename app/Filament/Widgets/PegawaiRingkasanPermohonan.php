<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\NomorSuratResource;
use App\Filament\Resources\PengajuanKegiatanResource;
use App\Filament\Resources\PengajuanKendaraanDinasResource;
use App\Filament\Resources\PengajuanRapatKonsumsiResource;
use App\Filament\Resources\PengajuanSPPDResource;
use App\Models\Kegiatan;
use App\Models\NomorSurat;
use App\Models\PengajuanKendaraanDinas;
use App\Models\PengajuanRapatKonsumsi;
use App\Models\PengajuanSPPD;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PegawaiRingkasanPermohonan extends BaseWidget
{
    protected static ?int $sort = 99;

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $user = auth()->user();
        $idPegawai = $user?->id_pegawai;

        $jumlahKegiatan = Kegiatan::count();

        $jumlahNomorSurat = $idPegawai
            ? NomorSurat::where('id_pegawai', $idPegawai)->count()
            : 0;

        $jumlahKendaraanDinas = $idPegawai
            ? PengajuanKendaraanDinas::where('id_pegawai', $idPegawai)->count()
            : 0;

        $jumlahRapatKonsumsi = $idPegawai
            ? PengajuanRapatKonsumsi::where('id_pegawai', $idPegawai)->count()
            : 0;

        $jumlahSPPD = $idPegawai
            ? PengajuanSPPD::where('id_pegawai', $idPegawai)->count()
            : 0;

        return [
            Stat::make('Kegiatan', $jumlahKegiatan)
                ->description('Total kegiatan')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('success')
                ->url(PengajuanKegiatanResource::getUrl('index', panel: 'user')),

            Stat::make('Nomor Surat', $jumlahNomorSurat)
                ->description('Pengajuan nomor surat')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary')
                ->url(NomorSuratResource::getUrl('index', panel: 'user')),

            Stat::make('Kendaraan Dinas', $jumlahKendaraanDinas)
                ->description('Pengajuan kendaraan dinas')
                ->descriptionIcon('heroicon-m-truck')
                ->color('warning')
                ->url(PengajuanKendaraanDinasResource::getUrl('index', panel: 'user')),

            Stat::make('Rapat Konsumsi', $jumlahRapatKonsumsi)
                ->description('Pengajuan rapat konsumsi')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info')
                ->url(PengajuanRapatKonsumsiResource::getUrl('index', panel: 'user')),

            Stat::make('SPPD', $jumlahSPPD)
                ->description('Pengajuan SPPD')
                ->descriptionIcon('heroicon-m-paper-airplane')
                ->color('danger')
                ->url(PengajuanSPPDResource::getUrl('index', panel: 'user')),
        ];
    }
}
