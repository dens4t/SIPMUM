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
        Schema::create('page_unit', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail');
            $table->longText('content')->nullable();
            $table->string('url_google_map')->nullable();

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
        Schema::dropIfExists('page_unit');
    }
};
