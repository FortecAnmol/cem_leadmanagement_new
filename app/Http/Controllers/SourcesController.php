<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Source;
use App\Models\Money;
use App\Models\User;
use App\Http\Requests\SourceRequest;
use App\Models\Lead;
use App\Models\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SourcesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $admin = User::where(['is_admin'=>Null,'id'=>auth()->user()->id])->first();
        if(!empty($admin)){
            $data = Source::select("*", DB::raw('(SELECT SUM(amount) FROM money WHERE money.source_id = sources.id) as amount'))->with('closed_leads')->get()->toArray();

        }else{
            $data = Source::where(['user_id'=>auth()->user()->id])->orWhere(['assign_to_manager'=>auth()->user()->id])->select("*", DB::raw('(SELECT SUM(amount) FROM money WHERE money.source_id = sources.id) as amount'))->with('closed_leads')->get()->toArray();
        }
         return view('sources.list')->with(['data'=>$data]);
    }


    public function create()
    {
         return view('sources.add');
    }
    public function create_campaign($id)
    {
         $source = Source::where('id',$id)->first();
         return view('sources.add_campaign')->with(['source'=>$source]);
    }


    public function store(Request $request)
    {
        /*$data = array(
            'source_name'=>$request->source_name
        );
        
        Source::create($data);
        
        return redirect('sources')->with('success', 'Source Added Successfully.');*/


        $validator = Validator::make($request->all(), [
            'source_name' => 'required|min:3|max:20',
            'description' => 'required|min:3|max:255',
        ]);


        if ($validator->passes()) {


            $data = array(
                'user_id'=>auth()->user()->id,
                'source_name'=>$request->source_name,
                'description'=>$request->description
            );
            //dd($data);
            Source::create($data);

            return response()->json(['success'=>'Added new records.']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = Source::where(['id'=>$id])->first();
        return view('sources.edit')->with(['data'=>$data]);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(), [
                'source_name' => 'required|min:3',
                'description' => 'required|min:3|max:255',
                'start_date' => 'required',
                'end_date' => 'required',
            ],
            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $input = $request->all(); 

        $data = Source::find($id);
        
        $data->source_name = $input['source_name'];
        $data->description = $input['description'];
        $data->start_date = date('Y-m-d', strtotime($input['start_date']));
        $data->end_date = date('Y-m-d', strtotime($input['end_date']));
        $data->save();

        return redirect('sources')->with('success', 'Source Updated Successfully.');
    }

    public function camp_assign(Request $request, $id)
    {  
        $data = Source::where(['id'=>$id])->first();    
        if(empty($data->assign_to_manager)){
            $data->assign_to_manager = $request->assignedTo;

            $all_leads_data = Lead::where('source_id', $id)->get(); 
            foreach($all_leads_data as $leadid) {
            Lead::where('id', $leadid->id)->update(['asign_to_manager'=>$request->assignedTo]);
            }
        }
        $data->save();
        return redirect('sources')->with('success', 'Campaign Assigned Successfully');
    }

    public function destroy($id)
    {
        //
    }

     public function delete($id)
    {

        $source = Source::findOrFail($id);
        $lead = Lead::where('source_id',$id);
        $relation = Relation::where('assign_to_cam',$id);
        $relation->delete();
        $lead->delete();
        $source->delete();
        return redirect('sources')->with('success', 'Source Deleted Successfully.');
    }

    public function updateAmount(Request $request)
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

             $data = array(
                'source_id'=>$request->source_id,
                'amount'=>$request->amount,
                 'date'=>$request->date
            );
            
            //print_r($data); dd();
            Money::create($data);

            //Lead::where('source_id', $request->source_id)->update([]);
            return response()->json(['success'=>'Updated Successfully.']);
    }
}
