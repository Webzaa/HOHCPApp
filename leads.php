<!doctype html>
<?php  include 'header.php'; ?>

<?php

session_start();
include 'constant.php';
include_once 'functions.php';

  //print_r($_COOKIE);exit;

  if(!isset($_COOKIE['name']) && $_COOKIE['name'] == ''){

      header('Location: index.php');

  }


if(isset($_COOKIE['token']) && $_COOKIE['token'] != ''){
    

        $url = APIURL.'api/loginCheck';
        $data = '{"token":"'.$_COOKIE['token'].'"}';
        

        $result = APICALL($url,$data);

        //echo'<pre>';print_r($_COOKIE);exit;

        if($result->success)
        {
            
            setcookie('status', $result->ChannelPartner[0]->is_active, time() + (86400 * 30), "/");
         }
         else{
            header('Location: index.php');
            $msg = 'Your logged out of device.';
         }

    }





?>







<style>

  body {

    background-image: none;
    height: auto;
    margin-bottom: 100px;

  }

  section#leads-table th {

    background-color: #f1f1f1 !important;

  }

  span.alert.alert-success {
    position: absolute;
    top: 88%;
    padding:0px;
    left: 0;
    text-align: center;
    width: 100%
}



  table.leadtable {

    width: 100%;

    text-align: center;

  }



  i.fa-solid.fa-angle-down {

    color: #941f53;

  }





  table.table.table-condensed {

    width: 100% !important;

    text-align: center;

}

button.btn.btn-success.exploder {

    background-color: transparent;

    color: #941f53;

    border: none;

}



table.table.table-condensed.table-inner th {

color: #000;

background-color: #fff !important;

}

table.table.table-condensed.table-inner th {

    color: #000;

    background-color: #fff !important;

    font-size: 12px;

    border: none;

}

table.table.table-condensed.table-inner td {

  font-size: 12px;

}

table.table.table-condensed th {

    color: #941f53;

    background-color: #f1f1f1 !important;

}



/* The popup form - hidden by default */

.form-popup {

    display: none;

    position: fixed;

    bottom: 0;

    right: 0px;

    border: 1px solid #444;

    z-index: 9;

    background-color: #fff;

    width: 100%;

    padding: 20px 30px 30px;

}



i.fa-solid.fa-filter {

    position: absolute;
right: 0px;
top: 13px;
    font-size: 25px;

}

.filterhead {

  font-size: 16px;

}

.filterhead-inner {

  font-size: 14px;

}

label.form-check-label {

    font-size: 13px;

    font-weight: 600;

}

.form-check-input:checked[type=radio] {

    padding: 8px;

}

.form-check-input[type=radio] {

    border-radius: 50%;

    padding: 6px;

}

button.btn.clear-filter {

    border: 1px solid #000;

    padding: 2px 40px;

    border-radius: 20px;

}

button.btn.add-apply {

  border: 1px solid #941f53;

    padding: 2px 60px;

    border-radius: 20px;

    color: #fff;

    background-color: #941f53;

}

button.btn.exploder.btn-danger:active {

    color: #941f53;

    background-color: transparent;

    border: none;

}



button.btn.exploder.btn-danger:hover{

   color: #941f53;

    background-color: transparent;

    border: none;

}



.btn-danger {

    --bs-btn-color: #771744;

    --bs-btn-bg: transparent;

    --bs-btn-border-color: transparent;

    --bs-btn-hover-color: #fff;

    --bs-btn-hover-bg: transparent;

    --bs-btn-hover-border-color: transparent;

    --bs-btn-focus-shadow-rgb: 225,83,97;

    --bs-btn-active-color: #fff;

    --bs-btn-active-bg: transparent;

    --bs-btn-active-border-color: transparent;

    --bs-btn-active-shadow: inset 0 3px 5pxrgba(0, 0, 0, 0.125);

    --bs-btn-disabled-color: #fff;

    --bs-btn-disabled-bg: transparent;

    --bs-btn-disabled-border-color: transparent;

}



.btn:hover {

    color: #721641;

    background-color: #bb2d3b00;

    border-color: #b02a3700;

}

.otp-form .otp-field {
  display: inline-block;
 width: 35px;
    height: 35px;
    font-size: 15px;
    line-height: 1px;
  text-align: center;
  border: none;
  border-bottom: 2px solid var(--bs-secondary);
  outline: none;
}

.otp-form .otp-field:focus {
  border-bottom-color: var(--bs-dark);
}

a i.fa-sharp.fa-solid.fa-plus {
    text-decoration: none;
    color: #000;
    font-weight: bold;
}




</style>



<!-- section first start -->

