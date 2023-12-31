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
        Schema::create('location_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->nullable();
            $table->foreignId('usage_address_id')->nullable();
            $table->string('country')->nullable();
            $table->text('street_address')->nullable();
            $table->text('additional_info')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_addresses');
    }
};
