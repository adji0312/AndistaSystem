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
        Schema::create('staff_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_type_id");
            $table->foreignId("no_id");
            $table->foreignId("staff_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_backgrounds');
    }
};
