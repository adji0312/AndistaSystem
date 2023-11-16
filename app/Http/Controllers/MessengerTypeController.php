<?php

namespace App\Http\Controllers;

use App\Models\MessengerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessengerTypeController extends Controller
{
    public function store(Request $request){
        //    dd($request->all());
        $validatedData = $request->validate([
            'type_name' => 'required|unique:messenger_types',
        ]);

        MessengerType::create($validatedData);
        return redirect()->back();
    }

    public function update(Request $request, $id){
    //    dd($request->all());
        $type = MessengerType::find($id);

        $rules = [];

        if($request->type_name != $type->type_name){
            $rules['type_name'] = 'required|unique:messenger_types';
        }

        $validatedData = $request->validate($rules);

        MessengerType::where('id', $type->id)->update($validatedData);
        return redirect()->back();
    }

    public function deleteMessengerType(Request $request){
        
        $myString = $request->deleteId;
        $myArray = explode(',', $myString);
        // print_r(count($myArray));
        $length = count($myArray);

        for($i = 0 ; $i < $length ; $i++){
            $type = MessengerType::find($myArray[$i]);
            // print_r($category->category_service_name);
            DB::table('messenger_types')->where('id', $type->id)->delete();
        }

        return redirect()->back();
    }
}
