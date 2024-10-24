<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanKendaraanDinas extends Model
{
    protected $table = 'pengajuan_kendaraan_dinas';
    protected $guarded = [];
    use HasFactory;

    public function pegawai(){
        return $this->hasOne(Pegawai::class, 'id','id_pegawai');
    }
    public function driver(){
        return $this->hasOne(Pegawai::class, 'id','id_driver');
    }
    public function kendaraan(){
        return $this->hasOne(Pegawai::class, 'id','id_kendaraan');
    }
}
