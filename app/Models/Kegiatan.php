<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';

    protected $guarded = [];

    use HasFactory;

    protected $appends = ['tanggal'];

    protected $casts = [
        'dokumentasi_kegiatan' => 'array',
    ];

    public const JENIS_PENGAJUAN = 'kegiatan';

    public function pegawai()
    {
        return $this->hasOne(Pegawai::class, 'id', 'id_pegawai');
    }

    public function approval(): HasOne
    {
        return $this->hasOne(PengajuanApproval::class, 'pengajuan_id', 'id')
            ->where('jenis_pengajuan', self::JENIS_PENGAJUAN);
    }

    public function getTanggalAttribute()
    {
        return $this->tanggal_awal_kegiatan.' - '.$this->tanggal_akhir_kegiatan;
    }
}
