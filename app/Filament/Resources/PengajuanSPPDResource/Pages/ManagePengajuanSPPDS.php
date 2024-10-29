<?php

namespace App\Filament\Resources\PengajuanSPPDResource\Pages;

use App\Filament\Resources\PengajuanSPPDResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use App\Http\Traits\WablasTrait;
use App\Models\Kota;
use App\Models\Pegawai;

class ManagePengajuanSPPDS extends ManageRecords
{
    protected static string $resource = PengajuanSPPDResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->after(function ($data) {
                $data = ($data);
                $pegawai = Pegawai::where('id', $data['id_pegawai'])->first();
                $kotaAsal = Kota::where('id', $data['id_kota_asal'])->first();
                $kotaTujuan = Kota::where('id', $data['id_kota_tujuan'])->first();
                if (!$pegawai) return;
                $namaPegawai = $pegawai->nama;
                $jenis_sppd = $data['jenis_sppd'] ?? "";
                $judul_kegiatan = $data['judul_kegiatan'] ?? "";
                $tanggal_awal_kegiatan = $data['tanggal_awal_kegiatan'] ?? "";
                $tanggal_akhir_kegiatan = $data['tanggal_akhir_kegiatan'] ?? "";
                $nomor_prk = $data['nomor_prk'] ?? "";
                $nomor_pembebanan = $data['nomor_pembebanan'] ?? "";
                $jenis_angkutan = $data['jenis_angkutan'] ?? "";
                $kota_asal = $kotaAsal->nama ?? "";
                $kota_tujuan = $kotaTujuan->nama ?? "";
                $format = "";
                $format .= "$namaPegawai telah melakukan submit pengajuan SPPD sebagai berikut :\n\n";
                $format .= "Jenis SPPD : *$jenis_sppd*\n";
                $format .= "Judul Kegiatan : *$judul_kegiatan*\n";
                $format .= "Tanggal Awal Kegiatan : *$tanggal_awal_kegiatan*\n";
                $format .= "Tanggal Akhir Kegiatan : *$tanggal_akhir_kegiatan*\n";
                $format .= "Nomor PRK : *$nomor_prk*\n";
                $format .= "Nomor Pembebanan : *$nomor_pembebanan*\n";
                $format .= "Jenis Angkutan : *$jenis_angkutan*\n";
                $format .= "Jenis Angkutan : *$jenis_angkutan*\n";
                $format .= "Asal : *$kota_asal*\n";
                $format .= "Tujuan : *$kota_tujuan*\n";
                WablasTrait::sendMessage($pegawai->no_hp, $format);
            }),
        ];
    }
}
