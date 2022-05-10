{{-- <style>
    /* Start by setting display:none to make this hidden.
   Then we position it in relation to the viewport window
   with position:fixed. Width, height, top and left speak
   speak for themselves. Background we set to 80% white with
   our animation centered, and no-repeating */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: rgba(255, 255, 255, .8) url('http://i.stack.imgur.com/FhHRx.gif') 50% 50% no-repeat;
    }

    /* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
    body.loading {
        overflow: hidden;
    }

    /* Anytime the body has the loading class, our
   modal element will be visible */
    body.loading .modal {
        display: block;
    }
</style> --}}
@extends('layouts.admin')
@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Dashboard</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Export Leads </li>
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
                    <h4 class="m-b-0 text-white">Export Leads </h4>
                </div>

                <div class="card-body">
                    <h1> EXPORT PDF AND EXCEL</h1>
                    <a href="{{ url('lead/export') }}" id="loading" class="btn btn-info pull-right">Leads
                        Reports Download</a>
                    {{-- <div class="modal">
                        <!-- Place at bottom of page -->
                    </div> --}}
                    <a href="{{ url('lead/exportCsv') }}" class="btn btn-info pull-right">Lead
                        Download</a>
                </div>
            </div>

        </div>
    </div>


</div>
{{-- <script>
    $body = $("body");

$(document).on({
    ajaxStart: function() { $body.addClass("loading");    },
     ajaxStop: function() { $body.removeClass("loading"); }
});
</script> --}}
@endsection
