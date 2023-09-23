<?php

namespace App\Http\Controllers;

use App\Models\TaxRate;
use Illuminate\Http\Request;

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
}
