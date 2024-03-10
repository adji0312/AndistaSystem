<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\History;
use App\Models\Location;
use App\Models\Product;
use App\Models\Suppliers;
use App\Models\TaxRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function productList(){
        return view('product.products.productlist',[
            "title"=>"Product List",
            "products"=>Product::latest()->filter(request(['search']))->get()
        ]);
    }

    public function suppliers(){
        return view('product.suppliers.supplier',[
            "title"=>"Product Supplier",
            "suppliers"=>Suppliers::latest()->filter(request(['search']))->get()
        ]);
    }

    public function brands(){
        return view('product.brands.brand',[
            "title"=>"Product Brand",
            "brands"=>Brand::latest()->filter(request(['search']))->get()
        ]);
    }

    public function categories(){
        return view('product.categories.category',[
            "title"=>"Product Category",
            "categories"=>CategoryProduct::latest()->filter(request(['search']))->get()
        ]);
    }

    public function addProduct(){
        return view('product.products.addproduct',[
            "title"=>"Add Product",
            "suppliers"=>Suppliers::all(),
            "brands"=>Brand::all(),
            "categories"=>CategoryProduct::all(),
            "tax"=>TaxRate::all(),
            "location"=>Location::all()
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

    //Hanya untuk product
    public function deleteProduct(Request $request){
        $myString = $request->deleteId;
        $myArray = explode(',', $myString);
        // print_r($myArray);
        $length = count($myArray);

        for($i = 0 ; $i < $length ; $i++){
            $supplier = Product::find($myArray[$i]);
            $history = new History();
            $history->user_id = Auth::user()->id;
            $history->product_id = $supplier->id;
            $history->service_id = 0;
            $history->status = "Hapus";
            $history->username = Auth::user()->first_name;
            $history->description = "Produk '" . $supplier->product_name . "' telah dihapus.";
            $history->nama = $supplier->product_name;
            $history->save();
            // @dd($supplier);
            // print_r($supplier);
            DB::table('products')->where('id', $supplier->id)->delete();
        }

        return redirect('/product/list');
    }

    public function storeProduct(Request $request){
        // @dd($request->all());

        // $validatedData = $request->validate([
        //     'product_name' => 'required|unique:products',
        //     'simple_name' => 'unique:products',
        // ]);

        $product = new Product();
        $product->product_name=$request->product_name;
        $product->simple_name=$request->simple_name;
        $product->brand_id=$request->brand_id;
        $product->supplier_id=$request->supplier_id;
        $product->category_id=$request->category_id;
        $product->tax_rate_id=$request->tax_rate_id;
        $product->location_id=$request->location_id;
        $product->sku=$request->sku;
        $product->upc_ean=$request->upc_ean;
        $product->supplier_pid=$request->supplier_pid;
        $product->price=$request->price;
        $product->stock=$request->stock;
        $product->description=$request->description;
        $product->status=$request->status;
       
        $product->save();

        $history = new History();
        $history->user_id = Auth::user()->id;
        $history->product_id = $product->id;
        $history->service_id = 0;
        $history->status = "Tambah";
        $history->username = Auth::user()->first_name;
        $history->description = "Produk baru telah ditambahkan '" . $request->product_name . "'."; 
        $history->nama = $request->product_name;
        $history->save();

        return redirect('/product/list');
    }

    public function editProduct($id){
        $product = Product::find($id);
        // dd($product);
        // $supplierChoosen=Suppliers::where("id","=",$product->supplier_id)->get();
        // dd($supplierChoosen);
        return view('product.products.editproduct',[
            "title"=>"Edit Product",
            "product"=>$product,
            "suppliers"=>Suppliers::all(),
            "supplierChoosen"=>Suppliers::find($product->supplier_id),
            "brands"=>Brand::all(),
            "brandChoosen"=>Brand::find($product->brand_id),
            "categories"=>CategoryProduct::all(),
            "categoryChoosen"=>CategoryProduct::find($product->category_id),
            "tax"=>TaxRate::all(),
            "taxChoosen"=>TaxRate::find($product->tax_rate_id),
            "location"=>Location::all(),
            "locationChoosen"=>Location::find($product->location_id),
        ]);
    }

    public function saveEditProduct(Request $request,$id){
        // dd($request->all());
        $product = Product::find($id);
        // dd($product->product_name);
        if($product->product_name != $request->product_name){
            $history = new History();
            $history->user_id = Auth::user()->id;
            $history->product_id = $product->id;
            $history->service_id = 0;
            $history->status = "Edit";
            $history->username = Auth::user()->first_name;
            $history->nama = $request->product_name;
            $history->description = "Nama Produk telah diubah dari '" . $product->product_name . "' menjadi '" . $request->product_name . "'."; 
            $history->save();
        }
        if($product->simple_name != $request->simple_name){
            $history = new History();
            $history->user_id = Auth::user()->id;
            $history->product_id = $product->id;
            $history->service_id = 0;
            $history->status = "Edit";
            $history->username = Auth::user()->first_name;
            $history->nama = $request->product_name;
            $history->description = "Nama Simple Produk telah diubah dari '" . $product->simple_name . "' menjadi '" . $request->simple_name . "'."; 
            $history->save();
        }
        if($product->price != $request->price){
            $history = new History();
            $history->user_id = Auth::user()->id;
            $history->product_id = $product->id;
            $history->service_id = 0;
            $history->status = "Edit";
            $history->username = Auth::user()->first_name;
            $history->nama = $request->product_name;
            $history->description = "Harga Produk telah diubah dari '" . $product->price . "' menjadi '" . $request->price . "'."; 
            $history->save();
        }
        if($product->stock != $request->stock){
            $history = new History();
            $history->user_id = Auth::user()->id;
            $history->product_id = $product->id;
            $history->service_id = 0;
            $history->status = "Edit";
            $history->username = Auth::user()->first_name;
            $history->nama = $request->product_name;
            $history->description = "Stock Produk telah diubah dari '" . $product->stock . "' menjadi '" . $request->stock . "'."; 
            $history->save();
        }
        if($product->description != $request->description){
            $history = new History();
            $history->user_id = Auth::user()->id;
            $history->product_id = $product->id;
            $history->service_id = 0;
            $history->status = "Edit";
            $history->username = Auth::user()->first_name;
            $history->nama = $request->product_name;
            $history->description = "Deskripsi Produk telah diubah dari '" . $product->description . "' menjadi '" . $request->description . "'."; 
            $history->save();
        }
        if($product->status != $request->status){
            $history = new History();
            $history->user_id = Auth::user()->id;
            $history->product_id = $product->id;
            $history->service_id = 0;
            $history->status = "Edit";
            $history->username = Auth::user()->first_name;
            $history->nama = $request->product_name;
            $history->description = "Status Produk telah diubah dari '" . $product->status . "' menjadi '" . $request->status . "'."; 
            $history->save();
        }
        if($product->category_id != $request->category_id){
            $history = new History();
            $history->user_id = Auth::user()->id;
            $history->product_id = $product->id;
            $history->service_id = 0;
            $history->status = "Edit";
            $history->username = Auth::user()->first_name;
            $history->nama = $request->product_name;
            $ctgr = CategoryProduct::find($request->category_id);
            $history->description = "Category Produk telah diubah dari '" . $product->category->category_name . "' menjadi '" . $ctgr->category_name . "'."; 
            $history->save();
        }
        if($product->brand_id != $request->brand_id){
            $history = new History();
            $history->user_id = Auth::user()->id;
            $history->product_id = $product->id;
            $history->service_id = 0;
            $history->status = "Edit";
            $history->username = Auth::user()->first_name;
            $history->nama = $request->product_name;
            $brd = Brand::find($request->brand_id);
            $history->description = "Brand Produk telah diubah dari '" . $product->brand->brand_name . "' menjadi '" . $brd->brand_name . "'."; 
            $history->save();
        }
        if($product->supplier_id != $request->supplier_id){
            $history = new History();
            $history->user_id = Auth::user()->id;
            $history->product_id = $product->id;
            $history->service_id = 0;
            $history->status = "Edit";
            $history->username = Auth::user()->first_name;
            $history->nama = $request->product_name;
            $sup = Suppliers::find($request->supplier_id);
            $history->description = "Supplier Produk telah diubah dari '" . $product->supplier->suppliers_name . "' menjadi '" . $sup->suppliers_name . "'."; 
            $history->save();
        }
        if($product->location_id != $request->location_id){
            $history = new History();
            $history->user_id = Auth::user()->id;
            $history->product_id = $product->id;
            $history->service_id = 0;
            $history->status = "Edit";
            $history->username = Auth::user()->first_name;
            $history->nama = $request->product_name;
            $loc = Location::find($request->location_id);
            $history->description = "Lokasi Produk telah diubah dari '" . $product->location->location_name . "' menjadi '" . $loc->location_name . "'."; 
            $history->save();
        }
        if($product->tax_rate_id != $request->tax_rate_id){

        }


        $product->product_name= $request->product_name;
        $product->simple_name= $request->simple_name;
        $product->sku= $request->sku;
        $product->upc_ean= $request->upc_ean;
        $product->supplier_pid= $request->supplier_pid;
        $product->price= $request->price;
        $product->stock= $request->stock;
        $product->description= $request->description;
        $product->status= $request->status;
        $product->category_id= $request->category_id;
        $product->brand_id= $request->brand_id;
        $product->supplier_id= $request->supplier_id;
        $product->location_id= $request->location_id;
        $product->tax_rate_id= $request->tax_rate_id;
        
        

        $product->update();


        return redirect('/product/list');
    }
}