<section id="third-main">

  <div class="container">

    <div class="row d-flex justify-content-between">

      <div class="col-lg-6 col-6"><a href="homescreen.php"><img src="img/lessthanarrow-new.png" class="singlearrow"></a><span>Lead

          Status</span></div>

      <div class="col-lg-6 col-6"> <button type="button btn" class="pagesixhelp" data-bs-toggle="modal" data-bs-target="#myModal">Help</button> </div>

    </div>

  </div>

</section>

<!-- section first end -->



<section id="dropdown-page6">

  <div class="container">

    <form autocomplete="off" id="action_page.php">

      <div class="autocomplete col-lg-6 col-10 offset-1">

        <div class="d-flex justify-content-between">

          <h2 class="headpagesix">Lead Status</h2>

          <!-- <button class="open-button" onclick="openForm()">Open Form</button> -->

          <i class="fa-solid fa-filter" onclick="openForm()">&nbsp;&nbsp;<a href="generateleads.php"><i class="fa-sharp fa-solid fa-plus"></i></a></i>


        </div>



        <!-- form start -->

        <div class="form-popup col-md-12" id="myForm">

            <div class="d-flex justify-content-between">

              <h1 class="filterhead"><strong>Filter Order</strong></h1>

              <button type="button" class="btn cancel" onclick="closeForm()">x</button>

            </div>



            <div class="status-checked">

            <h1 class="filterhead-inner"><strong>Status</strong></h1>

            <div class="form-check">

              <input class="form-check-input" type="radio" name="status" id="flexRadioDefault01" value="Y">

              <label class="form-check-label" for="flexRadioDefault01">

                Approved

              </label>

            </div>

            <div class="form-check">

              <input class="form-check-input" type="radio" name="status" id="flexRadioDefault02" value="N">

              <label class="form-check-label" for="flexRadioDefault02">

                Pending
               

              </label>

            </div>

            <div class="form-check">

              <input class="form-check-input" type="radio" name="status" id="flexRadioDefault02" checked value="All">

              <label class="form-check-label" for="flexRadioDefault02">

                All

              </label>

            </div>

          </div>



               <hr>

               <div class="time-checked">

               <h1 class="filterhead-inner"><strong>Time</strong></h1>

               <div class="form-check">

                 <input class="form-check-input" type="radio" name="time_filter" id="flexRadioDefault1" checked value="anytime">

                 <label class="form-check-label" for="flexRadioDefault1">

                   Anytime

                 </label>

               </div>

               <div class="form-check">

                 <input class="form-check-input" type="radio" name="time_filter" id="flexRadioDefault2" value="last_7_days">

                 <label class="form-check-label" for="flexRadioDefault2">

                   Last 7 days

                 </label>

               </div>

               <div class="form-check">

                 <input class="form-check-input" type="radio" name="time_filter" id="flexRadioDefault3" value="last_30_days">

                 <label class="form-check-label" for="flexRadioDefault3">

                  Last 30 days

                 </label>

               </div>

               <div class="form-check">

                 <input class="form-check-input" type="radio" name="time_filter" id="flexRadioDefault4" value="last_6_months">

                 <label class="form-check-label" for="flexRadioDefault24">

                  Last 6 Months

                 </label>

               </div>

              </div>

              <br>

              <button type="button" class="btn clear-filter">Clear Filter</button>

              <button type="button" class="btn add-apply" id="apply">Apply</button>

        </div>

      </form>



        <!-- form end -->

        

        <input id="project" type="text" name="projects" placeholder="Search for Leads">

      </div>

  </div>

</section>



<!-- table start -->

<div class="container first-container col-sm-12 pull-left">    

  <table class="table table-condensed">

    <thead>

      <tr>

        <th>Name</th>
        <th>Status</th>

      </tr>

    </thead>

    <tbody class="lead-data">



      

    </tbody>

  </table>

</div>

<!-- table end -->







<div class="modal fade" id="exampleModalnew" tabindex="-1" aria-labelledby="exampleModalnewLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalnewLabel">OTP Verification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="card col-12 col-md-8 col-lg-7 p-4">
      <div class="card-body">
        <h4 class="card-title text-center">OTP Verificattion</h4>
        <div class="card-text text-center">
          <form action="" class="otp-form">
            <input class="otp-field" type="text" id="OTP_1" name="opt-field[]" maxlength=1>
            <input class="otp-field" type="text" id="OTP_2" name="opt-field[]" maxlength=1>
            <input class="otp-field" type="text" id="OTP_3" name="opt-field[]" maxlength=1>
            <input class="otp-field" type="text" id="OTP_4" name="opt-field[]" maxlength=1>
            <input class="otp-field" type="text" id="OTP_5" name="opt-field[]" maxlength=1>
            <input class="otp-field" type="text" id="OTP_6" name="opt-field[]" maxlength=1>
            <input type="hidden" name="uniqueid" id="uniqueid">
            <input type="hidden" name="project_id" id="project_id">

            <!-- Store OTP Value -->
            <input class="otp-value" type="hidden" name="opt-value">
             <div class="msg"></div>
            <div class="d-block mt-4">
              <button class="btn btn-primary" type="submit" id="VerifyOTP">Verify</button>
            </div>
          </form>
        </div>
      </div>
    </div> 
      </div>
  
    </div>
  </div>
