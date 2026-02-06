<?php

namespace App\Services;

use App\Models\Approver;
use App\Models\ApproverCategory;
use App\Models\ApprovalLog;
use App\Models\Pegawai;
use App\Models\PengajuanApproval;
use Illuminate\Support\Facades\Request;

class ApproverService
{
    public function getApproverCategoryById(int $id): ?ApproverCategory
    {
        return ApproverCategory::find($id);
    }

    public function getApproverCategoryByNama(string $nama): ?ApproverCategory
    {
        return ApproverCategory::where('nama_kategori', $nama)->first();
    }

    public function getAllActiveCategories()
    {
        return ApproverCategory::active()->ordered()->get();
    }

    public function getApproverByPegawai(int $id_pegawai)
    {
        return Approver::where('id_pegawai', $id_pegawai)->active()->with('category')->get();
    }

    public function getApproverCategoryByPegawai(int $id_pegawai, int $id_kategori): ?Approver
    {
        return Approver::where('id_pegawai', $id_pegawai)
            ->where('id_approver_category', $id_kategori)
            ->activeNow()
            ->first();
    }

    public function getApproverUntukPengajuan(int $id_pegawai_pengaju): ?Approver
    {
        $pegawai = Pegawai::findOrFail($id_pegawai_pengaju);

        if (!$pegawai->id_atasan) {
            return null;
        }

        return Approver::where('id_pegawai', $pegawai->id_atasan)
            ->activeNow()
            ->first();
    }

    public function isAtasan(int $id_atasan, int $id_bawahan): bool
    {
        return Pegawai::where('id', $id_bawahan)
            ->where('id_atasan', $id_atasan)
            ->exists();
    }

    public function validateCircularAssignment(int $id_pegawai_approver, ?int $id_atasan): bool
    {
        if (!$id_atasan) {
            return true;
        }

        return !Pegawai::where('id', $id_atasan)
            ->where('id_atasan', $id_pegawai_approver)
            ->exists();
    }

    public function createApprovalLog(
        string $jenis,
        int $pengajuan_id,
        Approver $approver,
        int $pegawai_pengaju,
        string $status,
        ?string $catatan = null
    ): ApprovalLog {
        return ApprovalLog::create([
            'jenis_pengajuan' => $jenis,
            'pengajuan_id' => $pengajuan_id,
            'id_approver' => $approver->id,
            'id_pegawai' => $pegawai_pengaju,
            'status' => $status,
            'catatan' => $catatan,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    public function approvePengajuan(
        string $jenis,
        int $pengajuan_id,
        Approver $approver,
        ?string $catatan = null
    ): PengajuanApproval {
        $pengajuanApproval = PengajuanApproval::where('jenis_pengajuan', $jenis)
            ->where('pengajuan_id', $pengajuan_id)
            ->where('id_approver', $approver->id)
            ->firstOrFail();

        $pengajuanApproval->update([
            'status' => 'approved',
            'catatan' => $catatan,
            'approved_at' => now(),
        ]);

        $this->createApprovalLog(
            $jenis,
            $pengajuan_id,
            $approver,
            $pengajuanApproval->approver->pegawai->id,
            'approved',
            $catatan
        );

        return $pengajuanApproval->fresh();
    }

    public function rejectPengajuan(
        string $jenis,
        int $pengajuan_id,
        Approver $approver,
        string $catatan
    ): PengajuanApproval {
        $pengajuanApproval = PengajuanApproval::where('jenis_pengajuan', $jenis)
            ->where('pengajuan_id', $pengajuan_id)
            ->where('id_approver', $approver->id)
            ->firstOrFail();

        $pengajuanApproval->update([
            'status' => 'rejected',
            'catatan' => $catatan,
            'rejected_at' => now(),
        ]);

        $this->createApprovalLog(
            $jenis,
            $pengajuan_id,
            $approver,
            $pengajuanApproval->approver->pegawai->id,
            'rejected',
            $catatan
        );

        return $pengajuanApproval->fresh();
    }

    public function getPendingApprovalsForApprover(int $id_approver)
    {
        return PengajuanApproval::where('id_approver', $id_approver)
            ->pending()
            ->with(['approver.pegawai', 'approver.category'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getApprovalStatus(string $jenis, int $pengajuan_id): array
    {
        $approval = PengajuanApproval::where('jenis_pengajuan', $jenis)
            ->where('pengajuan_id', $pengajuan_id)
            ->with('approver.pegawai', 'approver.category')
            ->first();

        if (!$approval) {
            return [
                'has_approval' => false,
                'status' => null,
                'approver' => null,
                'catatan' => null,
            ];
        }

        return [
            'has_approval' => true,
            'status' => $approval->status,
            'approver' => $approval->approver->nama_lengkap ?? null,
            'approver_category' => $approval->approver->category->nama_kategori ?? null,
            'catatan' => $approval->catatan,
            'approved_at' => $approval->approved_at,
            'rejected_at' => $approval->rejected_at,
        ];
    }

    public function assignApproverToPengajuan(string $jenis, int $pengajuan_id, int $id_pegawai_pengaju): ?PengajuanApproval
    {
        $approver = $this->getApproverUntukPengajuan($id_pegawai_pengaju);

        if (!$approver) {
            return null;
        }

        return PengajuanApproval::create([
            'jenis_pengajuan' => $jenis,
            'pengajuan_id' => $pengajuan_id,
            'id_approver' => $approver->id,
            'status' => 'pending',
        ]);
    }
}
