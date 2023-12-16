<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Location;
use App\Models\OffDay;
use App\Models\Shift;
use App\Models\Staff;
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
        
        // $attendance = Attendance::all()->where('')
        return view('attendance.attendancelistbylocation', [
            "title" => "Attendance List",
            "location" => $location,
            "month" => $request->month,
            "year" => $request->year,
        ]);
    }

    public function attendancelistbyfilter(Request $request){
        // dd($request->all());
        $location = $request->location_name;
        $month = $request->month;
        $year = $request->year;

            $result = DB::table('attendances')
                ->leftJoin('staff', 'attendances.staff_id', '=', 'staff.id')
                ->leftJoin('locations', 'staff.location_id', '=', 'locations.id')
                ->when($request->location_name, function ($query, $location_name) {
                    return $query->where('locations.location_name', $location_name);
                })
                ->when($request->month, function ($query, $month) {
                    return $query->whereMonth('attendances.created_at', $month);
                })
                ->when($request->year, function ($query, $year) {
                    return $query->whereYear('attendances.created_at', $year);
                })
                ->get();

        @dd($result);


        // $location = Location::where('location_name', $name)->first();
        
        // $attendance = Attendance::all()->where('')
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
        $staff = Staff::latest()->where('location_id', $location->id)->paginate(20)->withQueryString();
        $shifts = Shift::all();
        // dd($location);
        return view('attendance.staffbylocation', [
            "title" => "Manage Staff",
            "shifts" => Shift::all(),
            "location" => $location,
            "staff" => $staff,
            "shifts" => $shifts
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

    public function updateShift(Request $request, $id){
        $staffShift = Staff::find($id);
        $staffShift->shifts_id = $request->shift_id;
        $staffShift->save();

        return redirect()->back();
    }

    public function updateFilterAttendanceList(Request $request){
        $location_id = $request->location_id;
        $month = $request->month;
        $year = $request->year;

        $filterAttendanceList = Attendance::query()
        ->whereRelation('staff','id','staff_id');

        @dd($filterAttendanceList);
    }
}
