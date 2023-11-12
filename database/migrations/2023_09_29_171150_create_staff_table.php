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
            $table->foreignId("role_id");
            $table->foreignId("service_id");
            $table->string("first_name");
            $table->string("middle_name");
            $table->string("last_name");
            $table->string("nickname");
            $table->string("gender");
            $table->string("status");
            $table->string("descriptions");
            $table->string("phone");
            $table->string("email");
            $table->string("image");
            $table->uuid("UUID");
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
