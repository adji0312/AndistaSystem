<?php

namespace App\Http\Controllers;

use App\Models\UsageContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsageContactController extends Controller
{
    public function store(Request $request){
        //    dd($request->all());
        $validatedData = $request->validate([
            'usage_name' => 'required|unique:usage_contacts',
        ]);

        UsageContact::create($validatedData);
        return redirect()->back();
    }

    public function update(Request $request, $id){
    //    dd($request->all());
        $usage = UsageContact::find($id);

        $rules = [];

        if($request->usage_name != $usage->usage_name){
            $rules['usage_name'] = 'required|unique:usage_contacts';
        }

        $validatedData = $request->validate($rules);

        UsageContact::where('id', $usage->id)->update($validatedData);
        return redirect()->back();
    }

    public function deleteUsageContact(Request $request){
        
        $myString = $request->deleteId;
        $myArray = explode(',', $myString);
        // print_r(count($myArray));
        $length = count($myArray);

        for($i = 0 ; $i < $length ; $i++){
            $usage = UsageContact::find($myArray[$i]);
            // print_r($category->category_service_name);
            DB::table('usage_contacts')->where('id', $usage->id)->delete();
        }

        return redirect()->back();
    }
}
