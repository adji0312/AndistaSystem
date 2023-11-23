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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('customer_id')->nullable();
            $table->string("pet_name")->nullable();
            $table->string("pet_type")->nullable();
            $table->string("pet_ras")->nullable();
            $table->string("pet_gender")->nullable();
            $table->date("date_of_birth")->nullable();
            $table->string("pet_color")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
