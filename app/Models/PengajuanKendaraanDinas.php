<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PengajuanKendaraanDinas extends Model
{
    protected $table = 'pengajuan_kendaraan_dinas';

    protected $guarded = [];

    use HasFactory;

    public function pegawai()
    {
        return $this->hasOne(Pegawai::class, 'id', 'id_pegawai');
    }

    public function driver()
    {
        return $this->hasOne(Driver::class, 'id', 'id_driver');
    }

    public function kendaraan()
    {
        return $this->hasOne(Kendaraan::class, 'id', 'id_kendaraan');
    }

    public function approval(): HasOne
    {
        return $this->hasOne(PengajuanApproval::class, 'pengajuan_id', 'id')
            ->where('jenis_pengajuan', 'pengajuan_kendaraan_dinas');
    }
}
