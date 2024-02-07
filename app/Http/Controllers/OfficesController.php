<?php

namespace App\Http\Controllers;

use App\Models\Drivers;
use App\Models\Offices;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OfficesController extends Controller
{
    public function show(Request $request){
        if ($request->ajax()) {
            $data = Offices::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $button= '<button type="button" name="edit" id="' . $data->off_id . '" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button.= '<button type="button" name="delete" id="' . $data->off_id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('offices');

    }

    public function destroy($off_id)
    {
            $data = Offices::findOrFail($off_id);
            $data->delete();
        
    }
    public function edit($off_id)
    {
        if (request()->ajax()) {
            $data = Offices::findOrFail($off_id);
            return response()->json(['result' => $data]);
        }
    }
    public function update(Request $request)
    { 
        $acr = $request->off_acr;
        $name = $request->off_name;
        $head = $request->off_head;
        $id = $request->hidden_id;
        Offices::where('off_id', $id)
        ->update([
            'off_acr' => $acr,
            'off_name'=>$name,
            'off_head'=>$head,
        ]); 
        return response()->json(['success' => 'Data is successfully updated']);
        
    }

}
