<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanKendaraanDinas extends Model
{
    protected $table = 'pengajuan_kendaraan_dinas';

    protected $guarded = [];

    use HasFactory;

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'id_driver');
    }

    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan');
    }

    public function approval(): BelongsTo
    {
        return $this->belongsTo(PengajuanApproval::class, 'id', 'pengajuan_id')
            ->where('jenis_pengajuan', 'pengajuan_kendaraan_dinas');
    }
}
