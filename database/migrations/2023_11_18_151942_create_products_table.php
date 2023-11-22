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
            $table->foreignId('category_id');
            $table->foreignId('brand_id');
            $table->foreignId('supplier_id');
            $table->foreignId('location_id');
            $table->foreignId('tax_rate_id');
            $table->string('product_name');
            $table->string('simple_name');
            $table->string('sku');
            $table->string('upc_ean');
            $table->string('supplier_pid');
            $table->float('price');
            $table->integer('stock');
            $table->string('description');
            $table->string('status');
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
