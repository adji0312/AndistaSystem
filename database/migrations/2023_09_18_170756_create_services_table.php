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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id');
            $table->foreignId('tax_id');
            $table->foreignId('category_service_id');
            $table->foreignId('staff_id');
            $table->foreignId('facility_id');
            $table->foreignId('policy_id'); //bisa nullable (untuk service yg tidak memerlukan persetujuan surat)
            $table->string('service_name');
            $table->string('simple_service_name');
            $table->string('status');
            $table->string('image');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
