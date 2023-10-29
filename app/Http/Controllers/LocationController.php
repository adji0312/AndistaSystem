<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LocationAddress;
use App\Models\LocationContactEmail;
use App\Models\LocationContactMessenger;
use App\Models\LocationContactPhone;
use App\Models\WorkingHours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{

    public function store(Request $request){

        // dd($request->all());
        // $checked = $request->has('all_day[]') ? 1 : 0;
        // dd($checked);
        // $checkAllDay = $request->has('all_day') ? 1 : 0;
        // dd($checkAllDay);
            

        $lastLocations = DB::table('locations')->latest('created_at')->first();
        $idLocation = 0;
        if($lastLocations == null){
            $idLocation = 1;
        }else{
            $idLocation = $lastLocations->id + 1;
        }

        // dd($idLocation);

        //phone
        $usage_phone_contact_id = $request->get('usage_phone_contact_id');
        $phone_type = $request->get('phone_type');
        $phone_number = $request->get('phone_number');

        // dd($usage_phone_contact_id);

        //email
        $usage_email_contact_id = $request->get('usage_email_contact_id');
        $email_address = $request->get('email_address');
        // dd($email_address);
        
        //messenger
        $usage_messenger_contact_id = $request->get('usage_messenger_contact_id');
        $username = $request->get('username');
        $messenger_type_id = $request->get('messenger_type_id');
        // dd($usage_messenger_contact_id);

        //working_hours
        $day = $request->get('day');
        $time_on = $request->get('time_on');
        $time_off = $request->get('time_off');
        $all_day = $request->get('all_day');
        // dd($all_day);
        

        // dd($idLocation);
        $validatedData = $request->validate([
            'location_name' => 'required|unique:locations',
            'type' => 'required',
            'status' => 'required',
            
        ]);
    
        if($request->image){
            $validatedData['image'] = $request->image;
        }else{
            $validatedData['image'] = '';
        }

        $validatedData1 = $request->validate([
            'street_address' => 'required',
            'usage_address_id' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required'
        ]);

        $validatedData1['location_id'] = $idLocation;
        $validatedData1['usage_address_id'] = $request->usage_address_id;

        if($request->additional_info){
            $validatedData1['additional_info'] = $request->additional_info;
        }else{
            $validatedData1['additional_info'] = '';
        }

        if($request->postal_code){
            $validatedData1['postal_code'] = $request->postal_code;
        }else{
            $validatedData1['postal_code'] = '';
        }
        
        // dd($validatedData1);
        LocationAddress::create($validatedData1);
        
    
        //Phone
        for($i = 0 ; $i < count($phone_type) ; $i++){
            LocationContactPhone::create([
                'usage_phone_contact_id' => $usage_phone_contact_id[$i],
                'phone_number' => $phone_number[$i],
                'phone_type' => $phone_type[$i],
                'location_id' => $idLocation
            ]); 
        }

        //Email
        for($i = 0 ; $i < count($email_address) ; $i++){
            LocationContactEmail::create([
                'usage_email_contact_id' => $usage_email_contact_id[$i],
                'email_address' => $email_address[$i],
                'location_id' => $idLocation
            ]); 
        }

        //Messenger
        for($i = 0 ; $i < count($username) ; $i++){
            print_r($i);
            LocationContactMessenger::create([
                'usage_messenger_contact_id' => $usage_messenger_contact_id[$i],
                'username' => $username[$i],
                'messenger_type_id' => $messenger_type_id[$i],
                'location_id' => $idLocation
            ]); 
        }

        //Operating Hours
        for($i = 0 ; $i < count($day) ; $i++){
            WorkingHours::create([
                'day' => $day[$i],
                'time_on' => $time_on[$i],
                'time_off' => $time_off[$i],
                'all_day' => $all_day[$i],
                'location_id' => $idLocation
            ]); 
        }
        
    
        
        
        
    
    
    
        Location::create($validatedData);
        return redirect('/location/list');
    }
}
