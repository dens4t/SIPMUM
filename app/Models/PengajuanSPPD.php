<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanSPPD extends Model
{
    protected $table = 'pengajuan_sppd';

    protected $guarded = [];

    protected $casts = [
        'surat_undangan_penugasan' => 'array',
    ];

    use HasFactory;

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function kota_asal(): BelongsTo
    {
        return $this->belongsTo(Kota::class, 'id_kota_asal');
    }

    public function kota_tujuan(): BelongsTo
    {
        return $this->belongsTo(Kota::class, 'id_kota_tujuan');
    }

    public function approval(): BelongsTo
    {
        return $this->belongsTo(PengajuanApproval::class, 'id', 'pengajuan_id')
            ->where('jenis_pengajuan', 'pengajuan_sppd');
    }
}
