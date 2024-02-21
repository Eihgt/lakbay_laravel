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
    // public function fetch(){
    //     $data = Offices::onlyTrashed()->get();
    //     foreach($data as $data){
    //         echo $data->off_name;
    //     }
    // }
    public function store(Request $request)
    { 
        $offices  = new Offices();

        $acr = $request->off_acr;
        $name = $request->off_name;
        $head = $request->off_head;

        $offices->off_acr =$acr;
        $offices->off_name = $name;
        $offices->off_head = $head;

        $offices->save();
        return response()->json(['success' => 'Office successfully stored']);
        
    }
    public function delete($off_id){
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
    public function restore($id) 
    {
        Offices::where('off_id', $id)->withTrashed()->restore();

        return redirect()->route('offices.show', ['status' => 'archived'])
            ->withSuccess(__('Record restored successfully.'));
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
    public function offices_word(Request $request){

        $rows = Offices::count();
        $offices = DB::table('offices')->select('off_id','off_acr','off_name','off_head')->get();
        // dd($offices);
        $templateProcessor = new TemplateProcessor(public_path().'\\'."Offices.docx");

        $templateProcessor->cloneRow('off_id', $rows);
        for($i=0;$i<$rows;$i++){
            $office=$offices[$i];
            $templateProcessor->setValue("off_id#".($i+1),$office->off_id);
            $templateProcessor->setValue("off_acr#".($i+1),$office->off_acr);
            $templateProcessor->setValue("off_name#".($i+1),$office->off_name);
            $templateProcessor->setValue("off_head#".($i+1),$office->off_head);
        }
        $templateProcessor->saveAs(public_path().'\\'."WordDownloads\sample_downloads.docx");
        return response()->download(public_path().'\\'."WordDownloads\sample_downloads.docx", "OfficesList.docx")->deleteFileAfterSend(true);
    }
    

}
