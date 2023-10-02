<?php

namespace App\Http\Controllers;

use App\Models\TaxRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxRateController extends Controller
{
    public function store(Request $request){
        // dd($request->all());

        $validatedData = $request->validate([
            'tax_name' => 'required',
            'tax_rate' => 'required'
        ]);

        $validatedData['created_by'] = 'Adji';
        $validatedData['updated_by'] = '';

        TaxRate::create($validatedData);
        return redirect('/finance/taxrate');
    }

    public function update(Request $request, $id){
       
        $tax = TaxRate::find($id);

        $rules = [
            "tax_rate" => 'required'
        ];

        if($request->tax_name != $tax->tax_name){
            $rules['tax_name'] = 'required|unique:tax_rates';
        }
        
        $validatedData = $request->validate($rules);
        $validatedData['updated_by'] = 'Budhi';

        TaxRate::where('id', $tax->id)->update($validatedData);
        return redirect('/finance/taxrate');
    }

    public function deleteTax(Request $request){
        
        $myString = $request->deleteId;
        $myArray = explode(',', $myString);
        // print_r(count($myArray));
        $length = count($myArray);

        for($i = 0 ; $i < $length ; $i++){
            $tax = TaxRate::find($myArray[$i]);
            // print_r($category->category_service_name);
            DB::table('tax_rates')->where('id', $tax->id)->delete();
        }

        return redirect('/finance/taxrate');
    }
}
