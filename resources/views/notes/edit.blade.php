@extends('layouts.admin')

 
@section('content')

<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('notes') }}">Notes</a></li>
                        <li class="breadcrumb-item active">Edit Note</li>
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
                                <h4 class="m-b-0 text-white">Edit Note</h4>
                            </div>

                            <div class="card-body">
                                <!--<h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>-->

                    
                          <form action="{{route('notes.update', [$data['id']])}}" method="post" >
                          	@csrf
                            {{ method_field('PATCH') }}
                                    <div class="form-body add_custom_table">
                                        
                                        
                                        <div class="row p-t-20">
                                            

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Reminder Date</label>
                                                    <!--<input type="date" class="form-control" placeholder="Reminder Date" name="reminder_date" value="{{$data['reminder_date']}}">--->

                                                    <input type="text" class="form-control" placeholder="Reminder Date" name="reminder_date" value="{{$data['reminder_date']}}" id="min-date">

                                                    @if($errors->has('reminder_date'))
                                                        <div class="alert alert-danger">{{ $errors->first('reminder_date') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>


                                         <div class="row p-t-20">
                                            
                                   
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Reminder For</label>
                                                    <input type="text" class="form-control" placeholder="Reminder For" name="reminder_for" value="{{$data['reminder_for']}}">
                                                    @if($errors->has('reminder_for'))
                                                        <div class="alert alert-danger">{{ $errors->first('reminder_for') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>



                                         <div class="row p-t-20">
                                            
                    
                                             <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Note</label>
                                                    <textarea type="text" class="form-control" name="note" placeholder="Enter Note" style="min-height: 130px;">{{$data['feedback']}}</textarea>
                                                    @if($errors->has('note'))
                                                        <div class="alert alert-danger">{{ $errors->first('note') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>


                                     
                               
                                   
                                  <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
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

