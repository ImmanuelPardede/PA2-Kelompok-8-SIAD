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
        Schema::create('orang_tua_wali', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anak_id');
            $table->unsignedBigInteger('agama_id')->nullable();

            $table->string('nama_ibu')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nik_ayah', 16)->nullable();
            $table->string('nik_ibu', 16)->nullable();

            $table->date('tanggal_lahir_ayah')->nullable();
            $table->date('tanggal_lahir_ibu')->nullable();
            $table->string('alamat_orangtua')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->unsignedBigInteger('pekerjaan_ayah_id')->nullable();
            $table->string('no_hp_ayah', 15)->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->unsignedBigInteger('pekerjaan_ibu_id')->nullable();
            $table->string('no_hp_ibu', 15)->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('alamat_wali')->nullable();
            $table->unsignedBigInteger('pekerjaan_wali_id')->nullable();
            $table->date('tanggal_lahir_wali')->nullable();
            $table->timestamps();


            $table->foreign('anak_id')->references('id')->on('anak');
            $table->foreign('agama_id')->references('id')->on('agama');
            $table->foreign('pekerjaan_ayah_id')->references('id')->on('pekerjaan');
            $table->foreign('pekerjaan_ibu_id')->references('id')->on('pekerjaan');
            $table->foreign('pekerjaan_wali_id')->references('id')->on('pekerjaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orang_tua_wali');
    }
};
