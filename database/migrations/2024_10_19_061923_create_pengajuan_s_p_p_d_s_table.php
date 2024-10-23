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
        Schema::create('pengajuan_sppd', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pegawai')->unsigned()->nullable();
            $table->foreign('id_pegawai')->references('id')->on('pegawai')->cascadeOnUpdate()->nullOnDelete();

            $table->enum('jenis_sppd',array('diklat','non_diklat'));
            $table->string('judul_kegiatan');
            $table->date('tanggal_awal_kegiatan');
            $table->date('tanggal_akhir_kegiatan');
            $table->string('nomor_prk');
            $table->string('nomor_pembebanan');
            $table->enum('jenis_angkutan', array('pesawat','kereta_api','kapal','kendaraan_dinas','kendaraan_umum'));
            $table->string('kota_asal');
            $table->string('kota_tujuan');
            $table->string('surat_undangan_penugasan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_sppd');
    }
};
