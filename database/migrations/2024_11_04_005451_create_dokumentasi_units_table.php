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
        Schema::create('dokumentasi_unit', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('foto');

            $table->bigInteger('id_unit')->unsigned()->nullable();
            $table->foreign('id_unit')->references('id')->on('unit')->cascadeOnUpdate()->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumentasi_unit');
    }
};
