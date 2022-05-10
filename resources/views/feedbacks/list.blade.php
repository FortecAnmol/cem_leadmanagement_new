@extends('layouts.admin')
<style>
.table td, .table th {
    padding: 7px 0 !important;
    font-size: 12.5px;
    vertical-align: middle !important;
}
.table-striped tbody tr:nth-of-type(odd) {
    background: #f2f4f859 !important;
}
.wraping {
    height: auto !important;
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
         <li class="breadcrumb-item active">Feedbacks</li>
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
               <h4 class="m-b-0 text-white">Notes</h4>
            </div>
            <div class="card-body">
               <!--<h4 class="card-title">Data Export</h4>
                  <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>-->
               <div class="table-responsive m-t-40">
                  <form id="ajaxform">
                     <meta name="csrf-token" content="{{ csrf_token() }}" />
                     <div class="mian-dp">
                        <div class="main-first">
                           <select class="form-control"  name="employee_id" id="employee_id">
                              <option value="">Select Employee</option>
                              @foreach($employees as $employees)
                              @if (old('id') == $employees['id'])
                              <option value="{{ $employees['id'] }}" selected>{{ $employees['name'] }}</option>
                              @else
                              <option value="{{ $employees['id'] }}">{{ $employees['name'] }}</option>
                              @endif
                              @endforeach
                           </select>
                           @if($errors->has('employee_id'))
                           <div class="alert alert-danger">{{ $errors->first('employee_id') }}</div>
                           @endif
                        </div>
                        <div class="main-second">
                           <select class="form-control"   id="lead_id" name="lead_id">
                              <option value="">Select Leads</option>
                           </select>
                        </div>
                        <div class="main-third">
                           <button type="submit" id="submitButton" class="btn btn-success">Search</button>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="col-md-2 col-sm-6 col-xs-12">
                        </div>
                     </div>
                  </form>
                  <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                     <thead>
                        <tr>
                           <th>Campaign Name</th>
 
                           <th>Lead Name</th>
                           <th>Note</th>
                           <th>Date</th>
                           <th>Reminder Date</th>
                           <th>Reminder For</th>
                        </tr>
                     </thead>
                     <tbody></tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
   $(function(){
   
         $('#employee_id').change(function() {
   
           var  employee_id = $(this).val();
           var _token   = $('meta[name="csrf-token"]').attr('content');
           console.log(employee_id);
   
         $.ajax({
             url: '{{route("getLeads")}}',
             type:"POST",
             data:{
               employee_id:employee_id,
               _token: _token
             },
             success:function(response){
             console.log(response);
               $('#lead_id').empty();
   
               $.each(response, function(index, response) {
                 if( employee_id ) {
                     $('#lead_id').append('<option value='+response.id+'>'+response.prospect_first_name+' '+response.prospect_last_name+'</option>');
                 }
           });
   
             },
         });
         
     
   
         $.ajax({
             url: '{{route("getFeedbacks")}}',
             type:"POST",
             data:{
               employee_id:employee_id,
               _token: _token
             },
             success:function(response){
   
                 //console.log(response);
   
                 // $('#showData').html(data);
   
                 $('tbody').empty();
   
               $.each(response, function(index, response) {
   
                 //console.log(response.notes)
   
                 var notes = response.notes;
                  $.each(notes, function(inx, notes) {
                   //console.log(notes.feedback);
                   //var urls = '{{ url('/leads') }}'+'/'+response.id;
         
               $('tbody').append('<tr><td><a href="{{ url('/leads') }}'+'/'+response.id+'">'+response.prospect_first_name+' '+response.prospect_last_name+'</a></td><td class="wraping">'+notes.feedback+'</td><td>'+notes.created_at  +'</td><td>'+notes.reminder_date +'</td><td>'+notes.reminder_for+'</td></tr>');
               });
                  });
   
             },
           });
   
   
   
   
   
         });
   
       $("#submitButton").click(function(event){
   
           event.preventDefault();
      
           var lead_id = $("#lead_id").val();
           var _token   = $('meta[name="csrf-token"]').attr('content');
   
           $.ajax({
             url: '{{route("getFeedbacks")}}',
             type:"POST",
             data:{
               lead_id:lead_id,
               _token: _token
             },
             success:function(response){
   
                 console.log(response);
   
                 // $('#showData').html(data);
   
                 $('tbody').empty();
   
               $.each(response, function(index, response) {
   
               $('tbody').append('<tr><td>'+response.lead.prospect_first_name+' '+response.lead.prospect_last_name+'</td><td>'+response.feedback+'</td><td>'+response.created_at  +'</td><td>'+response.reminder_date +'</td><td>'+response.reminder_for+'</td></tr>');
           });
   
             },
           });
       });
   
     });
   
   
</script>