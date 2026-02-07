<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NomorSurat extends Model
{
    protected $table = 'nomor_surat';

    protected $guarded = [];

    use HasFactory;

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function approval(): BelongsTo
    {
        return $this->belongsTo(PengajuanApproval::class, 'id', 'pengajuan_id')
            ->where('jenis_pengajuan', 'nomor_surat');
    }
}
