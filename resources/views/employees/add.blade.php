@extends('layouts.admin')

 
@section('content')
<style>
      .control-label {
            font-weight: 500;
    }
    
    .vw-lead .col-md-4 {
    background: #fff;
}
.vw-lead .col-md-4 .form-group {
    background: #ffffff;
    padding: 10px 15px;
    text-align: center;
    text-transform: uppercase;
    height: 100%;
    left: 14px;
    position: absolute;
    top: -8px;
    z-index: 5;
    padding-left: 8px;
}
    
.vw-lead .control-label {
    font-weight: 500;
    height: 100%;
    /* vertical-align: top; */
    align-items: center;
    display: flex;
    justify-content: center;
    margin: 0;
    color: #222;
    font-weight: 600;
}
    
    .vw-lead.form-body .col-md-8 {
    border: 1px solid #efefef;
    padding-right: 0 !important;
    max-width: 64.5% !important;
    padding:0;
}
    
    .form-body.vw-lead {
    display: inline-block;
    width: 100%;
    padding-left: 15px;
}

    .vw-lead.form-body .form-group {
    margin-bottom: 0;
}
.vw-lead.form-body .form-group .statusbtnmargin {
    margin-bottom: 16px;
    margin-left: 20px;
}
.vw-lead .form-body {
    padding-left:13px;
}
.col-md-6.show_lead .form-group input.form-control{
/* height:calc(2.5em + 1.75rem + 0px) !important; */
height:47px !important;
color: #747474;
padding-left: 20px;
}
.col-md-6.show_lead .form-group input.form-control::-webkit-input-placeholder { 
color: #747474;
}

.col-md-6.show_lead .form-group input.form-control:-ms-input-placeholder { /* Internet Explorer 10-11 */
  color: #747474;
}

.col-md-6.show_lead .form-group input.form-control::placeholder {
  color: #747474;
}
    @media screen and (max-width: 767px) { 
  .vw-lead .col-md-8 .form-group input {
    text-align: center;
}

.vw-lead.form-body .col-md-8 { 
    max-width: 100% !important;
}

}

    </style>
<?php
$managers = App\Models\User::where('is_admin', 2)->get();

?>
<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('employees') }}">Employees</a></li>
                        <li class="breadcrumb-item active">Add Employee</li>
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
                                <h4 class="m-b-0 text-white">Add Employee</h4>
                            </div>
                            <div class="card-body">
                                <form method='post' action="{{ route('employees.store') }}">
                                    @csrf
                                    <div class="form-body add_custom_table">
                                        <!--<h3 class="card-title">Add Employee Details</h3>
                                        <hr>-->
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">First Name</label>
                                                    <input type="text" id="first_name" name='first_name'class="form-control" placeholder="Enter First Name" value="{{ old('first_name') }}">
                                                    @if($errors->has('first_name'))
                                                        <div class="alert alert-danger">{{ $errors->first('first_name') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Last Name</label>
                                                    <input type="text" id="last_name" name='last_name' class="form-control form-control-danger" placeholder="Enter Last Name" value="{{ old('last_name') }}">
                                                    @if($errors->has('last_name'))
                                                        <div class="alert alert-danger">{{ $errors->first('last_name') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Phone No</label>
                                                    <input type="text" id="phone_no"  name='phone_no' class="form-control" placeholder="Enter Phone No" value="{{ old('phone_no') }}">
                                                    @if($errors->has('phone_no'))
                                                        <div class="alert alert-danger">{{ $errors->first('phone_no') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Email</label>
                                                    <input type="text" id="email" name='email' class="form-control" placeholder="Enter Email" value="{{ old('email') }}">
                                                    @if($errors->has('email'))
                                                        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Address</label>
                                                    <input type="text" id="address" name='address' class="form-control" placeholder="Enter Address" value="{{ old('address') }}">
                                                    @if($errors->has('address'))
                                                        <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            @if(auth()->user()->is_admin == 0)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Select Manager</label>
                                                    <select name="manager" class="form-control custom-select" data-placeholder="Select Manager" tabindex="1" required>
                                                        <option value="">Select Manager</option>
                                                        <?php foreach($managers as $manager) { ?>
                                                        <option value='{{ $manager->id }}'>{{ $manager->name }}</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            @endif

                                            <!--/span-->
                                        </div>

                                        <!--/row-->
                                
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <input type="reset" class="btn btn-inverse" value="Cancel" />
                                          <a href="{{ url('employees') }}"><button type="button" class="btn btn-info">Back</button></a>

                                         
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

