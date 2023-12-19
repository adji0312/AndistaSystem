<?php

namespace App\Http\Controllers;

use App\Models\BookingService;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Service;
use App\Models\Staff;
use App\Models\SubBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class ReportController extends Controller
{
    public function daily(){

        if(request('filterdate')){
            $sales = Sale::whereDate('updated_at', request('filterdate'))->where('status', 0)->get();
            
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

        if(request('month') || request('year')){
            // dd(request('month'));
            $sales = Sale::whereRaw('MONTH(updated_at) = '.request('month'))->whereRaw('YEAR(updated_at) = '.request('year'))->where('status', 0)->get();
            
        }else{
            $sales = Sale::all()->where('status', 0);
        }

        return view('report.monthlyaudit', [
            'title' => "Monthly Audit",
            'sales' => $sales,
            'cashsale' => $sales->where('metode', 'Cash')->sum('total_price'),
            'creditsale' => $sales->where('metode', 'Credit Card')->sum('total_price'),
            'banksale' => $sales->where('metode', 'Bank Transfer')->sum('total_price'),
            'debitsale' => $sales->where('metode', 'Debit Card')->sum('total_price'),
            'allTotal' => $sales->sum('total_price')
        ]);
    }
    public function byProduct(){

        $products = Product::all();

        return view('report.salesbyproduct', [
            'title' => "Sale by Product",
            'products' => $products
        ]);
    }
    public function byServices(){
        $services = Service::all();
        $bookingServices = BookingService::all();

        return view('report.salesbyservices', [
            'title' => "Sale by Services",
            'services' => $services,
            'bookingServices' => $bookingServices
        ]);
    }
    public function byStaff(){

        $subBooks = SubBook::all();
        $staffs = Staff::all();

        return view('report.salesbystaff', [
            'title' => "Sale by Staff",
            'subbooks' => $subBooks,
            'staffs' => $staffs
        ]);
    }
    public function quotationReport(){
        return view('report.quotationreport', [
            'title' => "Quotation Report"
        ]);
    }
}
