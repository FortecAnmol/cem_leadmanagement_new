<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Table</title>
    <link href="css/style.css" rel="stylesheet">


</head>

<body>
    <?php
    $data = App\Models\Lead::where('status', 3)->first();
    ?>

    <section class="Prospect_sec">
        <div class="container">
            <div class="logo" style="text-align: center; padding: 20px 0; border-top: 10px solid #d3e215;">
                <img src="{{ asset('public/admin/assets/images/logo.png') }}">


            </div>
            <div class="Prospect_heading" style="background-color: #404040; color: #fff; padding: 10px 10px;">
                <h5 style="margin: 0;">Prospect Information</h5>
            </div>

            <table style="width:100%; border: 1px solid black; border-collapse: collapse;">
                <tr>
                    <th style="width:15%; background-color: #fff; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Contact's Name:</th>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        {{ $prospect_first_name." $prospect_last_name" }}
                    </td>
                    <th style="width:15%; background-color: #fff; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Board Number:</th>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        {{ $board_no }}
                    </td>
                </tr>
                <tr>
                    <th style="width:15%; background-color: #c9d8fe; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Contact's Designation:</th>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;     background-color: #c9d8fe;">
                        {{ $designation }}
                    </td>
                    <th style="width:15%; background-color: #ebebeb; font-size: 13px; border: 1px solid black; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left; background-color: #c9d8fe;">
                        Direct Number:</th>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left; background-color: #c9d8fe;">
                        {{$direct_no}}
                    </td>
                </tr>
                <tr>
                    <th style="width:15%; background-color: #fff; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Company:</th>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        {{ $company_name }}
                    </td>
                    <th style="width:15%; background-color: #fff; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Ext (if any):</th>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        {{$ext_if_any}}
                    </td>
                </tr>
                <tr>
                    <th style="width:15%; background-color: #c9d8fe; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Industry:</th>
                    <td style="width:35%; font-size: 12px; border: 1p   x solid black; border-collapse: collapse; padding: 10px; text-align: left; background-color: #c9d8fe;">
                        {{ $company_industry }}
                    </td>
                    <th style="width:15%; background-color: #c9d8fe; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Cell Number:</th>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left; background-color: #c9d8fe;">
                        {{ $contact_number_1 }}
                    </td>
                </tr>
                <tr>
                    <th style="width:15%; background-color: #fff; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Employees:</th>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        {{$employees_strength}}
                    </td>
                    <th style="width:15%; background-color: #fff; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Email:</th>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        {{ $prospect_email }}
                    </td>
                </tr>
                <tr>
                    <th style="width:15%; background-color: #c9d8fe; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Revenue:</th>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left; background-color: #c9d8fe;">
                        {{$revenue}}
                    </td>
                    <th style="width:15%; background-color: #c9d8fe; font-size: 13px; border: 1px solid black; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        EA Name:</th>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left; background-color: #c9d8fe;">
                        {{$ea_name}}
                    </td>
                </tr>
                <tr>
                    <th style="width:15%; background-color: #fff; font-size: 13px; border: 1px solid black; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Address:</th>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        {{$address}}
                    </td>
                    <th style="width:15%; background-color: #fff; font-size: 13px; border: 1px solid black; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        EA Phone Number:</th>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        {{$ea_phone_no}}
                    </td>
                </tr>
                <tr>
                    <th style="width:15%; background-color: #c9d8fe; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        LinkedIn Profile:</th>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left; background-color: #c9d8fe;">
                        {{ $linkedin_address }}
                    </td>
                    <th style="width:15%; background-color: #c9d8fe; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        EA Email:</th>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left; background-color: #c9d8fe;">
                        {{$ea_email}}
                    </td>
                </tr>
                <tr>
                    <th style="width:15%; background-color: #fff; font-size: 13px; border: 1px solid black; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Prospect Level:</th>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        {{$prospects_level}}
                    </td>
                    <th style="width:15%; background-color: #fff; font-size: 13px; border: 1px solid black; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Website:</th>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        {{$website}}
                    </td>
                </tr>
                <tr>
                    <th style="width:15%; background-color: #c9d8fe; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Prospect Vertical:</th>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left; background-color: #c9d8fe;">
                        {{$prospect_vertical}}
                    </td>
                    <th style="width:15%; background-color: #c9d8fe; font-size: 13px; border: 1px solid black; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Opt-in Status:</th>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left; background-color: #c9d8fe;">
                        {{$opt_in_status}}
                    </td>
                </tr>

            </table>
            <div class="Prospect_heading" style="background-color: #404040; color: #fff; padding: 10px 10px;">
                <h5 style="margin: 0;">Company Description</h5>
            </div>
            <table style="width:100%; border: 1px solid black; border-collapse: collapse;">
                <tr>
                    <td style="width:35%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        {{$company_desc}}
                    </td>
                </tr>
            </table>
            <div class="Prospect_heading" style="background-color: #404040; color: #fff; padding: 10px 10px;">
                <h5 style="margin: 0;">and</h5>
            </div>
            <table style="width:100%; border: 1px solid black; border-collapse: collapse;">
                <tr>
                    <th style="width:20%; background-color: #fff; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Responsibilities:</th>
                    <td style="width:80%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        {{ $responsibilities }}
                    </td>
                </tr>
                <tr>
                    <th style="width:20%; background-color: #c9d8fe; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Team Size:</th>
                    <td style="width:80%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;     background-color: #c9d8fe;">
                        {{$team_size}}
                    </td>
                </tr>
                <tr>
                    <th style="width:20%; background-color: #fff; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Pain Areas:</th>
                    <td style="width:80%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        {{$pain_areas}}
                    </td>
                </tr>
                <tr>
                    <th style="width:20%; background-color: #c9d8fe; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Interest/New Initiatives:</th>
                    <td style="width:80%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;     background-color: #c9d8fe;">
                        {{$interest_new_initiatives}}
                    </td>
                </tr>
                <tr>
                    <th style="width:20%; background-color: #fff; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Budget:</th>
                    <td style="width:80%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        {{$budget}}
                    </td>
                </tr>
                <tr>
                    <th style="width:20%; background-color: #c9d8fe; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Defined Agenda:</th>
                    <td style="width:80%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;     background-color: #c9d8fe;">
                        {{$defined_agenda}}
                    </td>
                </tr>
                <tr>
                    <th style="width:20%; background-color: #fff; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Call Notes:</th>
                    <td style="width:80%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        {{$call_notes}}
                    </td>
                </tr>
            </table>
            <table style="width:100%; border: 1px solid black; border-collapse: collapse;">
                <tr>
                    <td style="width:60%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Does the prospect wish to have a Face to Face meeting or teleconference?</td>
                    <td style="width:60%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        {{$meeting_teleconference}}
                    </td>
                </tr>
                <tr>
                    <td style="width:60%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left; background-color: #c9d8fe;">
                        Is the contact the decision maker? If No, then who is?</td>
                    <td style="width:60%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left; background-color: #c9d8fe;">
                        {{$contact_decision_maker}}
                    </td>
                </tr>
                <tr>
                    <td style="width:60%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Who else would be the influencers in the decision making process?</td>
                    <td style="width:60%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        {{$influencers_decision_making_process}}
                    </td>
                </tr>
                <tr>
                    <td style="width:60%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left; background-color: #c9d8fe;">
                        Is the Company already affiliated with any other similar services? If Yes, Name?</td>
                    <td style="width:60%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left; background-color: #c9d8fe;">
                        {{$company_already_affiliated}}
                    </td>
                </tr>
            </table>
            <div class="Prospect_heading" style="background-color: #404040; color: #fff; padding: 10px 10px;">
                <h5 style="margin: 0;">Meeting Information</h5>
            </div>
            <table style="width:100%; border: 1px solid black; border-collapse: collapse;">
                <tr>
                    <th style="width:20%; background-color: #fff; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Date 1:</th>
                    <td style="width:30%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        {{$meeting_date1}}
                    </td>
                    <th style="width:20%; background-color: #fff; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Time 1:(24 Hours format)</th>
                    <td style="width:30%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        {{$created_at}}
                    </td>
                </tr>
                <tr>
                    <th style="width:20%; background-color: #c9d8fe; font-size: 13px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;">
                        Date 1:</th>
                    <td style="width:30%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left;     background-color: #c9d8fe;">
                        {{$meeting_date2}}
                    </td>
                    <th style="width:20%; background-color: #ebebeb; font-size: 13px; border: 1px solid black; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left; background-color: #c9d8fe;">
                        Time 1:(24 Hours format)</th>
                    <td style="width:30%; font-size: 12px; border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: left; background-color: #c9d8fe;">
                        {{$updated_at}}
                    </td>
                </tr>
            </table>
        </div>
    </section>





</body>

</html>
