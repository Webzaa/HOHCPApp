<?php

session_start();
    include 'constant.php';

//print_r($_COOKIE);exit;

if (!isset($_COOKIE['name']) && $_COOKIE['name'] == '') {

    header('Location: index.php');
}

   

$curl = curl_init();



curl_setopt_array($curl, array(

    CURLOPT_URL => APIURL.'api/GetUserDetails',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => '{"token":"' . $_COOKIE['token'] . '","email":"' . $_COOKIE['username'] . '"}',
    CURLOPT_HTTPHEADER => array(

        'Content-Type: application/json'

    ),

));



$response = curl_exec($curl);



curl_close($curl);

$result = json_decode($response);

if (isset($result->error) && $result->error == 'Unauthorised') {

    header('Location: index.php');
}



$user = $result->user[0];

$Firm = $result->Firm;

$REGION = $result->REGION;

$MemberType = $result->MemberType;

//echo '<pre>'; print_r($result);exit;

$profile_photo = '';
if($user->profile_photo != ''){
    $profile_photo = APIURL.''.$user->profile_photo;
}


$rera_certificate_path = '';
if($user->rera_certificate_path != ''){
    $rera_certificate_path = APIURL.''.$user->rera_certificate_path;
}

$gst_certificate_path = '';
if($user->gst_certificate_path != ''){
    $gst_certificate_path = APIURL.''.$user->gst_certificate_path;
}

$pan_path = '';
if($user->pan_path != ''){
    $pan_path = APIURL.''.$user->pan_path;
}

$company_logo = '';
if($user->company_logo != ''){
    $company_logo = APIURL.''.$user->company_logo;
}

// echo $profile_photo.'<br>';
// echo $rera_certificate_path.'<br>';
// echo $gst_certificate_path.'<br>';
// echo $pan_path.'<br>';
// echo $company_logo.'<br>';
//'<pre>'; print_r($result);exit;

?>



<!doctype html>



<?php include 'header.php'; ?>

<style>
    body {

        height: 1800px !important;
       font-family: "Roboto", sans-serif !important;
        font-weight: 600;

    }

    a#show_image {
        float: right;

    }

    i.fa.fa-eye {
        position: absolute;
        right: 5%;
    }

    #manageformform {

        background-image: url(./img/whitebgh.jpg);

        background-repeat: no-repeat;

        background-position: center;

        height: 40vh;

        padding-bottom: 100px;

        margin: 0;

        background-size: cover;

        background-position: center;

        padding: 0;

        overflow: inherit;

    }

    select#firm {
        padding: 10px 5px;
    }

    select#region {
        padding: 10px 5px;
    }

    select#member_of {
        padding: 10px 5px;
    }

    span.alert.alert-success {

        font-size: 18px;
        padding: 10px;
        text-align: center;
    }

    label.choose {
        padding: 5px 10px;
        font-family: 'Montserrat';
    }

    button#update_user {

        background-color: #781744;

        color: #fff;

        width: 100%;

        margin-top: 10px;

    }

    .mb-3 {

        margin-bottom: 0px !important;

    }

    #homescreen {
        background: none !important;
    }
</style>



<!-- section first start -->

<section id="sixth-main">

    <div class="container">

        <div class="row d-flex justify-content-between manageprofile">

            <div class="col-lg-6 col-9"><a href="profile.php"><img src="img/lessthanarrow-new.png" class="singlearrow"></a>
                <span> Manage Profile </span>
            </div>

            <div class="col-lg-6 col-3"> <button type="button btn" class="pagesixhelp" data-bs-toggle="modal"
                    data-bs-target="#myModal">Help</button> </div>

        </div>

    </div>

</section>

<!-- section first end -->



<!-- manageprofile profile start -->

<section id="manageprofile-profile">

    <div class="manageprofile-profile-inner">

        <div class="container">

            <div class="row">

                <div class="col-12 profile-imgnew">

                    <img src="<?php echo APIURL.''.$user->profile_photo; ?>">

                </div>

                <!--   <div class="col-12">

                <div class="pagetwosearch manage-search"><img src="img/lessthanarrow.png" class="singlearrow"></div>

            </div> -->

            </div>

        </div>

    </div>

