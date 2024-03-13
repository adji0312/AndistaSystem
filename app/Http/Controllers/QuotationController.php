<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Location;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Sale;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
{
    public function quotationList(){
        return view('finance.quotationlist', [
            "title" => "Quotation List",
            "quotations" => Quotation::all()
        ]);
    }

    public function addquotation(){
        return view('finance.addquotation', [
            "title" => "Quotation List",
            "locations" => Location::all()->where('status', 'Active')
        ]);
    }

    public function addInvoice(){
        return view('finance.addInvoice', [
            "title" => "Invoice Baru",
            "locations" => Location::all()->where('status', 'Active')
        ]);
    }

    public function addquotationdetail($name){

        $quo = Quotation::all()->where('quotation_name', $name)->first();
        $staffs = Staff::all()->where('status', "Active");
        $quoItem = QuotationItem::all()->where('quotation_id', $quo->id);
        
        return view('finance.addquotationdetail', [
            "title" => "Quotation List",
            "quotation" => $quo,
            "locations" => Location::all()->where('status', 'Active'),
            "staffs" => $staffs,
            "quoItem" => $quoItem
        ]);
    }

    public function storeNewInvoice(Request $request){

        // dd($request->all());
        $string = $request->customer_id;
        $prefix = "(";
        $index = strpos($string, $prefix) + strlen($prefix);
        $phone = substr($string, $index);

        // dd($result);
        $customer_name = substr($request->customer_id, 0, strpos($request->customer_id, ' ('));
        $customer_phone = substr($phone, 0, strpos($phone, ')'));
        $customer = Customer::where("first_name","LIKE","%{$customer_name}%")->where("phone", $customer_phone)->get();
        // dd($customer->first());

        $lastSales = DB::table('sales')->latest('created_at')->first();
            // dd($lastSales);

        if($lastSales == null || $lastSales == ''){
            $nextNumber = sprintf("%05d", 1);
        }else{
            $nextNumber = sprintf("%05d", $lastSales->id + 1);
        }
        // dd($nextNumber);
        $sales = new Sale();
        $sales->no_invoice = "INV-" . $nextNumber;
        $sales->booking_id = 0;
        $sales->sub_booking_id = 0;
        $sales->diskon = 0;
        $sales->deskripsi_tambahan_biaya = '-';
        $sales->tambahan_biaya = 0;
        $sales->metode = '-';
        $sales->status = 1;
        $sales->is_delete = 1;
        $sales->customer_name = $customer->first()->first_name;
        $sales->sub_account_name = '-';
        $sales->pesan_resepsionis = '-';
        $sales->resepsionis_id = Auth::user()->id;
        $sales->save();

        $saleTerakhir = DB::table('sales')->latest('created_at')->first();
        
        // Alert::success('Berhasil!', 'Invoice Berhasil Dibuat!');

        return redirect('/sale/list/detail/' . $saleTerakhir->no_invoice);
    }
}
