<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\OffDay;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function dashboard(){
        return view('attendance.dashboard', [
            "title" => "Attendance Dashboard"
        ]);
    }

    public function attendancelist(){
        return view('attendance.attendancelist', [
            "title" => "Attendance List",
            "locations" => Location::all()
        ]);
    }

    public function attendancelistbylocation(Request $request, $name){
        // dd($request->all());
        $location = Location::where('location_name', $name)->first();
        return view('attendance.attendancelistbylocation', [
            "title" => "Attendance List",
            "location" => $location,
            "month" => $request->month,
            "year" => $request->year,
        ]);
    }

    public function workingshift(){
        return view('attendance.workingshift', [
            "title" => "Working Shift",
            "shifts" => Shift::all()
        ]);
    }

    public function managestaff(){
        return view('attendance.managestaff', [
            "title" => "Manage Staff",
            "shifts" => Shift::all(),
            "locations" => Location::all()
        ]);
    }

    public function staffbylocation($name){
        $location = Location::where('location_name', $name)->first();
        // dd($location);
        return view('attendance.staffbylocation', [
            "title" => "Manage Staff",
            "shifts" => Shift::all(),
            "location" => $location
        ]);
    }

    public function managedayoff(){
        $dayoff = OffDay::all();

        return view('attendance.dayoff', [
            "title" => "Manage Day Off",
            "shifts" => Shift::all(),
            "locations" => Location::all(),
            "dayoff" => $dayoff
        ]);
    }

    public function storeDayOff(Request $request){
        $dayoff = new OffDay();
        $dayoff->name = $request->name;
        $dayoff->tanggal_merah = $request->tanggal_merah;
        $dayoff->save();
        return redirect()->back();
    }

    public function editDayOff(Request $request, $id){
        $dayoff = OffDay::find($id);
        $dayoff->name = $request->name;
        $dayoff->tanggal_merah = $request->tanggal_merah;
        $dayoff->save();
        return redirect()->back();
    }

    public function deleteDayOff(Request $request){
        
        $myString = $request->deleteId;
        $myArray = explode(',', $myString);
        // print_r(count($myArray));
        $length = count($myArray);

        for($i = 0 ; $i < $length ; $i++){
            $dayoff = OffDay::find($myArray[$i]);
            DB::table('off_days')->where('id', $dayoff->id)->delete();
        }

        return redirect()->back();
    }
}
