<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function approval(): BelongsTo
    {
        return $this->belongsTo(PengajuanApproval::class, 'id', 'pengajuan_id')
            ->where('jenis_pengajuan', self::JENIS_PENGAJUAN);
    }

    public function getTanggalAttribute()
    {
        return $this->tanggal_awal_kegiatan.' - '.$this->tanggal_akhir_kegiatan;
    }
}
