<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Frequency;
use App\Models\ListPlan;
use App\Models\Location;
use App\Models\Plan;
use App\Models\Service;
use App\Models\ServicePrice;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListPlanController extends Controller
{

    public function index($name){

        $plan = Plan::where('name', $name)->first();
        // dd($plan);
        

        return view('service.listPlan', [
            'title' => 'List Plan',
            'plan' => $plan,
            'tasks' => Task::all(),
            'list_plans' => ListPlan::orderBy('temp', 'asc')->orderBy('start_day', 'asc')->where('plan_id', $plan->id)->get(),
            'frequencies' => Frequency::all(),
            'locations' => Location::all(),
            'diagnosis' => Diagnosis::all(),
            'services' => Service::all()->where('status', 'Active'),
            'servicePrice' => ServicePrice::all(),
            'service_id' => 0
        ]);
    }

    // public function store(Request $request){
        
    //     // dd($request->all());
    //     $validatedData = $request->validate([
    //         'start_day' => 'required',
    //         'frequency_id' => 'required',
    //         'duration' => 'required',
    //     ]);
        
    //     $validatedData['plan_id'] = $request->plan_id;
    //     $validatedData['temp'] = 1;
    //     $validatedData['task_id'] =  $request->task_id;
    //     $validatedData['service_id'] =  $request->service_id;
    //     $validatedData['product_id'] =  $request->product_id;
    //     $validatedData['notes'] =  $request->notes;

    //     // dd($validatedData);

    //     ListPlan::create($validatedData);

    //     return redirect('/service/treatmentplan/add'.'/'.$request->plan_name);
    // }

    public function deleteItem($id){
        DB::table('list_plans')->where('id', $id)->delete();
        return redirect()->back();
    }

    public function addServicePlan(Request $request){
        
        // dd($request->all());
        $validatedData = $request->validate([
            'service_id' => 'required',
            'plan_id' => 'required',
        ]);
        
        $validatedData['temp'] = 1;
        $validatedData['task_id'] =  0;
        $validatedData['product_id'] =  0;
        $validatedData['duration'] =  0;
        $validatedData['start_day'] =  0;
        $validatedData['frequency_id'] =  0;


        ListPlan::create($validatedData);

        return redirect('/service/treatmentplan/add'.'/'.$request->plan_name);
    }

    public function addTaskPlan(Request $request){
        
        // dd($request->all());
        $validatedData = $request->validate([
            'task_id' => 'required',
            'plan_id' => 'required',
        ]);
        
        $validatedData['temp'] = 1;
        $validatedData['service_id'] =  0;
        $validatedData['product_id'] =  0;
        $validatedData['duration'] =  0;
        $validatedData['start_day'] =  0;
        $validatedData['frequency_id'] =  0;


        ListPlan::create($validatedData);

        return redirect('/service/treatmentplan/add'.'/'.$request->plan_name);
    }
}
