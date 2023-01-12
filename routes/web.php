<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware('auth')->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // profile route start here
    Route::get('profile', [HomeController::class, 'profile'])->name(('profile'));
    Route::put('profile/update', [HomeController::class, 'profileUpdate'])->name(('profile.update'));
    // profile route end

    Route::get('password/change', [HomeController::class, 'passwordChangeForm'])->name(('password.change'));
    Route::put('password/change', [HomeController::class, 'passwordUpdate'])->name(('password.change'));
    
    // company route start here
    Route::resource('company',CompanyController::class);

    // employe route start here
    Route::resource('employee',EmployeeController::class);
});

