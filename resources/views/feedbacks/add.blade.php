
@extends('layouts.admin')
<style>
    form label {
    font-weight: 700 !important;
    color: #081840 !important;
}
.row-changed .form-group {
    position: relative;
}

.row-changed .form-group .control-label {
    position: absolute;
    left: 5px;
    top: -10px;
    background: #fff;
    padding: 0 7px;
}
</style>



 
@section('content')

<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Feedback</li>
                    </ol>
                </div>
                <div>
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
                                <h4 class="m-b-0 text-white">Add Feedback</h4>
                            </div>

                            <div class="card-body">

                    
                          <form action="{{route('feedbacks.store')}}" method="post">
                          	@csrf
                                    <div class="form-body">
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Job Title</label>
                                                     <h6 class="card-subtitle">{{$data['lead_name']}}</h6>
                                                </div>
                                            </div>
                                   
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Prospect Email</label>
                                                     <h6 class="card-subtitle">{{$data['prospect_email']}}</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
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


                                        <div class="row row-changed">
                                          
                                  
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Feedback</label>
                                                    <input type="hidden" class="form-control" name="lead_id" placeholder="Lead Id" value="{{$data['id']}}">
                                                    <textarea type="text" class="form-control" name="feedback" placeholder="Enter Feedback" >@if($data['feedback']) {{$data['feedback']['feedback']}}  @endif</textarea>
                                                    @if($errors->has('feedback'))
                                                        <div class="alert alert-danger">{{ $errors->first('feedback') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                           
                                        </div>
                                     
                               
                                   
                                  <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                         <input type="reset" class="btn btn-inverse" value="Cancel" />
                                           <button type="button" class="btn btn-info" onclick="window.history.back()">Back</button>
                                    </div>

                                    </form>     
                                        
                                    </div>
                                   
                      
                    
                          
                                
                            </div>
                        </div>

                    </div>
                </div>

               
        </div>
  
@endsection

