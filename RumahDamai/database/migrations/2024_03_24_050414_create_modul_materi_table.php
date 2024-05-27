<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulMateriTable extends Migration
{
    public function up()
    {
        Schema::create('modul_materi', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kelas_id');
            $table->string('nama_materi');
            $table->unsignedInteger('minggu_pembelajaran_id');
            $table->unsignedInteger('tahun_kurikulum_id');
            $table->unsignedInteger('user_id');
            $table->string('file_modul');
            $table->string('deskripsi', 2000);
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('minggu_pembelajaran_id')->references('id')->on('minggu_pembelajaran')->onDelete('cascade');
            $table->foreign('tahun_kurikulum_id')->references('id')->on('tahun_kurikulum')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
