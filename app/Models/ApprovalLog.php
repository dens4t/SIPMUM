<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApprovalLog extends Model
{
    use HasFactory;

    protected $table = 'approval_logs';
    protected $fillable = ['jenis_pengajuan', 'pengajuan_id', 'id_approver', 'id_pegawai', 'status', 'catatan', 'ip_address', 'user_agent'];

    protected $casts = [
        'status' => 'string',
    ];

    public function approver()
    {
        return $this->belongsTo(Approver::class, 'id_approver');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function scopeByJenisPengajuan($query, $jenis)
    {
        return $query->where('jenis_pengajuan', $jenis);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function getWarnaStatusAttribute()
    {
        return match($this->status) {
            'approved' => 'success',
            'rejected' => 'danger',
            default => 'warning',
        };
    }

    public function getLabelStatusAttribute()
    {
        return match($this->status) {
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => 'Menunggu',
        };
    }
}
