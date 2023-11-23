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



        // dd($request->all());
        // $checked = $request->has('all_day[]') ? 1 : 0;
        // dd($checked);
        // $checkAllDay = $request->has('all_day') ? 1 : 0;
        // dd($checkAllDay);
            

        // $lastLocations = DB::table('locations')->latest('created_at')->first();
        // $idLocation = 0;
        // if($lastLocations == null){
        //     $idLocation = 1;
        // }else{
        //     $idLocation = $lastLocations->id + 1;
        // }

        // dd($idLocation);

        // //phone
        // $usage_phone_contact_id = $request->get('usage_phone_contact_id');
        // $phone_type = $request->get('phone_type');
        // $phone_number = $request->get('phone_number');
        
        // //email
        // $usage_email_contact_id = $request->get('usage_email_contact_id');
        // $email_address = $request->get('email_address');
        
        // //messenger
        // $usage_messenger_contact_id = $request->get('usage_messenger_contact_id');
        // $username = $request->get('username');
        // $messenger_type_id = $request->get('messenger_type_id');
        // // dd($usage_messenger_contact_id);

        
        // // dd($all_day);
        
        // // kondisi tanpa perlu phone, email dan messenger working hours harus ada tidak boleh null
        // if($usage_phone_contact_id == null && $usage_email_contact_id == null && $usage_messenger_contact_id == null){

        //     dd("null contact");
        //     $validatedData = $request->validate([
        //         'location_name' => 'required|unique:locations',
        //         'type' => 'required',
        //         'status' => 'required'
        //     ]);

        //     if($request->image){
        //         $validatedData['image'] = $request->image;
        //     }else{
        //         $validatedData['image'] = '-';
        //     }

        //     Location::create($validatedData);

        //     $lastLocations = DB::table('locations')->latest('created_at')->first();
        //     //Operating Hours
        //     for($i = 0 ; $i < count($day) ; $i++){
        //         WorkingHours::create([
        //             'day' => $day[$i],
        //             'time_on' => $time_on[$i],
        //             'time_off' => $time_off[$i],
        //             'all_day' => $all_day[$i],
        //             'location_id' => $lastLocations->id
        //         ]); 
        //     }

        //     return redirect('/location/list');
        // }else{

        //     if($usage_phone_contact_id != null){
        //         dd("phone tidak null");
        //     }else if($usage_email_contact_id != null){
        //         dd("email tidak null");
        //     }else if($usage_messenger_contact_id != null){
        //         dd("messenger tidak null");
        //     }
        //     // kondisi kalau phone tidak null

        //     dd("tidak null");
        //     $validatedData = $request->validate([
        //         'location_name' => 'required|unique:locations',
        //         'type' => 'required',
        //         'status' => 'required'
        //     ]);

        //     if($request->image){
        //         $validatedData['image'] = $request->image;
        //     }else{
        //         $validatedData['image'] = '-';
        //     }

        //     Location::create($validatedData);

        //     $lastLocations = DB::table('locations')->latest('created_at')->first();
        //     //Operating Hours
        //     for($i = 0 ; $i < count($day) ; $i++){
        //         WorkingHours::create([
        //             'day' => $day[$i],
        //             'time_on' => $time_on[$i],
        //             'time_off' => $time_off[$i],
        //             'all_day' => $all_day[$i],
        //             'location_id' => $lastLocations->id
        //         ]); 
        //     }

            
            
        
        //     //Phone
        //     for($i = 0 ; $i < count($phone_type) ; $i++){
        //         LocationContactPhone::create([
        //             'usage_phone_contact_id' => $usage_phone_contact_id[$i],
        //             'phone_number' => $phone_number[$i],
        //             'phone_type' => $phone_type[$i],
        //             'location_id' => $lastLocations->id
        //         ]); 
        //     }
    
        //     //Email
        //     for($i = 0 ; $i < count($email_address) ; $i++){
        //         LocationContactEmail::create([
        //             'usage_email_contact_id' => $usage_email_contact_id[$i],
        //             'email_address' => $email_address[$i],
        //             'location_id' => $lastLocations->id
        //         ]); 
        //     }
    
        //     //Messenger
        //     for($i = 0 ; $i < count($username) ; $i++){
        //         print_r($i);
        //         LocationContactMessenger::create([
        //             'usage_messenger_contact_id' => $usage_messenger_contact_id[$i],
        //             'username' => $username[$i],
        //             'messenger_type_id' => $messenger_type_id[$i],
        //             'location_id' => $lastLocations->id
        //         ]); 
        //     }
        // }

    

        
    
        
        
        
    
    
    
        // Location::create($validatedData);
        // return redirect('/location/list');
    }

    public function edit(Request $request, $id){
        dd($request->all());
        $location = Location::find($id);
        // dd(count($location->locationaddresses));
        $rules = [
            'location_name' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]; 
        $validatedData = $request->validate($rules);

        Location::where('id', $location->id)->update($validatedData);
        // $lastLocations = DB::table('locations')->latest('created_at')->first();

        
        if(count($location->locationaddresses) != 0){
            $rules2 = [
                'street_address' => '',
                'usage_address_id' => '',
                'city' => '',
                'state' => '',
                'country' => ''
            ];
            
            $validatedData2 = $request->validate($rules2);

            LocationAddress::where('location_id', $location->id)->update($validatedData2);
        }else{
            $validatedData1 = $request->validate([
                'street_address' => '',
                'usage_address_id' => '',
                'city' => '',
                'state' => '',
                'country' => ''
            ]);
    
            $validatedData1['location_id'] = $location->id;
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

    public function deletePhoneLocation($id){
        // dd($id);
        
        DB::table('location_contact_phones')->where('id', $id)->delete();
        return redirect()->back();
    }

    public function deleteEmail($id){
        DB::table('location_contact_emails')->where('id', $id)->delete();
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
}
