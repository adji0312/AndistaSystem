<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\UnitFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacilityController extends Controller
{
    public function store(Request $request){
        // dd($request->all());
        // dd(count($unit_name));

        $unit_name = $request->get('unit_name');
        $unit_note = $request->get('notes');
        $unit_status = $request->get('unit_status');
        // dd($unit_name);
        
        //kondisi tanpa perlu unit
        if(count($unit_name) <= 1 && $unit_name[0] == null){
            $validatedData = $request->validate([
                'facility_name' => 'required|unique:facilities',
                'capacity' => 'required',
                'status' => 'required',
            ]);
    
            $validatedData['location_id'] = 1;
            $validatedData['share_facility'] = 1;
            $validatedData['image'] = $request->file('image')->store('public');
            Facility::create($validatedData);
            return redirect('/facility');
        }else{
           
            $validatedData = $request->validate([
                'facility_name' => 'required|unique:facilities',
                'capacity' => 'required',
                'status' => 'required',
            ]);
    
            $validatedData['location_id'] = 1;
            $validatedData['share_facility'] = 1;
            if($request->file('image')){
                $validatedData['image'] = $request->file('image')->store('public');
            }
            Facility::create($validatedData);
            $lastFacility = DB::table('facilities')->latest('created_at')->first();
            
            if(count($unit_name) > 1){
                for($i = 0 ; $i < count($unit_name) ; $i++){
                    UnitFacility::create([
                        'unit_name' => $unit_name[$i],
                        'unit_status' => $unit_status[$i],
                        'notes' => $unit_note[$i],
                        'facility_id' => $lastFacility->id
                    ]);
                }
            }else{
                UnitFacility::create([
                    'unit_name' => $unit_name[0],
                    'unit_status' => $unit_status[0],
                    'notes' => $unit_note[0],
                    'facility_id' => $lastFacility->id
                ]);
            }
            return redirect('/facility');
        }
        

        
        

        

        
        
        



        
    }

    public function edit(Request $request, $id){
        $facility = Facility::find($id);

        $rules = [
            "facility_name" => 'required',
            "capacity" => 'required',
            "status" => 'required',
            "location_id" => 'required',
            "share_facility" => 'required',
        ];

        $validatedData = $request->validate($rules);

        Facility::where('id', $facility->id)->update($validatedData);

        return redirect('/facility');
    }

    public function deleteFacility(Request $request){
        // dd($request->all());
        $myString = $request->deleteId;
        $myArray = explode(',', $myString);
        // print_r(count($myArray));
        $length = count($myArray);

        for($i = 0 ; $i < $length ; $i++){
            $category = Facility::find($myArray[$i]);
            DB::table('unit_facilities')->where('facility_id', $category->id)->delete();
            // print_r($category->category_service_name);
            DB::table('facilities')->where('id', $category->id)->delete();
        }

        return redirect('/facility');
    }
}
