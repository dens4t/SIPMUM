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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('NIP');
            $table->string('nama');
            $table->enum('jenis_kelamin', array('L','P'))->default('L');
            $table->string('no_ktp')->nullable();
            $table->string('no_npwp')->nullable();
            $table->string('email')->nullable();
            $table->string('alamat_lengkap')->nullable();
            $table->string('kota')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('keterangan_pegawai')->nullable();
            $table->string('person_grade')->nullable();
            $table->string('position_grade')->nullable();
            $table->string('jenjang_jabatan')->nullable();
            $table->date('tanggal_grade')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->string('profile')->nullable();

            $table->bigInteger('id_pendidikan_terakhir')->unsigned()->nullable();
            $table->foreign('id_pendidikan_terakhir')->references('id')->on('pendidikan_terakhir')->cascadeOnUpdate()->nullOnDelete();

            $table->bigInteger('id_jabatan')->unsigned()->nullable();
            $table->foreign('id_jabatan')->references('id')->on('jabatan')->cascadeOnUpdate()->nullOnDelete();

            $table->bigInteger('id_bagian')->unsigned()->nullable();
            $table->foreign('id_bagian')->references('id')->on('bagian')->cascadeOnUpdate()->nullOnDelete();

            $table->bigInteger('id_unit')->unsigned()->nullable();
            $table->foreign('id_unit')->references('id')->on('unit')->cascadeOnUpdate()->nullOnDelete();

            $table->string('jabatan_lengkap')->nullable();

            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_calon_pegawai')->nullable();
            $table->date('tanggal_pegawai')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->date('tanggal_berakhir_kerja')->nullable();
            $table->date('tanggal_pensiun_normal')->nullable();
            $table->string('no_hp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
