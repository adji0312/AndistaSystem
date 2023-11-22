<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagnosisController extends Controller
{
    public function store(Request $request){
        $validatedData = $request->validate([
            'diagnosis_name' => 'required|unique:diagnoses',
        ]);

        Diagnosis::create($validatedData);
        return redirect('/service/diagnosis');
    }

    public function update(Request $request, $id){
       
        $diagnosis = Diagnosis::find($id);

        $rules = [];

        if($request->diagnosis_name != $diagnosis->diagnosis_name){
            $rules['diagnosis_name'] = 'required|unique:diagnoses';
        }

        $validatedData = $request->validate($rules);

        Diagnosis::where('id', $diagnosis->id)->update($validatedData);
        return redirect('/service/diagnosis');
    }

    public function deleteDiagnosis(Request $request){
        
        $myString = $request->deleteId;
        $myArray = explode(',', $myString);
        // print_r(count($myArray));
        $length = count($myArray);

        for($i = 0 ; $i < $length ; $i++){
            $diagnosis = Diagnosis::find($myArray[$i]);
            DB::table('diagnoses')->where('id', $diagnosis->id)->delete();
        }

        return redirect('/service/diagnosis');
    }
}
