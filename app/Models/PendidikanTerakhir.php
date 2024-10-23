<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanTerakhir extends Model
{
    protected $table = 'pendidikan_terakhir';
    protected $guarded = [];
    use HasFactory;

    public function pegawai(){
        return $this->hasMany(Pegawai::class, 'id','id');
    }

}
