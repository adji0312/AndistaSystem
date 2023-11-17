<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CategoryServiceController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListPlanController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MessengerTypeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaxRateController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\UnitFacilityController;
use App\Http\Controllers\UsageAddressController;
use App\Http\Controllers\UsageContactController;
use App\Models\Attendance;
use App\Models\Facility;
use App\Models\UsageContact;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'home']);
Route::get('/upcoming-booking', [IndexController::class, 'upcomingbooking']);
Route::get('/location/list/add/autocomplete-search', [IndexController::class, 'autocompleteSearch']);

//Location
Route::get('/location', [IndexController::class, 'locationDashboard']);
Route::get('/location/list', [IndexController::class, 'locationList']);
Route::get('/location/list/add', [IndexController::class, 'addLocation']);
Route::post('/addLocation', [LocationController::class, 'store']);
Route::get('/location/{location_name}', [IndexController::class, 'editLocation']);
Route::get('/location-setting', [IndexController::class, 'settingLocation']);

// Finance
Route::get('/finance', [IndexController::class, 'financeDashboard']);
Route::get('/finance/list', [IndexController::class, 'financeList']);
Route::get('/finance/taxrate', [IndexController::class, 'financeTaxRate']);
Route::post('/addTaxRate', [TaxRateController::class, 'store']);
Route::post('/updateTaxRate/{id}', [TaxRateController::class, 'update']);
Route::get('/deleteTax', [TaxRateController::class, 'deleteTax']);

//Service
Route::get('/service', [IndexController::class, 'serviceDashboard']);
Route::get('/service/list', [IndexController::class, 'serviceList']);
Route::get('/service/list/add', [IndexController::class, 'addService']);
Route::get('/service/list/{name}', [IndexController::class, 'addServiceDetail']);
Route::get('/service/treatmentplan', [IndexController::class, 'treatmentPlan']);
Route::get('/service/treatmentplan/add', [IndexController::class, 'addTreatmentPlan']);
Route::post('/addService', [ServiceController::class, 'store']);
Route::get('/deleteService', [ServiceController::class, 'deleteService']);
Route::get('/discardChange/{id}', [ServiceController::class, 'discardChange']);
Route::post('/saveChange/{id}', [ServiceController::class, 'saveChange']);

Route::get('/service/policy', [IndexController::class, 'policy']);
Route::get('/service/policy/add', [IndexController::class, 'addPolicy']);
Route::get('/service/policy/{id}', [IndexController::class, 'editPolicy']);
Route::post('/addPolicy', [PolicyController::class, 'store']);
Route::get('/deletePolicy', [PolicyController::class, 'deletePolicy']);
Route::post('/updatePolicy/{id}', [PolicyController::class, 'update']);

Route::post('/addPriceService', [ServiceController::class, 'addPriceService']);
Route::post('/updatePriceService/{id}', [ServiceController::class, 'updatePriceService']);
Route::get('/deletePriceService/{id}', [ServiceController::class, 'deletePriceService']);
Route::post('/addFacilityService', [ServiceController::class, 'addFacilityService']);
Route::get('/deleteFacilityService/{id}', [ServiceController::class, 'deleteFacilityService']);



// Service Category
Route::get('/service/category', [IndexController::class, 'serviceCategory']);
Route::get('/service/diagnosis', [IndexController::class, 'serviceDiagnosis']);
Route::post('/addCategory', [CategoryServiceController::class, 'store']);
Route::post('/addDiagnosis', [DiagnosisController::class, 'store']);
Route::post('/updateCategory/{id}', [CategoryServiceController::class, 'update']);
Route::post('/updateDiagnosis/{id}', [DiagnosisController::class, 'update']);
Route::get('/deleteCategory', [CategoryServiceController::class, 'deleteCategory']);
Route::get('/deleteDiagnosis', [DiagnosisController::class, 'deleteDiagnosis']);

Route::post('/post', [IndexController::class, 'store']);

Route::post('/addTask', [TaskController::class, 'store']);


