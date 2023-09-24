<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\UnitFacility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function store(Request $request){
           dd($request->all());
            $validatedData = $request->validate([
                'facility_name' => 'required|unique:facilities',
                'capacity' => 'required',
                'status' => 'required',
            ]);

            $validatedData['location_id'] = 1;
            $validatedData['share_facility'] = 1;
            $validatedData['image'] = '';

            $validatedData2 = $request->validate([
                'unit_name' => 'required|unique:unit_facilities',
                'status' => 'required'
            ]);

            $validatedData2['facility_id'] = 1;
            if($request->notes){
                $validatedData2['notes'] = $request->notes;
            }

    
            Facility::create($validatedData);
            UnitFacility::create($validatedData2);
            return redirect('/location/facility');
    }

    public function edit($facility_name){

    }
}
