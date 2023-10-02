<?php

namespace App\Http\Controllers;

use App\Models\MessengerType;
use Illuminate\Http\Request;

class MessengerTypeController extends Controller
{
    public function store(Request $request){
        //    dd($request->all());
        $validatedData = $request->validate([
            'type_name' => 'required|unique:messenger_types',
        ]);

        MessengerType::create($validatedData);
        return redirect('/location/list/add')->with('successAddTask', 'wkwkwk');
    }
}
