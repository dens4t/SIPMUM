<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PengajuanRapatKonsumsi extends Model
{
    protected $table = 'pengajuan_rapat_konsumsi';
    protected $guarded = [];
    use HasFactory;

    public function pegawai(){
        return $this->hasOne(Pegawai::class, 'id','id_pegawai');
    }
    public function getJudulJenisKonsumsiAttribute()
    {
        return Str::upper($this->jenis_konsumsi) . ' ' . $this->nama;
    }
}
