<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    
    public function storeTreatment(Request $request){
        // dd($request->all());

        $validatedData = $request->validate([
            'name' => 'required|unique:plans',
            'location_id' => 'required',
            'diagnosis_id' => 'required'
        ]);

        $validatedData['duration'] = 0;
        Plan::create($validatedData);

        return redirect('/service/treatmentplan/add'.'/'.$request->name);
    }

    public function storeDiagnosis(Request $request){

        $validatedData = $request->validate([
            'diagnosis_name' => 'required',
        ]);

        Diagnosis::create($validatedData);
        return redirect('/service/treatmentplan/add');
    }

    public function updateTreatment(Request $request, $id){

        // dd($request->all());
        $plan = Plan::find($id);
        
        $validatedData = $request->validate([
            'name' => 'required:unique:plans',
            'location_id' => 'required',
            'diagnosis_id' => 'required',
        ]);

        Plan::where('id', $plan->id)->update($validatedData);
        return redirect('/service/treatmentplan');
    }
}
