<?php

namespace App\Http\Controllers;

use App\Models\Drivers;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DriversController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $drivers = new Drivers();
        $drivers->dr_emp_id=$request->dr_emp_id;
        $drivers->dr_name = $request->dr_name ;
        $drivers->dr_office = $request->dr_office;
        $drivers->dr_status = $request->dr_status;
        $drivers->save();

        return response()->json(['success' => 'Driver successfully Stored']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = Drivers::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" id="' . $data->driver_id . '" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '<button type="button" name="delete" id="' . $data->driver_id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('drivers');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($driver_id)
    {
        if (request()->ajax()) {
            $data = Drivers::findOrFail($driver_id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $dr_emp_id = $request->dr_emp_id_modal;
        $dr_name = $request->dr_name_modal;
        $dr_status = $request->dr_status_modal;
        $dr_office=$request->dr_office_modal;
        $id = $request->hidden_id;
        Drivers::where('driver_id', $id)
        ->update([
            'dr_emp_id' => $dr_emp_id,
            'dr_name'=>$dr_name,
            'dr_status'=>$dr_status,
            'dr_office' => $dr_office,
        ]); 
        return response()->json(['success' => 'Driver successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($driver_id){
        $data = Drivers::findOrFail($driver_id);
        $data->delete();
    }
}
