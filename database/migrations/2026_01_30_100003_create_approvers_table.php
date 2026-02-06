<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('approvers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pegawai');
            $table->unsignedBigInteger('id_approver_category');
            $table->unsignedBigInteger('id_atasan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps();

            $table->index('id_pegawai');
            $table->index('id_approver_category');
            $table->index('id_atasan');
            $table->unique(['id_pegawai', 'id_approver_category']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('approvers');
    }
};
