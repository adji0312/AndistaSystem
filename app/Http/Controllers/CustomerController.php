<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Location;
use App\Models\MessengerType;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //
    public function customerList(){
        return view('customer.customerlist',[
            "title" => "Customer List",
            "customers" => Customer::all()
        ]);
    }

    public function customerSubList(){
        return view('customer.customersublist',[
            "title" => "Sub Customer List"
        ]);
    }


    public function addCustomer(){
        // @dd(MessengerType::all());
        return view('customer.addcustomer', [
            "title" => "Add Customer",
            "messengerType" => MessengerType::all(),
            // "categories" => CategoryService::all(),
            // "tax" => TaxRate::all(),
            "locations" => Location::all(),
            // "policies" => Policy::all(),
            // "facilities" => Facility::all()->where('status', 'Active'),
            // "staff" => Staff::all()
        ]);
    }

    public function store(Request $request){
        // Create customer
        $customer = new Customer;
        $customer->location_id = $request->location;
        $customer->first_name = $request->first_name;
        $customer->middle_name = $request->middle_name;
        $customer->last_name = $request->last_name;
        $customer->degree = $request->customer_degree;
        $customer->nickname = $request->nick_name;
        $customer->phone = $request->phone_customer;
        $customer->email = $request->email;
        $customer->messengerId = $request->messenger_type;
        $customer->messenger = $request->messenger;
        $customer->address = $request->address;
        $customer->card_type = $request->card_type;
        $customer->no_id = $request->id_no;
        $customer->join_date = $request->join_date;
        $customer->gender = $request->customer_gender;
        $customer->date_of_birth = $request->date_of_birth_customer;
        
        $customer->save();

        $pet = new Pet;
        $pet->customer_id = $customer->id;
        $pet->pet_name = $request->pet_name;
        $pet->pet_type = $request->pet_type;
        $pet->pet_ras = $request->pet_ras;
        $pet->pet_color = $request->pet_color;
        $pet->date_of_birth = $request->date_of_birth_pet;
        $pet->pet_gender = $request->gender;

        $pet->save();

        return view('customer.customerlist',[
            "title" => "Customer List",
            "customers" => Customer::all()
        ])->with('success', 'Customer created successfully');
    }

    public function deleteCustomer(Request $request){
        $pet = Pet::where('customer_id',$request->id)->get();
        foreach($pet as $p){
            $p->delete();
        }
        $customer = Customer::find($request->id);
        $customer->delete();
        return view('customer.customerlist',[
            "title" => "Customer List",
            "customers" => Customer::all()
        ])->with('success', 'Customer deleted successfully');
    }

    public function petList(){
        // @dd(Pet::all());
        return view('customer.customersublist',[
            "title" => "Customer Sub List",
            "pets" => Pet::all()
        ]);
    }

    public function updateCustomer($id){
        return view ('customer.editcustomer',[
            "title" => "Update Customer",
            "customer" => Customer::find($id),
            "messengerType" => MessengerType::all(),
            "messengerTypeCurr" => MessengerType::find(Customer::find($id)->messengerId),
            // "categories" => CategoryService::all(),
            // "tax" => TaxRate::all(),
            "locations" => Location::all(),
            // "policies" => Policy::all(),
            // "facilities" => Facility::all()->where('status', 'Active'),
            // "staff" => Staff::all()
        ]);

        
    }

    public function saveUpdateCustomer(Request $request, $id){
        // @dd($request->all());
        // @dd($request->all());
        // Create customer
        $customer = Customer::find(1)->first();
        $customer->location_id = $request->location;
        $customer->first_name = $request->first_name;
        $customer->middle_name = $request->middle_name;
        $customer->last_name = $request->last_name;
        $customer->degree = $request->customer_degree;
        $customer->nickname = $request->nick_name;
        $customer->phone = $request->phone_customer;
        $customer->email = $request->email;
        $customer->messengerId = $request->messenger_type;
        $customer->messenger = $request->messenger;
        $customer->address = $request->address;
        $customer->card_type = $request->card_type;
        $customer->no_id = $request->id_no;
        $customer->join_date = $request->join_date;
        $customer->gender = $request->customer_gender;
        $customer->date_of_birth = $request->date_of_birth_customer;
        
        $customer->save();

        $pet = Pet::where('customer_id','=',$id)->first();
        $pet->pet_name = $request->pet_name;
        $pet->pet_type = $request->pet_type;
        $pet->pet_ras = $request->pet_ras;
        $pet->pet_color = $request->pet_color;
        $pet->date_of_birth = $request->date_of_birth_pet;
        $pet->pet_gender = $request->gender;

        $pet->save();

        return view('customer.customerlist',[
            "title" => "Customer List",
            "customers" => Customer::all()
        ])->with('success', 'Customer created successfully');
    }

    public function customerDetail($id){
        // @dd(Customer::find($id)->messengerId);
        return view ('customer.customerdetail',[
            "title" => "Detail Customer",
            "customer" => Customer::find($id),
            "messengerType" => MessengerType::find(Customer::find($id)->messengerId),
            // "categories" => CategoryService::all(),
            // "tax" => TaxRate::all(),
            "locations" => Location::all(),
            // "policies" => Policy::all(),
            // "facilities" => Facility::all()->where('status', 'Active'),
            // "staff" => Staff::all()
        ]);
    }

}
