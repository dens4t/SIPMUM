<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan_approvers', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_pengajuan', 100);
            $table->unsignedBigInteger('pengajuan_id');
            $table->unsignedBigInteger('id_approver');
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->text('catatan')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamps();

            $table->index(['jenis_pengajuan', 'pengajuan_id']);
            $table->index('id_approver');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_approvers');
    }
};
