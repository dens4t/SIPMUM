<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanRapatKonsumsi extends Model
{
    protected $table = 'pengajuan_rapat_konsumsi';
    protected $guarded = [];
    use HasFactory;

    public function pegawai(){
        return $this->hasOne(Pegawai::class, 'id','id_pegawai');
    }
}
