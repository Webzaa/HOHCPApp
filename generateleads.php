<!doctype html>

<?php  include 'header.php'; ?>

<?php
    
    include 'constant.php';

   if(!isset($_COOKIE['name']) && $_COOKIE['name'] == ''){

       header('Location: index.php');

   }

?>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>

     body {

    background-image: url(./img/whitebg.jpg);

    background-repeat: no-repeat;

    background-position: center;

    height: 100vh;
    font-family: "Roboto", sans-serif !important;

    padding-bottom: 100px;

    margin: 0;

    background-size: cover;

    background-position: center;

    padding: 0;

    overflow: inherit;

}

.error {
    border-color: red;
}

span.alert.alert-success {

    font-size: 23px;

    padding: 10px 25px;

    position: absolute;

    top: 71%;
    width: 100%;
    right: 0;

}

.mt-5 {
    margin-top: 0rem!important;
}

.msg {
    text-align: center;
    margin: 30px auto;
}

.alert-danger {
    --bs-alert-color: #842029;
    --bs-alert-bg: #f8d7da;
    --bs-alert-border-color: #f5c2c7;
    padding: 10px 120px;
    text-align: center;
    margin: 10px auto;
}

    #otpform .bgWhite {

        background: white;

        box-shadow: 0px 3px 6px 0px #cacaca;

    }



    #otpform .title {

        font-weight: 600;

        margin-top: 20px;

        font-size: 24px

    }



    #otpform .customBtn {

        border-radius: 0px;

        padding: 10px;

    }



    #otpform form input {

        display: inline-block;

        width: 50px;

        height: 50px;

        text-align: center;

    }

    #AddLead input#project {

    margin: 15px 0px;

    background-color: #c4bdbd;

    color: #fff;

}

.skipp {
    position: absolute;
    right: 20px;
    padding-top: 20px;
}


  .select2 {
    width: 100%!important; /* force fluid responsive */
    padding: 5px;
  }
  
  .select2-container {
    
    .select2-selection--single {
       height: 56px;
       position: relative;
      
      .select2-selection__rendered {
        line-height: 56px;
      }
    
      .select2-selection__arrow {
        top: 16px;
        right: 8px;
      }
  
      .select2-container--default {

        .select2-results>.select2-results__options {
          -webkit-overflow-scrolling: touch; /* use momentum scrolling */
        }
      }
    }      
  }
}

.disclaim {
    margin-top: 20px;
}

</style>

<form id="ProjectLeads" action="leads.php" method="POST">

    <input type="hidden" name="project_id" id="project_id_edit">



</form>

<!-- section first start -->

<section id="generatelead-main ">

    <div class="container">

        <div class="row d-flex justify-content-between">

            <div class="col-lg-6 col-6 arroww"><a href="homescreen.php" ><img src="img/lessthanarrow-new.png" class="singlearrow"></a>

                <span> &nbsp; Generate Lead</span>

            </div>

            <div class="col-lg-6 col-6"> <button type="button btn" class="pagesixhelp" data-bs-toggle="modal" data-bs-target="#myModal">Help</button> </div>

        </div>

    </div>

</section>

<!-- section first end -->



<section id="generate-lead">

    <div class="generatelead-inner">

        <div class="container">

            <h2 class="generate-leadhead" style="color: #941f53;">GENERATE LEAD</h2>

            <form id="AddLead">



                <?php 

                    if(isset($_POST['project_id']) && $_POST['project_id'] > 0){

                        echo '<input type="hidden" id="project_id" name="project_id" value="'.$_POST['project_id'].'">';

                    }

                    else{

                       echo '<div class="select-dropdown">
                                       <select class="select2" id="multiple-select-field">

                                       </select>
                             <input type="hidden" id="project_id" name="project_id" value="">          
                             </div>';

                    }



                ?>

                <div class="mb-3">

                    <input typ e="text" class=" generateleadform" id="generateleadname" placeholder="Name*"

                        aria-describedby="emailHelp" required>

                </div>

                <div class="mb-3">

                    <input type="email" class=" generateleadform" id="generateleademail" placeholder="Email ID*"

                        aria-describedby="generateemailHelp" required>

                </div>

                <div class="mb-3">

                    <input type="number" class=" generateleadform" id="generateleadnumber" placeholder="Mobile Number*"

                        aria-describedby="generatemobileHelp" required>

                </div>

                <div class="mb-3">

                    <input type="text" class=" generateleadform" id="generateleadlocation" placeholder="Location*"

                        aria-describedby="generatelocationHelp" required>





                </div>



                <button type="Submit" class="btn btn-primary col-12  add-lead" id="enquire-btn" href="#">

            Submit

        </button>

            </form>

        </div>

    </div>

</section>

<section id="enquirebtn">

    <div class="msg"></div>

</section>

<!-- <section id="enquirebtn">

    <div class="enquirebtn-inner">

        

    </div>

</section> -->

