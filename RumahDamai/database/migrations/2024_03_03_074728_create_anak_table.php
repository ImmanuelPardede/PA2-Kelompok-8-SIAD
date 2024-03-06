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
        $table->string('namaLengkap');
        $table->bigInteger('agama_id')->unsigned(); // Tambahkan unsigned() di sini
        $table->bigInteger('jenis_kelamin_id')->unsigned(); // Tambahkan unsigned() di sini
        $table->bigInteger('golongan_darah_id')->unsigned(); // Tambahkan unsigned() di sini
        $table->bigInteger('kebutuhan_id')->unsigned(); // Tambahkan unsigned() di sini
        $table->string('tempatLahir');
        $table->date('tanggalLahir');
        
        //Baru
        $table->string('nama_ibu')->nullable();
        $table->string('nama_ayah')->nullable();
        $table->string('nama_wali')->nullable();
        $table->string('foto_profile')->nullable();
        $table->string('disukai')->nullable();
        $table->string('tidak_disukai')->nullable();
        $table->string('alamat')->nullable();
        $table->string('kelebihan')->nullable();
        $table->string('kekurangan')->nullable();
        
        $table->timestamps();

        // Tambahkan foreign key constraints
        $table->foreign('agama_id')->references('id')->on('agama');
        $table->foreign('jenis_kelamin_id')->references('id')->on('jenis_kelamin');
        $table->foreign('golongan_darah_id')->references('id')->on('golongan_darah');
        $table->foreign('kebutuhan_id')->references('id')->on('kebutuhan');


        
    });
}


    public function down()
    {
        Schema::dropIfExists('anak');
    }
}
