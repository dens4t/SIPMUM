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
        Schema::create('dossier_pegawai', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pegawai')->unsigned()->nullable();
            $table->foreign('id_pegawai')->references('id')->on('pegawai')->cascadeOnUpdate()->nullOnDelete();

            $table->string('sk_pengangkatan')->nullable();
            $table->string('sk_talenta')->nullable();
            $table->string('sk_pembinaan_grade')->nullable();
            $table->string('sk_mutasi_rotasi')->nullable();
            $table->string('data_keluarga')->nullable();
            $table->string('data_sertifikasi_kompetensi_dan_pelatihan')->nullable();
            $table->string('data_pendidikan_terakhir')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossier_pegawai');
    }
};
