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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('customer_Id');
            $table->foreignId('id_type_id');
            $table->foreignId('job_id');
            $table->foreignId('no_id');
            $table->string('join_date');
            $table->string('gender');
            $table->string('birthday_date');
            $table->string('ethnic');
            $table->string('religion');
            $table->string('marital_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
