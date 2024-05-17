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
            $table->id();
            $table->unsignedBigInteger('anak_id');
            $table->integer('usia');
            $table->string('kelas');
            $table->date('tanggal');
            $table->text('deskripsi');
            $table->timestamps();

            $table->foreign('anak_id')->references('id')->on('anak')->onDelete('cascade');
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
