<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Position;
use App\Models\Role;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    //staffList
    public function staffList(){
        return view('staff.stafflist',[
            "staffs" => Staff::all(),
            "title" => "Staff List"
        ]);
    }

    //staffPosition
    public function staffPosition(){
        return view('staff.jobposition',[
            "title" => "Staff Position",
            "position" => Position::all()
        ]);
    }

    //staffWorkingHours
    public function staffWorkingHours(){
        return view('staff.dashboard',[
            "title" => "Staff Working Hours"
        ]);
    }

    public function staffAccessControl(){
        return view('staff.dashboard',[
            "title" => "Staff Access Control",
        ]);
    }

    public function saveStaffAccessControl(Request $request,$id){
        
        $roles = Role::find($id);

        //home
        $roles->role_name = $request->role_name;
        $roles->home_upcoming_booking = $request->home_upcoming_booking;
        //calendar
        $roles->calendar_calendar = $request->calendar_calendar;
        $roles->calendar_create_booking = $request->calendar_create_booking;
        $roles->calendar_list_booking = $request->calendar_list_booking;
        //Staff
        $roles->staff_dashboard = $request->staff_dashboard;
        $roles->staff_staff_list = $request->staff_staff_list;
        $roles->staff_job = $request->staff_job;
        $roles->staff_access_control = $request->staff_access_control;
        $roles->staff_security_group = $request->staff_security_group;
        //Service
        $roles->service_dashboard = $request->service_dashboard;
        $roles->service_list = $request->service_list;
        $roles->service_treatment_plan = $request->service_treatment_plan;
        $roles->service_category = $request->service_category;
        $roles->service_diagnosis = $request->service_diagnosis;
        $roles->service_policy = $request->service_policy;
        //Product
        $roles->product_dashboard = $request->product_dashboard;
        $roles->product_list = $request->product_list;
        $roles->product_brand = $request->product_brand;
        $roles->product_category = $request->product_category;
        $roles->product_suppliers = $request->product_suppliers;
        //Location
        $roles->dashboard_location = $request->dashboard_location;
        $roles->location_list = $request->location_list;
        $roles->facilities = $request->facilities;
        $roles->setting_location = $request->setting_location;
        //Finance
        $roles->dashboard_finance = $request->dashboard_finance;
        $roles->sale_list = $request->sale_list;
        $roles->quotation_list = $request->quotation_list;
        $roles->tax_rate = $request->tax_rate;
        //Attendance
        $roles->dashboard_attendance = $request->dashboard_attendance;
        $roles->attendance_list = $request->attendance_list;
        $roles->working_shift = $request->working_shift;
        $roles->manage_staff_shift = $request->manage_staff_shift;
        //Presence
        $roles->absent = $request->absent;
        //Reports
        $roles->reports_all = $request->reports_all;

        $roles->update();
    }

    //staffSecurityGroups
    public function staffSecurityGroups(){
        return view('staff.securitygroup',[
            "title" => "Staff Security Groups",
            "roles" => Role::all()
        ]);
    }

    //newStaff
    public function newStaff(){
        return view('staff.newstaff',[
            "title" => "New Staff"
        ]);
    }

    public function addStaff(Request $request){
        // dd($request->all());
        // echo("sip");
        $validated = $request->validate([
            'first_name' => 'required',
            'middle_email' => 'required',
            'last_name' => 'required',
            'nickname' => 'required',
            'gender' => 'required',
        ]);

        // echo("sip");

        Staff::create($validated);

        return redirect('/staff/list')->with('success','New Staff Added Successfully');
    }

    public function update(Request $request, $id){
        $request->validate([
            'first_name' => 'required',
            'middle_email' => 'required',
            'last_name' => 'required',
            'nickname' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'description' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'image' => 'required',
        ]);

        $staff = Staff::find($id);
        $staff->first_name = $request->first_name;
        $staff->middle_name = $request->middle_name;
        $staff->last_name = $request->last_name;
        $staff->nickname = $request->nickname;
        $staff->gender = $request->gender;
        $staff->status = $request->status;
        $staff->description = $request->description;
        $staff->phone = $request->phone;
        $staff->email = $request->email;
        $staff->image = $request->image;
        $staff->save();

        return redirect('/staff/stafflist')->with('success','Staff Updated Successfully');
    }

    public function delete($id){
        $staff = Staff::find($id);
        $staff->delete();

        return redirect('/staff/stafflist')->with('success','Staff Deleted Successfully');
    }

    public function deleteStaffJob(Request $request){
        $myString = $request->deleteId;
        $myArray = explode(',', $myString);
        // print_r($myArray);
        $length = count($myArray);

        for($i = 0 ; $i < $length ; $i++){
            $supplier = Position::find($myArray[$i]);
            // @dd($supplier);
            // print_r($supplier);
            DB::table('positions')->where('id', $supplier->id)->delete();
            Log::info('Job Position is deleted',['job'=>$supplier->position_name]);
        }

        return redirect('/staff/position');
    }

    public function addStaffPosition(Request $request){
        $validated = $request->validate([
            'position_name' => 'required',
        ]);

        Position::create($validated);

        Log::info('Staff Added ',[$request->position_name]);

        return redirect('/staff/position')->with('success','New Job Position Added Successfully');
    }

    public function updateStaffPosition(Request $request, $id){
        $positionOld = Position::find($id);
        $newPosition = $positionOld;
        $positionOld->position_name = $request->position_name;
        $positionOld->update();

        Log::info('Job update to ',[$positionOld]);

        return redirect('/staff/position')->with('success','Job Position Updated Successfully');
    }
    
}
