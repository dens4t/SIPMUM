<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bagian extends Model
{
    protected $table = 'bagian';
    protected $guarded = [];
    protected $appends = ['nama_lengkap'];
    public function getNamaLengkapAttribute()
    {
        return Str::ucfirst($this->jenis) . ' ' . $this->nama;
    }
    use HasFactory;
}
