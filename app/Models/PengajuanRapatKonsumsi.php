<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class PengajuanRapatKonsumsi extends Model
{
    protected $table = 'pengajuan_rapat_konsumsi';

    protected $guarded = [];

    use HasFactory;

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function getJudulJenisKonsumsiAttribute()
    {
        return Str::upper($this->jenis_konsumsi).' '.$this->nama;
    }

    public function approval(): BelongsTo
    {
        return $this->belongsTo(PengajuanApproval::class, 'id', 'pengajuan_id')
            ->where('jenis_pengajuan', 'pengajuan_rapat_konsumsi');
    }
}
