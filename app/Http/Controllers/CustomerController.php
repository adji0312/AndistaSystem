<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function customerList(){
        return view('customer.customerlist',[
            "title" => "Customer List"
        ]);
    }

    public function customerSubList(){
        return view('customer.customersublist',[
            "title" => "Customer List"
        ]);
    }

    public function customerAdd(){
        return view('customer.addcustomer',[
            "title" => "Add Customer"
        ]);
    }
}
