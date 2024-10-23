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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Name of the activity (kegiatan)
            $table->date('tanggal_awal_kegiatan'); // Start date of the activity
            $table->date('tanggal_akhir_kegiatan'); // End date of the activity
            $table->string('tempat'); // Place of the activity
            $table->string('dokumentasi_kegiatan')->nullable(); // File path for documentation (can be nullable)
            $table->timestamps(); // Created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
