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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('role_name');
            //Home
            $table->tinyinteger('home_overview')->nullable();
            $table->tinyinteger('home_upcoming_booking')->nullable();
            //Calendar
            $table->tinyInteger('calendar_calendar')->nullable();
            $table->tinyInteger('calendar_create_booking')->nullable();
            $table->tinyInteger('calendar_list_booking')->nullable();
            //Staff
            // $table->tinyInteger('staff_dashboard')->nullable();
            $table->tinyInteger('staff_staff_list')->nullable();
            $table->tinyInteger('staff_job')->nullable();
            $table->tinyInteger('staff_access_control')->nullable(); 
            $table->tinyInteger('staff_security_groups')->nullable();
            //Service
            $table->tinyInteger('service_dashboard')->nullable();
            $table->tinyInteger('service_list')->nullable();
            $table->tinyInteger('service_treatment_plan')->nullable();
            $table->tinyInteger('service_category')->nullable();
            $table->tinyInteger('service_diagnosis')->nullable();
            $table->tinyInteger('service_policy')->nullable();
            //Product
            $table->tinyInteger('product_dashboard')->nullable();
            $table->tinyInteger('product_list')->nullable();
            $table->tinyInteger('product_brand')->nullable();
            $table->tinyInteger('product_category')->nullable();
            $table->tinyInteger('product_suppliers')->nullable();
            //Location
            $table->tinyInteger('dashboard_location')->nullable();
            $table->tinyInteger('location_list')->nullable();
            $table->tinyInteger('facilities')->nullable();
            $table->tinyInteger('setting_location')->nullable();
            //Finance
            $table->tinyInteger('dashboard_finance')->nullable();
            $table->tinyInteger('sale_list')->nullable();
            $table->tinyInteger('quotation_list')->nullable();
            $table->tinyInteger('tax_rate')->nullable();
            //Attendance
            $table->tinyInteger('dashboard_attendance')->nullable();
            $table->tinyInteger('attendance_list')->nullable();
            $table->tinyInteger('working_shift')->nullable();
            $table->tinyInteger('manage_staff_shift')->nullable();
            //Presence
            $table->tinyInteger('absent')->nullable();
            //Reports
            $table->tinyInteger('reports_all')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
