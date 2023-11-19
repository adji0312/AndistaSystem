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
            $table->foreignId("service_id")->nullable();
            $table->string("first_name")->nullable();
            $table->string("middle_name")->nullable();
            $table->string("last_name")->nullable();
            $table->string("nickname")->nullable();
            $table->string("gender")->nullable();
            $table->string("status")->nullable();
            $table->string("descriptions")->nullable();
            $table->string("phone")->nullable();
            $table->string("email")->nullable();
            $table->string("image")->nullable();
            $table->uuid("UUID")->unique();
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
