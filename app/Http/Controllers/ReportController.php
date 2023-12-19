<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class ReportController extends Controller
{
    public function daily(){

        if(request('filterdate')){
            $sales = Sale::whereDate('updated_at', request('filterdate'))->get();
            
        }else{
            $sales = Sale::all()->where('status', 0);
        }

        return view('report.dailyaudit', [
            'title' => "Daily Audit",
            'sales' => $sales,
            'cashsale' => $sales->where('metode', 'Cash')->sum('total_price'),
            'creditsale' => $sales->where('metode', 'Credit Card')->sum('total_price'),
            'banksale' => $sales->where('metode', 'Bank Transfer')->sum('total_price'),
            'debitsale' => $sales->where('metode', 'Debit Card')->sum('total_price'),
            'allTotal' => $sales->sum('total_price')
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
