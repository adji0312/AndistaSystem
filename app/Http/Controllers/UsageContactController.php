<?php

namespace App\Http\Controllers;

use App\Models\UsageContact;
use Illuminate\Http\Request;

class UsageContactController extends Controller
{
    public function store(Request $request){
        //    dd($request->all());
        $validatedData = $request->validate([
            'usage_name' => 'required|unique:usage_contacts',
        ]);

        UsageContact::create($validatedData);
        return redirect('/location/list/add')->with('successAddTask', 'wkwkwk');
    }
}
