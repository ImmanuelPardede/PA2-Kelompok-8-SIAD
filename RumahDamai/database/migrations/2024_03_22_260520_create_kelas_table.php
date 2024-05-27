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
        Schema::create('kelas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_kelas');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('tahun_kurikulum_id');
            $table->unsignedInteger('tahun_ajaran_id');
            $table->unsignedInteger('semester_tahun_ajaran_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tahun_kurikulum_id')->references('id')->on('tahun_kurikulum')->onDelete('cascade');
            $table->foreign('tahun_ajaran_id')->references('id')->on('tahun_ajaran')->onDelete('cascade');
            $table->foreign('semester_tahun_ajaran_id')->references('id')->on('semester_tahun_ajaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
