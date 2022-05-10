@extends('layouts.admin')

 
@section('content')

<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Installment Details</li>
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
                                <h4 class="m-b-0 text-white">Installment Details</h4>
                            </div>

                            <div class="card-body">
                                <!--<h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>-->

                    
                          
                                    <div class="form-body">
                                        
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Lead Name</label>
                                                    <h6 class="card-subtitle">{{$data['lead_name']}}</h6>
                                                </div>
                                            </div>
                                   
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Email</label>
                                                     <h6 class="card-subtitle">{{$data['email']}}</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Phone No</label>
                                                     <h6 class="card-subtitle">{{$data['contact_number_1']}}</h6>
                                                </div>
                                            </div>
                                   
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Source</label>
                                                     <h6 class="card-subtitle">{{$data['source']['source_name']}}</h6>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Gross Amount</label>
                                                     <h6 class="card-subtitle">{{$data['total_amount']}}</h6>
                                                </div>
                                            </div>
                                   
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">No of Installments</label>
                                                      <h6 class="card-subtitle">{{$data['no_of_installment']}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                     
                               
                                   
                                       
                                        
                                    </div>
                                   
                      
                    
                          
                                <div class="table-responsive m-t-40">

                                	
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                       
                                                <th>Sr. No</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                @if(auth()->user()->is_admin == 0)
                                                <th>Action</th>
                                                @endif
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['installments'] as $record)
                                            <tr>
                                                <td>{{ $record['id'] }}</td>
                                                <td>{{ $record['amount'] }}</td>
                                                <td>{{ $record['date'] }}</td>
                                                
                                                 @if($record['status'] == 1)
                                                    <td><span class="label label-danger">Unpaid</span></td>
                                                @else
                                                    <td><span class="label label-success">Paid</span></td>
                                                @endif
                                                
                                                @if(auth()->user()->is_admin == 0)
                                                <td><span class="label label-info">Paid</span></td>
                                                @endif


                                               
                      
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
  
@endsection

