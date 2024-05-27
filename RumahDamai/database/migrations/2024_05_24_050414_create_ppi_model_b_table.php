<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ppi_model_b', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('anak_id');
            $table->unsignedInteger('user_id');
            $table->string('file_ppi_b');
            $table->string('deskripsi');
            $table->timestamps();

            $table->foreign('anak_id')->references('id')->on('anak')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ppi_model_b');
    }
};
