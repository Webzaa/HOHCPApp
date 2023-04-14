<?php

include 'header.php';

session_start();

include 'constant.php';
include_once 'functions.php';

//print_r($_COOKIE);exit;

if(!isset($_COOKIE['name']) && $_COOKIE['name'] == ''){

    header('Location: index.php');

}



$url = APIURL.'api/GetUserDetails';
$data = '{"token":"'.$_COOKIE['token'].'","email":"'.$_COOKIE['username'].'"}';
        

$result = APICALL($url,$data);

if(isset($result->error) && $result->error == 'Unauthorised'){

    header('Location: index.php'); 

}

$user = $result->user[0];

?>


<style>
    body {
        background-color: #fff;
        margin-bottom: 100px;
    }

    .slider-form>form {
        padding: 1em;
    }

    .slider-form>form>.form-group {
        margin-bottom: .75rem;
    }

    .slider-form>form>button {
        background-color: #751743;
        border: 1px solid rgba(0, 0, 0, 0.4);
        color: white;
        font-size: 1.25rem;
        font-weight: 700;
        margin-top: .5rem;
        text-align: center;
        width: 100%;
    }

    .slider-form>form>.form-group>input {
        border: none;
        border-radius: .5rem .5rem 0 0;
        margin: 0;
        padding: 8px 10px;
        width: 100%;
    }

    button.btn.btn-primary {
        border-radius: 0px;
        width: 100%;
        background-color: #751743;
        border: none;
    }

    #main-profile {
        padding-top: 7px;
    }

    .cdcprofilee {
        padding-bottom: 15px;
        font-size: 11px;
    }

    .row.profilebtn {

        border-bottom: 1px solid #000;

        margin: 20px 10px;

    }

    i.fa-regular.fa-user.profile-icon {

        padding: 10px;

        font-size: 24px;

        color: #b9a479;

    }

    .fa-solid.fa-pencil {
        color: #fff !important;
        border: 1px solid #fff;
        padding: 6px;
        background-color: #781744;
        margin: 0;
        : #781744;
        color: #fff;
        font-size: 9px;
        position: absolute;
        /* right: 20px; */
        /* top: 240px; */
        border-radius: 0;
        margin: -15px 42%;
    }

    p.cdcprofile {
        text-align: center;
        font-size: 12px;
        margin: 0;
        padding: 10px 0px;
        color: #761743;
        font-weight: 600;
    }
</style>

<!-- profile start -->

<section id="prfile">
    <div class="profile-inner">
        <div class="container">
            <div class="row d-flex justify-content-between eight-main">
                <div class="col-lg-6 col-6 arroww"><span><a href="profile.php"><img src="img/lessthanarrow-new.png"
                                class="singlearrow"></a> &nbsp; Profile</span>
                </div>
                <div class="col-lg-6 col-6"> <button type="button btn" class="pagesixhelp" data-bs-toggle="modal"
                        data-bs-target="#myModal">Help</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- profile end -->

<!-- ---------------cdc profile---------------------------- -->
<!-- Button trigger modal -->
<p class="cdcprofile text-center">You can add profiles to Customize Collaterals to suit your needs. </p>
<button id="AddCDCProfile" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <i class="fa-regular fa-plus"></i>&nbsp;&nbsp;Add Profile
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Add Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="slider-form">
                    <form>

                        <div class="form-group">
                            <input type="text" id="profile_name" placeholder="Profile Name" />
                        </div>


                        <div class="form-group">
                            <input type="text" id="name" placeholder="Name" />
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" placeholder="Email Address" />
                        </div>

                        <div class="form-group">
                            <input type="tel" id="mobile" placeholder="Phone Number" />
                        </div>

                        <div class="form-group">
                            <input type="text" id="rera_no" placeholder="Rera Number" />
                        </div>

                        <div class="form-group">
                            <input type="file" id="logo" />
                            <input type="hidden" id="profile_id" value="0">
                        </div>

                        <button class="btn btn-default" id="AddProfile">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ---------------------end cdc profile-------------------------- -->


<section id="main-profile">
    <div class="container" id="CDCProfile">
        
    </div>
