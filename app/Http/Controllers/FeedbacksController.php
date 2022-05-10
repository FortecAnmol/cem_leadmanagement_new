<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use App\Models\Lead;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Note;

use App\Http\Requests\FeedbackRequest;

class FeedbacksController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
         $employees =  User::where(['user_id'=>auth()->user()->id, 'is_admin'=>'1'])->select('id', 'name')->get()->toArray();
        // dd($employees);die;
         $data= [];
        return view('feedbacks.list')->with(['employees'=>$employees,'data'=>$data]);
    }

 
    public function create()
    {
        //
    }

    public function add($id)
    {
         $data =  Lead::where(['id'=>$id])->with('source')->with('feedback')->first()->toArray();
         //dd($data);
        return view('feedbacks.add')->with(['data'=>$data]);
    }

    public function store(FeedbackRequest $request)
    {

        $data = array(
            'lead_id'=>$request->lead_id,
            'feedback'=>$request->feedback,
        );

         $result =  Feedback::where(['lead_id'=>$request->lead_id])->first();


         if($result){

            Feedback::where('lead_id', $request->lead_id)->update(['feedback'=>$request->feedback]);
            return Redirect::back()->with('success', 'Feedback Updated Successfully.');

         }else{

            Feedback::create($data);
            return Redirect::back()->with('success', 'Feedback Added Successfully.');
         }

    
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
       
        //
    }

   
    public function destroy($id)
    {
        //
    }


    public function getFeedbacks(Request $request)
    {

        if($request->has('lead_id') && !empty($request->input('lead_id'))) {
            $data = Note::where('lead_id', $request->lead_id)->with('lead')->get()->toArray();
        } 

        if($request->has('employee_id') && !empty($request->input('employee_id'))) {
            //$data = Note::where('lead_id', $request->lead_id)->with('lead')->get()->toArray();
            $data = lead::where('asign_to', $request->employee_id)->with('notes')->get()->toArray();
        } 

        return response()->json($data);
    }

}
