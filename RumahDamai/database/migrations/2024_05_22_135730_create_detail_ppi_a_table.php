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
        Schema::create('detail_ppi_a', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ppiA_id');
            $table->text('level_komunikasi');
            $table->text('gambaran_sensorik');
            $table->text('informasi_penting');
            $table->text('kondisi_lain')->nullable();
            $table->text('layanan_lain')->nullable();
            $table->text('tujuan_jangka_panjang');
            $table->text('tujuan_jangka_pendek');
            $table->timestamps();

            $table->foreign('ppiA_id')->references('id')->on('ppi_model_a')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_ppi_a');
    }
};
