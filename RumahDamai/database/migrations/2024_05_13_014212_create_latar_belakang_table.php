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
        Schema::create('latar_belakang', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('anak_id');
            $table->unsignedInteger('user_id');
            $table->integer('usia');
            $table->string('kelas');
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('anak_id')->references('id')->on('anak')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latar_belakang');
    }
};
