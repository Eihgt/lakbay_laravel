<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\OfficesController;
use App\Http\Controllers\RequestorsController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('index');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/reservations', function () {
    return view('reservations');
});
Route::get('/events', function () {
    return view('events');
});
Route::get('/vehicles', function () {
    return view('vehicles');
});
Route::get('/requestors', function () {
    return view('requestors');
});


Route::post('/insertRequestors',[RequestorsController::class,'store']);
Route::get('/requestors', [RequestorsController::class, 'show'])->name('requestors.show');

Route::post('/insertDriver',[DriversController::class,'store']);
Route::get('/drivers', [DriversController::class, 'show'])->name('drivers.show');

Route::get('/offices', [OfficesController::class, 'show'])->name('offices.show');
Route::get('/delete-office/{off_id}', [OfficesController::class, 'destroy']);
Route::get('/edit-office/{off_id}', [OfficesController::class, 'edit']);
Route::post('/update-office', [OfficesController::class, 'update']);