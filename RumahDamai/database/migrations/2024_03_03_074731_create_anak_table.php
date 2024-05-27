<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnakTable extends Migration
{
    public function up()
    {
        Schema::create('anak', function (Blueprint $table) {
            $table->increments('id');
            $table->string('foto_profil')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->unsignedInteger('agama_id')->nullable();
            $table->string('nia')->nullable();
            $table->unsignedInteger('jenis_kelamin_id')->nullable();
            $table->unsignedInteger('golongan_darah_id')->nullable();
            $table->unsignedInteger('kebutuhan_disabilitas_id')->nullable();
            $table->unsignedInteger('lokasi_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('disukai')->nullable();
            $table->text('tidak_disukai')->nullable();
            $table->string('alamat')->nullable();
            $table->text('kelebihan')->nullable();
            $table->text('kekurangan')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->dateTime('tanggal_keluar')->nullable();
            $table->string('status')->default('aktif');
            $table->string('tipe_anak');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('agama_id')->references('id')->on('agama');
            $table->foreign('lokasi_id')->references('id')->on('lokasi_penugasan');
            $table->foreign('jenis_kelamin_id')->references('id')->on('jenis_kelamin');
            $table->foreign('kebutuhan_disabilitas_id')->references('id')->on('kebutuhan_disabilitas');
            $table->foreign('golongan_darah_id')->references('id')->on('golongan_darah');
        });
    }


    public function down()
    {
        Schema::dropIfExists('anak');
    }
}
