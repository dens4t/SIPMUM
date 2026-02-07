<?php

namespace App\Filament\Widgets;

use App\Models\Approver;
use App\Models\ApproverCategory;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class ApproverStatusWidget extends BaseWidget
{
    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $user = auth()->user();
        $idPegawai = $user?->id_pegawai;

        if (!$idPegawai) {
            return [
                Stat::make('Status Approver', 'Tidak Ada')
                    ->description('Anda tidak memiliki akses approver')
                    ->descriptionIcon('heroicon-o-x-circle')
                    ->color('danger'),
            ];
        }

        $approvers = Approver::where('id_pegawai', $idPegawai)->activeNow()->with('category')->get();

        if ($approvers->isEmpty()) {
            return [
                Stat::make('Status Approver', 'Non-Approver')
                    ->description('Anda belum ditunjuk sebagai approver')
                    ->descriptionIcon('heroicon-o-user-minus')
                    ->color('gray'),
            ];
        }

        $stats = [];

        foreach ($approvers as $index => $approver) {
            $categoryName = $approver->category->nama_kategori ?? 'Tanpa Kategori';
            $badgeColor = match ($index) {
                0 => 'success',
                1 => 'warning',
                2 => 'info',
                default => 'primary',
            };

            $stats[] = Stat::make(
                "Approver Level " . ($index + 1),
                $categoryName
            )
            ->description('Kategori Approver')
            ->descriptionIcon('heroicon-o-check-circle')
            ->color($badgeColor);
        }

        return $stats;
    }
}
