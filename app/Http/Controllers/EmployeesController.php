<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lead;
use App\Models\LhsReport;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\ManagerEmployeeRequest;
use App\Http\Requests\EditEmployeeRequest;
use App\Http\Requests\EditManagerEmployeeRequest;
use App\Models\Note;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Source;
use Illuminate\Support\Facades\DB;
use App\Models\Relation;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class EmployeesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function notes_new()
    {
        $notes = Note::groupBy('lead_id')->get('lead_id');
        foreach($notes as $data_notes){
            $leads = Lead::select('source_id','id','status')->where('id',$data_notes->lead_id)->get();
            foreach($leads as $data_leads){
                Note::where('lead_id',$data_leads->id)->update(['source_id' => $data_leads->source_id,'status'=>$data_leads->status]);
            }
        }
        
        $leads = Lead::where('id','lead_id')->get('source_id');
          
        
    }
    public function index()
    {
        $admin = User::where(['is_admin'=>Null,'id'=>auth()->user()->id])->first();
        if(!empty($admin)){
            $data = User::where(['is_admin'=>'1'])->get()->toArray();
        }else{
         //$data = User::where(['is_admin'=>'1','user_id'=>auth()->user()->id])->get()->toArray();
         $data = User::where(['user_id'=>auth()->user()->id,'is_admin'=>'1'])->get()->toArray();
        }
          return view('employees.list')->with(['data'=>$data]);
        
    }

    public function create()
    {
            $employeeCount = User::where(['user_id'=>auth()->user()->id,'is_admin'=>'1'])->count();
            if(auth()->user()->is_admin != NULL){
                if($employeeCount >= 2){
                    return view('employees.add');
                   // return redirect('employees')->with('error', 'Please contact with admin to add more employees.');
                }else{
    
                    return view('employees.add');
                }
            }else{
                return view('employees.add');
            }
    }


    public function store(EmployeeRequest $request)
    {

        $password = rand(10000000,99999999);
        if(auth()->user()->is_admin != NULL){
            // dd('manager');
            $data = array(
                'user_id'=>auth()->user()->id,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'name'=>$request->first_name.' '.$request->last_name,
                'phone_no'=>$request->phone_no,
                'email'=>$request->email,
                'password'=>Hash::make($password),
                'orignal_password'=>$password,
                'address'=>$request->address,
                'is_admin'=>'1',
            );
    
            User::create($data);
            
            return redirect('employees')->with('success', 'Employee Added Successfully.');
            }else{
                // dd('admin');    
                $data = array(
                    'user_id'=>$request->manager,
                    'first_name'=>$request->first_name,
                    'last_name'=>$request->last_name,
                    'name'=>$request->first_name.' '.$request->last_name,
                    'phone_no'=>$request->phone_no,
                    'email'=>$request->email,
                    'password'=>Hash::make($password),
                    'orignal_password'=>$password,
                    'address'=>$request->address,
                    'is_admin'=>'1',
                );
        
                User::create($data);
                
                return redirect('employees')->with('success', 'Employee Added Successfully.');
            }
        

         $data = array(
            'user_id'=>auth()->user()->id,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'name'=>$request->first_name.' '.$request->last_name,
            'phone_no'=>$request->phone_no,
            'email'=>$request->email,
            'password'=>Hash::make($password),
            'orignal_password'=>$password,
            'address'=>$request->address,
            'is_admin'=>'1',
        );

        User::create($data);
        
        return redirect('employees')->with('success', 'Employee Added Successfully.');
        
    }
    
    
    public function addManagerEmployee()
    {
        $managers = User::where(['is_admin'=>'2'])->select('id','name')->get()->toArray();
        return view('employees.addManagerEmployee')->with(['managers'=>$managers]);
    }
    
    
    public function storeManagerEmployee(ManagerEmployeeRequest $request)
    {

        $password = rand(10000000,99999999);

         $data = array(
            'user_id'=>$request->manager_id,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'name'=>$request->first_name.' '.$request->last_name,
            'phone_no'=>$request->phone_no,
            'email'=>$request->email,
            'password'=>Hash::make($password),
            'orignal_password'=>$password,
            'address'=>$request->address,
            'is_admin'=>'1',
        );
        // dd($data);
        User::create($data);
        
        return redirect()->route('employees.show', ['id' => $request->manager_id])->with('success', 'Employee Added Successfully.');
        
    }
    
    
    public function editManagerEmployee($id)
    {
        $managers = User::where(['is_admin'=>'2'])->select('id','name')->get()->toArray();
        $data = User::where(['id'=>$id])->first();
        return view('employees.editManagerEmployee')->with(['data'=>$data,'managers'=>$managers]);
    }


    public function updateManagerEmployee(Request $request, $id)
    {
        
         $validator = Validator::make(
            $request->all(), [
                'first_name' => 'required|min:3|max:20',
                'last_name' => 'required|min:3|max:20',
               //'email' => 'required|email|unique:users',
               'email' => 'required|email|unique:users,email,'.$id,
                'phone_no' => 'required|min:10|numeric|unique:users,phone_no,'.$id,
                'address' => 'required|min:3|max:30',
            ],
            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $input = $request->all(); 

        $data = User::find($id);
        
        $data->user_id = $input['manager_id'];
        $data->first_name = $input['first_name'];
        $data->last_name = $input['last_name'];
        $data->name = $input['first_name'].' '.$input['last_name'];
        $data->phone_no = $input['phone_no'];
        $data->email = $input['email'];
        $data->address = $input['address'];
    
        $data->save();

        //return redirect('employees')->with('success', 'Employee Updated Successfully.');
         return redirect()->route('employees.show', ['id' => $request->manager_id])->with('success', 'Employee Added Successfully.');
    }
    
    
    public function deleteManagerEmployee($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();
        return redirect()->back()->with('success', 'Employee Deleted Successfully.');
    }


    public function show($id)
    {
          $manager = User::where(['id'=>$id])->select('name')->first();
          $data = User::where(['is_admin'=>'1','user_id'=>$id])->get()->toArray();
          return view('employees.listManagerEmployee')->with(['data'=>$data,'manager'=>$manager]);
    }

    public function edit($id)
    {
       
        $data = User::where(['id'=>$id])->first();
        return view('employees.edit')->with(['data'=>$data]);
    }


    public function update(Request $request, $id)
    {
        // dd($request->email);
        $validator = Validator::make(
            $request->all(), [
                'first_name' => 'required|min:3|max:20',
                'last_name' => 'required|min:3|max:20',
               //'email' => 'required|email|unique:users',
               'email' => 'required|email|unique:users,email,'.$id,
                // 'phone_no' => 'required|min:10|numeric|unique:users,phone_no,'.$id,
                // 'address' => 'required|min:3|max:30',
                'orignal_password' => 'required|min:3|max:30',
            ],
            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->all(); 
        
        $password  =  Hash::make($input['orignal_password']);
        $data = User::find($id);
        if($input['manager'] !== NULL){
        $data->user_id = $input['manager'];
        }
        $data->first_name = $input['first_name'];
        $data->last_name = $input['last_name'];
        $data->name = $input['first_name'].' '.$input['last_name'];
        $data->phone_no = $input['phone_no'];
        $data->email = $input['email'];
        $data->address = $input['address'];
        $data->password = $password;
        $data->orignal_password = $input['orignal_password'];

    
        $data->save();

        return redirect('employees')->with('success', 'Employee Updated Successfully.');
    }


    public function destroy($id)
    {
        //
    }
    
    public function statusUpdate($id)
    {
       
        $manager = User::findOrFail($id);
        //dd($manager->first_name);
        //$manager->first_name = "DEMO";
        
        if($manager->is_active == 1){
            $manager->is_active = 2;
        }
        else
        {
            $manager->is_active = 1;
        }
        
        $manager->save();
        
        
        return redirect('employees')->with('success', 'Status Changed');
        
    }

    public function delete($id)
    {
        //dd('ddd');
        //Lead::where(['asign_to'=>$id,'status'=>'1'])->update(['asign_to'=>NULL]);
        $employee = User::findOrFail($id);
        $employee->delete();
        return redirect('employees')->with('success', 'Employee Deleted Successfully.');
    }

    public function lhs_report($id)
    {
        $get_lead = Lead::where(['id'=>$id])->first();
        return view('employees.export_Lhs')->with(['data'=>$get_lead]);
    }


    public function lhs_report_save(Request $request){
        

        // $validator = Validator::make(
        //     $request->all(), [
        //         'call_notes' => 'required',
        //         'meeting_teleconference' => 'required',
        //         'meeting_date1' => 'required|',
        //         'meeting_time1' => 'required|',
        //         'timezone_1' => 'required|'
                
        //     ],
        //     $messages = [
        //         'required' => 'The :attribute field is required.',
        //     ]
        // );
        
        // if ($validator->fails()) {
        //     //dd('dkdjkd');
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
        
        $prev  = $request->previous_url;
        $uriSegments = explode("/", parse_url($prev, PHP_URL_PATH));
        $notesCount =  Note::where(['lead_id'=>$request->lead_id])->count();
        // dd($request->influencers_decision_making_process);
        if($notesCount == 0){
           return response()->json(['error'=>'Please add a note first.']);
        }else{
            $data = array(
                'lead_id'=>$request->lead_id,
                'board_no'=>$request->board_no,
                'direct_no'=>$request->direct_no,
                'employees_strength'=>$request->employees_strength,
                'revenue'=>$request->revenue,
                'address'=>$request->address,
                'website'=>$request->website,
                'prospect_vertical'=>$request->prospect_vertical,
                'prospects_level'=>$request->prospects_level,
                'opt_in_status'=>$request->opt_in_status,
                'company_desc'=>$request->company_desc,
                'responsibilities'=>$request->responsibilities,
                'team_size'=>$request->team_size,
                'pain_areas'=>$request->pain_areas,
                'interest_new_initiatives'=>$request->interest_new_initiatives,
                'budget'=>$request->budget,
                'defined_agenda'=>$request->defined_agenda,
                'call_notes'=>$request->call_notes,
                'meeting_date1'=>date('Y-m-d', strtotime($request->meeting_date1)),
                'meeting_date2'=>date('Y-m-d', strtotime($request->meeting_date2)),
                'meeting_time1'=>$request->meeting_time1,
                'meeting_time2'=>$request->meeting_time2,
                'timezone_1'=>$request->timezone_1,
                'timezone_2'=>$request->timezone_2,
                'ext_if_any'=>$request->ext_if_any,
                'ea_name'=>$request->ea_name,
                'ea_email'=>$request->ea_email,
                'ea_phone_no'=>$request->ea_phone_no,
                'meeting_teleconference'=>$request->meeting_teleconference,
                'contact_decision_maker'=>$request->contact_decision_maker,
                'influencers_decision_making_process'=>$request->influencers_decision_making_process,
                'company_already_affiliated'=>$request->company_already_affiliated,
            );
            $request->validate([
                'board_no'=>                    'required|numeric',
                'direct_no'=>                   'required|numeric',
                'employees_strength'=>          'required',
                'revenue'=>                     'required',
                'address'=>                     'required',
                'website'=>                     'required',
                'prospect_vertical'=>           'required',
                'prospects_level'=>             'required',
                'company_desc'=>                'required',
                'responsibilities'=>            'required',
                'team_size'=>                   'required',
                'opt_in_status'=>               'required',
                'pain_areas'=>                  'required',
                'interest_new_initiatives'=>    'required',         
                'budget'=>                      'required',
                'defined_agenda'=>              'required',
                'call_notes'=>                  'required',
                'meeting_date1'=>               'required',
                'meeting_date2'=>               'required',
                'meeting_time1'=>               'required',
                'meeting_time2'=>               'required',
                'timezone_1'=>                  'required',
                'timezone_2'=>                  'required',
                'ext_if_any'=>                  'required',
                'ea_name'=>                     'required',
                'ea_email'=>                    'required|email',
                'ea_phone_no'=>                 'required|numeric',
                'meeting_teleconference'=>      'required|in:Face to Face meeting,Teleconference',
                'contact_decision_maker'=>      'required|in:Yes,No',
                'influencers_decision_making_process'=>        'required',
                'company_already_affiliated'=>                 'required',
            ]);
            $lead_data =  Lead::where('id','=', $request->lead_id)->first();
            $source_id = $lead_data->source_id;
            LhsReport::create($data);
           
            if($uriSegments[2] == 'campaign'){
                return redirect('campaign/camp_assign_emp/'.$source_id)->with('success', 'LHS Report Added Successfully.');

            }elseif($uriSegments[2] == 'notes')
            {       
                 return redirect('notes/add/'.$request->lead_id)->with('success', 'LHS Report Added Successfully.');
            }
            return redirect('notes/add/'.$request->lead_id)->with('success', 'LHS Report Added Successfully.');
            //return redirect('leads/closed')->with('success', 'LHS Report Added Successfully.');
            
        }
       

    }
    public function edit_lhs_report($id){

        $get_lead_report = LhsReport::where(['lead_id'=>$id])->first();
        $get_lead = Lead::where(['id'=>$id])->first();
        return view('employees.edit_export_Lhs')->with(['data'=>$get_lead_report,'lead_info'=> $get_lead]);
    }
    public function update_lhs_report(Request $request){
        $input = $request->all(); 

        // dd($input);
        $request->validate([
            'board_no'=>                    'required|numeric',
            'direct_no'=>                   'required|numeric',
            'employees_strength'=>          'required',
            'revenue'=>                     'required',
            'address'=>                     'required',
            'website'=>                     'required',
            'prospect_vertical'=>           'required',
            'prospects_level'=>             'required',
            'company_desc'=>                'required',
            'responsibilities'=>            'required',
            'team_size'=>                   'required',
            'pain_areas'=>                  'required',
            'opt_in_status'=>               'required',
            'interest_new_initiatives'=>    'required',         
            'budget'=>                      'required',
            'defined_agenda'=>              'required',
            'call_notes'=>                  'required',
            'meeting_date1'=>               'required',
            'meeting_date2'=>               'required',
            'meeting_time1'=>               'required',
            'meeting_time2'=>               'required',
            'timezone_1'=>                  'required',
            'timezone_2'=>                  'required',
            'ext_if_any'=>                  'required',
            'ea_name'=>                     'required',
            'ea_email'=>                    'required|email',
            'ea_phone_no'=>                 'required|numeric',
            'meeting_teleconference'=>      'required|in:Face to Face meeting,Teleconference',
            'contact_decision_maker'=>      'required|in:Yes,No',
            'influencers_decision_making_process'=>        'required',
            'company_already_affiliated'=>                 'required',
        ]);
         
        $data = LhsReport::find($request->lead_lhs_id);
        $data->lead_id = $input['lead_id'];
        $data->board_no = $input['board_no'];
        $data->direct_no = $input['direct_no'];
        $data->employees_strength = $input['employees_strength'];
        $data->revenue = $input['revenue'];
        $data->address = $input['address'];
        $data->website = $input['website'];
        $data->prospect_vertical = $input['prospect_vertical'];
        $data->prospects_level = $input['prospects_level'];
        $data->opt_in_status = $input['opt_in_status'];
        $data->company_desc = $input['company_desc'];
        $data->responsibilities = $input['responsibilities'];
        $data->team_size = $input['team_size'];
        $data->pain_areas = $input['pain_areas'];
        $data->interest_new_initiatives = $input['interest_new_initiatives'];
        $data->budget = $input['budget'];
        $data->defined_agenda = $input['defined_agenda'];
        $data->call_notes = $input['call_notes'];
        $data->meeting_date1 = date('Y-m-d', strtotime($input['meeting_date1']));
        $data->meeting_date2 = date('Y-m-d', strtotime($input['meeting_date2']));
        $data->meeting_time1 = $input['meeting_time1'];
        $data->meeting_time2 = $input['meeting_time2'];
        $data->timezone_1= $input['timezone_1'];
        $data->timezone_2= $input['timezone_2'];
        $data->ext_if_any = $input['ext_if_any'];
        $data->ea_name = $input['ea_name'];
        $data->ea_email = $input['ea_email'];
        $data->ea_phone_no = $input['ea_phone_no'];
        $data->meeting_teleconference = $input['meeting_teleconference'];
        $data->contact_decision_maker = $input['contact_decision_maker'];
        $data->influencers_decision_making_process = $input['influencers_decision_making_process'];
        $data->company_already_affiliated = $input['company_already_affiliated'];
        $data->save();
        return Redirect::back()->with('success', 'LHS Report Updated Successfully.');
    }

    public function view_lhs($id){

        $get_lead_report = LhsReport::where(['lead_id'=>$id])->first();
        $get_lead = Lead::where(['id'=>$id])->first();
        return view('employees.view_lhs_report')->with(['data'=>$get_lead_report,'lead_info'=> $get_lead]);
    }

    public function emp_daily_report(){
        
        if(request()->get('campaign_id')){
            $campaign_id =  $_GET['campaign_id']; 
          }else{
                $campaign_id =  "";
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
          $date_from_new = date ( 'Y-m-d H:i:s' , strtotime($date_from) );
          $date_to_new = date ( 'Y-m-d H:i:s' , strtotime($date_to) );
          $campaigns =  Lead::where(['asign_to'=>auth()->user()->id])->with('source')
          ->select('*', DB::raw('COUNT(source_id) as totalLeads'))->groupBy('source_id')->get();


          if(request()->get('campaign_id') && empty(request()->get('date_from')) && empty(request()->get('date_to'))){
            $data = Lead::where(['asign_to'=>auth()->user()->id])
            ->where('notes.source_id','=',request()->get('campaign_id'))
            ->join('notes','notes.lead_id','=','leads.id')->latest('notes.updated_at', 'desc')
            ->get();
          }
          elseif(empty(request()->get('campaign_id')) && empty(request()->get('date_from')) && empty(request()->get('date_to')))
          {
          $data = Lead::where(['asign_to'=>auth()->user()->id])
          ->join('notes','notes.lead_id','=','leads.id')->latest('notes.updated_at')->get();
          }
          elseif(request()->get('campaign_id') && request()->get('date_from') && request()->get('date_to'))
          {
            $data = Lead::where(['asign_to'=>auth()->user()->id])
            ->where('notes.source_id','=',request()->get('campaign_id'))
            ->whereBetween('notes.updated_at', [$date_from_new, $date_to_new])->join('notes','notes.lead_id','=','leads.id')
            ->latest('notes.updated_at', 'desc')->get();


          }
          elseif(empty(request()->get('campaign_id')) && request()->get('date_from') && request()->get('date_to'))
          {
            $data = Lead::where(['asign_to'=>auth()->user()->id])->join('notes','notes.lead_id','=','leads.id')
            ->whereBetween('notes.updated_at', [$date_from_new, $date_to_new])->latest('notes.updated_at', 'desc')->get();
          }
        // $data = Lead::where(['asign_to'=>auth()->user()->id])->where('status','!=','1')->groupBy(DB::raw('source_id'))->groupBy(DB::raw('DATE(updated_at)'))->orderBy('updated_at', 'desc')->with('source')->get();
        return view('employees.emp_daily_report')->with(['campaigns'=>$campaigns, 'data'=>$data ,'campaign_id'=> $campaign_id,'date_from'=>$date_from,'date_to'=>$date_to]);
    }
    public function man_daily_report(){
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
        $date_from_new = date ( 'Y-m-d H:i:s' , strtotime($date_from) );
        $date_to_new = date ( 'Y-m-d H:i:s' , strtotime($date_to) );
          $data = Lead::join('notes','notes.lead_id','=','leads.id')->latest('notes.updated_at')->get();
          if(request()->get('employee_id') && empty(request()->get('campaign_id')) && empty(request()->get('date_from')) && empty(request()->get('date_to'))){
              $data = Lead::where(['asign_to'=>request()->get('employee_id')])
              ->join('notes','notes.lead_id','=','leads.id')->latest('notes.updated_at')->get();
          }
          if(request()->get('campaign_id') && empty(request()->get('employee_id')) && empty(request()->get('date_from')) && empty(request()->get('date_to')) ){

            $data = Lead::where('notes.source_id','=',request()->get('campaign_id'))
            ->join('notes','notes.lead_id','=','leads.id')->latest('notes.updated_at', 'desc')
            ->get();
          }
          if(empty(request()->get('campaign_id')) && request()->get('employee_id') && request()->get('date_from') && request()->get('date_to') ){
            
            $data = Lead::where(['asign_to'=>request()->get('employee_id')])
            ->whereBetween('notes.updated_at', [$date_from_new, $date_to_new])
            ->join('notes','notes.lead_id','=','leads.id')->latest('notes.updated_at')
            ->get();
          }
          if(request()->get('campaign_id') && empty(request()->get('employee_id')) && request()->get('date_from') && request()->get('date_to') ){
            $data = Lead::where('notes.source_id','=',request()->get('campaign_id'))
            ->whereBetween('notes.updated_at', [$date_from_new, $date_to_new])
            ->join('notes','notes.lead_id','=','leads.id')
            ->latest('notes.updated_at', 'desc')->get();
          }
          
          if(request()->get('campaign_id') && request()->get('employee_id') && empty(request()->get('date_from')) && empty(request()->get('date_to')) ){
              $data = Lead::where('notes.source_id','=',request()->get('campaign_id'))->where(['asign_to'=>request()->get('employee_id')])
              ->join('notes','notes.lead_id','=','leads.id')->latest('notes.updated_at')->get();
          }
          if(request()->get('date_from') && request()->get('date_to') && request()->get('campaign_id') && request()->get('employee_id')){
            $date_from =  date('Y-m-d', strtotime($_GET['date_from']));
            $date_to =  date('Y-m-d', strtotime($_GET['date_to']));
            $data =  Lead::where('notes.source_id','=',request()->get('campaign_id'))
            ->where(['asign_to'=>request()->get('employee_id')])->whereBetween('notes.updated_at', [$date_from_new, $date_to_new])
            ->join('notes','notes.lead_id','=','leads.id')->latest('notes.updated_at')->get();
        }
          if(request()->get('date_from') && request()->get('date_to') && empty(request()->get('campaign_id')) && empty(request()->get('employee_id'))){
              $date_from =  date('Y-m-d', strtotime($_GET['date_from']));
              $date_to =  date('Y-m-d', strtotime($_GET['date_to']));
              $data =  Lead::whereBetween('notes.updated_at', [$date_from_new, $date_to_new])
              ->join('notes','notes.lead_id','=','leads.id')->latest('notes.updated_at')->get();
          }
          
          $admin = User::where(['is_admin'=>Null,'id'=>auth()->user()->id])->first();
          if(!empty($admin)){
            $employees = User::where(['is_admin'=>1])->get()->toArray();
            if($employee_id == NULL){
            $campaigns = Source::get()->toArray();
            }else{
            $campaigns = Source::join('relations', 'relations.assign_to_cam', '=', 'sources.id')
                ->where('relations.assign_to_employee', $employee_id)
                ->get();
            }
          }else{
            $employees = User::where(['user_id'=>auth()->user()->id,'is_admin'=>'1'])->get()->toArray();
            $campaigns = Source::where(['assign_to_manager'=>auth()->user()->id])->get()->toArray();
          }
        // $data = Lead::where(['asign_to'=>auth()->user()->id])->where('status','!=','1')->groupBy(DB::raw('source_id'))->groupBy(DB::raw('DATE(updated_at)'))->orderBy('updated_at', 'desc')->with('source')->get();
        return view('employees.man_daily_report')->with(['employees'=>$employees,'data'=>$data,'employee_id'=>$employee_id,'campaigns'=> $campaigns,'campaign_id'=> $campaign_id,'date_from'=>$date_from,'date_to'=>$date_to]);
    }


    public function performace($id){

        //dd('herer');
        if(request()->get('camp_id')){
            $camp_id =  $_GET['camp_id']; 
        }else{
            $camp_id =  "";
        }
        
        if(request()->get('emp_id')){
            $emp_id =  $_GET['emp_id']; 
            }else{
                $emp_id =  "";
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
     //  $campaigns = Source::get()->toArray();
       $campaigns = Lead::where(['asign_to'=>$emp_id])
                   ->with('source')
                   ->groupBy('source_id')
                    ->get()->toArray();
                    // dd($campaigns);
       return view('employees.single_emp_performace')->with(['campaigns'=>$campaigns,'camp_id'=>$camp_id,'emp_id'=>$emp_id ,'date_from'=>$date_from,'date_to'=>$date_to]);
    }
    public function single_emp_views()
    {
          if(request()->get('camp_id')){
              $camp_id =  $_GET['camp_id']; 
          }else{
              $camp_id =  "";
          }
          if(request()->get('emp_id')){
            $emp_id =  $_GET['emp_id']; 
            }else{
                $emp_id =  "";
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
            if(request()->get('emp_id')){
            $data = $data->where(['asign_to'=> request()->get('emp_id')]);
        }

        if(request()->get('camp_id') && request()->get('emp_id')){
            $data = $data->where('source_id', '=', $_GET['camp_id'])->where('asign_to', '=', $_GET['emp_id']);

        }
        if(request()->get('date_from') && request()->get('date_to')){
          
            $from = date($_GET['date_from']);
            $to = date($_GET['date_to']);

            $data = $data->whereBetween('created_at', [$from, $to]);
         
        }

        // $data =  $data->whereHas('users', function ($query) {
        //             $query->where(['user_id'=>auth()->user()->id]);
        //   })->with('source')->get()->toArray();
        if(auth()->user()->is_admin == 2){
            $data =  $data->whereHas('users', function ($query) {
                     $query->where(['user_id'=>auth()->user()->id]);
           })->with('source')->get()->toArray();
        }else{
            $data =  $data->with('source')->get()->toArray();
        }
       $campaigns = Lead::where(['asign_to'=>$emp_id])
                   ->with('source')
                   ->groupBy('source_id')
                    ->get()->toArray();
         return view('employees.single_emp_view')->with(['campaigns'=>$campaigns,'data'=>$data,'camp_id'=>$camp_id,'date_from'=>$date_from,'date_to'=>$date_to]);
    }
    public function new_emp_per(){
        
        $pending = new Lead;
        $failed = new Lead;
        $closed = new Lead;
        if(request()->get('emp_id')){
            $pending = $pending->where('asign_to', '=', $_GET['emp_id']);
            $failed = $failed->where('asign_to', '=', $_GET['emp_id']);
            $closed = $closed->where('asign_to', '=', $_GET['emp_id']);
        }
        //dd(request()->get('campaign_id'));
        if(request()->get('camp_id')){
            $pending = $pending->where('source_id', '=', $_GET['camp_id']);
            $failed = $failed->where('source_id', '=', $_GET['camp_id']);
            $closed = $closed->where('source_id', '=', $_GET['camp_id']);
         
        }
        if(request()->get('emp_id') && request()->get('camp_id')){
           // dd(request()->get('employee_id'));
            $pending = $pending->where(['source_id'=> request()->get('camp_id')])->where(['asign_to'=> request()->get('emp_id')]);
            $failed = $failed->where(['source_id'=> request()->get('camp_id')])->where(['asign_to'=> request()->get('emp_id')]);
            $closed = $closed->where(['source_id'=> request()->get('camp_id')])->where(['asign_to'=> request()->get('emp_id')]);
      
        }
        //dd($pending);
       if(request()->get('date_from') && request()->get('date_to')){
          
            $from = date($_GET['date_from']);
            $to = date($_GET['date_to']);
           // dd($from);
            $pending = $pending->whereBetween('updated_at', [$from, $to]);
            $failed = $failed->whereBetween('updated_at', [$from, $to]);
            $closed = $closed->whereBetween('updated_at', [$from, $to]);
         
        }
     
        // $pending =  $pending->whereHas('users', function ($query) {
        //          $query->where(['user_id'=>auth()->user()->id,'status'=>'1']);
        //  })->count();
        //  dd( $pending);
         $pending =  $pending->where(['status'=>'1'])->count();
         $failed =  $failed->where(['status'=>'2'])->count();
         $closed =  $closed->where(['status'=>'3'])->count();

        //  $failed =  $failed->whereHas('users', function ($query) {
        //             $query->where(['user_id'=>auth()->user()->id,'status'=>'2']);
        //  })->count();
         
         
        //  $closed =  $closed->whereHas('users', function ($query) {
        //             $query->where(['user_id'=>auth()->user()->id,'status'=>'3']);
        //  })->count();
        
     
        //dd(json_encode($closed));
     
        /*if (isset($_GET['employee_id'])) {
              $employee_id =  $_GET['employee_id'];
          }else{
              $employee_id =  "";
          }
        //dd($employee_id);
        
        if(empty($employee_id)){
            
            $pending = Lead::where(['user_id'=>auth()->user()->id,'status'=>'1'])->count();
            $failed = Lead::where(['user_id'=>auth()->user()->id,'status'=>'2'])->count();
            $closed = Lead::where(['user_id'=>auth()->user()->id,'status'=>'3'])->count();
            
           // $data['employee']->name = "Total Leads";
            
        }else{
            $pending = Lead::where(['user_id'=>auth()->user()->id,'asign_to'=>$employee_id,'status'=>'1'])->count();
            $failed = Lead::where(['user_id'=>auth()->user()->id,'asign_to'=>$employee_id,'status'=>'2'])->count();
            $closed = Lead::where(['user_id'=>auth()->user()->id,'asign_to'=>$employee_id,'status'=>'3'])->count();
            
            //$data['employee'] = User::where(['id'=>$employee_id])->select('name')->first();
        }
      */
        
        $data = array(

            array(
                    'value'=> $pending,
                    'color'=> "#009efb",
                    'highlight'=> "#009efb",
                    'label'=> "Pending Leads"
            ), array(
                    'value'=> $failed,
                    'color'=> "#e30022",
                    'highlight'=>"#e30022",
                    'label'=> "Failed Leads",
            ),
            array(
                    'value'=> $closed,
                    'color'=> "#55ce63",
                    'highlight'=> "#55ce63",
                    'label'=> "Closed Leads",
            )
          
      );
      
      //  $employees = User::where(['user_id'=>auth()->user()->id,'is_admin'=>'1'])->get()->toArray();
     //    return view('employees_performance')->with(['employees'=>$employees,'data'=>$data]);
         
        return response()->json($data);
    }

}
