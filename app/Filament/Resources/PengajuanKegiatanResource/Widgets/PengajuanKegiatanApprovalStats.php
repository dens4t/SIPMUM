<?php

namespace App\Filament\Resources\PengajuanKegiatanResource\Widgets;

use App\Models\Approver;
use App\Models\Kegiatan;
use App\Models\Pegawai;
use App\Models\PengajuanApproval;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class PengajuanKegiatanApprovalStats extends BaseWidget
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

        $queryKegiatan = Kegiatan::query();
        $this->applyDataVisibilityScope($queryKegiatan, $isAdmin, $idPegawai);

        $total = (clone $queryKegiatan)->count();

        $approvalQuery = PengajuanApproval::query()
            ->where('jenis_pengajuan', 'kegiatan')
            ->whereIn('pengajuan_id', $queryKegiatan->select('id'));

        $pending = (clone $approvalQuery)->where('status', 'pending')->count();
        $approved = (clone $approvalQuery)->where('status', 'approved')->count();
        $rejected = (clone $approvalQuery)->where('status', 'rejected')->count();

        $myApproverIds = $idPegawai
            ? Approver::where('id_pegawai', $idPegawai)->activeNow()->pluck('id')
            : collect();

        $needMyApproval = $myApproverIds->isNotEmpty()
            ? PengajuanApproval::where('jenis_pengajuan', 'kegiatan')
                ->whereIn('id_approver', $myApproverIds)
                ->where('status', 'pending')
                ->count()
            : 0;

        return [
            Stat::make('Total Pengajuan', (string) $total)
                ->color('primary'),
            Stat::make('Menunggu', (string) $pending)
                ->color('warning'),
            Stat::make('Disetujui', (string) $approved)
                ->color('success'),
            Stat::make('Ditolak', (string) $rejected)
                ->color('danger'),
            Stat::make('Perlu Persetujuan', (string) $needMyApproval)
                ->color('info'),
        ];
    }

    protected function applyDataVisibilityScope(Builder $queryKegiatan, bool $isAdmin, ?int $idPegawai): void
    {
        if ($isAdmin) {
            return;
        }

        if (! $idPegawai) {
            $queryKegiatan->whereRaw('1 = 0');

            return;
        }

        $activeCategoryNames = $this->getActiveApproverCategoryNames($idPegawai);

        if (in_array('Manager', $activeCategoryNames, true)) {
            return;
        }

        if ($this->hasTeamLeaderScope($activeCategoryNames)) {
            $subordinateIds = Pegawai::query()
                ->where('id_atasan', $idPegawai)
                ->pluck('id');

            if ($subordinateIds->isEmpty()) {
                $queryKegiatan->whereRaw('1 = 0');

                return;
            }

            $queryKegiatan->whereIn('id_pegawai', $subordinateIds);

            return;
        }

        $queryKegiatan->where('id_pegawai', $idPegawai);
    }

    protected function getActiveApproverCategoryNames(int $idPegawai): array
    {
        return Approver::query()
            ->where('id_pegawai', $idPegawai)
            ->activeNow()
            ->with('category:id,nama_kategori')
            ->get()
            ->pluck('category.nama_kategori')
            ->filter()
            ->values()
            ->all();
    }

    protected function hasTeamLeaderScope(array $activeCategoryNames): bool
    {
        foreach ($activeCategoryNames as $categoryName) {
            if ($categoryName === 'Manager') {
                continue;
            }

            if (str_starts_with($categoryName, 'Manager ')
                || str_starts_with($categoryName, 'Team Leader')
                || str_starts_with($categoryName, 'TL ')) {
                return true;
            }
        }

        return false;
    }
}
