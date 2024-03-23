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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('product_id')->nullable();
            $table->foreignId('service_id')->nullable();
            $table->foreignId('treatment_id')->nullable();
            $table->foreignId('booking_id')->nullable();
            $table->foreignId('invoice_id')->nullable();
            $table->string('status');
            $table->string('username');
            $table->string('description')->nullable();
            $table->string('nama')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
