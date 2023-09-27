<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\UnitFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacilityController extends Controller
{
public function store(Request $request){
    $unit_name = $request->get('unit_name');
    $unit_note = $request->get('notes');
    // dd($unit_note);
    $unit_status = $request->get('unit_status');
    $lastFacility = DB::table('facilities')->latest('created_at')->first();
    $validatedData = $request->validate([
        'facility_name' => 'required|unique:facilities',
        'capacity' => 'required',
        'status' => 'required',
    ]);

    $validatedData['location_id'] = 1;
    $validatedData['share_facility'] = 1;
    $validatedData['image'] = '';

    if(count($unit_name) > 1){
        for($i = 1 ; $i <= count($unit_name) ; $i++){
            // $validatedData2 = $request->validate([
            //     'unit_name' => 'required|unique:unit_facilities',
            //     'unit_status' => 'required'
            // ]);
            // if($request->notes){
            //     $validatedData2['notes'] = $request->notes;
            // }
            if($lastFacility == null){
                UnitFacility::create([
                    'unit_name' => $unit_name[$i],
                    'unit_status' => $unit_status[$i],
                    'notes' => $unit_note[$i],
                    'facility_id' => 1
                ]);
            }else{
                UnitFacility::create([
                    'unit_name' => $unit_name[$i],
                    'unit_status' => $unit_status[$i],
                    'notes' => $unit_note[$i],
                    'facility_id' => $lastFacility->id + 1
                ]);
            }
        }
    }else{
        $validatedData2 = $request->validate([
            'unit_name' => 'required|unique:unit_facilities',
            'unit_status' => 'required'
        ]);
        if($request->notes){
            $validatedData2['notes'] = $request->notes;
        }
        $validatedData2['facility_id'] = $lastFacility->id + 1; 
        
        UnitFacility::create($validatedData2);
    }
    

    
    
    



    Facility::create($validatedData);
    return redirect('/location/facility');
}

    public function edit($facility_name){

    }
}
