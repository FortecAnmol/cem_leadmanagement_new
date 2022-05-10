@extends('layouts.admin')
<style>
    .table td, .table th {
    padding:5px 0 !important;
    font-size: 12.5px;
    vertical-align:middle !important;
}
.table-striped tbody tr:nth-of-type(odd) {
    background: #f2f4f859 !important;
}
.wraping {
    height: auto !important;
}
.table-responsive>.table-bordered {
    border: 1px solid #dee2e6 !important;
}

</style>
 
@section('content')

<style type="text/css">
    
    .icons {

     width: 40px;

    }
</style>
<?php
date_default_timezone_set('Asia/Kolkata');
?>
<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Closed Lead List</li>
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
                                <h4 class="m-b-0 text-white">Closed Lead List</h4>
                            </div>

                            <div class="card-body">
                                <div class="seacrh-by-dropdown-wrapper">
                                    <label for="recipient-name" class="control-label">Search By: </label>
                                    <select class="form-control"  id="status_search" name="status_search">
                                    <option id="option" value="0">All</option>
                                    <option value="1">Sr. No</option>
                                    <option value="2">Campaign Name</option>
                                    <option value="3">Company Name</option>
                                    <option value="5">Prospect Name</option> 
                                    <option value="6">Time Zone</option>
                                    <option value="7">Designation</option>
                                    <option value="8">Phone No.</option>
                                    <option value="9">Date</option>
                                    </select>
                                 </div>
                            <table class="custom-seacrh-table" cellpadding="3" cellspacing="0" border="0" style="width: 67%; margin: 0 auto 2em auto;">
                                <thead>
                                    <tr>
                                        <th>Target</th>
                                        <th>Search text</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <tr id="filter_global0" class="show">
                                        <td class="search-label">Search</td>
                                        <td align="center"><input type="text" placeholder="Global Search" class="global_filter" id="global_filter"></td>
                                    </tr>
                                    <tr id="filter_col1" class="filter_call"  data-column="0">
                                        <td class="search-label">Search</td>
                                        <td align="center"><input type="text" placeholder="Sr. Number Search" class="column_filter" id="col0_filter"></td>
                                    </tr>
                                    <tr id="filter_col2" class="filter_call" data-column="1">
                                        <td class="search-label">Search</td>
                                        <td align="center"><input type="text" placeholder="Compaign name Search" class="column_filter" id="col1_filter"></td>
                                    </tr>
                                    <tr id="filter_col3" class="filter_call" data-column="2">
                                        <td class="search-label">Search</td>
                                        <td align="center"><input type="text" placeholder="Company name Search" class="column_filter" id="col2_filter"></td>
                                    </tr>
                                    <tr id="filter_col4" class="filter_call" data-column="3">
                                        <td class="search-label">Search</td>
                                        <td align="center"><input type="text" placeholder="Prospect name Search" class="column_filter" id="col3_filter"></td>
                                    </tr>
                                    <tr id="filter_col6" class="filter_call" data-column="5">
                                        <td class="search-label">Search</td>
                                        <td align="center"><input type="text" placeholder="Time Zone Search" class="column_filter" id="col5_filter"></td>
                                    </tr>
                                    <tr id="filter_col7" class="filter_call" data-column="6">
                                        <td class="search-label">Search</td>
                                        <td align="center"><input type="text" placeholder="Designation Search" class="column_filter" id="col6_filter"></td>
                                    </tr>
                                    <tr id="filter_col8" class="filter_call" data-column="7">
                                        <td class="search-label">Search</td>
                                        <td align="center"><input type="text" placeholder="Phone Number Search" class="column_filter" id="col7_filter"></td>
                                    </tr>
                                    <tr id="filter_col9" class="filter_call" data-column="8">
                                        <td class="search-label">Search</td>
                                        <td align="center"><input type="text" placeholder="Date Search" class="column_filter" id="col8_filter"></td>
                                    </tr>
                                </tbody>
                            </table>
                               
                                <!--<h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>-->
                             
                                <div class="table-responsive m-t-40" style="padding-bottom: 50px;">

                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Campaign Name</th>
                                                <th>Sub-Campaign Name</th>

   
                                                <th>Company Name</th>
                                                <th>Prospect Name</th>
                                                <th>LinkedIn</th>
                                                <th>Time Zone</th>
                                                <th>Designation</th>
                                                <th>Phone No.</th>
                                                <th>Date</th>
                                                <th>Last Updated Note</th>
                                                <th>Updated Note Date</th>
                                                {{-- <th>Time</th> --}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="custom-table-foot">
                                            <tr>
                                                    <th style="visibility: hidden">Sr. No</th>
                                                    <th class="campain_name">Campaign Name</th>
                                                    <th class="campain_name">Sub-Campaign Name</th>

                                                    <th class="company_name">Company Name</th>
                                                    <th class="prospect_name">Prospect Name</th>
                                                    <th style="visibility: hidden;">LinkedIn</th>
                                                    <th class="time_zone">Time Zone</th>
                                                    <th style="visibility: hidden" class="designation">Designation</th>
                                                    <th class="phone_no" style="visibility: hidden;">Phone No.</th>
                                                    <th>Date</th>
                                                    <th class="phone_no" style="visibility: hidden;">Last Updated Note</th>
                                                    <th style="visibility: hidden">Duration of Last Updated Note</th>
                                                    <th class="prospect_name">Action</th>
                                                    </tr>
                                             </tfoot>
                                        <tbody>
                                             @php $i = 1; 
                                            use App\Models\Note; 
                                             @endphp
                                            @foreach($data as $data)
                                            <tr>
                                                <td>
                                                    <?php
                                                $date_today = date('Y-m-d');
                                                    $get_dates = Note::where('lead_id',$data['id'])->groupBy('reminder_date')->get();
                                                        $get_date['reminder_date'] ?? 'default value';
                                                    ?>
                                                    @foreach($get_dates as $get_date)
                                                    @if($date_today == $get_date['reminder_date'])
                                                    <img src="{{ asset('storage/app/images/new_alert.gif') }}"  width='50' height='35' title='Today is Reminder Date' alt='Today is Reminder Date'>
                                                    @else
                                                    @endif
                                                    @endforeach
                                                    <a onclick="document.getElementById('lead_id').value={{ $data['id'] }}" class="notes_id" baseUrl="{{ $data['id'] }}" id="view-note" name="view-note"   data-toggle="modal" data-target="#largeModal">
                                                        <span    class="label" data-toggle="tooltip" data-placement="top" title="View All Notes" style="color:#000;font-size: 15px;"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                                    </a>
                                                    <a  onclick="document.getElementById('lead_id_quick_note').value={{ $data['id'] }}" data-toggle="modal" data-target="#status-modal-quicknote">
                                                        <span    class="label" data-toggle="tooltip" data-placement="top" title="Add Quick Note" style="color:#000;font-size: 15px;"><i class="fa fa-comment" aria-hidden="true"></i></span>
                                                        </a>
                                                    <div style="visibility: hidden">
                                                            {{ $i }}
                                                                </div>
                                                </td>
                                                <?php
                                                    $sources_data = App\Models\Source::where(['id'=>$data['source_id']])->first();
                                                    ?>
                                                    <td>{{ $sources_data->source_name }}</td>
                                                    <td>{{ $sources_data->description }}</td>
                                                <td class="wraping">{{ $data['company_name'] }}</td>
                                                <td class="wraping"><a href="{{ url('/leads', [$data['id']]) }}">{{ $data['prospect_first_name'].' '.$data['prospect_last_name'] }}</a></td>
                                                @php
                                                $var = $data['linkedin_address'];
                                                @endphp
                                                @if(strpos($var, 'linkedin') == 0)
                                                <td><a href="javascript:void(0)" ><i style="color: #000" alt="LinkedIn" title="LinkedIn Address Not Valid" class="fa-brands fa-linkedin" aria-hidden="true"></i></a></td>
                                                @else
                                                <td><a href="<?php
                                                        // $var = $data[6]['linkedin_address'];
                                                        if(strpos($var, 'http://') !== 0  && strpos($var, 'https://') !== 0) {
                                                            echo $kasa = 'https://' . $var;
                                                        } else {
                                                        echo $var;
                                                        }
                                                    ?>" target="_blank" ><i  alt="LinkedIn" title="LinkedIn" class="fa-brands fa-linkedin" aria-hidden="true"></i></a></td>
                                                @endif
                                                <td>{{$data['timezone']}}</td>
                                                <td class="designation">{{ $data['designation'] }}</td>
                                                {{-- <td>{{ $data['job_title'] }}</td> --}}
                                                {{-- <td class="wraping">{{ $data['prospect_email'] }}</td> --}}
                                                <td>{{ $data['contact_number_1'] }}</td>
                                                <td>
                                                   
                                                    {{-- {{ date('d M, Y H:i:s', strtotime($data['updated_at'])) }} --}}
                                                    
                                                    {{ date('d M, Y h:i A', strtotime($data['updated_at'])) }}
                                                
                                                </td>
                                                                                                <td><?php
                                                   $sget_dates = Note::where('lead_id',$data['id'])->orderBy('created_at','desc')->get()->unique('lead_id');
                                                ?>
                                                @foreach($sget_dates as $get_date)
                                                @if($get_date['feedback'] == '')
                                                <p> </p>
                                                @else
                                                {{-- <p class="campain_name" data-toggle="tooltip" data-placement="top" title="{{$get_date['feedback']}}"> --}}
                                                    @php
                                                    $result = substr($get_date['feedback'], 0, 20);
                                                    @endphp
                                                    @if (strlen($get_date['feedback']) > 20)
                                                    <p class="campain_name" data-toggle="tooltip" data-placement="top"><span>{{$get_date['feedback']}}</span>{{$result}}</p>
                                                    @else
                                                    {{$get_date['feedback']}}
                                                    @endif
                                                @endif
                                                @endforeach
                                            </td>
                                                 <td><?php
                                                     foreach ($sget_dates as $get_date) {
                                                         if($get_date['created_at'] == ''){
                                                            echo  "Null";
                                                         }else{
                                                           echo  $get_date['created_at']->format('d-m-Y H:m');
                                                           $time = $get_date['created_at']->format('h:i a');
                                                         }  
                                                     } 
                                                    ?></td>
                                                    {{-- <td>@php 
                                                    foreach ($sget_dates as $get_date) {
                                                          echo  $get_date['created_at']->format('h:i a');  
                                                        } 
                                                        @endphp</td> --}}
                                                    <input type="hidden" id="notes_count_{{ $data['source_id'] }}" name="source_id" value="{{ $data['source_id'] }}">
                  
                                                <td>

                                                     {{-- <a href="{{ url('/feedbacks/add', [$data['id']]) }}">
                                                     <span type="button" class="label" data-toggle="tooltip" data-placement="top" title="Add Feedback" style="color:#000;font-size: 15px;"> <span class="material-icons">chat</span></span>
                                                    </a>
                                                   
                                                    <a onclick="document.getElementById('lead_id').value={{ $data['id'] }}" class="notes_id" baseUrl="{{ $data['id'] }}" id="view-note" name="view-note"   data-toggle="modal" data-target="#largeModal">
                                                        <span    class="label" data-toggle="tooltip" data-placement="top" title="View All Notes" style="color:#000;font-size: 15px;"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                                    </a> --}}
                                                    <?php
                                                      $getlhs_report =  App\Models\LhsReport::where(['lead_id'=>$data['id']])->first();
                                                  
                                                    ?>
                                                    @if(!empty($getlhs_report))
                                                    <a href="{{ url('/employee/lhs_report/view_lhs', [$data['id']]) }}">
                                                        <span class="label" data-toggle="tooltip" data-placement="top" title="View LHS Report" style="color:#000;font-size: 15px;"><span class="material-icons">pageview</span></span>
                                                    </a>
                                                    <a href="{{ url('/employee/lhs_report/edit', [$data['id']]) }}">
                                                        <span class="label" data-toggle="tooltip" data-placement="top" title="Edit LHS Report" style="color:#000;font-size: 15px;"><span class="material-icons">drive_file_rename_outline</span></span>
                                                    </a>
                                                    @else
                                                    <a href="{{ url('/employee/lhs_report', [$data['id']]) }}">
                                                        <span class="label" data-toggle="tooltip" style="display: none" data-placement="top" title="Add LHS Report" style="color:#000;font-size: 15px;"> <span class="material-icons">library_add</span></span>
                                                    </a>
                                                    
                                                    @endif

                                                </td>
                      
                                            </tr>
                                             @php $i = $i+1; @endphp
                                            @endforeach
                               
                              
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
<!-- Quick Notes Add -->
{{-- <form action="{{route('notes.store')}}" method="post"> --}}
    {{-- @csrf --}}
    <form id="form">
<div id="status-modal-quicknote" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
             <meta name="csrf-token" content="{{ csrf_token() }}" />
             <div>
            <ul></ul>
        </div>

            <div class="modal-header">
                <h4 class="modal-title">Add Quick Note</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                    <div class="form-group" id="status" name="status">
                        <label class="control-label">Reminder Date</label>
                        <input type="text" class="form-control" placeholder="Reminder Date" name="reminder_date" value="{{ old('reminder_date') }}" id="min-date" data-dtp="dtp_2827e">
                        <label class="control-label">Reminder Time</label>
                        <input type="time" class="form-control" id="reminder_time" name="reminder_time">                          
                        <label class="control-label">Reminder Type</label>
                        {{-- <input type="text" class="form-control required" placeholder="Reminder Type" id="reminder_for" name="reminder_for" value="{{ old('reminder_for') }}"> --}}
                        <select id="reminder_for" class="form-control required" name="reminder_for">
                            <option value="">Choose Reminder Type</option>
                                <option value="Follow-up call">Follow-up call</option>
                                <option value="Follow-up email">Follow-up email</option>
                                <option value="Information Request Customised Deck">Information Request Customised Deck</option>
                                <option value="Information Request Brochure">Information Request Brochure</option>
                        </select>
                        <label class="control-label">Note</label>
                        <input type="hidden" class="form-control" name="lead_id" placeholder="Lead Id" value="{{isset($data['id'])}}">
                        <textarea required type="text" class="form-control required" name="feedback" id="feedback" placeholder="Enter Note" style="min-height: 130px;">{{ old('note') }}</textarea>   
                        <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul class="custom_text"></ul>
                        </div>              
                        @if($errors->has('status'))
                        <div class="alert alert-danger">{{ $errors->first('status') }}</div>
                    @endif
                    </div>
            </div>
            <div class="modal-footer">
            <input type="hidden" id="lead_id_quick_note" name="lead_id_quick_note">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                {{-- <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button> --}}
                <button id="save-data-quick-note" type="button" class="btn btn-info waves-effect waves-light ">Add Note</button>
            </div>
        </div>
</form>
                    </div>
                </div>

               
        
        </div>
         <!-- large modal -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">View Note</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-body">
          <input type="hidden" name="view_lead_id" value=<?php $lead_id = "";?>>             
          </div>
      {{-- @else
      <div> Empty data</div>
      @endif     --}}
      <div class="table-responsive m-t-40" id="notes_data">
  
      
  
      </div>
      </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
          <button type="button" style="display: none;" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
        <script>
            /* ============================ */
    $("#save-data-quick-note").click(function(event){
    event.preventDefault();
    let feedback = $("[name=feedback]").val();
    if(feedback == 0){
      $('.alert.alert-danger.print-error-msg').show();
          $('ul.custom_text').html('<li class="error_list"><span class="tab">Note Field Cannot Be Empty!</span></li>');
    } else{
    $('.alert.alert-danger.print-error-msg').hide();
      $('ul.custom_text').html('');
    //   $('alert.alert-success.print-error-msg').show();
    //   $('ul.custom_text').html('<li><span class="error_list">Note Added Successfully</span></li>');
    let feedback = $("[name=feedback]").val();
    let reminder_date = $("[name=reminder_date]").val(); 
    let reminder_time = $("[name=reminder_time]").val(); 
    let source_id = $("[name=source_id]").val(); 
    console.log(reminder_time);
    let reminder_for = $("[name=reminder_for]").val(); 
    let lead_id = $("input[name=lead_id_quick_note]").val(); 
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      url: '{{route("add_note")}}',
      type:"POST",
      data:{
        source_id:source_id,
          reminder_date:reminder_date,
          reminder_time:reminder_time,
          reminder_for:reminder_for,
          lead_id:lead_id,
          feedback:feedback,
        _token: _token
      },
      success:function(response){
          if($.isEmptyObject(response.error)){
              console.log(response);
              toastr.success(response.success,'Success!')
          }else{
                toastr.error(response.error,'Error!');
          }

      },
     });
    }
    function printErrorMsg (msg) {
      console.log(msg);
          $(".print-error-msg").find("ul").html('');
          $(".print-error-msg").css('display','block');
          $(".print-error-msg").find("ul").append('<li>'+msg+'</li>');
      }
});
$(document).on("click", ".notes_id", function () {
    event.preventDefault();
        // $("input[name=view_lead_id]").val(lead_id);
    // let lead_id_new = $("input[name=view_lead_id]").val();      
    // let lead_id = $("input[name=view-note]").val();
    let  lead_id = $(this).attr("baseUrl");
    var url ='{{url("notes/view/")}}';
    var full_url = url+'/'+lead_id;
    $.ajax({
      url: full_url,
      type:"GET",
      data:{
          lead_id:lead_id
      },
      success:function(response){
          if($.isEmptyObject(response.error)){
              console.log(response.notes_data);
              console.log(response.table);
              $("#notes_data").html('');
              $("#notes_data").html(response.table);
          }else{
                toastr.error(response.error,'Error!');
          }

      },
     });

});

            $("#status_search").change(function(){
                if($(this).val() == "0") {
                  $('.filter_call').removeClass('show');
                   $('#filter_col0').addClass('show');
                }
                else if($(this).val() == "1") {
                  $('.filter_call').removeClass('show');
                   $('#filter_col1').addClass('show');
                } else if($(this).val() == "2"){
                $('.filter_call').removeClass('show');
                   $('#filter_col2').addClass('show');
                }
                 else if($(this).val() == "3"){
                $('.filter_call').removeClass('show');
                   $('#filter_col3').addClass('show');
                }
                 else if($(this).val() == "5"){
                $('.filter_call').removeClass('show');
                   $('#filter_col4').addClass('show');
                }
                else if($(this).val() == "6"){
                $('.filter_call').removeClass('show');
                   $('#filter_col6').addClass('show');
                }
                else if($(this).val() == "7"){
                $('.filter_call').removeClass('show');
                   $('#filter_col7').addClass('show');
                }
                else if($(this).val() == "8"){
                $('.filter_call').removeClass('show');
                   $('#filter_col8').addClass('show');
                }
                else if($(this).val() == "9"){
                $('.filter_call').removeClass('show');
                   $('#filter_col9').addClass('show');
                }
            });
        </script>
  
@endsection

