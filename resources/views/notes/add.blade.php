@extends('layouts.admin')
<style>
    .table td, .table th {
    padding:5px 0 !important;
    font-size: 12.5px;
    padding:5px !important;
}
.table td{
    vertical-align: middle !important;
}
.table-striped tbody tr:nth-of-type(odd) {
    background: #f2f4f859 !important;
}
form label {
    margin-bottom: 0;
    color: #081840;
    font-weight: 700 !important;
}
.form-body .row-changed .form-group {
    position: relative;
}

.form-body .row-changed .form-group .control-label {
    position: absolute;
    left: 5px;
    top: -10px;
    background: #fff;
    padding: 0 7px;
}
body table tr td{
    white-space: pre-wrap !important;
}
.feedback_td {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow-y: auto;
    border: none !important;
}
/* width */
.feedback_td::-webkit-scrollbar {
  width:4px;
}

/* Track */
.feedback_td::-webkit-scrollbar-track {
  background: #f1f1f1;
}

/* Handle */
.feedback_td::-webkit-scrollbar-thumb {
  background: rgb(187, 187, 187);
}

/* Handle on hover */
.feedback_td::-webkit-scrollbar-thumb:hover {
  background: rgb(100, 100, 100);
}
span.label.label-info {
    padding: 0.7rem 0.75rem;
}
#status-modal .btn-info.disabled, #status-modal .btn-info:disabled {
    color: black;
    background-color: #dddddd;
    border-color: #dddddd;
}
#status-modal .btn-info.disabled:hover, #status-modal .btn-info:disabled:hover{
    color: black;
    background-color: #dddddd;
    border-color: #dddddd;
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
                        <li class="breadcrumb-item"><a href="{{ url('notes') }}">Notes</a></li>
                        <li class="breadcrumb-item active">Add Note</li>
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
                                <h4 class="m-b-0 text-white">Add Note</h4>
                            </div>

                            <div class="card-body">
                               	 <!-- status modal content start -->
                                <div id="status-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <form id="ajaxform">

                                             <meta name="csrf-token" content="{{ csrf_token() }}" />

                                             <div>
                                            <ul></ul>
                                        </div>

											<div class="modal-header">
                                                <h4 class="modal-title">Change Status</h4>
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                              <div class="alert alert-danger print-error-msg" style="display:none">
                                               <ul class="custom_text"></ul>
                                                </div>
                                            <div class="modal-body">
                                                
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Select Status: </label>
                                                        <select class="form-control" id="status" name="status" required>
														<option value="">Select Status</option>
                                                        <option value="4">In progress</option>
														<option value="3">Closed</option>
														<option value="2">Failed</option>
														</select>
                                                        @if($errors->has('status'))
                                                        <div class="alert alert-danger">{{ $errors->first('status') }}</div>
                                                    @endif
                                                    </div>
                                                
                                            </div>
                                            <div class="modal-footer">
											<input type="hidden" id="lead_id" name="lead_id">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                <button id="save-data" type="button" class="btn btn-info waves-effect waves-light ">Save changes</button>
                                            </div>
                                        </div>
                                         <!-- status modal content end -->
									</form>
                                    </div>
                                </div>
                    
                            <form action="{{route('notes.store')}}" method="post">
                                @csrf
                                    <div class="form-body">
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                     <label class="control-label">Lead Name</label>
                                                    <h6 class="card-subtitle">{{$data['prospect_first_name'].' '.$data['prospect_last_name']}}</h6>
                                                </div>
                                            </div>
                                   
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                      <label class="control-label">Email</label>
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


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Date</label>
                                                    <h6 class="card-subtitle">{{$data['created_at']}}</h6>
                                                </div>
                                            </div>
                                        </div>


                                         <div class="row p-t-20 row-changed">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Reminder Date</label>
                                                    <!--<input type="date" class="form-control" placeholder="Reminder Date" name="reminder_date" value="{{ old('reminder_date') }}">-->

                                                      <input type="text" class="form-control" placeholder="Reminder Date" name="reminder_date" value="{{ old('reminder_date') }}" id="min-date">

                                                    @if($errors->has('reminder_date'))
                                                        <div class="alert alert-danger">{{ $errors->first('reminder_date') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                   
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Reminder For</label>
                                                    <input type="text" class="form-control" placeholder="Reminder For" name="reminder_for" value="{{ old('reminder_for') }}">
                                                    @if($errors->has('reminder_for'))
                                                        <div class="alert alert-danger">{{ $errors->first('reminder_for') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row  row-changed">
                                          
                                   
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Note</label>
                                                    <input type="hidden" class="form-control" name="lead_id" placeholder="Lead Id" value="{{$data['id']}}">
                                                    <textarea type="text" class="form-control" name="note" placeholder="Enter Note" style="min-height: 130px;">{{ old('note') }}</textarea>
                                                    @if($errors->has('note'))
                                                        <div class="alert alert-danger">{{ $errors->first('note') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                     
                               
                                   
                                  <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                         <input type="reset" class="btn btn-inverse" value="Cancel" />
                                       <?php 
                                       if(!isset($_COOKIE['get_last_url'])) {
                                        $last_url = redirect()->getUrlGenerator()->previous();
                                    } else {
                                        $last_url =  $_COOKIE['get_last_url'];
                                    }
                                    ?>
                                            <a href="{{ $last_url }}"><button type="button" class="btn btn-info">Back</button></a>
                                 
                                            <span class="label label-info" onclick="document.getElementById('lead_id').value={{ $lead_ID }}" data-toggle="modal" data-target="#status-modal">Change Status</span>
                                            <?php
                                            $notesCount =  App\Models\Note::where(['lead_id'=>$lead_ID])->count();
                                            $LhsReportCount =  App\Models\LhsReport::where(['lead_id'=>$lead_ID])->count();
                                           ?>
                                            <input type="hidden" id="notes_count_{{ $lead_ID }}" name="notes_count" value="{{ $notesCount }}">
                                            <input type="hidden" id="Lhsreport_count_{{ $lead_ID }}" name="Lhsreport_count" value="{{ $LhsReportCount }}">

                                     </div>
                                   
                                    </form>     

                                    
                                    <div class="table-responsive m-t-40">

                                	
                                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                           
                                                    
                                                    <th>Lead Name</th>
                                                    <th>Note</th>
                                                    <th>Reminder Date</th>
                                                    <th>Reminder For</th>
                                                    <th>Updated On</th>
                                                     {{-- @if(auth()->user()->is_admin == 1)
                                                    <th>Action</th>
                                                    @endif --}}                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                use App\Models\Note;
                                                $notes_data = Note::where('lead_id',$lead_ID)->orderBy('created_at','desc')->get();
                                                @endphp
                                                @foreach($data['notes'] as $record)
                                                <tr>
                                                    <!--<td>{{ $record['created_at'] }}</td>-->
                                                    <td>{{ $record['lead']['prospect_first_name'].' '.$record['lead']['prospect_last_name'] }}</td>
                                                    <td class="feedback_td" width="300">{{ $record['feedback'] }}</td>
                                                    <td>{{ date('d M, Y', strtotime( $record['reminder_date'])) }}</td>
                                                    <td class="feedback_td">{{ $record['reminder_for'] }}</td>
                                                    <td style="text-align:center;white-space:nowrap !important">
                                                        {{ date('d M, Y h:i A', strtotime($record['updated_at'])) }}
                                                    </td>
                                                    {{-- @if(auth()->user()->is_admin == 1)
                                                    <td><a href="{{ url('/notes/' . $record['id'] . '/edit') }}"><span class="label" data-toggle="tooltip" data-placement="top" title="Edit Lead" style="color:#000;font-size: 15px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a></td>
                                                    @endif --}}
                                                  
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

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
<script src = "https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- This is data table -->
<script src="{{ asset('public/admin/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
$(document).ready(function() {
    var table = $('#example23').DataTable();
    table
    .order( [ 4, 'asc' ] )
    .draw();
} );
$( document ).ready(function() {

// $("#status").change(function() {
//    var selected_val =   $('option:selected', this).val();
//    lead_id = $("input[name=lead_id]").val(); 
//     if(selected_val == 3){
//         $("#save-data").attr("disabled", true);
//          var create_notes_count_id   =  "notes_count_"+lead_id;
//          var total_notes_count = $("#"+create_notes_count_id).val();
//          var Lhsreport_count_id   =  "Lhsreport_count_"+lead_id;
//          var total_Lhsreport_count = $("#"+Lhsreport_count_id).val();
//          if(total_Lhsreport_count == 0){
//             $('.alert.alert-danger.print-error-msg').show();
//             var base_url = $('meta[name="base_url"]').attr('content');
//             var  Current_url = base_url+"/employee/lhs_report/"+ lead_id+"?status="+selected_val;
//             $('ul.custom_text').html('<li class="error_list"><span class="tab">Please add  LHS Report first.</span><a href="'+Current_url+'" ><span class="tab">Click here to add Lhs Report</span></a></li>');
//          }else{
//             $("#save-data").attr("disabled", false);
//          }
//          if(total_notes_count > 0){
//             var base_url = $('meta[name="base_url"]').attr('content');
//             var  Current_url = base_url+"/employee/lhs_report/"+ lead_id+"?status="+selected_val;
//           //  window.location.href = Current_url;
          
//          }else{
//              $('.alert.alert-danger.print-error-msg').show();
//              $('ul.custom_text').html('<li class="error_list"><span class="tab">Please add a notes first.</span></li>');
//         }
      
//     }else{
//         $("#save-data").attr("disabled", false);
//     }
// });

$("#save-data").click(function(event){
  event.preventDefault();
 
  let status = $("select[name=status]").val(); 
  let lead_id = $("input[name=lead_id]").val(); 
  let _token   = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    url: '{{route("changeStatus")}}',
    type:"POST",
    data:{
      lead_id:lead_id,
      status:status,
      _token: _token
    },
    success:function(response){


        if($.isEmptyObject(response.error)){
            console.log(response);
            toastr.success(response.success,'Success!')
              if(response) {
                 $(".print-error-msg").css('display','none');
                $('.success').text(response.success);
                var base_url = $('meta[name="base_url"]').attr('content');
            
                if(response.status == 'failed'){
                    var  Current_url = base_url+"/leads/failed";
                    window.location.href = Current_url;
                }else if (response.status == 'close'){
                    var  Current_url = base_url+"/leads/closed";
                    window.location.href = Current_url;
                }else{
                   // var  Current_url = base_url+"/leads/closed";
                  //  window.location.href = Current_url;
                  location.reload(true); // inprogress
                }
                
                $("#ajaxform")[0].reset();
              }

        }else{
            $('.alert.alert-danger.print-error-msg').show();
            $('ul.custom_text').html(response.lhs_link);
            toastr.error(response.error,'Error!');
        }

    },
   });


  function printErrorMsg (msg) {
    console.log(msg);
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        //$.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+msg+'</li>');
       // });
    }


});

});
</script>