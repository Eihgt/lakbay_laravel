<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DriversController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/index', function () {
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
Route::post('/insertDriver',[DriversController::class,'store']);
Route::get('/drivers', [DriversController::class, 'show'])->name('drivers.show');