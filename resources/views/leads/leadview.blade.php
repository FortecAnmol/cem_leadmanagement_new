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

                                 <!-- <a type="button" href="{{ route('leads.create') }}" class="btn btn-success addButton"> + Add Lead</a> -->
                                 
                                    <form class="form-horizontal form-label-left input_mask" id="assignForm" method='post' action="{{ route('searchLead') }}">
                                            @csrf
                                            <div class="mian-dp">
                                                <div class="main-first">
                                                    <select  name="source_id" class="form-control custom-select" data-placeholder="Select Campaign" tabindex="1">
                                                        <option value="">Select Campaign</option>
                                                        @foreach($sources as $sources)
                                                            @if ($source_ids == $sources['id'])
                                                                <option value="{{ $sources['id'] }}" selected>{{ $sources['source_name'] }}</option>
                                                            @else
                                                                <option value="{{ $sources['id'] }}">{{ $sources['source_name'] }}</option>
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
                                        <div class="form-group campaign_add" style="
                                                display: flex;
                                                justify-content: flex-end;
                                                width: 100%;">
                                                <br>
                                                <a type="button" href="{{ url('/add_leads').'/'.$source_ids }}"  class="btn btn-success addButton"> Import Leads + </a>

                                            </div>


                               
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
                                    <table  class="custom-seacrh-table" cellpadding="3" cellspacing="0" border="0" style="width: 67%; margin: 0 auto 2em auto;">
                                        <thead>
                                            <tr>
                                                <th>Target</th>
                                                <th>Search text</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="filter_global0" class="show search_box">
                                                <td class="search-label">Search</td>
                                                <td align="center"><input type="text" placeholder="Global Search" class="global_filter" id="global_filter"></td>
                                            </tr>
                                            <tr id="filter_col1" class="filter_call search_box" data-column="0">
                                                <td class="search-label">Search</td>
                                                <td align="center"><input type="text" placeholder="Sr Search"  class="column_filter" id="col0_filter"></td>
                                            </tr>
                                            <tr id="filter_col2" class="filter_call search_box" data-column="1">
                                                <td class="search-label">Search</td>
                                                <td align="center"><input type="text" placeholder="Campaign Search" class="column_filter" id="col1_filter"></td>
                                            </tr>
                                            <tr  id="filter_col3" class="filter_call search_box" data-column="2">
                                                <td class="search-label">Search</td>
                                                <td align="center"><input type="text" placeholder="Company Search" class="column_filter" id="col2_filter"></td>
                                            </tr>
                                            <tr   id="filter_col4" class="filter_call search_box" data-column="3">
                                                <td class="search-label">Search</td>
                                                <td align="center"><input type="text" placeholder="Prospect Search" class="column_filter" id="col3_filter"></td>
                                            </tr>
                                            <tr id="filter_col5" style="display: none" class="filter_call search_box" data-column="4">
                                                <td class="search-label">Search</td>
                                                <td align="center"><input type="text" placeholder="LinkedIn Search" class="column_filter" id="col4_filter"></td>
                                            </tr>
                                            <tr id="filter_col6" class="filter_call search_box" data-column="5">
                                                <td class="search-label">Search</td>
                                                <td align="center"><input type="text"  placeholder="Time Search" class="column_filter" id="col5_filter"></td>
                                            </tr>
                                            <tr id="filter_col7"  class="filter_call search_box" data-column="6">
                                                <td class="search-label">Search</td>
                                                <td align="center"><input type="text" placeholder="Designation Search" class="column_filter" id="col6_filter"></td>
                                            </tr>
                                            <tr  id="filter_col8"  class="filter_call search_box" data-column="7">
                                                <td class="search-label">Search</td>
                                                <td align="center"><input   placeholder="Phone Search" type="text" class="column_filter" id="col7_filter"></td>
                                            </tr>
                                            <tr  id="filter_col9" class="filter_call search_box" data-column="8">
                                                <td class="search-label">Search</td>
                                                <td align="center"><input type="text"  placeholder="Date Search" class="column_filter" id="col8_filter"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sr. No</th>
                                                <th>Campaign Name</th>
  
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
                                        <tfoot class="custom-table-foot">
                                            <tr>
                                                    <th>Sr. No</th>
                                                    <th class="campain_name">Campaign Name</th>
                                                    <th class="company_name">Company Name</th>
                                                    <th  class="prospect_name" class="column-wrap" style="visibility: hidden;">Prospect Name</th>
                                                    <th style="visibility: hidden;">LinkedIn</th>
                                                    <th class="time_zone">Time Zone</th>
                                                    <th class="designation">Designation</th>
                                                    <th  class="phone_no" style="visibility: hidden;">Phone No.</th>
                                                    <th>Date</th>
                                                    <th style="visibility: hidden;">Status</th>
                                                    <th style="visibility: hidden;" class="action_th"style="width: auto">Action</th>
                                                    </tr>
                                             </tfoot>
                                        <tbody>
                                             @php $i = 1; @endphp
                                            @foreach($data as $data)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <?php
                                                 if(!empty($data['source_id'])){
                                                  $campaign_id = $data['source_id'];
                                                  $source_data = App\Models\Source::where(['id'=>$data['source_id']])->first();
                                                  // echo"<pre>";print_r($source_data);echo"</pre>";
                                                  $campaign_name = $source_data->source_name;
                                                
                                                 }else{
                                                     $campaign_name = '';
                                                 }
                                                ?>
                                                <td class="wraping">{{ $campaign_name }}</td>
                                                <td class="wraping">{{ $data['company_name'] }}</td>
                                                <td class="wraping"><a href="{{ url('/leads', [$data['id']]) }}">{{ $data['prospect_first_name'].' '.$data['prospect_last_name'] }}</a></td>
                                                @php
                                                $var = $data['linkedin_address'];
                                                @endphp
                                                @if(strpos($var, 'linkedin') == -1)
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
                                                <!--<td class="wraping">{{ $data['company_name'] }}</td>
                                                <td>{{ $data['job_title'] }}</td>-->
                                                <td class="phone_no">{{ $data['contact_number_1'] }}</td>
                                   
                                                <td>{{ date('d M, Y', strtotime($data['created_at'])) }}</td>
                                

                                                @if($data['status'] == 1)
                                                    <td>
                                                        <span class="label" data-toggle="tooltip" data-placement="top" title="Pending" style="color:#000;font-size: 15px;"><img style="width: 20px" src="{{ asset('public/admin/assets/images/pending.png') }}" alt="pending"><span class="lead_status_sapn">1</span></span></td>
                                                @elseif($data['status'] == 2)
                                                    <td><span class="label"  data-toggle="tooltip" data-placement="top" title="Failed" style="color:#000;font-size: 15px;" class="label"><img style="width: 20px" src="{{ asset('public/admin/assets/images/failed.png') }}" alt="failed"><span class="lead_status_sapn">2</span></span></td>
                                                @elseif($data['status'] == 4)
                                                    <td><span class="label"  data-toggle="tooltip" data-placement="top" title="In Progress" style="color:#000;font-size: 15px;" class="label"><img style="width: 20px" src="{{ asset('public/admin/assets/images/in-progress.png') }}" alt="In Progress"><span class="lead_status_sapn">4</span></span></td>
    
                                                @else
                                                    <td><span  class="label" data-toggle="tooltip" data-placement="top" title="Closed" style="color:#000;font-size: 15px;"><img style="width: 20px" src="{{ asset('public/admin/assets/images/completed.png') }}" alt="completed"><span class="lead_status_sapn">3</span></span></td>
                                                @endif
                                                <td>
                                                   <a href="{{ url('/leads', [$data['id']]) }}"><span class="label" data-toggle="tooltip" data-placement="top" title="View" style="color:#000;font-size: 15px;"><i class="fa fa-eye" aria-hidden="true"></i></span></a>   
                                                 </td>
                                                <!-- <td>
                                                    <a href="{{ url('/notes/view', [$data['id']]) }}">
                                                        <span  class="label label-warning">View All Notes</span>
                                                    </a>
                                                 <a href="{{ url('/leads', [$data['id']]) }}"><span class="label label-success">View</span></a>   

                                                <a href="{{ url('/leads/' . $data['id'] . '/edit') }}"><span class="label label-warning">Edit</span></a>
                                                
                                                <a href="{{ url('leads/delete', ['id' => $data['id']]) }}"  ><span class="label label-danger" onclick="return confirm('Are you sure you want to delete this lead ?')">Delete</span></a> 

                                                </td> -->
                      
                                            </tr>
                                             @php $i = $i+1; @endphp
                                            @endforeach
                               
                              
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

               
        </div>
        <script>
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
        
          
        </script>
@endsection
{{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
$(document).ready(function() {
    $('#pTable').DataTable();
});
</script> --}}