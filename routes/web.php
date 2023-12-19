<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CartBookingController;
use App\Http\Controllers\CategoryServiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListPlanController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessengerTypeController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaxRateController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\UnitFacilityController;
use App\Http\Controllers\UsageAddressController;
use App\Http\Controllers\UsageContactController;
use App\Http\Controllers\StaffController;
use App\Models\Attendance;
use App\Models\Booking;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [IndexController::class, 'home']);
    Route::get('/upcoming-booking', [IndexController::class, 'upcomingbooking']);
    
    //AUTO SEARCHING
    Route::get('/location/list/add/autocomplete-search', [IndexController::class, 'autocompleteSearch']);
    Route::get('/newBooking/autocomplete-search', [IndexController::class, 'serviceAutocompleteSearch']);
    Route::get('/newBooking/alasan/autocomplete-search', [IndexController::class, 'alasanKunjunganSearch']);
    Route::get('/newBooking/customer/autocomplete-search', [IndexController::class, 'customerSearch']);
    Route::get('/cart/product/autocomplete-search', [IndexController::class, 'cartProductSearch']);
    Route::get('/cart/service/autocomplete-search', [IndexController::class, 'cartServiceSearch']);
    Route::get('/bookingDiagnosis/autocomplete-search', [IndexController::class, 'bookingDiagnosisSearch']);

    //Location
    Route::get('/location', [IndexController::class, 'locationDashboard']);
    Route::get('/location/list', [IndexController::class, 'locationList']);
    Route::get('/location/list/add', [IndexController::class, 'addLocation']);
    Route::post('/addLocation', [LocationController::class, 'store']);
    Route::post('/editLocation/{id}', [LocationController::class, 'edit']);
    Route::get('/location/{location_name}', [IndexController::class, 'editLocation']);
    Route::get('/location-setting', [IndexController::class, 'settingLocation']);
    
    // Finance
    Route::get('/finance', [IndexController::class, 'financeDashboard']);
    Route::get('/sale/list/paid', [IndexController::class, 'salelistpaid']);
    Route::get('/sale/list/unpaid', [IndexController::class, 'salelistunpaid']);
    Route::get('/sale/list/deposit', [IndexController::class, 'salelistdeposit']);
    // Route::get('/sale/list/unpaid/{name}', [IndexController::class, 'detailinvoice']);
    Route::get('/sale/list/deposit/{name}', [IndexController::class, 'detaildeposit']);
    Route::get('/sale/list/detail/{name}', [IndexController::class, 'detailinvoice']);
    Route::get('/quotation/list', [QuotationController::class, 'quotationList']);
    Route::get('/quotation/add', [QuotationController::class, 'addquotation']);
    Route::get('/quotation/add/{name}', [QuotationController::class, 'addquotationdetail']);
    Route::post('/storeQuotation', [QuotationController::class, 'storeQuotation']);
    Route::get('/finance/taxrate', [IndexController::class, 'financeTaxRate']);
    Route::post('/addTaxRate', [TaxRateController::class, 'store']);
    Route::post('/updateTaxRate/{id}', [TaxRateController::class, 'update']);
    Route::get('/deleteTax', [TaxRateController::class, 'deleteTax']);
    Route::post('/makePayment', [BookingController::class, 'makePayment']);
    Route::post('/makeDeposit', [BookingController::class, 'makeDeposit']);
    Route::post('/updateAddCost/{id}', [BookingController::class, 'updateAddCost']);
    Route::get('/deleteBookingService2/{id}', [CartBookingController::class, 'deleteBookingService2']);
    
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
    Route::post('/addStaffService', [ServiceController::class, 'addStaffService']);
    Route::get('/deleteFacilityService/{id}', [ServiceController::class, 'deleteFacilityService']);
    Route::get('/deleteStaffService/{id}', [ServiceController::class, 'deleteStaffService']);
    
    
    
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
    Route::get('/discardFacility/{id}', [FacilityController::class, 'discardFacility']);
    
    
    
    //Treatment Plan
    Route::get('/service/treatmentplan/add/{name}', [ListPlanController::class, 'index']);
    Route::post('/addTreatment', [PlanController::class, 'storeTreatment']);
    Route::get('/deleteItem/{id}', [ListPlanController::class, 'deleteItem']);
    Route::post('/updateTreatment/{id}', [PlanController::class, 'updateTreatment']);
    Route::get('/deletePlan', [PlanController::class, 'deletePlan']);
    
    //List Plan in Treatment
    Route::post('/addTaskPlan', [ListPlanController::class, 'addTaskPlan']); //task
    Route::post('/addServicePlan', [ListPlanController::class, 'addServicePlan']); //service
    Route::post('/addProductPlan', [ListPlanController::class, 'addProductPlan']); //product
    Route::post('/editTaskPlan/{id}', [ListPlanController::class, 'editTaskPlan']);
    Route::post('/editServicePlan/{id}', [ListPlanController::class, 'editServicePlan']);
    Route::post('/editProductPlan/{id}', [ListPlanController::class, 'editProductPlan']);
    
    
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
    Route::get('/attendance/managedayoff', [AttendanceController::class, 'managedayoff']);
    Route::post('/addDayOff', [AttendanceController::class, 'storeDayOff']);
    Route::post('/editDayOff/{id}', [AttendanceController::class, 'editDayOff']);
    Route::get('/deleteDayOff', [AttendanceController::class, 'deleteDayOff']);
    Route::post('/updateShift/{id}', [AttendanceController::class, 'updateShift']);
    Route::get('/submitFilterAttendance',[AttendanceController::class,'attendancelistbyfilter']); 
    Route::get('/submitFilterAttendanceEmployee',[AttendanceController::class,'attendancelistbyfilteremployee']); 


    //Shift
    Route::post('/addShift', [ShiftController::class, 'addshift']);
    Route::post('/editShift/{id}', [ShiftController::class, 'editShift']);
    Route::get('/deleteShift', [ShiftController::class, 'deleteShift']);
    
    //Report
    Route::get('/report', [IndexController::class, 'allReport']);
    
    //Calendar
    Route::get('/calendar', [IndexController::class, 'dashboardCalendar']);
    Route::get('/bookingCalendar',[IndexController::class,'bookingCalender']);
    Route::get('/list-booking', [BookingController::class, 'listBooking']);
    Route::get('/newBooking', [BookingController::class, 'createbooking']);
    Route::get('/newBooking/{name}', [BookingController::class, 'createbookingDetail']);
    Route::get('/bookingdetail', [IndexController::class, 'bookingdetail']);
    Route::get('/booking/detail/{id}', [BookingController::class, 'detailBookingById']);

    //Booking List
    Route::get('/booking/darurat', [BookingController::class, 'bookingdarurat']);
    Route::get('/booking/terjadwal', [BookingController::class, 'bookingterjadwal']);
    Route::get('/booking/kedatangan', [BookingController::class, 'bookingkedatangan']);
    Route::get('/booking/rawatinap', [BookingController::class, 'bookingrawatinap']);
    Route::get('/booking/memulai', [BookingController::class, 'bookingmemulai']);
    Route::get('/booking/selesai', [BookingController::class, 'bookingselesai']);


    //Presence
    Route::get('/presence', [IndexController::class, 'presencelist']);
    Route::get('/presence/list', [IndexController::class, 'presencelist']);
    Route::post('/presence/scan', [IndexController::class, 'presencescan']);
    Route::post('/checkoutButton/{id}', [IndexController::class, 'checkoutButton']);
    
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
    // Contact Location - messenger
    Route::post('/addMessengerLocation', [LocationController::class, 'addMessengerLocation']);
    Route::get('/deleteMessengerLocation/{id}', [LocationController::class, 'deleteMessengerLocation']);
    Route::post('/updateMessengerLocation/{id}', [LocationController::class, 'updateMessengerLocation']);

    // Booking
    Route::post('/addNewCustomer', [BookingController::class, 'addNewCustomer']);
    Route::post('/addSubAccount', [BookingController::class, 'addSubAccount']);
    Route::post('/addBooking', [BookingController::class, 'storeBooking']);
    Route::post('/editBooking/{id}', [BookingController::class, 'editBooking']);
    Route::post('/addBookingService', [BookingController::class, 'addBookingService']);
    Route::post('/editBookingService/{id}', [BookingController::class, 'editBookingService']);
    Route::get('/discardBooking/{id}', [BookingController::class, 'discardBooking']);
    Route::post('/checkBookingService/{id}', [BookingController::class, 'checkBookingService']);
    Route::get('/deleteBookingService/{id}', [BookingController::class, 'deleteBookingService']);
    Route::post('/changeStatus/{id}', [BookingController::class, 'changeStatus']);

    // Sub Account
    Route::post('/updateSubAccount/{id}', [BookingController::class, 'updateSubAccount']);
    Route::get('/deleteSubAccount/{id}', [BookingController::class, 'deleteSubAccount']);

    //Statistic
    Route::post('/addStatistic', [BookingController::class, 'addStatistic']);

    //Detail Booking
    Route::post('/addCartProduct', [CartBookingController::class, 'addCartProduct']);
    Route::post('/addCartProduct2', [CartBookingController::class, 'addCartProduct2']);
    Route::post('/addCartProduct3', [CartBookingController::class, 'addCartProduct3']);
    Route::post('/addCartService', [CartBookingController::class, 'addCartService']);
    Route::post('/addCartService2', [CartBookingController::class, 'addCartService2']);
    Route::post('/addBookingDiagnosis', [BookingController::class, 'addBookingDiagnosis']);
    Route::post('/updateCartBooking/{id}', [CartBookingController::class, 'updateCartBooking']);
    Route::post('/updateCartBooking2/{id}', [CartBookingController::class, 'updateCartBooking2']);
    Route::post('/updateCartBooking3/{id}', [CartBookingController::class, 'updateCartBooking3']);
    Route::get('/deleteCartBooking/{id}', [CartBookingController::class, 'deleteCartBooking']);
    Route::get('/deleteCartBooking2/{id}', [CartBookingController::class, 'deleteCartBooking2']);
    Route::get('/deleteCartBooking3/{id}', [CartBookingController::class, 'deleteCartBooking3']);
    Route::post('/saveCartBooking/{id}', [CartBookingController::class, 'saveCartBooking']);
    Route::post('/saveCartBooking2/{id}', [CartBookingController::class, 'saveCartBooking2']);
    Route::post('/saveCartBooking3/{id}', [CartBookingController::class, 'saveCartBooking3']);
    Route::post('/submitTextBooking', [CartBookingController::class, 'submitTextBooking']);
    Route::post('/editTextBooking/{id}', [CartBookingController::class, 'editTextBooking']);
    Route::get('/deleteBookingDiagnosis/{id}', [BookingController::class, 'deleteBookingDiagnosis']);
    Route::post('/editBookingDiagnosis/{id}', [BookingController::class, 'editBookingDiagnosis']);
    Route::post('/updateBookingDate/{id}', [BookingController::class, 'updateBookingDate']);


    // -- SEMUA ROUTING STAFF
    // Staff
    Route::get('/Staff',[IndexController::class,'staffDashboard']);
    Route::get('/staff',[IndexController::class,'staffDashboard']);
    Route::get('/staff/list',[StaffController::class,'staffList']);
    Route::get('/staff/position',[StaffController::class,'staffPosition']);
    Route::get('/staff/working-hours',[StaffController::class,'staffWorkingHours']);
    Route::get('/staff/access-control',[StaffController::class,'staffAccessControl']);
    Route::get('/staff/security-groups',[StaffController::class,'staffSecurityGroups']);
    
    
    //Staff Add
    Route::get('/staff/add-new-staff',[StaffController::class,'addNewStaff']);
    Route::post('/saveNewStaff', [StaffController::class, 'addStaff']);
    //Staff Update
    Route::get('/staff/update-data/{id}',[StaffController::class,'viewUpdateStaff']);
    Route::post('/saveUpdateStaff/{id}',[StaffController::class,'saveUpdateStaff']);
    //StaffDelete
    Route::get('/deleteStaff',[StaffController::class,'deleteStaff']);
    //Staff Position Add
    Route::post('/addPosition',[StaffController::class,'addStaffPosition']);
    //Staff Position Update
    Route::post('/updatePosition/{id}',[StaffController::class,'updateStaffPosition']);
    
    //Staff Position Delete
    Route::get('/deleteStaffJob',[StaffController::class,'deleteStaffJob']);
    
    //Staff Save Access Control
    Route::post('/saveAccessControl/{id}',[StaffController::class,'saveStaffAccessControl']);
    
    //Staff Access Control detail
    Route::get('/staff/access-control-new',[StaffController::class,'newAccessControl']);
    Route::get('/staff/access-control/detail/{id}',[StaffController::class,'staffAccessControlDetail']);
    
    //Staff Update Data
    Route::post('/saveUpdatedStaffInfo/{id}',[StaffController::class,'saveStaffUpdateInformation']);

    //Staff Reset Password
    Route::post('/resetPassword/{id}',[StaffController::class,'resetPassword']);

    //Staff QR Attendance
    Route::get('/qr-attendance',[StaffController::class,'qrAttendance']);

    //JOB
    Route::post('/addJob', [ProductController::class, 'addJob']);
    Route::get('/deleteJob',[ProductController::class,'deleteJob']);
    Route::post('/editJob/{id}',[ProductController::class,'editJob']);
    
    //SECURITY Groups
    Route::post('/addJob', [ProductController::class, 'addJob']);
    Route::get('/deleteJob',[ProductController::class,'deleteJob']);
    Route::post('/editJob/{id}',[ProductController::class,'editJob']);
    
    
    //--SEMUA ROUTING CUSTOMER
    //Customer
    Route::get('/customer',[IndexController::class,'customerDashboard']);
    Route::get('/customer/list',[CustomerController::class,'customerList']);
    Route::get('/customer/sub-customer-list',[CustomerController::class,'petList']);
    Route::get('/customer/detail/{id}',[CustomerController::class,'customerdetail']);
    
    //Customer Add
    Route::get('/customer/list/add', [CustomerController::class,'addCustomer']);
    Route::post('/addCustomer', [CustomerController::class, 'store']);
    Route::get('/customer/list/edit/{id}',[CustomerController::class,'addPets']);
    Route::get('/customer/list/saved/edit/{id}',[CustomerController::class,'editPets']);
    Route::post('/saveEditCustomer/{id}',[CustomerController::class, 'saveEditProcess']);
    //All About Pets
    Route::post('/addCustomerPets/{id}', [CustomerController::class, 'saveAddPets']);
    Route::post('/saveEditPets/{id}',[CustomerController::class, 'saveEditPets']);
    Route::get('/deletePets/{id}',[CustomerController::class, 'deletePets']);
    
    Route::get('/discardAddCustomer',[CustomerController::class],'discardAll');
    
    //Customer Update
    // Route::get('/customer/list/update/{id}',[CustomerController::class, 'updateCustomer']);
    // Route::post('/saveUpdateCustomer/{id}',[CustomerController::class, 'saveUpdateCustomer']);
    // //Customer Delete
    // Route::get('/customer/list/delete/{id}',[CustomerController::class, 'deleteCustomer']);
    
    //CustomerDelete
    Route::get('/deleteCustomer',[CustomerController::class,'deleteCustomer']);
    Route::get('/discardCustomer/{id}',[CustomerController::class,'discardCustomer']);
    
    //--SEMUA ROUTING PETS
    Route::post('/addPets/{id}',[PetController::class,'SubAccount']);
    
    
    //-- SEMUA ROUTING PRODUCT --
    //Product
    Route::get('/product', [IndexController::class, 'productDashboard']);
    Route::get('/product/list', [ProductController::class, 'productList']);
    Route::get('/product/brand',[ProductController::class, 'brands']);
    Route::get('/product/category',[ProductController::class, 'categories']);
    Route::get('/product/suppliers',[ProductController::class, 'suppliers']);
    
    //Product Add
    Route::get('/product/list/add', [ProductController::class,'addProduct']);
    Route::post('/addProduct', [ProductController::class, 'storeProduct']);
    //Brand
    // Route::get('/product/list/brand', [ProductController::class,'addBrand']);
    Route::post('/addBrand', [ProductController::class, 'addBrand']);
    Route::get('/deleteBrand',[ProductController::class,'deleteBrand']);
    Route::post('/editBrand/{id}',[ProductController::class,'editBrand']);
    //Product Category
    Route::get('/product/list/category', [ProductController::class,'addCategory']);
    Route::post('/addProductCategory', [ProductController::class, 'addCategoryProduct']);
    Route::get('/deleteCategoryProduct',[ProductController::class,'deleteCategoryProduct']);
    Route::post('/editCategory/{id}',[ProductController::class,'editCategory']);
    //Supplier
    Route::get('/product/list/supplier', [ProductController::class,'addSupplier']);
    Route::post('/addSupplier', [ProductController::class, 'addSupplier']);
    Route::post('/editSupplier/{id}',[ProductController::class,'editSupplier']);
    Route::get('/deleteSupplier',[ProductController::class,'deleteSupplier']);
    
    //Product Modal Delete
    Route::get('/deleteProduct',[ProductController::class,'deleteProduct']);
    
    //Product Edit
    Route::get('/product/edit/{id}',[ProductController::class,'editProduct']);
    Route::post('/saveEditProduct/{id}',[ProductController::class,'saveEditProduct']);
    

    //Attach File
    Route::post('/attachFile', [BookingController::class, 'attachFile']);
    Route::get('/deleteAttach/{id}', [BookingController::class, 'deleteAttach']);
    
    
    //Logout Controller
    Route::get('/logout',[LoginController::class,'logout']);

    //Report
    Route::get('/report/daily', [ReportController::class, 'daily']);
    Route::get('/report/monthly', [ReportController::class, 'monthly']);
    Route::get('/report/byProduct', [ReportController::class, 'byProduct']);
    Route::get('/report/byServices', [ReportController::class, 'byServices']);
    Route::get('/report/byStaff', [ReportController::class, 'byStaff']);
    Route::get('/report/quotation', [ReportController::class, 'quotationReport']);
});



//Login Controller
Route::post('/login-process',[LoginController::class,'authenticate']);
Route::get('/login-page',[LoginController::class,'loginForm'])->name('login')->middleware('guest');



