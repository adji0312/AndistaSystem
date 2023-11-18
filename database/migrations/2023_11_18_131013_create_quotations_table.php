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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('quotation_name')->unique();
            $table->foreignId('location_id');
            $table->foreignId('customer_id');
            $table->integer('total_price');
            $table->integer('is_delete'); //1 not delete, 0 deleted
            $table->date('quotation_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
