<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function treatmentPlan(){
        return view('service.treatmentplan', [
            "title" => "Treatment Plan"
        ]);
    }

    public function serviceCategory(){
        return view('service.servicecategory', [
            "title" => "Service Category"
        ]);
    }
    
}
