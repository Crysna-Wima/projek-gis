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
        Schema::create('t_irigasi', function (Blueprint $table) {
            $table->id();
            $table->char('id_kota', 4);
            $table->year('tahun');
            $table->string('jenis_irigasi');
            $table->double('luas');
            $table->timestamps();

            $table->foreign('id_kota')->references('id')->on('regencies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_irigasi');
    }
};
