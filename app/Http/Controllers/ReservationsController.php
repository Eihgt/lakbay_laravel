<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Datatables\ReservationsDataTable;
class ReservationsController extends Controller
{
    public function show(){
        return view('reservations');
    }

}
