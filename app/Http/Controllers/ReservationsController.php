<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Drivers;
use App\Models\Offices;
use App\Models\Events;
use App\Models\Vehicles;
use App\Models\Reservations;
use App\Models\ReservationVehicle;
use App\Models\Requestors;
use Yajra\DataTables\DataTables; 
use PhpOffice\PhpWord\TemplateProcessor; 
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Reader\Word2007;
use Carbon\Carbon;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReservationsController extends Controller
{
    public function show(Request $request){

        // $data = Reservations::with("reservation_vehicles","reservation_vehicles.vehicles")->get();
        // dd($data[0]);
        

        if ($request->ajax()) {
            $data = Reservations::with("reservation_vehicles","reservation_vehicles.vehicles","reservation_vehicles.drivers")->select('reservations.*','events.ev_name','requestors.rq_full_name')
                ->join('events', 'reservations.event_id', '=', 'events.event_id')
                ->join('requestors', 'reservations.requestor_id', '=', 'requestors.requestor_id');
            return Datatables::of($data)
                ->addIndexColumn()
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
        $drivers = DB::table('drivers')->select('driver_id','dr_fname')->get();
        $vehicles = DB::table('vehicles')->select('vehicle_id','vh_plate','vh_brand','vh_capacity')->get();
        $requestors = DB::table('requestors')->select('requestor_id','rq_full_name')->get();  
        // dd($requestors);  
        return view('reservations')->with(compact('events','drivers','vehicles','requestors'));

    }
    public function store(Request $request){
        $reservations = new Reservations();
        $reservation_vh = new ReservationVehicle();
        
        $validation = $request->validate([
            "rs_voucher"=>"required",
            "rs_travel_type"=>"required",
            "rs_approval_status"=>"required",
            "rs_status"=>"required",
            "event_id"=>"required",
            "driver_id"=>"required",
            "vehicle_id"=>"required",
            "requestor_id"=>"required",
            "rs_passengers"=>"required",
        ],
        [
            "required"=>"This field is required",
        ]);

        $reservations->rs_voucher = $request->rs_voucher;
        $reservations->rs_travel_type = $request->rs_travel_type;
        $reservations->rs_approval_status = $request->rs_approval_status;
        $reservations->rs_status = $request->rs_status;
        $reservations->event_id = $request->event_id;
        $reservations->requestor_id = $request->requestor_id;
        $reservations->rs_passengers = $request->rs_passengers;
        $reservations->save();
        
        
        $vehicle_ids = $request->vehicle_id;
        $driver_ids = $request->driver_id;
        $count = count($vehicle_ids);
        
        for ($i = 0; $i < $count; $i++) {
            $reservation_vh = new ReservationVehicle();
            $reservation_vh->reservation_id = $reservations->reservation_id;
            $reservation_vh->vehicle_id = $vehicle_ids[$i]; 
            
            // Check if driver_id is set before assigning
            if (isset($driver_ids[$i])) {
                $reservation_vh->driver_id = $driver_ids[$i];
            }
            
            $reservation_vh->save();
        }
        

            


        
        return response()->json(['success' => 'Reservation successfully recorded']);
    }

    
    public function update(Request $request)
    {    
        $id = $request->hidden_id;
        // dd($id);
        $reservations = Reservations::findOrFail($id);
        dd($reservations);
        // $reservations->event_id = $request->event_edit;
        // $reservations->requestor_id = $request->requestor_edit;
        // $reservations->rs_voucher = $request->voucher_edit;
        // $reservations->rs_travel_type = $request->travel_edit;
        // $reservations->rs_approval_status = $request->approval_status_edit;
        // $reservations->rs_status = $request->status_edit;
        // $reservations->save();

        // $vehicle_ids = $request->vehicle_id;
        // $driver_ids = $request->driver_id;
        // $count = count($vehicle_ids);
        
        // for ($i = 0; $i < $count; $i++){
        //     $reservation_vh->reservation_id = $reservations->reservation_id;
        //     $reservation_vh->vehicle_id = $vehicle_ids[$i]; 
        //     // Check if driver_id is set before assigning
        //     if (isset($driver_ids[$i])) {
        //         $reservation_vh->driver_id = $driver_ids[$i];
        //     }
            
        //     $reservation_vh->save();
        // }



        // return response()->json(['success' => 'Reservation successfully updated']);
    }
    public function edit($reservation_id)   
    {   
        if (request()->ajax()) {
            $data = Reservations::with("reservation_vehicles","reservation_vehicles.vehicles","reservation_vehicles.drivers")->select('reservations.*', 'events.ev_name', 'requestors.rq_full_name')
                ->join('events', 'reservations.event_id', '=', 'events.event_id')
                ->join('requestors', 'reservations.requestor_id', '=', 'requestors.requestor_id')
                ->findOrFail($reservation_id);
                
            
            return response()->json(['result' => $data]);
        }

    }
    public function delete($reservation_id){
        $data = Reservations::findOrFail($reservation_id);
        $data->delete();
        return response()->json(['success' => 'Vehicle successfully Deleted']);
    }
    
    public function reservations_word(Request $request){

        $reservations = DB::table('reservations')
            ->select('reservations.*', 'events.ev_name', 'drivers.dr_fname', 'vehicles.vh_brand', 'vehicles.vh_plate', 'requestors.rq_full_name', 'reservations.created_at', 'reservations.rs_approval_status', 'reservations.rs_status')
            ->join('events', 'reservations.event_id', '=', 'events.event_id')
            ->join('drivers', 'reservations.driver_id', '=', 'drivers.driver_id')
            ->join('vehicles', 'reservations.vehicle_id', '=', 'vehicles.vehicle_id')
            ->join('requestors', 'reservations.requestor_id', '=', 'requestors.requestor_id');
            
            if ($request->has('search')) {
                $searchValue = $request->input('search');
                $reservations->where(function ($query) use ($searchValue) {
                    $query->where('ev_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('dr_fname', 'like', '%' . $searchValue . '%')
                        ->orWhere('vh_brand', 'like', '%' . $searchValue . '%')
                        ->orWhere('rq_full_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('rs_voucher', 'like', '%' . $searchValue . '%')
                        ->orWhere('rs_approval_status', 'like', '%' . $searchValue . '%')
                        ->orWhere('rs_status', 'like', '%' . $searchValue . '%')
                        ->orWhere('rs_travel_type', 'like', '%' . $searchValue . '%');
                });
            }
            $filteredReservations = $reservations->get();
            $rows = $filteredReservations->count();

            $templateProcessor = new TemplateProcessor(public_path().'\\'."Reservations.docx");
    
        $templateProcessor->cloneRow('reservation_id', $rows);

        for($i=0;$i<$rows;$i++){
            $reservation=$filteredReservations[$i];
            $formattedDate = Carbon::parse($reservation->created_at)->format('F j, Y');
            $templateProcessor->setValue("reservation_id#".($i+1), $reservation->reservation_id);
            $templateProcessor->setValue("event_id#".($i+1), $reservation->ev_name);
            $templateProcessor->setValue("driver_id#".($i+1), $reservation->dr_fname);
            $templateProcessor->setValue("vehicle_id#".($i+1), $reservation->vh_brand);
            $templateProcessor->setValue("requestor_id#".($i+1),  $reservation->rq_full_name);
            $templateProcessor->setValue("rs_voucher#".($i+1), $reservation->rs_voucher);
            $templateProcessor->setValue("rs_travel_type#".($i+1), $reservation->rs_travel_type);
            $templateProcessor->setValue("created_at#".($i+1), $formattedDate);
            $templateProcessor->setValue("rs_approval_status#".($i+1), $reservation->rs_approval_status);
            $templateProcessor->setValue("rs_status#".($i+1), $reservation->rs_status);
        }
    
        $templateProcessor->saveAs(public_path().'\\'."WordDownloads\sample_downloads.docx");
        return response()->download(public_path().'\\'."WordDownloads\sample_downloads.docx", "ReservationsList.docx")->deleteFileAfterSend(true);
    }

    public function reservations_excel(Request $request)
    {
        $templateFilePath = 'Reservations.xlsx';
        $spreadsheet = new Spreadsheet();
        
        // Retrieve filtered reservations based on the search value
        $filteredReservationsQuery = DB::table('reservations')
            ->select('reservations.*', 'events.ev_name', 'drivers.dr_fname', 'vehicles.vh_brand', 'vehicles.vh_plate', 'requestors.rq_full_name')
            ->join('events', 'reservations.event_id', '=', 'events.event_id')
            ->join('drivers', 'reservations.driver_id', '=', 'drivers.driver_id')
            ->join('vehicles', 'reservations.vehicle_id', '=', 'vehicles.vehicle_id')
            ->join('requestors', 'reservations.requestor_id', '=', 'requestors.requestor_id');
    
        // Apply search filter if a search value is provided
        if ($request->has('search')) {
            $searchValue = $request->input('search');
            $filteredReservationsQuery->where(function ($query) use ($searchValue) {
                $query->where('ev_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('dr_fname', 'like', '%' . $searchValue . '%')
                    ->orWhere('vh_brand', 'like', '%' . $searchValue . '%')
                    ->orWhere('rq_full_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('rs_voucher', 'like', '%' . $searchValue . '%')
                    ->orWhere('rs_approval_status', 'like', '%' . $searchValue . '%')
                    ->orWhere('rs_status', 'like', '%' . $searchValue . '%')
                    ->orWhere('rs_travel_type', 'like', '%' . $searchValue . '%');
            });
        }
    
        // Execute the query to get filtered reservations
        $filteredReservations = $filteredReservationsQuery->get();
        // dd($filteredReservations);
        $spreadsheet = IOFactory::load($templateFilePath);
        $sheet = $spreadsheet->getActiveSheet();
    
        // Populate spreadsheet with filtered reservation data
        foreach ($filteredReservations as $index => $reservation) {
            $rowIndex = $index + 2; 
            $formattedDate = Carbon::parse($reservation->created_at)->format('F j, Y');
            $sheet->setCellValue('A' . $rowIndex, $reservation->reservation_id);
            $sheet->setCellValue('B' . $rowIndex, $reservation->ev_name);
            $sheet->setCellValue('C' . $rowIndex, $reservation->dr_fname);
            $sheet->setCellValue('D' . $rowIndex, $reservation->vh_brand);
            $sheet->setCellValue('E' . $rowIndex, $reservation->rq_full_name);
            $sheet->setCellValue('F' . $rowIndex, $reservation->rs_voucher);
            $sheet->setCellValue('G' . $rowIndex, $reservation->rs_travel_type);
            $sheet->setCellValue('H' . $rowIndex, $formattedDate);
            $sheet->setCellValue('I' . $rowIndex, $reservation->rs_approval_status);
            $sheet->setCellValue('J' . $rowIndex, $reservation->rs_status);
        }
    
        // Save and download the spreadsheet
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $fileName = 'Lakbay_Reservations.xlsx';
        $writer->save($fileName);
    
        return response()->download($fileName)->deleteFileAfterSend(true);
    }
    public function reservations_pdf(Request $request)
    {
        $filteredReservationsQuery = DB::table('reservations')
            ->select('reservations.*', 'events.ev_name', 'drivers.dr_fname', 'vehicles.vh_brand', 'vehicles.vh_plate', 'requestors.rq_full_name', 'reservations.created_at', 'reservations.rs_approval_status', 'reservations.rs_status')
            ->join('events', 'reservations.event_id', '=', 'events.event_id')
            ->join('drivers', 'reservations.driver_id', '=', 'drivers.driver_id')
            ->join('vehicles', 'reservations.vehicle_id', '=', 'vehicles.vehicle_id')
            ->join('requestors', 'reservations.requestor_id', '=', 'requestors.requestor_id');
    
        if ($request->has('search')) {
            $searchValue = $request->input('search');
            $filteredReservationsQuery->where(function ($query) use ($searchValue) {
                $query->where('ev_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('dr_fname', 'like', '%' . $searchValue . '%')
                    ->orWhere('vh_brand', 'like', '%' . $searchValue . '%')
                    ->orWhere('rq_full_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('rs_voucher', 'like', '%' . $searchValue . '%')
                    ->orWhere('rs_approval_status', 'like', '%' . $searchValue . '%')
                    ->orWhere('rs_status', 'like', '%' . $searchValue . '%')
                    ->orWhere('rs_travel_type', 'like', '%' . $searchValue . '%');
            });
        }

        $filteredReservations = $filteredReservationsQuery->get();
        $phpWord = new PhpWord();
    
        // Load the template
        $templateProcessor = new TemplateProcessor(public_path('Reservations.docx'));
    
        $rows = $filteredReservations->count();
    
        $templateProcessor->cloneRow('reservation_id', $rows);
        foreach ($filteredReservations as $index => $reservation) {
            $templateProcessor->setValue("reservation_id#" . ($index + 1), $reservation->reservation_id);
            $templateProcessor->setValue("event_id#" . ($index + 1), $reservation->ev_name);
            $templateProcessor->setValue("driver_id#" . ($index + 1), $reservation->dr_fname);
            $templateProcessor->setValue("vehicle_id#" . ($index + 1), $reservation->vh_brand . '-' . $reservation->vh_plate);
            $templateProcessor->setValue("requestor_id#" . ($index + 1), $reservation->rq_full_name);
            $templateProcessor->setValue("rs_voucher#" . ($index + 1), $reservation->rs_voucher);
            $templateProcessor->setValue("rs_travel_type#" . ($index + 1), $reservation->rs_travel_type);
            $templateProcessor->setValue("created_at#" . ($index + 1), $reservation->created_at);
            $templateProcessor->setValue("rs_approval_status#" . ($index + 1), $reservation->rs_approval_status);
            $templateProcessor->setValue("rs_status#" . ($index + 1), $reservation->rs_status);
        }
    
        $wordFilePath = public_path().'\\'."WordDownloads\\reservations_list.docx";
        $pdfFilePath = public_path().'\\'."PdfDownloads\\reservations_list.pdf";
    
        $templateProcessor->saveAs($wordFilePath);

         // Load Word document
         $phpWord = \PhpOffice\PhpWord\IOFactory::load($wordFilePath); 
           
       // Set up Dompdf renderer
       Settings::setPdfRendererPath(base_path('vendor/dompdf/dompdf'));
       Settings::setPdfRendererName('DomPDF');
    
        // Save PDF file
        $pdfWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');
        $pdfWriter->save($pdfFilePath);
     
        // Delete the Word file
        unlink($wordFilePath);

        // Return response for PDF download
         return response()->download($pdfFilePath, "ReservationsList.pdf")->deleteFileAfterSend(true);
    }
    public function reservations_archive(){
        
    }
}
    

