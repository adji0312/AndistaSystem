<?php

namespace App\Http\Controllers;

use App\Models\UsageAddress;
use Illuminate\Http\Request;

class UsageAddressController extends Controller
{
    public function store(Request $request){
        //    dd($request->all());
        $validatedData = $request->validate([
            'usage_name' => 'required|unique:usage_contacts',
        ]);

        UsageAddress::create($validatedData);
        return redirect('/location/list/add')->with('successAddTask', 'wkwkwk');
    }
}
