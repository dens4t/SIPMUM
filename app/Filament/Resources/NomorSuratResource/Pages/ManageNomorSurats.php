<?php

namespace App\Filament\Resources\NomorSuratResource\Pages;

use App\Filament\Resources\NomorSuratResource;
use App\Filament\Resources\NomorSuratResource\Widgets\NomorSuratApprovalStats;
use App\Http\Traits\WablasTrait;
use App\Models\Pegawai;
use App\Services\ApproverService;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;

class ManageNomorSurats extends ManageRecords
{
    protected static string $resource = NomorSuratResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            NomorSuratApprovalStats::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->after(function ($record, array $data) {
                // dd($data);
                $pegawai = Pegawai::where('id', $data['id_pegawai'])->first();
                if (! $pegawai) {
                    return;
                }
                $namaPegawai = $pegawai->nama;
                $kode_surat = $data['kode_surat'];
                $kode_klasifikasi = $data['kode_klasifikasi'];
                $perihal = $data['perihal'];
                $tanggal = $data['tanggal'];
                $kode_unit = $data['kode_unit'];
                $format = '';
                $format .= "$namaPegawai telah melakukan submit permohonan nomor surat sebagai berikut :\n\n";
                $format .= "Kode Surat : *$kode_surat*\n";
                $format .= "Kode Klasifikasi : *$kode_klasifikasi*\n";
                $format .= "Perihal : *$perihal*\n";
                $format .= "Tanggal : *$tanggal*\n";
                $format .= "Kode Unit : *$kode_unit*\n";
                WablasTrait::sendMessage($pegawai->no_hp, $format);

                $idPegawaiPengaju = $record->id_pegawai ?? $data['id_pegawai'] ?? auth()->user()?->id_pegawai;
                if ($idPegawaiPengaju) {
                    $approval = app(ApproverService::class)
                        ->assignApproverToPengajuan('nomor_surat', $record->id, (int) $idPegawaiPengaju);

                    if (! $approval) {
                        Notification::make()
                            ->title('Pengajuan dibuat, tetapi approver belum tersedia.')
                            ->warning()
                            ->send();
                    }
                }

                // Runs after the form fields are saved to the database.
            }),
        ];
    }
}
