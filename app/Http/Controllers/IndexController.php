<?php

namespace App\Http\Controllers;

use App\Models\AlasanKunjungan;
use App\Models\Attendance;
use App\Models\Booking;
use App\Models\BookingService;
use App\Models\CartBooking;
use App\Models\CategoryService;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Diagnosis;
use App\Models\Facility;
use App\Models\Frequency;
use App\Models\History;
use App\Models\InvoicePayment;
use App\Models\ListPlan;
use App\Models\Location;
use App\Models\LocationContactEmail;
use App\Models\LocationContactMessenger;
use App\Models\LocationContactPhone;
use App\Models\MessengerType;
use App\Models\OffDay;
use App\Models\Pet;
use App\Models\Plan;
use App\Models\Policy;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\Sale;
use App\Models\Service;
use App\Models\ServiceAndFacility;
use App\Models\ServiceAndStaff;
use App\Models\ServicePrice;
use App\Models\Shift;
use App\Models\Staff;
use App\Models\SubBook;
use App\Models\Task;
use App\Models\TaxRate;
use App\Models\UnitFacility;
use App\Models\UsageAddress;
use App\Models\UsageContact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPSTORM_META\map;

class IndexController extends Controller
{
    public function home(){
        return view('home', [
            "title" => "Home",
            "bookings" => Booking::all()
        ]);
    }

    public function __invoke()
    {
        $events = [];
 
        $appointments = BookingService::all();
        dd($appointments);
 
        foreach ($appointments as $appointment) {
            $events[] = [
                'title' => $appointment->client->name . ' ('.$appointment->employee->name.')',
                'start' => $appointment->start_time,
                'end' => $appointment->finish_time,
            ];
        }
 
        return view('home', compact('events'));
    }

    public function upcomingbooking(){
        return view('upcomingbooking', [
            "title" => "Upcoming Booking"
        ]);
    }
    

    public function locationDashboard(){
        return view('location.dashboard', [
            "title" => "Location Dashboard",
            "locations" => Location::all(),
            "facilities" => Facility::all(),
        ]);
    }
    
    public function locationList(){
        return view('location.locationslist', [
            "title" => "Location List",
            "locations" => Location::latest()->filter(request(['search']))->get()
        ]);
    }
    public function addLocation(){
        return view('location.addLocation', [
            "title" => "Location List",
            "usages" => UsageContact::all(),
            "messengerTypes" => MessengerType::all(),
            "countries" => Country::all(),
            "usageAddresses" => UsageAddress::all()
        ]);
    }
    
    public function locationFacility(){
        return view('location.locationfacilities', [
            "title" => "Facility",
            "facilities" => Facility::all(),
            "units" => UnitFacility::all()
        ]);
    }

    public function addFacility(){
        return view('location.addFacility', [
            "title" => "Facility",
            "locations" => Location::all()
        ]);
    }

    public function serviceDashboard(){
        return view('service.dashboard', [
            "title" => "Service Dashboard",
            "services" => Service::all(),
            "treatment" => Plan::all(),
            "category" => CategoryService::all(),
            "diagnosis" => Diagnosis::all(),
            "policy" => Policy::all(),
        ]);
    }

    public function serviceList(){
        return view('service.serviceslist', [
            "title" => "Service List",
            "services" => Service::latest()->paginate(20)->withQueryString()
        ]);
    }

    public function addService(){
        return view('service.addservice', [
            "title" => "Service List",
            "categories" => CategoryService::all(),
            "tax" => TaxRate::all(),
            "locations" => Location::all(),
            "policies" => Policy::all(),
            "facilities" => Facility::all()->where('status', 'Active'),
            // "staff" => Staff::all()
        ]);
    }

