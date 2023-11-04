<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request){
    //    dd($request->all());
        $validatedData = $request->validate([
            'task_name' => 'required|unique:tasks',
        ]);

        Task::create($validatedData);
        return redirect('/service/treatmentplan/add'.'/'.$request->name)->with('successAddTask', 'wkwkwk');
    }
}
