@extends('layouts.admin')

 
@section('content')
<style>

.checl_all_leads {
    width: 34%;
    float: right;
    margin-top: 18px;
    padding: 10px 10px 10px 10px;
    background: #192e62;
    border: 1px solid #192e62;
    color: white;
    border-radius: 0.25rem;
}
.checl_all_leads h4 {
    color: white;
    font-size: 16px;
}
.form-control.error {
    border-color: red;
}
.row.appendd {
    margin: 0;
}
.table-responsive {
    overflow-x: hidden;
}
button:disabled,
button[disabled]{
  border: 1px solid #999999 ;
  background-color: #cccccc !important;
  color: #666666;
}
.form-control:disabled, .form-control[readonly] {
    background-color: #e9ecef !important;
    opacity: 1!important;
    border: 1px solid #ced4da !important;
    border-radius: 0.25rem !important;
}
.append_row td {
    text-align: left;
    width: 25%;
    color: #67757c;
    border-color: #e7e7e7;
    background: #fff;
    padding: 15px 10px;
}

.append_row td:nth-child(odd) {
    font-weight: 500;
    background: #f4f4f4;
}

.append_row {
    padding: 4% 6% 3%;
    margin: 20px auto 40px;
    background: #192e62;
}
.change_lead .total_lead {
    position: absolute;
    right: 20px;
    top: 33px;
}
.change_lead .total_lead [type=checkbox]+label:before {
    background: #fff;
}
.change_lead {
    position: relative;
}
.before_append.col-md-12 > div {
    max-width: 400px;
    margin: 0 auto;
}
.appended_items {
    float: left;
    margin: 0;
    display: contents;
}
.appended_items + div{
    float: right;
}
span.error_msg {
    color: red;
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
                        <li class="breadcrumb-item active">Assign Leads</li>
                    </ol>
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

                         @if($errors->has('lead_id'))
                            <div class="alert alert-danger">{{ $errors->first('lead_id') }}</div>
                        @endif
                        
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Assign Leads</h4>
                            </div>
                               <form class="form-horizontal form-label-left input_mask" >
                                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                                    <div class="card-body">
                                       <div class="table-responsive m-t-40">
                                           <div class="row">
                                            @csrf
                                                <div class="col-sm-6 col-md-6 before_append">
                                                     <div class="form-group">
                                                     <label class="control-label">Select Campaign</label>
                                                        <select  name="source_id" id="source_id" class="form-control custom-select" data-placeholder="Select Campaign" tabindex="1">
                                                            <option value="">Select Campaign</option>
                                                            @foreach($sources as $sources)
                                                                    <option value="{{ $sources['id'] }}">{{ $sources['source_name'] }} ({{ $sources['description'] }})</option>
                                                            
                                                            @endforeach
                                                        
                                                        </select>
                                                        @if($errors->has('source_id'))
                                                            <div class="alert alert-danger">{{ $errors->first('source_id') }}</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="appended_items">
                                                </div>

                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Select Employee</label>
                                                        <select class="form-control"  name="employee_id" id="employee_id">
                                                                        <option value="">Select Employee</option>
                                                                        @foreach($employees as $employees)
                                                                        <option value="{{ $employees['id'] }}">{{ $employees['name'] }}</option>
                                                                        
                                                                        @endforeach
                                                       </select>
                                                    </div>
                                                    
                                                </div>
                                               
                                                
                                                
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                            <div class="second">
                                                                <button type="submit" id="save_particular_lead" class="btn btn-success">Assign Leads</button>
                                                            </div>  
                                                    </div>
                                                </div>

                                                <div class="add_table col-md-12">
                                                
                                                
                                                    
                                                </div> 
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        

 
  
@endsection
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
     $(document).ready(function () {
        var total_leadcount = $('#total_leads').val();
        $("#start_assign_id").val(total_leadcount);

        $(document).on('click', 'input#all_leads' , function () {   
           // alert('hererre');  
            if ($('input#all_leads').is(':checked')) {    
               
               $('#start_assign_id').prop('readonly', !$(this).is(':checked'));    
             }else{
                $('#start_assign_id').prop('readonly', true);
            }
        });
         $("#source_id").change(function(){
           var camp_id =  $(this).find(":selected").val();

           $('.before_append').removeClass('col-md-6').addClass('col-md-12');
           
            //alert(camp_id);
                $.ajax({
                type: 'GET',
                dataType: "html",
                data: {camp_id:camp_id},
                url: "{{route("leads.campname")}}",
                success: function (data) {                    
                    var obj = jQuery.parseJSON(data) ;
                    $(".append_element").hide();
                    $('.appended_items').html(obj.data);
                   $(".add_table").html(obj.table);
                    var assign_lead1 =   $('input[name = start_assign_id]').val();
                    if(assign_lead1 == 0){
                        $("#save_particular_lead").prop("disabled", true);
                    }else{
                        $("#save_particular_lead").prop("disabled", false);
                    }

                }
            });
        });  
        
        $("#save_particular_lead").click(function(event) {
            event.preventDefault();
            var assign_leads = $("#start_assign_id").val();
            var total_Lead_count = parseInt($(".getleadTotalcount").text());
            let _token   = $('meta[name="csrf-token"]').attr('content');
            if($("#start_assign_id").val() <= total_Lead_count){
                var total_leads = assign_leads;
            }else{
                $('#start_assign_id').addClass('error');
                $(".error_msg").text("Please Enter Valid Leads");
                return false;
            }
            var employee_id = $("#employee_id").val() === "";
            if(total_leads != "" && employee_id != true){
                $(".error_msg").hide();
                $('#start_assign_id').removeClass('error');
                $('#employee_id').removeClass('error');
                var emp_id = $("#employee_id").val();
                var cmp_id = $("#source_id").val();
                console.log(emp_id,'emp_id');
                console.log(cmp_id,'cmp_id');
                $.ajax({
                type: 'POST',
                dataType: "json",
                data: {assign_leads:assign_leads,emp_id:emp_id,cmp_id:cmp_id,_token: _token},
                url: "{{route("leads.assingParticalurleads")}}",
                success: function (data) {
                    console.log(data);
                    $(".alert.alert-success").text("Lead assigned successfully");
                   $("#start_assign_id").val(data.data);
                   $(".Change_lead_count").text(data.data);
                   $(".add_table").html(data.table);
                }
               });
               
            }else{
                $('#employee_id').addClass('error');
                $('#source_id').addClass('error');
                return false;
            }
        

        }); 


    });     
</script>
