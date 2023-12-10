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
            $table->tinyinteger('home_overview')->default('4')->nullable();
            $table->tinyinteger('home_upcoming_booking')->default('4')->nullable();
            //Calendar
            $table->tinyInteger('calendar_calendar')->default('4')->nullable();
            $table->tinyInteger('calendar_create_booking')->default('4')->nullable();
            $table->tinyInteger('calendar_list_booking')->default('4')->nullable();
            //Customer
            $table->tinyInteger('customer_list')->default('4')->nullable();
            //Staff
            // $table->tinyInteger('staff_dashboard')->default('4');
            $table->tinyInteger('staff_staff_list')->default('4')->nullable();
            $table->tinyInteger('staff_job')->default('4')->nullable();
            $table->tinyInteger('staff_access_control')->default('4')->nullable(); 
            $table->tinyInteger('staff_security_groups')->default('4')->nullable();
            //Service
            $table->tinyInteger('service_dashboard')->default('4')->nullable();
            $table->tinyInteger('service_list')->default('4')->nullable()->nullable();
            $table->tinyInteger('service_treatment_plan')->default('4')->nullable();
            $table->tinyInteger('service_category')->default('4')->nullable();
            $table->tinyInteger('service_diagnosis')->default('4')->nullable();
            $table->tinyInteger('service_policy')->default('4')->nullable();
            //Product
            $table->tinyInteger('product_dashboard')->default('4')->nullable();
            $table->tinyInteger('product_list')->default('4')->nullable();
            $table->tinyInteger('product_brand')->default('4')->nullable();
            $table->tinyInteger('product_category')->default('4')->nullable();
            $table->tinyInteger('product_suppliers')->default('4')->nullable();
            //Location
            $table->tinyInteger('dashboard_location')->default('4')->nullable();
            $table->tinyInteger('location_list')->default('4')->nullable();
            $table->tinyInteger('facilities')->default('4')->nullable();
            $table->tinyInteger('setting_location')->default('4')->nullable();
            //Finance
            $table->tinyInteger('dashboard_finance')->default('4')->nullable();
            $table->tinyInteger('sale_list')->default('4')->nullable();
            $table->tinyInteger('quotation_list')->default('4')->nullable();
            $table->tinyInteger('tax_rate')->default('4')->nullable();
            //Attendance
            $table->tinyInteger('dashboard_attendance')->default('4')->nullable();
            $table->tinyInteger('attendance_list')->default('4')->nullable();
            $table->tinyInteger('working_shift')->default('4')->nullable();
            $table->tinyInteger('manage_staff_shift')->default('4')->nullable();
            //Presence
            $table->tinyInteger('absent')->default('4')->nullable();
            $table->tinyInteger('presence_today')->default('4')->nullable();
            //Reports
            $table->tinyInteger('reports_all')->default('4')->nullable();
            $table->tinyInteger('reports_booking')->default('4')->nullable();
            $table->tinyInteger('reports_finance')->default('4')->nullable();
            $table->tinyinteger('reports_attendance')->default('4')->nullable();
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
