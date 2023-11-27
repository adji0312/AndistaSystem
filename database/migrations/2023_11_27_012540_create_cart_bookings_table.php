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
        Schema::create('cart_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->nullable();
            $table->foreignId('sub_booking_id')->nullable();
            $table->foreignId('product_id')->nullable();
            $table->foreignId('service_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('total_price')->nullable();
            $table->integer('flag')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_bookings');
    }
};
