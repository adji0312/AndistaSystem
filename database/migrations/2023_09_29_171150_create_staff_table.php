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
        Schema::create('staff', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId("role_id")->nullable();
            $table->foreignId("position_id")->nullable();
            $table->string("first_name")->nullable(); 
            $table->string("middle_name")->nullable(); 
            $table->string("last_name")->nullable(); 
            $table->string("nickname")->nullable(); 
            $table->string("gender")->nullable(); 
            $table->string("status")->nullable();
            $table->string("messenger")->nullable(); 
            $table->foreignId("messengerId")->nullable(); 
            $table->string("descriptions")->nullable();
            $table->string("phone")->nullable(); 
            $table->string("email")->nullable(); 
            $table->uuid("UUID")->unique(); //20 char
            $table->string("Address")->nullable(); 
            $table->foreignId("shifts_id")->nullable();
            $table->string("location_id")->nullable();
            $table->string("password")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
