<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pegawai')) {
            return;
        }

        if (!Schema::hasColumn('pegawai', 'id_atasan')) {
            Schema::table('pegawai', function (Blueprint $table) {
                $table->unsignedBigInteger('id_atasan')->nullable()->after('id_unit');
            });
        }

        $foreignName = 'pegawai_id_atasan_foreign';
        if (!$this->hasForeignKey('pegawai', $foreignName)) {
            Schema::table('pegawai', function (Blueprint $table) {
                $table->foreign('id_atasan')->references('id')->on('pegawai')->cascadeOnUpdate()->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('pegawai')) {
            return;
        }

        $foreignName = 'pegawai_id_atasan_foreign';
        if ($this->hasForeignKey('pegawai', $foreignName)) {
            Schema::table('pegawai', function (Blueprint $table) {
                $table->dropForeign('pegawai_id_atasan_foreign');
            });
        }

        if (Schema::hasColumn('pegawai', 'id_atasan')) {
            Schema::table('pegawai', function (Blueprint $table) {
                $table->dropColumn('id_atasan');
            });
        }
    }

    private function hasForeignKey(string $tableName, string $constraintName): bool
    {
        $databaseName = DB::getDatabaseName();

        $result = DB::selectOne(
            'SELECT COUNT(*) AS total FROM information_schema.table_constraints WHERE constraint_schema = ? AND table_name = ? AND constraint_name = ? AND constraint_type = ? ',
            [$databaseName, $tableName, $constraintName, 'FOREIGN KEY']
        );

        return $result !== null && (int) $result->total > 0;
    }
};
