<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSilabusTable extends Migration
{
    public function up()
    {
        Schema::create('silabus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tahun_kurikulum_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('user_id');
            $table->string('deskripsi', 2000);
            $table->string('hasil_kursus');
            $table->string('tipe_pembelajaran');
            $table->string('penilaian');
            $table->string('konten_kursus');
            $table->string('buku_pegangan_dan_referensi');
            $table->string('alat');
            $table->timestamps();

            $table->foreign('tahun_kurikulum_id')->references('id')->on('tahun_kurikulum')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('silabus');
    }
}
