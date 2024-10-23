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
        Schema::create('data_unit_pembangkit', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_urut');
            $table->string('mesin');
            $table->string('tipe');
            $table->string('nomor_seri');
            $table->integer('daya_terpasang');
            $table->integer('daya_mampu');
            $table->string('lokasi_unit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_unit_pembangkit');
    }
};
