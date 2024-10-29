<?php

namespace App\Filament\Resources\PengajuanKendaraanDinasResource\Pages;

use App\Filament\Resources\PengajuanKendaraanDinasResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use App\Http\Traits\WablasTrait;
use App\Models\Driver;
use App\Models\Kendaraan;
use App\Models\Pegawai;

class ManagePengajuanKendaraanDinas extends ManageRecords
{
    protected static string $resource = PengajuanKendaraanDinasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->after(function ($data) {
                $data = ($data);
                // dd($data);
                $pegawai = Pegawai::where('id', $data['id_pegawai'])->first();
                $driver = Driver::where('id', $data['id_driver'])->first();
                $kendaraan = Kendaraan::where('id', $data['id_kendaraan'])->first();
                if (!$pegawai) return;
                $namaPegawai = $pegawai->nama;
                $namaDriver = $driver->nama;
                $namaKendaraan = $kendaraan->jenis_mobil;
                $nomorPolisiKendaraan = $kendaraan->nomor_polisi;
                $tanggal_peminjaman = $data['tanggal_peminjaman'] ?? "";
                $tanggal_pengembalian = $data['tanggal_pengembalian'] ?? "";
                $keperluan = $data['keperluan'] ?? "";
                $tujuan = $data['tujuan'] ?? "";
                $stand_km_awal = $data['stand_km_awal'] ?? "";
                $format = "";
                $format .= "$namaPegawai telah melakukan submit pengajuan kendaraan dinas sebagai berikut :\n\n";
                $format .= "Tanggal Peminjaman : *$tanggal_peminjaman sampai dengan $tanggal_pengembalian*\n";
                $format .= "Keperluan : *$keperluan*\n";
                $format .= "Tujuan : *$tujuan*\n";
                $format .= "Stand KM awal : *$stand_km_awal*\n";
                $format .= "Nama Driver : *$namaDriver*\n";
                $format .= "Kendaraan : *$namaKendaraan* | *$nomorPolisiKendaraan*\n";
                WablasTrait::sendMessage($pegawai->no_hp, $format);
                WablasTrait::sendMessage($driver->no_hp, $format);
            }),
        ];
    }
}