    public function addServiceDetail($name){

        $service = Service::where('service_name', $name)->first();
        $servicefacility = ServiceAndFacility::all()->where('service_id', $service->id);
        $servicestaff = ServiceAndStaff::all()->where('service_id', $service->id);
        // dd($servicefacility);
        return view('service.addServiceDetail', [
            "title" => "Service List",
            "categories" => CategoryService::all(),
            "tax" => TaxRate::all(),
            "locations" => Location::all()->where('status', 'Active'),
            "policies" => Policy::all()->where('status', 'Active'),
            "facilities" => Facility::all()->where('status', 'Active'),
            "staff" => Staff::all(),
            "service" => $service,
            "priceService" => ServicePrice::all()->where('service_id', $service->id),
            "servicefacility" => $servicefacility,
            "servicestaff" => $servicestaff
        ]);
    }

    public function treatmentPlan(){
        return view('service.treatmentplan', [
            "title" => "Treatment Plan",
            "plans" => Plan::latest()->paginate(10)->withQueryString()
        ]);
    }

    public function addTreatmentPlan(){
        return view('service.addtreatmentplan', [
            "title" => "Treatment Plan",
            "tasks" => Task::all(),
            "locations" => Location::all()->where('status', 'Active'),
            "plan" => ListPlan::all()->where('temp', 1),
            "diagnosis" => Diagnosis::all()
        ]);
    }

    public function serviceCategory(){
        return view('service.servicecategory', [
            "title" => "Service Category",
            "categories" => CategoryService::latest()->paginate(20)->withQueryString()
        ]);
    }

    public function serviceDiagnosis(){
        return view('service.serviceDiagnosis', [
            "title" => "Service Diagnosis",
            "diagnosis" => Diagnosis::latest()->paginate(20)->withQueryString()
        ]);
    }

    public function policy(){
        return view('service.policy', [
            "title" => "Policy",
            "policies" => Policy::all()
        ]);
    }
    public function addPolicy(){
        return view('service.addPolicy', [
            "title" => "Policy"
        ]);
    }

    public function editPolicy($id){

        // dd($id);
        
        $policy = Policy::find(decrypt($id));
        // dd($policy);

        return view('service.editPolicy', [
            "title" => "Policy",
            "policy" => $policy
        ]);
    }
    
    public function editLocation($location_name){

        // dd($id);
        
        // $location = Location::find(decrypt($id));
        // dd($policy);
        $location = Location::all()->where('location_name', $location_name)->first();
        // dd($location);

        return view('location.editLocation', [
            "title" => "Location",
            "location" => $location,
            "usages" => UsageContact::all(),
            "messengerTypes" => MessengerType::all(),
            "countries" => Country::all(),
            "usageAddresses" => UsageAddress::all(),
            "phones" => LocationContactPhone::all()->where('location_id', $location->id),
            "emails" => LocationContactEmail::all()->where('location_id', $location->id),
            "messengers" => LocationContactMessenger::all()->where('location_id', $location->id),
        ]);
    }

    public function settingLocation(){
        return view('location.setting', [
            "title" => "Setting Location",
            "usageAddress" => UsageAddress::all(),
            "usageContact" => UsageContact::all(),
            "typeMessenger" => MessengerType::all(),
        ]);
    }

    public function store(Request $request){
        return view('service.servicecategory', 
        [
            "title" => "Service Category",
            'categpries' => $request->redirectlink
        ]);
    }

    public function financeDashboard(){

        $allSales = Sale::all()->where('status', 0)->where('is_delete', 1);
        $total_pendapatan = 0;
        foreach($allSales as $as){
            $total_pendapatan += ($as->total_price - $as->amount_discount);
        }

        return view('finance.dashboard', [
            "title" => "Finance Dashboard",
            "totalSales" => $total_pendapatan,
            "totalQuotation" => Quotation::all()->where('is_delete', 1)->sum('total_price'),
            "taxrate" => TaxRate::all()
        ]);
    }
    
    public function salelistpaid(){

        $sales = Sale::all()->where('status', 0);
        return view('finance.salelistpaid', [
            "title" => "Sale List Paid",
            "sales" => $sales
        ]);
    }
    public function salelistunpaid(){

        $sales = Sale::all()->where('status', 1);

        return view('finance.salelistunpaid', [
            "title" => "Sale List Unpaid",
            "sales" => Sale::latest()->where('status', 1)->filter(request(['search']))->get()
        ]);
    }

