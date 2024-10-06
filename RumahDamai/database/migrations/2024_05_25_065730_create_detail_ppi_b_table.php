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
        Schema::create('detail_ppi_b', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ppiB_id');
            $table->string('file_ppi_b');
            $table->string('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('ppiB_id')->references('id')->on('ppi_model_b')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_ppi_b');
    }
};
