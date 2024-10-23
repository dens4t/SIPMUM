<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';
    protected $guarded = [];
    use HasFactory;
    protected $appends = ['tanggal'];
    protected $casts = [
        'dokumentasi_kegiatan' => 'array',
    ];
    public function getTanggalAttribute()
    {
        return ($this->tanggal_awal_kegiatan . ' - ' . $this->tanggal_akhir_kegiatan);
    }
}