    public function salelistdeposit(){

        $sales = Sale::all()->where('status', 2);

        return view('finance.salelistdeposit', [
            "title" => "Sale List Deposit",
            "sales" => $sales
        ]);
    }

    public function detailinvoice($name){
        // dd($name);
        $sale = Sale::all()->where('no_invoice', $name)->first();
        $subbook = SubBook::find($sale->sub_booking_id);
        // dd($subbook);
        // dd($sale);
        // dd($sale->booking->customer->pets);
        $bookingService = BookingService::all()->where('sub_booking_id', '!=', NULL)->where('sub_booking_id', $sale->sub_booking_id)->first();
        // dd($bookingService);
        $item = $sale->booking;
        $staff = Staff::all()->where('status', 'Active');
        // dd($staff);
        $subAccount = Pet::all()->where('customer_id', $sale->booking->customer->id);

        $invoice_method = InvoicePayment::all()->where('invoice_id', $sale->id);
        return view('finance.detailsalelistunpaid', [
            "title" => "Sale List Unpaid",
            "sale" => $sale,
            "bookingService" => $bookingService,
            "item" => $item,
            "staffs" => $staff,
            "subAccount" => $subAccount,
            "servicePrice" => ServicePrice::all(),
            "carts" => CartBooking::all()->where('sub_booking_id', $sale->sub_booking_id)->where('invoice_id', $sale->id),
            "subbook" => $subbook,
            "invoice_method" => $invoice_method
        ]);
    }

    public function detaildeposit($name){

        $sale = Sale::all()->where('status', 2)->where('no_invoice', $name)->first();
        // dd($sale);
        // dd($sale->booking->customer->pets);
        $bookingService = BookingService::all()->where('booking_id', $sale->booking_id)->first();
        $item = $sale->booking;
        $staff = Staff::all()->where('status', 'Active');
        $subAccount = Pet::all()->where('customer_id', $sale->booking->customer->id);
        return view('finance.detailsalelistdeposit', [
            "title" => "Sale List Despoit",
            "sale" => $sale,
            "bookingService" => $bookingService,
            "item" => $item,
            "staffs" => $staff,
            "subAccount" => $subAccount,
            "servicePrice" => ServicePrice::all(),
        ]);
    }

    public function financeTaxRate(){
        return view('finance.taxrate', [
            "title" => "Tax Rate",
            "tax" => TaxRate::all()
        ]);
    }

    public function editFacility($facility_name){
        $facility = Facility::all()->where('facility_name', $facility_name);
        
        return view('location.editFacility', [
            "title" => "Facility",
            "facility" => $facility->first(),
            "locations" => Location::all()
        ]);
    }

    public function autocompleteSearch(Request $request){
        // $query = $request->get('query');
        // $filterResult = Country::where('country_name', 'LIKE', '%'. $query. '%')->get();
        // return response()->json($filterResult);

        $datas = Country::select("country_name")
            ->where("country_name","LIKE","%{$request->input('query')}%")
            ->get();
        $dataModified = array();
        foreach ($datas as $data){
            $dataModified[] = $data->country_name;
        }

        return response()->json($dataModified);
    }

    public function serviceAutocompleteSearch(Request $request){
        // $query = $request->get('query');
        // $filterResult = Country::where('country_name', 'LIKE', '%'. $query. '%')->get();
        // return response()->json($filterResult);

        $datas = Service::select("service_name")
            ->where("service_name","LIKE","%{$request->input('query')}%")
            ->get();
        $dataModified = array();
        foreach ($datas as $data){
            $dataModified[] = $data->service_name;
        }

        return response()->json($dataModified);
    }

    public function alasanKunjunganSearch(Request $request){
        // $query = $request->get('query');
        // $filterResult = Country::where('country_name', 'LIKE', '%'. $query. '%')->get();
        // return response()->json($filterResult);

        $datas = AlasanKunjungan::select("name")
            ->where("name","LIKE","%{$request->input('query')}%")
            ->get();
        $dataModified = array();
        foreach ($datas as $data){
            $dataModified[] = $data->name;
        }

        return response()->json($dataModified);
    }

