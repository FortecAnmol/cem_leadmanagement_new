@extends('layouts.admin')
<style>
    .table td, .table th {
    padding:5px 0 !important;
    font-size: 12.5px;
}
.table-striped tbody tr:nth-of-type(odd) {
    background: #f2f4f859 !important;
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
                        <li class="breadcrumb-item active">Campaign Assign Leads </li>
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
                                <h4 class="m-b-0 text-white">Active Campaigns </h4>
                            </div>

                            <div class="card-body">
							
							
							 <!-- sample modal content -->
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
                                               <ul></ul>
                                                </div>
                                            <div class="modal-body">
                                                
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Select Status: </label>
                                                        <select class="form-control" id="status" name="status" required>
														<option value="">Select Status</option>
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
									</form>
                                    </div>
                                </div>
							
                                <!--<h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>-->
                             
                                <div class="table-responsive m-t-40">

                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sr. No</th>
                                                <th>Campaign Name</th>
                                                <th>Sub-Campaign Name</th>
                                                <th>Total Assigned Leads</th>
                                                {{-- <th>Campiagn Start Date</th> --}}
                                                {{-- <th>Campiagn End Date</th> --}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = 1; @endphp
                                            @foreach($data as $data)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <?php
                                                    $sources_data = App\Models\Source::where(['id'=>$data['source_id']])->first();
                                                    ?>
                                                    <td>{{ $sources_data->source_name }}</td>
                                                    <td>{{ $sources_data->description }}</td>
                                                <td>{{ $data['totalLeads']}}</td>
                                                {{-- <td>{{ $data['source']['start_date'] }}</td> --}}
                                                {{-- <td>{{ $data['source']['end_date'] }}</td> --}}
                                                <td>
                                                    <a href="{{ route('employe.view_camp', [$data['source_id']]) }}" class="set_camp_id">
                                                    <span
                                                    class="label" data-toggle="tooltip" data-placement="top" title="View Campaign" style="color:#000;font-size: 15px;">
                                                    <i class="fa fa-eye" aria-hidden="true"></i></span>
                                                    </a>
                                                </td>
                                                <?php
                                                $notesCount =  App\Models\Note::where(['lead_id'=>$data['id']])->count();
                                                 
                                               ?>
                                                <input type="hidden" id="notes_count_{{ $data['id'] }}" name="notes_count" value="{{ $notesCount }}">
                                          
                                            </tr>
                                            @php $i = $i+1; @endphp
                                            @endforeach
                                          
                              
                                        </tbody>
                                    </table>
                                    <?php
                                           //$cookie_name = "last_url";
                                          // $cookie_value =  route('employe.view_camp', [$data['source_id']]) ;
                                          // setcookie($cookie_name, $cookie_value,time()+3600,'/');
                                           
                                            ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

               
        </div>
  
    <!--<script type = "text/javascript" src = "//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js" ></script>-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
  <script>
$( document ).ready(function() {
  
    $("#status").change(function() {
       var selected_val =   $('option:selected', this).val();
       lead_id = $("input[name=lead_id]").val(); 
        if(selected_val == 3){
            $("#save-data").attr("disabled", true);
             var create_notes_count_id   =  "notes_count_"+lead_id;
             var total_notes_count = $("#"+create_notes_count_id).val();
             if(total_notes_count > 0){
                var base_url = $('meta[name="base_url"]').attr('content');
                var  Current_url = base_url+"/employee/lhs_report/"+ lead_id+"?status="+selected_val;
                window.location.href = Current_url;
             }else{
                 $('.alert.alert-danger.print-error-msg').show();
                $('ul.custom_text').html('<li class="error_list"><span class="tab">Please add a notes first.</span></li>');
                 alert('jjdjdjj');
        
              }
          
        }else{
            $("#save-data").attr("disabled", false);
        }
    });

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
                toastr.success(response.success,'Success!')
                  $('#user-notf-count').val(response.notification_count);
                  if(response) {
                     $(".print-error-msg").css('display','none');
                     alert(response.notification_count);
                     console.log(response.notification_count);
                    $('.success').text(response.success);
                    $("#ajaxform")[0].reset();
                  }
            }else{
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
        $(".set_camp_id").click(function () {
          var get_url =   $(this).attr('href');
           console.log(get_url);
           $.cookie("get_last_url", get_url,{ path: '/' });
        });

});
</script>

  
  
@endsection

