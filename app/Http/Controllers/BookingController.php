<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Location;
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
            "booking" => $booking
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
}
