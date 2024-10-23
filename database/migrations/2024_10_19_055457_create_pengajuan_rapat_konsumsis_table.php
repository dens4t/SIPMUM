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
        Schema::create('pengajuan_rapat_konsumsi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pegawai')->unsigned()->nullable();
            $table->foreign('id_pegawai')->references('id')->on('pegawai')->cascadeOnUpdate()->nullOnDelete();

            $table->string('judul_rapat');
            $table->datetime('tanggal_waktu_mulai');
            $table->datetime('tanggal_waktu_selesai');
            $table->integer('jumlah_peserta_rapat');
            $table->enum('metode', array('offline','online'));
            $table->enum('ruang', array('upks','baca'));
            $table->enum('jenis_konsumsi', array('snack_minum','snack_minum_makan','makan_minum'));
            $table->string('surat_undangan_rapat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_rapat_konsumsi');
    }
};
