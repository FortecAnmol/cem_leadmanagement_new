@extends('layouts.admin')

 
@section('content')

@php
                                

    $urls = '?emp_id='.intval(request()->get('emp_id')).'&camp_id='.intval(request()->get('camp_id')).'&date_from='.request()->get('date_from').'&date_to='.request()->get('date_to');


    $list_urls = '?emp_id='.intval(request()->get('emp_id')).'&camp_id='.intval(request()->get('camp_id')).'&date_from='.request()->get('date_from').'&date_to='.request()->get('date_to');
     $current_url = URL::current();
     $host = explode('/',$current_url);
     $emp_id = intval($host[5]);

@endphp

<style>
    .form-control {
      height: calc(0em + .0rem + 0px) !important; 
    }
    .btn {
        margin-top: 5px;
    }
    .tablecustomheader {
        text-align: right !important;
    }
          .lead_emp_wrapper {
        display: flex;
        justify-content: space-between;
        position: absolute;
        width: 100%;
        padding-right: 5%;
    }
    ul.side_emp_asign {
    padding: 0;
    list-style: none;
    }
    ul.side_emp_asign .emp_list{
    max-height: 30vh;
    overflow-y: scroll;
    }
    ul.side_emp_asign li div {
        font-size: 12.5px;
        font-weight: 400;
        color: #455a64;
    }
    .lead_emp_wrapper
    /* width */
     ul.side_emp_asign .emp_list::-webkit-scrollbar {
    width: 5px;
    }

    /* Track */
     ul.side_emp_asign .emp_list::-webkit-scrollbar-track {
    background: #f1f1f1;
    }

    /* Handle */
     ul.side_emp_asign .emp_list::-webkit-scrollbar-thumb {
    background: #888;
    }

    /* Handle on hover */
     ul.side_emp_asign .emp_list::-webkit-scrollbar-thumb:hover {
    background: #555;
    }
    .left_side_total_leads{
        display: flex;
        flex-direction: column;
    }
</style>

<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active"> Employees Performance</li>
                    </ol>
                </div>
                <div>
                    <!--<button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>--->
                </div>
            </div>



            <div class="container-fluid">

                <div class="row">
                    
                    <div class="col-12">
                       <div class="card card-outline-info">
                            
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Employee Performance</h4>
                            </div>
                            
                            <div class="card-body">
      
                                <form id="1ajaxform">
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
                                                      {{-- <a type="button" href="{{ url('employees/'.request()->get('emp_id').'/performace').$list_urls}}" class="btn btn-success"> Search</a> --}}
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <br>
                                                     <a type="button" href="{{ route('getSingleViewLeads').$list_urls}}" class="btn btn-success addButton"> View in Tabular Format</a>
                                                </div>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </form>
                            <div>
                                     @if(!empty(request()->get('camp_id')))
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
                                    $user_dataId = $user_data->id;
                                    $emp_names[] =  $user_data;
                                }
                               // print_r( $emp_names);
                                ?>
                             
                               
                                <div class="lead_emp_wrapper">
                                    <ul class="list-inline left_side_total_leads m-t-40">
                                        <li>
                                            <h5><i class="fa fa-square m-r-5" style="color: #108c36"></i>Total Leads : <span id="Total_Leads">{{ $Grand_total_leads}}</span></h5>
                                        </li>
                                        <li>
                                            <h5><i class="fa fa-square m-r-5" style="color: #e35022"></i>Total Assigned Leads : <span id="Total_Assigned_Leads">{{ $total_Assigned_leads}}</span></h5>
                                        </li>
                                        <li>
                                            <h5><i class="fa fa-square m-r-5" style="color: #251e63"></i>Total Pending Assign Leads : <span id="Total_Pending_Assign_Leads">{{  $total_Pending_Assign_leads }}</span></h5>
                                        </li>
                                       
                                    </ul>
                                    <ul class="side_emp_asign">
                                        <li>
                                            <h5><i class="fa fa-square m-r-5" style="color: #560773"></i>Assigned Emplyee : <span id="Assigned_Emplyee"></span></h5>
                                           <div class="emp_list">
                                               
                                            @foreach($emp_names as $data_latest)
                                            <?php
                                              $emp_user_Id = $data_latest->id;
                                              $Emp_total_leads = App\Models\Lead::where(['source_id'=>request()->get('camp_id'),'asign_to'=>$emp_user_Id])->count();
                                              $emp_urls = '?employee_id='. $emp_user_Id.'&campaign_id='.request()->get('camp_id').'&date_from='.request()->get('date_from').'&date_to='.request()->get('date_to');
                                               ?>
                                                <div><a href="{{ route('getViewLeads').$emp_urls}}">{{$data_latest->name}} ({{ $Emp_total_leads }})</a></div>
                                            @endforeach
                                           </div>
                                           
                                        </li>
                                    </ul>
                                </div>
                                @endif     
                
                                <h2 style="text-align:center" id="title"></h2>
                                
                                <br>

                                <canvas id="emp_chart" height="60"></canvas>
                                
                                <br><br>
                                    
                               <!-- <ul class="list-inline text-center m-t-40">
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #009efb"></i>Pending</h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #e30022"></i>Failed</h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #55ce63"></i>Closed</h5>
                                    </li>
                                </ul>-->
                                
                                 <ul class="list-inline text-center m-t-40">
                                    <li>
                                        <h5><i class="fa fa-square m-r-5" style="color: #009efb"></i>Pending Leads : <span id="emp_pending"></span></h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-square m-r-5" style="color: #e30022"></i>Failed Leads : <span id="emp_failed"></span></h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-square m-r-5" style="color: #55ce63"></i>Closed Leads : <span id="emp_closed"></span></h5>
                                    </li>
                                </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
     
            </div>
            


  
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
$( document ).ready(function() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const camp_id = urlParams.get('camp_id');
        const emp_id = urlParams.get('emp_id');
        const date_from = urlParams.get('date_from');
        const date_to = urlParams.get('date_to');
       var url = '{{ url("new_emp_per") }}?emp_id='+emp_id+'&camp_id='+camp_id+'&date_from='+date_from+'&date_to='+date_to;
        console.log(url);
        $(document).on("click","#sub_cmap",function() {
               var camp_id = $('#camp_id').val();
               var date_from = $('#date_from').val();
               var date_to = $('#date_to').val();
               var base_url = $('meta[name="base_url"]').attr('content');
               var  Current_url = base_url+"/employees/"+emp_id+"/performace?emp_id="+emp_id+"&camp_id="+camp_id+"&date_from="+date_from+"&date_to="+date_to;
                $(window).attr("location",Current_url);
            
        });
        

    $.get(url, function(data, status){
        console.log(data);
        console.log('data');
        
        $("#emp_pending").text(data[0].value);
        $("#emp_failed").text(data[1].value);
        $("#emp_closed").text(data[2].value);
        
        var ctx3 = document.getElementById("emp_chart").getContext("2d");
        var data3 = data;
    
            var myPieChart = new Chart(ctx3).Pie(data3,{
                segmentShowStroke : true,
                segmentStrokeColor : "#fff",
                segmentStrokeWidth : 0,
                animationSteps : 100,
                tooltipCornerRadius: 0,
                animationEasing : "easeOutBounce",
                animateRotate : true,
                animateScale : false,
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
                responsive: true
            });
    });
});
</script>