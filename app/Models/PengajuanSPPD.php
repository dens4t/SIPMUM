<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSPPD extends Model
{
    protected $table = 'pengajuan_sppd';
    protected $guarded = [];

    use HasFactory;

    public function pegawai(){
        return $this->hasOne(Pegawai::class, 'id','id_pegawai');
    }
    public function kota_asal(){
        return $this->hasOne(Kota::class, 'id','id_kota_asal');
    }

    public function kota_tujuan(){
        return $this->hasOne(Kota::class, 'id','id_kota_tujuan');
    }
    use HasFactory;
}
