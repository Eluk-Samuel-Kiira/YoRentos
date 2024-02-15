<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\CountyController;
use App\Http\Controllers\SubcountyController;
use App\Http\Controllers\ParishController;
use App\Http\Controllers\VillageController;
use App\Http\Controllers\EstateController;
use App\Http\Controllers\DurationController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PaymodeController;


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

// Route::get('/', function () {
//     return view('landing_page.home');
// });
Route::get('/',[LandingPageController::class, 'index'])->name('landing.page');
Route::post('/feedback-inquiry', [LandingPageController::class, 'storeFeedback'])->name('store.feedback');
Route::post('/user-district', [LandingPageController::class, 'userDistrict'])->name('user.district');
Route::get('/unit-rental/{slug}', [LocationController::class, 'showEstate'])->name('unit.detail');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');

    // User Routes
    Route::post('/user-location', [UserController::class, 'userLocation'])->name('update.user_location');
    Route::get('/users-index-page', [UserController::class, 'userIndex'])->name('user');
    Route::get('/role-permissions', [UserController::class, 'rolePermissions'])->name('role-permissions');    
    Route::get('/users', [UserController::class, 'userDetails'])->name('users.details');
    Route::get('/account-confirm', [UserController::class, 'userAccount'])->name('account.confirm');
    Route::get('/account-deactivate', [UserController::class, 'userDeactivated'])->name('account-deactivate');

    Route::get('/users-permissions', [UserController::class, 'userPermissions'])->name('user.permissions');
    Route::post('/role', [UserController::class, 'createRolesAndPermissions'])->name('create.role');
    Route::post('/role-permission', [UserController::class, 'editRolePermission'])->name('edit.role');
    Route::post('/role-change', [UserController::class, 'changeRole'])->name('change.role');
    Route::get('/change-status/{id}', [UserController::class, 'changeStatus'])->name('change-status'); 
    Route::get('/delete-role/{role_id}', [UserController::class, 'deleteRole'])->name('delete-role');

    Route::post('/create-broker', [UserController::class, 'createBroker'])->name('create.broker');
    Route::get('/broker-status/{id}', [UserController::class, 'changeBrokerStatus'])->name('broker_name.status');
    Route::get('/broker-delete/{id}', [UserController::class, 'deleteBroker'])->name('broker_name.delete');
    Route::get('/otp-request', [UserController::class, 'otpRequest'])->name('otp.request');
    Route::post('/otp-confirm', [UserController::class, 'otpConfirm'])->name('confirm-otp');
    // Route::get('/my-profile', [UserController::class, 'myProfile'])->name('my-profile');


    // Payment Routes
    Route::resource('payment', PaymodeController::class); 
    Route::post('/pay-delete', [PaymodeController::class, 'deletePay'])->name('payment.delete');
    Route::post('/pay-advert', [PaymodeController::class, 'advertPay'])->name('payment.advert');
    Route::post('/pay-status', [PaymodeController::class, 'payStatus'])->name('pay.status');
    Route::post('/pay-unit', [PaymodeController::class, 'payUnit'])->name('payment.units');
    Route::post('/pay-unit-status', [PaymodeController::class, 'unitPayStatus'])->name('pay.unit-status');

    // income routes
    Route::get('/estate-income', [PaymodeController::class, 'estateIncome'])->name('income.index');    
    Route::get('/status-income/{id}', [PaymodeController::class, 'advertStatus'])->name('advert.status');    
    Route::get('/advert-destroy/{id}', [PaymodeController::class, 'advertDestroy'])->name('advert.destroy');    
    Route::get('/status-unitpay/{id}', [PaymodeController::class, 'unitSubStatus'])->name('unitpay.status');    
    Route::get('/unitpay-destroy/{id}', [PaymodeController::class, 'unitpayDestroy'])->name('unitpay.destroy');    

    // Rental Routes
    Route::resource('rental', RentalController::class); 
    Route::get('/rental-status/{id}', [RentalController::class, 'rentalStatus'])->name('rental.status');    
    Route::get('/delete-rental/{rental_id}', [RentalController::class, 'deleteRental']);

    //Estates
    Route::resource('estate', EstateController::class); 
    Route::get('/estate-status/{id}', [EstateController::class, 'changeEstateStatus'])->name('estate.status');
    Route::post('/update-video', [EstateController::class, 'videoUpdate'])->name('estate.video');
    Route::post('/update-images', [EstateController::class, 'imageUpload'])->name('estate.images');
    Route::post('/delete-image', [EstateController::class, 'deleteImage'])->name('image.delete');
    Route::post('/estate-location', [EstateController::class, 'estateLocation'])->name('estate.location');
    Route::post('/estate-description', [EstateController::class, 'estateDescription'])->name('estate.description');
    Route::post('/estate-terms', [EstateController::class, 'estateTerms'])->name('estate.terms');

    
    //Unit routes
    Route::resource('unit', UnitController::class); 
    Route::post('/update-tenant', [UnitController::class, 'updateTenant'])->name('update.tenant');
    Route::get('/unit-status/{slug}', [UnitController::class, 'changeUnitStatus'])->name('unit.status');
    Route::get('/terms-accept/{slug}', [UnitController::class, 'termsConditions'])->name('unit.accept');
    Route::get('/terms-conditions/{slug}', [UnitController::class, 'readTerms'])->name('confirm.terms');


    //Duration
    Route::resource('duration', DurationController::class); 
    Route::get('/duration-status/{id}', [DurationController::class, 'changeDurationStatus'])->name('duration.status');

    //Resources routes
    Route::resource('resource', ResourceController::class);
    Route::get('/resource-status/{id}', [ResourceController::class, 'changeResourceStatus'])->name('resource.status');


    //Location Routes
    Route::resource('country', CountryController::class);
    Route::get('/country-status/{id}', [CountryController::class, 'changeCountryStatus'])->name('country.status');   

    Route::resource('district', DistrictController::class);
    Route::get('/district-status/{slug}', [DistrictController::class, 'changeDistrictStatus'])->name('district.status');   

    Route::resource('county', CountyController::class);
    Route::get('/county-status/{slug}', [CountyController::class, 'changeCountyStatus'])->name('county.status'); 
    
    Route::resource('subcounty', SubcountyController::class);
    Route::get('/subcounty-status/{slug}', [SubcountyController::class, 'changeSubcountyStatus'])->name('subcounty.status');
    
    Route::resource('parish', ParishController::class);
    Route::get('/parish-status/{slug}', [ParishController::class, 'changeParishStatus'])->name('parish.status');

    Route::resource('village', VillageController::class);
    Route::get('/village-status/{slug}', [VillageController::class, 'changevillageStatus'])->name('village.status');


    // Tenant Dashboard
    Route::get('/tenant/dashboard',[LocationController::class, 'tenantIndex'])->name('tenant.dashboard');
    // Route::get('/unit-rental/{slug}', [LocationController::class, 'showEstate'])->name('unit.detail');
    Route::get('/rental-type/{slug}', [LocationController::class, 'showRental'])->name('rental.type');
    Route::get('/rental-map-location/{slug}', [LocationController::class, 'locationRental'])->name('rental.map');
    Route::get('/my-room-units', [LocationController::class, 'myUnit'])->name('my.unit');


    // Feedback
    Route::get('/feedback-from-users',[LandingPageController::class, 'indexFeedback'])->name('feedback.index');
    Route::get('/feedback-delete/{id}',[LandingPageController::class, 'deleteFeedback'])->name('destroy.feedback');


    // Dashboard Element Chart
    Route::get('/charts-pie-rentals',[RentalController::class, 'rentalCharts'])->name('pie.rentals');
    Route::get('/charts-bar-estates',[DistrictController::class, 'districtEstate'])->name('bar.estates');

});
