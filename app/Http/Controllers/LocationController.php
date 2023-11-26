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
        //working_hours
        $day = $request->get('day');
        $time_on = $request->get('time_on');
        $time_off = $request->get('time_off');
        $all_day = $request->get('all_day');

        // dd($day);

        $validatedData = $request->validate([
            'location_name' => 'required|unique:locations',
            'type' => 'required',
            'status' => 'required'
        ]);

        if($request->image){
            $validatedData['image'] = $request->image;
        }else{
            $validatedData['image'] = '-';
        }

        Location::create($validatedData);

        $lastLocations = DB::table('locations')->latest('created_at')->first();

        if($day != null){
            //Operating Hours
            for($i = 0 ; $i < count($day) ; $i++){
                WorkingHours::create([
                    'day' => $day[$i],
                    'time_on' => $time_on[$i],
                    'time_off' => $time_off[$i],
                    'all_day' => $all_day[$i],
                    'location_id' => $lastLocations->id
                ]); 
            }
        }


        $validatedData1 = $request->validate([
            'street_address' => '',
            'usage_address_id' => '',
            'city' => '',
            'state' => '',
            'country' => ''
        ]);

        $validatedData1['location_id'] = $lastLocations->id;
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
        
        LocationAddress::create($validatedData1);

        return redirect('/location' . '/' . $lastLocations->location_name);
    }

    public function edit(Request $request, $id){
        // dd($request->all());
        $location = Location::find($id);
        // dd(count($location->locationaddresses));
        $rules = [
            'type' => 'required',
            'status' => 'required',
        ]; 

        if($request->location_name != $location->location_name){
            $rules['location_name'] = 'required|unique:locations';
        }

        $validatedData = $request->validate($rules);

        Location::where('id', $location->id)->update($validatedData);
        // $lastLocations = DB::table('locations')->latest('created_at')->first();

        
        if(count($location->locationaddresses) != 0){
            $rules2 = [
                'usage_address_id' => '',
                'country' => '',
                'street_address' => '',
                'additional_info' => '',
                'city' => '',
                'state' => '',
                'postal_code' => ''
            ];
            
            $validatedData2 = $request->validate($rules2);

            LocationAddress::where('location_id', $location->id)->update($validatedData2);
        }else{
            $validatedData1 = $request->validate([
                'usage_address_id' => '',
                'country' => '',
                'street_address' => '',
                'additional_info' => '',
                'city' => '',
                'state' => '',
                'postal_code' => ''
            ]);
    
            $validatedData1['location_id'] = $location->id;
            
            LocationAddress::create($validatedData1);
        }

        return redirect('/location/list');

    }

    public function addPhoneLocation(Request $request){
        // dd($request->all());
        $validatedData = $request->validate([
            'usage_phone_contact_id' => 'required',
            'phone_number' => 'required',
            'phone_type' => 'required',
            'location_id' => 'required',
        ]);

        LocationContactPhone::create($validatedData);

        return redirect()->back();
    }

    public function addEmailLocation(Request $request){
        // dd($request->all());
        $validatedData = $request->validate([
            'usage_email_contact_id' => 'required',
            'email_address' => 'required',
            'location_id' => 'required',
        ]);

        LocationContactEmail::create($validatedData);

        return redirect()->back();
    }
    
    public function addMessengerLocation(Request $request){
        // dd($request->all());
        $validatedData = $request->validate([
            'usage_messenger_contact_id' => 'required',
            'username' => 'required',
            'location_id' => 'required',
            'messenger_type_id' => 'required',
        ]);

        LocationContactMessenger::create($validatedData);

        return redirect()->back();
    }

    public function deletePhoneLocation($id){
        // dd($id);
        
        DB::table('location_contact_phones')->where('id', $id)->delete();
        return redirect()->back();
    }

    public function deleteEmail($id){
        DB::table('location_contact_emails')->where('id', $id)->delete();
        return redirect()->back();
    }

    public function deleteMessengerLocation($id){
        DB::table('location_contact_messengers')->where('id', $id)->delete();
        return redirect()->back();
    }

    public function updatePhoneLocation(Request $request, $id){
        // dd($request->all());
        $phone = LocationContactPhone::find($id);

        $rules = [
            'usage_phone_contact_id' => 'required',
            'location_id' => 'required',
            'phone_number' => 'required',
            'phone_type' => 'required',
        ];
        $validatedData = $request->validate($rules);

        LocationContactPhone::where('id', $phone->id)->update($validatedData);
        return redirect()->back();
    }

    public function updateEmailLocation(Request $request, $id){
        // dd($request->all());
        $email = LocationContactEmail::find($id);

        $rules = [
            'usage_email_contact_id' => 'required',
            'location_id' => 'required',
            'email_address' => 'required'
        ];
        $validatedData = $request->validate($rules);

        LocationContactEmail::where('id', $email->id)->update($validatedData);
        return redirect()->back();
    }

    public function updateMessengerLocation(Request $request, $id){
        // dd($request->all());
        $messenger = LocationContactMessenger::find($id);

        $rules = [
            'usage_messenger_contact_id' => 'required',
            'location_id' => 'required',
            'username' => 'required',
            'messenger_type_id' => 'required'
        ];
        $validatedData = $request->validate($rules);

        LocationContactMessenger::where('id', $messenger->id)->update($validatedData);
        return redirect()->back();
    }
}
