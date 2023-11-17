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
            $table->foreignId('customer_id');
            $table->foreignId('location_id');
            $table->foreignId('treatment_id');
            $table->foreignId('statistik_id');
            $table->foreignId('catatan_id');
            $table->string('product_id');
            $table->string('status'); //confirmed, started, completed, paid, unpaid (default saat pertama booking confirmed)
            $table->string('category');
            $table->text('resepsionisNotes');
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
