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
        Schema::create('t_jenis_tanah', function (Blueprint $table) {
            $table->id();
            $table->char('id_kota', 4);
            $table->unsignedInteger('id_jenis_tanah');
            $table->double('luas');

            $table->foreign('id_kota')->references('id')->on('regencies');
            $table->foreign('id_jenis_tanah')->references('id')->on('jenis__tanahs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_jenis_tanah');
    }
};
