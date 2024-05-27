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
        Schema::create('gambar_latar_belakang', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('latar_belakang_id');
            $table->string('nama');
            $table->timestamps();

            $table->foreign('latar_belakang_id')->references('id')->on('latar_belakang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gambar_latar_belakang');
    }
};
