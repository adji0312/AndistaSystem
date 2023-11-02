<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\UnitFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitFacilityController extends Controller
{
    public function store(Request $request){
        $facility = Facility::find($request->facility_id);
        
        $validatedData = $request->validate([
            'unit_name' => 'required',
            'unit_status' => 'required',
            'facility_id' => 'required'
        ]);

        $validatedData['notes'] = $request->notes;

        UnitFacility::create($validatedData);
        return redirect('/location/facility'.'/'. $facility->facility_name);
    }

    public function deleteUnit($id){
        
        
        DB::table('unit_facilities')->where('id', $id)->delete();
        return redirect()->back();
    }

    public function editUnit(Request $request, $id){
        $unit = UnitFacility::find($id);
        // dd($unit->facility->facility_name);
        $rules = [
            "facility_id" => 'required',
            "unit_name" => 'required',
            "unit_status" => 'required'
        ];

        $validatedData = $request->validate($rules);
        $validatedData['notes'] = $request->notes;

        UnitFacility::where('id', $unit->id)->update($validatedData);
        return redirect('/location/facility'.'/'.$unit->facility->facility_name);

    }
}