    public function customerSearch(Request $request){

        $datas = Customer::select("id", "first_name", "phone")
            ->where("first_name","LIKE","%{$request->input('query')}%")->orWhere("phone","LIKE","%{$request->input('query')}%")
            ->get();
        $dataModified = array();
        foreach ($datas as $data){
            $dataModified[] = $data->first_name . " (" . $data->phone . ")";
        }

        return response()->json($dataModified);
    }

    public function cartProductSearch(Request $request){

        $datas = Product::select("product_name")
            ->where("product_name","LIKE","%{$request->input('query')}%")->where("stock", ">" , 0)
            ->get();
        $dataModified = array();
        foreach ($datas as $data){
            $dataModified[] = $data->product_name;
        }

        return response()->json($dataModified);
    }

    public function bookingDiagnosisSearch(Request $request){

        $datas = Diagnosis::select("diagnosis_name")
            ->where("diagnosis_name","LIKE","%{$request->input('query')}%")
            ->get();
        $dataModified = array();
        foreach ($datas as $data){
            $dataModified[] = $data->diagnosis_name;
        }

        return response()->json($dataModified);
    }

    public function allReport(){
        return view('report.allreport', [
            "title" => "Report"
        ]);
    }

    public function bookingCalender(){
        $subbook = SubBook::all();
        // dd($subbook);

        $events = [];

        foreach ($subbook as $b) {
            $date = date_format($b->created_at, 'H:i');
            // dd($b->booking_date);
            $formatDate = date_create($b->booking_date);
            $events[] = [
                'subbook_id' => $b->id,
                // 'title' => $b->booking->,
                'title' => str(date_format($formatDate, "H:i") . ' ' . $b->booking->customer->first_name." - ".$b->booking->customer->pets[0]->pet_name??''),
                'start' => str(date_format($formatDate, 'Y-m-d')),
                'start_time' => date_format($formatDate, "H:i"),
                'end_booking' => $b->end_booking
                
            ];

            // dd($events);
        }

        return response()->json($events);
    }

    public function dashboardCalendar(){
        return view('calendar.Dashboard', [
            "title" => "Calendar",
            "tasks" => Booking::all()
        ]);
    }

    public function bookingdetail(){
        return view('calendar.bookingdetail', [
            "title" => "Booking"
        ]);
    }

    public function absent(){
        return view('presence.absent', [
            "title" => "Absent"
        ]);
    }

    public function presencelist(){
        $shiftTime = '19:00';
        $timeNow = '08:01';
        $timeDateNow = Date::now();
        $hourminute = date_format($timeDateNow ,"H:i");
        $timeDifference  = Carbon::parse($hourminute)->diffInMinutes(Carbon::parse($shiftTime));
        $attendances = Attendance::latest()->paginate(30)->withQueryString();
        // dd($timeDifference);
        return view('presence.newpresencelist', [
            "title" => "Presence List",
            "timeDifference" => $timeDifference,
            "timeDateNow" => $hourminute,
            "attendances" => $attendances
        ]);
    }

    function cekAvailableMasuk(){

    }

