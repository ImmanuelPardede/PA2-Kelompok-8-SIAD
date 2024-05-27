<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('format_laporan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('kode_laporan_id')->unique();
            $table->string('format_laporan');
            $table->string('nama_laporan');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kode_laporan_id')->references('id')->on('kode_laporan')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('format_laporan');
    }
};
