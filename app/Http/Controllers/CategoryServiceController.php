<?php

namespace App\Http\Controllers;

use App\Models\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryServiceController extends Controller
{
    public function store(Request $request){
       
        $validatedData = $request->validate([
            'category_service_name' => 'required|unique:category_services',
        ]);

        CategoryService::create($validatedData);
        return redirect('/service/category');
    }

    public function update(Request $request, $id){
       
        $category = CategoryService::find($id);

        $rules = [];

        if($request->category_service_name != $category->category_service_name){
            $rules['category_service_name'] = 'required|unique:category_services';
        }

        $validatedData = $request->validate($rules);

        CategoryService::where('id', $category->id)->update($validatedData);
        return redirect('/service/category');
    }

    public function deleteCategory(Request $request){
        
        $myString = $request->deleteId;
        $myArray = explode(',', $myString);
        // print_r(count($myArray));
        $length = count($myArray);

        for($i = 0 ; $i < $length ; $i++){
            $category = CategoryService::find($myArray[$i]);
            // print_r($category->category_service_name);
            DB::table('category_services')->where('id', $category->id)->delete();
        }

        return redirect('/service/category');
    }
}
