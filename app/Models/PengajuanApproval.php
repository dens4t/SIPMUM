<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengajuanApproval extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_approvers';
    protected $fillable = ['jenis_pengajuan', 'pengajuan_id', 'id_approver', 'status', 'catatan', 'approved_at', 'rejected_at'];

    protected $casts = [
        'status' => 'string',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    public function approver()
    {
        return $this->belongsTo(Approver::class, 'id_approver');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'approved' => 'success',
            'rejected' => 'danger',
            default => 'warning',
        };
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => 'Menunggu',
        };
    }
}
