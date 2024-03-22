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
            $table->id();
            $table->unsignedBigInteger('donasi_id')->nullable();
            $table->string('nama_donatur')->nullable();
            $table->string('email_donatur')->nullable()->unique();
            $table->string('no_hp_donatur')->nullable();
            $table->string('jumlah_donasi')->nullable();
            $table->string('foto_donatur')->nullable();
            $table->timestamps();

            $table->foreign('donasi_id')->references('id')->on('donasi')->onDelete('cascade')->onUpdate('cascade');
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