</section>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

    $(document).ready(function () {
        $('#loading').hide();
    })
   

    mixpanel.track("List CDC Profile", {
        "PageName": lastPathSegment.replace(".php", ""),
        "collateral": "List CDC Profile",
        "ProjectName":'',
        "$user_id": "<?php echo $_COOKIE['username']; ?>",
        "collateralevent": "List CDC Profile",
    });



    function download_file() {
        document.getElementById("my_download").click()
    }


    $(document).on('click', '#AddProfile', function (e) {

        mixpanel.track("Add CDC Profile", {
            "PageName": lastPathSegment.replace(".php", ""),
            "collateral": "Add CDC Profile",
            "ProjectName": $('#name').val(),
            "$user_id": "<?php echo $_COOKIE['username']; ?>",
            "collateralevent": "Add CDC Profile",
        });
      
        e.preventDefault();

        var token = '<?php echo $_COOKIE['token'] ?>';

        var fd = new FormData();

        let logo = $('#logo')[0].files;

        fd.append('token', token);

        fd.append('username', '<?php echo $_COOKIE['username'] ?>');

        fd.append('logo', logo[0]);

        fd.append('profile_name', $('#profile_name').val());

        fd.append('name', $('#name').val());

        fd.append('mobile', $('#mobile').val());

        fd.append('email', $('#email').val());

        fd.append('email', $('#email').val());

        fd.append('rera_no', $('#rera_no').val());

        fd.append('profile_id', $('#profile_id').val());

        if (token == '') {

            $(".msg").html('<span class="alert alert-success">Your are logged out please login again. </span>');

            setTimeout(function () {

                window.location.href = "index.php";

            }, 3000);

            return false;

        }

        $.ajax({

            url: '<?php echo APIURL; ?>api/AddCDCProfile',

            data: fd,

            async: false,

            type: 'POST',

            success: function (data) {

                console.log(data.lead);



                if (data.success) {
                    $('#exampleModal').modal('toggle');
                    GetCDCProfile('');

                } else {



                }



            },

            cache: false,

            contentType: false,

            processData: false

        });

    })
    GetCDCProfile('');
    function GetCDCProfile(profile_id) {

        $('#loading').hide();

        mixpanel.track("Get CDC Profile", {
            "PageName": lastPathSegment.replace(".php", ""),
            "collateral": "Get CDC Profile",
            "ProjectName": $('#name').val(),
            "$user_id": "<?php echo $_COOKIE['username']; ?>",
            "collateralevent": "Get CDC Profile",
        });

        var token = '<?php echo $_COOKIE['token'] ?>';

        var fd = new FormData();
        let logo = $('#logo')[0].files;
        fd.append('token', token);
        fd.append('profile_id', profile_id);
        fd.append('username', '<?php echo $_COOKIE['username'] ?>');

        $.ajax({

            url: '<?php echo APIURL; ?>api/GetCDCProfile',
            data: fd,
            async: false,
            type: 'POST',
            success: function (data) {

                var html = '';

                if (data.ProfileCDCData.length > 0) {
                    $.each(data.ProfileCDCData, function (att, i) {
                        html += '<div class="row profilebtn">';
                        html += '   <div class="col-5">';
                        html += '       <img src="<?php echo APIURL; ?>' + i.logo_path + '" class="manageprofilephoto" style="    height: 100px;    width: 100px;">';
                        html += '    </div>';
                        html += '    <div class="col-7 cdcprofilee">';
                        html += '        <h3>' + i.profile_name + '</h3>';
                        html += '          Name: ' + i.name + '<br>';
                        html += '           Mobile: ' + i.mobile + '<br>';
                        html += '           Email: ' + i.email + '<br>';
                        html += '           Rera No.: ' + i.rera_no + '<br> <a id="show_data" data-profile-name="' + i.profile_name + '" data-name="' + i.name + '" data-mobile="' + i.mobile + '" data-email="' + i.email + '" data-rera-no="' + i.rera_no + '" data-logo-path="' + i.logo_path + '" data-id="' + i.id + '" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-pencil"></i></a>';

                        html += '    </div>'; html += ' ';
                        html += ' </div>';

                    })
                }

                $("#CDCProfile").html(html);









            },

            cache: false,

            contentType: false,

            processData: false

        })

    }

    $(document).on('click', '#show_data', function (e) {

        var id = $(this).data('id');
        var profile_name = $(this).data('profile-name');
        var name = $(this).data('name');
        var email = $(this).data('email');
        var mobile = $(this).data('mobile');
        var rera_no = $(this).data('rera-no');
        var logo_path = $(this).data('logo-path');

        $('#name').val(name);

        $('#mobile').val(mobile);

        $('#email').val(email);

        $('#profile_name').val(profile_name);

        $('#rera_no').val(rera_no);

        $('#profile_id').val(id);

        $("#company_logo").attr('src', '<?php echo APIURL; ?>' + logo_path)

    })
    $(document).on('click', '#AddCDCProfile', function (e) {



        $('#name').val('');

        $('#mobile').val('');

        $('#email').val('');

        $('#profile_name').val('');

        $('#rera_no').val('');

        $('#profile_id').val('0');

        $("#company_logo").attr('src', '')

    })


</script>
</body>

</html>