<section id="otpform" style="display: none;">

    <div class="container">

        <div class="row justify-content-md-center">

            <div class="col-md-4 text-center">

                <div class="row">

                    <div class="col-sm-12 mt-5 bgWhite">
                         <div class="skipp">
                            <a href="leads.php">Skip</a>
                         </div>
                        <div class="title">

                            Verify OTP

                        </div>



                        <form action="" class="mt-5">

                            <input class="otp" id="OTP_1" type="text" oninput='digitValidate(this)'

                                onkeyup='tabChange(1)' maxlength=1 required>

                            <input class="otp" id="OTP_2" type="text" oninput='digitValidate(this)'

                                onkeyup='tabChange(2)' maxlength=1 required>

                            <input class="otp" id="OTP_3" type="text" oninput='digitValidate(this)'

                                onkeyup='tabChange(3)' maxlength=1 required>

                            <input class="otp" id="OTP_4" type="text" oninput='digitValidate(this)'

                                onkeyup='tabChange(4)' maxlength=1 required>

                            <input class="otp" id="OTP_5" type="text" oninput='digitValidate(this)'

                                onkeyup='tabChange(5)' maxlength=1 required>

                            <input class="otp" id="OTP_6" type="text" oninput='digitValidate(this)'

                                onkeyup='tabChange(6)' maxlength=1 required>

                            <input type="hidden" name="uniqueid" id="uniqueid">

                            <div class="disclaim" style="margin-top: 20px;">
                                 <input type="checkbox" name="agree" id="agree" value="yes" / style="height: 20px;
    width: 20px;">
                                 <label for="agree" style="color: red;">Lead will be considered only if CP accompanies the customer during site visit</label>
                                 <div style="display:none; color:red" id="agree_chk_error">
                                    <b>Can't proceed as you didn't agree to the terms!</b>
                                  </div>
                            </div>

                        </form>

                        <hr class="mt-4">

                        <button class='btn btn-primary btn-block mt-4 mb-4 customBtn' id="VerifyOTP">Verify</button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script type="text/javascript">

 $('#loading').hide(); 
    
    function validateForm(form)
{
    console.log("checkbox checked is ", form.agree.checked);
    if(!form.agree.checked)
    {
        document.getElementById('agree_chk_error').style.visibility='visible';
        return false;
    }
    else
    {
        document.getElementById('agree_chk_error').style.visibility='hidden';
        return true;
    }
}
</script>

 <script type="text/javascript">
  $('#multiple-select-field').select2({
});

</script>


<script>



$(document).ready(function(){

    $(document).on("change","#multiple-select-field",function(){
        if($(this).val() > 0){

          $("#project_id").val($(this).val());

          $("#project_id_edit").val($(this).val());

      
          //$("#ProjectLeads").submit();
        }
    })

    let project_details = [];

    GetProjects()

    $( "#project" ).autocomplete({  

      source: project_details,

      select: function(event, ui) {

          var id = ui.item.id;

          $("#project_id").val(id);

          $("#ProjectLeads").submit();

        

      } 

    });

    function GetProjects(){

         var fd = new FormData();    

        fd.append( 'token', '<?php echo $_COOKIE['token'] ?>' );

        fd.append( 'email', '<?php echo $_COOKIE['username'] ?>' );

        

        

        



        $.ajax({

          url: '<?php echo APIURL; ?>api/GetProjects',

          data: fd,

          processData: false,

          contentType: false,

          type: 'POST',

          success: function(data){

            var html = '';
            html += '<option value="0">Select Project</option>';
            $.each(data.project ,function(arr,i){

                project_details.push({'label':i.project_name+', '+i.city_name, 'id': i.id})
                html += '<option value="'+i.id+'">'+i.project_name+', '+i.city_name+'</option>';

            })

            $('#multiple-select-field').html(html);

             



            console.log(project_details);

          }

        });

    }

})

</script>

