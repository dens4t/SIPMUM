<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->addIndexIfMissing('guest_page', 'active');
        $this->addIndexIfMissing('guest_page', 'slug');

        $this->addIndexIfMissing('pengajuan_sppd', 'jenis_sppd');
        $this->addIndexIfMissing('pengajuan_sppd', 'jenis_angkutan');
        $this->addIndexIfMissing('pengajuan_sppd', 'tanggal_awal_kegiatan');

        $this->addIndexIfMissing('pengajuan_kendaraan_dinas', 'tanggal_peminjaman');

        $this->addIndexIfMissing('pengajuan_rapat_konsumsi', 'tanggal_waktu_mulai');
        $this->addIndexIfMissing('pengajuan_rapat_konsumsi', 'metode');

        $this->addIndexIfMissing('nomor_surat', 'kode_surat');
        $this->addIndexIfMissing('nomor_surat', 'created_at');

        $this->addIndexIfMissing('kota', 'nama');
        $this->addIndexIfMissing('jabatan', 'nama');
        $this->addIndexIfMissing('bagian', 'nama');
    }

    public function down(): void
    {
        $this->dropIndexIfExists('guest_page', 'active');
        $this->dropIndexIfExists('guest_page', 'slug');

        $this->dropIndexIfExists('pengajuan_sppd', 'jenis_sppd');
        $this->dropIndexIfExists('pengajuan_sppd', 'jenis_angkutan');
        $this->dropIndexIfExists('pengajuan_sppd', 'tanggal_awal_kegiatan');

        $this->dropIndexIfExists('pengajuan_kendaraan_dinas', 'tanggal_peminjaman');

        $this->dropIndexIfExists('pengajuan_rapat_konsumsi', 'tanggal_waktu_mulai');
        $this->dropIndexIfExists('pengajuan_rapat_konsumsi', 'metode');

        $this->dropIndexIfExists('nomor_surat', 'kode_surat');
        $this->dropIndexIfExists('nomor_surat', 'created_at');

        $this->dropIndexIfExists('kota', 'nama');
        $this->dropIndexIfExists('jabatan', 'nama');
        $this->dropIndexIfExists('bagian', 'nama');
    }

    private function addIndexIfMissing(string $tableName, string $column): void
    {
        if (!Schema::hasTable($tableName) || !Schema::hasColumn($tableName, $column)) {
            return;
        }

        $indexName = $this->buildIndexName($tableName, $column);
        if ($this->hasIndex($tableName, $indexName)) {
            return;
        }

        Schema::table($tableName, function (Blueprint $table) use ($column, $indexName) {
            $table->index($column, $indexName);
        });
    }

    private function dropIndexIfExists(string $tableName, string $column): void
    {
        if (!Schema::hasTable($tableName)) {
            return;
        }

        $indexName = $this->buildIndexName($tableName, $column);
        if (!$this->hasIndex($tableName, $indexName)) {
            return;
        }

        Schema::table($tableName, function (Blueprint $table) use ($indexName) {
            $table->dropIndex($indexName);
        });
    }

    private function hasIndex(string $tableName, string $indexName): bool
    {
        $databaseName = DB::getDatabaseName();

        $result = DB::selectOne(
            'SELECT COUNT(*) AS total FROM information_schema.statistics WHERE table_schema = ? AND table_name = ? AND index_name = ?',
            [$databaseName, $tableName, $indexName]
        );

        return $result !== null && (int) $result->total > 0;
    }

    private function buildIndexName(string $tableName, string $column): string
    {
        return $tableName.'_'.$column.'_index';
    }
};
