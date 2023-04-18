<?php

session_start();
include 'constant.php';

//print_r($_COOKIE);exit;

if(!isset($_COOKIE['name']) && $_COOKIE['name'] == ''){

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

  CURLOPT_POSTFIELDS =>'{"token":"'.$_COOKIE['token'].'","email":"'.$_COOKIE['username'].'"}',

  CURLOPT_HTTPHEADER => array(

    'Content-Type: application/json'

  ),

));



$response = curl_exec($curl);



curl_close($curl);

 $result = json_decode($response);

if(isset($result->error) && $result->error == 'Unauthorised'){

    header('Location: index.php'); 

}

$user = $result->user[0];

//echo '<pre>'; print_r($result);exit;

?>





<!doctype html>





<?php  include 'header.php'; ?>



<style>

    body {

        background-color: #fff;
font-family: "Roboto", sans-serif !important;
        background-image: none;

    }

    #main-profile {

    padding-top: 7px;

}



.prfile-img h5{

        margin-top: 10px;

}



.prfile-img {

    text-align: center;

}

    .prfile-img img {

    width: 140px;

    height: 140px;

    border-radius: 150px;

    border: 4px solid #7b1846;

}

input.profile-input {

    border-bottom: 1px solid #000;

    border-radius: 0px;

    background-color: #fff;

}

input.profile-input::placeholder {

color: #962054;

text-align: center;

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

img.manageprofilephoto {

    width: 35px;

    margin: 5px 0px;

}

</style>



<!-- <body>

    <section id="eight-main">

        <div class="container">

           

        </div>

    </section> -->



    <!-- profile start -->

    <section id="prfile">

        <div class="profile-inner">

            <div class="container">

                <div class="row d-flex justify-content-between eight-main">

                    <div class="col-lg-6 col-6 arroww"><a href="homescreen.php" ><img src="img/lessthanarrow-new.png" class="singlearrow"></a> &nbsp; Profile</span></div>

                    <div class="col-lg-6 col-6"> <button type="button btn" class="pagesixhelp" data-bs-toggle="modal" data-bs-target="#myModal">Help</button> </div>

                </div>

                <div class="row progress-profile-main">

                <div class="col-12 prfile-img"><img src="<?php echo APIURL.''.$user->profile_photo; ?>"><h5><?php echo $_COOKIE['name']; ?></h5></div>

                

            </div>



            </div>

        </div>

    </section>

    <!-- profile end -->



<section id="main-profile">
    <div class="container">
        <!-- <div class="row"> -->
            <div class="row profilebtn" id="manageprofile">
                <div class="col-2">
                    <img src="img/Icons/manage-profile.png" class="manageprofilephoto">
                </div>
                <div class="col-10">
                <a style="color: #000; text-decoration: none;">Manage Profile</a>
                    <p style="font-size: 10px;">Change your profile details & password</p>
                </div>
                
            </div>
             <div class="row profilebtn"  id="cdcprofile">
                <div class="col-2">
                    <img src="img/briefcase.png" class="manageprofilephoto">
                </div>
                <div class="col-10">
                    <a style="color: #000; text-decoration: none;">CDC Profile</a>
                    <p style="font-size: 10px;">Add the Details</p>
                </div>
            </div>
        <!-- </div> -->
    </div>
</section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



    <script>
        $(document).ready(function() {
                $('#loading').hide();
        })

         mixpanel.track("Profile", {
            "PageName": lastPathSegment.replace(".php", ""),
            "collateral": "Profile",
            "ProjectName":'',
            "$user_id": "<?php echo $_COOKIE['username']; ?>",
            "collateralevent": "Profile",
        });

         $(document).on('click', '#manageprofile', function () {
            window.location.href = "manageprofile.php";
            $('#loading').show(); 

            mixpanel.track("Click on Manage Profile", {
                "PageName": lastPathSegment.replace(".php", ""),
                "collateral": "Click on Manage Profile",
                "ProjectName":'',
                "$user_id": "<?php echo $_COOKIE['username']; ?>",
                "collateralevent": "Click on Manage Profile",
            });
        })

         $(document).on('click', '#cdcprofile', function () {

            window.location.href = "cdcprofile.php";
            $('#loading').show(); 

            mixpanel.track("Click on CDC Profile", {
                "PageName": lastPathSegment.replace(".php", ""),
                "collateral": "Click on CDC Profile",
                "ProjectName":'',
                "$user_id": "<?php echo $_COOKIE['username']; ?>",
                "collateralevent": "Click on CDC Profile",
            });
          })

        

       

         $(document).on('click','#homescreen',function(){
            $('#loading').show(); 

            mixpanel.track("click on Home Screen", {
                "PageName": lastPathSegment.replace(".php", ""),
                "collateral": "Home page",
                "ProjectName": '',
                "$user_id": "<?php echo $_COOKIE['username']; ?>",
                "collateralevent": "click on Home Screen",
            });
         }) 

        function download_file() {

            document.getElementById("my_download").click()

        }

        var href = document.location.href;
        var lastPathSegment = href.substr(href.lastIndexOf('/') + 1);

        if(lastPathSegment == 'profile.php'){
            $("#homescreen p").attr('style','color:#fff');
            $("#collaterals p").attr('style','color:#fff');
            $("#projectalloted p").attr('style','color:#fff');
            $("#generateleads p").attr('style','color:#fff');
            $("#units_available p").attr('style','color:#fff');
            $("#more p").attr('style','color:#b9a479');


            $("#homescreen_red").hide();
            $("#homescreen_white").show();

            $("#collaterals_white").show();
            $("#collaterals_red").hide();

            $("#projectalloted_white").show();
            $("#projectalloted_red").hide();

            $("#generateleads_white").show();
            $("#generateleads_red").hide();

            $("#units_available_white").show();
            $("#units_available_red").hide();

            $("#more_white").hide();
            $("#more_red").show();
        }

    </script>



</body>



</html>

