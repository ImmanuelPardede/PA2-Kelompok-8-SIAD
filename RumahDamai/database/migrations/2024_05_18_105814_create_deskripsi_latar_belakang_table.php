<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('deskripsi_latar_belakang', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('latar_belakang_id');
            $table->text('deskripsi');
            $table->timestamps();

            $table->foreign('latar_belakang_id')->references('id')->on('latar_belakang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deskripsi_latar_belakang');
    }
};
