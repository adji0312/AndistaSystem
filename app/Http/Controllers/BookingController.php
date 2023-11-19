<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingService;
use App\Models\Location;
use App\Models\Service;
use App\Models\ServicePrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{

    public function listBooking(){
        return view('calendar.listbooking', [
            "title" => "List Booking",
            "locations" => Location::all()->where('status', 'Active'),
            "bookings" => Booking::all()
        ]);
    }

    public function createbooking(){
        return view('calendar.createBooking', [
            "title" => "Booking",
            "locations" => Location::all()->where('status', 'Active')
        ]);
    }
    
    public function createbookingDetail($name){
        $booking = Booking::all()->where('booking_name', $name)->first();
        // dd($booking);
        return view('calendar.createbookingDetail', [
            "title" => "Booking",
            "locations" => Location::all()->where('status', 'Active'),
            "booking" => $booking,
            "services" => Service::all()->where('status', 'Active'),
            "service_prices" => ServicePrice::all(),
            "booking_services" => BookingService::all()->where('booking_id', $booking->id)
        ]);
    }

    public function storeBooking(Request $request){
        // dd($request->all());
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'location_id' => 'required',
            'booking_date' => 'required',
        ]);

        $lastBooking = DB::table('bookings')->latest('created_at')->first();
        // dd($lastBooking);
        if($lastBooking == null || $lastBooking == ''){
            $nextNumber = sprintf("%05d", 1);
            $validatedData['booking_name'] = "BOOK-" . $nextNumber;
        }else{
            $nextNumber = sprintf("%05d", $lastBooking->id + 1);
            $validatedData['booking_name'] = "BOOK-" . $nextNumber;
        }

        // dd($validatedData['booking_name']);

        if($request->category != null || $request->category != ''){
            $validatedData['category'] = $request->category;
        }else{
            $validatedData['category'] = '-';
        }

        if($request->duration != null || $request->duration != ''){
            $validatedData['duration'] = $request->duration;
        }else{
            $validatedData['duration'] = 0;
        }

        if($request->resepsionisNotes != null || $request->resepsionisNotes != ''){
            $validatedData['resepsionisNotes'] = $request->resepsionisNotes;
        }else{
            $validatedData['resepsionisNotes'] = '-';
        }

        $validatedData['total_price'] = 0;
        $validatedData['status'] = "confirmed";
        $validatedData['temp'] = 1;

        Booking::create($validatedData);

        $lastBooking1 = DB::table('bookings')->latest('created_at')->first();
        return redirect('/newBooking' . '/' . $lastBooking1->booking_name);
    }

    public function addBookingService(Request $request){
        // dd($request->all());

        $service = Service::all()->where('service_name', $request->service_name)->first();
        // dd($service);

        // $booking = Booking::find($request->booking_id);
        $validatedData = $request->validate([
            'booking_id' => 'required',
            'time' => 'required'
        ]);
        $validatedData['service_id'] = $service->id;
        $validatedData['service_price_id'] = 0;
        $validatedData['service_staff_id'] = 0;
        $validatedData['price'] = 0;

        BookingService::create($validatedData);
        return redirect()->back();
    }

    public function editBookingService(Request $request, $id){

        $bookingservice = BookingService::find($id);
        $serviceprice = ServicePrice::find($request->service_price_id);
        // dd($serviceprice);
        $rules = [
            "service_price_id" => 'required',
            // "price" => 'required',
        ];



        $validatedData = $request->validate($rules);
        $validatedData['price'] = $serviceprice->price;

        BookingService::where('id', $bookingservice->id)->update($validatedData);

        return redirect()->back();
    }
}
