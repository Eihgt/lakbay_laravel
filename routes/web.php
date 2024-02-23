<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\OfficesController;
use App\Http\Controllers\RequestorsController;
use App\Http\Controllers\VehiclesController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataTableAjaxCRUDController;


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


Route::get('/test', function () {
    return view('test_word');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});


Route::get('/',[Controller::class,'redirect']);

//Requestors
Route::get('requestors', [RequestorsController::class, 'index']);
Route::post('store-requestor', [RequestorsController::class, 'store']);
Route::post('edit-requestor', [RequestorsController::class, 'edit']);
Route::post('delete-requestor', [RequestorsController::class, 'destroy']);
//End-Requestor
//Driver Section
Route::post('/insert-driver',[DriversController::class,'store']);
Route::get('/drivers', [DriversController::class, 'show'])->name('drivers.show');
Route::get('/delete-driver/{driver_id}', [DriversController::class, 'delete']);
Route::get('/edit-driver/{driver_id}', [DriversController::class, 'edit']);
Route::post('/update-driver', [DriversController::class, 'update']);
Route::get('/driver-word', [DriversController::class, 'driver_word']);
Route::get('/driver-excel', [DriversController::class, 'driver_excel']);
//End
//Vehicles Section
// Route::post('/insert-driver',[DriversController::class,'store']);
Route::get('/vehicles', [VehiclesController::class, 'show'])->name('vehicles.show');
// Route::get('/delete-driver/{driver_id}', [DriversController::class, 'delete']);
// Route::get('/edit-driver/{driver_id}', [DriversController::class, 'edit']);
// Route::post('/update-driver', [DriversController::class, 'update']);
// Route::get('/driver-word', [DriversController::class, 'driver_word']);
// Route::get('/driver-excel', [DriversController::class, 'driver_excel']);
//End
//Event Section
Route::post('/insert-event', [EventsController::class, 'store']);
Route::get('/events',[EventsController::class,'show'])->name('events.show');
Route::get('/edit-event/{event_id}', [EventsController::class, 'edit']);
Route::post('/update-event', [EventsController::class, 'update']);
Route::get('/delete-event/{event_id}', [EventsController::class, 'delete']);
Route::get('/events-word', [OfficesController::class, 'events_word']);
//End
//Offices Section
Route::get('/offices', [OfficesController::class, 'show'])->name('offices.show');
Route::post('/insert-office', [OfficesController::class, 'store']);
Route::get('/delete-office/{off_id}', [OfficesController::class, 'delete']);
Route::get('/edit-office/{off_id}', [OfficesController::class, 'edit']);
Route::post('/update-office', [OfficesController::class, 'update']);
Route::get('/offices-word', [OfficesController::class, 'offices_word']);
//End
//Reservation Section
Route::get('/reservations', [ReservationsController::class,'show'])->name('reservations.show');
Route::get('/reservations-word', [ReservationsController::class, 'reservations_word']);
Route::get('/reservations-excel', [ReservationsController::class, 'reservations_excel']);
Route::post('/insert-reservation', [ReservationsController::class, 'store']);
Route::post('/update-reservation', [ReservationsController::class, 'update']);
Route::get('/edit-reservation/{reservation_id}', [ReservationsController::class, 'edit']);
Route::get('/delete-reservation/{reservation_id}', [ReservationsController::class, 'delete']);
//End

//Test Section
Route::get('/driver-word', [DriversController::class, 'driver_word']);