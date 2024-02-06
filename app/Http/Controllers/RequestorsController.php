<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Requestors;


class RequestorsController extends Controller
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
        $req = new Requestors();
        $req->requestor_id=$request->requestor_id;
        $req->rq_full_name = $request->rq_full_name;
        $req->rq_office = $request->rq_office;
        $req->save();

        return redirect('/requestors');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = Requestors::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('requestors');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Requestors $drivers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Requestors $drivers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requestors $drivers)
    {
        //
    }
    
}