</div>





















<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>


<script type="text/javascript">

 $('#loading').hide(); 


      mixpanel.track("Lead List", {
        "PageName": lastPathSegment.replace(".php", ""),
        "collateral": "Lead List",
        "ProjectName":'',
        "$user_id": "<?php echo $_COOKIE['username']; ?>",
        "collateralevent": "Lead List",
      });

      
  

</script>


<script>

  function openForm() {

    document.getElementById("myForm").style.display = "block";

  }

  

  function closeForm() {

    document.getElementById("myForm").style.display = "none";

  }

  </script>



<script>

$(document).on('click',".exploder",function(){

  $(this).toggleClass("btn-success btn-danger");

  $(this).children("span").toggleClass("glyphicon-search glyphicon-zoom-out");  



  $(this).closest("tr").next("tr").toggleClass("hide");

  

  if($(this).closest("tr").next("tr").hasClass("hide")){

    $(this).closest("tr").next("tr").children("td").slideUp();

  }

  else{

    $(this).closest("tr").next("tr").children("td").slideDown(350);

  }

});

</script>





<script>



  $(document).ready(function () {

    var href = document.location.href;
    var lastPathSegment = href.substr(href.lastIndexOf('/') + 1);

    if(lastPathSegment == 'leads.php'){

        $("#homescreen p").attr('style','color:#fff');
        $("#collaterals p").attr('style','color:#fff');
        $("#projectalloted p").attr('style','color:#fff');
        $("#generateleads p").attr('style','color:#b9a479');
        $("#units_available p").attr('style','color:#fff');


        $("#homescreen_white").show();
        $("#homescreen_red").hide();

        $("#collaterals_white").show();
        $("#collaterals_red").hide();

        $("#projectalloted_white").show();
        $("#projectalloted_red").hide();

        $("#generateleads_white").hide();
        $("#generateleads_red").show();

        $("#units_available_white").show();
        $("#units_available_red").hide();
    }



    $(document).on('click','#apply',function(){

        GetLeads('')

    })

    GetLeads('');

     $(document).on('click','#ResendOtp',function(){

      var fd = new FormData();

      var id =  $(this).data('id');
      var project_id =  $(this).data('project');

      var time_filter =  $('input[name="time_filter"]:checked').val();

      

      fd.append('token', '<?php echo $_COOKIE['token'] ?>');


      fd.append('id', id);

        $.ajax({

        url: '<?php echo APIURL; ?>api/ResendOTP',

        data: fd,

        processData: false,

        contentType: false,

        type: 'POST',

        success: function (data) {

          $('#uniqueid').val(data.uniqueid);
          $('#project_id').val(project_id);

        }

      })

    })
    


    let lead = [];

    

    $("#project").autocomplete({

      source: lead,

      select: function(event, ui) {

        console.log(ui.item);

        GetLeads(ui.item.id);

      }

    });

    function GetLeads(id) {
      $("#loading").show();

      var fd = new FormData();

      var status =  $('input[name="status"]:checked').val();

      var time_filter =  $('input[name="time_filter"]:checked').val();

      
      var token = '<?php echo $_COOKIE['token'] ?>';
      var username = '<?php echo $_COOKIE['username'] ?>';
      fd.append('token', '<?php echo $_COOKIE['token'] ?>');
      fd.append('username', '<?php echo $_COOKIE['username'] ?>');
      fd.append('status', status);
      fd.append('time_filter', time_filter);
      fd.append('id', id);


      $.ajax({

        url: '<?php echo APIURL; ?>api/GetLeads?token='+token+'&username='+username+'&status='+status+'&time_filter='+time_filter+'&id='+id,
        data: fd,
        processData: false,
        contentType: false,
        type: 'GET',

        success: function (data) {
          $("#loading").hide();

          console.log(data);  

          var html = '';

          

          if(data.LeadData.length > 0){

             $.each(data.LeadData, function (arr, i) {



              lead.push({'label':i.name,'id':i.id});



              



              

                html += '<tr class="sub-container">';

                if(data.cp_id > 0){

                  var date    = new Date(i.created_on),

                  yr      = date.getFullYear(),

                  month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),

                  day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),

                  newDate = day + '/' + month + '/' + yr;



                  html += '<td>'+i.full_name+'</td>';

                  html += '<td><button type="button" class="btn btn-success exploder">';

                  html += '<span class="glyphicon glyphicon-search"> &nbsp; '+i.lead_status+' &nbsp; <i class="fa-solid fa-angle-down"></i></span>';

                  html += '</button></td>';    

                }

                else{

                  var date    = new Date(i.created_date),

                  yr      = date.getFullYear(),

                  month   = date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth(),

                  day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),

                  newDate = day + '/' + month + '/' + yr;

                    html += '<td>'+i.name+'</td>';

                    
                    html += '<td><button type="button" class="btn btn-success exploder">';

                    html += '<span class="glyphicon glyphicon-search"> &nbsp;  '+i.is_verified+' &nbsp; <i class="fa-solid fa-angle-down"></i></span>';

                    html += '</button></td>';

                }

                html += '</tr>';

                html += '<tr class="explode hide">';

                html += '<td colspan="4" style="display: none;">';

                html += '<table class="table table-condensed table-inner">';

                html += '<tbody>';

                if(data.cp_id > 0){

                  html += '  <tr>';

                  html += '    <td>Created Date</td>';

                  html += '    <td>Site Visited On</td>';

                  html += '    <td>Is site visted</td>';

                  html += '  </tr>';

                  html += '  <tr>'

                  html += '    <td>'+i.created_date+'</td>';                

                  html += '    <td>'+i.site_visited_on+'</td>';

                  html += '    <td>'+i.site_visited_yn+'</td>';

                  html += '  </tr>';

                }

                else{

                  html += '  <tr>';

                  html += '    <td>Created Date</td>';

                  // html += '    <td>Email</td>';

                  // html += '    <td>Contact</td>';

                  html += '    <td>Location</td>';

                  html += '  </tr>';

                  html += '  <tr>'

                   html += '    <td>'+i.created_date+'</td>';

                  // html += '    <td>'+i.email+'</td>';

                  // html += '    <td>'+i.mobile+'</td>';

                  html += '    <td>'+i.location+'</td>';

                  html += '  </tr>';

                }

                

                html += '</tbody>';

                html += '</table>';

                html += '</td>';

                html += '</tr>';

             })

           }

           else{

                html += '<tr class="sub-container">';

                html += '<td>No record found.</td>';

                html += '</tr>';

           }



           $(".lead-data").html(html);

           console.log(lead);

        }

      });

    }

    $(document).on('click', '#VerifyOTP', function () {

            //var FormData = new FormData($('#AddLead')[0];

            $(this).attr('disabled', true);



            if ($('#OTP_1').val() == '') {

                $('#OTP_1').addClass('error');

                return false;

            }

            var validation = false;

            if ($('#OTP_1').val() == '') {

                $('#OTP_1').addClass('error');

                validation = true;

            }





            if ($('#OTP_2').val() == '') {

                $('#OTP_2').addClass('error');

                validation = true;

            }





            if ($('#OTP_3').val() == '') {

                $('#OTP_3').addClass('error');

                validation = true;

            }





            if ($('#OTP_4').val() == '') {

                $('#OTP_4').addClass('error');

                validation = true;

            }



            if ($('#OTP_5').val() == '') {

                $('#OTP_5').addClass('error');

                validation = true;

            }



            if ($('#OTP_6').val() == '') {

                $('#OTP_6').addClass('error');

                validation = true;

            }





            if (validation) {

                return false;

            }



            var OTP = $('#OTP_1').val() + '' + $('#OTP_2').val() + '' + $('#OTP_3').val() + '' + $('#OTP_4').val() + '' + $('#OTP_5').val() + '' + $('#OTP_6').val();



            var fd = new FormData();

            var token = '<?php echo $_COOKIE['token'] ?>';

            fd.append('token', '<?php echo $_COOKIE['token'] ?>');

            fd.append('username', '<?php echo $_COOKIE['username'] ?>');

            fd.append('uniqueid', $('#uniqueid').val());

            fd.append('project_id', $('#project_id').val());

            fd.append('OTP', OTP);

            if (token == '') {

                $(".msg").html('<span class="alert alert-success">Your are logged out please login again. </span>');

                setTimeout(function () {

                    window.location.href = "index.php";

                }, 3000);

                return false;

            }

            $.ajax({

                url: '<?php echo APIURL; ?>api/Verify-OTP',

                data: fd,

                processData: false,

                contentType: false,

                type: 'POST',

                success: function (data) {

                    console.log(data.lead);

                    if (typeof (data.msg) != "undefined" && data.msg !== null) {

                        $(".msg").html('<span class="alert alert-success">' + data.msg + ' </span>');

                        setTimeout(function () {
                            $('#exampleModalnew').modal('hide');
                             GetLeads('');


                        }, 1500);



                    }

                    else {

                        $(".msg").html('<span class="alert alert-danger">Lead not added.</span>');



                    }

                }

            });

        })

  })

</script>



</body>



</html>

