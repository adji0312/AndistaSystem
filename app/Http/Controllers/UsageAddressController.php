<?php

namespace App\Http\Controllers;

use App\Models\UsageAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsageAddressController extends Controller
{
    public function store(Request $request){
        //    dd($request->all());
        $validatedData = $request->validate([
            'usage_name' => 'required|unique:usage_addresses',
        ]);

        UsageAddress::create($validatedData);
        return redirect()->back();
    }

    public function update(Request $request, $id){
        //    dd($request->all());
        $usage = UsageAddress::find($id);

        $rules = [];

        if($request->usage_name != $usage->usage_name){
            $rules['usage_name'] = 'required|unique:usage_addresses';
        }

        $validatedData = $request->validate($rules);

        UsageAddress::where('id', $usage->id)->update($validatedData);
        return redirect()->back();
    }

    public function deleteUsageAddress(Request $request){
        
        $myString = $request->deleteId;
        $myArray = explode(',', $myString);
        // print_r(count($myArray));
        $length = count($myArray);

        for($i = 0 ; $i < $length ; $i++){
            $usage = UsageAddress::find($myArray[$i]);
            // print_r($category->category_service_name);
            DB::table('usage_addresses')->where('id', $usage->id)->delete();
        }

        return redirect()->back();
    }
}
