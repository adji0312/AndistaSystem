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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('location_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();    
            $table->string('degree')->nullable();
            $table->string('nickname')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('messenger')->nullable();
            $table->foreignId('messengerId')->nullable();
            $table->string('address')->nullable();
            $table->string('card_type')->nullable();
            $table->string('job_name')->nullable();
            $table->string('no_id')->nullable();
            $table->string('join_date')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('religion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
