<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    
    public function storeTreatment(Request $request){
        // dd($request->all());

        $validatedData = $request->validate([
            'name' => 'required|unique:plans',
            'location_id' => 'required',
            'diagnosis_id' => 'required',
            'duration' => 'required',
        ]);

        $validatedData['temp'] = 0;
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
            'duration' => 'required'
        ]);

        Plan::where('id', $plan->id)->update($validatedData);
        return redirect('/service/treatmentplan');
    }

    public function deletePlan(Request $request){
        // dd($request->all());
        $myString = $request->deleteId;
        $myArray = explode(',', $myString);
        // print_r(count($myArray));
        $length = count($myArray);

        for($i = 0 ; $i < $length ; $i++){
            $plan = Plan::find($myArray[$i]);
            DB::table('plans')->where('id', $plan->id)->delete();
            DB::table('list_plans')->where('plan_id', $plan->id)->delete();
        }

        return redirect('/service/treatmentplan');
    }
}
