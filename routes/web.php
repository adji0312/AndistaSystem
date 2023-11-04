<?php

use App\Http\Controllers\CategoryServiceController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListPlanController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MessengerTypeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaxRateController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\UnitFacilityController;
use App\Http\Controllers\UsageAddressController;
use App\Http\Controllers\UsageContactController;
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
Route::get('/location/list/add/autocomplete-search', [IndexController::class, 'autocompleteSearch']);


Route::get('/location', [IndexController::class, 'locationDashboard']);
Route::get('/location/list', [IndexController::class, 'locationList']);
Route::get('/location/list/add', [IndexController::class, 'addLocation']);
Route::post('/addLocation', [LocationController::class, 'store']);
Route::get('/location/{location_name}', [IndexController::class, 'editLocation']);


Route::get('/finance', [IndexController::class, 'financeDashboard']);
Route::get('/finance/list', [IndexController::class, 'financeList']);
Route::get('/finance/taxrate', [IndexController::class, 'financeTaxRate']);
Route::post('/addTaxRate', [TaxRateController::class, 'store']);
Route::post('/updateTaxRate/{id}', [TaxRateController::class, 'update']);
Route::get('/deleteTax', [TaxRateController::class, 'deleteTax']);

Route::get('/service', [IndexController::class, 'serviceDashboard']);
Route::get('/service/list', [IndexController::class, 'serviceList']);
Route::get('/service/list/add', [IndexController::class, 'addService']);
Route::get('/service/treatmentplan', [IndexController::class, 'treatmentPlan']);
Route::get('/service/treatmentplan/add', [IndexController::class, 'addTreatmentPlan']);

Route::get('/service/policy', [IndexController::class, 'policy']);
Route::get('/service/policy/add', [IndexController::class, 'addPolicy']);
Route::get('/service/policy/{id}', [IndexController::class, 'editPolicy']);
Route::post('/addPolicy', [PolicyController::class, 'store']);
Route::get('/deletePolicy', [PolicyController::class, 'deletePolicy']);
Route::post('/updatePolicy/{id}', [PolicyController::class, 'update']);


Route::get('/service/category', [IndexController::class, 'serviceCategory']);
Route::post('/addCategory', [CategoryServiceController::class, 'store']);
Route::post('/updateCategory/{id}', [CategoryServiceController::class, 'update']);
Route::get('/deleteCategory', [CategoryServiceController::class, 'deleteCategory']);

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

//Service
Route::post('/addService', [ServiceController::class, 'store']);

//Treatment Plan
Route::get('/service/treatmentplan/add/{name}', [ListPlanController::class, 'index']);
Route::post('/addTreatment', [PlanController::class, 'storeTreatment']);
Route::post('/addPlan', [ListPlanController::class, 'store']);
Route::post('/addDiagnosis', [PlanController::class, 'storeDiagnosis']);
Route::get('/deleteItem/{id}', [ListPlanController::class, 'deleteItem']);
Route::post('/updateTreatment/{id}', [PlanController::class, 'updateTreatment']);

// Usage Contact
Route::post('/addUsage', [UsageContactController::class, 'store']);
Route::post('/addTypeMessenger', [MessengerTypeController::class, 'store']);

Route::post('/addUsageAddress', [UsageAddressController::class, 'store']);