<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class PengajuanRapatKonsumsi extends Model
{
    protected $table = 'pengajuan_rapat_konsumsi';

    protected $guarded = [];

    use HasFactory;

    public function pegawai()
    {
        return $this->hasOne(Pegawai::class, 'id', 'id_pegawai');
    }

    public function getJudulJenisKonsumsiAttribute()
    {
        return Str::upper($this->jenis_konsumsi).' '.$this->nama;
    }

    public function approval(): HasOne
    {
        return $this->hasOne(PengajuanApproval::class, 'pengajuan_id', 'id')
            ->where('jenis_pengajuan', 'pengajuan_rapat_konsumsi');
    }
}
