<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Service;
use App\Models\ServiceAndFacility;
use App\Models\ServiceAndStaff;
use App\Models\ServicePrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function store(Request $request){
        // dd($request->all());

        //table price services
        $duration = $request->get('duration');
        $duration_type = $request->get('duration_type');
        $price = $request->get('price');
        $location_price_id = $request->get('location_price_id');
        $price_title = $request->get('price_title');

        // dd($price_title);

        if(count($duration) <= 1 && $duration[0] == null){
            $validatedData = $request->validate([
                'service_name' => 'required|unique:services',
                'status' => 'required',
                'location_id' => 'required',
                'category_service_id' => 'required',
                // 'policy_id' => 'required'
            ]);
            if($request->simple_service_name != null || $request->simple_service_name != ''){
                $validatedData['simple_service_name'] = $request->simple_service_name;
            }else{
                $validatedData['simple_service_name'] = '-';
            }

            if($request->tax_id != null || $request->tax_id != ''){
                $validatedData['tax_id'] = $request->tax_id;
            }else{
                $validatedData['tax_id'] = 0;
            }

            // $validatedData['staffCheck'] = 1;
            // $validatedData['facilityCheck'] = 1;

            Service::create($validatedData);
            $lastService = DB::table('services')->latest('created_at')->first();
            return redirect('/service/list' . '/' . $lastService->service_name);
        }else{
            $validatedData = $request->validate([
                'service_name' => 'required|unique:services',
                'status' => 'required',
                'location_id' => 'required',
                'category_service_id' => 'required',
                // 'policy_id' => 'required'
            ]);
            if($request->simple_service_name != null || $request->simple_service_name != ''){
                $validatedData['simple_service_name'] = $request->simple_service_name;
            }else{
                $validatedData['simple_service_name'] = '-';
            }

            if($request->tax_id != null || $request->tax_id != ''){
                $validatedData['tax_id'] = $request->tax_id;
            }else{
                $validatedData['tax_id'] = 0;
            }

            // $validatedData['staffCheck'] = 1;
            // $validatedData['facilityCheck'] = 1;

            Service::create($validatedData);
            $lastService = DB::table('services')->latest('created_at')->first();

            if(count($duration) > 1){
                for($i = 0 ; $i < count($duration) ; $i++){
                    $duration = $request->get('duration');
                    $duration_type = $request->get('duration_type');
                    $price = $request->get('price');
                    $location_price_id = $request->get('location_price_id');
                    $price_title = $request->get('price_title');
                    ServicePrice::create([
                        'location_price_id' => $location_price_id[$i],
                        'service_id' => $lastService->id,
                        'duration' => $duration[$i],
                        'duration_type' => $duration_type[$i],
                        'price' => $price[$i],
                        'price_title' => $price_title[$i],
                    ]);
                }
            }else{
                ServicePrice::create([
                    'location_price_id' => $location_price_id[0],
                    'service_id' => $lastService->id,
                    'duration' => $duration[0],
                    'duration_type' => $duration_type[0],
                    'price' => $price[0],
                    'price_title' => $price_title[0],
                ]);
            }

            $lastService = DB::table('services')->latest('created_at')->first();

            $history = new History();
            $history->service_id = $lastService->id;
            $history->user_id = Auth::user()->id;
            $history->status = "Tambah";
            $history->username = Auth::user()->first_name;
            $history->nama = $lastService->service_name;
            $history->description = "Servis baru " . $lastService->service_name . " telah ditambahkan."; 
            $history->save();

            return redirect('/service/list' . '/' . $lastService->service_name);
        }
    }

    public function saveChange(Request $request, $id){
        $service = Service::find($id);
        $rules = [
            // 'service_name' => 'required|unique:services',
            'status' => 'required',
            'location_id' => 'required',
            'category_service_id' => 'required',
            // 'policy_id' => 'required',
            'simple_service_name' => '',
            // 'tax_id' => '',
        ];

        if($request->service_name != $service->service_name){
            $rules['service_name'] = 'required|unique:services';
        }

        $validatedData = $request->validate($rules);

        Service::where('id', $service->id)->update($validatedData);

        $history = new History();
        $history->service_id = $service->id;
        $history->user_id = Auth::user()->id;
        $history->status = "Edit";
        $history->username = Auth::user()->first_name;
        $history->nama = $service->service_name;
        $history->description = "Servis " . $service->service_name . " telah di ubah."; 
        $history->save();

        return redirect('/service/list');
    }

    public function deleteService(Request $request){
        
        $myString = $request->deleteId;
        $myArray = explode(',', $myString);
        // print_r(count($myArray));
        $length = count($myArray);

        for($i = 0 ; $i < $length ; $i++){
            $service = Service::find($myArray[$i]);
            $history = new History();
            $history->service_id = $service->id;
            $history->user_id = Auth::user()->id;
            $history->status = "Hapus";
            $history->username = Auth::user()->first_name;
            $history->nama = $service->service_name;
            $history->description = "Servis " . $service->service_name . " telah di hapus."; 
            $history->save();
            // print_r($category->category_service_name);
            DB::table('services')->where('id', $service->id)->delete();
            DB::table('service_prices')->where('service_id', $service->id)->delete();
            DB::table('service_and_staff')->where('service_id', $service->id)->delete();
            DB::table('service_and_facilities')->where('service_id', $service->id)->delete();
        }

        return redirect('/service/list');
    }

    public function discardChange($id){

        $service = Service::find($id);
        // dd($service);
        DB::table('service_prices')->where('service_id', $service->id)->delete();
        DB::table('service_and_staff')->where('service_id', $service->id)->delete();
        DB::table('service_and_facilities')->where('service_id', $service->id)->delete();
        DB::table('services')->where('id', $service->id)->delete();
        return redirect('/service/list');
    }

    public function addPriceService(Request $request){
        // dd($request->all());

        $service = Service::find($request->service_id);
        // dd($service);

        $validatedData = $request->validate([
            'location_price_id' => 'required',
            'service_id' => 'required',
            'duration' => 'required',
            'duration_type' => 'required',
            'price' => 'required'
        ]);
        
        if($request->price_title != null || $request->price_title != ''){
            $validatedData['price_title'] = $request->price_title;
        }else{
            $validatedData['price_title'] = '-';
        }

        ServicePrice::create($validatedData);
        return redirect('/service/list' . '/' . $service->service_name);
    }

    public function updatePriceService(Request $request, $id){
        $price = ServicePrice::find($id);
        // dd($request->price_title . $price->price_title);
        $service = Service::find($request->service_id);
        // dd($service);

        $rules = [
            'location_price_id' => 'required',
            'service_id' => 'required',
            'duration' => 'required',
            'duration_type' => 'required',
            'price' => 'required',
            'price_title' => '',
        ];

        // if($request->price_title != $price->price_title){
        //     $validatedData['price_title'] = $request->price_title;
        // }

        $validatedData = $request->validate($rules);

        ServicePrice::where('id', $price->id)->update($validatedData);
        return redirect('/service/list' . '/' . $service->service_name);
        
        // if($request->price_title != null || $request->price_title != ''){
        //     $validatedData['price_title'] = $request->price_title;
        // }else{
        //     $validatedData['price_title'] = '-';
        // }

        // ServicePrice::create($validatedData);
        // return redirect('/service/list' . '/' . $service->service_name);
    }

    public function addFacilityService(Request $request){
        
        $service = Service::find($request->service_id);
        // dd($request->all());
        $myArray = $request->facility_id;
        
        for($i = 0 ; $i < count($myArray) ; $i++){
            ServiceAndFacility::create(['service_id' => $request->service_id, 'facility_id' => $myArray[$i]]);
        }

        return redirect('/service/list' . '/' . $service->service_name);
    }

    public function addStaffService(Request $request){
        
        $service = Service::find($request->service_id);
        // dd($request->all());
        $myArray = $request->staff_id;
        
        for($i = 0 ; $i < count($myArray) ; $i++){
            ServiceAndStaff::create(['service_id' => $request->service_id, 'staff_id' => $myArray[$i]]);
        }

        return redirect('/service/list' . '/' . $service->service_name);
    }

    public function deleteFacilityService($id){
        DB::table('service_and_facilities')->where('id', $id)->delete();
        return redirect()->back();
    }

    public function deleteStaffService($id){
        DB::table('service_and_staff')->where('id', $id)->delete();
        return redirect()->back();
    }

    public function deletePriceService($id){
        DB::table('service_prices')->where('id', $id)->delete();
        return redirect()->back();
    }
}
