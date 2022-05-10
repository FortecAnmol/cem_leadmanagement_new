<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Source;
use App\Models\User;
use App\Models\Note;
use App\Http\Requests\LeadRequest;
use App\Http\Requests\SearchLeadRequest;
use App\Http\Requests\AssignLeadRequest;
use App\Http\Requests\AssignLeadEmployeeRequest;
use App\Models\LhsReport;
use App\Models\Relation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Mockery\Matcher\Not;
use App\Http\Controllers\URL;
use DataTables;
class LeadsController extends Controller
{
    
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if(request()->get('status')){
            $status =  $_GET['status']; 
        }else{
            $status =  "";
        }
        // if($status)
        // {
        //     $data = Lead::where(['status'=>$status])->with('source')->with('feedback')->get()->toArray();
        // }
        $admin = User::where(['is_admin'=>Null,'id'=>auth()->user()->id])->first();
        if(!empty($admin)){
            if (!isset($_GET['status'])) {
            $data = Lead::with('source')->with('feedback')->get()->toArray();  
                // $data = Lead::where(['user_id'=>auth()->user()->id])->with('source')->with('feedback')->get()->toArray();
           } else{
            $data = Lead::where(['status'=>$_GET['status']])->with('source')->with('feedback')->get()->toArray();
           }
           $sources = Source::get()->toArray();
        }else{
            if (!isset($_GET['status'])) {
            // $data = Lead::Where(['asign_to_manager'=>auth()->user()->id])->with('source')->with('feedback')->paginate(100);
            if ($request->ajax()) {
                $url = env('APP_URL', 'default_value');
                $data = Lead::Where(['asign_to_manager'=>auth()->user()->id])->with('source')->with('feedback');
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('campaign_name', function($data){
                            $source_data =    DB::table('sources')->where('id',$data['source_id'] )->first();
                            $campaign_name = $source_data->source_name;
                            $btn = $campaign_name;
        
                             return $btn;
                     })
                     ->addColumn('description', function($data){
                        $source_data =    DB::table('sources')->where('id',$data['source_id'] )->first();
                        $campaign_name = $source_data->source_name;
                        $btn = $campaign_name;
    
                         return $btn;
                 })
                        ->addColumn('action', function($data) use ($url) {

                           $return = '<a onclick="document.getElementById("lead_id").value='.$data['id'].'" class="notes_id" baseUrl="'.$data['id'].'" id="view-note" name="view-note"   data-toggle="modal" data-target="#largeModal">
                           <span class="label" data-toggle="tooltip" data-placement="top" title="View All Notes" style="color:#000;font-size: 15px;"><i class="fa fa-list" aria-hidden="true"></i></span></a></span>
                       </a>
                       <a href="'.$url.'/leads/'.$data['id'].'"><span class="label" data-toggle="tooltip" data-placement="top" title="View" style="color:#000;font-size: 15px;"><i class="fa fa-eye" aria-hidden="true"></i></span></a></span></a>   
                      <a href="'.$url.'/leads/'.$data['id'].'/edit")"><span class="label" data-toggle="tooltip" data-placement="top" title="Edit" style="color:#000;font-size: 15px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>
                      <a href="'.$url.'/leads/delete/'.$data['id'].'"  ><span class="label" data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;font-size: 15px;" onclick="return confirm("Are you sure you want to delete this lead ?")"><i class="fa fa-trash" aria-hidden="true"></i></span></a>';

                                return $return;
                        })
                        ->rawColumns(['action','campaign_name'])
                        ->make(true);
            }
           } else{
            $data = Lead::where(['asign_to_manager'=>auth()->user()->id,'status'=>$_GET['status']])->with('source')->with('feedback')->get()->toArray();
           }
           $sources = Source::where(['user_id'=>auth()->user()->id])->orWhere(['assign_to_manager'=>auth()->user()->id ])->get()->toArray();
        }
         $source_ids ="";
         return view('leads.list')->with(['sources'=>$sources,'source_ids'=>$source_ids]);
    }

  
    public function create()
    {
        if(Auth::user()->is_admin == null){
        $sources = Source::get()->toArray();
        }else
        {
            $sources = Source::where(['assign_to_manager'=>auth()->user()->id])->get()->toArray();
        }
        return view('leads.add')->with(['sources'=>$sources]);
    }


    public function store(Request $request)
    {
        $assign   =  Source::where('id',$request->source_id)->first();
        $data = array(
            'user_id'=>auth()->user()->id,
            'source_id'=>$request->source_id,
            'company_name'=>$request->company_name,
            'prospect_first_name'=>$request->prospect_first_name,
            'prospect_last_name'=>$request->prospect_last_name,
            'company_industry'=>$request->company_industry,
            'designation'=>$request->designation,
            'designation_level'=>$request->designation_level,
            'contact_number_1'=>$request->contact_number_1,
            'contact_number_2'=>$request->contact_number_2,
            'prospect_email'=>$request->prospect_email,
            'linkedin_address'=>$request->linkedin_address,
            'bussiness_function'=>$request->bussiness_function,
            'location'=>$request->location,
            'timezone'=>$request->timezone,
            'asign_to_manager'=>$assign['assign_to_manager'],
            'date_shared'=>$request->date_shared,
            /*'job_title'=>$request->job_title,*/
            /*'web_address'=>$request->web_address,
            'physical_address'=>$request->physical_address,
            'city'=>$request->city,
            'state'=>$request->state,
            'zip_code'=>$request->zip_code,
            'country'=>$request->country,
            'linkedin_address'=>$request->linkedin_address,
            'lead_name'=>$request->job_title,*/
              
        );
        
        lead::create($data);
        
        return redirect('leads')->with('success', 'Lead Added Successfully.');
    }

  
    public function show($id)
    {
        $data = Lead::where(['id'=>$id])->with('source')->with('notes')->with('user')->first()->toArray();
        $record = Lead::where(['id'=>$id])->with('notes')->first();
        $lead_ID = $id;
        //dd( $record);
        return view('leads.show')->with(['data'=>$data,'record'=>$record, 'lead_ID'=>$id]);
    }


    public function edit($id)
    {
        // dd($id);
        $admin = User::where(['is_admin'=>Null,'id'=>auth()->user()->id])->first();
        if(!empty($admin)){
            $sources = Source::where(['user_id'=>auth()->user()->id])->select('id','source_name')->get()->toArray();

        }elseif(Auth::User()->is_admin == 1){
            $sources = Source::select('id','source_name')->get()->toArray();

        }else{
            $sources = Source::where(['user_id'=>auth()->user()->id])->select('id','source_name')->orWhere(['assign_to_manager'=>auth()->user()->id ])->get()->toArray();

        }
    
    //    dd($sources);
        
        $data = Lead::where(['id'=>$id])->first();
        return view('leads.edit')->with(['data'=>$data,'sources'=>$sources]);
    }


    public function update(Request $request, $id)
    {
        // dd($request);
        $validator = Validator::make(
            $request->all(), [
                'source_id' => 'required',
                // 'company_name' => 'required|min:3|max:20',
                'prospect_first_name' => 'required|min:3|max:20',
                'prospect_last_name' => 'required|min:3|max:20',
                // 'designation' => 'required|min:3|max:20',
                // 'designation_level' => 'required|min:1|max:20',
                'prospect_email' => 'required|email|unique:leads,prospect_email,'.$id,
                'contact_number_1' => 'required|min:10|numeric|unique:leads,contact_number_1,'.$id,
                // 'contact_number_2' => 'required|min:10|numeric|unique:leads,contact_number_2,'.$id,
                // 'company_industry' => 'required|min:3|max:20',
                // 'linkedin_address' => 'required|min:3',
                // 'location' => 'required|min:3',
                // 'bussiness_function' => 'required|numeric',
                // 'timezone' => 'required|numeric',
                
                /* 'physical_address' => 'required|min:3|max:50',
                'city' => 'required|min:3|max:20',
                'state' => 'required|min:3|max:20',
                'zip_code' => 'required|min:3|max:20',
                'country' => 'required|min:3|max:20',
                */
            ],
            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $input = $request->all(); 

        $data = Lead::find($id);
        
        $data->source_id = $input['source_id'];
        if(!empty($input['designation_level'])){
            $data->designation_level = $input['designation_level'];
        }
        if(!empty($input['designation'])){
            $data->designation = $input['designation'];
        }
        if(!empty($input['company_name'])){
            $data->company_name = $input['company_name'];
        }
        if(!empty($input['contact_number_2'])){
            $data->contact_number_2 = $input['contact_number_2'];
        }
        if(!empty($input['company_industry'])){
            $data->company_industry = $input['company_industry'];
        }
        if(!empty($input['bussiness_function'])){
            $data->bussiness_function = $input['bussiness_function'];
        }
        if(!empty($input['prospect_name'])){
            $data->prospect_name = $input['prospect_name'];
        }
        if(!empty($input['linkedin_address'])){
            $data->linkedin_address = $input['linkedin_address'];
        }
        if(!empty($input['prospect_first_name'])){
            $data->prospect_first_name = $input['prospect_first_name'];
        }
        if(!empty($input['prospect_last_name'])){
            $data->prospect_last_name = $input['prospect_last_name'];
        }
        if(!empty($input['prospect_email'])){
            $data->prospect_email = $input['prospect_email'];
        }
        if(!empty($input['contact_number_1'])){
            $data->contact_number_1 = $input['contact_number_1'];
        }
       
       // $data->location = $input['location'];
        //$data->timezone = $input['timezone'];
       /* $data->country = $input['country'];
        $data->lead_name = $input['job_title'];*/

    
        $data->save();
        if(Auth::user()->is_admin == 1){
            return redirect('campaign/camp_assign_emp')->with('success', 'Lead Updated Successfully.');
        }else{
            return redirect('leads')->with('success', 'Lead Updated Successfully.');
        }
       
    }


    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();
        return redirect('leads')->with('success', 'Lead Deleted Successfully.');
    }

    public function searchLead(SearchLeadRequest $request)
    {

        if($request->has('source_id') && !empty($request->input('source_id'))) {
            $data = Lead::where('source_id', $request->source_id)->with('source')->get()->toArray();
             $source_ids = $request->source_id;
        } else {
            $data = Lead::where(['user_id'=>auth()->user()->id])->with('source')->get()->toArray();
             $source_ids = "";
        }

         $sources = Source::where(['user_id'=>auth()->user()->id])->get()->toArray();

         return view('leads.list')->with(['data'=>$data,'sources'=>$sources,'source_ids'=>$source_ids]);
         //return redirect('leads')->with(['data'=>$data,'sources'=>$sources]);
    }


    public function view()
    {
        $data = Lead::where(['user_id'=>auth()->user()->id])->whereNotIn('status', [1])->with('source')->get()->toArray();
        $employees = User::where(['user_id'=>auth()->user()->id, 'is_admin'=>'1'])->get()->toArray();
        $employee_ids = "";
        return view('leads.view')->with(['employees'=>$employees,'data'=>$data,'employee_ids'=>$employee_ids]);
    }


    public function views()
    {
      //dd('dsddsdd');
          if(request()->get('employee_id')){
              $employee_id =  $_GET['employee_id']; 
          }else{
              $employee_id =  "";
          }
          if(request()->get('campaign_id')){
            $campaign_id =  $_GET['campaign_id']; 
          }else{
                $campaign_id =  "";
          }
          //dd($campaign_id);
          if(request()->get('date_from')){
              $date_from =  $_GET['date_from']; 
          }else{
              $date_from =  "";
          }
          
          if(request()->get('date_to')){
              $date_to =  $_GET['date_to']; 
          }else{
              $date_to =  "";
          }
          
        
        $data = new Lead;
        if(request()->get('employee_id')){

            $data = $data->where(['asign_to'=> request()->get('employee_id')]);
        }
        if(request()->get('campaign_id')){
            $data = $data->where(['source_id' => request()->get('campaign_id')]);
        }
        
        if(request()->get('campaign_id') && request()->get('employee_id')){
            $data = $data->where('source_id', '=', $_GET['campaign_id'])->where('asign_to', '=', $_GET['employee_id']);
        }
        
        if(request()->get('date_from') && request()->get('date_to')){
           // $from = date($_GET['date_from']);
          // $to = date($_GET['date_to']);
            $from =  date('Y-m-d', strtotime($_GET['date_from']));
            $to =  date('Y-m-d', strtotime($_GET['date_to']));
            $data = $data->whereBetween('created_at', [$from, $to]);
         
        }
        if(auth()->user()->is_admin == 2){
            $data =  $data->get()->toArray();
        }else{
                    $data =  $data->with('source')->get()->toArray();
        }
        $admin = User::where(['is_admin'=>Null,'id'=>auth()->user()->id])->first();
        if(!empty($admin)){
          $employees = User::where(['is_admin'=>1])->get()->toArray();
          $campaigns = Source::get()->toArray();
        }else{
          $employees = User::where(['user_id'=>auth()->user()->id,'is_admin'=>'1'])->get()->toArray();
          $campaigns = Source::where(['assign_to_manager'=>auth()->user()->id])->get()->toArray();
        }
        
         return view('leads.view')->with(['employees'=>$employees,'data'=>$data,'employee_id'=>$employee_id,'campaigns'=> $campaigns,'campaign_id'=> $campaign_id,'date_from'=>$date_from,'date_to'=>$date_to]);
    }

    public function leadview($id){

        //dd('jdjjdj');

        $admin = User::where(['is_admin'=>Null,'id'=>auth()->user()->id])->first();
        if(!empty($admin)){
                $data = Lead::where(['source_id'=>$id])->with('source')->with('feedback')->get()->toArray();
            
            $sources = Source::select('id','source_name')->get()->toArray();
        }else{
            
            $data = Lead::where(['source_id'=>$id])->with('source')->with('feedback')->get()->toArray();
            $sources = Source::where(['user_id'=>auth()->user()->id])->orWhere(['assign_to_manager'=>auth()->user()->id])->select('id','source_name')->get()->toArray();
        }

            $source_ids = $id;
            return view('leads.leadview')->with(['data'=>$data,'sources'=>$sources,'source_ids'=>$source_ids]);
    }


    public function assign()
    {   
        
        $admin = User::where(['is_admin'=>Null,'id'=>auth()->user()->id])->first();
        if(!empty($admin)){

            $employees = User::where(['user_id'=>auth()->user()->id,'is_admin'=>'2'])->get()->toArray();
            $assing_checkemployees = User::where(['is_admin'=>'1'])->get()->toArray();
            $data = Lead::with('source')->where(['user_id'=>auth()->user()->id,'status'=>'1','asign_to'=>NULL])->whereNull('asign_to_manager')->get()->toArray();
            //dd($employees);
        }else{
            //$employees = User::where(['user_id'=>auth()->user()->id,'is_admin'=>'1'])->get()->toArray();
            $employees = User::where(['is_admin'=>'1'])->get()->toArray();
            $assing_checkemployees = User::where(['is_admin'=>'1'])->get()->toArray();
            $data = Lead::with('source')->where(['asign_to_manager'=>auth()->user()->id,'status'=>'1','asign_to'=>NULL])->orWhere(['user_id'=>auth()->user()->id])->get()->toArray();
        }
        //dd( $assing_checkemployees);
       // $data = Lead::with('source')->where(['user_id'=>auth()->user()->id,'status'=>'1','asign_to'=>NULL])->get()->toArray();
      //  $employees = User::where(['user_id'=>auth()->user()->id,'is_admin'=>'1'])->get()->toArray();
        return view('leads.assign')->with(['employees'=>$employees,'data'=>$data,'assign_employe'=>$assing_checkemployees]);
    }

    public function assigns(Request $request)
    {

        /*if($request->has('employee_id') && !empty($request->input('employee_id'))) {
            $data = Lead::where('asign_to', $request->employee_id)->with('source')->get()->toArray();
        } else {
            $data = Lead::with('source')->get()->toArray();
        }*/
        $data = Lead::with('source')->where(['status'=>'1'])->get()->toArray();
        $employees = User::where(['is_admin'=>'1'])->get()->toArray();

         return view('leads.assign')->with(['employees'=>$employees,'data'=>$data]);
    }
    public function assign_lead_emp()
    {   
            // $employees = User::where(['is_admin'=>'1'])->get()->toArray();
            $admin = User::where(['is_admin'=>Null,'id'=>auth()->user()->id])->first();
            if(!empty($admin)){
              $employees = User::where(['is_admin'=>1])->get()->toArray();
              $campaigns = Source::get()->toArray();
            }else{
              $employees = User::where(['user_id'=>auth()->user()->id,'is_admin'=>'1'])->get()->toArray();
              $campaigns = Source::where(['assign_to_manager'=>auth()->user()->id])->get()->toArray();
            }
            $sources = Source::where(['user_id'=>auth()->user()->id])->orWhere(['assign_to_manager'=>auth()->user()->id])->get()->toArray();
            $data = Lead::with('source')->where(['asign_to_manager'=>auth()->user()->id,'status'=>'1','asign_to'=>NULL])->orWhere(['user_id'=>auth()->user()->id])->get()->toArray();
            return view('leads.assign_lead')->with(['employees'=>$employees,'data'=>$data,'sources'=>$sources]);
    }
    
    public function campname(Request $request)
    {   
        // dd($request->camp_id);
            $subLaws ="";
            $table ="";
            $sources = Source::where(['id'=>$request->camp_id])->first();
            $User_info = User::where(['id'=>$sources->assign_to_manager	])->first();
             $src_Descrition = $sources->description;
             $source_name = $sources->source_name;
           if(!empty($sources)){
              $all_leads = Lead::with('source')->where(['source_id'=>$sources->id])->count();
              $total_leads = Lead::with('source')->where(['source_id'=>$sources->id])->whereNotNull('asign_to')->count();
              $assign_to_leads = Lead::with('source')->where(['source_id'=>$sources->id])->whereNull('asign_to')->count();
           }
           $subLaws ='<div class="append_row col-md-12 ">
           <table class="table">
           <tr>
           <td>Campaign Name</td>
           <td>'.$source_name .' ('.$sources->description.')</td>
           <td>Campaign Manager</td>
           <td>'.$User_info->name.'</td>
           </tr>
           <tr>
           <td>Campaign Total Leads</td>
           <td class="getleadTotalcount">'.$all_leads.'</td>
           <td>Campaign Start Date</td>
           <td>'.$sources->start_date.'</td>
           </tr>
           <tr>
           <td>Campaign End Date</td>
           <td>'.$sources->end_date.'</td>
           <td>Campaign Assigned Leads</td>
           <td class="Change_lead_count">'.$total_leads.'</td>
           </tr>
           </table>
       </div>
       <div class="col-sm-6 col-md-6">
       <div class="form-group change_lead">
           <label class="control-label">Enter Assign Leads Count</label>
           <input type="text" id="start_assign_id" name="start_assign_id" class="form-control"  value='.$assign_to_leads.' readonly="">
           <div class="total_lead">
           <input class="switch-input all_leads" id="all_leads" name="edit" type="checkbox" value="all_leads">
            <label for="all_leads">Edit</label>
        </div>
        <span class="error_msg"></span>
       </div>
   </div>';
        $get_table = DB::table('leads')
        ->select('*', DB::raw('COUNT(asign_to) as totalLeads'))
        ->where('source_id', $request->camp_id)
        ->whereNotNull('asign_to')
        ->groupBy('asign_to')
        ->get();
        $table = '<table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
        <th>Campaign Name</th>
        <th>Total Assigned Lead</th>
        <th>Employee Name</th>
        <th>Campaign Start Date</th>
        <th>Campaign End Date</th>
        </tr>
        </thead>
        <tbody>';
        if(!empty($get_table)){
            foreach($get_table as $key=> $table_data){
                $User_info = User::where(['id'=>$table_data->asign_to])->first();
                $table .=  '<tr><td class="wraping"> '.$sources->source_name .' ('.$sources->description.') </td>
                <td class="wraping"> '.$table_data->totalLeads.' </td>
                <td class="wraping"> '.$User_info->name.' </td>
                <td class="wraping"> '.$sources->start_date.' </td>
                <td class="wraping"> '.$sources->end_date.' </td></tr>';
            }
        }else{
            $table .=  '<tr><td class="wraping">  </td>
            <td class="wraping">  </td>
            <td class="wraping"> Data Not Found </td>
            <td class="wraping">  </td>
            <td class="wraping">  </td></tr>';  
        }
        
        $table .=  '</tbody> </table>';

        $sampleArray = array(
            'data'    => $subLaws,
            'table'   => $table 
        );
        return json_encode($sampleArray);
    }


    public function assingParticalurleads(Request $request)
    {   
        $employee_id = $request->emp_id;
        $assign_leads = $request->assign_leads;
        $campaign_id = $request->cmp_id;
        $data = array(
            'assign_to_cam'=>$campaign_id,
            'assign_to_employee'=>$employee_id,
            'assign_to_manager'=>auth()->user()->id,
            'lead_assigned'=>$assign_leads,
        );
        $relation  = Relation::where('assign_to_employee',$employee_id)->where('assign_to_cam',$campaign_id)->first();
        if($relation == null){
        Relation::create($data);
        }else
        {
            $total_assign = $assign_leads + $relation['lead_assigned'];
            $data1 = array(
                'lead_assigned'=>$total_assign,
            );
            Relation::where('id',$relation['id'])->update($data1);
        }
       $sources_data = Source::where(['id'=>$campaign_id])->first();
       $get_assign_records =  Lead::where('source_id', $campaign_id)->whereNull('asign_to')->take($assign_leads)->get();
       foreach($get_assign_records as $getassigndata){
        Lead::where('source_id', $campaign_id)->where('id', $getassigndata->id)->update(['asign_to'=>$employee_id]);
       }
       $update_leads_count =  Lead::where('source_id', $campaign_id)->whereNull('asign_to')->count();
       $get_table = DB::table('leads')
                ->select('*', DB::raw('COUNT(asign_to) as totalLeads'))
                ->where('source_id', $campaign_id)
                ->whereNotNull('asign_to')
                ->groupBy('asign_to')
                ->get();
       $table = '<table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th>Campaign Name</th>
                                                <th>Sub-Campaign Name</th>
                <th>Total Assigned Lead</th>
                <th>Employee Name</th>
                <th>Campaign Start Date</th>
                <th>Campaign End Date</th>
                </tr>
                </thead>
                <tbody>';
                foreach($get_table as $key=> $table_data){
                    $User_info = User::where(['id'=>$table_data->asign_to])->first();
                    $table .=  '<tr><td class="wraping"> '.$sources_data->source_name.' ('.$sources_data->description.') </td>
                    <td class="wraping"> '.$table_data->totalLeads.' </td>
                    <td class="wraping"> '.$User_info->name.' </td>
                    <td class="wraping"> '.$sources_data->start_date.' </td>
                    <td class="wraping"> '.$sources_data->end_date.' </td></tr>';
                }
            $table .=  '</tbody> </table>';
        
        return response()->json([
        'success' => true,
        'data'    => $update_leads_count,
        'table'   => $table,
        ]);
       //return redirect('leads/assigned_leads')->with('success', 'Leads Assigned Successfully.');

    }
    public function closed()
    {
         $data = Lead::with('source')->where(['asign_to'=>auth()->user()->id])->with('feedback')->where(['status'=>'3'])->orderBy('updated_at','DESC')->get()->toArray();
         //dd($data);
         return view('leads.closed')->with(['data'=>$data]);
    }


    public function failed()
    {
         $data = Lead::with('source')->where(['asign_to'=>auth()->user()->id])->with('feedback')->where(['status'=>'2'])->orderBy('updated_at','DESC')->get()->toArray();
         return view('leads.failed')->with(['data'=>$data]);
    }



    // assign  lead to manager by admin
    public function assignLeadsManager(AssignLeadRequest $request)
    {

            $data = array(
                'employee_id'=>$request->employee_id,
                'lead_id'=>$request->lead_id
            );
            foreach($request->lead_id as $leadid) {
            Lead::where('id', $leadid)->update(['asign_to_manager'=>$request->employee_id]);
            }

            return redirect('leads/assign')->with('success', 'Leads Assigned Successfully.');
            
    }
    public function assignLeadsEmployee(AssignLeadRequest $request)
    {
            $data = array(
                'employee_id'=>$request->employee_id,
                'lead_id'=>$request->lead_id
            );
            
            foreach($request->lead_id as $leadid) {
            Lead::where('id', $leadid)->update(['asign_to'=>$request->employee_id]);
            }

            return redirect('leads/assign')->with('success', 'Leads Assigned Successfully.');
            
    }
    public function assignHalfLeadsEmployee(Request $request)
    {
            //dd($request);
                $employee_id = $request->employee_id;
                $lead_id = $request->lead_id;
                $source_id = $request->source_id;

            Lead::where('source_id', $source_id)->update(['asign_to'=>$request->employee_id]);
            return redirect('leads/assign_lead_emp')->with('success', 'Leads Assigned Successfully.');
            
    }

    public function getLeads(Request $request)
    {  
        $data =array();
        if ($request->has('employee_id')) {
            $data = Lead::where('asign_to', $request->employee_id)->get()->toArray();
        }
        return response()->json($data);
    }
    /*     ANMOL         */ 
    public function add_note(Request $request)
    {
        $status = Lead::where('id',$request->lead_id)->first();
         $data = array(
            'user_id'=>auth()->user()->id,
            'lead_id'=>$request->lead_id,
            'source_id'=>$request->source_id,
            'status'=>$status['status'],
            'reminder_time'=>$request->reminder_time,
            'reminder_date'=>$request->reminder_date,
            'reminder_for'=>$request->reminder_for,
            'feedback'=>$request->feedback,
        );
        Note::create($data);
        return response()->json(['success'=>'Note Added Successfully']);
        // }
    }
    public function changeStatus(Request $request)
    {

        /*$validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);


        if ($validator->passes()) {

            $data = array(
                'status'=>$request->status
            );
            
             //Lead::where('id', $request->lead_id)->update(['status'=>$request->status]);
            return response()->json(['success'=>'Updated Successfully.']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);

        */
        //dd( $request);
         $notesCount =  Note::where(['lead_id'=>$request->lead_id])->count();
         $total_Lhsreport_count =  LhsReport::where(['lead_id'=>$request->lead_id])->count();
        if($notesCount == 0){
            $html = '<li class="error_list"><span class="tab">Please add a notes first.</span></li>';
           return response()->json(['error'=>'Please add a note first.','lhs_link'=>$html]);
        }else if($total_Lhsreport_count == 0 && $request->status == 3)
        {    
            if($notesCount == 0){
           return response()->json(['error'=>'Please add a note first.']);
            }else{
            $html = '';
            $hostname = Config::get('app.url');
            $Current_url = $hostname."/employee/lhs_report/". $request->lead_id."?status=".$request->status;
            $html = '<li class="error_list"><span class="tab">Please add  LHS Report first.</span><a href="'.$Current_url.'" ><span class="tab">Click here to add Lhs Report</span></a></li>';
            return response()->json(['error'=>'Please add  LHS Report first.','lhs_link'=>$html]);
            }
            //$('.alert.alert-danger.print-error-msg').show();
            //var base_url = $('meta[name="base_url"]').attr('content');
           // var  Current_url = base_url+"/employee/lhs_report/"+ lead_id+"?status="+selected_val;
          //  $('ul.custom_text').html('<li class="error_list"><span class="tab">Please add  LHS Report first.</span><a href="'+Current_url+'" ><span class="tab">Click here to add Lhs Report</span></a></li>');
        

        }
        else{
            // Note::where('lead_id', $request->lead_id)->orderBy('updated_at', 'desc')
            // ->first()
            // ->update([
            //     'updated_at' => date('Y-m-d G:i:s')
            //  ]);
            $create_note = Note::where('lead_id', $request->lead_id)->orderBy('updated_at', 'desc')
            ->first();
            $data = array(
                'user_id'=>$create_note['user_id'],
                'lead_id'=>$create_note['lead_id'],
                'source_id'=>$create_note['source_id'],
                'status'=>$request->status,
                'reminder_time'=>$create_note['reminder_time'],
                'reminder_date'=>$create_note['reminder_date'],
                'reminder_for'=>$create_note['reminder_for'],
                'feedback'=>$create_note['feedback'],
            );
            Note::create($data);
            Lead::where('id', $request->lead_id)->update(['status'=>$request->status,'is_notify'=>1,'is_read'=>1]);
             $notification_count =  Lead::where('is_notify','!=', 0)->count();
             if($request->status == 2){
                $status = 'failed';
             }elseif($request->status == 3){
                $status = 'close';
             }else{
                $status = 'in_progress'; 
             }
             //dd($notification_count);
            return response()->json(['success'=>'Updated Successfully.','notification_count'=>$notification_count ,'status'=> $status]);
        }       
    }
    public function search(Request $request)
    {  
        $data = Lead::where('timezone', 'LIKE', '%$value%')->get();
        return view('leads.list')->with(['data'=>$data]);
        // return response()->json($data);
    }
 

}
