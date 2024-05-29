<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSilabusTable extends Migration
{
    public function up()
    {
        Schema::create('silabus', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tahun_kurikulum_id');
            $table->unsignedInteger('kelas_id');
            $table->unsignedInteger('user_id');
            $table->text('deskripsi')->nullable();
            $table->text('hasil_kursus')->nullable();
            $table->text('tipe_pembelajaran')->nullable();
            $table->text('penilaian')->nullable();
            $table->text('konten_kursus')->nullable();
            $table->text('buku_pegangan_dan_referensi')->nullable();
            $table->text('alat')->nullable();
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
