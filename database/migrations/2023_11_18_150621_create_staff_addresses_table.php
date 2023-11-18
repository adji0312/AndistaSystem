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
        Schema::create('staff_addresses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('staff_id');
            $table->foreignId('country_id');
            $table->string('address_name');
            $table->string('detail_address');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code');
            $table->string('country');
            $table->string('religion');
            $table->string('marital_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_addresses');
    }
};
