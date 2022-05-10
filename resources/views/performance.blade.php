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
                        <li class="breadcrumb-item active">Analysis</li>
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
     


                 <div class="row" style="display: none;">
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
                                <h4 class="card-title">Leads</h4>
                                <div id="morris-donut-right"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Monthly Chart</h4>
                                <div id="morris-bar-chart"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Yearly Chart</h4>
                                <ul class="list-inline text-center m-t-40">
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #009efb"></i>Pending</h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #e30022"></i>Failed</h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #55ce63"></i>Closed</h5>
                                    </li>
                                </ul>
                                <div id="extra-area-chart"></div>
                            </div>
                        </div>
                    </div>

              
               <!-- <div class="row">
                    <div class="col-lg-12 col-md-7">
                    <div id="morris-area-chart2" style="height: 405px; display: none;"></div>
                        <div class="card card-default">

                            <div class="card-header">
                                <div class="card-actions">
                                    <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                                    <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                    <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                                </div>
                                <h4 class="card-title m-b-0">Company Performance</h4>
                            </div>

                            <div class="card-body collapse show">
                                <div id="morris-donut-chart" class="ecomm-donute" style="height: 317px;"></div>
                                <ul class="list-inline m-t-20 text-center">
                                    <li>
                                        <h6 class="text-muted"><i class="fa fa-circle text-info"></i> Pending</h6>
                                        <h4 class="m-b-0">4</h4>
                                    </li>
                                    <li>
                                        <h6 class="text-muted"><i class="fa fa-circle text-danger"></i> Failed</h6>
                                        <h4 class="m-b-0">2</h4>
                                    </li>
                                    <li>
                                    <h6 class="text-muted"> <i class="fa fa-circle text-success"></i> Closed</h6>
                                        <h4 class="m-b-0">12</h4>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>--->


          
  
         
         

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