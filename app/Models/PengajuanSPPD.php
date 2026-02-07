<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PengajuanSPPD extends Model
{
    protected $table = 'pengajuan_sppd';

    protected $guarded = [];

    protected $casts = [
        'surat_undangan_penugasan' => 'array',
    ];

    use HasFactory;

    public function pegawai()
    {
        return $this->hasOne(Pegawai::class, 'id', 'id_pegawai');
    }

    public function kota_asal()
    {
        return $this->hasOne(Kota::class, 'id', 'id_kota_asal');
    }

    public function kota_tujuan()
    {
        return $this->hasOne(Kota::class, 'id', 'id_kota_tujuan');
    }

    public function approval(): HasOne
    {
        return $this->hasOne(PengajuanApproval::class, 'pengajuan_id', 'id')
            ->where('jenis_pengajuan', 'pengajuan_sppd');
    }
}
