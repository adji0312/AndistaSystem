<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Quotation;
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
        // dd($quo);

        return view('finance.addquotationdetail', [
            "title" => "Quotation List",
            "quotation" => $quo,
            "locations" => Location::all()->where('status', 'Active')
        ]);
    }

    public function storeQuotation(Request $request){
        $validatedData = $request->validate([
            'location_id' => 'required',
            'customer_id' => 'required',
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

        $validatedData['total_price'] = 0;
        $validatedData['is_delete'] = 1;

        Quotation::create($validatedData);

        $lastQuo = DB::table('quotations')->latest('created_at')->first();
        return redirect('/quotation/add' . '/' . $lastQuo->quotation_name);
    }
}
