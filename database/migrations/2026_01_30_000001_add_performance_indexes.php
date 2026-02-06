<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->addIndexIfMissing('pegawai', 'id_unit');
        $this->addIndexIfMissing('pegawai', 'id_jabatan');
        $this->addIndexIfMissing('pegawai', 'id_bagian');
        $this->addIndexIfMissing('pegawai', 'id_pendidikan_terakhir');

        $this->addIndexIfMissing('pengajuan_sppd', 'id_pegawai');
        $this->addIndexIfMissing('pengajuan_sppd', 'id_kota_asal');
        $this->addIndexIfMissing('pengajuan_sppd', 'id_kota_tujuan');

        $this->addIndexIfMissing('pengajuan_kendaraan_dinas', 'id_pegawai');
        $this->addIndexIfMissing('pengajuan_kendaraan_dinas', 'id_driver');
        $this->addIndexIfMissing('pengajuan_kendaraan_dinas', 'id_kendaraan');

        $this->addIndexIfMissing('pengajuan_rapat_konsumsi', 'id_pegawai');
        $this->addIndexIfMissing('dossier_pegawai', 'id_pegawai');
        $this->addIndexIfMissing('nomor_surat', 'id_pegawai');
        $this->addIndexIfMissing('unit', 'nama');
    }

    public function down(): void
    {
        $this->dropIndexIfExists('pegawai', 'id_unit');
        $this->dropIndexIfExists('pegawai', 'id_jabatan');
        $this->dropIndexIfExists('pegawai', 'id_bagian');
        $this->dropIndexIfExists('pegawai', 'id_pendidikan_terakhir');

        $this->dropIndexIfExists('pengajuan_sppd', 'id_pegawai');
        $this->dropIndexIfExists('pengajuan_sppd', 'id_kota_asal');
        $this->dropIndexIfExists('pengajuan_sppd', 'id_kota_tujuan');

        $this->dropIndexIfExists('pengajuan_kendaraan_dinas', 'id_pegawai');
        $this->dropIndexIfExists('pengajuan_kendaraan_dinas', 'id_driver');
        $this->dropIndexIfExists('pengajuan_kendaraan_dinas', 'id_kendaraan');

        $this->dropIndexIfExists('pengajuan_rapat_konsumsi', 'id_pegawai');
        $this->dropIndexIfExists('dossier_pegawai', 'id_pegawai');
        $this->dropIndexIfExists('nomor_surat', 'id_pegawai');
        $this->dropIndexIfExists('unit', 'nama');
    }

    private function addIndexIfMissing(string $tableName, string $column): void
    {
        if (!Schema::hasTable($tableName) || !$this->hasColumn($tableName, $column)) {
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

    private function hasColumn(string $tableName, string $column): bool
    {
        return Schema::hasColumn($tableName, $column);
    }

    private function buildIndexName(string $tableName, string $column): string
    {
        return $tableName.'_'.$column.'_index';
    }
};
