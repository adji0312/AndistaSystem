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
        Schema::create('location_contact_phones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id');
            $table->foreignId('usage_contact_id');
            $table->string('phone_number');
            $table->string('phone_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_contact_phones');
    }
};
