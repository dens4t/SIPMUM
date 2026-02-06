<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Approver extends Model
{
    use HasFactory;

    protected $table = 'approvers';
    protected $fillable = ['id_pegawai', 'id_approver_category', 'id_atasan', 'is_active', 'tanggal_mulai', 'tanggal_selesai'];

    protected $casts = [
        'is_active' => 'boolean',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function category()
    {
        return $this->belongsTo(ApproverCategory::class, 'id_approver_category');
    }

    public function atasan()
    {
        return $this->belongsTo(Pegawai::class, 'id_atasan');
    }

    public function approvalLogs()
    {
        return $this->hasMany(ApprovalLog::class, 'id_approver');
    }

    public function pengajuanApprovals()
    {
        return $this->hasMany(PengajuanApproval::class, 'id_approver');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeActiveNow($query)
    {
        return $query->active()->where(function ($q) {
            $q->whereNull('tanggal_mulai')
              ->orWhereDate('tanggal_mulai', '<=', now());
        })->where(function ($q) {
            $q->whereNull('tanggal_selesai')
              ->orWhereDate('tanggal_selesai', '>=', now());
        });
    }

    public function getNamaLengkapAttribute()
    {
        return $this->pegawai->nama . ' (' . $this->category->nama_kategori . ')';
    }

    public function getJumlahBawahanAttribute()
    {
        if (!$this->relationLoaded('pegawai') || !$this->pegawai->relationLoaded('bawahan')) {
            return $this->pegawai?->bawahan()->count() ?? 0;
        }
        return $this->pegawai->bawahan->count();
    }
}
