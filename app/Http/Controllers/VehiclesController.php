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
    public function store(Request $request){
        $vehicles = new Vehicles();
        $vehicles->vh_plate = $request->vh_plate;
        $vehicles->vh_type = $request->vh_type;
        $vehicles->vh_brand = $request->vh_brand;
        $vehicles->vh_year = $request->vh_year;
        $vehicles->vh_fuel_type = $request->vh_fuel_type;
        $vehicles->vh_condition = $request->vh_condition;
        $vehicles->vh_status = $request->vh_status;
        $vehicles->vh_year = $request->vh_year;
        $vehicles->save();
        return response()->json(['success' => 'Vehicle successfully registered']);
    }
    public function delete($vehicle_id){
        $data = Vehicles::findOrFail($vehicle_id);
        $data->delete();
        return response()->json(['success' => 'Vehicle successfully Deleted']);
    }
}
