<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function daily(){
        return view('report.dailyaudit', [
            'title' => "Daily Audit"
        ]);
    }
    public function monthly(){
        return view('report.monthlyaudit', [
            'title' => "Monthly Audit"
        ]);
    }
    public function byProduct(){
        return view('report.salesbyproduct', [
            'title' => "Sale by Product"
        ]);
    }
    public function byServices(){
        return view('report.salesbyservices', [
            'title' => "Sale by Services"
        ]);
    }
    public function byStaff(){
        return view('report.salesbystaff', [
            'title' => "Sale by Staff"
        ]);
    }
    public function quotationReport(){
        return view('report.quotationreport', [
            'title' => "Quotation Report"
        ]);
    }
}