<script>



    let digitValidate = function (ele) {

        console.log(ele.value);

        ele.value = ele.value.replace(/[^0-9]/g, '');

    }



    let tabChange = function (val) {

        let ele = $('.otp');

        if (ele[val - 1].value != '') {

            ele[val].focus()

        } else if (ele[val - 1].value == '') {

            ele[val - 2].focus()

        }

    }





    $(document).ready(function () {

        let project_details = [];

        GetProjects()

        $("#project").autocomplete({

            source: project_details,

            select: function (event, ui) {

                var id = ui.item.id;

                $("#project_id").val(id);

                //$("#ProjectLeads").submit();



            }

        });

        function GetProjects() {

            var fd = new FormData();

            fd.append('token', '<?php echo $_COOKIE['token'] ?>');

            fd.append('email', '<?php echo $_COOKIE['username'] ?>');









            $.ajax({

                url: '<?php echo APIURL; ?>api/GetProjects',

                data: fd,

                processData: false,

                contentType: false,

                type: 'POST',

                success: function (data) {

                    $.each(data.project, function (arr, i) {

                        project_details.push({ 'label': i.project_name + ', ' + i.city_name, 'id': i.id })

                    })



                    console.log(project_details);

                }

            });

        }



        $(document).on('click', '.add-lead', function (e) {

            e.preventDefault();
            var valid = true;

            //var FormData = new FormData($('#AddLead')[0];

            var fullname = $('#generateleadname').val();

            var mobile = $('#generateleadnumber').val();

            var email = $('#generateleademail').val();

            var location = $('#generateleadlocation').val();

            var project_id = $('#project_id').val();
            
            var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

            if(fullname == ''){
                $('#generateleadname').addClass('error');
                 valid = false;
            }else{
                 $('#generateleadname').removeClass('error');
            }

            if(mobile == '' || mobile.length!=10){
                $('#generateleadnumber').addClass('error');
                 valid = false;
            }else{
                 $('#generateleadnumber').removeClass('error');
            }
           
            if(email == '' || !testEmail.test(email)){
                $('#generateleademail').addClass('error');
                 valid = false;
            }else{
                 $('#generateleademail').removeClass('error');
            }

            if(location == ''){
                $('#generateleadlocation').addClass('error');
                 valid = false;
            }else{
                 $('#generateleadlocation').removeClass('error');
            }

            if(project_id == ''){
                $('#project_id').addClass('error');
                 valid = false;
            }else{
                 $('#generateleadname').removeClass('error');
            }
            console.log(valid);
            if(!valid){
                return false;
            }
            var token = '<?php echo $_COOKIE['token'] ?>';

            var fd = new FormData();

            fd.append('token', '<?php echo $_COOKIE['token'] ?>');

            fd.append('username', '<?php echo $_COOKIE['username'] ?>');

            fd.append('name', $('#generateleadname').val());

            fd.append('mobile', $('#generateleadnumber').val());

            fd.append('email', $('#generateleademail').val());

            fd.append('location', $('#generateleadlocation').val());

            fd.append('project_id', $('#project_id').val());

            if (token == '') {

                $(".msg").html('<span class="alert alert-success">Your are logged out please login again. </span>');

                setTimeout(function () {

                    window.location.href = "index.php";

                }, 3000);

                return false;

            }

            $.ajax({

                url: '<?php echo APIURL; ?>api/AddLead',

                data: fd,

                processData: false,

                contentType: false,

                type: 'POST',

                success: function (data) {

                    

                    if (data.success) {
                        
                       var project_name = $(".select2-selection__rendered").text();
                        

                        mixpanel.track("Add lead", {
                            "PageName": lastPathSegment.replace(".php", ""),
                            "collateral": "Add lead",
                            "ProjectName":project_name,
                            "$user_id": "<?php echo $_COOKIE['username']; ?>",
                            "collateralevent": "Add lead",
                        });

                    $(".msg").html('<span class="alert alert-success">'+data.msg+'</span>');
                        //  setTimeout(function () {

                        //         $("#ProjectLeads").submit();

                        //     }, 1500);

                        var id = $('#project_id').val();
                        $("#generate-lead").hide();
                        $("#otpform").show();
                         $("#uniqueid").val(data.uniqueid);
                        

                    }
                    else {
                        $(".msg").html('<span class="alert alert-danger">'+data.msg+'</span>');

                    }

                }

            });

        })



        $(document).on('click', '#VerifyOTP', function () {

          
                    var project_name = $(".select2-selection__rendered").text();
                   
                        mixpanel.track("Verify OTP", {
                            "PageName": lastPathSegment.replace(".php", ""),
                            "collateral": "Verify OTP",
                            "ProjectName":project_name,
                            "$user_id": "<?php echo $_COOKIE['username']; ?>",
                            "collateralevent": "Verify OTP",
                        });


            if ($('#agree:checked').val() == 'yes') {
                $(this).attr('disabled', true);
          

                var validation = false;

                if ($('#OTP_1').val() == '') {

                    $('#OTP_1').addClass('error');

                    validation = true;

                }
                else{
                    $('#OTP_1').removeClass('error');
                }





                if ($('#OTP_2').val() == '') {

                    $('#OTP_2').addClass('error');

                    validation = true;

                }
                else{
                    $('#OTP_2').removeClass('error');
                }





                if ($('#OTP_3').val() == '') {

                    $('#OTP_3').addClass('error');

                    validation = true;

                }
                else{
                    $('#OTP_3').removeClass('error');
                }





                if ($('#OTP_4').val() == '') {

                    $('#OTP_4').addClass('error');

                    validation = true;

                }
                else{
                    $('#OTP_4').removeClass('error');
                }



                if ($('#OTP_5').val() == '') {

                    $('#OTP_5').addClass('error');

                    validation = true;

                }
                else{
                    $('#OTP_5').removeClass('error');
                }



                if ($('#OTP_6').val() == '') {

                    $('#OTP_6').addClass('error');

                    validation = true;

                }
                else{
                    $('#OTP_6').removeClass('error');
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

                                $("#ProjectLeads").submit();

                            }, 1500);



                        }

                        else {

                            $(".msg").html('<span class="alert alert-danger">Lead not added.</span>');



                        }

                    }

                });
             }
             else{

                $("#agree_chk_error").show();
                
             }
        })


    })

    var href = document.location.href;
    var lastPathSegment = href.substr(href.lastIndexOf('/') + 1);

    if(lastPathSegment == 'generateleads.php'){

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

</script>



</body>



</html>

