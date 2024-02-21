<?php

namespace App\Http\Controllers;

use App\Models\Drivers;
use App\Models\Offices;
use App\Models\Events;
use App\Models\Reservations;
use App\Models\Requestors;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables; 
use Illuminate\Support\Facades\DB;

class ReservationsController extends Controller
{
    public function show(Request $request){
        if ($request->ajax()) {
            $data = Reservations::select('reservations.*','drivers.dr_name','events.ev_name','vehicles.vh_brand','requestors.rq_full_name')
                ->join('drivers', 'reservations.driver_id', '=', 'drivers.driver_id')
                ->join('events', 'reservations.event_id', '=', 'events.event_id')
                ->join('vehicles', 'reservations.vehicle_id', '=', 'vehicles.vehicle_id')
                ->join('requestors', 'reservations.requestor_id', '=', 'requestors.requestor_id');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('rs_daily_transport', function ($data) {
                    if( $data->rs_daily_transport == 1){
                       return $data->rs_daily_transport = 'Daily Transport';
                    }else{
                        return $data->rs_daily_transport = 'Outside Province Transport';
                    };
                })
                ->addColumn('created_at', function ($data) {
                    return $data->created_at->format('F j, Y');
                })
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" id="'.$data->reservation_id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '<button type="button" name="delete" id="' . $data->reservation_id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $events = DB::table('events')->select('ev_name','event_id')->get();
        $drivers = DB::table('drivers')->select('driver_id','dr_name')->get();
        $vehicles = DB::table('vehicles')->select('vehicle_id','vh_plate','vh_brand')->get();
        $requestors = DB::table('requestors')->select('requestor_id','rq_full_name')->get();  
        // dd($requestors);  
        return view('reservations')->with(compact('events','drivers','vehicles','requestors'));

    }
    public function store(Request $request){
        $reservations = new Reservations();
        $reservations->reservation_id = $request->reservation_id;
        $reservations->rs_voucher = $request->rs_voucher;
        $reservations->rs_daily_transport = $request->rs_daily_transport;
        $reservations->rs_outside_province = $request->rs_outside_province;
        $reservations->rs_date_filed = $request->rs_date_filed;
        $reservations->rs_approval_status = $request->rs_approval_status;
        $reservations->rs_status = $request->rs_status;
        $reservations->event_id = $request->event_id;
        $reservations->driver_id = $request->driver_id;
        $reservations->vehicle_id = $request->vehicle_id;
        $reservations->requestor_id = $request->requestor_id;
        $reservations->save();
        return response()->json(['success' => 'Reservation successfully recorded']);
    }

}
