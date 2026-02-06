<?php

namespace Database\Seeders;

use App\Models\Approver;
use App\Models\Driver;
use App\Models\Kegiatan;
use App\Models\Kendaraan;
use App\Models\Kota;
use App\Models\NomorSurat;
use App\Models\Pegawai;
use App\Models\PengajuanApproval;
use App\Models\PengajuanKendaraanDinas;
use App\Models\PengajuanRapatKonsumsi;
use App\Models\PengajuanSPPD;
use App\Services\ApproverService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendingPengajuanStaffSeeder extends Seeder
{
    private const TOTAL_PER_MODULE = 10;

    private const STAFF_SAMPLE_SIZE = 2;

    private const MARKER = '[SEED-PENDING-STAFF]';

    private const KEGIATAN_REAL = [
        'Briefing Operasi Harian Unit',
        'Rapat Koordinasi Pemeliharaan Mesin',
        'Evaluasi Kinerja Mingguan Pembangkitan',
        'Sosialisasi Keselamatan K3L',
        'Monitoring Rencana Pengadaan Material',
        'Review Realisasi Anggaran Operasional',
        'Pelatihan Internal Prosedur Operasi',
        'Rapat Tindak Lanjut Temuan Audit',
        'Koordinasi Persiapan Outage',
        'Forum Komunikasi Tim Operasi dan HAR',
    ];

    public function run(): void
    {
        $staffPool = $this->getStaffUnderTeamLeader()->take(self::STAFF_SAMPLE_SIZE)->values();

        if ($staffPool->isEmpty()) {
            $this->command?->warn('Tidak ada pegawai staff di bawah Team Leader. Seeder dibatalkan.');

            return;
        }

        [$driverId, $kendaraanId, $kotaAsalId, $kotaTujuanId] = $this->prepareDependencies();

        $summary = [];

        DB::transaction(function () use ($staffPool, $driverId, $kendaraanId, $kotaAsalId, $kotaTujuanId, &$summary) {
            $this->resetSeededData();

            for ($i = 1; $i <= self::TOTAL_PER_MODULE; $i++) {
                $pegawai = $staffPool[($i - 1) % $staffPool->count()];
                $this->initSummaryRow($summary, $pegawai);

                $this->seedKegiatan($pegawai, $i, $summary);
                $this->seedNomorSuratPending($pegawai, $i, $summary);
                $this->seedKendaraanDinasPending($pegawai, $i, $driverId, $kendaraanId, $summary);
                $this->seedRapatKonsumsiPending($pegawai, $i, $summary);
                $this->seedSppdPending($pegawai, $i, $kotaAsalId, $kotaTujuanId, $summary);
            }
        });

        $this->printSummary($summary);
    }

    private function resetSeededData(): void
    {
        $kegiatanIds = Kegiatan::query()
            ->where('tempat', 'UPDK Kapuas (Seeder)')
            ->pluck('id');

        $nomorSuratIds = NomorSurat::query()
            ->where('perihal', 'like', '%'.self::MARKER.'%')
            ->pluck('id');

        $kendaraanIds = PengajuanKendaraanDinas::query()
            ->where('keperluan', 'like', '%'.self::MARKER.'%')
            ->pluck('id');

        $rapatIds = PengajuanRapatKonsumsi::query()
            ->where('judul_rapat', 'like', '%'.self::MARKER.'%')
            ->pluck('id');

        $sppdIds = PengajuanSPPD::query()
            ->where('judul_kegiatan', 'like', '%'.self::MARKER.'%')
            ->pluck('id');

        if ($nomorSuratIds->isNotEmpty()) {
            PengajuanApproval::query()
                ->where('jenis_pengajuan', 'nomor_surat')
                ->whereIn('pengajuan_id', $nomorSuratIds)
                ->delete();
        }

        if ($kendaraanIds->isNotEmpty()) {
            PengajuanApproval::query()
                ->where('jenis_pengajuan', 'pengajuan_kendaraan_dinas')
                ->whereIn('pengajuan_id', $kendaraanIds)
                ->delete();
        }

        if ($rapatIds->isNotEmpty()) {
            PengajuanApproval::query()
                ->where('jenis_pengajuan', 'pengajuan_rapat_konsumsi')
                ->whereIn('pengajuan_id', $rapatIds)
                ->delete();
        }

        if ($sppdIds->isNotEmpty()) {
            PengajuanApproval::query()
                ->where('jenis_pengajuan', 'pengajuan_sppd')
                ->whereIn('pengajuan_id', $sppdIds)
                ->delete();
        }

        if ($kegiatanIds->isNotEmpty()) {
            Kegiatan::query()->whereIn('id', $kegiatanIds)->delete();
        }

        if ($nomorSuratIds->isNotEmpty()) {
            NomorSurat::query()->whereIn('id', $nomorSuratIds)->delete();
        }

        if ($kendaraanIds->isNotEmpty()) {
            PengajuanKendaraanDinas::query()->whereIn('id', $kendaraanIds)->delete();
        }

        if ($rapatIds->isNotEmpty()) {
            PengajuanRapatKonsumsi::query()->whereIn('id', $rapatIds)->delete();
        }

        if ($sppdIds->isNotEmpty()) {
            PengajuanSPPD::query()->whereIn('id', $sppdIds)->delete();
        }
    }

    private function getStaffUnderTeamLeader()
    {
        $tlPegawaiIds = Approver::query()
            ->activeNow()
            ->whereHas('category', function ($query) {
                $query->where('nama_kategori', 'like', 'TL %')
                    ->orWhere('nama_kategori', 'like', 'Team Leader %');
            })
            ->pluck('id_pegawai');

        if ($tlPegawaiIds->isEmpty()) {
            return collect();
        }

        $activeApproverPegawaiIds = Approver::query()->activeNow()->pluck('id_pegawai');

        return Pegawai::query()
            ->whereIn('id_atasan', $tlPegawaiIds)
            ->whereNotIn('id', $activeApproverPegawaiIds)
            ->orderBy('nama')
            ->get(['id', 'NIP', 'nama']);
    }

    private function prepareDependencies(): array
    {
        $driverId = Driver::query()->value('id');
        if (!$driverId) {
            $driverId = Driver::query()->insertGetId([
                'nama' => 'Driver Seeder',
                'no_hp' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $kendaraanId = Kendaraan::query()->value('id');
        if (!$kendaraanId) {
            $kendaraanId = Kendaraan::query()->insertGetId([
                'jenis_mobil' => 'Toyota Avanza',
                'nomor_polisi' => 'KB 1001 SE',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $kotaIds = Kota::query()->limit(2)->pluck('id')->values();
        if ($kotaIds->count() < 2) {
            if ($kotaIds->count() === 0) {
                $kotaIds->push(Kota::query()->insertGetId([
                    'nama' => 'Pontianak',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }

            $kotaIds->push(Kota::query()->insertGetId([
                'nama' => 'Ketapang',
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        return [$driverId, $kendaraanId, $kotaIds[0], $kotaIds[1]];
    }

    private function seedKegiatan(Pegawai $pegawai, int $sequence, array &$summary): void
    {
        $nama = self::KEGIATAN_REAL[($sequence - 1) % count(self::KEGIATAN_REAL)];

        Kegiatan::query()->updateOrCreate(
            [
                'nama' => $nama,
                'tempat' => 'UPDK Kapuas (Seeder)',
            ],
            [
                'tanggal_awal_kegiatan' => now()->subDays($sequence + 3)->toDateString(),
                'tanggal_akhir_kegiatan' => now()->subDays($sequence + 2)->toDateString(),
                'tempat' => 'UPDK Kapuas (Seeder)',
                'dokumentasi_kegiatan' => null,
            ]
        );

        $summary[$pegawai->id]['kegiatan']++;
    }

    private function seedNomorSuratPending(Pegawai $pegawai, int $sequence, array &$summary): void
    {
        $record = NomorSurat::query()->updateOrCreate(
            [
                'id_pegawai' => $pegawai->id,
                'perihal' => sprintf('Permohonan Nomor Surat %02d %s', $sequence, self::MARKER),
            ],
            [
                'kode_surat' => 'SKT',
                'kode_klasifikasi' => 'SDM.15.01',
                'kode_unit' => 'UPKS',
                'tanggal' => now()->subDays($sequence)->toDateString(),
            ]
        );

        $this->ensurePendingApproval('nomor_surat', $record->id, $pegawai->id);
        $summary[$pegawai->id]['nomor_surat']++;
    }

    private function seedKendaraanDinasPending(Pegawai $pegawai, int $sequence, int $driverId, int $kendaraanId, array &$summary): void
    {
        $record = PengajuanKendaraanDinas::query()->updateOrCreate(
            [
                'id_pegawai' => $pegawai->id,
                'keperluan' => sprintf('Keperluan Kendaraan Dinas %02d %s', $sequence, self::MARKER),
            ],
            [
                'tanggal_peminjaman' => now()->addDays($sequence)->toDateString(),
                'tanggal_pengembalian' => now()->addDays($sequence + 1)->toDateString(),
                'tujuan' => 'Lokasi kerja UPDK Kapuas',
                'id_driver' => $driverId,
                'id_kendaraan' => $kendaraanId,
                'stand_km_awal' => (string) (12000 + $sequence * 10),
            ]
        );

        $this->ensurePendingApproval('pengajuan_kendaraan_dinas', $record->id, $pegawai->id);
        $summary[$pegawai->id]['kendaraan_dinas']++;
    }

    private function seedRapatKonsumsiPending(Pegawai $pegawai, int $sequence, array &$summary): void
    {
        $mulai = now()->addDays($sequence)->setTime(9, 0);
        $selesai = now()->addDays($sequence)->setTime(11, 0);

        $record = PengajuanRapatKonsumsi::query()->updateOrCreate(
            [
                'id_pegawai' => $pegawai->id,
                'judul_rapat' => sprintf('Rapat Konsumsi Staff %02d %s', $sequence, self::MARKER),
            ],
            [
                'tanggal_waktu_mulai' => $mulai,
                'tanggal_waktu_selesai' => $selesai,
                'jumlah_peserta_rapat' => 12 + $sequence,
                'metode' => 'offline',
                'ruang' => 'upks',
                'jenis_konsumsi' => 'snack_minum',
                'surat_undangan_rapat' => sprintf('%s-rapat-%02d.pdf', self::MARKER, $sequence),
            ]
        );

        $this->ensurePendingApproval('pengajuan_rapat_konsumsi', $record->id, $pegawai->id);
        $summary[$pegawai->id]['rapat_konsumsi']++;
    }

    private function seedSppdPending(Pegawai $pegawai, int $sequence, int $kotaAsalId, int $kotaTujuanId, array &$summary): void
    {
        $record = PengajuanSPPD::query()->updateOrCreate(
            [
                'id_pegawai' => $pegawai->id,
                'judul_kegiatan' => sprintf('Perjalanan Dinas SPPD %02d %s', $sequence, self::MARKER),
            ],
            [
                'jenis_sppd' => 'non_diklat',
                'tanggal_awal_kegiatan' => now()->addDays($sequence + 2)->toDateString(),
                'tanggal_akhir_kegiatan' => now()->addDays($sequence + 4)->toDateString(),
                'nomor_prk' => sprintf('PRK-%04d', 5000 + $sequence),
                'nomor_pembebanan' => sprintf('PB-%04d', 7000 + $sequence),
                'jenis_angkutan' => 'kendaraan_dinas',
                'id_kota_asal' => $kotaAsalId,
                'id_kota_tujuan' => $kotaTujuanId,
                'surat_undangan_penugasan' => sprintf('%s-sppd-%02d.pdf', self::MARKER, $sequence),
            ]
        );

        $this->ensurePendingApproval('pengajuan_sppd', $record->id, $pegawai->id);
        $summary[$pegawai->id]['pengajuan_sppd']++;
    }

    private function ensurePendingApproval(string $jenis, int $pengajuanId, int $idPegawai): void
    {
        $existing = PengajuanApproval::query()
            ->where('jenis_pengajuan', $jenis)
            ->where('pengajuan_id', $pengajuanId)
            ->first();

        if ($existing) {
            $existing->update([
                'status' => 'pending',
                'catatan' => null,
                'approved_at' => null,
                'rejected_at' => null,
            ]);

            return;
        }

        $approval = app(ApproverService::class)->assignApproverToPengajuan($jenis, $pengajuanId, $idPegawai);

        if (!$approval) {
            $this->command?->warn("Approver tidak ditemukan untuk {$jenis} pengajuan #{$pengajuanId} (pegawai {$idPegawai}).");
        }
    }

    private function initSummaryRow(array &$summary, Pegawai $pegawai): void
    {
        if (isset($summary[$pegawai->id])) {
            return;
        }

        $summary[$pegawai->id] = [
            'id_pegawai' => $pegawai->NIP ?: (string) $pegawai->id,
            'nama_pegawai' => $pegawai->nama,
            'jenis' => 'Staff (Bawahan TL)',
            'kegiatan' => 0,
            'nomor_surat' => 0,
            'kendaraan_dinas' => 0,
            'rapat_konsumsi' => 0,
            'pengajuan_sppd' => 0,
        ];
    }

    private function printSummary(array $summary): void
    {
        $rows = collect($summary)
            ->sortBy('nama_pegawai')
            ->map(function (array $row) {
                return [
                    'ID Pegawai' => $row['id_pegawai'],
                    'Nama Pegawai' => $row['nama_pegawai'],
                    'Jenis' => $row['jenis'],
                    'Jumlah Kegiatan' => $row['kegiatan'],
                    'Jumlah Nomor Surat' => $row['nomor_surat'],
                    'Jumlah Kendaraan Dinas' => $row['kendaraan_dinas'],
                    'Jumlah Rapat Konsumsi' => $row['rapat_konsumsi'],
                    'Jumlah Pengajuan SPPD' => $row['pengajuan_sppd'],
                ];
            })
            ->values()
            ->all();

        $this->command?->info('Summary Seeder Pending Pengajuan Staff Bawahan TL');
        $this->command?->table([
            'ID Pegawai',
            'Nama Pegawai',
            'Jenis',
            'Jumlah Kegiatan',
            'Jumlah Nomor Surat',
            'Jumlah Kendaraan Dinas',
            'Jumlah Rapat Konsumsi',
            'Jumlah Pengajuan SPPD',
        ], $rows);
    }
}
