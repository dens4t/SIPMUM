<?php

namespace App\Filament\Resources\PengajuanRapatKonsumsiResource\Pages;

use App\Filament\Resources\PengajuanRapatKonsumsiResource;
use App\Models\Pegawai;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use App\Http\Traits\WablasTrait;

class ManagePengajuanRapatKonsumsis extends ManageRecords
{
    protected static string $resource = PengajuanRapatKonsumsiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->after(function ($data) {
                $data = ($data);
                $pegawai = Pegawai::where('id', $data['id_pegawai'])->first();
                if (!$pegawai) return;
                $namaPegawai = $pegawai->nama;
                $judul_rapat = $data['judul_rapat'] ?? "";
                $jumlah_peserta_rapat = $data['jumlah_peserta_rapat'] ?? "";
                $tanggal_waktu_mulai = $data['tanggal_waktu_mulai'] ?? "";
                $tanggal_waktu_selesai = $data['tanggal_waktu_selesai'] ?? "";
                $metode = $data['metode'] ?? "";
                $ruang = $data['ruang'] ?? "";
                $jenis_konsumsi = $data['jenis_konsumsi'] ?? "";
                $format = "";
                $format .= "$namaPegawai telah melakukan submit pengajuan rapat dan konsumsi berikut :\n\n";
                $format .= "Judul Rapat : *$judul_rapat*\n";
                $format .= "Jumlah Peserta Rapat : *$jumlah_peserta_rapat*\n";
                $format .= "Tanggal Waktu Mulai : *$tanggal_waktu_mulai*\n";
                $format .= "Tanggal Waktu Selesai: *$tanggal_waktu_selesai*\n";
                $format .= "Metode : *$metode*\n";
                $format .= "Ruang : *$ruang*\n";
                $format .= "Jenis Konsumsi : *$jenis_konsumsi*\n";
                WablasTrait::sendMessage($pegawai->no_hp, $format);
            }),
        ];
    }
}
