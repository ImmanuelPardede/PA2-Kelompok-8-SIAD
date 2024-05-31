<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donatur', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('nama_donatur');
            $table->string('email_donatur')->unique();
            $table->date('tanggal_donatur');
            $table->string('no_hp_donatur')->nullable();
            $table->string('deskripsi')->nullable();
            $table->bigInteger('jumlah_donasi')->nullable();
            $table->string('foto_donatur');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasi');
    }
};

