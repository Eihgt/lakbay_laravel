<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Datatables\ReservationsDataTable;
class ReservationsController extends Controller
{
    public function index(){
        return view('reservations');
    }
    public function show(ReservationsDataTable $dataTable){
        return $dataTable->render('reservations');
 }
}
