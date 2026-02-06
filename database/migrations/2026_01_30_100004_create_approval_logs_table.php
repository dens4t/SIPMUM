<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('approval_logs', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_pengajuan', 100);
            $table->unsignedBigInteger('pengajuan_id');
            $table->unsignedBigInteger('id_approver');
            $table->unsignedBigInteger('id_pegawai');
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->text('catatan')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();

            $table->foreign('id_approver')->references('id')->on('approvers')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('id_pegawai')->references('id')->on('pegawai')->cascadeOnUpdate()->restrictOnDelete();

            $table->index(['jenis_pengajuan', 'pengajuan_id']);
            $table->index('id_approver');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('approval_logs');
    }
};
