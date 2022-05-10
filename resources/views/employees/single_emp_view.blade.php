@extends('layouts.admin')
<style>
    .table-responsive>.table-bordered{
        border: 1px solid #dee2e6 !important;
    }
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
.tablecustomheader {
        text-align: right !important;
    }



    .table td, .table th {
    padding:5px 0 !important;
    font-size: 12.5px;
    height: auto;
}
.table-striped tbody tr:nth-of-type(odd) {
    background: #f2f4f859 !important;
}
.emp_lead_info ul {
    list-style: none;
    padding-left: 0;
}
.emp_lead_info ul li {
    line-height: 1.4;
}
.emp_lead_info ul span {
    font-size: 12.5px;
    font-weight: 600;
    color: #192e62;
}
table#example23 {
    border: 1px solid #dee2e6;
}


span.assign_emp_wrapper_heading {
    font-weight: 700;
    color: #192e62;
}
span.assign_emp_wrapper_list{
    display: block;
    /* max-height: 30vh;
    overflow-y: scroll; */
    }
    .assign_emp_wrapper_list  div {
        font-size: 12.5px;
        font-weight: 400;
        color: #455a64;
    }
    /* width */
     span.assign_emp_wrapper_list::-webkit-scrollbar {
    width: 5px;
    }

    /* Track */
     span.assign_emp_wrapper_list::-webkit-scrollbar-track {
    background: #f1f1f1;
    }

    /* Handle */
     span.assign_emp_wrapper_list::-webkit-scrollbar-thumb {
    background: #888;
    }

    /* Handle on hover */
     span.assign_emp_wrapper_list::-webkit-scrollbar-thumb:hover {
    background: #555;
    }
    /* 12-1-2022 */
    .col-md-6.emp_lead_info {
        background: #a3a4a752;
        padding: 14px;
        border-radius: 10px;
        margin-left: 15px;
        flex: 0 0 48%;
        max-width: 48%;
    }
    .emp_lead_info ul li {
        line-height: 1.4;
        display: inline-block;
        background: #192e62;
        padding: 4px 12px;
        border-radius: 50px;
        margin-bottom: 8px;
    }
    .emp_lead_info ul span {
        color: #fff;
    }
    .assign_emp_wrapper_list div {
        font-weight: 500;
        color: #192e62;
    }
    .seacrh-by-dropdown-wrapper {
        margin-right: 20px;
    }
</style>

 
@section('content')


@php
                                
    $urls = '?emp_id='.intval(request()->get('emp_id')).'&camp_id='.request()->get('camp_id').'&date_from='.request()->get('date_from').'&date_to='.request()->get('date_to');

//dd('hdhdhdh');
@endphp

<style>
    .form-control {
      height: calc(0em + .0rem + 0px) !important; 
    }
    .btn {
        margin-top: 5px;
    }
</style>

