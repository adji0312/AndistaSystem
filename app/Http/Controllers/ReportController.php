<?php

namespace App\Http\Controllers;

use App\Models\BookingService;
use App\Models\CartBooking;
use App\Models\InvoicePayment;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Service;
use App\Models\Staff;
use App\Models\SubBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class ReportController extends Controller
{
    public function daily(Request $request){
        // dd($request->all);
        if(request('datefrom') && request('dateto')){
            $sales = InvoicePayment::whereDate('created_at', '>=', request('datefrom'))->whereDate('created_at', '<=', request('dateto'))->get();
            $invoice = Sale::where('status', 0)->whereDate('created_at', '>=', request('datefrom'))->whereDate('created_at', '<=', request('dateto'))->get();
            // $sales = InvoicePayment::whereDate('created_at', request('filterdate'))->get();
            // $invoice = Sale::whereDate('created_at', request('filterdate'))->get();
        }else{
            $sales = InvoicePayment::whereDate('created_at', date_format(Date::now(), 'Y-m-d'))->get();
            $invoice = Sale::whereDate('created_at', date_format(Date::now(), 'Y-m-d'))->where('status', 0)->get();
        }

        return view('report.dailyaudit', [
            'title' => "Daily Audit",
            'cashsale' => $sales->where('method', 'Cash')->sum('price'),
            'creditsale' => $sales->where('method', 'Credit Card')->sum('price'),
            'banksale' => $sales->where('method', 'Bank Transfer')->sum('price'),
            'debitsale' => $sales->where('method', 'Debit Card')->sum('price'),
            'allTotal' => $sales->sum('price'),
            'invoice' => $invoice
        ]);
    }
    public function monthly(){

        if(request('month') && request('year')){
            // dd(request('month'));
            $sales = Sale::whereRaw('MONTH(updated_at) = '.request('month'))->whereRaw('YEAR(updated_at) = '.request('year'))->where('status', 0)->get();
            $invoice = InvoicePayment::whereRaw('MONTH(updated_at) = '.request('month'))->whereRaw('YEAR(updated_at) = '.request('year'))->get();
            
        }else{
            $sales = Sale::where('status', 0)->whereRaw('MONTH(updated_at) = '.date_format(Date::now(), 'm'))->whereRaw('YEAR(updated_at) = '.date_format(Date::now(), 'Y'))->get();
            $invoice = InvoicePayment::whereRaw('MONTH(updated_at) = '.date_format(Date::now(), 'm'))->whereRaw('YEAR(updated_at) = '.date_format(Date::now(), 'Y'))->get();
        }

        // dd($sales);
        // dd($invoice);

        return view('report.monthlyaudit', [
            'title' => "Monthly Audit",
            'sales' => $sales,
            'cashsale' => $invoice->where('method', 'Cash')->sum('price'),
            'creditsale' => $invoice->where('method', 'Credit Card')->sum('price'),
            'banksale' => $invoice->where('method', 'Bank Transfer')->sum('price'),
            'debitsale' => $invoice->where('method', 'Debit Card')->sum('price'),
            'allTotal' => $invoice->sum('price'),
            'invoices' => $invoice
        ]);
    }
    public function byProduct(){

        if(request('datefrom') && request('dateto')){
            $cartbooking = CartBooking::where('product_id', '!=', '')->whereDate('created_at', '>=', request('datefrom'))->whereDate('created_at', '<=', request('dateto'))->get();
        }else{
            $cartbooking = CartBooking::where('product_id', '!=', '')->get();
        }

        $products = Product::all();

        return view('report.salesbyproduct', [
            'title' => "Sale by Product",
            'cartbooking' => $cartbooking,
            'products' => $products
        ]);
    }
    public function byServices(){

        if(request('datefrom') && request('dateto')){
            $cartbooking = CartBooking::where('service_id', '!=', '')->whereDate('created_at', '>=', request('datefrom'))->whereDate('created_at', '<=', request('dateto'))->get();
        }else{
            $cartbooking = CartBooking::where('service_id', '!=', '')->get();
        }

        $services = Service::all();

        return view('report.salesbyservices', [
            'title' => "Sale by Services",
            'services' => $services,
            'cartbooking' => $cartbooking
        ]);
    }
    public function byStaff(){

        if(request('datefrom') && request('dateto')){
            $subBooks = SubBook::where('staff_id', '!=', '')->where('status', 4)->whereDate('created_at', '>=', request('datefrom'))->whereDate('created_at', '<=', request('dateto'))->get();
        }else{
            $subBooks = SubBook::where('staff_id', '!=', '')->where('status', 4)->get();
        }

        $staffs = Staff::all();

        return view('report.salesbystaff', [
            'title' => "Sale by Staff",
            'subbooks' => $subBooks,
            'staffs' => $staffs
        ]);
    }

    public function byResepsionis(){

        if(request('datefrom') && request('dateto')){
            $subBooks = SubBook::where('admin_id', '!=', '')->whereDate('created_at', '>=', request('datefrom'))->whereDate('created_at', '<=', request('dateto'))->get();
        }else{
            $subBooks = SubBook::where('admin_id', '!=', '')->get();
        }

        $staffs = Staff::all();

        return view('report.salesbyresepsionis', [
            'title' => "Sale by Resepsionis",
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
