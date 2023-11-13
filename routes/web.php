<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
});