// Facility
Route::get('/facility', [IndexController::class, 'locationFacility']);
Route::get('/deleteFacility', [FacilityController::class, 'deleteFacility']);
Route::get('/location/facility/add', [IndexController::class, 'addFacility']);
Route::post('/addFacility', [FacilityController::class, 'store']);
Route::post('/addunitfacility', [UnitFacilityController::class, 'store']);
Route::post('/editFacility/{id}', [FacilityController::class, 'edit']);
Route::post('/updateunitfacility/{id}', [UnitFacilityController::class, 'editUnit']);
Route::get('/location/facility/{facility_name}', [IndexController::class, 'editFacility']);
Route::get('/deleteUnit/{id}', [UnitFacilityController::class, 'deleteUnit']);



//Treatment Plan
Route::get('/service/treatmentplan/add/{name}', [ListPlanController::class, 'index']);
Route::post('/addTreatment', [PlanController::class, 'storeTreatment']);
Route::get('/deleteItem/{id}', [ListPlanController::class, 'deleteItem']);
Route::post('/updateTreatment/{id}', [PlanController::class, 'updateTreatment']);
Route::get('/deletePlan', [PlanController::class, 'deletePlan']);

//List Plan in Treatment
Route::post('/addTaskPlan', [ListPlanController::class, 'addTaskPlan']); //task
Route::post('/editTaskPlan/{id}', [ListPlanController::class, 'editTaskPlan']);
Route::post('/addServicePlan', [ListPlanController::class, 'addServicePlan']); //task
Route::post('/editServicePlan/{id}', [ListPlanController::class, 'editServicePlan']);


// Usage Contact
Route::post('/addTypeMessenger', [MessengerTypeController::class, 'store']);
Route::post('/updateMessengerType/{id}', [MessengerTypeController::class, 'update']);
Route::get('/deleteMessengerType', [MessengerTypeController::class, 'deleteMessengerType']);

Route::post('/addUsageContact', [UsageContactController::class, 'store']);
Route::post('/editUsageContact/{id}', [UsageContactController::class, 'update']);
Route::get('/deleteUsageContact', [UsageContactController::class, 'deleteUsageContact']);

Route::post('/addUsageAddress', [UsageAddressController::class, 'store']);
Route::post('/editUsageAddress/{id}', [UsageAddressController::class, 'update']);
Route::get('/deleteUsageAddress', [UsageAddressController::class, 'deleteUsageAddress']);


// Attendance
Route::get('/attendance', [AttendanceController::class, 'dashboard']);
Route::get('/attendance/list', [AttendanceController::class, 'attendancelist']);
Route::get('/attendance/list/{name}', [AttendanceController::class, 'attendancelistbylocation']);
Route::get('/attendance/workingshift', [AttendanceController::class, 'workingshift']);
Route::get('/attendance/managestaff', [AttendanceController::class, 'managestaff']);
Route::get('/attendance/managestaff/{name}', [AttendanceController::class, 'staffbylocation']);

//Shift
Route::post('/addShift', [ShiftController::class, 'addshift']);
Route::post('/editShift/{id}', [ShiftController::class, 'editShift']);
Route::get('/deleteShift', [ShiftController::class, 'deleteShift']);

//Report
Route::get('/report', [IndexController::class, 'allReport']);

//Calendar
Route::get('/calendar', [IndexController::class, 'dashboardCalendar']);
Route::get('/newBooking', [IndexController::class, 'createbooking']);
Route::get('/bookingdetail', [IndexController::class, 'bookingdetail']);

//Presence
Route::get('/presence', [IndexController::class, 'absent']);
Route::get('/presence/list', [IndexController::class, 'presencelist']);

//Profile
Route::get('/profile', [IndexController::class, 'profile']);

// Contact Location - phone
Route::post('/addPhoneLocation', [LocationController::class, 'addPhoneLocation']);
Route::get('/deletePhoneLocation/{id}', [LocationController::class, 'deletePhoneLocation']);
Route::post('/updatePhoneLocation/{id}', [LocationController::class, 'updatePhoneLocation']);
// Contact Location - email
Route::post('/addEmailLocation', [LocationController::class, 'addEmailLocation']);
Route::get('/deleteEmail/{id}', [LocationController::class, 'deleteEmail']);
Route::post('/updateEmailLocation/{id}', [LocationController::class, 'updateEmailLocation']);

Route::post('/selectService', [IndexController::class, 'selectService']);