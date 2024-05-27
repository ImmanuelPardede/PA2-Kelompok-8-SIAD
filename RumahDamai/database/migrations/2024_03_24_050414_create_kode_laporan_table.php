<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kode_laporan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode')->unique();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('kode_laporan');
    }
};
