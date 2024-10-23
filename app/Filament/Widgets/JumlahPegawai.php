<?php

namespace App\Filament\Widgets;

use App\Models\Pegawai;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class JumlahPegawai extends BaseWidget
{
    protected function getStats(): array
    {
        $jumlahPegawai = Pegawai::count();
        $jumlahPegawaiLaki = Pegawai::where('jenis_kelamin', 'L')->count();
        $jumlahPegawaiPerempuan = Pegawai::where('jenis_kelamin', 'P')->count();
        return [
            Stat::make('Total Pegawai', "$jumlahPegawai Orang"),
            Stat::make('Jumlah Pegawai Laki-laki', "$jumlahPegawaiLaki Orang"),
            Stat::make('Jumlah Pegawai Perempuan', "$jumlahPegawaiPerempuan Orang"),
        ];
    }
}