</section>

<!-- manageprofile profile end -->



<!-- manage form start -->

<section id="manageformform">

    <div class="manageformform-inner">

        <div class="container">

            <!-- <h2 class="manageformform-head">ENQUIRE NOW</h2> -->

            <form>



                <div class="mb-3">
                    <label class="choose">Profile Photo</label>
                    <input type="file" class="manage-formcontrol" id="profile_photo" aria-describedby="nameHelp"
                        placeholder="Choose file" value="">
                    <?php if($profile_photo != ''){ ?>
                    <a data-src="<?php echo $profile_photo; ?>" data-title="Profile Photo" id="show_image"
                        data-bs-toggle="modal" data-bs-target="#ImageModal"><i class="fa fa-eye"
                            aria-hidden="true"></i></a>
                    <?php } ?>


                </div>



                <div class="mb-3">

                    <input type="name" class="manage-formcontrol" id="cp_name" aria-describedby="nameHelp"
                        placeholder="Name" value="<?php echo $user->cp_name; ?>"><i class="fa-solid fa-pencil"></i>

                </div>


                <div class="mb-3">

                    <input type="number" class="manage-formcontrol" id="mobile" placeholder="Mobile Number"
                        value="<?php echo $user->mobile; ?>"><i class="fa-solid fa-pencil"></i>

                </div>



                <div class="mb-3">

                    <input type="email" class="manage-formcontrol" id="email_id" placeholder="Email ID" readonly
                        value="<?php echo $user->email_id; ?>"><i class="fa-solid fa-pencil"></i>

                </div>

                <div class="mb-3">
                    <?php 
                        $readonly = '';
                        if($_COOKIE['status'] == '1'){
                            $readonly = 'readonly';
                        } 
                    ?>

                    <input type="name" class="manage-formcontrol" id="rerano" aria-describedby="nameHelp" <?php echo
                        $readonly; ?> placeholder="Rera No." value="
                    <?php echo $user->rerano; ?>"><i class="fa-solid fa-pencil"></i>

                </div>


                <div class="mb-3">

                    <input type="name" class="manage-formcontrol" id="rera_expiry_date" aria-describedby="nameHelp"
                        placeholder="Rera Expiry Date"
                        value="<?php  if($user->rera_expiry_date != '0000-00-00') echo date('d-m-Y',strtotime($user->rera_expiry_date)); ?>"><i
                        class="fa-solid fa-pencil"></i>

                </div>

                <div class="mb-3">

                    <input type="name" class="manage-formcontrol" id="pan_no" aria-describedby="nameHelp"
                        placeholder="PAN No" value="<?php echo $user->pan_no; ?>"><i class="fa-solid fa-pencil"></i>

                </div>



                <div class="mb-3 choosefile">
                    <label class="choose">Upload GST Certificate</label>
                    <input type="file" class="manage-formcontrol" id="gst_certificate_path" aria-describedby="nameHelp"
                        placeholder="Choose GST Certificate" value="">

                    <?php if($gst_certificate_path != ''){ ?>
                    <a data-src="<?php echo $gst_certificate_path; ?>" data-title="GST Certificate" id="show_image"
                        data-bs-toggle="modal" data-bs-target="#ImageModal"><i class="fa fa-eye"
                            aria-hidden="true"></i></a>
                    <?php } ?>

                </div>


                <div class="mb-3 choosefile">
                    <label class="choose">Upload Pancard</label>
                    <input type="file" class="manage-formcontrol" id="pan_card_path" aria-describedby="nameHelp"
                        placeholder="Choose pan card" value="">

                    <?php if($pan_path != ''){ ?>
                    <a data-src="<?php echo $pan_path; ?>" data-title="PAN Card" id="show_image" data-bs-toggle="modal"
                        data-bs-target="#ImageModal"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <?php } ?>

                </div>


                <div class="mb-3">

                    <input type="name" class="manage-formcontrol" id="address" aria-describedby="nameHelp"
                        placeholder="Address" value="<?php echo $user->address; ?>"><i class="fa-solid fa-pencil"></i>

                </div>



                <div class="mb-3">

                    <input type="name" class="manage-formcontrol" id="city" aria-describedby="nameHelp"
                        placeholder="City" value="<?php echo $user->city; ?>"><i class="fa-solid fa-pencil"></i>

                </div>



                <div class="mb-3">

                    <input type="name" class="manage-formcontrol" id="state" aria-describedby="nameHelp"
                        placeholder="State" value="<?php echo $user->state; ?>"><i class="fa-solid fa-pencil"></i>

                </div>

                <div class="mb-3">

                    <select class="manage-formcontrol" id="member_of">

                        <option value="">Select Member Of</option>

                        <?php

                        foreach ($MemberType as $member) {

                            echo '<option value="' . $member->sub_type . '">' . $member->sub_type . '</option>';
                        }

                        ?>

                    </select>

                </div>

                <div class="mb-3 choosefile">
                    <label class="choose">Upload Rera Certificate</label>

                    <input type="file" class="manage-formcontrol" id="rera_certificate_path" aria-describedby="nameHelp"
                        placeholder="Choose Rera Certificate" value="">

                    <?php if($rera_certificate_path != ''){ ?>
                    <a data-src="<?php echo $rera_certificate_path; ?>" data-title="RERA Certificate" id="show_image"
                        data-bs-toggle="modal" data-bs-target="#ImageModal"><i class="fa fa-eye"
                            aria-hidden="true"></i></a>
                    <?php } ?>

                </div>



                <div class="mb-3">

                    <select class="manage-formcontrol" id="firm">

                        <option value="">Select Firm</option>

                        <?php

                        foreach ($Firm as $firm_type) {

                            echo '<option value="' . $firm_type->sub_type . '">' . $firm_type->sub_type . '</option>';
                        }

                        ?>

                    </select>

                </div>



                <div class="mb-3 choosefile">
                    <label class="choose">Company Logo</label>
                    <input type="file" class="manage-formcontrol" id="company_logo" aria-describedby="nameHelp"
                        placeholder="Choose company logo" value="">

                    <?php if($company_logo != ''){ ?>
                    <a data-src="<?php echo $company_logo; ?>" data-title="Company Logo" id="show_image"
                        data-bs-toggle="modal" data-bs-target="#ImageModal"><i class="fa fa-eye"
                            aria-hidden="true"></i></a>
                    <?php } ?>

                </div>


                <!-- 
                <div class="mb-3">

                    <select class="manage-formcontrol" id="region">

                        <option value="">Select Region</option>

                        <?php

                        foreach ($REGION as $region_type) {

                            echo '<option value="' . $region_type->sub_type . '">' . $region_type->sub_type . '</option>';
                        }

                        ?>

                    </select>

                </div> -->







                <div class="mb-3">

                    <input type="name" class="manage-formcontrol" id="campany_name" aria-describedby="nameHelp"
                        placeholder="Campany Name" value="<?php echo $user->campany_name; ?>"><i
                        class="fa-solid fa-pencil"></i>

                </div>

                <div class="mb-3">

                    <input type="name" class="manage-formcontrol" id="branch_name" aria-describedby="nameHelp"
                        placeholder="Branch" value="<?php echo $user->branch_name; ?>"><i
                        class="fa-solid fa-pencil"></i>

                </div>

                <div id="msg">



                </div>

                <!-- <button type="submit" class="btn btn col-12 change-password">Change Password</button> -->

                <button type="button" class="btn form-savedetailsbtn" id="update_user">Save Details</button>

            </form>

        </div>

    </div>

