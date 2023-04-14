<?php
include 'header.php';
?>

<!doctype html>

<?php  


$curl = curl_init();

curl_setopt_array($curl, array(

  CURLOPT_URL => APIURL.'api/GetDashboardDetails',
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


?>

<style>
    body {

        /*font-family: "Monteserat";*/



    }



    .dropdown-item:after {

        content: '';

        position: absolute;

        left: 100%;

        top: 50%;

        margin-top: -13px;

        border-left: 0;

        border-bottom: 13px solid transparent;

        border-top: 13px solid transparent;

        border-left: 10px solid #fff;

    }



    .dropdown-item {

        font-family: "Montserrat";

        font-weight: 600;

    }

    .mainpagetwo {

        background-image: url(./img/deskbg.jpg);

        background-repeat: no-repeat;

        background-position: center;

    }



    .generateleadsncollaterls {

        position: absolute !important;

        inset: 0px 0px auto auto !important;

        margin: 0px !important;

        right: 60px !important;

        top: -60px !important;

    }

    .html-marquee {
        /* overflow: hidden; */
        /* position: relative; */
        color: red;
        background-color: #b9a479;
        /* color: #000; */
        /* font-weight: bold; */
        font-size: 14px;
        /* border: 1px solid #ccc; */
        font-family: "Monteserat";
    }


    .tooltip:hover span {
        opacity: 1;
        filter: alpha(opacity=100);
        top: -6em;
        left: 20em;
        z-index: 99;
        -webkit-transition: all 0.2s ease;
        -moz-transition: all 0.2s ease;
        -o-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }

    .box b {
        color: #fff;
    }

    .tooltip span {
        background: none repeat scroll 0 0 #222;
        /*-- some basic styling */
        color: #F0B015;
        font-family: 'Helvetica';
        font-size: 0.8em;
        font-weight: normal;
        line-height: 1.5em;
        padding: 16px 15px;
        width: 240px;
        top: -4em;
        /*-- this is the original position of the tooltip when it's hidden */
        left: 20em;
        margin-left: 0;
        /*-- set opacity to 0 otherwise our animations won't work */
        opacity: 0;
        filter: alpha(opacity=0);
        position: absolute;
        text-align: center;
        z-index: 2;
        text-transform: none;
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease;
        transition: all 0.3s ease-in-out;
    }

    .tooltip span:after {
        border-color: #222 rgba(0, 0, 0, 0);
        border-style: solid;
        border-width: 15px 15px 0;
        bottom: -15px;
        content: "";
        display: block;
        left: 31px;
        position: absolute;
        width: 0;
    }

    .refresh {
        position: absolute;
        right: 25%;
        top: 2%;
    }




    .modal-content {
        position: relative;
        display: flex;
        flex-direction: column;
        margin-top: 50%;
    }

    #homescreen {
        margin-top: 20px;
        margin-bottom: 80px;
    }

    .show-in {
        display: block !important;
    }


    .mainhomescreen {
        padding: 15px 40px;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/shepherd.js@10.0.1/dist/css/shepherd.css" />


<body>



    <section id="mainpagetwo">

        <div class="backgroundmain">

            <div class="container ">

                <div class="homescreenmain">

                    <!-- <button type="button" class="pagetwohelp">Help</button> -->

                    <button type="button" class="pagetwohelp"><a href="logout.php" id="logout"
                            style="color:#7b1846;text-decoration:none;"><i
                                class="fa-solid fa-power-off"></i></a></button>

                    <div class="refresh">

                        <svg id="refreshTable" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" height="30px" width="30px" x="0px" y="0px"
                            viewBox="0 0 30 30" style="enable-background:new 0 0 30 30;" xml:space="preserve">
                            <defs>
                                <style type="text/css">
                                    #goldSquare {
                                        fill: transparent;
                                    }

                                    .arrow {
                                        fill: #fff;
                                    }

                                    #cover:hover #goldSquare {
                                        fill: #741742;
                                    }

                                    #cover:hover .arrow {
                                        fill: #000;
                                    }
                                </style>
                            </defs>
                            <g id="cover">
                                <rect id="goldSquare" width="30" height="30">
                                    <animate attributeName="fill" from="white" to="#feca40" keySplines="0.5 0 0.5 1"
                                        keyTimes="0;1" calcMode="spline" dur="1s" begin="cover.click" repeatCount="1" />
                                </rect>
                                <g>
                                    <animateTransform id="clickAnimate" attributeName="transform" attributeType="XML"
                                        type="rotate" from="0 15 15" to="-360 15 15" keySplines="0 0.5 0.5 1"
                                        keyTimes="0;1" calcMode="spline" dur="0.5s" begin="cover.click" fill="freeze" />



                                    <path class="arrow" d="M22.7,6.5H26v-3h-9v9h3V8.2c2.2,1.6,3.5,4.1,3.5,6.8c0,4.7-3.8,8.5-8.5,8.5v3c6.3,0,11.5-5.2,11.5-11.5
        C26.5,11.7,25.1,8.6,22.7,6.5z" />
                                    <path class="arrow" d="M10,21.8c-2.2-1.6-3.5-4.1-3.5-6.8c0-4.7,3.8-8.5,8.5-8.5v-3C8.7,3.5,3.5,8.7,3.5,15c0,3.3,1.4,6.4,3.8,8.5H4
        v3h9v-9h-3V21.8z" />
                                </g>
                            </g>
                        </svg>



                    </div>

                    <div class="head-page2">

                        <h2>Hello <br>

                            <?php 
                                if($_COOKIE['name'] == 'Proprietor' || $_COOKIE['name'] == 'Partnership'){
                                    echo 'Partner';
                                }
                                else{
                                    echo $_COOKIE['name']; 
                                }
                                

                            ?>

                        </h2>
                        <?php if($_COOKIE['status'] == '1'){ ?>
                        <div class="d-flex justify-content-between">

                         

                            <p></p>

                            <div class="dropdown">

                               

                            </div>

                          

                            <a href="profile.php" class="anchor-profile" id="veiw_profile">VIEW PROFILE</a>

                        </div>
                        <?php  } ?>

                    </div>

                </div>

            </div>

    </section>
    <?php if($_COOKIE['status'] == '0'){ ?>
    <marquee class="html-marquee" direction="left" behavior="scroll" scrollamount="12">
        <p style="padding: 0;
    margin: 0;">Your Account Under verification</p>
    </marquee>
    <?php  } ?>



    <section id="homescreen">

        <div class="container">
            <?php if($_COOKIE['status'] == '1'){ ?>
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mainhomescreen"  id="leads">

                    <a href="leads.php" style="text-decoration: none;">

                        <div class="homescreen-one">

                            <h5>Total Leads</h5>

                            <h1>

                                <?php echo  $result->lead ?>

                            </h1>

                    </a>

                </div>

            </div>

            <?php  } ?>

            <div class="col-lg-12 col-md-12 col-sm-12 col-12 mainhomescreen" id="projectalloted" >

                <a href="projectalloted.php" style="text-decoration: none; color: #7a1845;">

                    <div class="homescreen-one">

                        <h5>Total No. of Projects</h5>

                        <h1>

                            <?php echo  $result->project ?>

                        </h1>

                    </div>

                </a>

            </div>

           
            <?php if($_COOKIE['status'] == '1'){ ?>
            
            </div> 

            <?php  } ?>


        </div>

        </div>

    </section>




    <!-- Modal -->
    <div class="modal fade" id="InactiveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
               
                <div class="modal-body">
                    <h1 style="text-align: center; margin-bottom: 10%;">Complete Your Profile</h1>
                    <div class="col-lg-12" style="text-align: center;"><img src="img/Complete-Profile.png"
                            style="width: 40%;"></div>
                    <p style="margin-top: 10%; text-align: center; font-size: 20px;">Please complete your profile to
                        unlock more benefits*</p>
                    <div class="row col-12">
                        <div class="col-5 offset-1" style="margin-top: 5px;"><a data-bs-dismiss="modal"
                                aria-label="Close" style="color: #03a8ec;font-size: 16px;cursor: pointer;">I'll do it
                                later.</a></div>
                        <div class="col-4 offset-2"><a href="manageprofile.php" class="btn btn-primary"
                                style="background: #7b1846;">Let's do it</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ---------------------end cdc profile-------------------------- -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

    <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/shepherd.js@10.0.1/dist/js/shepherd.min.js"></script>



    <script type="text/javascript">

    

        var status = '<?php echo $_COOKIE['status'] ?>';
        console.log(status);
        if (status == '0') {

            $(window).on('load', function () {
                $('#InactiveModal').modal('show');
            });

        }

        $(window).on('load', function () {

            gtag('event', 'Login', {
                'event_category': '<?php echo $_COOKIE['username'] ?>',
                'event_label': 'LoginDone',
                'value': status
            });
            // Pageview
            gtag('event', 'page_view', {
                "page_title": "Home-Screen"
            });

        });




        $('#loading').hide();
        $(document).on('click', '#projectalloted', function () {

            window.location.href = "projectalloted.php";
            mixpanel.track("click on projects list", {
                "PageName": lastPathSegment.replace(".php", ""),
                "collateral": "Home page",
                "ProjectName": '',
                "$user_id": "<?php echo $_COOKIE['username']; ?>",
                "collateralevent": "click on projects",
            });
            $('#loading').show();
        })

        $(document).on('click', '#view_profile', function () {

            mixpanel.track("click on view profile", {
                "PageName": lastPathSegment.replace(".php", ""),
                "collateral": "Home page",
                "ProjectName": '',
                "$user_id": "<?php echo $_COOKIE['username']; ?>",
                "collateralevent": "click on view profile",
            });
            $('#loading').show();
        })

        $(document).on('click', '#leads', function () {

            window.location.href = "leads.php";

             mixpanel.track("click on leads", {
                "PageName": lastPathSegment.replace(".php", ""),
                "collateral": "Home page",
                "ProjectName": '',
                "collateralevent": "click on leads",
            });
            $('#loading').show();
        })

        $(document).on('click', '#booking_details', function () {
            $('#loading').show();
        })

        $(document).on('click', "#cover", function () {
            $('#loading').show();
            location.reload();
        })

        $(document).on('click', '#profile', function () {
             mixpanel.track("click on profile", {
                "PageName": lastPathSegment.replace(".php", ""),
                "collateral": "Home page",
                "ProjectName": '',
                "$user_id": "<?php echo $_COOKIE['username']; ?>",
                "collateralevent": "click on profile",
            });
            $('#loading').show();
        })

        $(document).on('click', '#generateleads', function () {
             mixpanel.track("click on generateleads", {
                "PageName": lastPathSegment.replace(".php", ""),
                "collateral": "Home page",
                "ProjectName": '',
                "$user_id": "<?php echo $_COOKIE['username']; ?>",
                "collateralevent": "click on generateleads",
            });
            $('#loading').show();
        })

        $(document).on('click', '#units_available', function () {
            $('#loading').show();
        })


        $(document).on('click', '#collaterals', function () {
            $('#loading').show();
        })

        var href = document.location.href;
        
        if (lastPathSegment == 'homescreen.php') {
            $("#homescreen p").attr('style', 'color:#b9a479');
            $("#collaterals p").attr('style', 'color:#fff');
            $("#projectalloted p").attr('style', 'color:#fff');
            $("#generateleads p").attr('style', 'color:#fff');
            $("#units_available p").attr('style', 'color:#fff');
            $("#more p").attr('style', 'color:#fff');


            $("#homescreen_red").show();
            $("#homescreen_white").hide();

            $("#collaterals_white").show();
            $("#collaterals_red").hide();

            $("#projectalloted_white").show();
            $("#projectalloted_red").hide();

            $("#generateleads_white").show();
            $("#generateleads_red").hide();

            $("#units_available_white").show();
            $("#units_available_red").hide();
        }

    </script>


</body>



</html>