<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalPembelajaranTable extends Migration
{
    public function up()
    {
        Schema::create('jadwal_pembelajaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelas_id');
            $table->string('nama_materi');
            $table->unsignedBigInteger('tahun_kurikulum_id');
            $table->string('deskripsi', 2000);
            $table->unsignedBigInteger('guru_id');
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('tahun_kurikulum_id')->references('id')->on('tahun_kurikulum')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
