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
        Schema::create('backgrounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId("customer_id");
            $table->foreignId("id_type_id");
            $table->foreignId("job_id");
            $table->foreignId("no_id");
            $table->string("join_date");
            $table->string("gender");
            $table->string("birthday_date");
            $table->string("ethnic");
            $table->string("religion");
            $table->string("marital_status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backgrounds');
    }
};
