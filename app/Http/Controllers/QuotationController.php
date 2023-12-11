<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Location;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Staff;
use Illuminate\Http\Request;
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

    public function storeQuotation(Request $request){

        $string = $request->customer_id;
        $prefix = "(";
        $index = strpos($string, $prefix) + strlen($prefix);
        $phone = substr($string, $index);

        // dd($result);
        $customer_name = substr($request->customer_id, 0, strpos($request->customer_id, ' ('));
        $customer_phone = substr($phone, 0, strpos($phone, ')'));
        $customer = Customer::where("first_name","LIKE","%{$customer_name}%")->where("phone", $customer_phone)->get();

        // dd($customer);

        $validatedData = $request->validate([
            'location_id' => 'required',
            'quotation_date' => 'required',
        ]);

        // if()
        $lastQuo1 = DB::table('quotations')->latest('created_at')->first();
        if($lastQuo1 == null || $lastQuo1 == ''){
            $nextNumber = sprintf("%05d", 1);
            $validatedData['quotation_name'] = "QUO-" . $nextNumber;
            // dd($validatedData['quotation_name']);
        }else{
            // $lastId = $lastQuo1->id + 1;
            $nextNumber = sprintf("%05d", $lastQuo1->id + 1);
            $validatedData['quotation_name'] = "QUO-" . $nextNumber;
        }

        $validatedData['customer_id'] = $customer->first()->id;
        $validatedData['total_price'] = 0;
        $validatedData['is_delete'] = 1;

        Quotation::create($validatedData);

        $lastQuo = DB::table('quotations')->latest('created_at')->first();
        return redirect('/quotation/add' . '/' . $lastQuo->quotation_name);
    }
}
