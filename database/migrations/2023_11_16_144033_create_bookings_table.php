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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_name')->unique();
            $table->foreignId('customer_id');
            $table->foreignId('location_id');
            $table->date('booking_date');
            $table->string('category'); //tidak dikenakan biaya, langsung datang, rawat inap, darurat
            $table->text('resepsionisNotes')->nullable();
            $table->integer('total_price')->nullable(); //ambil dari table bookingservice where booking_id sama, ambil dari table bookingcart where booking_id sama
            $table->string('status')->default('confirmed'); //confirmed, started, completed (kalau sudah completed, langsung masuk ke table sale dengan status unpain)
            $table->integer('temp')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
