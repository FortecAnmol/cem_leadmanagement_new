@extends('layouts.admin')


   <!-- <link href="{{ asset('public/admin/assets/plugins/morrisjs/morris.css') }}" rel="stylesheet"> -->
    
    
@section('content')

<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
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
                @if(auth()->user()->is_admin == null)
                       <div class="card-group">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <a href="{{ url('leads') }}">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="fa fa-calculator text-warning"></i></h2>
                                    <h3 class="">{{ $totalLeads }}</h3>
                                    <h6 class="card-subtitle">Campaign Total Leads</h6></div>
                                </a>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <a href="{{ url('leads/?status=1') }}">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="fa fa-clock-o text-info"></i></h2>
                                    <h3 class="">{{ $totalPendingLeads }}</h3>
                                    <h6 class="card-subtitle">Campaign Total Pending Leads</h6></div>
                                </a>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                 <a href="{{ url('leads/?status=3') }}">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="fa fa-check text-success"></i></h2>
                                    <h3 class="">{{ $totalClosedLeads }}</h3>
                                    <h6 class="card-subtitle">Campaign Total Closed Leads</h6></div>
                                </a>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                 <a href="{{ url('leads/?status=2') }}">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="fa fa-exclamation-triangle text-danger"></i></h2>
                                    <h3 class="">{{ $totalFailedLeads }}</h3>
                                    <h6 class="card-subtitle">Campaign Total Failed Leads</h6></div>
                                </a>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif


                @if(auth()->user()->is_admin == null)
                 <div class="row">
                    <div class="col-lg-6" style="">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Users</h4>
                                <div id="morris-donut-left"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6" >
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Campaign Leads</h4>
                                <div id="morris-donut-right"></div>
                            </div>
                        </div>
                    </div>

                </div>
                @endif

                @if(auth()->user()->is_admin == 2)
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <!-- Start Page Content -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-12">
    
                            @if (Session::has('success'))
                               <div class="alert alert-success" role="alert">
                                   {{Session::get('success')}}
                               </div>
                            @elseif (Session::has('error'))
                               <div class="alert alert-danger" role="alert">
                                   {{Session::get('error')}}
                               </div>
                            @endif
                            
                            <div class="card card-outline-info">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Campaigns</h4>
    
                                </div>
                                
                                <div id="myModal" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">Add Lable</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="ajaxform">
    
                                          <meta name="csrf-token" content="{{ csrf_token() }}" />
                                                            
                                                        <div class="alert alert-danger print-error-msg" style="display:none">
                                                            <ul></ul>
                                                        </div>
    
                                                                <div class="form-group">
                                                                    <label class="col-md-12">Date</label>
                                                                    <div class="col-md-12">
                                                                        <input type="date" class="form-control" placeholder="Date" name="date"> </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label class="col-md-12">Amount</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" class="form-control" placeholder="Amount" name="amount"> </div>
                                                                </div>
                                                                
                                                                
                                                                <input type="hidden" id="source_id" name="source_id">
                                                            </from>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-info waves-effect save-data" data-dismiss="modal">Save</button>
                                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
    
                                <div class="card-body">
                                    <div class="table-responsive m-t-40">
                                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Campaign</th>
                                                    <th>Sub-Campaign</th>
                                                    <th>Leads</th>
                                                    <th>Last Login</th>
                                                    <th>Comments since last session</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php   $count = 0;
                                              $data_new2 = App\Models\Relation::where('assign_to_manager', auth()->user()->id)->orderBy('assign_to_employee','desc')->groupBy('assign_to_employee')->get();
                                                // dd( $data);
                                                $data_new = [];
                                            foreach(  $data_new2 as $dnewdata)
                                            {
                                                $data_new[] = App\Models\User::where(['id'=>$dnewdata['assign_to_employee']])->first();
                                            }

                                              ?>
                                            @foreach($data as $data)
                                            </tr>
                                            @php
                                            $user_name = App\Models\User::where(['id'=>$data['assign_to_employee']])->first();
                                            $camp_name = App\Models\Source::where(['id'=>$data['assign_to_cam']])->first();
                                            $futureDate=date('Y-m-d h:i:s', strtotime('+1 year'));
                                            $count = App\Models\Note::where(['source_id'=>$data['assign_to_cam']])
                                            ->whereBetween('created_at', [$user_name['last_login'], $futureDate])->count();
                                            $lastlogin_new = date("d-m-Y H:m:s", strtotime($user_name->last_login));
                                            if($lastlogin_new == '01-01-1970 05:01:00')
                                            {
                                            $lastlogin = "";
                                            }
                                            else{
                                            $lastlogin = $lastlogin_new;
                                            }
                                            @endphp
                                                <td>{{$user_name->name}}</td>
                                                <td>{{$camp_name->source_name}}</td>
                                                <td>{{$camp_name->description}}</td>
                                                <td>{{$data['lead_assigned']}}</td>
                                                <td>{{$lastlogin}}</td>
                                                <td>{{$count}}</td>  
                                            </tr>       
                                            <?php  $count++;   ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
    
                        </div>
                    </div>
                    
        </div>
    
        <!-- =========== MODAL POPUP ================ -->
        @endif
    


  
         
         

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
                                    <a href="javascript:void(0)"><img src="{{ asset('public/admin/assets/images/users/1.jpg') }}" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="{{ asset('public/admin/assets/images/users/2.jpg') }}" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="{{ asset('public/admin/assets/images/users/3.jpg') }}" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="{{ asset('public/admin/assets/images/users/4.jpg') }}" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="{{ asset('public/admin/assets/images/users/5.jpg') }}" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="{{ asset('public/admin/assets/images/users/6.jpg') }}" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="{{ asset('public/admin/assets/images/users/7.jpg') }}" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="{{ asset('public/admin/assets/images/users/8.jpg') }}" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
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



 <!--
    <script src="{{ asset('public/admin/assets/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('public/admin/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('public/admin/dark/js/jquery.slimscroll.js') }}"></script>

    <script src="{{ asset('public/admin/dark/js/waves.js') }}"></script>

    <script src="{{ asset('public/admin/dark/js/sidebarmenu.js') }}"></script>

    <script src="{{ asset('public/admin/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    <script src="{{ asset('public/admin/dark/js/custom.min.js') }}"></script>

    <script src="{{ asset('public/admin/assets/plugins/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/plugins/morrisjs/morris.min.js') }}"></script>

    <script src="{{ asset('public/admin/assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('public/admin/dark/js/dashboard4.js') }}"></script>

    <script src="{{ asset('public/admin/assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>

-->