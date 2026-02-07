<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NomorSurat extends Model
{
    protected $table = 'nomor_surat';

    protected $guarded = [];

    use HasFactory;

    // protected $appends = ['nama_lengkap'];

    public function pegawai()
    {
        return $this->hasOne(Pegawai::class, 'id', 'id_pegawai');
    }

    public function approval(): HasOne
    {
        return $this->hasOne(PengajuanApproval::class, 'pengajuan_id', 'id')
            ->where('jenis_pengajuan', 'nomor_surat');
    }
}
