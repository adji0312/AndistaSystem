<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Shift;
use Illuminate\Http\Request;

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
}
