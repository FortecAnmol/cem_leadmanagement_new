<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lead;
use App\Models\Source;
use App\Models\User;
use App\Models\Note;
Use DB;
use App\Http\Requests\LeadRequest;
use App\Http\Requests\SearchLeadRequest;
use App\Http\Requests\AssignLeadRequest;
use App\Http\Requests\AssignLeadEmployeeRequest;


use Validator;

class LeadsController extends Controller
{
    
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $admin = User::where(['is_admin'=>Null,'id'=>auth()->user()->id])->first();
        if(!empty($admin)){
            if (!isset($_GET['status'])) {

                $data = Lead::where(['user_id'=>auth()->user()->id])->with('source')->with('feedback')->get()->toArray();
           } else{
                $data = Lead::where(['user_id'=>auth()->user()->id,'status'=>$_GET['status']])->with('source')->with('feedback')->get()->toArray();
           }
           $sources = Source::select('id','source_name')->get()->toArray();
        }else{
            if (!isset($_GET['status'])) {

                $data = Lead::where(['user_id'=>auth()->user()->id])->orWhere(['asign_to_manager'=>auth()->user()->id])->with('source')->with('feedback')->get()->toArray();
           } else{
                $data = Lead::where(['user_id'=>auth()->user()->id,'status'=>$_GET['status']])->with('source')->with('feedback')->get()->toArray();
           }
           $sources = Source::where(['user_id'=>auth()->user()->id])->orWhere(['assign_to_manager'=>auth()->user()->id ])->select('id','source_name')->get()->toArray();
        }
         $source_ids ="";
         return view('leads.list')->with(['data'=>$data,'sources'=>$sources,'source_ids'=>$source_ids]);
    }

  
    public function create()
    {
        $sources = Source::where(['user_id'=>auth()->user()->id])->select('id','source_name')->get()->toArray();
        return view('leads.add')->with(['sources'=>$sources]);
    }


    public function store(Request $request)
    {
        
        $data = array(
            'user_id'=>auth()->user()->id,
            'source_id'=>$request->source_id,
            /*'company_name'=>$request->company_name,*/
            'prospect_first_name'=>$request->prospect_first_name,
            'prospect_last_name'=>$request->prospect_last_name,
            /*'job_title'=>$request->job_title,*/
            'prospect_email'=>$request->prospect_email,
            'contact_number_1'=>$request->contact_number_1,
            /*'web_address'=>$request->web_address,
            'employee_size'=>$request->employee_size,
            'revenue_size'=>$request->revenue_size,
            'company_industry'=>$request->company_industry,
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
        $data = Lead::where(['id'=>$id])->with('source')->with('user')->first()->toArray();
        //dd($data);
        return view('leads.show')->with(['data'=>$data]);
    }


    public function edit($id)
    {
        $admin = User::where(['is_admin'=>Null,'id'=>auth()->user()->id])->first();
        if(!empty($admin)){
            $sources = Source::where(['user_id'=>auth()->user()->id])->select('id','source_name')->get()->toArray();

        }else{
            $sources = Source::where(['user_id'=>auth()->user()->id])->select('id','source_name')->orWhere(['assign_to_manager'=>auth()->user()->id ])->get()->toArray();

        }
    
       // dd($sources);
        
        $data = Lead::where(['id'=>$id])->first();
        return view('leads.edit')->with(['data'=>$data,'sources'=>$sources]);
    }


    public function update(Request $request, $id)
    {
        //dd($request);
        $validator = Validator::make(
            $request->all(), [
                'source_id' => 'required',
                // 'company_name' => 'required|min:3|max:20',
                'prospect_first_name' => 'required|min:3|max:20',
                'prospect_last_name' => 'required|min:3|max:20',
                // 'designation' => 'required|min:3|max:20',
                // 'designation_level' => 'required|min:1|max:20',
                'prospect_email' => 'required|email|unique:leads,email,'.$id,
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
        
        return redirect('leads')->with('success', 'Lead Updated Successfully.');
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

         $sources = Source::where(['user_id'=>auth()->user()->id])->select('id','source_name')->get()->toArray();

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

            $data = $data->where('asign_to', '=', $_GET['employee_id']);

        }
     
        if(request()->get('date_from') && request()->get('date_to')){
          
            $from = date($_GET['date_from']);
            $to = date($_GET['date_to']);

            $data = $data->whereBetween('created_at', [$from, $to]);
         
        }
   
        //$data = $data->where(['user_id'=>auth()->user()->id])->whereNotNull('asign_to')->with('source')->get()->toArray();
        
        $data =  $data->whereHas('users', function ($query) {
                    $query->where(['user_id'=>auth()->user()->id]);
          })->with('source')->get()->toArray();
      
        //$employees = User::where(['user_id'=>auth()->user()->id, 'is_admin'=>'1'])->get()->toArray();
        $employees = User::where(['is_admin'=>'1'])->get()->toArray();
        
         return view('leads.view')->with(['employees'=>$employees,'data'=>$data,'employee_id'=>$employee_id,'date_from'=>$date_from,'date_to'=>$date_to]);
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
        //dd('heerre');
        $admin = User::where(['is_admin'=>Null,'id'=>auth()->user()->id])->first();
        if(!empty($admin)){
            $employees = User::where(['user_id'=>auth()->user()->id,'is_admin'=>'2'])->get()->toArray();
            $data = Lead::with('source')->where(['user_id'=>auth()->user()->id,'status'=>'1','asign_to'=>NULL])->whereNull('asign_to_manager')->get()->toArray();

        }else{
            $employees = User::where(['is_admin'=>'1'])->get()->toArray();
            $sources = Source::where(['user_id'=>auth()->user()->id])->orWhere(['assign_to_manager'=>auth()->user()->id])->select('id','source_name')->get()->toArray();
            $data = Lead::with('source')->where(['asign_to_manager'=>auth()->user()->id,'status'=>'1','asign_to'=>NULL])->orWhere(['user_id'=>auth()->user()->id])->get()->toArray();
        }
         return view('leads.assign_lead')->with(['employees'=>$employees,'data'=>$data,'sources'=>$sources]);
    }
    
    public function campname(Request $request)
    {   
        //dd($request->camp_id);
            $subLaws ="";
            $sources = Source::where(['id'=>$request->camp_id])->first();
            $User_info = User::where(['id'=>$sources->assign_to_manager	])->first();
             $src_Descrition = $sources->description;
             $source_name = $sources->source_name;
           if(!empty($sources)){
              $total_leads = Lead::with('source')->where(['source_id'=>$sources->id])->whereNull('asign_to')->count();
           }
           $subLaws ='<div class="append_row col-md-12 ">
            
           <table class="table">
           <tr>
           <td>Campaign Name</td>
           <td>'.$source_name.'</td>
           <td>Campaign Manager</td>
           <td>'.$User_info->name.'</td>
           </tr>
           <tr>
           <td>Campaign Total Leads</td>
           <td class="Change_lead_count">'.$total_leads.'</td>
           <td>Campaign Start Date</td>
           <td>'.$sources->start_date.'</td>
           </tr>
           <tr>
           <td>Campaign End Date</td>
           <td>'.$sources->end_date.'</td>
           <td></td>
           <td></td>
           </tr>
           </table>

       </div>

       <div class="col-sm-6 col-md-6">
       <div class="form-group change_lead">
           <label class="control-label">Enter Assign Leads Count</label>
           <input type="text" id="start_assign_id" name="start_assign_id" class="form-control"  value='.$total_leads.' readonly="">
           
           <div class="total_lead">
              <input class="switch-input all_leads" id="all_leads" name="edit" type="checkbox" value="all_leads">
               <label for="all_leads">Edit</label>
           </div>
       </div>
   </div>';


           
        return $subLaws;
            // return view('leads.assign_lead')->with(['employees'=>$employees,'data'=>$data,'sources'=>$sources]);
    }

    public function test_fn(){
        //$get_updated_table = DB::table('leads')->where('source_id', 11)->get();
        $get_updated_table = DB::table('leads')->groupBy('asign_to')->select('*')->get();
        echo"<pre>";print_r($get_updated_table);echo"</pre>";
 dd('here');
    }
    public function assingParticalurleads(Request $request)
    {   

        $employee_id = $request->emp_id;
        $assign_leads = $request->assign_leads;
        $campaign_id = $request->cmp_id;
        $sources_data = Source::where(['id'=>$campaign_id])->first();
       $get_assign_records =  Lead::where('source_id', $campaign_id)->whereNull('asign_to')->take($assign_leads)->get();
       foreach($get_assign_records as $getassigndata){
        Lead::where('source_id', $campaign_id)->where('id', $getassigndata->id)->update(['asign_to'=>$employee_id]);
       }
       $update_leads_count =  Lead::where('source_id', $campaign_id)->whereNull('asign_to')->count();
       $get_table =  Lead::with('source')->where('source_id', $campaign_id)->whereNotNull('asign_to')->groupBy('asign_to')->get();     
 
       $table = '<table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
             <th>Campaign Name</th>
                                                <th>Sub-Campaign Name</th>
                                                <th>Sub-Campaign Name</th>
                                                <th>Sub-Campaign Name</th>
             <th>Total Assigned Lead</th>
             <th>Employee Name</th>
              <th>Campaign Start Date</th>
             <th>Campaign End Date</th>
               </tr>
              </thead>
              <tbody>';
              foreach($get_table as $table_data){
                $table .=  '<tr><td class="wraping"> '.$sources_data->source_name.' </td>
                <td class="wraping"> '.$table_data->asign_to.' </td>
                <td class="wraping"> '.$table_data->asign_to.' </td>
                <td class="wraping"> '.$sources_data->start_date.' </td>
                <td class="wraping"> '.$sources_data->end_date.' </td></tr>';

                }
         $table .=  '</tbody>
              </table>';
       
       return response()->json([
        'success' => true,
        'data'    => $update_leads_count,
        'table'   => $table,
      ]);

    }
    public function closed()
    {
         $data = Lead::with('source')->where(['asign_to'=>auth()->user()->id])->with('feedback')->where(['status'=>'3'])->get()->toArray();
         //dd($data);
         return view('leads.closed')->with(['data'=>$data]);
    }


    public function failed()
    {
         $data = Lead::with('source')->where(['asign_to'=>auth()->user()->id])->with('feedback')->where(['status'=>'2'])->get()->toArray();
         return view('leads.failed')->with(['data'=>$data]);
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
         $notesCount =  Note::where(['lead_id'=>$request->lead_id])->count();
        if($notesCount == 0){

           return response()->json(['error'=>'Please add a note first.']);

        }else{

            
             Lead::where('id', $request->lead_id)->update(['status'=>$request->status]);
            return response()->json(['success'=>'Updated Successfully.']);

        }
            
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

 

}