    public function presencescan(Request $request){

        $staff = Staff::all()->where('UUID', $request->qrid)->first();
        // dd($staff);

        //kalau gk ada langsung return error
        if($staff == null){
            Alert::warning('Not Found', "Your QR ID doesn't exist!");
            return redirect()->back();
        }
        
        
        $attendanceAtDayNow = Attendance::all()->where('staff_id', $staff->id)->where('check_in', date_format(Date::now(), 'Y-m-d'))->first();
        $checkingAttendance = Attendance::latest()->where('staff_id', $staff->id)->get();
        // dd($checkingAttendance[0]);
        // $attendanceAtBefore = Attendance::all()->where('staff_id', $staff->id)->where('check_in', date_format(Date::now()->subDay(1), 'Y-m-d'))->first();
        $dayNow = date_format(Date::now(), 'l');
        $dayBefore = date_format(Date::now()->subDay(1), 'l');
        
        $shiftLibur = Shift::find($staff->workdays[0]->$dayNow);
        if($shiftLibur->shift_name == 'Libur'){
            Alert::warning('Warning', "Shift anda hari ini libur!");
            return redirect()->back();
        }
        // dd($attendanceAtDayNow);
        // dd($shift);
        // dd(count($checkingAttendance));
        if(count($checkingAttendance) != 0){
            // if($checkingAttendance[0]->check_out == null){
            //     Alert::warning('Maaf', 'Anda sudah check in, silahkan laukakan check out terlebih dahulu!');
            //     return redirect('/presence');
            // }else{
                // dd('ajsasjas');
                $now = Carbon::now();
                $start = Carbon::createFromTimeString('23:00');
                $end = Carbon::createFromTimeString('23:59');
                $start1 = Carbon::createFromTimeString('00:00');
                $end1 = Carbon::createFromTimeString('03:00');
                
                //ini biasanya dilakukan oleh user yang cek in saat shift 1
                if ($now->between($start, $end) || $now->between($start1, $end1)){
                    // dd('ini');
                    // dd($dayBefore);
                    //pake daybefore
                    $timeNow = Carbon::now()->format('H:i');
                    
                    if($now->between($start, $end)){
                        $shiftBefore = Shift::find($staff->workdays[0]->$dayNow);
                        if($timeNow < $shiftBefore->jam_mulai){
                            Alert::warning('Maaf', 'Anda Belum Bisa Check In, Check In Kembali Pada Pukul ' . $shiftBefore->jam_mulai);
                            return redirect('/presence'); 
                        }else{
                            $attendance = new Attendance();
                            $attendance->staff_id = $staff->id;
                            $attendance->check_in = Carbon::now();
                            $attendance->status = 'Normal';
                            $attendance->over_hour = 0;
                            $attendance->shift_id = $shiftBefore->id;
                            $attendance->save();
                        }
                    }else{
                        $shiftBefore = Shift::find($staff->workdays[0]->$dayBefore);
                        if($timeNow > $shiftBefore->jam_berakhir){
                            $attendance = new Attendance();
                            $attendance->staff_id = $staff->id;
                            $attendance->check_in = Carbon::now();
                            $attendance->status = 'Late';
                            $timeDiff = Carbon::parse($timeNow)->diffInMinutes(Carbon::parse($shiftBefore->jam_berakhir));
                            // dd($timeDiff);
                            $attendance->over_hour = $timeDiff;
                            $attendance->shift_id = $shiftBefore->id;
                            $attendance->save();
                        }else{
                            $attendance = new Attendance();
                            $attendance->staff_id = $staff->id;
                            $attendance->check_in = Carbon::now();
                            $attendance->status = 'Normal';
                            $attendance->over_hour = 0;
                            $attendance->shift_id = $shiftBefore->id;
                            $attendance->save();
                        }
                    }
                    
                }
                //ya ini harusnya shift shift yg lain
                else{
                    
                    $attendanceCheck = Attendance::latest()->where('staff_id', $staff->id)->get();
                    // dd($attendanceCheck);
                    // if($attendanceCheck[0]->check_out == null){
                    //     Alert::warning('Maaf', 'Anda sudah check in, silahkan laukakan check out terlebih dahulu!');
                    //     return redirect('/presence');
                    // }else{

                        $shift = Shift::find($staff->workdays[0]->$dayNow);
                        $timeNow = Carbon::now()->format('H:i');
                        
                        if($timeNow < $shift->jam_mulai){
                            Alert::warning('Maaf', 'Anda Belum Bisa Check In, Check In Kembali Pada Pukul ' . $shift->jam_mulai);
                            return redirect('/presence'); 
                        }elseif($timeNow > $shift->jam_berakhir){
                            
                            $attendance = new Attendance();
                            $attendance->staff_id = $staff->id;
                            $attendance->check_in = Carbon::now();
                            $attendance->status = 'Late';
                            $timeDiff = Carbon::parse($timeNow)->diffInMinutes(Carbon::parse($shift->jam_berakhir));
                            $attendance->over_hour = $timeDiff;
                            $attendance->shift_id = $shift->id;
                            $attendance->save();
                        }else{
                            $attendance = new Attendance();
                            $attendance->staff_id = $staff->id;
                            $attendance->check_in = Carbon::now();
                            $attendance->status = 'Normal';
                            $attendance->over_hour = 0;
                            $attendance->shift_id = $shift->id;
                            $attendance->save();
                        }
                    // }
                }
            // }
        }else{
            $now = Carbon::now();
            $start = Carbon::createFromTimeString('23:00');
            $end = Carbon::createFromTimeString('23:59');
            $start1 = Carbon::createFromTimeString('00:00');
            $end1 = Carbon::createFromTimeString('03:00');
            
            //ini biasanya dilakukan oleh user yang cek in saat shift 1
            if ($now->between($start, $end) || $now->between($start1, $end1)){
                //pake daybefore
                $timeNow = Carbon::now()->format('H:i');
                
                if($now->between($start, $end)){
                    $shiftBefore = Shift::find($staff->workdays[0]->$dayNow);
                    if($timeNow < $shiftBefore->jam_mulai){
                        Alert::warning('Maaf', 'Anda Belum Bisa Check In, Check In Kembali Pada Pukul ' . $shiftBefore->jam_mulai);
                        return redirect('/presence'); 
                    }else{
                        $attendance = new Attendance();
                        $attendance->staff_id = $staff->id;
                        $attendance->check_in = Carbon::now();
                        $attendance->status = 'Normal';
                        $attendance->over_hour = 0;
                        $attendance->shift_id = $shiftBefore->id;
                        $attendance->save();
                    }
                }else{
                    $shiftBefore = Shift::find($staff->workdays[0]->$dayBefore);
                    if($timeNow > $shiftBefore->jam_berakhir){
                        $attendance = new Attendance();
                        $attendance->staff_id = $staff->id;
                        $attendance->check_in = Carbon::now();
                        $attendance->status = 'Late';
                        $timeDiff = Carbon::parse($timeNow)->diffInMinutes(Carbon::parse($shiftBefore->jam_berakhir));
                        // dd($timeDiff);
                        $attendance->over_hour = $timeDiff;
                        $attendance->shift_id = $shiftBefore->id;
                        $attendance->save();
                    }else{
                        $attendance = new Attendance();
                        $attendance->staff_id = $staff->id;
                        $attendance->check_in = Carbon::now();
                        $attendance->status = 'Normal';
                        $attendance->over_hour = 0;
                        $attendance->shift_id = $shiftBefore->id;
                        $attendance->save();
                    }
                }
                
            }
            //ya ini harusnya shift shift yg lain
            else{
                $attendanceCheck = Attendance::latest()->where('staff_id', $staff->id)->get();
                // dd($attendanceCheck);
                if(count($attendanceCheck) != 0){
                    // if($attendanceCheck[0]->check_out == null){
                    //     Alert::warning('Maaf', 'Anda sudah check in, silahkan laukakan check out terlebih dahulu!');
                    //     return redirect('/presence');
                    // }else{
    
                        $shift = Shift::find($staff->workdays[0]->$dayNow);
                        $timeNow = Carbon::now()->format('H:i');
                        
                        if($timeNow < $shift->jam_mulai){
                            Alert::warning('Maaf', 'Anda Belum Bisa Check In, Check In Kembali Pada Pukul ' . $shift->jam_mulai);
                            return redirect('/presence'); 
                        }elseif($timeNow > $shift->jam_berakhir){
                            $attendance = new Attendance();
                            $attendance->staff_id = $staff->id;
                            $attendance->check_in = Carbon::now();
                            $attendance->status = 'Late';
                            $timeDiff = Carbon::parse($timeNow)->diffInMinutes(Carbon::parse($shift->jam_berakhir));
                            $attendance->over_hour = $timeDiff;
                            $attendance->shift_id = $shift->id;
                            $attendance->save();
                        }else{
                            $attendance = new Attendance();
                            $attendance->staff_id = $staff->id;
                            $attendance->check_in = Carbon::now();
                            $attendance->status = 'Normal';
                            $attendance->over_hour = 0;
                            $attendance->shift_id = $shift->id;
                            $attendance->save();
                        }
                    // }
                }else{
                    $shift = Shift::find($staff->workdays[0]->$dayNow);
                    $timeNow = Carbon::now()->format('H:i');
                    
                    if($timeNow < $shift->jam_mulai){
                        Alert::warning('Maaf', 'Anda Belum Bisa Check In, Check In Kembali Pada Pukul ' . $shift->jam_mulai);
                        return redirect('/presence'); 
                    }elseif($timeNow > $shift->jam_berakhir){
                        $attendance = new Attendance();
                        $attendance->staff_id = $staff->id;
                        $attendance->check_in = Carbon::now();
                        $attendance->status = 'Late';
                        $timeDiff = Carbon::parse($timeNow)->diffInMinutes(Carbon::parse($shift->jam_berakhir));
                        $attendance->over_hour = $timeDiff;
                        $attendance->shift_id = $shift->id;
                        $attendance->save();
                    }else{
                        $attendance = new Attendance();
                        $attendance->staff_id = $staff->id;
                        $attendance->check_in = Carbon::now();
                        $attendance->status = 'Normal';
                        $attendance->over_hour = 0;
                        $attendance->shift_id = $shift->id;
                        $attendance->save();
                    }
                }
            }
        }
        

        Alert::success('Success', 'You have successfully checked in!');
        return redirect()->back();
    }

