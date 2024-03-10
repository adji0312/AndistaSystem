<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Location;
use App\Models\OffDay;
use App\Models\Shift;
use App\Models\Staff;
use App\Models\Workdays;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\PDF;

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
            "locations" => Location::all(),
            "staffs" => Staff::all(),
        ]);
    }

    
    public function attendancelistExport(){
        $data = [
            "title" => "Attendance List",
            "locations" => Location::all(),
            "staffs" => Staff::all(),
            "attendances" => Attendance::all()
        ];

        $pdf = PDF::loadView('attendance.attendancelistexport',$data);
        // $pdf->setPaper('A4', 'landscape');
        // $pdf->setFont('Times New Roman');
        return $pdf->download('attendance.attendancelist.pdf');
    }

    public function attendancelistbylocation(Request $request, $name){
        // dd($request->all());
        $location = Location::where('location_name', $name)->first();
        $staffs = Staff::all()->where('location_id', $location->id);
        // dd($staffs);
        
        // $attendance = Attendance::all()->where('')
        return view('attendance.attendancelistbylocation', [
            "title" => "Attendance List",
            "location" => $location,
            "month" => $request->month,
            "year" => $request->year,
            "staffs" => $staffs
            
        ]);
    }

    public function attendancelistbyfilter(Request $request){
        // dd($request->all());
        $location = $request->location_id;
        // $month = $request->month;
        // $year = $request->year;
        // // $now = Carbon::now();
        $month = $request->year .'-'. $request->month;
        // dd($month);
        $start = Carbon::parse($month)->startOfMonth();
        $end = Carbon::parse($month)->endOfMonth();

        $dates = [];
        while ($start->lte($end)) {
            $dates[] = $start->copy();
            $start->addDay();
        }
        // dd($dates);

        // dd(request('filterstaff'));

        $l = Location::where('location_name', $location)->first();
        // dd($l);

        $staffs = Staff::all();

        $result = DB::table('attendances')
            ->select('attendances.id','locations.location_name') 
            ->leftJoin('staff', 'attendances.staff_id', '=', 'staff.id')
            ->leftJoin('locations', 'staff.location_id', '=', 'locations.id')
            ->when($request->location_name, function ($query, $location_name) {
                return $query->where('locations.location_name', $location_name);
            })
            ->when($request->staff_id, function ($query, $staff_id) {
                return $query->where('staff.id', $staff_id);
            })

            ->get();

    // @dd($result);
        

    $finalResult = [];

    foreach ($result as $row) {
        $attendance = Attendance::find($row->id);
        // dd($attendance);
        //month and year find
        if($attendance->created_at->month == $request->month && $attendance->created_at->year == $request->year && $attendance->staff_id == $request->staff_id){
            $finalResult[] = $attendance;
        }

        // //month only , year null
        // else if($attendance->created_at->month == $request->month && $request->year == ''){
        //     $finalResult[] = $attendance;
        // }

        // //year only , month null
        // else if($request->month=='' && $attendance->created_at->year == $request->year){
        //     $finalResult[] = $attendance;
        // }

        // else if($request->month=='' && $request->year==''){
        //     $finalResult[] = $attendance;
        // }

        else{

        }
    }

        $staffDetail = Staff::find($request->staff_id);

    // @dd($finalResult);

        return view('attendance.attendancelistbylocation', [
            "title" => "Attendance List",
            "month" => $request->month,
            "year" => $request->year,
            "attendances" => $finalResult,
            "staffs" => $staffs,
            "now" => $dates,
            "staff" => $staffDetail
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

    public function addWorkDays(Request $request){
        // dd($request->all());
        $workDays = new Workdays();
        $workDays->staff_id = $request->staff_id;
        $workDays->Monday = $request->Monday;
        $workDays->Tuesday = $request->Tuesday;
        $workDays->Wednesday = $request->Wednesday;
        $workDays->Thursday = $request->Thursday;
        $workDays->Friday = $request->Friday;
        $workDays->Saturday = $request->Saturday;
        $workDays->Sunday = $request->Sunday;
        $workDays->save();

        return redirect()->back();

    }

    public function updateWorkDays(Request $request, $id){
        // dd($request->all());
        $workDays = Workdays::find($id);
        // dd($workDays);
        // $workDays->staff_id = $request->staff_id;
        $workDays->Monday = $request->Monday;
        $workDays->Tuesday = $request->Tuesday;
        $workDays->Wednesday = $request->Wednesday;
        $workDays->Thursday = $request->Thursday;
        $workDays->Friday = $request->Friday;
        $workDays->Saturday = $request->Saturday;
        $workDays->Sunday = $request->Sunday;
        $workDays->save();

        return redirect()->back();

    }
}
