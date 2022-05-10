@extends('layouts.admin')

 
@section('content')

<style type="text/css">
    th {
        white-space: break-spaces;
    }
</style>

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
                                <h4 class="m-b-0 text-white">Analysis</h4>
                            </div>

                            <div class="card-body">
                                <!--<h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>-->
                                <!--<div style="text-align: center;">
                                <img src="{{ url('public/img/cun.png') }}">
                                </div>-->

                
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Source Name</th>
                                                <th>Total Leads</th>
                                                <th>Unsigned Leads</th>
                                                <th>Pending Leads</th>
                                                <th>Closed Leads</th>
                                                <th>Failed Leads</th>
                                                <!--<th>Amount Invested</th>
                                                <th>Amount Generated</th>
                                                <th>Amount Received</th>-->

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $data)
                                            <tr>
                                                <td>{{$data['source_name']}}</td>
                                                <td>{{$data['total_leads']}}</td>
                                                <td>{{$data['unassigned_leads']}}</td>
                                                <td>{{$data['pending_leads']}}</td>
                                                <td>{{$data['closed_leads']}}</td>
                                                 <td>{{$data['failed_leads']}}</td>
                                                <!--<td>{{$data['total_amount']}}</td>
                                                <td>{{$data['amount_genrated']}}</td>
                                                <td>{{$data['amount_received']}}</td>--->
                                               
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                                        
                                    </div>
                                   
                      
                    
                          
                                
                            </div>
                        </div>

                    </div>



                </div>

               
        </div>
  
@endsection

