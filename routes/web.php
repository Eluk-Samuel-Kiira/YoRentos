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

Route::get('/', function () {
    return view('landing_page.home');
});
   
// Route::get('/all-role',[UserController::class, 'userRoles'])->name('user.roles');






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
    Route::get('/users-index-page',[UserController::class, 'userIndex'])->name('user');    
    Route::get('/users',[UserController::class, 'userDetails'])->name('users.details');

    Route::get('/users-permissions',[UserController::class, 'userPermissions'])->name('user.permissions');
    Route::post('/role', [UserController::class, 'createColesAndPermissions'])->name('create.role');
    Route::post('/role-permission', [UserController::class, 'editRolePermission'])->name('edit.role');
    Route::post('/role-change', [UserController::class, 'changeRole'])->name('change.role');
    Route::get('/change-status/{id}', [UserController::class, 'changeStatus']); 
    Route::get('/delete-role/{role_id}', [UserController::class, 'deleteRole']);

    Route::post('/create-broker', [UserController::class, 'createBroker'])->name('create.broker');
    Route::get('/broker-status/{id}', [UserController::class, 'changeBrokerStatus'])->name('broker_name.status');
    Route::get('/broker-delete/{id}', [UserController::class, 'deleteBroker'])->name('broker_name.delete');


    // Rental Routes
    Route::resource('rental', RentalController::class); 
    Route::get('/rental-status/{id}', [RentalController::class, 'rentalStatus']);    
    Route::get('/delete-rental/{rental_id}', [RentalController::class, 'deleteRental']);


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
    
});
