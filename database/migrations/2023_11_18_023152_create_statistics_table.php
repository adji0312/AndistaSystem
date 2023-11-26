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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_booking_id')->nullable();
            $table->foreignId('pet_id')->nullable();
            $table->string('suhu')->nullable();
            $table->string('berat')->nullable();
            $table->string('perilaku')->nullable();
            $table->string('bcs')->nullable();
            $table->string('gula_darah')->nullable();
            $table->string('tekanan_darah')->nullable();
            $table->string('crt')->nullable();
            $table->string('detak_jantung')->nullable();
            $table->string('mm')->nullable();
            $table->string('saturasi_oksigen')->nullable();
            $table->string('tingkat_pernapasan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
