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
        Schema::create('raport', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('anak_id');
            $table->unsignedInteger('tahun_ajaran_id');
            $table->unsignedInteger('semester_id',);
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('anak_id')->references('id')->on('anak');
            $table->foreign('tahun_ajaran_id')->references('id')->on('tahun_ajaran');
            $table->foreign('semester_id')->references('id')->on('semester_tahun_ajaran');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raport');
    }
};
