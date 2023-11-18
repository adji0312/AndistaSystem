<?php

namespace App\Http\Controllers;

use App\Models\CategoryService;
use App\Models\Country;
use App\Models\Diagnosis;
use App\Models\Facility;
use App\Models\Frequency;
use App\Models\ListPlan;
use App\Models\Location;
use App\Models\LocationContactEmail;
use App\Models\LocationContactMessenger;
use App\Models\LocationContactPhone;
use App\Models\MessengerType;
use App\Models\Plan;
use App\Models\Policy;
use App\Models\Service;
use App\Models\ServiceAndFacility;
use App\Models\ServicePrice;
use App\Models\Staff;
use App\Models\Task;
use App\Models\TaxRate;
use App\Models\UnitFacility;
use App\Models\UsageAddress;
use App\Models\UsageContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Http\Response;

use function PHPSTORM_META\map;

class IndexController extends Controller
{
    public function home(){
        return view('home', [
            "title" => "Home",
            
        ]);
    }

    public function upcomingbooking(){
        return view('upcomingbooking', [
            "title" => "Upcoming Booking"
        ]);
    }
    

    public function locationDashboard(){
        return view('location.dashboard', [
            "title" => "Location Dashboard"
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
            "title" => "Service Dashboard"
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
        // dd($servicefacility);
        return view('service.addServiceDetail', [
            "title" => "Service List",
            "categories" => CategoryService::all(),
            "tax" => TaxRate::all(),
            "locations" => Location::all()->where('status', 'Active'),
            "policies" => Policy::all()->where('status', 'Active'),
            "facilities" => Facility::all()->where('status', 'Active'),
            // "staff" => Staff::all(),
            "service" => $service,
            "priceService" => ServicePrice::all()->where('service_id', $service->id),
            "servicefacility" => $servicefacility
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
            "title" => "Finance Dashboard"
        ]);
    }
    
    public function financeList(){
        return view('finance.financelist', [
            "title" => "Finance List"
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

    public function allReport(){
        return view('report.allreport', [
            "title" => "All Report"
        ]);
    }

    public function dashboardCalendar(){
        return view('calendar.Dashboard', [
            "title" => "Calendar"
        ]);
    }

    public function createbooking(){
        return view('calendar.createBooking', [
            "title" => "Booking"
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
        return view('presence.presencelist', [
            "title" => "Presence List"
        ]);
    }

    public function profile(){
        return view('profile.index', [
            "title" => "My Profile"
        ]);
    }

    function selectService(Request $request){
        // dd($request->service_id); 
        $plan = Plan::find($request->plan_id);
        dd($plan);
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
