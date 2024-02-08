<?php

namespace App\Http\Controllers;
use App\Models\Events;
use Illuminate\Http\Request;

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
}
