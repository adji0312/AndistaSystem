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
            "locations" => Location::all()
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
        return view('finance.dashboard', [
            "title" => "Finance Dashboard",
            "totalSales" => Sale::all()->where('status', 0)->where('is_delete', 1)->sum('total_price'),
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
            "sales" => $sales
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
        return view('finance.detailsalelistunpaid', [
            "title" => "Sale List Unpaid",
            "sale" => $sale,
            "bookingService" => $bookingService,
            "item" => $item,
            "staffs" => $staff,
            "subAccount" => $subAccount,
            "servicePrice" => ServicePrice::all(),
            "carts" => CartBooking::all()->where('sub_booking_id', $sale->sub_booking_id),
            "subbook" => $subbook
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
            $events[] = [
                'subbook_id' => $b->id,
                'title' => str(date('H:i',strtotime($date)))." ".$b->booking->services[0]->service->service_name,
                'start' => str($b->booking_date),
                'start_time' => $b->start_booking,
                'end_booking' => $b->end_booking
                
            ];
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
        $attendances = Attendance::latest()->get();
        // dd($timeDifference);
        return view('presence.presencelist', [
            "title" => "Presence List",
            "timeDifference" => $timeDifference,
            "timeDateNow" => $hourminute,
            "attendances" => $attendances
        ]);
    }

    public function presencescan(Request $request){

        $staff = Staff::all()->where('UUID', $request->qrid)->first();
        // dd($staff->shifts_id);
        $dayNow = date_format(Date::now(), 'l');
        // dd($dayNow);
        // dd($staff->workdays[0]);
        if($staff == null){
            Alert::warning('Not Found', "Your QR ID doesn't exist!");
            return redirect()->back();
        }

        if($dayNow == "Monday"){

        }elseif($dayNow == "Tuesday"){
            
        }elseif($dayNow == "Wednesday"){
            
        }elseif($dayNow == "Thursday"){
            $shift = Shift::find($staff->workdays[0]->Thursday);
            
            $dayoff = OffDay::all()->where('tanggal_merah', date_format(Date::now(), 'Y-m-d'));

            if(count($dayoff) != 0){

            }else{
                $attendance = Attendance::latest()->where('staff_id', $staff->id)->first();

                if($attendance){

                }else{
                    if($shift->start_hour == "00:00"){
                        // dd("here121212");
                        $attendance = new Attendance();
                        $attendance->staff_id = $staff->id;
                        $attendance->check_in = Carbon::now();
                        $checkTime = $attendance->check_in->format('H:i');
                        // $checkTime = '00:00';
                        // dd($checkTime);
            
                        if($checkTime > $shift->end_hour){
                            $attendance->status = 'Normal';
                            $attendance->over_hour = 0;
                            $attendance->shift_id = $shift->id;
                            $attendance->save();
                        }elseif ($checkTime > $shift->start_hour && $checkTime < $shift->end_hour){
                            $attendance->status = 'Late';
                            $timeDifference  = Carbon::parse($checkTime)->diffInMinutes(Carbon::parse($shift->start_hour));
                            $attendance->over_hour = $timeDifference;
                            $attendance->shift_id = $shift->id;
                            $attendance->save();
                        }elseif ($checkTime == $shift->start_hour){
                            $attendance->status = 'Normal';
                            $attendance->over_hour = 0;
                            $attendance->shift_id = $shift->id;
                            $attendance->save();
                        }
                    }else{
    
                        // dd('here12');
                        $attendance = new Attendance();
                        $attendance->staff_id = $staff->id;
                        $attendance->check_in = Carbon::now();
                        $checkTime = $attendance->check_in->format('H:i');
                        // $checkTime = '08:01';
                        
                        if($staff->shift->end_hour == '00:00'){
                            $endHour = '24:00';
                            if($checkTime > $staff->shift->start_hour && $checkTime < $endHour){
                                // dd("late");
                                $attendance->status = 'Late';
                                $timeDifference  = Carbon::parse($checkTime)->diffInMinutes(Carbon::parse($staff->shift->start_hour));
                                $attendance->over_hour = $timeDifference;
                                $attendance->shift_id = $staff->shifts_id;
                                $attendance->save();
                            }else{
                                // dd("normal");
                                $attendance->status = 'Normal';
                                $attendance->over_hour = 0;
                                $attendance->shift_id = $staff->shifts_id;
                                $attendance->save();
                            }
                        }else{
                            if($checkTime > $staff->shift->start_hour && $checkTime < $staff->shift->end_hour){
                                // dd("late");
                                $attendance->status = 'Late';
                                $timeDifference  = Carbon::parse($checkTime)->diffInMinutes(Carbon::parse($staff->shift->start_hour));
                                $attendance->over_hour = $timeDifference;
                                $attendance->shift_id = $staff->shifts_id;
                                $attendance->save();
                            }else{
                                // dd("normal");
                                $attendance->status = 'Normal';
                                $attendance->over_hour = 0;
                                $attendance->shift_id = $staff->shifts_id;
                                $attendance->save();
                            }
                        }
    
                    }
                }
            }
        }elseif($dayNow == "Friday"){
            
        }elseif($dayNow == "Saturday"){
            
        }elseif($dayNow == "Sunday"){

        }

        // $dayoff = OffDay::all()->where('tanggal_merah', date_format(Date::now(), 'Y-m-d'));
        // // dd(count($dayoff));
        // if(count($dayoff) != 0){

        //     $attendance = Attendance::latest()->where('staff_id', $staff->id)->first();
        //     if($attendance){
        //         if($attendance->check_out == null){
        //             Alert::warning('Sorry', 'You already check in, please check out first!');
        //             return redirect('/presence');
        //         }else{
        //             // dd('here');
        //             $attendance = new Attendance();
        //             $attendance->staff_id = $staff->id;
        //             $attendance->check_in = Carbon::now();
        //             $attendance->status = 'Hari Libur';
        //             $attendance->over_hour = 0;
        //             $attendance->shift_id = $staff->shifts_id;
        //             $attendance->save();
        //         }
        //     }else{
        //         $attendance = new Attendance();
        //         $attendance->staff_id = $staff->id;
        //         $attendance->check_in = Carbon::now();
        //         $attendance->status = 'Hari Libur';
        //         $attendance->over_hour = 0;
        //         $attendance->shift_id = $staff->shifts_id;
        //         $attendance->save();
        //     }

        // }else{
        //     $attendance = Attendance::latest()->where('staff_id', $staff->id)->first();
        //     // dd($attendance);
        //     // dd($staff->shift);
        //     if($attendance){
        //         if($attendance->check_out == null){
        //             Alert::warning('Sorry', 'You already check in, please check out first!');
        //             return redirect('/presence');
        //         }else{
        //             //cuma khusus shift yang start hour nya jam 00:00
        //             if($staff->shift->start_hour == "00:00"){
        //                 $attendance = new Attendance();
        //                 $attendance->staff_id = $staff->id;
        //                 $attendance->check_in = Carbon::now();
        //                 $checkTime = $attendance->check_in->format('H:i');
        //                 // $checkTime = '00:00';
        //                 // dd($checkTime);
            
        //                 if($checkTime > $staff->shift->end_hour){
        //                     $attendance->status = 'Normal';
        //                     $attendance->over_hour = 0;
        //                     $attendance->shift_id = $staff->shifts_id;
        //                     $attendance->save();
        //                 }elseif ($checkTime > $staff->shift->start_hour && $checkTime < $staff->shift->end_hour){
        //                     $attendance->status = 'Late';
        //                     $timeDifference  = Carbon::parse($checkTime)->diffInMinutes(Carbon::parse($staff->shift->start_hour));
        //                     $attendance->over_hour = $timeDifference;
        //                     $attendance->shift_id = $staff->shifts_id;
        //                     $attendance->save();
        //                 }elseif ($checkTime == $staff->shift->start_hour){
        //                     $attendance->status = 'Normal';
        //                     $attendance->over_hour = 0;
        //                     $attendance->shift_id = $staff->shifts_id;
        //                     $attendance->save();
        //                 }
        //             }else{

        //                 // dd('here');
        //                 $attendance = new Attendance();
        //                 $attendance->staff_id = $staff->id;
        //                 $attendance->check_in = Carbon::now();
        //                 $checkTime = $attendance->check_in->format('H:i');
        //                 // $checkTime = '08:01';
        //                 // dd($checkTime);

        //                 if($staff->shift->end_hour == '00:00'){
        //                     $endHour = '24:00';
        //                     if($checkTime > $staff->shift->start_hour && $checkTime < $endHour){
        //                         // dd("late");
        //                         $attendance->status = 'Late';
        //                         $timeDifference  = Carbon::parse($checkTime)->diffInMinutes(Carbon::parse($staff->shift->start_hour));
        //                         $attendance->over_hour = $timeDifference;
        //                         $attendance->shift_id = $staff->shifts_id;
        //                         $attendance->save();
        //                     }else{
        //                         // dd("normal");
        //                         $attendance->status = 'Normal';
        //                         $attendance->over_hour = 0;
        //                         $attendance->shift_id = $staff->shifts_id;
        //                         $attendance->save();
        //                     }
        //                 }else{
        //                     if($checkTime > $staff->shift->start_hour && $checkTime < $staff->shift->end_hour){
        //                         // dd("late");
        //                         $attendance->status = 'Late';
        //                         $timeDifference  = Carbon::parse($checkTime)->diffInMinutes(Carbon::parse($staff->shift->start_hour));
        //                         $attendance->over_hour = $timeDifference;
        //                         $attendance->shift_id = $staff->shifts_id;
        //                         $attendance->save();
        //                     }else{
        //                         // dd("normal");
        //                         $attendance->status = 'Normal';
        //                         $attendance->over_hour = 0;
        //                         $attendance->shift_id = $staff->shifts_id;
        //                         $attendance->save();
        //                     }
        //                 }
        //             }
        //         }
        //     }else{
        //         // dd("here");
        //         //cuma khusus shift yang start hour nya jam 00:00
        //         if($staff->shift->start_hour == "00:00"){
        //             // dd("here");
        //             $attendance = new Attendance();
        //             $attendance->staff_id = $staff->id;
        //             $attendance->check_in = Carbon::now();
        //             $checkTime = $attendance->check_in->format('H:i');
        //             // $checkTime = '00:00';
        //             // dd($checkTime);
        
        //             if($checkTime > $staff->shift->end_hour){
        //                 $attendance->status = 'Normal';
        //                 $attendance->over_hour = 0;
        //                 $attendance->shift_id = $staff->shifts_id;
        //                 $attendance->save();
        //             }elseif ($checkTime > $staff->shift->start_hour && $checkTime < $staff->shift->end_hour){
        //                 $attendance->status = 'Late';
        //                 $timeDifference  = Carbon::parse($checkTime)->diffInMinutes(Carbon::parse($staff->shift->start_hour));
        //                 $attendance->over_hour = $timeDifference;
        //                 $attendance->shift_id = $staff->shifts_id;
        //                 $attendance->save();
        //             }elseif ($checkTime == $staff->shift->start_hour){
        //                 $attendance->status = 'Normal';
        //                 $attendance->over_hour = 0;
        //                 $attendance->shift_id = $staff->shifts_id;
        //                 $attendance->save();
        //             }
        //         }else{

        //             // dd('here12');
        //             $attendance = new Attendance();
        //             $attendance->staff_id = $staff->id;
        //             $attendance->check_in = Carbon::now();
        //             $checkTime = $attendance->check_in->format('H:i');
        //             // $checkTime = '08:01';
                    
        //             if($staff->shift->end_hour == '00:00'){
        //                 $endHour = '24:00';
        //                 if($checkTime > $staff->shift->start_hour && $checkTime < $endHour){
        //                     // dd("late");
        //                     $attendance->status = 'Late';
        //                     $timeDifference  = Carbon::parse($checkTime)->diffInMinutes(Carbon::parse($staff->shift->start_hour));
        //                     $attendance->over_hour = $timeDifference;
        //                     $attendance->shift_id = $staff->shifts_id;
        //                     $attendance->save();
        //                 }else{
        //                     // dd("normal");
        //                     $attendance->status = 'Normal';
        //                     $attendance->over_hour = 0;
        //                     $attendance->shift_id = $staff->shifts_id;
        //                     $attendance->save();
        //                 }
        //             }else{
        //                 if($checkTime > $staff->shift->start_hour && $checkTime < $staff->shift->end_hour){
        //                     // dd("late");
        //                     $attendance->status = 'Late';
        //                     $timeDifference  = Carbon::parse($checkTime)->diffInMinutes(Carbon::parse($staff->shift->start_hour));
        //                     $attendance->over_hour = $timeDifference;
        //                     $attendance->shift_id = $staff->shifts_id;
        //                     $attendance->save();
        //                 }else{
        //                     // dd("normal");
        //                     $attendance->status = 'Normal';
        //                     $attendance->over_hour = 0;
        //                     $attendance->shift_id = $staff->shifts_id;
        //                     $attendance->save();
        //                 }
        //             }

        //         }
        //     }
        // }
        
        // dd(Date::now());
        Alert::success('Success', 'You have successfully checked in!');
        return redirect()->back();
    }

    public function checkoutButton(Request $request, $id){
        $attendance = Attendance::find($id);
        $staff = Auth::user();
        $attendance->check_out = Carbon::now();
        $checkTime = $attendance->check_out->format('H:i');
        $timeDifference  = Carbon::parse($checkTime)->diffInMinutes(Carbon::parse($staff->shift->end_hour));
        $attendance->duration_work = $timeDifference;
        $attendance->save();
        Alert::success('Success', 'You have successfully check out!');
        return redirect()->back();
        // dd($request->all());
        // dd($attendance);
    }

    public function profile(){
        // dd(Auth::user()->id);
        $attendances = Attendance::latest()->where('staff_id', Auth::user()->id)->paginate(20)->withQueryString();
        $dayoff = OffDay::all()->where('tanggal_merah', date_format(Date::now(), 'Y-m-d'));
        // $attendance->check_in = Carbon::now();
        $checkTime = Carbon::now()->format('H:i');
        // dd($checkTime);
        // dd(Auth::user()->shift->start_hour);
        $timeDifference  = Carbon::parse($checkTime)->diffInMinutes(Carbon::parse(Auth::user()->shift->start_hour));
        // dd($timeDifference);
        return view('profile.index', [
            "title" => "My Profile",
            "locations"=>Location::all(),
            "attendances" => $attendances,
            "dayoff" => $dayoff,
            "timeDifference" => $timeDifference
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
    
}
