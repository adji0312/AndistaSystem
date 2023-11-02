<?php

namespace App\Http\Controllers;

use App\Models\ListPlan;
use Illuminate\Http\Request;

class ListPlanController extends Controller
{
    public function store(Request $request){
        
        // dd($request->all());
        $validatedData = $request->validate([
            'start_day' => 'required',
            'frequency' => 'required',
            'duration' => 'required',
        ]);
        
        $validatedData['temp'] = 1;
        $validatedData['task_id'] =  $request->task_id;
        $validatedData['service_id'] =  $request->service_id;
        $validatedData['product_id'] =  $request->product_id;
        $validatedData['notes'] =  $request->notes;

        // dd($validatedData);

        ListPlan::create($validatedData);
        return redirect('/service/treatmentplan/add');
    }
}
