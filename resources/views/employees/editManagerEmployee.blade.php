@extends('layouts.admin')

 
@section('content')

<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('employees') }}">Employees</a></li>
                        <li class="breadcrumb-item active">Edit Employee (Manager)</li>
                    </ol>
                </div>
                <div>
                    <!--<button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>--->
                </div>
            </div>


  <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Edit Employee  (Manager)</h4>
                            </div>
                            <div class="card-body">
                                    <form method='post' action="{{route('employees.updateManagerEmployee', [$data->id])}}" enctype="multipart/form-data">
                                   @csrf
                                    {{ method_field('PATCH') }}
                                    <div class="form-body">
                                        <!--<h3 class="card-title">Add Employee Details</h3>
                                        <hr>-->
                                        <div class="row p-t-20">
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Select Manager</label>
                                              
                                                    
                                                    
                                                      <select name="manager_id" id="manager_id" class="form-control custom-select">

                                                    <option value="">Select Manager</option>
                                                    @foreach($managers as $managers)
                                                        <option value="{{$managers['id']}}" {{ ( $managers['id'] == $data->user_id) ? 'selected' : '' }}>
                                                        {{$managers['name']}}
                                                        </option>
                                                    @endforeach
                                                    </select>
                                                    @if($errors->has('manager_id'))
                                                        <div class="alert alert-danger">{{ $errors->first('manager_id') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">First Name</label>
                                                    <input type="text" id="first_name" name='first_name'class="form-control" placeholder="Enter First Name" value="{{old('first_name', $data->first_name)}}">
                                                    @if($errors->has('first_name'))
                                                        <div class="alert alert-danger">{{ $errors->first('first_name') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                            
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Last Name</label>
                                                    <input type="text" id="last_name" name='last_name' class="form-control form-control-danger" placeholder="Enter Last Name" value="{{old('last_name', $data->last_name)}}">
                                                    @if($errors->has('last_name'))
                                                        <div class="alert alert-danger">{{ $errors->first('last_name') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Phone No</label>
                                                    <input type="text" id="phone_no"  name='phone_no' class="form-control" placeholder="Enter Phone No" value="{{old('phone_no', $data->phone_no)}}">
                                                    @if($errors->has('phone_no'))
                                                        <div class="alert alert-danger">{{ $errors->first('phone_no') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                            
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Email</label>
                                                    <input type="text" id="email" name='email' class="form-control" placeholder="Enter Email" value="{{old('email', $data->email)}}">
                                                    @if($errors->has('email'))
                                                        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Address</label>
                                                    <input type="text" id="address" name='address' class="form-control" placeholder="Enter Address" value="{{old('address', $data->address)}}">
                                                    @if($errors->has('address'))
                                                        <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>

                                        <!--/row-->
                                
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <input type="reset" class="btn btn-inverse" value="Cancel" />
                                          <a href="{{ url('managers') }}"><button type="button" class="btn btn-info">Back</button></a>

                                         
                                    </div>
                                </form>
                                 
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
        
               
       
               
               
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme working">4</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                                <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                                <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>Chat option</b></li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
  
@endsection

