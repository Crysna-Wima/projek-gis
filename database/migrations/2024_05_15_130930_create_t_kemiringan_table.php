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
        Schema::create('t_kemiringan', function (Blueprint $table) {
            $table->id();
            $table->char('id_kota', 4);
            $table->unsignedInteger('id_kemiringan_wilayah');
            $table->double('luas');

            $table->foreign('id_kota')->references('id')->on('regencies');
            $table->foreign('id_kemiringan_wilayah')->references('id')->on('kemiringan__wilayahs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_kemiringan');
    }
};
