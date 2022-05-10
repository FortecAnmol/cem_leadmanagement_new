@extends('layouts.admin')

 
@section('content')

<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Upload Bulk Leads</li>
                    </ol>
                </div>
                <div>
                    <!--<button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>--->
                </div>
            </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

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
                        <h4 class="m-b-0 text-white">Upload Bulk Leads</h4>
                    </div>
                    <div class="card-body">
                            <div class="container">
                                <div class="card bg-light mt-3">
                                    <div class="card-body">
                                        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="file" name="file" class="form-control">
                                            @if($errors->has('file'))
                                                    <div class="alert alert-danger">{{ $errors->first('file') }}</div>
                                            @endif
                                            <br><br>
                                            <button class="btn btn-success">Import Bulk Leads</button>
                                            <a class="btn btn-warning" href="{{ url('/public/leads.csv') }}">Download Format</a>

                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection


