<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShiftController extends Controller
{
    public function addshift(Request $request){
        $validatedData = $request->validate([
            'shift_name' => 'required|unique:shifts',
            'start_hour' => 'required',
            'end_hour' => 'required',
            'jam_mulai' => 'required',
            'jam_berakhir' => 'required',
        ]);

        Shift::create($validatedData);
        return redirect('/attendance/workingshift')->with('successAddTask', 'wkwkwk');
    }

    // public function editShift(Request $request, $id){
    //     $shift = Shift::find($id);

    //     $validatedData = $request->validate([
    //         'shift_name' => 'required|unique:shifts',
    //         'start_hour' => 'required',
    //         'end_hour' => 'required',
    //     ]);

    //     Shift::create($validatedData);
    //     return redirect('/attendance/workingshift')->with('successAddTask', 'wkwkwk');
    // }

    public function editShift(Request $request, $id){

        $shift = Shift::find($id);

        DB::table('shifts')
            ->where('id', $shift->id)
            ->update(['shift_name' => $request->shift_name,
                      'start_hour' => $request->start_hour,
                      'end_hour' => $request->end_hour,
                      'jam_mulai' => $request->jam_mulai,
                      'jam_berakhir' => $request->jam_berakhir]);
        return redirect('/attendance/workingshift');
    }

    public function deleteShift(Request $request){
        
        $myString = $request->deleteId;
        $myArray = explode(',', $myString);
        // print_r(count($myArray));
        $length = count($myArray);

        for($i = 0 ; $i < $length ; $i++){
            $shift = Shift::find($myArray[$i]);
            DB::table('shifts')->where('id', $shift->id)->delete();
        }

        return redirect('/attendance/workingshift');
    }
}
