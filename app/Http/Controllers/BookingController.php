<?php

namespace App\Http\Controllers;

use App\Models\AlasanKunjungan;
use App\Models\AttachNote;
use App\Models\Booking;
use App\Models\BookingDiagnosis;
use App\Models\BookingNote;
use App\Models\BookingService;
use App\Models\CartBooking;
use App\Models\CheckStaff;
use App\Models\Customer;
use App\Models\Diagnosis;
use App\Models\InvoicePayment;
use App\Models\ListPlan;
use App\Models\ListPlanBooking;
use App\Models\Location;
use App\Models\Pet;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Service;
use App\Models\ServiceAndStaff;
use App\Models\ServicePrice;
use App\Models\Staff;
use App\Models\Statistic;
use App\Models\SubBook;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BookingController extends Controller
{

    public function listBooking(){
        return view('calendar.listbooking', [
            "title" => "List Booking",
            "locations" => Location::all()->where('status', 'Active'),
            "bookings" => Booking::latest()->paginate(30)->withQueryString()
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
        // dd($bookingdarurat);
        $subBooks = SubBook::latest()->where('status', 1)->paginate(30)->withQueryString();
        return view('calendar.darurat', [
            "title" => "Darurat",
            "bookings" => $subBooks
        ]);
    }

    public function bookingterjadwal(){
        $subBooks = SubBook::latest()->where('status', 1)->paginate(30)->withQueryString();

        return view('calendar.terjadwal', [
            "title" => "Terjadwal",
            "bookings" => $subBooks
        ]);
    }

    public function bookingkedatangan(){

        // $bookingkedatangan = Booking::where('langsung_datang', 0)->get();
        
        $subBooks = SubBook::latest()->where('status', 1)->paginate(30)->withQueryString();
        // $listkedatangan = DB::table('sub_books')->select('*')->join('bookings', 'bookings.id' , '=', 'sub_books.booking_id')->join('locations', 'locations.id', '=', 'bookings.location_id')->join('staff', 'staff.id', '=', 'bookings.staff_id')->where('bookings.langsung_datang', 0)->get();
        // dd($listkedatangan);
        // $cartSubBook = CartBooking::all()->where('sub_booking_id',)

        return view('calendar.kedatangan', [
            "title" => "Kedatangan",
            "subBooks" => $subBooks
        ]);
    }

    public function bookingrawatinap(){

        // if(request('filterstatus')){
        //     if(request('filterstatus') == "1"){
        //         $subBooks = SubBook::latest()->where('status', 5)->where('ranap', 1)->paginate(30)->withQueryString();
        //     }elseif(request('filterstatus') == "2"){
        //         $subBooks = SubBook::latest()->where('status', 5)->where('ranap', 2)->paginate(30)->withQueryString();
        //     }
        // }else{
        $subBooks = SubBook::latest()->where('status', 5)->where('ranap', 1)->paginate(30)->withQueryString();

        $now = Carbon::now();
        return view('calendar.rawatinap', [
            "title" => "Rawat Inap",
            "bookings" => $subBooks,
            "now" => $now
        ]);
    }

    public function bookingmemulai(){

        $subBooks = SubBook::latest()->where('status', 2)->paginate(30)->withQueryString();
        return view('calendar.memulai', [
            "title" => "Memulai",
            "bookings" => $subBooks
        ]);
    }

    public function bookingapotek(){

        $subBooks = SubBook::latest()->where('status', 3)->paginate(30)->withQueryString();
        return view('calendar.apotek', [
            "title" => "Apotek",
            "bookings" => $subBooks
        ]);
    }

    public function bookingselesai(){
        $subBooks = SubBook::latest()->where('status', 4)->orWhere('ranap', 2)->paginate(30)->withQueryString();
        return view('calendar.selesai', [
            "title" => "Selesai",
            "bookings" => $subBooks
        ]);
    }
    
    public function createbookingDetail($name){
        $booking = Booking::all()->where('booking_name', $name)->first();
        $sub_books = SubBook::all()->where('booking_id', $booking->id);
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
            "staff_book" => Booking::all(),
            "sub_books" => $sub_books
        ]);
    }

    public function storeBooking(Request $request){
        // dd($request->all());

        $string = $request->customer_id;
        $prefix = "(";
        $index = strpos($string, $prefix) + strlen($prefix);
        $phone = substr($string, $index);

        // dd($result);
        $customer_name = substr($request->customer_id, 0, strpos($request->customer_id, ' ('));
        $customer_phone = substr($phone, 0, strpos($phone, ')'));
        $customer = Customer::where("first_name","LIKE","%{$customer_name}%")->where("phone", $customer_phone)->get();
        // dd($customer->first()->id);

        $alasan = AlasanKunjungan::all()->where('name', $request->alasan_kunjungan)->first();
        if($alasan == null){
            $validatedAlasan['name'] = $request->alasan_kunjungan;
            AlasanKunjungan::create($validatedAlasan);
        }else{
            // dd("ada");
        }

        $validatedData = $request->validate([
            'location_id' => 'required',
            'category' => 'required',
            'booking_date' => 'required'
        ]);

        if($request->category == 1){
            $validatedData['booking_date'] = Date::now();
        }

        $validatedData['customer_id'] = $customer->first()->id;
        $validatedData['admin_id'] = $request->admin_id;
        
        $lastBooking = DB::table('bookings')->latest('created_at')->first();
        if($lastBooking == null || $lastBooking == ''){
            $nextNumber = sprintf("%05d", 1);
            $validatedData['booking_name'] = "BOOK-" . $nextNumber;
        }else{
            $nextNumber = sprintf("%05d", $lastBooking->id + 1);
            $validatedData['booking_name'] = "BOOK-" . $nextNumber;
        }
        
        if($request->alasan_kunjungan != null || $request->alasan_kunjungan != ''){
            $validatedData['alasan_kunjungan'] = $request->alasan_kunjungan;
        }else{
            $validatedData['alasan_kunjungan'] = '-';
        } 

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
        if($request->subAccount == null || $request->subAccount == ''){
            Alert::warning('Gagal', "Sub Akun Tidak Boleh Kosong!");
            return redirect('/newBooking' . '/' . $booking->booking_name);
        }
        
        $bs = BookingService::all()->where('booking_id', $booking->id);
        // dd($bs);

        if(count($bs) == 0){
            Alert::warning('Gagal', "Service Tidak Boleh Kosong!");
            return redirect('/newBooking' . '/' . $booking->booking_name);
        }else{
            if($bs->first()->service_price_id == 0 || $bs->first()->service_price_id == null || $bs->first()->service_price_id == ''){
                Alert::warning('Gagal', "Service Durasi Tidak Boleh Kosong!");
                return redirect('/newBooking' . '/' . $booking->booking_name);
            }
        }

        $myString = $request->subAccount;
        $myArray = explode(',', $myString);
        $length = count($myArray);
        // dd($length);
        for($i = 0 ; $i < $length ; $i++){
            $subBookingBaru = new SubBook();
            $subBookingBaru->booking_id = $booking->id;

            $formatDate = date_create($booking->booking_date);
            $year = date_format($formatDate, 'Y');
            $month = date_format($formatDate, 'm');
            $date = date_format($formatDate, 'd');

            $hour = substr($bs->first()->time, 0, 2);
            $minute = substr($bs->first()->time, 3, 4);
            // dd($hour . ' ' . $minute);
            // dd($month . $date);
            $newDate = Carbon::create($year, $month, $date, $hour, $minute, 0);
            // dd($newDate);

            $subBookingBaru->booking_date = $newDate;
            $subBookingBaru->subAccount_id = $myArray[$i];
            $subBookingBaru->status = 1;
            $subBookingBaru->category = $booking->category;
            $subBookingBaru->admin_id = $booking->admin_id;
            $subBookingBaru->sub_total_price = $bs->first()->price;
            $subBookingBaru->save();

            $lastSubBook = SubBook::all()->sortByDesc('id')->first();

            $cart = new CartBooking();
            $cart->booking_id = $booking->id;
            $cart->staff_id = 0;
            $cart->sub_booking_id = $lastSubBook->id;
            $cart->product_id = 0;
            $cart->service_id = $bs->first()->service_id;
            $cart->service_price_id = $bs->first()->service_price_id;
            $cart->quantity = 1;
            $cart->total_price = $bs->first()->price;
            $cart->flag = 0;
            $cart->name = $bs->first()->service->service_name;
            $cart->save();
        }

        Alert::success('Success', 'Booking Berhasil Dibuat!');
        return redirect('/calendar');
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
        DB::table('booking_services')->where('booking_id', $booking->id)->delete();
        DB::table('bookings')->where('id', $booking->id)->delete();
        return redirect('/newBooking');
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

        // dd($id);

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
        $subBook = SubBook::find($id);
        // dd($subBook);
        // if($subBook->status == 2 || $subBook->status == 3){
        //     if($subBook->staff_id != Auth::user()->id && $subBook->staff_id != null){
        //         Alert::warning('Peringatan!', 'Pasien ini sudah ditangani oleh dokter!');
        //         return redirect()->back();
        //     }
        // }

        $latestStatistic = Statistic::where('sub_booking_id', $subBook->id)->orderBy('created_at', 'desc')->get();
        $cart = CartBooking::where('sub_booking_id', $subBook->id)->get();
        $selectedCart = CartBooking::where('sub_booking_id', $subBook->id)->where('flag', 0)->get();
        $totalPrice = $selectedCart->sum('total_price');
        $note = BookingNote::where('sub_booking_id', $subBook->id)->get();

        $diagnosis = BookingDiagnosis::where('sub_booking_id', $subBook->id)->get();
        $treatments = Plan::all();
        $servicePrice = ServicePrice::all();
        $files = AttachNote::all();
        $cartsubbook = CartBooking::all()->where('sub_booking_id', $subBook->id);
        $bs = BookingService::all()->where('booking_id', $subBook->booking_id)->first();
        // dd($bs);
        $historyBook = SubBook::where('subAccount_id', $subBook->subAccount_id)->where('id', '!=', $subBook->id)->get();
        // dd($historyBook);
        // dd($cart);
        // dd($cartsubbook);
        $resepsionis = Staff::where('id', $subBook->admin_id)->first();

        $listInvoice = Sale::all()->where('sub_booking_id', $subBook->id);

        $checkCart = CartBooking::all()->where('sub_booking_id', $subBook->id)->where('invoice_id', null)->where('flag', 0);

        $statistics = Statistic::all()->where('sub_booking_id', $subBook->id);

        $bookingTreatment = BookingDiagnosis::where('sub_booking_id', $subBook->id)->first();
        $listPlan = ListPlan::all();
        $listPlanBooking = ListPlanBooking::all()->where('sub_booking_id', $subBook->id);
        
        return view('calendar.bookingdetail', [
            'booking' => $subBook,
            'title' => "Detail Booking",
            'carts' => $cart,
            'totalPrice' => $totalPrice,
            'notes' => $note,
            'bookingDiagnosis' => $diagnosis,
            'treatments' => $treatments,
            'servicePrice' => $servicePrice,
            'files' => $files,
            'bookingservices' => $cartsubbook,
            'bs' => $bs,
            'historyBook' => $historyBook,
            'resepsionis' => $resepsionis,
            'listInvoice' => $listInvoice,
            'checkCart' => $checkCart,
            'statistics' => $statistics,
            'bookingTreatment' => $bookingTreatment,
            'listPlan' => $listPlan,
            'listPlanBooking' => $listPlanBooking
        ]);
    }

    public function detailBookingCatatan($id){
        
        $note = BookingNote::find($id);
        
        return view('calendar.notedetail', [
            "title" => "Detail Note",
            "note" => $note
        ]);
        
    }

    public function changeStatus(Request $request, $id){
        // dd($request->all());
        $subbooking = SubBook::find($id);
        // dd($subbooking);
        $cart = CartBooking::where('sub_booking_id', $subbooking->id)->first();
        // dd($cart->id);
        if($request->status){
            $subbooking->status = $request->status;
        }
        $subbooking->staff_id = Auth::user()->id;
        if($request->balikantrian){
            $cart->staff_id = 0;
            $cart->save();
        }else{
            $cart->staff_id = Auth::user()->id;
            $cart->save();
        }


        if($request->status == 4){
            // dd($request->all());
            $lastSales = DB::table('sales')->latest('created_at')->first();
            // dd($lastSales);

            if($lastSales == null || $lastSales == ''){
                $nextNumber = sprintf("%05d", 1);
            }else{
                $nextNumber = sprintf("%05d", $lastSales->id + 1);
            }
            // dd($nextNumber);
            $sales = new Sale();
            $sales->no_invoice = "INV-" . $nextNumber;
            $sales->booking_id = $subbooking->booking->id;
            $sales->sub_booking_id = $subbooking->id;
            $sales->diskon = 0;
            $sales->deskripsi_tambahan_biaya = '-';
            $sales->tambahan_biaya = 0;
            $sales->metode = '-';
            $sales->status = 1;
            $sales->is_delete = 1;
            $sales->customer_name = $subbooking->booking->customer->first_name;
            $sales->sub_account_name = $subbooking->pet->pet_name;
            $sales->pesan_resepsionis = $request->pesan_resepsionis;

            $cartBooking = CartBooking::all()->where('sub_booking_id', $subbooking->id);
            // dd($cartBooking);
            foreach($cartBooking as $cb){
                $sales->total_price += $cb->total_price;
                if($lastSales == null || $lastSales == ''){
                    $cb->invoice_id = 1;
                }else{
                    $cb->invoice_id = $lastSales->id + 1;
                }
                $cb->save();
            }

            $sales->save();
            Alert::success('Berhasil!', 'Booking Telah Selesai!');
        }elseif($request->status == 5){
            $subbooking->status = 5;
            $subbooking->ranap = 1;
            $subbooking->duration = 1;

            $lastSales = DB::table('sales')->latest('created_at')->first();
            // dd($lastSales);

            if($lastSales == null || $lastSales == ''){
                $nextNumber = sprintf("%05d", 1);
            }else{
                $nextNumber = sprintf("%05d", $lastSales->id + 1);
            }
            $sales = new Sale();
            $sales->no_invoice = "INV-" . $nextNumber;
            $sales->booking_id = $subbooking->booking->id;
            $sales->sub_booking_id = $subbooking->id;
            $sales->diskon = 0;
            $sales->deskripsi_tambahan_biaya = '-';
            $sales->tambahan_biaya = 0;
            $sales->metode = '-';
            $sales->status = 1;
            $sales->is_delete = 1;
            $sales->customer_name = $subbooking->booking->customer->first_name;
            $sales->sub_account_name = $subbooking->pet->pet_name;

            $cartBooking = CartBooking::all()->where('sub_booking_id', $subbooking->id);
            foreach($cartBooking as $cb){
                $sales->total_price += $cb->total_price;
                if($lastSales == null || $lastSales == ''){
                    $cb->invoice_id = 1;
                }else{
                    $cb->invoice_id = $lastSales->id + 1;
                }
                $cb->save();
            }

            $sales->save();

            $subbooking->rawat_inap = Date::now();
        }

        if($request->pulangpasien){
            $subbooking->ranap = 2;
            if($request->alasan_pulang){
                $subbooking->pesanresepsionis = $request->alasan_pulang;
            }else{
                $subbooking->pesanresepsionis = '-';
            }
        }
        
        $subbooking->save();


        return redirect()->back();
    }

    public function makeInvoice(Request $request, $id){
        $subbooking = SubBook::find($id);
        // dd($subbooking);
        $lastSales = DB::table('sales')->latest('created_at')->first();
        // dd($lastSales);

        if($lastSales == null || $lastSales == ''){
            $nextNumber = sprintf("%05d", 1);
        }else{
            $nextNumber = sprintf("%05d", $lastSales->id + 1);
        }
        $sales = new Sale();
        $sales->no_invoice = "INV-" . $nextNumber;
        $sales->booking_id = $subbooking->booking->id;
        $sales->sub_booking_id = $subbooking->id;
        $sales->diskon = 0;
        $sales->deskripsi_tambahan_biaya = '-';
        $sales->tambahan_biaya = 0;
        $sales->metode = '-';
        $sales->status = 1;
        $sales->is_delete = 1;
        $sales->customer_name = $subbooking->booking->customer->first_name;
        $sales->sub_account_name = $subbooking->pet->pet_name;

        $cartBooking = CartBooking::all()->where('sub_booking_id', $subbooking->id)->where('invoice_id', null);
        // dd($cartBooking);
        foreach($cartBooking as $cb){
            $sales->total_price += $cb->total_price;
            if($lastSales == null || $lastSales == ''){
                $cb->invoice_id = 1;
            }else{
                $cb->invoice_id = $lastSales->id + 1;
            }
            $cb->save();
        }

        $sales->save();

        $subbooking->sub_total_price = 0;
        $subbooking->save();

        foreach($subbooking->invoice as $si){
            $subbooking->sub_total_price += $si->total_price;
        }

        $subbooking->save();

        Alert::success('Berhasil!', 'Invoice Berhasil Dibuat!');
        return redirect()->back();
    }

    public function addStatistic(Request $request){

        // dd($request->all());

        $validatedData = $request->validate([
            'sub_booking_id' => 'required',
            'pet_id' => 'required'
        ]);
        
        if($request->suhu != null){
            $validatedData['suhu'] = $request->suhu;
        }else{
            $validatedData['suhu'] = "-";
        }
        
        if($request->berat != null){
            $validatedData['berat'] = $request->berat;
        }else{
            $validatedData['berat'] = "-";
        }

        if($request->perilaku != null){
            $validatedData['perilaku'] = $request->perilaku;
        }else{
            $validatedData['perilaku'] = "-";
        }

        if($request->bcs != null){
            $validatedData['bcs'] = $request->bcs;
        }else{
            $validatedData['bcs'] = "-";
        }

        if($request->gula_darah != null){
            $validatedData['gula_darah'] = $request->gula_darah;
        }else{
            $validatedData['gula_darah'] = "-";
        }

        if($request->tekanan_darah != null){
            $validatedData['tekanan_darah'] = $request->tekanan_darah;
        }else{
            $validatedData['tekanan_darah'] = "-";
        }

        if($request->crt != null){
            $validatedData['crt'] = $request->crt;
        }else{
            $validatedData['crt'] = "-";
        }

        if($request->detak_jantung != null){
            $validatedData['detak_jantung'] = $request->detak_jantung;
        }else{
            $validatedData['detak_jantung'] = "-";
        }

        if($request->mm != null){
            $validatedData['mm'] = $request->mm;
        }else{
            $validatedData['mm'] = "-";
        }

        if($request->saturasi_oksigen != null){
            $validatedData['saturasi_oksigen'] = $request->saturasi_oksigen;
        }else{
            $validatedData['saturasi_oksigen'] = "-";
        }

        if($request->tingkat_pernapasan != null){
            $validatedData['tingkat_pernapasan'] = $request->tingkat_pernapasan;
        }else{
            $validatedData['tingkat_pernapasan'] = "-";
        }

        Statistic::create($validatedData);
        return redirect()->back();
    }

    public function deletestatistic($id){
        $statistic = Statistic::find($id);
        DB::table('statistics')->where('id', $statistic->id)->delete();
        Alert::success('Berhasil!', 'Hapus Data Berhasil Dilakukan');
        return redirect()->back();
    }

    public function addBookingDiagnosis(Request $request){
        // dd($request->all());
        $diagnosis = Diagnosis::where('diagnosis_name', $request->diagnosis_name)->first();
        
        if($diagnosis == null){
            $validatedData = $request->validate([
                'diagnosis_name' => 'required|unique:diagnoses',
            ]);
    
            Diagnosis::create($validatedData);

            $lastDiagnosis = DB::table('diagnoses')->latest('created_at')->first();

            $bookingDiagnosis = new BookingDiagnosis();
            $bookingDiagnosis->diagnosis_id = $lastDiagnosis->id;
            $bookingDiagnosis->booking_id = $request->booking_id;
            $bookingDiagnosis->sub_booking_id = $request->sub_booking_id;
            $bookingDiagnosis->save();

        }else{
            $bookingDiagnosis = new BookingDiagnosis();
            $bookingDiagnosis->diagnosis_id = $diagnosis->id;
            $bookingDiagnosis->booking_id = $request->booking_id;
            $bookingDiagnosis->sub_booking_id = $request->sub_booking_id;
            $bookingDiagnosis->save();
        }

        return redirect()->back();
    }

    public function deleteBookingDiagnosis($id){
        $bd = BookingDiagnosis::find($id);

        DB::table('booking_diagnoses')->where('id', $bd->id)->delete();
        DB::table('list_plan_bookings')->where('booking_diagnoses_id', $bd->id)->delete();
        return redirect()->back();
    }

    public function editBookingDiagnosis(Request $request, $id){
        
        $bookingDiagnosis = BookingDiagnosis::find($id);
        $treatment = Plan::find($request->treatment_id);
        // dd($treatment->listPlan);
        // $days = 0;
        foreach($treatment->listPlan as $tl){
            $days = $tl->start_day; ////1    2 
            for($i = 1 ; $i <= $tl->duration ; $i++){
                $listplanbooking = new ListPlanBooking();
                $listplanbooking->list_plan_id = $tl->id;  //product,service,task here
                $listplanbooking->sub_booking_id = $bookingDiagnosis->sub_booking_id;
                $listplanbooking->booking_diagnoses_id = $bookingDiagnosis->id;
                $listplanbooking->day = $days; //this is for looping //1, 2
                $listplanbooking->save();
                $days += 1;
            }
        }

        $bookingDiagnosis->treatment_id = $request->treatment_id;
        $bookingDiagnosis->save();

        // $listPla
        
        return redirect()->back();
    }

    public function makePayment(Request $request){
        // dd($request->all());
        // $total = $request->price1 + $request->price2;
        // dd($total);
        // if($total != $request->hargasli){
        //     Alert::warning('Gagal!', 'Jumlah pembayaran tidak sesuai dengan total harga!');
        //     return redirect()->back();
        // }
        $sale = Sale::find($request->sale_id);

        //kasus tidak ada biaya apa apa lagi
        // $sale->metode = $request->payment_method;
        // $sale->note = $request->payment_note;
        $sale->resepsionis_id = $request->resepsionis_id;
        $sale->status = 0;
        $sale->save();

        if($request->payment_method2 == null || $request->payment_method2 == '' || $request->price2 == null || $request->price2 == ''){
            $invoice = new InvoicePayment();
            $invoice->invoice_id = $request->sale_id;
            $invoice->method = $request->payment_method1;
            $invoice->price = $request->price1;
            $invoice->save();
        }else{
            $invoice = new InvoicePayment();
            $invoice->invoice_id = $request->sale_id;
            $invoice->method = $request->payment_method1;
            $invoice->price = $request->price1;
            $invoice->save();

            $invoice2 = new InvoicePayment();
            $invoice2->invoice_id = $request->sale_id;
            $invoice2->method = $request->payment_method2;
            $invoice2->price = $request->price2;
            $invoice2->save();
        }

        Alert::success('Berhasil!', 'Pembayaran Berhasil Dilakukan');
        return redirect('/finance');
    }

    public function makeDeposit(Request $request){
        // dd($request->all());
        $sale = Sale::find($request->sale_id);

        //kasus tidak ada biaya apa apa lagi
        $sale->metode = $request->payment_method;
        $sale->deposit = $request->deposit;
        $sale->note = $request->payment_note;
        $sale->status = 2;
        $sale->save();

        return redirect('/finance');
    }

    public function updateAddCost(Request $request, $id){
        // dd($request->all());
        $sale = Sale::find($id);
        
        $amountdiscount = ($request->discount/100) * $sale->total_price;
        // $newPrice = $sale->total_price - $amountdiscount;
        // dd($amountdiscount);
        
        $sale->diskon = $request->discount;
        $sale->amount_discount = $amountdiscount;
        $sale->save();
        
        if($sale->booking_id != 0 && $sale->sub_booking_id != 0){
            $subbooking = SubBook::find($sale->sub_booking->id);
            $subbooking->sub_total_price = $sale->total_price;
            $subbooking->save();
        }
        // $sale->total_price = $newPrice;
        // $subbooking->sub_total_price
        // dd($sale->sub_booking);
        // $priceDiskon = (diskon.value/100) * before_total_price.value;
        // $finalPrice = before_total_price.value - priceDiskon;

        

        return redirect()->back();
    }

    public function attachFile(Request $request){

        // dd($request->image->getClientOriginalName());

        $validatedData = $request->validate([
            'booking_id' => 'required',
            'sub_booking_id' => 'required',
        ]);

        $files = AttachNote::all()->where('sub_booking_id', $request->sub_booking_id);
        
        if($request->file('image')){
            $validatedData['file_name'] = 'SUBBOOK' . $request->sub_booking_id . '-' . 'PIC-' . count($files)+1 . '.' . $request->image->getClientOriginalExtension();

            // $validatedData['image'] = $request->file('image')->move('public', $validatedData['file_name']);
            $validatedData['image'] = $request->file('image')->store('public');
        }

        AttachNote::create($validatedData);
        return redirect()->back();
    }

    public function deleteAttach($id){

        $file = AttachNote::find($id);
        Storage::delete($file->image);
        DB::table('attach_notes')->where('id', $file->id)->delete();
        // dd($file);
        // dd($request->image->getClientOriginalName());

        // AttachNote::create($validatedData);
        return redirect()->back();
    }

    public function updateBookingDate($id){
        $booking = Booking::find($id);
        dd($booking);
    }

    public function newDeposit(Request $request){
        // dd($request->all());
        $lastSales = DB::table('sales')->latest('created_at')->first();
        $subbooking = SubBook::find($request->sub_booking_id);
        // dd($subbooking);
        
        if($lastSales == null){
            $sales = new Sale();
            $nextNumber = sprintf("%05d", 1);
            $sales->no_invoice = "INV-" . $nextNumber;
            $sales->booking_id = $request->booking_id;
            $sales->sub_booking_id = $subbooking->id;
            $sales->diskon = 0;
            $sales->deskripsi_tambahan_biaya = '-';
            $sales->tambahan_biaya = 0;
            $sales->metode = '-';
            $sales->status = 2;
            $sales->is_delete = 1;
            $sales->total_price = $subbooking->sub_total_price;
            $sales->deposit = $request->deposit;
            $sales->flagDeposit = 1;
            $sales->save();
        }else{
            $sales = new Sale();
            if($lastSales == null || $lastSales == ''){
                $nextNumber = sprintf("%05d", 1);
                $sales->no_invoice = "INV-" . $nextNumber;
            }else{
                $nextNumber = sprintf("%05d", $lastSales->id + 1);
                $sales->no_invoice = "INV-" . $nextNumber;
            }
            $sales->booking_id = $request->booking_id;
            $sales->sub_booking_id = $subbooking->id;
            $sales->diskon = 0;
            $sales->deskripsi_tambahan_biaya = '-';
            $sales->tambahan_biaya = 0;
            $sales->metode = '-';
            $sales->status = 2;
            $sales->is_delete = 1;
            $sales->total_price = $subbooking->sub_total_price;
            $sales->deposit = $request->deposit;
            $sales->flagDeposit = 1;
            $sales->save();
        }

        return redirect()->back();
    }
    
    public function batalkanbooking($id){
        $booking = SubBook::find($id);
        DB::table('sub_books')->where('id', $booking->id)->delete();
        DB::table('cart_bookings')->where('sub_booking_id', $booking->id)->delete();
        Alert::success('Success', 'Booking Berhasil Dibatalkan!');
        return redirect('/booking/kedatangan');
    }

    public function pesanresepsionis(Request $request, $id){
        $booking = SubBook::find($id);
        $booking->pesanresepsionis = $request->pesanresepsionis;
        $booking->save();
        return redirect()->back();
    }

    public function tambahkeranjang(Request $request, $id){
        // dd($request->all());
        $LPB = ListPlanBooking::find($id);
        $item = ListPlan::find($LPB->list_plan_id);
        // dd($item);

        if($request->task){
            $LPB->flag = 1;
            $LPB->save();
            Alert::success('Berhasil', 'Berhasil Melakukan Task!');
        }

        if($item->service){
            // dd($item->service);
            $service = Service::find($item->service_id);
            $servicePrice = ServicePrice::find($item->service_price_id);
            // dd($service->service_name);
            if($service == null || $service == ''){
                Alert::warning('Gagal', "Servis tidak tersedia!");
                return redirect()->back();
            }
            $validatedData = $request->validate([
                'booking_id' => 'required',
                'sub_booking_id' => 'required',
                'staff_id' => 'required'
            ]);

            $validatedData['service_id'] = $service->id;
            $validatedData['quantity'] = $item->quantity*$item->frequency->frequency_value;
            $validatedData['flag'] = 1;
            $validatedData['name'] = $service->service_name;
            $validatedData['service_price_id'] = $servicePrice->id;
            $validatedData['total_price'] = $validatedData['quantity']*$servicePrice->price;
            // dd($validatedData['total_price']);

            // DB::table('products')

            CartBooking::create($validatedData);

            $LPB->flag = 1;
            $LPB->save();
            Alert::success('Berhasil', 'Berhasil Menambahkan Item!');
            
        }else if($item->products){
            // dd($item->products);
            $product = Product::find($item->product_id);
            // dd($product);
            if($product == null || $product == ''){
                Alert::warning('Gagal', "Produk tidak tersedia!");
                return redirect()->back();
            }
            // dd($product);
            $validatedData = $request->validate([
                'booking_id' => 'required',
                'sub_booking_id' => 'required',
                'staff_id' => 'required'
            ]);

            $validatedData['product_id'] = $product->id;
            $validatedData['quantity'] = $item->quantity*$item->frequency->frequency_value;
            $validatedData['flag'] = 1;
            $validatedData['name'] = $product->product_name;
            $validatedData['total_price'] = $product->price*$validatedData['quantity'];

            // DB::table('products')

            CartBooking::create($validatedData);

            $LPB->flag = 1;
            $LPB->save();
            Alert::success('Berhasil', 'Berhasil Menambahkan Item!');
        }

        return redirect()->back();
    }
}
