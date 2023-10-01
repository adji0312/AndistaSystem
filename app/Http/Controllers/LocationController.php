<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LocationContactEmail;
use App\Models\LocationContactMessenger;
use App\Models\LocationContactPhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    // public function store(Request $request){
    //     dd($request->all());
    // }

    public function store(Request $request){
        // dd($request->all());
        // phone
        $usage_phone_contact_id = $request->get('usage_phone_contact_id');
        // dd($usage_phone_contact_id);
        $phone_type = $request->get('phone_type');
        $phone_number = $request->get('phone_number');
        // dd($phone_number);

        //email
        $usage_email_contact_id = $request->get('usage_email_contact_id');
        $email_address = $request->get('email_address');
        
        //messenger
        $usage_messenger_contact_id = $request->get('usage_messenger_contact_id');
        $username = $request->get('username');
        $messenger_type_id = $request->get('messenger_type_id');

        $lastLocations = DB::table('locations')->latest('created_at')->first();
        $idLocation = 0;
        if($lastLocations == null){
            $idLocation = 1;
        }else{
            $idLocation = $lastLocations->id + 1;
        }

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

        
        // dd($validatedData);
    
        //Phone
        // if(count($phone_type) > 1){
            for($i = 0 ; $i < count($phone_type) ; $i++){
                LocationContactPhone::create([
                    'usage_phone_contact_id' => $usage_phone_contact_id[$i],
                    'phone_number' => $phone_number[$i],
                    'phone_type' => $phone_type[$i],
                    'location_id' => $idLocation
                ]); 
            }
        // }
        // else{
        //     $validatedData2 = $request->validate([
        //         'usage_phone_contact_id' => 'required',
        //         'phone_number' => 'required',
        //         'phone_type' => 'required',
        //     ]);
        //     $validatedData2['location_id'] = $idLocation; 
            
        //     LocationContactPhone::create($validatedData2);
        // }

        //Email
        // if(count($email_address) > 1){
            for($i = 0 ; $i < count($email_address) ; $i++){
                LocationContactEmail::create([
                    'usage_email_contact_id' => $usage_email_contact_id[$i],
                    'email_address' => $email_address[$i],
                    'location_id' => $idLocation
                ]); 
            }
        // }
        // else{
        //     $validatedData3 = $request->validate([
        //         'usage_email_contact_id' => 'required',
        //         'email_address' => 'required',
        //     ]);
        //     $validatedData3['location_id'] = $idLocation; 
            
        //     LocationContactEmail::create($validatedData3);
        // }

        //Messenger
        // if(count($username) > 1){
            for($i = 0 ; $i < count($username) ; $i++){
                LocationContactMessenger::create([
                    'usage_messenger_contact_id' => $usage_messenger_contact_id[$i],
                    'username' => $username[$i],
                    'messenger_type_id' => $messenger_type_id[$i],
                    'location_id' => $idLocation
                ]); 
            }
        // }
        // else{
        //     $validatedData4 = $request->validate([
        //         'usage_messenger_contact_id' => 'required',
        //         'username' => 'required',
        //         'messenger_type_id' => 'required',
        //     ]);
        //     $validatedData4['location_id'] = $idLocation; 
            
        //     LocationContactMessenger::create($validatedData4);
        // }
        
    
        
        
        
    
    
    
        Location::create($validatedData);
        return redirect('/location/list');
    }
}
