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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('no_invoice')->unique(); //INV-unique (random id unique)
            $table->foreignId('booking_id'); //nanti ambil list cart_id, trus service_id
            $table->foreignId('sub_booking_id'); //nanti ambil list cart_id, trus service_id
            $table->integer('diskon')->nullable();
            $table->string('deskripsi_tambahan_biaya')->nullable();
            $table->integer('tambahan_biaya')->nullable();
            $table->string('metode')->nullable(); //cash, debit, credit-card, bank transfer
            $table->string('note')->nullable();
            $table->integer('status')->nullable(); //unpaid: 1, paid: 0
            $table->integer('is_delete')->nullable(); //delete: 0, undeleted: 1
            $table->integer('total_price')->nullable();
            $table->integer('deposit')->nullable();
            $table->integer('flagDeposit')->nullable();
            $table->integer('recharge')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
