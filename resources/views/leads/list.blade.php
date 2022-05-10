@extends('layouts.admin')
<style>
    .table td, .table th {
    padding:5px 0 !important;
    font-size: 12.5px;
    vertical-align: middle !important;
}
.table-striped tbody tr:nth-of-type(odd) {
    background: #f2f4f859 !important;
}
.table th {
    padding: 5px !important;
}
.wraping {
    height: auto !important;
}
 /* ankita 16-02-22 */
.search_box {
    top: 200px !important;
    right: 20px !important;
}
</style>
<script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    </script>
 
@section('content')

@php 


if (isset($_GET["status"]))
{

if(isset($_GET['status']) && '1' == $_GET['status']) {
    
    $title = "Pending Leads";
}else if($_GET['status'] == 3){
    
    $title = "Closed Leads";
}else if($_GET['status'] == 2){
    
    $title = "Failed Leads";
} else{
    $title = "Leads";
}

}  else{
    $title = "Leads";
}





@endphp


<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
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

                                <h4 class="m-b-0 text-white">{{ $title }}</h4>
                            </div>

                            <div class="card-body">
                                <!--<h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>-->

                                 <a type="button" href="{{ route('leads.create') }}" class="btn btn-success addButton"> + Add Lead</a>
                                 
                                    <form class="form-horizontal form-label-left input_mask" id="assignForm" method='post' action="{{ route('searchLead') }}">
                                            @csrf
                                            <div class="mian-dp">

                                        <div class="main-first">
                                                    <select  name="source_id" class="form-control custom-select" data-placeholder="Select Campaign" tabindex="1">
                                                        <option value="">Select Campaign</option>
                                                        @foreach($sources as $sources)
                                                            @if ($source_ids == $sources['id'])
                                                                <option value="{{ $sources['id'] }}" selected>{{ $sources['source_name'] }} ({{ $sources['description'] }})</option>
                                                            @else
                                                                <option value="{{ $sources['id'] }}">{{ $sources['source_name'] }} ({{ $sources['description'] }})</option>
                                                            @endif
                                                        @endforeach
                                                       
                                                    </select>
                                                    @if($errors->has('source_id'))
                                                        <div class="alert alert-danger">{{ $errors->first('source_id') }}</div>
                                                    @endif
                                                </div>

                                

                                        <div class="main-second">
                                                <button type="submit" id="submitButton" class="btn btn-success">Search</button>
                                                </div>
                                                
                                            </div>

                                        </form>


                               
                                <div class="table-responsive m-t-40">
                                    <div class="seacrh-by-dropdown-wrapper">
                                        <label for="recipient-name" class="control-label">Search By: </label>
                                        <select class="form-control"  id="status_search" name="status_search">
                                        <option id="option" value="0">All</option>
                                        <option value="1">Sr</option>
                                        <option value="2">Campaign Name</option>
                                        <option value="3">Company Name</option>
                                        <option value="4">Prospect Name</option>
                                        <option style="display: none" value="5">LinkedIn No.</option> 
                                        <option value="6">Time</option>
                                        <option value="7">Designation</option>
                                        <option value="8">Phone</option>
                                        <option value="9">Date</option>
                                        </select>
                                     </div>

                                    <table id="exampl" class="display nowrap table table-hover table-striped table-bordered data-table" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sr. No</th>
                                                <th>Campaign Name</th>
                                                <th>Sub-Campaign Name</th>
                                                <th>Company Name</th>
                                                <th>Prospect Name</th>
                                                <th>LinkedIn</th>
                                                <th>Time Zone</th>
                                                <th>Designation</th>
                                                <th>Phone No.</th>                                        
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th class="action_th"style="width: auto">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <script type="text/javascript">
  $(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('leads.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'campaign_name', name: 'campaign_name', orderable: false, searchable: false},
            {data: 'description', name: 'description', orderable: false, searchable: false},
            {data: 'company_name', name: 'company_name'},
            {data: 'prospect_first_name', name: 'prospect_first_name'},
            {data: 'prospect_email', name: 'prospect_email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
    });
    
  });
</script>
               
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
                else if($(this).val() == "4"){
                $('.filter_call').removeClass('show');
                   $('#filter_col4').addClass('show');
                }
                 else if($(this).val() == "5"){
                $('.filter_call').removeClass('show');
                   $('#filter_col5').addClass('show');
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
        
          /*$(function(){
              
                $('#employee_id').change(function() {
                    
                    var employee_id = $(this).val();
                    var url = '{{ route("getViewLeads") }}?ids='+employee_id;
                    window.location.href = url;
        
                });
                
          });*/
        
          
     