<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Hash;

use App\Models\User;

use App\Http\Requests\ProfileUpdateRequest;


class ProfileController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function profile()
    {
       
        $data = User::where(['id'=>auth()->user()->id])->first();
        return view('profiles.profile')->with(['data'=>$data]);
    }

    public function profileUpdate(ProfileUpdateRequest $request)
    {

        if ($request->hasFile('image')) {

            if ($request->file('image')->isValid()) {


               /* $validated = $request->validate([
                    'image' => 'mimes:jpeg,png|max:1014',
                ]);*/
                
                $extension = $request->image->extension();
                $image_name = time().".".$extension;
                $request->image->storeAs('/images', $image_name);
            }else{
                $image_name ="";
            }
        }else{
            $image_name ="";
        }

    
       
       $data = array(
            'prospect_first_name'=>$request->prospect_first_name,
            'prospect_last_name'=>$request->prospect_last_name,
            'name'=>$request->prospect_first_name." ".$request->prospect_last_name,
            //'email'=>$request->email,
            //'contact_number_1'=>$request->contact_number_1,
            'address'=>$request->address,
            'image'=>$image_name,  
              
        );

       User::where('id', auth()->user()->id)->update($data);
        
        return redirect('profile')->with('success', 'Profile Updated Successfully.');
        
        
    }
    
}
