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
        Schema::create('sponsor', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('nama_sponsor');
            $table->string('email_sponsor')->unique();
            $table->date('tanggal_sponsor');
            $table->string('no_telepon_sponsor')->nullable();
            $table->string('deskripsi')->nullable();
            $table->bigInteger  ('jumlah_sponsor')->nullable();
            $table->string('foto_sponsor');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsorship');
    }
};

