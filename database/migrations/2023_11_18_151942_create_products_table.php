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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('brand_id')->nullable();
            $table->foreignId('supplier_id')->nullable();
            $table->foreignId('location_id')->nullable();
            $table->foreignId('tax_rate_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('simple_name')->nullable();
            $table->string('sku')->nullable();
            $table->string('upc_ean')->nullable();
            $table->string('supplier_pid')->nullable();
            $table->float('price')->nullable();
            $table->integer('stock')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
