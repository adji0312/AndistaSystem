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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id');
            $table->foreignId('shift_id')->nullable();//lebih jam kerja
            $table->date('check_in');
            $table->date('check_out')->nullable();
            $table->string('status'); //checkin
            $table->integer('over_hour');//telat disimpan disini
            $table->integer('duration_work')->nullable();//lebih jam kerja
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
