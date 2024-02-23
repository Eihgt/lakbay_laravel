<?php

namespace App\Http\Controllers;

use App\Models\Drivers;
use App\Models\Offices;
use App\Models\Events;
use App\Models\Reservations;
use App\Models\Requestors;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\DataTables; 
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor; 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
    public function update(Request $request)
    {    
        $id = $request->hidden_id;
        $reservations = Reservations::findOrFail($id);

        $reservations->event_id = $request->event_edit;
        $reservations->driver_id = $request->driver_edit;
        $reservations->vehicle_id = $request->vehicle_edit;
        $reservations->requestor_id = $request->requestor_edit;
        $reservations->rs_voucher = $request->voucher_edit;
        $reservations->rs_daily_transport = $request->travel_edit;
        $reservations->rs_outside_province = $request->travel_edit;
        $reservations->rs_approval_status = $request->approval_status_edit;
        $reservations->rs_status = $request->status_edit;
        $reservations->save();

        return response()->json(['success' => 'Reservation successfully updated']);
    }
    public function edit($reservation_id)   
    {
        if (request()->ajax()) {
            $data = Reservations::select('reservations.*', 'events.ev_name', 'drivers.dr_name', 'vehicles.vh_brand', 'vehicles.vh_plate', 'requestors.rq_full_name')
                ->join('events', 'reservations.event_id', '=', 'events.event_id')
                ->join('drivers', 'reservations.driver_id', '=', 'drivers.driver_id')
                ->join('vehicles', 'reservations.vehicle_id', '=', 'vehicles.vehicle_id')
                ->join('requestors', 'reservations.requestor_id', '=', 'requestors.requestor_id')
                ->findOrFail($reservation_id);
                
            
            return response()->json(['result' => $data]);
        }
    }
    
    public function reservations_word(Request $request){

        $reservations = DB::table('reservations')
            ->select('reservations.*', 'events.ev_name', 'drivers.dr_name', 'vehicles.vh_brand', 'vehicles.vh_plate', 'requestors.rq_full_name', 'reservations.created_at', 'reservations.rs_approval_status', 'reservations.rs_status')
            ->join('events', 'reservations.event_id', '=', 'events.event_id')
            ->join('drivers', 'reservations.driver_id', '=', 'drivers.driver_id')
            ->join('vehicles', 'reservations.vehicle_id', '=', 'vehicles.vehicle_id')
            ->join('requestors', 'reservations.requestor_id', '=', 'requestors.requestor_id')
            ->get();
    
        $templateProcessor = new TemplateProcessor(public_path().'\\'."Reservations.docx");
    
        $rows = $lenghtMenu->count();
    
        $templateProcessor->cloneRow('reservation_id', $rows);
        foreach($reservations as $index => $reservation){
            $templateProcessor->setValue("reservation_id#".($index+1), $reservation->reservation_id);
            $templateProcessor->setValue("event_id#".($index+1), $reservation->ev_name);
            $templateProcessor->setValue("driver_id#".($index+1), $reservation->dr_name);
            $templateProcessor->setValue("vehicle_id#".($index+1), $reservation->vh_brand .'-'. $reservation->vh_plate);
            $templateProcessor->setValue("requestor_id#".($index+1), $reservation->rq_full_name);
            $templateProcessor->setValue("rs_voucher#".($index+1), $reservation->rs_voucher);
            $templateProcessor->setValue("created_at#".($index+1), $reservation->created_at);
            $templateProcessor->setValue("rs_approval_status#".($index+1), $reservation->rs_approval_status);
            $templateProcessor->setValue("rs_status#".($index+1), $reservation->rs_status);
            $rs_daily_transport = $reservation->rs_daily_transport == 1 ? 'Daily Transport' : 'Outside Province Transport';
            $templateProcessor->setValue("rs_daily_transport#".($index+1), $rs_daily_transport);
        }
    
        $templateProcessor->saveAs(public_path().'\\'."WordDownloads\sample_downloads.docx");
        // return response()->download(public_path().'\\'."WordDownloads\sample_downloads.docx", "ReservationsList.docx")->deleteFileAfterSend(true);
    }

    public function reservations_excel(Request $request)
    {
        $templateFilePath = 'Reservations.xlsx';
        $spreadsheet = new Spreadsheet();
        $rows = Reservations::count();
        $reservations = DB::table('reservations')
            ->select('reservations.*', 'events.ev_name', 'drivers.dr_name', 'vehicles.vh_brand', 'vehicles.vh_plate', 'requestors.rq_full_name', 'reservations.created_at', 'reservations.rs_approval_status', 'reservations.rs_status')
            ->join('events', 'reservations.event_id', '=', 'events.event_id')
            ->join('drivers', 'reservations.driver_id', '=', 'drivers.driver_id')
            ->join('vehicles', 'reservations.vehicle_id', '=', 'vehicles.vehicle_id')
            ->join('requestors', 'reservations.requestor_id', '=', 'requestors.requestor_id')
            ->get();
        $spreadsheet = IOFactory::load($templateFilePath);
        $sheet = $spreadsheet->getActiveSheet();

        for ($i = 0; $i < $rows; $i++) {
            $reservation = $reservations[$i];
            $rowIndex = $i + 2; 
            $rs_daily_transport = $reservation->rs_daily_transport == 1 ? 'Daily Transport' : 'Outside Province Transport';
            $formattedDate = Carbon::parse($reservation->created_at)->format('F j, Y');
            $sheet->setCellValue('A' . $rowIndex, $reservation->reservation_id);
            $sheet->setCellValue('B' . $rowIndex, $reservation->ev_name);
            $sheet->setCellValue('C' . $rowIndex, $reservation->dr_name);
            $sheet->setCellValue('D' . $rowIndex, $reservation->vh_brand);
            $sheet->setCellValue('E' . $rowIndex, $reservation->rq_full_name);
            $sheet->setCellValue('F' . $rowIndex, $reservation->rs_voucher);
            $sheet->setCellValue('G' . $rowIndex, $rs_daily_transport);
            $sheet->setCellValue('H' . $rowIndex, $formattedDate);
            $sheet->setCellValue('I' . $rowIndex, $reservation->rs_approval_status);
            $sheet->setCellValue('J' . $rowIndex, $reservation->rs_status);
        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $fileName = 'Lakbay_Reservations.xlsx';
        $writer->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
    

}
