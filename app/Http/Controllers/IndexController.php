<?php

namespace App\Http\Controllers;

use App\Models\CategoryService;
use App\Models\Policy;
use App\Models\TaxRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function home(){
        return view('home', [
            "title" => "Home"
        ]);
    }   

    public function locationDashboard(){
        return view('location.dashboard', [
            "title" => "Location Dashboard"
        ]);
    }
    
    public function locationList(){
        return view('location.locationslist', [
            "title" => "Location List"
        ]);
    }
    public function addLocation(){
        return view('location.addLocation', [
            "title" => "Location List"
        ]);
    }
    
    public function locationFacility(){
        return view('location.locationfacilities', [
            "title" => "Facility"
        ]);
    }

    public function addFacility(){
        return view('location.addFacility', [
            "title" => "Facility"
        ]);
    }

    public function serviceDashboard(){
        return view('service.dashboard', [
            "title" => "Service Dashboard"
        ]);
    }

    public function serviceList(){
        return view('service.serviceslist', [
            "title" => "Service List"
        ]);
    }

    public function addService(){
        return view('service.addservice', [
            "title" => "Service List",
            "categories" => CategoryService::all(),
            "tax" => TaxRate::all()
        ]);
    }

    public function treatmentPlan(){
        return view('service.treatmentplan', [
            "title" => "Treatment Plan"
        ]);
    }

    public function addTreatmentPlan(){
        return view('service.addtreatmentplan', [
            "title" => "Treatment Plan"
        ]);
    }

    public function serviceCategory(){
        return view('service.servicecategory', [
            "title" => "Service Category",
            "categories" => CategoryService::latest()->paginate(20)->withQueryString()
        ]);
    }

    public function policy(){
        return view('service.policy', [
            "title" => "Policy",
            "policies" => Policy::all()
        ]);
    }
    public function addPolicy(){
        return view('service.addPolicy', [
            "title" => "Policy"
        ]);
    }

    public function editPolicy($id){

        // dd($id);
        
        $policy = Policy::find(decrypt($id));
        // dd($policy);

        return view('service.editPolicy', [
            "title" => "Policy",
            "policy" => $policy
        ]);
    }

    public function store(Request $request){
        return view('service.servicecategory', 
        [
            "title" => "Service Category",
            'categpries' => $request->redirectlink
        ]);
    }

    public function financeDashboard(){
        return view('finance.dashboard', [
            "title" => "Finance Dashboard"
        ]);
    }

    public function financeTaxRate(){
        return view('finance.taxrate', [
            "title" => "Tax Rate",
            "tax" => TaxRate::all()
        ]);
    }

    public function customer(){
        return view('customer.dashboard',[
            "title" => "Customer Dashboard"
        ]);
    }
    
}