<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('leads') }}">Leads</a></li>
                        <li class="breadcrumb-item active">View Leads</li>
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
                                <h4 class="m-b-0 text-white">View Leads</h4>
                            </div>

                            <div class="card-body">
                                <!--<h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>-->
                               <!-- <a type="button" href="{{ route('leads.create') }}" class="btn btn-success addButton"> + Add Lead</a>-->
                               
                              
                                 <form id="ajaxform1">
                                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                                    <div class="form-body">
                                        
                                         <div class="row p-t-20">
                                <div class="col-md-12 tablecustomheader">
                                    <?php
                                    $emp_id =  request()->get('emp_id');
                                    $emp_info = App\Models\User::where(['id' => $emp_id])->first();
                                    ?>
                                    <span>Employee Name:</span>
                                    <span>{{ $emp_info->name}}</span>
                                </div>
                                            
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Campaign Name</label>
                                                    <select class="form-control"  name="camp_id" id="camp_id">
                                                        <option value="">Select Campaign</option>
                                                              @foreach($campaigns as $campaigns)
                                                                   @if ($camp_id == $campaigns['source']['id'])
                                                                      <option value="{{ $campaigns['source']['id'] }}" selected>{{ $campaigns['source']['source_name'] }}</option>
                                                                  @else 
                                                                      <option value="{{ $campaigns['source']['id'] }}">{{ $campaigns['source']['source_name'] }}</option>
                                                                   @endif 
                                                              @endforeach
                                                      </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Date From</label>
                                                        <input type="text" class="form-control" placeholder="Date From" name="date_from" value="{{ $date_from }}" id="date_from">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Date To</label>
                                                    <input type="text" class="form-control" placeholder="Date To" name="date_to" value="{{ $date_to }}" id="date_to">
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <br>
                                                     <button type="button" id="sub_cmap" class="btn btn-success">Search</button>
                                                </div>
                                            </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="row">
                                        @if(!empty(request()->get('camp_id')))
                                        <div class="col-md-6 emp_lead_info">
                                            
                                            <?php
                                            $Grand_total_leads = App\Models\Lead::where(['source_id'=>request()->get('camp_id')])->count();
                                            $total_pending_leads = App\Models\Lead::where(['source_id'=>request()->get('camp_id'),'status'=> 1])->count();
                                            $total_completed_leads = App\Models\Lead::where(['source_id'=>request()->get('camp_id'),'status'=> 3])->count();
                                            $total_failed_leads = App\Models\Lead::where(['source_id'=>request()->get('camp_id'),'status'=> 2])->count();
                                            $total_Assigned_leads = App\Models\Lead::where(['source_id'=>request()->get('camp_id')])->whereNotNull(['asign_to'])->count();
                                            $total_Pending_Assign_leads = App\Models\Lead::where(['source_id'=>request()->get('camp_id')])->whereNull(['asign_to'])->count();
                                            $total_Assigned_emp_leads = App\Models\Lead::where(['source_id'=>request()->get('camp_id')])->whereNotNull(['asign_to'])->groupBy('asign_to')->get()->toArray();
                                            $emp_names = array();
                                            foreach($total_Assigned_emp_leads as $data_new){
                                               // print_r( $data_new['asign_to']);
                                                $user_data = App\Models\User::select('id','name')->where(['id' => $data_new['asign_to'] ])->first();
                                                $user_data_name = $user_data->name;
                                                $emp_names[] =  $user_data;
                                            }
                                            ?>
                                            <ul>
                                                <li><span>Total Leads </span><span>{{ $Grand_total_leads}}</span></li>
                                                <li><span>Total Pending Leads </span><span>{{ $total_pending_leads }}</span></li>
                                                <li><span>Total Closed Leads </span><span>{{ $total_completed_leads }}</span></li>
                                                <li><span>Total Failed Leads </span><span>{{ $total_failed_leads }}</span></li>
                                                <li><span>Total Assigned Leads </span><span>{{ $total_Assigned_leads}}</span></li>
                                                <li><span>Total Pending Assign Leads </span><span>{{  $total_Pending_Assign_leads }}</span></li>
                                            </ul>
                                            
                                            
                                            
                                            
                                            
                                            <div class="assign_emp_wrapper">
                                                <span class="assign_emp_wrapper_heading">Assigned Emplyee </span><span class="assign_emp_wrapper_list">
                                                    @foreach($emp_names as $data_latest)
                                                    <?php
                                                        $emp_user_Id = $data_latest->id;
                                                        $Emp_total_leads = App\Models\Lead::where(['source_id'=>request()->get('camp_id'),'asign_to'=>$emp_user_Id])->count();
                                                        $emp_urls = '?employee_id='. $emp_user_Id.'&campaign_id='.request()->get('camp_id').'&date_from='.request()->get('date_from').'&date_to='.request()->get('date_to');
                                                        ?>
                                                            <div><a href="{{ route('getViewLeads').$emp_urls}}">{{$data_latest->name}} ({{ $Emp_total_leads }})</a></div>
                                                    {{-- <div>{{$data_latest}}</div> --}}
                                                    @endforeach
                                                </span>
                                            </div>
                                            
                                        </div>
                                        @else
                                        <div class="col-md-6">
                                        </div>
                                        @endif
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <br>
                                                 <a type="button" href="{{ url('/employees/' . request()->get('emp_id') . '/performace').$urls }}" class="btn btn-success addButton"> View in Graphical Format</a>

                                            </div>
                                            <div class="form-group" style="
                                                display: flex;
                                                justify-content: flex-end;
                                                width: 100%;">
                                                <br>
                                                <a type="button" href="{{ url('/employee/export').$urls }}" class="btn btn-success addButton"> Export Report </a>

                                            </div>
                                        </div> 
                                    </div>
                                </div>

                                        </div>
                                        
                                    </div>
                                </form>
                                
                                <div class="table-responsive m-t-40">
                                    <div class="seacrh-by-dropdown-wrapper">
                                        <label for="recipient-name" class="control-label">Select Search By: </label>
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
                                    <table  class="custom-seacrh-table search_wrapper" cellpadding="3" cellspacing="0" border="0" style="width: 67%; margin: 0 auto 2em auto;">
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
                                            <tr id="filter_col1" class="filter_call" data-column="0">
                                                <td class="search-label">Search</td>
                                                <td align="center"><input type="text" placeholder="Sr Search"  class="column_filter" id="col0_filter"></td>
                                            </tr>
                                            <tr id="filter_col2" class="filter_call" data-column="1">
                                                <td class="search-label">Search</td>
                                                <td align="center"><input type="text" placeholder="Campaign Search" class="column_filter" id="col1_filter"></td>
                                            </tr>
                                            <tr  id="filter_col3" class="filter_call" data-column="2">
                                                <td class="search-label">Search</td>
                                                <td align="center"><input type="text" placeholder="Company Search" class="column_filter" id="col2_filter"></td>
                                            </tr>
                                            <tr   id="filter_col4" class="filter_call" data-column="3">
                                                <td class="search-label">Search</td>
                                                <td align="center"><input type="text" placeholder="Prospect Search" class="column_filter" id="col3_filter"></td>
                                            </tr>
                                            <tr id="filter_col5" style="display: none" class="filter_call" data-column="4">
                                                <td class="search-label">Search</td>
                                                <td align="center"><input type="text" placeholder="LinkedIn Search" class="column_filter" id="col4_filter"></td>
                                            </tr>
                                            <tr id="filter_col6" class="filter_call" data-column="5">
                                                <td class="search-label">Search</td>
                                                <td align="center"><input type="text"  placeholder="Time Search" class="column_filter" id="col5_filter"></td>
                                            </tr>
                                            <tr id="filter_col7"  class="filter_call" data-column="6">
                                                <td class="search-label">Search</td>
                                                <td align="center"><input type="text" placeholder="Designation Search" class="column_filter" id="col6_filter"></td>
                                            </tr>
                                            <tr  id="filter_col8"  class="filter_call" data-column="7">
                                                <td class="search-label">Search</td>
                                                <td align="center"><input   placeholder="Phone Search" type="text" class="column_filter" id="col7_filter"></td>
                                            </tr>
                                            <tr  id="filter_col9" class="filter_call" data-column="8">
                                                <td class="search-label">Search</td>
                                                <td align="center"><input type="text"  placeholder="Date Search" class="column_filter" id="col8_filter"></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                                                <th>View Notes</th>
                                                <th>Report</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="custom-table-foot">
                                            <tr>
                                                    <th>Sr. No</th>
                                                    <th class="campain_name">Campaign Name</th>
                                                    <th class="company_name">Company Name</th>
                                                    <th class="column-wrap prospect_name" >Prospect Name</th>
                                                    <th style="visibility: hidden;">LinkedIn</th>
                                                    <th class="time_zone">Time Zone</th>
                                                    <th class="designation">Designation</th>
                                                    <th class="phone_no">Phone No.</th>
                                                    <th>Date</th>
                                                    <th style="visibility: hidden;">Status</th>
                                                    <th class="view_notes">View Notes</th>
                                                    <th style="visibility: hidden">Report</th>
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
                                                 $source_data = App\Models\Source::where(['id'=>$campaign_id])->first();
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
                                                
                                                
                                                <!--<td class="wraping">{{ $data['company_name'] }}</td>
                                               <td>{{ $data['job_title'] }}</td>-->
                                               {{-- <td class="wraping">{{ $data['prospect_email'] }}</td> --}}
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
                                                <td>    <a href="{{ url('/notes/view', [$data['id']]) }}">
                                                    <span class="label" data-toggle="tooltip" data-placement="top" title="View All Notes" style="color:#000;font-size: 15px;"><span class="material-icons">
                                                        grading
                                                        </span></span></a></span>
                                                </a>
                                                </td>
                                                <?php
                                                $lhs = App\Models\LhsReport::where(['lead_id' => $data['id']])->first();
                                                ?>
                                               
                                                @if($data['status'] == 3 && !empty($lhs))
                                                <td> <a href="{{ url('/employee/export/' . $data['id']. '/pdf_single_down').$urls }}"><span class="label label-warning">
                                                            <i class="ti-download"> </i> Word</span>
                                                    </a>
                                                </td>
                                                @else 
                                                <td> </td>
                                                @endif



                                                
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



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const camp_id = urlParams.get('camp_id');
        const emp_id = urlParams.get('emp_id');
        const date_from = urlParams.get('date_from');
        const date_to = urlParams.get('date_to');
       
 $(document).on("click","#sub_cmap",function() {
               var camp_id = $('#camp_id').val();
               var date_from = $('#date_from').val();
               var date_to = $('#date_to').val();
               var base_url = $('meta[name="base_url"]').attr('content');
               var  Current_url = base_url+"/emp/leads/view?emp_id="+emp_id+"&camp_id="+camp_id+"&date_from="+date_from+"&date_to="+date_to;
    
                $(window).attr("location",Current_url);
        });
</script>

