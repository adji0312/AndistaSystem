<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function productList(){
        return view('product.products.productlist',[
            "title"=>"Product List",
            "products"=>Product::all()
        ]);
    }

    public function suppliers(){
        return view('product.suppliers.supplier',[
            "title"=>"Product Supplier",
            "suppliers"=>Suppliers::all()
        ]);
    }

    public function brands(){
        return view('product.brands.brand',[
            "title"=>"Product Brand",
            "brands"=>Brand::all()
        ]);
    }

    public function categories(){
        return view('product.categories.category',[
            "title"=>"Product Category",
            "categories"=>CategoryProduct::all()
        ]);
    }

    public function addProduct(){
        return view('product.products.addproduct',[
            "title"=>"Add Product",
            "suppliers"=>Suppliers::all(),
            "brands"=>Brand::all(),
            "categories"=>CategoryProduct::all()
        ]);
    }

    public function addBrand(Request $request){
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands',
        ]);

        Brand::create($validatedData);
        return redirect('/product/list/brand');
    }


    public function addSupplier(Request $request){
        $validatedData = $request->validate([
            'suppliers_name' => 'required|unique:suppliers',
        ]);

        Suppliers::create($validatedData);
        return redirect('/product/suppliers');
    }

    public function addCategoryProduct(Request $request){
        // @dd($request->all());
        $validatedData = $request->validate([
            'category_name' => 'required|unique:category_products',
        ]);

        // dd($validatedData);

        CategoryProduct::create($validatedData);
        return redirect('/product/category');
    }



    public function deleteBrand(Request $request){
        
        $myString = $request->deleteId;
        $myArray = explode(',', $myString);
        // print_r(count($myArray));
        $length = count($myArray);

        for($i = 0 ; $i < $length ; $i++){
            $brand = Brand::find($myArray[$i]);
            // print_r($category->category_service_name);
            DB::table('brands')->where('id', $brand->id)->delete();
        }

        return redirect('/product/brand');
    }

    public function deleteSupplier(Request $request){
        
        $myString = $request->deleteId;
        $myArray = explode(',', $myString);
        // print_r($myArray);
        $length = count($myArray);

        for($i = 0 ; $i < $length ; $i++){
            $supplier = Suppliers::find($myArray[$i]);
            // @dd($supplier);
            // print_r($supplier);
            DB::table('suppliers')->where('id', $supplier->id)->delete();
        }

        return redirect('/product/suppliers');
    }

    public function deleteCategoryProduct(Request $request){
        
        $myString = $request->deleteId;
        $myArray = explode(',', $myString);
        // print_r($myArray);
        $length = count($myArray);

        for($i = 0 ; $i < $length ; $i++){
            $supplier = CategoryProduct::find($myArray[$i]);
            // @dd($supplier);
            // print_r($supplier);
            DB::table('category_products')->where('id', $supplier->id)->delete();
        }

        return redirect('/product/category');
    }

    public function editBrand(Request $request,$id){
        
        $brand = Brand::find($id);

        $brand->brand_name= $request->brand_name;

        $brand->update();

        return redirect('/product/brand');
    }

    public function editSupplier(Request $request,$id){
        
        $supplier = Suppliers::find($id);

        $supplier->suppliers_name= $request->suppliers_name;

        $supplier->update();

        return redirect('/product/suppliers');
    }

    public function editCategory(Request $request,$id){
        
        $supplier = CategoryProduct::find($id);

        $supplier->category_name= $request->category_name;

        $supplier->update();

        return redirect('/product/category');
    }
}
