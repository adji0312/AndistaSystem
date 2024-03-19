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
        Schema::create('list_plan_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_booking_id')->nullable();
            $table->foreignId('booking_diagnoses_id')->nullable();
            $table->foreignId('list_plan_id')->nullable();
            $table->integer('day')->nullable();
            $table->integer('flag')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_plan_bookings');
    }
};
