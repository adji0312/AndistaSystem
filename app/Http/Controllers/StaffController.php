<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

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
        return view('staff.dashboard',[
            "title" => "Staff Position"
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
            "title" => "Staff Access Control"
        ]);
    }

    //staffSecurityGroups
    public function staffSecurityGroups(){
        return view('staff.dashboard',[
            "title" => "Staff Security Groups"
        ]);
    }

    //newStaff
    public function newStaff(){
        return view('staff.newstaff',[
            "title" => "New Staff"
        ]);
    }

    public function addStaff(Request $request){
        $request->validate([
            'staff_name' => 'required',
            'staff_email' => 'required',
            'staff_phone' => 'required',
            'staff_address' => 'required',
            'staff_password' => 'required',
            'staff_role' => 'required',
            'staff_position' => 'required',
            'staff_service' => 'required',
            'staff_working_hours' => 'required',
            'staff_access_control' => 'required',
            'staff_security_groups' => 'required',
        ]);

        Staff::create([
            'staff_name' => $request->staff_name,
            'staff_email' => $request->staff_email,
            'staff_phone' => $request->staff_phone,
            'staff_address' => $request->staff_address,
            'staff_password' => $request->staff_password,
            'staff_role' => $request->staff_role,
            'staff_position' => $request->staff_position,
            'staff_service' => $request->staff_service,
            'staff_working_hours' => $request->staff_working_hours,
            'staff_access_control' => $request->staff_access_control,
            'staff_security_groups' => $request->staff_security_groups,
        ]);

        return redirect('/staff/stafflist')->with('success','New Staff Added Successfully');
    }
}
