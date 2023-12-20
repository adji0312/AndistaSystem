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
        Schema::create('workdays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id');
            $table->integer('Monday')->nullable();
            $table->integer('Tuesday')->nullable();
            $table->integer('Wednesday')->nullable();
            $table->integer('Thursday')->nullable();
            $table->integer('Friday')->nullable();
            $table->integer('Saturday')->nullable();
            $table->integer('Sunday')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workdays');
    }
};
