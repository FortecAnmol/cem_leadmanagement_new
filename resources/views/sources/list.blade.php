@extends('layouts.admin')
<style>
    .table td, .table th {
    padding:5px 0 !important;
    font-size: 12.5px;
}
.table-striped tbody tr:nth-of-type(odd) {
    background: #f2f4f859 !important;
}
#exampleModal .modal-dialog {
    max-width: 340px;
}

#exampleModal .modal-dialog select {
    border: 1px solid #ccc;
    width: 100%;
    padding: 8px;
    border-radius: 5px;
    font-size: 12.5px;
}
#exampleModal .modal-header {
    background: #081840;
    border-color: #081840;
    border-radius: 0.3rem 0.3rem 0 0;
}

#exampleModal .modal-header .modal-title {
    color: #fff;
}
#exampleModal .modal-content {
    border: none;
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
                        <li class="breadcrumb-item active">Campaigns</li>
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
                                <h4 class="m-b-0 text-white">Campaigns</h4>

                            </div>
                            
                            <div id="myModal" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Add Lable</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="ajaxform">

                                      <meta name="csrf-token" content="{{ csrf_token() }}" />
                                                        
                                                    <div class="alert alert-danger print-error-msg" style="display:none">
                                                        <ul></ul>
                                                    </div>

                                                            <div class="form-group">
                                                                <label class="col-md-12">Date</label>
                                                                <div class="col-md-12">
                                                                    <input type="date" class="form-control" placeholder="Date" name="date"> </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label class="col-md-12">Amount</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" class="form-control" placeholder="Amount" name="amount"> </div>
                                                            </div>
                                                            
                                                            
                                                            <input type="hidden" id="source_id" name="source_id">
                                                        </from>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-info waves-effect save-data" data-dismiss="modal">Save</button>
                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

                            <div class="card-body">
                                <!--<h4 class="card-title">Data Export </h4>
                               <h6 class="card-subtitle">Copy, CSV, PDF & Print</h6>-->
                               <a type="button" href="{{ route('sources.create') }}" class="btn btn-success addButton"> + Add Campaign</a>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th style="padding-left:5px !important" width="50">Sr. No</th>
                                                {{-- <th>Campaign Id</th> --}}
                                                <th width="200">Campaign</th>
                                                <th width="200">Sub-Campaign Name</th>
                                                <th width="50">Total Leads</th>
                                                {{-- {{-- <th>Start Date</th> --}}
                                                {{-- <th>End Date</th> --}}
                                                <th>Manager</th>
                                                <th>Created On </th>
                                                <th>Modified On </th>
                                                <!--<th>Total Amount</th>-->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = 1; @endphp
                                            @foreach($data as $data)
                                            <tr>
                                                <td width="50">{{$i}}</td>
                                                {{-- <td>{{$data['id']}}</td> --}}
                                                <td style="white-space: pre-wrap" width="200"><span>{{$data['source_name']}}</span></td>
                                                <td style="white-space: pre-wrap" width="200"><span>{{$data['description']}}</span></td>
                                                <?php
                                               $data_src = App\Models\Lead::where(['source_id'=>$data['id']])->select(DB::raw('COUNT(source_id) as totalLeads'))->groupBy('source_id')->first();                                     
                                                ?>
                                                @if (empty($data_src->totalLeads))
                                                <td>N/A</td>
                                                @else
                                                <td>{{$data_src->totalLeads}}</td>
                                                @endif
                                                {{-- <td>{{$data['start_date']}}</td> --}}
                                                {{-- <td>{{$data['end_date']}}</td> --}}
                                                <?php
                                                $user_check = Auth::user()->is_admin;
                                                // if(empty($user_check)){
                                                    if(!empty($data['assign_to_manager'])){
                                                        $assigned_manager = $data['assign_to_manager'];
                                                        $manager_data = App\Models\User::where(['id'=>$assigned_manager,'is_admin'=>'2'])->first();
                                                       //echo"<pre>";print_r($manager_data);echo"</pre>";
                                                        $manager_name = $manager_data->name;
                                                      
                                                       }else{
                                                           $manager_name = 'N/A';
                                                       }
                                                // }else{
                                                //     $manager_name = 'N/A';
                                                // }
                                                
                                               ?>
                                               <td>{{ $manager_name }}</td>
                                                <!--@if(!empty($data['amount']))
                                                <td>Rs.{{$data['amount']}}/--</td>
                                                @else
                                                <td>Rs.0/--</td>
                                                @endif-->
                                                
                                                <td>{{ date('d-m-Y', strtotime($data['created_at'])) }}</td>
                                                <td>{{date('d-m-Y', strtotime($data['updated_at']))}}</td>
                                                <td>
                                                   
                                                @if(empty($user_check))
                                                        <!--<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal"><span class="label label-info" onclick="document.getElementById('source_id').value={{$data['id']}}">Add Money</span></a>--->
                                                    @if(!empty($data['assign_to_manager']))
                                                    <a href="javascript:void(0);"><span class="label label-warning">Assigned</span></a>
                                                    @else
                                                    <a href="#" class="assignToManagerBtn" id="campaign_id_new" campaign_id_new="<?php echo $data['id']; ?>" campaign_id="<?php echo $data['id']; ?>"><span  data-toggle="modal" data-target="#exampleModal"  class="label label-warning">Assign to Manager</span></a>
                                                    @endif
                                                @endif
                                                <a href="{{ url('/sources/' . $data['id'] . '/leadview') }}"><span
                                                    class="label" data-toggle="tooltip" data-placement="top" title="View Leads" style="color:#000;font-size: 15px;">
                                                    <i class="fa fa-eye" aria-hidden="true"></i></span></a>
    
                                            <a href="{{ url('/sources/' . $data['id'] . '/edit') }}"><span
                                                class="label"  data-toggle="tooltip" data-placement="top" title="Edit Campaign" style="color:#000;font-size: 15px;">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>
    
                                            <a href="{{ url('sources/delete', ['id' => $data['id']]) }}"><span
                                                class="label" data-toggle="tooltip" data-placement="top" title="Delete Campaign" style="color:red;font-size: 15px;"
                                                    onclick="return confirm('Are you sure you want to delete this source ?')">
                                                    <i class="fa fa-trash" aria-hidden="true"></i></span></a>
                                            <a href="{{ url('/lead/exportCsv/' . $data['id']). '/report_down' }}"><span
                                                   class="label" data-toggle="tooltip" data-placement="top" title="Download Excel Report" style="color:#000;font-size: 15px;">
                                                    <i class="fa fa-file-excel-o" aria-hidden="true"> </i></span></a>
                                                @if(empty($data['closed_leads']))
                                                <a>
                                                    <a href="javascript:void(0)"><span
                                                        class="label" data-toggle="tooltip" data-placement="top" title="LHS Report Creation Pending" style="color:#1a1a1a;font-size: 15px; filter: blur(0.8px);"> <i class="ti-download"> </i></span>
                                                 </a>
                                                </a>
                                            @else
                                            <a href="{{ url('/lead/export/' . $data['id']). '/pdf_down' }}"><span
                                                class="label" data-toggle="tooltip" data-placement="top" title="Word Download" style="color:#55ce63;font-size: 15px;"> <i class="ti-download"> </i></span>
                                         </a>
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

    <!-- =========== MODAL POPUP ================ -->
    <?php
    $managers = DB::table('users')->where('is_admin', 2)->where('deleted_at', NULL)->get();
    $url = Config::get('app.url');
    ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Campaign Assign</h5> 
                </div>
                <div class="modal-body">
                    <input type="hidden" id="campaign_id" value="0" baseUrl="{{ $url }}">
                    <select id="manager">
                        <option value="0">Choose Manager</option>
                         <?php foreach($managers as $manager) { ?>
                            <option value="<?php echo $manager->id; ?>">
                                <?php echo $manager->name; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                    <button type="button" id="assignToManagerPopupBtn" class="btn btn-success">Assign to Manager</button>
                </div>
            </div>
        </div>
    </div>

      <!-- Button trigger modal -->
 <script>
    $( document ).ready(function() {
        $(".assignToManagerBtn").click(function(e) {
            e.preventDefault();
            let  campaign_id = $(this).attr('campaign_id');
            $("#campaign_id").val(campaign_id);

        });

        $("#assignToManagerPopupBtn").click(function() {
            let  baseUrl = $("#campaign_id").attr("baseUrl");
            let  campaign_id = $("#campaign_id").val();
            let  campaign_id_new = $("#campaign_id_new").attr("campaign_id_new");
            let  managerId = $("#manager option:selected").val();
            if((campaign_id_new != 0) && (managerId != 0)) {
                window.location.replace(baseUrl+"/sources/"+campaign_id_new+"/camp_assign?assignedTo="+managerId);
            } else {
                alert("Please Choose Manager To Proceed..");
            }
            //alert(managerId+"--"+campaign_id);
           // $("#campaign_id").val(campaign_id);

        });
    });

  $(".save-data").click(function(event){
      event.preventDefault();
     
      let date = $("input[name=date]").val();
      let samount = $("input[name=amount]").val();
      let source_id = $("input[name=source_id]").val();
      let _token   = $('meta[name="csrf-token"]').attr('content');


//alert(date+"**"+samount+"**"+source_id+"**"+_token);

      $.ajax({
        url: '{{route("updateAmount")}}',
        type:"POST",
        data:{
          source_id:source_id,
          date:date,
          amount:samount,
          _token: _token
        },
        success:function(response){

            console.log(response);

            if($.isEmptyObject(response.error)){
                toastr.success(response.success,'Success!')
                  if(response) {
                     $(".print-error-msg").css('display','none');
                    $('.success').text(response.success);

                    setTimeout(reloadPage, 1000);
                    
                    $("#ajaxform")[0].reset();
                  }

            }else{
                printErrorMsg(response.error);
            }

        },
       });


      function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }


  });


    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
  
@endsection

