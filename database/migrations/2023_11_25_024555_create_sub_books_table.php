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
        Schema::create('sub_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id');
            // $table->date('booking_date');
            $table->timestamp('booking_date');
            $table->foreignId('subAccount_id')->nullable();
            $table->foreignId('staff_id')->nullable();
            $table->integer('status');  //1 : terkonfirmasi, 2 : dimulai, 3 : apotek , 4 : selesai, 5 : rawat inap
            $table->timestamp('rawat_inap')->nullable();
            $table->integer('category')->nullable(); //1 : langsung datang, 2 : darurat, 3 : jadwalkan
            $table->integer('duration')->nullable();
            $table->timestamp('start_booking')->nullable();
            $table->timestamp('end_booking')->nullable();
            $table->integer('ranap')->nullable(); //1 : dirawat inap, 2: selesai
            $table->integer('sub_total_price')->nullable();
            $table->string('pesanresepsionis')->nullable();

            $table->foreignId('admin_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_books');
    }
};
