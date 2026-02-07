<?php

namespace App\Filament\Resources\PengajuanKegiatanResource\Pages;

use App\Filament\Resources\PengajuanKegiatanResource;
use App\Filament\Resources\PengajuanKegiatanResource\Widgets\PengajuanKegiatanApprovalStats;
use App\Services\ApproverService;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;

class ManagePengajuanKegiatans extends ManageRecords
{
    protected static string $resource = PengajuanKegiatanResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            PengajuanKegiatanApprovalStats::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->after(function ($record, array $data) {
                $idPegawaiPengaju = $record->id_pegawai ?? $data['id_pegawai'] ?? auth()->user()?->id_pegawai;

                if ($idPegawaiPengaju) {
                    $approval = app(ApproverService::class)
                        ->assignApproverToPengajuan('kegiatan', $record->id, (int) $idPegawaiPengaju);

                    if (! $approval) {
                        Notification::make()
                            ->title('Pengajuan dibuat, tetapi approver belum tersedia.')
                            ->warning()
                            ->send();
                    }
                }
            }),
        ];
    }
}
