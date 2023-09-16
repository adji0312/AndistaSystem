<?php

use App\Http\Controllers\IndexController;
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


Route::get('/location', [IndexController::class, 'locationDashboard']);
Route::get('/location/list', [IndexController::class, 'locationList']);
Route::get('/location/list/add', [IndexController::class, 'addLocation']);
Route::get('/location/facility', [IndexController::class, 'locationFacility']);
Route::get('/location/facility/add', [IndexController::class, 'addFacility']);



Route::get('/service', [IndexController::class, 'serviceDashboard']);
Route::get('/service/list', [IndexController::class, 'serviceList']);
Route::get('/service/treatmentplan', [IndexController::class, 'treatmentPlan']);
Route::get('/service/category', [IndexController::class, 'serviceCategory']);