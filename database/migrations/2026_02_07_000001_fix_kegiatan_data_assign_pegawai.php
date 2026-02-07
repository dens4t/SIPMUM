<?php

use App\Models\Approver;
use App\Models\Kegiatan;
use App\Models\Pegawai;
use App\Services\ApproverService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get staff under Team Leader (same pattern as PendingPengajuanStaffSeeder)
        $staffPool = $this->getStaffUnderTeamLeader();

        if ($staffPool->isEmpty()) {
            echo "Warning: Tidak ada staff bawahan Team Leader. Skip fix data.\n";

            return;
        }

        // Get all kegiatan without id_pegawai
        $kegiatanWithoutPegawai = Kegiatan::query()
            ->whereNull('id_pegawai')
            ->get();

        if ($kegiatanWithoutPegawai->isEmpty()) {
            echo "Info: Tidak ada kegiatan yang perlu di-fix.\n";

            return;
        }

        $staffCount = $staffPool->count();
        $fixedCount = 0;

        DB::transaction(function () use ($kegiatanWithoutPegawai, $staffPool, $staffCount, &$fixedCount) {
            foreach ($kegiatanWithoutPegawai as $index => $kegiatan) {
                // Rotate through staff pool
                $pegawai = $staffPool[$index % $staffCount];

                // Assign id_pegawai
                $kegiatan->update(['id_pegawai' => $pegawai->id]);

                // Create approval via ApproverService (same as PendingPengajuanStaffSeeder)
                $approval = app(ApproverService::class)->assignApproverToPengajuan(
                    'kegiatan',
                    $kegiatan->id,
                    $pegawai->id
                );

                if ($approval) {
                    $fixedCount++;
                } else {
                    echo "Warning: Approver tidak ditemukan untuk kegiatan #{$kegiatan->id} (pegawai {$pegawai->id}).\n";
                }
            }
        });

        echo "Success: {$fixedCount} kegiatan berhasil di-fix dengan id_pegawai dan approval.\n";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove approval records for kegiatan that were fixed
        $kegiatanIds = Kegiatan::query()
            ->whereNotNull('id_pegawai')
            ->pluck('id');

        if ($kegiatanIds->isNotEmpty()) {
            DB::table('pengajuan_approvers')
                ->where('jenis_pengajuan', 'kegiatan')
                ->whereIn('pengajuan_id', $kegiatanIds)
                ->delete();
        }

        // Reset id_pegawai to null
        Kegiatan::query()
            ->whereNotNull('id_pegawai')
            ->update(['id_pegawai' => null]);
    }

    /**
     * Get staff under Team Leader (same logic as PendingPengajuanStaffSeeder)
     */
    private function getStaffUnderTeamLeader()
    {
        $tlPegawaiIds = Approver::query()
            ->activeNow()
            ->whereHas('category', function ($query) {
                $query->where('nama_kategori', 'like', 'TL %')
                    ->orWhere('nama_kategori', 'like', 'Team Leader %');
            })
            ->pluck('id_pegawai');

        if ($tlPegawaiIds->isEmpty()) {
            return collect();
        }

        $activeApproverPegawaiIds = Approver::query()->activeNow()->pluck('id_pegawai');

        return Pegawai::query()
            ->whereIn('id_atasan', $tlPegawaiIds)
            ->whereNotIn('id', $activeApproverPegawaiIds)
            ->orderBy('nama')
            ->get(['id', 'nama']);
    }
};
