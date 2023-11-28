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
            $table->tinyInteger('staff_dashboard')->nullable();
            $table->tinyInteger('staff_staff_list')->nullable();
            $table->tinyInteger('staff_job')->nullable();
            $table->tinyInteger('staff_access_control')->nullable();
            $table->tinyInteger('staff_security_groups')->nullable();
            //Service
            $table->tinyInteger('service_dashboard');
            $table->tinyInteger('service_list');
            $table->tinyInteger('service_treatment_plan');
            $table->tinyInteger('service_category');
            $table->tinyInteger('service_diagnosis');
            $table->tinyInteger('service_policy');
            //Product
            $table->tinyInteger('product_dashboard');
            $table->tinyInteger('product_list');
            $table->tinyInteger('product_brand');
            $table->tinyInteger('product_category');
            $table->tinyInteger('product_suppliers');
            //Location
            $table->tinyInteger('dashboard_location');
            $table->tinyInteger('location_list');
            $table->tinyInteger('facilities');
            $table->tinyInteger('setting_location');
            //Finance
            $table->tinyInteger('dashboard_finance');
            $table->tinyInteger('sale_list');
            $table->tinyInteger('quotation_list');
            $table->tinyInteger('tax_rate');
            //Attendance
            $table->tinyInteger('dashboard_attendance');
            $table->tinyInteger('attendance_list');
            $table->tinyInteger('working_shift');
            $table->tinyInteger('manage_staff_shift');
            //Presence
            $table->tinyInteger('absent');
            //Reports
            $table->tinyInteger('reports_all');
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
