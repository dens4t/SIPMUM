<?php

namespace App\Filament\Resources\PengajuanKendaraanDinasResource\Widgets;

use App\Models\Approver;
use App\Models\PengajuanApproval;
use App\Models\PengajuanKendaraanDinas;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PengajuanKendaraanDinasApprovalStats extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected function getColumns(): int
    {
        return 5;
    }

    protected function getStats(): array
    {
        $user = auth()->user();
        $idPegawai = $user?->id_pegawai;
        $isAdmin = (bool) $user?->is_admin;

        $queryPengajuan = PengajuanKendaraanDinas::query();
        if (! $isAdmin && $idPegawai) {
            $queryPengajuan->where('id_pegawai', $idPegawai);
        }

        $total = (clone $queryPengajuan)->count();

        $approvalQuery = PengajuanApproval::query()
            ->where('jenis_pengajuan', 'pengajuan_kendaraan_dinas')
            ->whereIn('pengajuan_id', $queryPengajuan->select('id'));

        $pending = (clone $approvalQuery)->where('status', 'pending')->count();
        $approved = (clone $approvalQuery)->where('status', 'approved')->count();
        $rejected = (clone $approvalQuery)->where('status', 'rejected')->count();

        $myApproverIds = $idPegawai
            ? Approver::where('id_pegawai', $idPegawai)->activeNow()->pluck('id')
            : collect();

        $needMyApproval = $myApproverIds->isNotEmpty()
            ? PengajuanApproval::where('jenis_pengajuan', 'pengajuan_kendaraan_dinas')
                ->whereIn('id_approver', $myApproverIds)
                ->where('status', 'pending')
                ->count()
            : 0;

        return [
            Stat::make('Total Pengajuan', (string) $total)->color('primary'),
            Stat::make('Menunggu', (string) $pending)->color('warning'),
            Stat::make('Disetujui', (string) $approved)->color('success'),
            Stat::make('Ditolak', (string) $rejected)->color('danger'),
            Stat::make('Perlu Persetujuan Saya', (string) $needMyApproval)->color('info'),
        ];
    }
}
