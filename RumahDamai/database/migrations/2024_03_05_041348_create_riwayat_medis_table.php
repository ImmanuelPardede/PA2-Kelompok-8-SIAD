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
        Schema::create('riwayat_medis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anak_id');
            $table->foreign('anak_id')->references('id')->on('anak')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('penyakit_id');
            $table->foreign('penyakit_id')->references('id')->on('penyakit')->onDelete('cascade')->onUpdate('cascade');
            $table->string('riwayat_perawatan')->nullable();
            $table->string('riwayat_perilaku')->nullable();
            $table->string('deskripsi_riwayat')->nullable();
            $table->string('kondisi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_medis');
    }
};
