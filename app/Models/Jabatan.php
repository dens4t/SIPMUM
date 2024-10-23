<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Jabatan extends Model
{
    protected $table = 'jabatan';
    protected $guarded = [];
    use HasFactory;

    public function getNamaLengkapAttribute()
    {
        return Str::ucfirst($this->jenis) . ' ' . $this->nama;
    }
}
