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

    public function attendancelistbylocation($name){
        $location = Location::where('location_name', $name)->first();
        // dd($location);
        return view('attendance.attendancelistbylocation', [
            "title" => "Attendance List",
            "location" => $location
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
}
