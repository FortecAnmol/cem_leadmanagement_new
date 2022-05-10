<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Exports\BulkExport;
use App\Imports\BulkImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Source;
use App\Http\Requests\ImportRequest;
use App\Imports\CampaignImport;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\HeadingRowImport;

class ImportExportController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * 
    */
    public function importLeads()
    {
       return view('importexport');
    }
    
    public function import(ImportRequest $request) 
    {

        $validator = Validator::make($request->all(), [
            'source_name' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if ($validator->passes()) {
            $data = array(
                'user_id'=>auth()->user()->id,
                'source_name'=>$request->source_name,
                'description'=>$request->description,
                'start_date'=>date('Y-m-d', strtotime($request->start_date)),
                'end_date'=>date('Y-m-d', strtotime($request->end_date))
            );
            Source::create($data);
            $file = request()->file('file');
        $headings = (new HeadingRowImport())->toArray($file);
        // dd($headings);
        if($headings[0][0][0] != "company_name"){
    return Redirect::back()->with('error', "'company_name' hearder name is incorrect please check your CSV file");
        }
        elseif($headings[0][0][1] != "company_industry")
        {
            return Redirect::back()->with('error', "'company_industry' hearder name is incorrect please check your CSV file");

        }
        elseif($headings[0][0][2] != "prospect_first_name")
        {
            return Redirect::back()->with('error', "'prospect_first_name' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][3] != "prospect_last_name")
        {
            return Redirect::back()->with('error', "'prospect_last_name' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][4] != "designation")
        {
            return Redirect::back()->with('error', "'designation' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][5] != "designation_level")
        {
            return Redirect::back()->with('error', "'designation_level' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][6] != "contact_number_1")
        {
            return Redirect::back()->with('error', "'contact_number_1' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][7] != "contact_number_2")
        {
            return Redirect::back()->with('error', "'contact_number_2' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][8] != "prospect_email")
        {
            return Redirect::back()->with('error', "'prospect_email' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][9] != "linkedin_address")
        {
            return Redirect::back()->with('error', "'linkedin_address' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][10] != "bussiness_function")
        {
            return Redirect::back()->with('error', "'bussiness_function' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][11] != "location")
        {
            return Redirect::back()->with('error', "'location' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][12] != "timezone")
        {
            return Redirect::back()->with('error', "'timezone' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][13] != "date_shared")
        {
            return Redirect::back()->with('error', "'date_shared' hearder name is incorrect please check your CSV file");

        }
        // elseif($headings[0][0][14] != "date_shared")
        // {
        //     return Redirect::back()->with('error', "'date_shared' hearder name is incorrect please check your CSV file");

        // }

        {
            $import = new BulkImport;
            $import->import($file);
            // dd($import->errors());
        }
            // Excel::import(new BulkImport,request()->file('file'));
            // (new BulkImport)->import($file);
        //    Excel::import(new BulkImport,request()->file('file'));

        }
           
        //return back()->with('success', 'Campaign Imported Successfully.');
        return redirect('sources')->with('success', 'Campaign Imported Successfully.');
    }
    public function import_leads(Request $request) 
    {
        $source_id =   $request->source_name;
        //$data = Source::where('id')->first();
        $file = request()->file('file');
        $headings = (new HeadingRowImport())->toArray($file);
        // dd($headings);
        if($headings[0][0][0] != "company_name"){
    return Redirect::back()->with('error', "'company_name' hearder name is incorrect please check your CSV file");
        }
        elseif($headings[0][0][1] != "company_industry")
        {
            return Redirect::back()->with('error', "'company_industry' hearder name is incorrect please check your CSV file");

        }
        elseif($headings[0][0][2] != "prospect_first_name")
        {
            return Redirect::back()->with('error', "'prospect_first_name' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][3] != "prospect_last_name")
        {
            return Redirect::back()->with('error', "'prospect_last_name' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][4] != "designation")
        {
            return Redirect::back()->with('error', "'designation' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][5] != "designation_level")
        {
            return Redirect::back()->with('error', "'designation_level' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][6] != "contact_number_1")
        {
            return Redirect::back()->with('error', "'contact_number_1' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][7] != "contact_number_2")
        {
            return Redirect::back()->with('error', "'contact_number_2' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][8] != "prospect_email")
        {
            return Redirect::back()->with('error', "'prospect_email' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][9] != "linkedin_address")
        {
            return Redirect::back()->with('error', "'linkedin_address' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][10] != "bussiness_function")
        {
            return Redirect::back()->with('error', "'bussiness_function' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][11] != "location")
        {
            return Redirect::back()->with('error', "'location' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][12] != "timezone")
        {
            return Redirect::back()->with('error', "'timezone' hearder name is incorrect please check your CSV file");

        }elseif($headings[0][0][13] != "date_shared")
        {
            return Redirect::back()->with('error', "'date_shared' hearder name is incorrect please check your CSV file");

        }
        // elseif($headings[0][0][14] != "date_shared")
        // {
        //     return Redirect::back()->with('error', "'date_shared' hearder name is incorrect please check your CSV file");

        // }
        Excel::import(new CampaignImport($source_id), $file);

        // {
        //     $import = new CampaignImport;
        //     $import->import($file,$source_id);
        // }
            // Excel::import(new BulkImport,request()->file('file'));
            // (new BulkImport)->import($file);
        //    Excel::import(new BulkImport,request()->file('file'));
           
        //return back()->with('success', 'Campaign Imported Successfully.');
        return redirect('sources')->with('success', 'Campaign Imported Successfully.');
    }
}

