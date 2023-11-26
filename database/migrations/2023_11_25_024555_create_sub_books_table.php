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
        Schema::create('sub_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id');
            $table->date('booking_date');
            $table->foreignId('subAccount_id')->nullable();
            $table->string('status')->default('confirmed'); //confirmed, started, completed (kalau sudah completed, langsung masuk ke table sale dengan status unpaid)
            $table->integer('tidak_dikenakan_biaya')->nullable();
            $table->integer('langsung_datang')->nullable();
            $table->integer('rawat_inap')->nullable();
            $table->integer('darurat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_books');
    }
};
