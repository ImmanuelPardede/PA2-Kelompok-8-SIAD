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
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('anak_id');
            $table->unsignedInteger('penyakit_id');
            $table->text('riwayat_perawatan')->nullable();
            $table->text('riwayat_perilaku')->nullable();
            $table->text('deskripsi_riwayat')->nullable();
            $table->text('kondisi');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('anak_id')->references('id')->on('anak')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('penyakit_id')->references('id')->on('penyakit')->onDelete('cascade')->onUpdate('cascade');
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
