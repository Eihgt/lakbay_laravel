<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Datatables;

use App\Models\Requestors;


class RequestorsController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(request()->ajax()) {
                        return datatables()->of(Requestors::select('*'))
                        ->addColumn('action', 'requestor.requestor-action')
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
                    }
                    return view('requestor.requestors');
            
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
        $requestorId = $request->id;
        $requestor  = Requestors::updateOrCreate(
            [
                'id' => $requestorId
            ],
            [
                'rq_full_name' => $request->rq_full_name,
                'rq_office' => $request->rq_office,
            ]);
       return Response()->json($requestor);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
        $where = array('id' => $request->id);
        $requestor = Requestors::where($where)->first();

        return Response()->json($requestor);

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
    public function destroy(Request $request)
    {
        //
        $requestor = Requestors::where('id',$request->id)->delete();

        return Response()->json($requestor);

    }
    
}
