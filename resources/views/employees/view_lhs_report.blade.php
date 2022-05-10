@extends('layouts.admin')
@section('content')
<style type="text/css">
    .control-label {
        font-weight: 500;
    }

    .vw-lead .col-md-4 {
        background: #fff;
    }

    .vw-lead .col-md-4 .form-group {
        background: #ffffff;
        padding: 10px 15px;
        text-align: center;
        text-transform: uppercase;
        height: 100%;
        left: 14px;
        position: absolute;
        top: -8px;
        z-index: 5;
        padding-left: 8px;
    }

    .vw-lead .control-label {
        font-weight: 500;
        height: 100%;
        /* vertical-align: top; */
        align-items: center;
        display: flex;
        justify-content: center;
        margin: 0;
        color: #222;
        font-weight: 600;
    }

    .vw-lead.form-body .col-md-8 {
        border: 1px solid #efefef;
        padding-right: 0 !important;
        max-width: 64.5% !important;
        padding: 0;
    }

    .form-body.vw-lead {
        display: inline-block;
        width: 100%;
        padding-left: 15px;
    }

    .vw-lead.form-body .form-group {
        margin-bottom: 0;
    }

    .vw-lead.form-body .form-group .statusbtnmargin {
        margin-bottom: 16px;
        margin-left: 20px;
    }

    .vw-lead .form-body {
        padding-left: 13px;
    }

    .col-md-6.show_lead .form-group input.form-control {
        /* height:calc(2.5em + 1.75rem + 0px) !important; */
        height: 47px !important;
        color: #747474;
        padding-left: 20px;
    }

    .col-md-6.show_lead .form-group input.form-control::-webkit-input-placeholder {
        color: #747474;
    }

    .col-md-6.show_lead .form-group input.form-control:-ms-input-placeholder {
        /* Internet Explorer 10-11 */
        color: #747474;
    }

    .col-md-6.show_lead .form-group input.form-control::placeholder {
        color: #747474;
    }
    a.button_edit_anchor{
        float: right;
        margin-right: 19px;
        margin-top: 16px;
        margin-bottom: -16px;
    }
    .button_edit {
        margin-bottom: 13px;
    }
    span.label.label-success {
        padding: 10px;
    }


    /* new css added 30-12-2021*/
    p.Heraeus {
        padding: 20px 20px;
        font-size: 14px;
        line-height: 1.9;
    }

    .form-body.vd-frm .row>div {
        display: flex;
        flex: 0 0 48%;
        max-width: 48%;
        position: relative;
    }

    .form-body.vd-frm .row {
        justify-content: space-between;
    }

    .form-body.vd-frm .row>div>div>div {
        flex: 0 0 100%;
        max-width: 100%;
    }

    .form-body.vd-frm .row>div>div {
        flex: 0 0 100%;
        max-width: 100%;
        position: relative;
    }

    .form-body.vd-frm .row>div>div>div:first-child {
        position: absolute;
        left: 20px;
        top: -20px;
        z-index: 2;
        background: #fff;
        display: inline;
        flex: 0 0 auto;
        max-width: initial;
        width: auto;
        height: 50%;
        padding: 0 8px;
    }

    .form-body.vd-frm .row>div>div>div .form-control {
        padding: 12px;
        font-weight: 500;
    }

    .vd-frm .control-label {
        font-weight: 700;
        color: #222;
        text-transform: uppercase;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgb(17 57 155 / 43%);
    }

    @media screen and (max-width: 767px) {
        .vw-lead .col-md-8 .form-group input {
            text-align: center;
        }

        .vw-lead.form-body .col-md-8 {
            max-width: 100% !important;
        }
    }
