<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Role;
use App\Models\Staff;
use Illuminate\Http\Request;
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
            "title" => "Staff Access Control"
        ]);
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
}
