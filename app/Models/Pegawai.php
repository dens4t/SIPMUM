<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $guarded = [];
    use HasFactory;
    protected $casts = [
        'profile' => 'array'
    ];

    public function jabatan()
    {
        return $this->hasOne(Jabatan::class, 'id', 'id_jabatan');
    }

    public function getNamaUnitAttribute()
    {
        return ($this->nama . ' (' . $this->unit->nama_lengkap . ")");
    }

    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'id_unit');
    }

    public function bagian()
    {
        return $this->hasOne(Bagian::class, 'id', 'id_bagian');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id_pegawai');
    }

    public function bawahan()
    {
        return $this->hasMany(Pegawai::class, 'id_atasan', 'id');
    }

    public function dossier_pegawai()
    {
        return $this->belongsTo(DossierPegawai::class, 'id', 'id_pegawai');
    }

    public function pendidikan_terakhir()
    {
        return $this->hasOne(PendidikanTerakhir::class, 'id', 'id_pendidikan_terakhir');
    }
}
