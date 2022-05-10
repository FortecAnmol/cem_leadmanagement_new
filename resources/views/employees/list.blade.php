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
</style>
 
@section('content')


<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Employees</li>
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
                                <h4 class="m-b-0 text-white">Employees</h4>
                            </div>

                            <div class="card-body">
                                <!--<h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>-->

                                <a type="button" href="{{ route('employees.create') }}" class="btn btn-success addButton"> + Add Employee</a>

                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th style="padding-left:5px !important" width="50">Sr. No</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Image</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Address</th>
                                                <th>Phone No</th>
                                                <th>Change Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                              @php $i = 1; @endphp
                                            @foreach($data as $data)
                                            <tr>
                                                <td  width="50">{{ $i }}</td>
                                                <td>{{ $data['first_name'] }}</td>
                                                <td>{{ $data['last_name'] }}</td>
                                                 <td><img style="width: 32px;" src="@if(!empty($data['image']))
                                                    {{ url('storage/app/images/'.$data['image']) }}
                                                @else
                                                  {{ url('storage/app/images/default.jpg') }}
                                                @endif"></td>
                                                <td width="400" class="wraping">{{ $data['email'] }}</td>
                                                <td>{{ $data['orignal_password'] }}</td>
                                                <td width="400" class="wraping">{{ $data['address'] }}</td>
                                                <td>{{ $data['phone_no'] }}</td>
                                                <td>@if($data['is_active'] == 2)
                                                    <a href="{{ url('employees/statusUpdate', ['id' => $data['id']]) }}"  ><span  class="label"  data-toggle="tooltip" data-placement="top" title="Deactivate" style="color:#000;font-size: 15px;" onclick="return confirm('Do you want to change manager status to Deactivate ?')"><i class="fa fa-toggle-on" aria-hidden="true"></i></span></a> 
                                                    @else
                                                    <a href="{{ url('employees/statusUpdate', ['id' => $data['id']]) }}"  ><span class="label"  data-toggle="tooltip" data-placement="top" title="Activate" style="color:red;font-size: 15px;" onclick="return confirm('Do you want to change manager status to Activate ?')"><i class="fa fa-toggle-off" aria-hidden="true"></i></span></a>
                                                    @endif
                                                </td>
                                                <td> 
                                                <a href="{{ url('/employees/' . $data['id'] . '/edit') }}"><span class="label"  data-toggle="tooltip" data-placement="top" title="Edit Employee" style="color:#000;font-size: 15px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>
                                                <a href="{{ url('/employees/' . $data['id'] . '/performace?emp_id='.$data['id'].'&camp_id=&date_from=&date_to=') }}"><span class="label"  data-toggle="tooltip" data-placement="top" title="View Perfomance" style="color:#000;font-size: 15px;"><i class="fa fa-bar-chart" aria-hidden="true"></i></span></a>
                                                <a href="{{ url('employees/delete', ['id' => $data['id']]) }}"  ><span class="label" data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;font-size: 15px;" onclick="return confirm('Are you sure you want to delete this employee ?')"><i class="fa fa-trash" aria-hidden="true"></i></span></a>
                                                

                                            </td>
                                                @php $i = $i+1; @endphp
                                            </tr>
                                             @endforeach
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme working">4</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                                <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                                <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>Chat option</b></li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
  <script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
@endsection