    public function checkoutButton(Request $request, $id){
        $attendance = Attendance::find($id);
        $attendance->check_out = Carbon::now();
        $checkTime = $attendance->check_out->format('H:i');
        
        if($attendance->shift == null){
            $timeDifference = 0;
            $attendance->duration_work = $timeDifference;
            $attendance->save();
            Alert::success('Success', 'You have successfully check out!');
            return redirect()->back();
        }else{
            if($attendance->shift->end_hour > $checkTime){
                $timeDifference = 0;
            }else{
                $timeDifference  = Carbon::parse($checkTime)->diffInMinutes(Carbon::parse($attendance->shift->end_hour));
            }
            
            $attendance->duration_work = $timeDifference;
            $attendance->save();
            Alert::success('Success', 'You have successfully check out!');
            return redirect()->back();
        }
        
    }

    public function profile(){
        // dd(Auth::user()->id);
        $attendances = Attendance::latest()->where('staff_id', Auth::user()->id)->paginate(20)->withQueryString();
        $timeNow = Carbon::now()->format('H:i');
        // dd($timeNow);
        return view('profile.myAccount', [
            "title" => "My Profile",
            "locations"=>Location::all(),
            "attendances" => $attendances,
            "timeNow" => $timeNow
        ]);
    }

    function selectService(Request $request){
        // dd($request->service_id); 
        $plan = Plan::find($request->plan_id);
        // dd($plan);
        // dd($request->all());
        return view('service.listPlan', [
            'title' => 'List Plan',
            'plan' => $plan,
            'tasks' => Task::all(),
            'list_plans' => ListPlan::all()->where('plan_id', $plan->id),
            'frequencies' => Frequency::all(),
            'locations' => Location::all(),
            'diagnosis' => Diagnosis::all(),
            'services' => Service::all()->where('status', 'Active'),
            'servicePrice' => ServicePrice::all(),
            'service_id' => $request->service_id
        ]);
    }



    //Staff
    public function staffDashboard(){
        return view('staff.dashboard',[
            "title" => "Staff Dashboard"
        ]);
    }

    //Customer
    public function customerDashboard(){
        return view('customer.dashboard',[
            "title" => "Customer Dashboard"
        ]);
    }

    //Product
    public function productDashboard(){
        return view('product.dashboard',[
            "title" => "Product Dashboard"
        ]);
    }

    // historyactivity
    public function historyactivity(){
        return view('historyactivity', [
            "title" => "Histori Aktivitas",
            "histories" => History::latest()->paginate(100)
        ]);
    }
    
}
