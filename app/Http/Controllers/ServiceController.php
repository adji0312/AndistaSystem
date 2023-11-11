<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServicePrice;
use Illuminate\Http\Request;
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
                'service_name' => 'required',
                'status' => 'required',
                'location_id' => 'required',
                'category_service_id' => 'required',
                'policy_id' => 'required'
            ]);
            if($request->simple_service_name != null || $request->simple_service_name != ''){
                $validatedData['simple_service_name'] = $request->simple_service_name;
            }else{
                $validatedData['simple_service_name'] = '-';
            }

            if($request->tax_id != null || $request->tax_id != ''){
                $validatedData['tax_id'] = $request->tax_id;
            }else{
                $validatedData['tax_id'] = '-';
            }

            $validatedData['staffCheck'] = 1;
            $validatedData['facilityCheck'] = 1;

            Service::create($validatedData);
            $lastService = DB::table('services')->latest('created_at')->first();
            // dd($lastService);
            return redirect('/service/list' . '/' . $lastService->service_name);
        }else{
            $validatedData = $request->validate([
                'service_name' => 'required',
                'status' => 'required',
                'location_id' => 'required',
                'category_service_id' => 'required',
                'policy_id' => 'required'
            ]);
            if($request->simple_service_name != null || $request->simple_service_name != ''){
                $validatedData['simple_service_name'] = $request->simple_service_name;
            }else{
                $validatedData['simple_service_name'] = '-';
            }

            if($request->tax_id != null || $request->tax_id != ''){
                $validatedData['tax_id'] = $request->tax_id;
            }else{
                $validatedData['tax_id'] = '-';
            }

            $validatedData['staffCheck'] = 1;
            $validatedData['facilityCheck'] = 1;

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

            return redirect('/service/list');
        }
    }

    public function deleteService(Request $request){
        
        $myString = $request->deleteId;
        $myArray = explode(',', $myString);
        // print_r(count($myArray));
        $length = count($myArray);

        for($i = 0 ; $i < $length ; $i++){
            $service = Service::find($myArray[$i]);
            // print_r($category->category_service_name);
            DB::table('services')->where('id', $service->id)->delete();
        }

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
}
