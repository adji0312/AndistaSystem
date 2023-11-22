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
            $table->foreignId('policy_id')->nullable();
            $table->string('service_name');
            $table->string('simple_service_name');
            $table->string('status');
            $table->text('description')->nullable();
            // $table->integer('staffCheck'); //0 is have staff, 1 don't have staff
            // $table->integer('facilityCheck'); //0 is have facility, 1 don't have facility
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
