<?php

namespace App\Http\Controllers;

use App\Models\AlasanKunjungan;
use App\Models\Booking;
use App\Models\BookingNote;
use App\Models\BookingService;
use App\Models\CartBooking;
use App\Models\CheckStaff;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Pet;
use App\Models\Sale;
use App\Models\Service;
use App\Models\ServiceAndStaff;
use App\Models\ServicePrice;
use App\Models\Statistic;
use App\Models\SubBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

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

        $bookingkedatangan = Booking::where('langsung_datang', 0)->get();
        
        $subBooks = SubBook::all();
        $listkedatangan = DB::table('sub_books')->select('*')->join('bookings', 'bookings.id' , '=', 'sub_books.booking_id')->join('locations', 'locations.id', '=', 'bookings.location_id')->join('staff', 'staff.id', '=', 'bookings.staff_id')->where('bookings.langsung_datang', 0)->get();
        // dd($listkedatangan);

        return view('calendar.kedatangan', [
            "title" => "Kedatangan",
            "bookings" => $subBooks
        ]);
    }

    public function bookingrawatinap(){
        return view('calendar.rawatinap', [
            "title" => "Rawat Inap"
        ]);
    }

    public function bookingmemulai(){

        $subBooks = SubBook::all();
        return view('calendar.memulai', [
            "title" => "Memulai",
            "bookings" => $subBooks
        ]);
    }

    public function bookingselesai(){
        $subBooks = SubBook::all();
        return view('calendar.selesai', [
            "title" => "Selesai",
            "bookings" => $subBooks
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
            "booking_services" => BookingService::all()->where('booking_id', $booking->id),
            "pets" => Pet::all(),
            "staff_book" => Booking::all()
        ]);
    }

    public function storeBooking(Request $request){
        // dd($request->tidak_dikenakan_biaya);

        // dd($request->all());

        $string = $request->customer_id;
        $prefix = "(";
        $index = strpos($string, $prefix) + strlen($prefix);
        $phone = substr($string, $index);

        // dd($result);
        $customer_name = substr($request->customer_id, 0, strpos($request->customer_id, ' ('));
        $customer_phone = substr($phone, 0, strpos($phone, ')'));
        $customer = Customer::where("first_name","LIKE","%{$customer_name}%")->where("phone", $customer_phone)->get();
        // dd($customer->first());

        $alasan = AlasanKunjungan::all()->where('name', $request->alasan_kunjungan)->first();
        if($alasan == null){
            $validatedAlasan['name'] = $request->alasan_kunjungan;
            AlasanKunjungan::create($validatedAlasan);
        }else{
            // dd("ada");
        }

        $validatedData = $request->validate([
            'location_id' => 'required',
            // 'booking_date' => 'required',
        ]);
        $validatedData['booking_date'] = $request->booking_date;

        if($request->tidak_dikenakan_biaya != null){
            $validatedData['tidak_dikenakan_biaya'] = 0;
        }else{
            $validatedData['tidak_dikenakan_biaya'] = 1;
        }

        if($request->langsung_datang != null){
            $validatedData['langsung_datang'] = 0;
            // dd(Date::now());
            $validatedData['booking_date'] = Date::now();
        }else{
            $validatedData['langsung_datang'] = 1;
        }

        if($request->rawat_inap != null){
            $validatedData['rawat_inap'] = 0;
        }else{
            $validatedData['rawat_inap'] = 1;
        }

        if($request->darurat != null){
            $validatedData['darurat'] = 0;
        }else{
            $validatedData['darurat'] = 1;
        }

        $validatedData['staff_id'] = 0;
        $validatedData['booking_service_id'] = 0;

        
        $validatedData['customer_id'] = $customer->first()->id;

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
            $validatedAlasan['name'] = $request->alasan_kunjungan;
            AlasanKunjungan::create($validatedAlasan);
        }else{
            // dd("ada");
        }

        $booking = Booking::find($id);

        
        $rules = [
            "location_id" => 'required',
            "booking_date" => 'required',
        ];

        $validatedData = $request->validate($rules);

        if($request->duration != null || $request->duration != ''){
            $validatedData['duration'] = $request->duration;
        }else{
            $validatedData['duration'] = 0;
        }

        if($request->alasan_kunjungan != null || $request->alasan_kunjungan != ''){
            $validatedData['alasan_kunjungan'] = $request->alasan_kunjungan;
        }else{
            $validatedData['alasan_kunjungan'] = '-';
        }
        //cek apakah booking ini punya service, klo ada temp = 0 else temp = 1
        $allservices = $booking->services;

        if(count($allservices) != 0 || count($allservices) != null){
            // dd($allservices->first());
            $validatedData['staff_id'] = $allservices->first()->service_staff_id;
            $validatedData['booking_service_id'] = $allservices->first()->service_price_id;
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

        $validatedData['status'] = "Terkonfirmasi";
        Booking::where('id', $booking->id)->update($validatedData);

        if($request->subAccount == null){
            dd("null");
        }else{
            $myString = $request->subAccount;
            $myArray = explode(',', $myString);
            $length = count($myArray);
            
            for($i = 0 ; $i < $length ; $i++){
                SubBook::create([
                    'booking_id' => $booking->id,
                    'booking_date' => $booking->booking_date,
                    'subAccount_id' => $myArray[$i],
                    'status' => $booking->status,
                ]);
            }
        }

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

        // dd($request->all());
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
            "time" => '',
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

    public function discardBooking($id){

        $booking = Booking::find($id);
        // dd($booking);
        DB::table('booking_services')->where('booking_id', $booking->id)->delete();
        DB::table('bookings')->where('id', $booking->id)->delete();
        // DB::table('service_and_staff')->where('service_id', $service->id)->delete();
        // DB::table('service_and_facilities')->where('service_id', $service->id)->delete();
        // DB::table('services')->where('id', $service->id)->delete();
        return redirect('/service/list');
    }

    public function addNewCustomer(Request $request){
        $validatedData = $request->validate([
            'first_name' => 'required',
            'phone' => 'required',
            'gender' => 'required'
        ]);

        $validatedData['join_date'] = Date::now();

        Customer::create($validatedData);
        return redirect()->back();
    }

    public function addSubAccount(Request $request){
        // dd($request->all());
        $validatedData = $request->validate([
            'pet_name' => 'required',
            'pet_type' => 'required',
            'pet_gender' => 'required'
        ]);

        $validatedData['customer_id'] = $request->customer_id;

        Pet::create($validatedData);
        return redirect()->back();
    }

    public function updateSubAccount(Request $request, $id){

        // dd($id);
        $pet = Pet::find($id);
        // dd($serviceprice);
        $rules = [
            "pet_name" => '',
            "pet_type" => '',
            "pet_ras" => '',
            "pet_gender" => '',
            "date_of_birth" => '',
            "pet_color" => ''
        ];

        $validatedData = $request->validate($rules);

        Pet::where('id', $pet->id)->update($validatedData);
        return redirect()->back();
    }

    public function deleteSubAccount($id){

        $pet = Pet::find($id);
        // dd($booking);
        DB::table('pets')->where('id', $pet->id)->delete();
        return redirect()->back();
    }

    public function checkBookingService(Request $request, $id){

        dd($id);

        $checkStaff = CheckStaff::where('time', $request->checkTime)->where('date', $request->checkDate)->where('staff_id', $request->checkStaff)->where('service_price_id', $request->checkDuration)->get()->first();
        
        if($checkStaff == null){
            // $validatedData['date'] = $request->checkDate;
            // $validatedData['time'] = $request->checkTime;
            // $validatedData['staff_id'] = $request->checkStaff;
            // $validatedData['service_price_id'] = $request->checkDuration;
    
            // CheckStaff::create($validatedData);
        }else{
            $rules = [
                "date" => '',
                "time" => '',
                "staff_id" => '',
                "service_price_id" => ''
            ];
            $validatedData = $request->validate($rules);
            CheckStaff::where('id', $checkStaff->id)->update($validatedData);
        }

        return redirect()->back();
    }

    public function deleteBookingService($id){
        $service = BookingService::find($id);
        DB::table('booking_services')->where('id', $service->id)->delete();
        return redirect()->back();
    }

    public function detailBookingById($id){
        $booking = SubBook::find($id);
        $latestStatistic = Statistic::where('sub_booking_id', $booking->id)->orderBy('created_at', 'desc')->get();
        $cart = CartBooking::where('sub_booking_id', $booking->id)->get();
        $selectedCart = CartBooking::where('sub_booking_id', $booking->id)->where('flag', 0)->get();
        $totalPrice = $selectedCart->sum('total_price');
        $note = BookingNote::where('sub_booking_id', $booking->id)->get();
        
        return view('calendar.bookingdetail', [
            'booking' => $booking,
            'title' => "Detail Booking",
            'latestStatistic' => $latestStatistic->take(1),
            'beforeStatistic' => $latestStatistic,
            'carts' => $cart,
            'totalPrice' => $totalPrice,
            'note' => $note
        ]);
    }

    public function changeStatus(Request $request, $id){
        // dd($request->all());
        $subbooking = SubBook::find($id);
        $booking = Booking::find($subbooking->booking_id);
        
        if($subbooking->status == "Terkonfirmasi" && $request->status == "Dimulai"){
            $subbooking->status = "Dimulai";
            $subbooking->save();
            $booking->start_booking = Date::now();
            $booking->save();
        }elseif ($subbooking->status == "Dimulai" && $request->status == "Selesai"){
            $lastSales = DB::table('sales')->latest('created_at')->first();
            $sales = new Sale();
            // dd($lastSales);
            if($lastSales == null || $lastSales == ''){
                $nextNumber = sprintf("%05d", 1);
                $sales->no_invoice = "INV-" . $nextNumber;
            }else{
                $nextNumber = sprintf("%05d", $lastSales->id + 1);
                $sales->no_invoice = "INV-" . $nextNumber;
            }
            $sales->booking_id = $booking->id;
            $sales->diskon = 0;
            $sales->deskripsi_tambahan_biaya = '-';
            $sales->tambahan_biaya = 0;
            $sales->metode = '-';
            $sales->status = 1;
            $sales->is_delete = 1;
            $sales->total_price = $booking->total_price;
            $sales->save();

            $subbooking->status = "Selesai";
            $subbooking->save();
            $booking->end_booking = Date::now();
            $booking->save();


            //save ke table sale dengan status unpaid
        }elseif ($subbooking->status == "Selesai" && $request->status == "Dimulai"){

        }

        return redirect()->back();
    }

    public function addStatistic(Request $request){

        $validatedData = $request->validate([
            'sub_booking_id' => 'required',
            'pet_id' => 'required'
        ]);
        
        if($request->suhu != null){
            $validatedData['suhu'] = $request->suhu;
        }else{
            $validatedData['suhu'] = 0;
        }
        
        if($request->berat != null){
            $validatedData['berat'] = $request->berat;
        }else{
            $validatedData['berat'] = 0;
        }

        if($request->perilaku != null){
            $validatedData['perilaku'] = $request->perilaku;
        }else{
            $validatedData['perilaku'] = 0;
        }

        if($request->bcs != null){
            $validatedData['bcs'] = $request->bcs;
        }else{
            $validatedData['bcs'] = 0;
        }

        if($request->gula_darah != null){
            $validatedData['gula_darah'] = $request->gula_darah;
        }else{
            $validatedData['gula_darah'] = 0;
        }

        if($request->tekanan_darah != null){
            $validatedData['tekanan_darah'] = $request->tekanan_darah;
        }else{
            $validatedData['tekanan_darah'] = 0;
        }

        if($request->crt != null){
            $validatedData['crt'] = $request->crt;
        }else{
            $validatedData['crt'] = 0;
        }

        if($request->detak_jantung != null){
            $validatedData['detak_jantung'] = $request->detak_jantung;
        }else{
            $validatedData['detak_jantung'] = 0;
        }

        if($request->mm != null){
            $validatedData['mm'] = $request->mm;
        }else{
            $validatedData['mm'] = 0;
        }

        if($request->saturasi_oksigen != null){
            $validatedData['saturasi_oksigen'] = $request->saturasi_oksigen;
        }else{
            $validatedData['saturasi_oksigen'] = 0;
        }

        if($request->tingkat_pernapasan != null){
            $validatedData['tingkat_pernapasan'] = $request->tingkat_pernapasan;
        }else{
            $validatedData['tingkat_pernapasan'] = 0;
        }

        Statistic::create($validatedData);
        return redirect()->back();
    }
}
