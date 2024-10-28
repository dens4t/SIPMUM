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
        Schema::create('guest_page', function (Blueprint $table) {
            $table->id();
            $table->integer('order'); //['profil','unit_pembangkit','media']
            $table->string('thumbnail')->nullable();
            $table->string('slug')->unqiue(); //['profil','unit_pembangkit','media']
            $table->string('menu')->nullable(); //['profil','unit_pembangkit','media']
            $table->string('title')->unique();
            $table->boolean('active')->default(true);
            $table->longText('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_page');
    }
};