</section>

<!-- manage form end -->
<!-- Modal -->

<div class="modal fade" id="ImageModal" tabindex="-1" aria-labelledby="ImageModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="ImageModalLabel">SMS Scripts</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body" id="image_preview">


            </div>

        </div>

    </div>

</div>




<script src="js/bootstrap.bundle.min.js"></script>

<script src="js/jquery.min.js"></script>

<script src="js/jquery-ui.js"></script>

<script type="text/javascript">


    $("#rera_expiry_date").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        dateFormat: 'dd-mm-yy'
    });

  

    mixpanel.track("Manage Profile", {
        "PageName": lastPathSegment.replace(".php", ""),
        "collateral": "Manage Profile",
        "ProjectName": '',
        "$user_id": "<?php echo $_COOKIE['username']; ?>",
        "collateralevent": "Manage Profile",
    });

    $(document).ready(function() {

        
        if (navigator.onLine) {
            console.log("You are online!");
            $('#update_user').show();
        }else{
            console.log("You are offline!");
            $('#update_user').hide();
        }
        $('#loading').hide();
    })
    

    $(document).on('click', '#show_image', function () {
        var src = $(this).data('src');
        var title = $(this).data('title');
        console.log(src);
        var html = '<img src="' + src + '" style="border:none;width:100%;" title="Iframe Example">';
        $("#image_preview").html(html);
        $("#ImageModalLabel").html(title);

    })


    $(document).on('click', '#homescreen', function () {
        $('#loading').show();

    })

    $(document).on('click', '#update_user', function () {


        mixpanel.track("Update Profile", {
        "PageName": lastPathSegment.replace(".php", ""),
        "collateral": "Update Profile",
        "ProjectName": '',
        "$user_id": "<?php echo $_COOKIE['username']; ?>",
        "collateralevent": "Update Profile",
    });

        //var FormData = new FormData($('#AddLead')[0];

        $('#loading').show();
        //return false;

        var token = '<?php echo $_COOKIE['token'] ?>';

        var fd = new FormData();

        let profile_photo = $('#profile_photo')[0].files;

        let rera_certificate_path = $('#rera_certificate_path')[0].files;

        let gst_certificate_path = $('#gst_certificate_path')[0].files;

        let pan_card_path = $('#pan_card_path')[0].files;

        let company_logo = $('#company_logo')[0].files;

        fd.append('token', '<?php echo $_COOKIE['token'] ?>');

        fd.append('username', '<?php echo $_COOKIE['username'] ?>');



        fd.append('profile_photo', profile_photo[0]);

        fd.append('rera_certificate_path', rera_certificate_path[0]);

        fd.append('gst_certificate_path', gst_certificate_path[0]);

        fd.append('pan_card_path', pan_card_path[0]);

        fd.append('company_logo', company_logo[0]);

        fd.append('cp_name', $('#cp_name').val());

        fd.append('mobile', $('#mobile').val());

        fd.append('email_id', $('#email_id').val());

        fd.append('rerano', $('#rerano').val());

        fd.append('rera_expiry_date', $('#rera_expiry_date').val());

        fd.append('pan_no', $('#pan_no').val());

        fd.append('address', $('#address').val());

        fd.append('city', $('#city').val());

        fd.append('state', $('#state').val());

        fd.append('member_of', $('#member_of').val());

        fd.append('firm', $('#firm').val());

        fd.append('region', $('#region').val());

        fd.append('campany_name', $('#campany_name').val());

        fd.append('branch_name', $('#branch_name').val());

        if (token == '') {

            $(".msg").html('<span class="alert alert-success">Your are logged out please login again. </span>');

            setTimeout(function () {

                window.location.href = "index.php";

            }, 3000);

            return false;

        }

        $.ajax({

            url: '<?php echo APIURL; ?>api/UpdateUserDetails',

            data: fd,

            async: false,

            type: 'POST',

            success: function (data) {

                console.log(data.lead);



                if (data.success) {

                    $('#msg').html('<span class="alert alert-success">User details saved successfully.</span>');

                    setTimeout(function () {

                        document.location.href = "profile.php";

                    }, 3000);

                } else {



                }



            },

            cache: false,

            contentType: false,

            processData: false

        });

    })
</script>







</body>

</html>