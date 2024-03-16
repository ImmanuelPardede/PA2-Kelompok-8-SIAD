<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnakTable extends Migration
{
    public function up()
    {
        Schema::create('anak', function (Blueprint $table) {
            $table->id();
            $table->string('foto_profil')->nullable();
            $table->string('nama_lengkap')->nullable();

            $table->unsignedBigInteger('agama_id')->nullable();
            $table->unsignedBigInteger('jenis_kelamin_id')->nullable();
            $table->unsignedBigInteger('golongan_darah_id')->nullable();
            $table->unsignedBigInteger('kebutuhan_id')->nullable();
            $table->unsignedBigInteger('penyakit_id')->nullable();

            $table->string('tempat_lahir')->nullable(); 
            $table->date('tanggal_lahir')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->dateTime('tanggal_keluar')->nullable();
            $table->string('disukai')->nullable();
            $table->string('tidak_disukai')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kelebihan')->nullable();
            $table->string('kekurangan')->nullable();
            $table->timestamps();

            $table->foreign('agama_id')->references('id')->on('agama');
            $table->foreign('penyakit_id')->references('id')->on('penyakit');
            $table->foreign('jenis_kelamin_id')->references('id')->on('jenis_kelamin');
            $table->foreign('kebutuhan_id')->references('id')->on('kebutuhan');
            $table->foreign('golongan_darah_id')->references('id')->on('golongan_darah');
        });
    }


    public function down()
    {
        Schema::dropIfExists('anak');
    }
}
