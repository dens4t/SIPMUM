<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DossierPegawai extends Model
{
    protected $table = 'dossier_pegawai';
    protected $guarded = [];
    use HasFactory;
    // protected $appends = ['tanggal'];
    protected $casts = [
        'sk_pengangkatan' => 'array',
        'sk_talenta' => 'array',
        'sk_pembinaan_grade' => 'array',
        'sk_mutasi_rotasi' => 'array',
        'data_keluarga' => 'array',
        'data_sertifikasi_kompetensi_dan_pelatihan' => 'array',
        'data_pendidikan_terakhir' => 'array',
    ];


    public function pegawai(){
        return $this->hasOne(Pegawai::class, 'id','id_pegawai');
    }
}
