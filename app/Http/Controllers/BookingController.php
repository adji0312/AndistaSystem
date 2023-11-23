<?php

namespace App\Http\Controllers;

use App\Models\AlasanKunjungan;
use App\Models\Booking;
use App\Models\BookingService;
use App\Models\Location;
use App\Models\Service;
use App\Models\ServiceAndStaff;
use App\Models\ServicePrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
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

    // Jenis jenis booking
    public function bookingdarurat(){

        $bookingdarurat = Booking::where('category', 'LIKE', "%darurat%")->where('status', 'Terkonfirmasi')->get();
        // dd($bookingdarurat);
        return view('calendar.darurat', [
            "title" => "Darurat",
            "bookings" => $bookingdarurat
        ]);
    }

    public function bookingterjadwal(){
        return view('calendar.terjadwal', [
            "title" => "Terjadwal"
        ]);
    }

    public function bookingkedatangan(){

        $bookingkedatangan = Booking::where('category', 'LIKE', "%langsung_datang%")->where('status', 'Datang')->get();
        // dd($bookingkedatangan);

        return view('calendar.kedatangan', [
            "title" => "Kedatangan",
            "bookings" => $bookingkedatangan
        ]);
    }

    public function bookingrawatinap(){
        return view('calendar.rawatinap', [
            "title" => "Rawat Inap"
        ]);
    }

    public function bookingmemulai(){
        return view('calendar.memulai', [
            "title" => "Memulai"
        ]);
    }

    public function bookingselesai(){
        return view('calendar.selesai', [
            "title" => "Selesai"
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
            "service_staff" => ServiceAndStaff::all(),
            "booking_services" => BookingService::all()->where('booking_id', $booking->id)
        ]);
    }

    public function storeBooking(Request $request){
        // dd($request->all());

        $alasan = AlasanKunjungan::all()->where('name', $request->alasan_kunjungan)->first();
        if($alasan == null){
            $validatedAlasan['name'] = $request->alasan_kunjungan;
            AlasanKunjungan::create($validatedAlasan);
        }else{
            // dd("ada");
        }

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

        if($request->category != null || $request->category != ''){
            $validatedData['category'] = $request->category;
        }else{
            $validatedData['category'] = '-';
        }
        
        if(strpos($validatedData['category'], "langsung_datang") !== false){
            $validatedData['status'] = "Datang";
            $date = Date::now();
            // $dateBooking = date_format($date, 'Y-d-m');
            $validatedData['booking_date'] = $date;
        }else{
            $validatedData['status'] = "Terkonfirmasi";
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
        
        if($request->alasan_kunjungan != null || $request->alasan_kunjungan != ''){
            $validatedData['alasan_kunjungan'] = $request->alasan_kunjungan;
        }else{
            $validatedData['alasan_kunjungan'] = '-';
        }

        $validatedData['total_price'] = 0;
        $validatedData['temp'] = 1;

        Booking::create($validatedData);

        $lastBooking1 = DB::table('bookings')->latest('created_at')->first();
        return redirect('/newBooking' . '/' . $lastBooking1->booking_name);
    }

    public function editBooking(Request $request, $id){
        // dd($request->all());

        $alasan = AlasanKunjungan::all()->where('name', $request->alasan_kunjungan)->first();
        if($alasan == null){
            // $validatedAlasan = $request->validate([
            //     'alasan_kunjungan' => ''
            // ]);
            $validatedAlasan['name'] = $request->alasan_kunjungan;
            AlasanKunjungan::create($validatedAlasan);
        }else{
            // dd("ada");
        }

        $booking = Booking::find($id);

        
        $rules = [
            "customer_id" => 'required',
            "location_id" => 'required',
            "booking_date" => 'required',
        ];

        $validatedData = $request->validate($rules);
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
        if($request->alasan_kunjungan != null || $request->alasan_kunjungan != ''){
            $validatedData['alasan_kunjungan'] = $request->alasan_kunjungan;
        }else{
            $validatedData['alasan_kunjungan'] = '-';
        }
        //cek apakah booking ini punya service, klo ada temp = 0 else temp = 1
        $allservices = $booking->services;

        if(count($allservices) != 0 || count($allservices) != null){
            $total_price = [];
            for($i = 0 ; $i < count($allservices) ; $i++){
                $total_price[$i] = $allservices[$i]->price;
            }
            $validatedData['total_price'] = array_sum($total_price);
            $validatedData['temp'] = 0;
        }else{
            $validatedData['total_price'] = 0;
            $validatedData['temp'] = 1;
        }

        $validatedData['status'] = "confirmed";
        Booking::where('id', $booking->id)->update($validatedData);

        return redirect('/list-booking');
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

        // Save ke table staff_sibuk
        // - booking_date
        // - service_time
        // - staff_id
        // - duration
        // - max_time

        // query where last booking.staff_id (skrg) = staff_id;
        // trus cek tanggal skrg = booking_date;



        // trus cek time lebih besar gk dari max time -> aman
        // tapi kalu cek time k
        // if(booking_date == )

        // dd($request->all());
        $bookingservice = BookingService::find($id);
        $serviceprice = ServicePrice::find($request->service_price_id);
        // dd($serviceprice);
        $rules = [
            "service_price_id" => '',
            "service_staff_id" => '',
            // "price" => 'required',
        ];

        if($request->service_staff_id){
            $validatedData = $request->validate($rules);
            BookingService::where('id', $bookingservice->id)->update($validatedData);
            
        }else{
            $validatedData = $request->validate($rules);
            
            $validatedData['price'] = $serviceprice->price;
            BookingService::where('id', $bookingservice->id)->update($validatedData);
        }





        return redirect()->back();
    }
}
