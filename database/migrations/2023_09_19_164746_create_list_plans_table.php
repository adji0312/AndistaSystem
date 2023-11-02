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
        Schema::create('list_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id');
            $table->foreignId('service_id');
            $table->foreignId('product_id');
            $table->integer('start_day');
            $table->integer('frequency');
            $table->integer('duration');
            $table->integer('temp'); //0 is save, 1 is temp
            $table->text('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_plans');
    }
};
