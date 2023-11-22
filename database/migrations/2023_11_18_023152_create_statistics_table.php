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
            $table->foreignId('booking_id');
            $table->string('suhu');
            $table->string('berat');
            $table->string('perilaku');
            $table->string('bcs');
            $table->string('gula_darah');
            $table->string('tekanan_darah');
            $table->string('crt');
            $table->string('detak_jantung');
            $table->string('mm');
            $table->string('saturasi_oksigen');
            $table->string('tingkat_pernapasan');
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
