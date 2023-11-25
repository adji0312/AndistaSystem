<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function productList(){
        return view('product.productlist',[
            "title"=>"Product List",
            "products"=>Product::all()
        ]);
    }

    public function suppliers(){
        return view('product.supplier',[
            "title"=>"Product Supplier"
        ]);
    }

    public function brands(){
        return view('product.brand',[
            "title"=>"Product Brand"
        ]);
    }

    public function categories(){
        return view('product.category',[
            "title"=>"Product Category"
        ]);
    }
}
