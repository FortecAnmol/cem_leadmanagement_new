<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Lead;
use App\Models\Note;
use App\Http\Requests\NoteRequest;
use App\Models\Source;
use Illuminate\Support\Facades\DB;

class NotesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //print_R(auth()->user()->id);die;
         $data = Lead::with('source')->with('note')->with('notes')->where(['status'=>'1','asign_to'=>auth()->user()->id])->get()->toArray();
        //  dd($data[0]['note']['feedback']);
         return view('notes.list')->with(['data'=>$data]);
    }
    public function in_progress()
    {
        //print_R(auth()->user()->id);die;
         $data = Lead::with('source')->where(['status'=>'4','asign_to'=>auth()->user()->id])->get()->toArray();
         return view('notes.in_progress_list')->with(['data'=>$data]);
    }

    
    public function create()
    {
        //
    }

    public function add($id)
    {
        $data =  Lead::where(['id'=>$id])->first();
        $lead_ID = $id;
        return view('notes.add')->with(['data'=>$data,'lead_ID'=>$lead_ID]);
    }

    


    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {

        //$data =  Lead::where(['id'=>$id])->with('note')->first()->toArray();
       //dd($data['note']);
        $data =  Note::where(['id'=>$id])->first()->toArray();

        return view('notes.edit')->with(['data'=>$data]);
    }

    
    public function update(NoteRequest $request, $id)
    {
         $data = array(
            'reminder_date'=>$request->reminder_date,
            'reminder_time'=>$request->reminder_time,
            'reminder_for'=>$request->reminder_for,
            'feedback'=>$request->note,
        );

         Note::where('id', $id)->update($data);

        return Redirect::back()->with('success', 'Note Updated Successfully.');
    }

    
    public function destroy($id)
    {
        //
    }
    // public function view($id)
    // {

    //     $data =  Lead::where(['id'=>$id])->with('source')->with('notes')->first();
    //     return view('notes.view')->with(['data'=>$data]);
    // }

    public function view(Request $request)
    {
        $notes_data =  Lead::where(['id'=>$request->lead_id])->with('source')->with('notes')->first();
        $sources_data = Source::where(['id'=>$notes_data->source_id])->first();
        $table = '
        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
        <th>Lead Name</th>
        <th  width="400">Note</th>
        <th>Reminder Date</th>
        <th>Reminder Type</th>  
    </tr>
        </thead>
        <tbody>';
         if(!empty($notes_data)){
            foreach($notes_data['notes'] as $key=> $table_data){
                $table .=  '<tr><td class="wraping"> '.$notes_data->prospect_first_name.' '.$notes_data->prospect_last_name.' </td>
                <td class="wraping notes_comment" ><p style="white-space: initial; max-height: 100px; overflow-y : auto;";> '.$table_data->feedback.'</p> </td>
                <td class="wraping"> '.date("d-m-Y", strtotime($table_data->reminder_date)).' </td>
                <td class="wraping"> '.$table_data->reminder_for.' </td>
                </tr>';
            }
        }else{
            $table .=  '<tr><td class="wraping">  </td>
            <td class="wraping">  </td>
            <td class="wraping"> Data Not Found </td>
            <td class="wraping">  </td>
            <td class="wraping">  </td></tr>';  
        }
        return response()->json(['notes_data'=>$notes_data, 'table'=>$table]);
        // return view('notes.view')->with(['data'=>$data]);
    }
        public function store(NoteRequest $request)
    {
        if(empty($request->reminder_date)){
            return response()->json(['error'=>'Please add a note first.']);
         }else{
         $data = array(
            'user_id'=>auth()->user()->id,
            'lead_id'=>$request->lead_id,
            'reminder_date'=>$request->reminder_date,
            'reminder_time'=>$request->reminder_time,
            'reminder_for'=>$request->reminder_for,
            'feedback'=>$request->note,
        );
        Note::create($data);
        return Redirect::back()->with('success', 'Note Added Successfully.');
    }
    }
    public function camp_assign_emp(){
        $data =  Lead::where(['asign_to'=>auth()->user()->id])->with('source')->select('*', DB::raw('COUNT(source_id) as totalLeads'))->groupBy('source_id')->get();
        return view('notes.camp_assign_emp')->with(['data'=>$data]);
    }
    public function view_camp($id){
        
        $data = Lead::with('source')->where(['status'=>'1','asign_to'=>auth()->user()->id,'source_id'=>$id])->get()->toArray();
        return view('notes.particular_camp_assign_emp')->with(['data'=>$data]);
    }

    
}
