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
            $table->foreignId('admin_id')->nullable();
            $table->foreignId('location_id');
            $table->date('booking_date');
            $table->string('alasan_kunjungan')->nullable();
            $table->integer('category')->nullable();
            $table->timestamps();
            // $table->foreignId('subAccount_id')->nullable();
            // $table->integer('tidak_dikenakan_biaya'); //1 itu tidak, 0 itu iya
            // $table->integer('rawat_inap');
            // $table->integer('total_price')->nullable(); //ambil dari table bookingservice where booking_id sama, ambil dari table bookingcart where booking_id sama
            // $table->string('status')->default('Terkonfirmasi'); //Terkonfirmasi, Dimulai, Selesai (kalau sudah completed, langsung masuk ke table sale dengan status unpain)
            // $table->integer('temp')->default(1);
            // $table->integer('duration')->nullable();
            // $table->foreignId('staff_id');
            // $table->foreignId('booking_service_id');
            // $table->timestamp('start_booking')->nullable();
            // $table->timestamp('end_booking')->nullable();
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
