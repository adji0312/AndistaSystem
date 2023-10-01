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
            $table->foreignId('location_id');
            $table->foreignId('usage_address_id');
            $table->string('country');
            $table->text('street_address');
            $table->text('additional_info');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
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
