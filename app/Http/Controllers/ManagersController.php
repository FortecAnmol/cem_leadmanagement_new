<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;

use App\Models\User;

use App\Http\Requests\ManagerRequest;
use App\Http\Requests\EditManagerRequest;

use Validator;

class ManagersController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::where(['is_admin'=>Null,'id'=>auth()->user()->id])->first();
        if(!empty($user)){
            $data = User::where(['is_admin'=>'2'])->get()->toArray();
        }else{
            $data = User::where(['is_admin'=>'2','user_id'=>auth()->user()->id])->get()->toArray();
        }
        
          return view('managers.list')->with(['data'=>$data]);
        
    }

    public function create()
    {
        return view('managers.add');
    }


    public function store(ManagerRequest $request)
    {

        $password = rand(10000000,99999999);

       // $manager = User::findOrFail(auth()->user()->id);
            //dd($manager);
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
            'is_admin'=>'2',
        );

        User::create($data);
        
        return redirect('managers')->with('success', 'Manager Added Successfully.');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = User::where(['id'=>$id])->first();
        return view('managers.edit')->with(['data'=>$data]);
    }


    public function update(Request $request, $id)
    {
         $validator = Validator::make(
            $request->all(), [
                'first_name' => 'required|min:3|max:20',
                'last_name' => 'required|min:3|max:20',
               //'email' => 'required|email|unique:users',
               'email' => 'required|email|unique:users,email,'.$id,
                'phone_no' => 'required|min:10|numeric|unique:users,phone_no,'.$id,
                'address' => 'required|min:3|max:30',
                'orignal_password' => 'required|min:3|max:20',

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
        
        $data->first_name = $input['first_name'];
        $data->last_name = $input['last_name'];
        $data->name = $input['first_name'].' '.$input['last_name'];
        $data->phone_no = $input['phone_no'];
        $data->email = $input['email'];
        $data->address = $input['address'];
        $data->password = $password;
        $data->orignal_password = $input['orignal_password'];

    
        $data->save();

          return redirect('managers')->with('success', 'Manager Updated Successfully.');
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
        
        
        return redirect('managers')->with('success', 'Status Changed');
        
    }

    public function delete($id)
    {
        $manager = User::findOrFail($id);
        $manager->delete();
        
        $employees = User::where(['user_id'=>$id])->delete();
        
        return redirect('managers')->with('success', 'Manager Deleted Successfully.');
    }
}
