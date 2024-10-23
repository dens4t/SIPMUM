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
        Schema::create('pengajuan_kendaraan_dinas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pegawai')->unsigned()->nullable();
            $table->foreign('id_pegawai')->references('id')->on('pegawai')->cascadeOnUpdate()->nullOnDelete();

            $table->date('tanggal_peminjaman');
            $table->date('tanggal_pengembalian');
            $table->string('keperluan');
            $table->string('tujuan');

            $table->bigInteger('id_driver')->unsigned()->nullable();
            $table->foreign('id_driver')->references('id')->on('driver')->cascadeOnUpdate()->nullOnDelete();

            $table->bigInteger('id_kendaraan')->unsigned()->nullable();
            $table->foreign('id_kendaraan')->references('id')->on('kendaraan')->cascadeOnUpdate()->nullOnDelete();

            $table->string('stand_km_awal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_kendaraan_dinas');
    }
};
