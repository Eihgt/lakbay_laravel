<?php

namespace App\Http\Controllers;
use App\Models\Events;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EventsController extends Controller
{
    public function store(Request $request){
        $events = new Events();
        
        $ev_name = $request->ev_name;
        $ev_venue = $request->ev_venue;
        $ev_date_start = $request->ev_date_start;
        $ev_time_start = $request->ev_time_start;
        $ev_date_end =$request->ev_date_end;
        $ev_time_end =$request->ev_time_end;
        $ev_date_added =$request->ev_date_added;

            $events->ev_name=$ev_name;
            $events->ev_venue=$ev_venue;
            $events->ev_date_start=$ev_date_start;
            $events->ev_time_start=$ev_time_start;
            $events->ev_date_end=$ev_date_end;
            $events->ev_time_end=$ev_time_end;
            $events->ev_date_added=$ev_date_added;

        $events->save();
        return response()->json(['success' => 'Data is successfully updated']);
    }
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = Events::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" id="'.$data->event_id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '<button type="button" name="delete" id="' . $data->event_id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('events');
}
public function edit($event_id)
{
    if (request()->ajax()) {
        $data = Events::findOrFail($event_id);
        return response()->json(['result' => $data]);
    }
}
public function update(Request $request)
{ 
    $ev_name = $request->ev_name_modal;
    $ev_venue = $request->ev_venue_modal;
    $ev_date_start = $request->ev_date_start_modal;
    $ev_time_start=$request->ev_time_start_modal;
    $ev_date_end=$request->ev_date_end_modal;
    $ev_time_end=$request->ev_time_end_modal;
    $id = $request->hidden_id;
    Events::where('event_id', $id)
    ->update([
        'ev_name' => $ev_name,
        'ev_venue'=>$ev_venue,
        'ev_date_start'=>$ev_date_start,
        'ev_time_start' => $ev_time_start,
        'ev_date_end'=>$ev_date_end,
        'ev_time_end'=>$ev_time_end,
    ]); 
    return response()->json(['success' => 'Data is successfully updated']);
    
}
}
