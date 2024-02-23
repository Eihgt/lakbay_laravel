<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drivers;
use App\Models\Offices;
use App\Models\Events;
use App\Models\Vehicles;
use App\Models\Reservations;
use App\Models\Requestors;
use Yajra\DataTables\DataTables; 
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor; 

class VehiclesController extends Controller
{
    public function show(Request $request){
        if ($request->ajax()) {
            $data = Vehicles::select('vehicles.*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" id="'.$data->vehicle_id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '<button type="button" name="delete" id="' . $data->vehicle_id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        } 
        
        return view('vehicles');
    }
}
