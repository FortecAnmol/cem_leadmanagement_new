 
@extends('layouts.admin')

 
@section('content')

<style type="text/css">
    .table-responsive{
        overflow-x: inherit;
    }
    .btns{
        text-align: center;
    }
    .payment-grid{
        text-align: center;
    }
</style>

<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('installment') }}">Installments</a></li>
                        <li class="breadcrumb-item active">Create Installment</li>
                    </ol>
                </div>
                <div>
                    <!--<button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>--->
                </div>
            </div>

    <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Create Installment</h4>
                            </div>
                            <div class="card-body">

 <div class="form-body ">

        <form class="col-md-12" id="instaForm"> 


                    <meta name="csrf-token" content="{{ csrf_token() }}" />

                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Gross</label>
                    <div class="col-md-9">
                        <input type="number" id="total_amount" name="total_amount" placeholder="Amount" class="form-control">
                    </div>
                    </div>
                    <div class="form-group row">
                    <label class="control-label text-right col-md-3">Installments</label>
                    <div class="col-md-9">
                         <input type="number" id="no_of_installment" name="no_of_installment" placeholder="Installments" min="0"class="form-control" onkeyup="calculate_installment()">
                    </div>
                    </div>
                   


                <div class="table-responsive" id="show_installments_table" style="display: none;">
                        <h4 class="m-b-0 payment-grid">Payment Grid</h4><hr>
                    <table class="table color-table info-table table-border">

                        <thead>
                            <!--<tr>
                                <th colspan="2" class="text-center">Payment Grid</th>
                            </tr>-->
                            <tr>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Date</th>
                            </tr>
                        </thead>
                        <tbody id="show_installments_details">
                        </tbody>
                    </table>


          
                    <div class="btns">
                        <button id="updateData" type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Submit</button>
                        <button class="btn btn-inverse" onclick="calculate_installment()">Cancel</button>
                         <button type="button" class="btn btn-info" onclick="window.history.back()">Back</button>
                  
                    </div>
                </div>

            </form>
            </div>

            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
     
    </div>
  

<script>

function calculate_installment() { 

    var total_amount = document.getElementById('total_amount').value;
    var no_of_installment = document.getElementById('no_of_installment').value;
    var i;
    var j;
    var table = document.getElementById("show_installments_details");
    var tab_length = table.rows.length;
     

     if(tab_length > 0) {
         
        for(j=0 ;j < tab_length;){
            table.deleteRow(0);
            tab_length--;
            }
    }


    if(document.getElementById('show_installments_table').style.display != "block")
        document.getElementById('show_installments_table').style.display = "block";

    if(no_of_installment == 0 || no_of_installment == 'Null' )
        document.getElementById('show_installments_table').style.display = "none";

    var installments = parseFloat(total_amount)/parseFloat(no_of_installment);

    for(i=0 ;i < no_of_installment; i++){

        var row = table.insertRow(i);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerHTML = "<input type='text' id='amount"+i+"' name='amount[]' value='"+Math.ceil(installments)+"' class='form-control text-center' readonly>";
         cell2.innerHTML = "<input type='date' id='amountDate"+i+"' name='date[]' class='form-control text-center' required>";

        //result .= "<tr><td><input type='text' name='installment' value='"+Math.ceil(installments)+"' class='form-control'></td><td><input type='date' name='date[]' class='form-control'></td></tr>";
        
    }

    //document.getElementById('show_installments_details').innerHTML = result;


}

/*
$(function(){
                $('#updateData').click(function(){
                    //alert( $('#instaForm').serialize());

                    $.ajax({
                        type : "POST",
                        url : "add-installments1.php",
                        data : $('#instaForm').serialize(),
                        success:function(data){
                            if(data == "2"){
                                alert("Not Updated successfully");

                            }
                            else if(data == "1"){
                                    alert("Please Select All Dates");
                            }
                            else{
                                alert(" Updated successfully");
                  window.location.href='lead-installment.php?id='+data;
                            }

                        }
                    });

                });

            })

*/
 $("#updateData").click(function(event){
      event.preventDefault();
     
      $.ajax({
        url: '{{route("installments.store")}}',
        type:"POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data : $('#instaForm').serialize(),
        success:function(response){

            console.log(response);

            if($.isEmptyObject(response.error)){
                toastr.success(response.success,'Success!')
                  if(response) {
                     $(".print-error-msg").css('display','none');
                    $('.success').text(response.success);
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


</script>

@endsection