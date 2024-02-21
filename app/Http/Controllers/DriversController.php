<?php

namespace App\Http\Controllers;

use App\Models\Drivers;
use App\Models\Offices;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use PhpOffice\PhpWord\Shared\XMLWriter; 
use PhpOffice\PhpWord\Shared\ZipArchive;
use PhpOffice\PhpWord\TemplateProcessor;    
use Illuminate\Support\Facades\DB;

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
        $drivers->off_id = $request->dr_office;
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
            $data = Drivers::select('drivers.*', 'offices.off_name')
                ->leftJoin('offices', 'drivers.off_id', '=', 'offices.off_id')
                ->get();
            
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
        $offices = DB::table('offices')->select('off_id','off_acr')->get();
        return view('drivers')->with(compact('offices'));
    }
    
    
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($driver_id)
    {
        if (request()->ajax()) {
            $data = Drivers::select('drivers.*', 'offices.off_name')
                ->leftJoin('offices', 'drivers.off_id', '=', 'offices.off_id')
                ->findOrFail($driver_id);
            return response()->json(['result' => $data]);
        }
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->hidden_id;
        
        $driver = Drivers::findOrFail($id);
        $off_id=$driver->off_id;
        $driver->dr_emp_id = $request->dr_emp_id_modal;
        $driver->dr_name = $request->dr_name_modal;
        $driver->dr_status = $request->dr_status_modal;
        $driver->off_id = $request->dr_office_modal;
        $driver->save();

    
        return response()->json(['success' => 'Driver successfully updated']);
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function delete($driver_id){
        $data = Drivers::findOrFail($driver_id);
        $data->delete();
    }
    public function driver_word(Request $request)
    {
        $rows = Drivers::count();
        $drivers = DB::table('drivers')->select('driver_id','dr_emp_id','dr_name','off_name')->join('offices','drivers.off_id','offices.off_id')->get();
        // dd($drivers);
        $templateProcessor = new TemplateProcessor(public_path().'\\'."Offices.docx");

        $templateProcessor->cloneRow('driver_id', $rows);
        for($i=0;$i<$rows;$i++){
            $driver=$drivers[$i];
            $templateProcessor->setValue("driver_id#".($i+1),$driver->driver_id);
            $templateProcessor->setValue("dr_emp_id#".($i+1),$driver->dr_emp_id);
            $templateProcessor->setValue("dr_name#".($i+1),$driver->dr_name);
            $templateProcessor->setValue("dr_office#".($i+1),$driver->off_name);
        }
        $templateProcessor->saveAs(public_path().'\\'."WordDownloads\sample_downloads.docx");
        // return response()->download(public_path().'\\'."WordDownloads\sample_downloads.docx", "DriverList.docx")->deleteFileAfterSend(true);
    }
    public function driver_excel(Request $request)
    {
        $rows = Drivers::count();
        $drivers = DB::table('drivers')->select('driver_id','dr_emp_id','dr_name','off_name')->join('offices','drivers.off_id','offices.off_id')->get();
        // dd($drivers);
        $templateProcessor = new TemplateProcessor(public_path().'\\'."Drivers.xlsx");
        $templateProcessor->cloneRow('driver_id', $rows);

        for($i=0;$i<$rows;$i++){
            $driver=$drivers[$i];
            $templateProcessor->setValue("driver_id#".($i+1),$driver->driver_id);
            $templateProcessor->setValue("dr_emp_id#".($i+1),$driver->dr_emp_id);
            $templateProcessor->setValue("dr_name#".($i+1),$driver->dr_name);
            $templateProcessor->setValue("dr_office#".($i+1),$driver->off_name);
        }
        
        $templateProcessor->saveAs(public_path().'\\'."ExcelDownloads\sample_downloads.xlsx");
        return response()->download(public_path().'\\'."ExcelDownloads\sample_downloads.xlsx", "DriverList.xlsx")->deleteFileAfterSend(true);  
    }
}
