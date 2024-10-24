<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Unit extends Model
{
    protected $table = 'unit';
    protected $guarded = [];
    use HasFactory;
    protected $appends = ['nama_lengkap'];
    public function getNamaLengkapAttribute()
    {
        return Str::upper($this->jenis) . ' ' . $this->nama;
    }

    public function pegawai(){
        return $this->hasMany(Pegawai::class, 'id','id');
    }
    public function unit_pembangkit(){
        return $this->belongsTo(DataUnitPembangkit::class, 'id','id_unit');
    }
}