</style>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Dashboard</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            @if(Auth::user()->is_admin == 1)
            <?php  $last_url = redirect()->getUrlGenerator()->previous();  ?>
            <li class="breadcrumb-item"><a href="{{ $last_url }}">View Campaign Leads</a></li>
            @else
            <li class="breadcrumb-item"><a href="{{ url('leads') }}">Leads</a></li>
            @endif
            @if(Auth::user()->is_admin == 1)
            <?php  $last_url = redirect()->getUrlGenerator()->previous();  ?>
            <li class="breadcrumb-item active">View Lead</li>
            @else
            <li class="breadcrumb-item active">View Leads</li>
            @endif
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
            <div class="card card-outline-info table-border-none">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">View page</h4>
                </div>
                 @if(Auth::User()->is_admin != 1)
                 <div class="button_edit">
                        <a class="button_edit_anchor" href="{{ url('/employee/lhs_report/edit', [$data['lead_id']]) }}">
                            <span class="label label-success">Edit Report</span>
                        </a>
                 </div>
                 @endif

                <div class="card-body">
                    <div class="form-body vw-lead">
                        <div class="row p-t-20">
                            <div class="col-md-6 show_lead">
                                <div class="row ">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Contact's Name:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="prospect_first_name"
                                                value="{{ ucfirst($lead_info->prospect_first_name) .' '. ucfirst($lead_info->prospect_last_name)}}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Board Number:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="prospect_last_name"
                                                value="{{ $data->board_no }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-t-20">
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Contact's Designation:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="email"
                                                value="{{ $lead_info->designation }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Direct Number:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="source_name"
                                                value="{{ $data->direct_no }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-t-20">
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Company:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="contact_number_1"
                                                value="{{ $lead_info->company_name }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Ext (if any):</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="contact_number_2"
                                                value="{{ $data->ext_if_any }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-t-20">
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Industry:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="company_industry"
                                                value="{{ $lead_info->company_industry }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Cell Number:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="company_name"
                                                value="{{ $lead_info->contact_number_1 }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-t-20">
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Employees:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="prospect_name"
                                                value="{{ $data->employees_strength }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Email:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="designation"
                                                value="{{ $lead_info->prospect_email }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-t-20">
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Revenue:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="linkedin_address"
                                                value="{{ $data->revenue }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">EA Name:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="bussiness_function"
                                                value="{{ $data->ea_name }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-t-20">
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Address:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="designation_level"
                                                value="{{ $data->address }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">EA Phone Number:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="timezone"
                                                value="{{ $data->ea_phone_no }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-t-20">
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">LinkedIn Profile:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="location"
                                                value="{{ $lead_info->linkedin_address }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">EA Email:</label><br>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="location"
                                                value="{{ $data->ea_email }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-t-20">
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Prospect Level:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="location"
                                                value="{{ $data->prospects_level }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Website:</label><br>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="location"
                                                value="{{ $data->website }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-t-20">
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Prospect Vertical:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="location"
                                                value="{{ $data->prospect_vertical }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Opt-in Status:</label><br>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="location"
                                                value="{{ $data->opt_in_status }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Company Description</h4>
                </div>
                <p class="Heraeus">{{ $data->company_desc }}</p>
                <div class="card-header">
                    <h4 class="m-b-0 text-white">and</h4>
                </div>
                <div class="card-body">
                    <div class="form-body vw-lead Manfred">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-4 show_lead">
                                <div class="row ">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Responsibilities:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="prospect_first_name" value=""
                                                readonly="">{{ $data->responsibilities }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4 show_lead">
                                <div class="row ">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Team Size:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="prospect_first_name" value=""
                                                readonly="">{{ $data->team_size }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Pain Areas:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="prospect_first_name" value=""
                                                readonly="">{{ $data->pain_areas }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4 show_lead">
                                <div class="row ">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Interest/New Initiatives:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="prospect_first_name" value=""
                                                readonly="">{{ $data->interest_new_initiatives }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4 show_lead">
                                <div class="row ">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Budget:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="prospect_first_name" value=""
                                                readonly="">{{ $data->budget }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4 show_lead">
                                <div class="row ">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Defined Agenda:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="prospect_first_name" value=""
                                                readonly="">{{ $data->defined_agenda }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4 show_lead">
                                <div class="row ">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Call Notes:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="prospect_first_name" value=""
                                                readonly="">{{ $data->call_notes }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-t-20">
                            <div class="col-md-6 mb-3 show_lead">
                                <div class="row">
                                    <!-- <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label labelstyle">Contact's Designation:</label>
                              </div>
                           </div> -->
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="email" value=""
                                                readonly>Does the prospect wish to have a Face to Face meeting or teleconference?</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 show_lead">
                                <div class="row">
                                    <!-- <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label labelstyle">Direct Number:</label>
                              </div>
                           </div> -->
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="source_name" value=""
                                                readonly>{{ $data->meeting_teleconference }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 show_lead">
                                <div class="row">
                                    <!-- <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label labelstyle">Contact's Designation:</label>
                              </div>
                           </div> -->
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="email" value=""
                                                readonly>Is the contact the decision maker? If No, then who is?</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 show_lead">
                                <div class="row">
                                    <!-- <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label labelstyle">Contact's Designation:</label>
                              </div>
                           </div> -->
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="email" value=""
                                                readonly>{{ $data->contact_decision_maker }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 show_lead">
                                <div class="row">
                                    <!-- <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label labelstyle">Contact's Designation:</label>
                              </div>
                           </div> -->
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="email" value=""
                                                readonly>Who else would be the influencers in the decision making process?</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 show_lead">
                                <div class="row">
                                    <!-- <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label labelstyle">Contact's Designation:</label>
                              </div>
                           </div> -->
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="email" value=""
                                                readonly>{{ $data->influencers_decision_making_process }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 show_lead">
                                <div class="row">
                                    <!-- <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label labelstyle">Contact's Designation:</label>
                              </div>
                           </div> -->
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="email" value=""
                                                readonly>Is the Company already affiliated with any other similar services? If Yes, Name?</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 show_lead">
                                <div class="row">
                                    <!-- <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label labelstyle">Contact's Designation:</label>
                              </div>
                           </div> -->
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="email" value=""
                                                readonly>{{ $data->company_already_affiliated }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Meeting Information</h4>
                </div>
                <div class="card-body">
                    <div class="form-body vd-frm">
                        <div class="row p-t-20">
                            <div class="col-md-6 show_lead">
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Date 1:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" value="{{ $data->meeting_date1 }}" class="form-control"
                                                readonly="" name="prospect_first_name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Time 1:(24 Hours format)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" value="{{ $data->meeting_time1 }} {{ $data->timezone_1 }}" class="form-control" readonly=""
                                                name="prospect_first_name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-t-20">
                            <div class="col-md-6 show_lead">
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Date 1:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" value="{{ $data->meeting_date2 }}" class="form-control"
                                                readonly="" name="prospect_first_name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Time 1:(24 Hours format)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" value="{{ $data->meeting_time2 }} {{ $data->timezone_2 }}" class="form-control" readonly=""
                                                name="prospect_first_name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
