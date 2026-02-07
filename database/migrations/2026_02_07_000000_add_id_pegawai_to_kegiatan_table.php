<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->foreignId('id_pegawai')
                ->nullable()
                ->constrained('pegawai', 'id')
                ->nullOnDelete();
            
            $table->index('id_pegawai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->dropForeign(['id_pegawai']);
            $table->dropIndex(['id_pegawai']);
            $table->dropColumn('id_pegawai');
        });
    }
};
