<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lead;
use App\Models\Installment;
use App\Models\User;

use Validator;

class InstallmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data = Lead::where(['asign_to'=>auth()->user()->id, 'status'=>3])->with('source')->get()->toArray();
         //print_R($data);die;
         return view('installments.list')->with(['data'=>$data]);
    }


    public function installment(Request $request)
    {

        $data = [];

         $employees = User::where(['user_id'=>auth()->user()->id,'is_admin'=>'1'])->get()->toArray();
         return view('installments.installment')->with(['data'=>$data, 'employees'=>$employees]);
    }

    public function searchInstallment(Request $request)
    {

        if($request->has('employee_id') && !empty($request->input('employee_id'))) {
            $data = Lead::where(['user_id'=>auth()->user()->id, 'asign_to'=>$request->employee_id, 'status'=>3])->with('source')->get()->toArray();
        } else {
            $data = [];
        }

         $employees = User::where(['is_admin'=>'1'])->get()->toArray();
         return view('installments.installment')->with(['data'=>$data, 'employees'=>$employees]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('installments.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'total_amount' => 'required',
            'no_of_installment' => 'required',
            'amount' => 'required|array',
            'date' => 'required|array',
       ]);



        if ($validator->passes()) {

            $data = array(
                'total_amount'=>$request->total_amount,
                'no_of_installment'=>$request->no_of_installment
            );

            //Lead::where('id', $leadid)->update(['asign_to'=>$request->employee_id]);
            
            //Source::create($data);

            return response()->json(['success'=>$request->all()]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function view($id)
    {

        $data =  Lead::where(['id'=>$id])->with('source')->with('installments')->first();
        return view('installments.view')->with(['data'=>$data]);
    }


}
