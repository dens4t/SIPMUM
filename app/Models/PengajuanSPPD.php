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
    use HasFactory;
}
