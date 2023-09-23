<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PolicyController extends Controller
{
    public function store(Request $request){
        // dd($request->all());

        $validatedData = $request->validate([
            'form_name' => 'required',
            'text' => 'required',
        ]);

        Policy::create($validatedData);
        return redirect('/service/policy');
    }

    public function deletePolicy(Request $request){
        
        $myString = $request->deleteId;
        $myArray = explode(',', $myString);
        // print_r(count($myArray));
        $length = count($myArray);

        for($i = 0 ; $i < $length ; $i++){
            $policy = Policy::find($myArray[$i]);
            // print_r($category->category_service_name);
            DB::table('policies')->where('id', $policy->id)->delete();
        }

        return redirect('/service/policy');
    }

    public function update(Request $request, $id){
       
        $policy = Policy::find($id);
        // dd($policy);

        $rules = [
            "status" => 'required',
            "text" => 'required'
        ];

        if($request->form_name != $policy->form_name){
            $rules['form_name'] = 'required|unique:policies';
        }

        $validatedData = $request->validate($rules);

        Policy::where('id', $policy->id)->update($validatedData);
        return redirect('/service/policy');
    }
}
