<!doctype html>
<?php  include 'header.php'; ?>
<?php
include_once 'functions.php';
include 'constant.php';
//echo APIURL; exit;
// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    // should do a check here to match $_SERVER['HTTP_ORIGIN'] to a
    // whitelist of safe domains
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

}


session_start();

  if(!isset($_COOKIE['name']) && $_COOKIE['name'] == ''){

    header('Location: index.php');

  }



  if(!isset($_GET['project_id']) && $_GET['project_id'] == ''){

    header('Location: collaterals.php');

    }



    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => APIURL.'api/GetProjectDetails?token='.$_COOKIE['token'].'&project_id='.$_GET['project_id'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);



    curl_close($curl);

    

    $result = json_decode($response);
    //echo'<pre>';print_r($result);exit;



    $ProjectCollateral = $result->ProjectCollateral;


    if(isset($result->error) && $result->error == 'Unauthorised'){

        header('Location: index.php'); 

    }

    $brouchure = '';

    foreach ($ProjectCollateral as $key => $value) {

        if($value->collateral_type == 'Brouchure'){

            $path = explode('|', $value->pathnames);

            $brouchure = APIURL.''.$path[0];

        }

    }

    $Project = $result->Project[0];

    $ProjectCollateral = $result->ProjectCollateral;

    $ChannelPartner = $result->ChannelPartner[0];

?>





<head>


    <meta charset="utf-8">



    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="css/lightgallery.css" />
    <!-- <link rel="stylesheet" href="https://partners.saisuncity.com/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <link rel="stylesheet" href="css/ekko-lightbox.css" />

    <link rel="stylesheet" href="css/swiper-bundle.min.css">

    <link href="css/aos.css" rel="stylesheet">
    <link href="css/select2.min.css" rel="stylesheet" />

</head>



<style>
body{
    font-family: "Roboto", sans-serif !important;
}
    .nav-pills .nav-link,
    .nav-pills .show>.nav-link {

        color: #000;

        background-color: #fff;

        margin: 0 auto;

        font-size: 14px;



        width: 180px;

        border: 2px solid #941f53;

        margin-right: 13px;

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

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {

        color: #941f53;

        background-color: #941f53;

        font-weight: 600;

        color: #fff;

    }


    .menuwrapper {

        position: relative;
        margin: 0 auto;
        overflow-y: hidden;
        padding: 5px;
        height: 80px;
        overflow-x: inherit;
    }

    .list {

        position: absolute;

        left: 0px;

        top: 0px;

        min-width: 600px;

        margin-left: 12px;

        margin-top: 0px;

    }



    .list li {

        display: table-cell;

        position: relative;

        text-align: center;

        cursor: grab;

        cursor: -webkit-grab;

        color: #efefef;

        vertical-align: middle;

    }



    .scroller {

        text-align: center;

        cursor: pointer;

        display: none;

        padding: 7px;

        color: #791845;

        font-size: 35px;

        padding-top: 11px;

        white-space: no-wrap;

        vertical-align: middle;

        background-color: #fff;

    }

    .menuwrapper::-webkit-scrollbar {
        display: none;
    }



    .scroller-right {

        float: right;

    }



    .scroller-left {

        float: left;

    }

    #eagleridge-icons {

        background-image: url(./img/whitebgh.jpg);

        background-repeat: no-repeat;

        background-position: center;

        height: 50vh;

        padding-bottom: 100px;

        margin: 0;

        background-size: cover;

        background-position: center;

        padding: 0;

        overflow: inherit;

    }

    i.fa.fa-eye {
        position: absolute;
        right: 5%;
        /* top: 3%; */
    }

    .eagle-icon {
        text-align: center;
    }


    .emailerbt {

        padding: 15px 15px;

    }



    .lg-backdrop.in {

        opacity: 1;

        z-index: 99999;

    }



    img.lg-object.lg-image {

        z-index: 9999999;

    }



    .modal-body {

        padding: 0;

    }

    #EmailerModal {
        height: 85% !important;
        width: 100% !important;
    }



    #exampleModal textarea {

        /* overflow: scroll; */

        /* resize: inherit; */

        width: 100%;

        height: 100px;

        border: none;

        padding: 0px 10px;

    }

    #lightgalleryVideos .whatsapp-video {
        position: absolute;
        right: 0;
    }

    .facebook-video {
        position: absolute;
        right: 0;
        top: 50px;
        font-size: 35px;
    }

    button.btn.btn-primary {

        background-color: transparent;

        color: #7d1543;

        font-size: 14px;

        border: none;

        font-weight: bold;

    }

    .video-btn {
        background-color: transparent;
        border-color: #fff;
        text-decoration: none;
    }

    .video-btn:hover {
        background-color: transparent;
        border-color: #fff;
    }


    .eagleridgemain-inner {

        background-image: url(./img/eagleridgebg.jpg);

        background-repeat: no-repeat;

        background-position: center;

        height: 185px;

        padding: 25px 10px;

    }



    h2.eagleridge-head {

        font-size: 20px;
        margin: 5px;
        padding: 10px;
        /* top: 8%; */
        color: #fff;
        font-size: 30px;

    }



    .col-4.eagle-icon img {

        border: 1px solid #941f53;
        padding: 20px;
        border-radius: 20px;
        width: 80px;
        background-color: transparent;
        text-align: center;
        margin: 0 auto;

    }


    i.fa-brands.fa-whatsapp {
        color: #4ec95c;
        font-size: 40px;
        padding: 0px 5px;
    }


    img.btn.btn-primary:active {

        background-color: transparent;

        border-color: #84214d;

    }



    .col-4.eagle-icon p {

        color: #941f53;

        text-align: center;

        font-size: 14px;

        padding: 10px 0px;

    }



    button.pagesixhelp-eagleridgemain {

        float: right;

        border-radius: 14px;

        padding: 4px 18px;

        font-size: 16px;

        border: none;

        background-color: #fff;

        color: #941f53;

    }

    .lg-outer.lg-visible {

        opacity: 1;

        z-index: 99999;

    }

    a.mybtn {

        text-decoration: none;

    }



    .tooltip button.btn.btn-default {

        border: none;
        /* background-color: transparent; */
        /* color: #fff; */
        font-size: 30px;

    }

    i.fa-duotone.fa-copy {
        color: #fff;
        background-color: #000;
        font-size: 20px;
    }



    .tooltip {

        opacity: unset;

        text-align: right;

        padding: 15px 0px;

    }



    .modal-body {

        padding: 10px;

    }



    /*=================================================*/

    /*lightgal*/

    .demo-gallery>ul {

        margin-bottom: 0;

        margin: 0 auto;

    }



    .demo-gallery>ul>li {

        float: left;

        margin: 15px 0px;

        /*width: 200px;*/

        height: 200px;

        text-align: center;

    }



    ul#lightgallery {

        margin: 0;

    }



    .demo-gallery>ul>li a {

        /*     border: 3px solid #FFF;*/

        border-radius: 3px;

        display: block;

        overflow: hidden;

        position: relative;

        float: left;

    }


    .lg-toolbar .lg-icon {
        width: 65px;
    }


    .modal {
        height: 85% !important;
    }

    #EmailerModal .modal {
        height: 85% !important;
        width: 50% !important;
    }
    #floorplan .demo-gallery>ul>li a {

        /*     border: 3px solid #504f4f;*/

        border-radius: 3px;

        display: block;

        overflow: hidden;

        position: relative;

        float: left;

    }



    .demo-gallery>ul>li a>img {

        -webkit-transition: -webkit-transform 0.15s ease 0s;

        -moz-transition: -moz-transform 0.15s ease 0s;

        -o-transition: -o-transform 0.15s ease 0s;

        transition: transform 0.15s ease 0s;

        -webkit-transform: scale3d(1, 1, 1);

        transform: scale3d(1, 1, 1);

        height: 200px;

        width: 90%;

        border: 2px solid #fff;

    }



    .demo-gallery>ul>li a:hover>img {

        -webkit-transform: scale3d(1.1, 1.1, 1.1);

        transform: scale3d(1.1, 1.1, 1.1);

    }



    .demo-gallery>ul>li a:hover .demo-gallery-poster>img {

        opacity: 1;

    }



    .demo-gallery>ul>li a .demo-gallery-poster {

        background-color: rgba(0, 0, 0, 0.1);

        bottom: 0;

        left: 0;

        position: absolute;

        right: 0;

        top: 0;

        -webkit-transition: background-color 0.15s ease 0s;

        -o-transition: background-color 0.15s ease 0s;

        transition: background-color 0.15s ease 0s;

    }



    .demo-gallery>ul>li a .demo-gallery-poster>img {

        left: 50%;

        margin-left: -10px;

        margin-top: -10px;

        opacity: 0;

        position: absolute;

        top: 50%;

        -webkit-transition: opacity 0.3s ease 0s;

        -o-transition: opacity 0.3s ease 0s;

        transition: opacity 0.3s ease 0s;

    }



    .demo-gallery>ul>li a:hover .demo-gallery-poster {

        background-color: rgba(0, 0, 0, 0.5);

    }



    .demo-gallery .justified-gallery>a>img {

        -webkit-transition: -webkit-transform 0.15s ease 0s;

        -moz-transition: -moz-transform 0.15s ease 0s;

        -o-transition: -o-transform 0.15s ease 0s;

        transition: transform 0.15s ease 0s;

        -webkit-transform: scale3d(1, 1, 1);

        transform: scale3d(1, 1, 1);

        height: 200px;

        width: 100%;

    }



    .demo-gallery .justified-gallery>a:hover>img {

        -webkit-transform: scale3d(1.1, 1.1, 1.1);

        transform: scale3d(1.1, 1.1, 1.1);

    }



    .demo-gallery .justified-gallery>a:hover .demo-gallery-poster>img {

        opacity: 1;

    }



    .demo-gallery .justified-gallery>a .demo-gallery-poster {

        background-color: rgba(0, 0, 0, 0.1);

        bottom: 0;

        left: 0;

        position: absolute;

        right: 0;

        top: 0;

        -webkit-transition: background-color 0.15s ease 0s;

        -o-transition: background-color 0.15s ease 0s;

        transition: background-color 0.15s ease 0s;

    }



    .demo-gallery .justified-gallery>a .demo-gallery-poster>img {

        left: 50%;

        margin-left: -10px;

        margin-top: -10px;

        opacity: 0;

        position: absolute;

        top: 50%;

        -webkit-transition: opacity 0.3s ease 0s;

        -o-transition: opacity 0.3s ease 0s;

        transition: opacity 0.3s ease 0s;

    }



    .demo-gallery .justified-gallery>a:hover .demo-gallery-poster {

        background-color: rgba(0, 0, 0, 0.5);

    }



    .demo-gallery .video .demo-gallery-poster img {

        height: 48px;

        margin-left: -24px;

        margin-top: -24px;

        opacity: 0.8;

        width: 48px;

    }



    .demo-gallery.dark>ul>li a {

        border: 3px solid #04070a;

    }



    .home .demo-gallery {

        padding-bottom: 80px;

    }



    .lg-item.lg-next-slide.lg-prev-slide.lg-loaded.lg-current.lg-complete {

        z-index: 99999999999;

    }



    button#email_me {

        width: 138px;

        margin: 0 5px;

        background-color: #7d1747;

        color: #fff;

        border-radius: 5px;

    }



    /*=====================================================*/





    body {

        height: 1000px;

    }


    .select2 {
        width: 100% !important;
        /* force fluid responsive */
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
                    -webkit-overflow-scrolling: touch;
                    /* use momentum scrolling */
                }
            }
        }
    }
    }

    div#dropdown-inner {
        width: 350px;
        margin: 20px auto;
        /* padding: inherit; */
    }

    
    div#dropdown-inner {
        width: 350px;
        margin: 20px auto;
    }


    #homescreen {
        background: none !important;
    }

    #ImageGallery .nav.nav-pills {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
        margin-top: 3%;
    }

    #ImageGallery .nav-pills>li {
        /*width: 19%;*/
        text-align: center;
        color: #04567c !important;
        border-radius: 4px;
        margin: 15px 2px;
    }

    #ImageGallery .nav>li>a {
        color: #000 !important;
        background-color: #fff0;
        border: 1px solid #7b1846;
        padding: 10px 5px;
        border-radius: 10px;
        text-decoration: none;
    }

    #ImageGallery .nav-pills>li.active>a,
    .nav-pills>li.active>a:hover,
    .nav-pills>li.active>a:focus {
        color: #fff !important;
        background-color: #7b1846;
    }


    .marquee {
        color: #7a1845;
        font-weight: 600;
    }
</style>



<!-- section first start -->

<section id="eagleridgemain">

    <div class="eagleridgemain-inner">

        <div class="container">

            <div class="row d-flex justify-content-between">

                <div class="col-lg-6 col-6"><a href="collaterals.php" style="text-decoration: none;"><img
                            src="img/lessthanarrow-white.png" class="singlearrow"></i>

                        <span style="color: #fff;"> &nbsp; Projects</span></a>
                </div>

                <div class="col-lg-6 col-6"> <button type="button btn" class="pagesixhelp" data-bs-toggle="modal" data-bs-target="#myModal">Help</button>
                </div>

                <h2 class="eagleridge-head">

                    <?php echo $Project->project_name; echo $Project->city_name; ?>

                </h2>

            </div>

        </div>

</section>

<section id="dropmain">


    <div class="marquee">
    <marquee align="center" direction="left" scrollamount="5" width="100%" height="20">Go ahead and share the project collacterals with your lead.
</marquee>
</div>

    <div id="dropdown-inner">
        <div class="select-dropdown">
            <label style="    color: #941f53 !important;">Select Profile:</label>
            <select class="select2 " id="CdcProfile" style="    color: #941f53 !important;">

            </select>
            <!-- <input type="hidden" id="project_id" name="project_id" value="">           -->
        </div>

    </div>
</section>

<!-- eagleridge locatioon end -->


<!-- section first end -->

<!-- eagleridge icons start -->

<section id="eagleridge-icons">

    <div class="eagleridge-inner">

        <div class="container">

            <div class="row mt-4">

                <div class="col-4 eagle-icon">

                    <img src="img/Icons/sms.png" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal" id="SmsScript" data-id="SMS Script">

                    <p>SMS Script</p>

                    <!-- Button trigger modal -->

                    <!-- <button type="button">

  SMS Scripts

</button> -->



                    <!-- Modal -->

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="SMSModalLabel"
                        aria-hidden="true">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title" id="SMSModalLabel">SMS Scripts</h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>

                                </div>

                                <div class="modal-body" id="SMS_Script">


                                </div>

                                <div class="modal-footer">

                                    <!--  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        <button type="button" class="btn btn-primary">Save changes</button> -->

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-4 eagle-icon">

                    <img src="img/Icons/emailer.png" class="btn btn-primary" data-bs-toggle="modal"
                        href="#EmailerModal" role="button" id="Emailer" data-id="Emailer">

                    <div class="modal fade" id="EmailerModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title" id="exampleModalToggleLabel">Emailer</h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>

                                </div>

                                <div class="modal-body" id="EmailerBody">

                                    <!-- <iframe src="emailer01.html" height="auto" width="370" title="Iframe Example"></iframe> -->

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- <a >Open first modal</a> -->

                    <p>Emailer</p>

                </div>

                <div class="col-4 eagle-icon" data-bs-toggle="modal" data-bs-target="#exampleModal" id="SmsScript"
                    data-id="WhatsApp"><img src="img/whatsapp-logo.png">

                    <p>Whatsapp</p>

                </div>

            </div>

            <div class="row mt-2">

                <!-- <div class="col-4 eagle-icon"><a id="download_brochure" class="mybtn" href="<?php echo $brouchure; ?>"
                        download><img src="img/pdf.png">

                        <p>Brochure</p>

                    </a></div> -->

                <!--   <div class="col-4 eagle-icon"><a class="mybtn" href="<?php echo $brouchure; ?>" download><img src="img/pdf.png">

            <p>OPP DOC</p>

          </a></div> -->

                <div class="col-4 eagle-icon gal14" id="OpenGallery" data-bs-toggle="modal"
                    data-bs-target="#ImageGallery" data-id="Creatives"><img src="img/gallery.png">

                    <p>AD Creative</p>

                </div>

                <!--   </div>



      <div class="row mt-2"> -->
                <div class="col-4 eagle-icon" id="OpenGallery" data-bs-toggle="modal" data-bs-target="#ImageGallery"
                    data-id="Gallery"><img src="img/gallery.png">

                    <p>Gallery</p>

                    </a>
                </div>

                <div class="col-4 eagle-icon"><a class="video-btn" id="OpenVideo" data-bs-toggle="modal"
                        data-id="Videos" data-bs-target="#VideoModal"><img src="img/vdo.png">

                        <p>Video</p>

                    </a></div>



                <!-- <div class="col-4 eagle-icon"><a class="mybtn" href="<?php echo $brouchure; ?>" download><img src="img/pdf.png">

            <p>Cost Sheet</p>

          </a></div> -->

            </div>

        </div>

    </div>

</section>






<!-- Modal -->

<div class="modal fade" id="ImageGallery" tabindex="-1" aria-labelledby="GalleryLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="GalleryLabel">Ad Creative's</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body" id="AppendImages">

                <!-- <ul class="nav nav-pills">
            <li class="active constructionleft"><a data-toggle="tab" href="#external">External Image</a></li>
            <li><a data-toggle="tab" href="#internal">Internal Image</a></li>
            <li><a data-toggle="tab" href="#amenities">Amenities Image</a></li>
        </ul>
        <div class="tab-content">
            <div id="external" class="tab-pane active">
              <img src="img/Gallery.jpg">
            </div>
            <div id="internal" class="tab-pane">
              <img src="img/Gallery.jpg">
            </div>
            <div id="amenities" class="tab-pane">
              <img src="img/Gallery.jpg">
            </div>
        </div> -->

            </div>



        </div>

    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="VideoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelnew"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" id="video_gallery">

            </div>
        </div>
    </div>
</div>



</div>

<!-- Modal -->
<div class="modal fade" id="CDCModal" tabindex="-1" aria-labelledby="CDCModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="CDCModalLabel">Add Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="slider-form">
                    <form id="CdcProfileForm">

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

                        <!-- <div class="form-group">
            <img src="" id="company_logo" style="    height: 175;"/>
      </div>
 -->

                        <button class="btn btn-default" id="AddProfile">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ---------------------end cdc profile-------------------------- -->






<script src="js/bootstrap.bundle.min.js"></script>

<script src="js/jquery.min.js"></script>

<script src="js/jquery-ui.js"></script>

<script src="js/jquery-migrate-3.0.0.min.js"></script>
<script src="js/1.12.0_jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/lightgallery-all.js"></script>

<script src="js/swiper-bundle.min.js"></script>

<script src="js/aos.js"></script>

<script src="js/html2canvas.min.js"></script>

<script src="js/ekko-lightbox.js"></script>

<script src="js/select2.min.js"></script>


<script type="text/javascript">

    $('#loading').hide();
    var project_name = '<?php echo $Project->project_name; ?>';
    mixpanel.track("Project Collateral Page Load", {
        "PageName": lastPathSegment.replace(".php", ""),
        "collateral": "Project Collateral Page Load",
        "ProjectName":project_name,
        "$user_id": "<?php echo $_COOKIE['username']; ?>",
        "collateralevent": "Project Collateral Page Load",
    });




</script>

<script type="text/javascript">
    
    var marquee = document.querySelector('.marquee');

    var marqueeLength = marquee.clientWidth;

    var marqueeTravelTime = Math.ceil(marqueeLength / 100);

    marquee.style.animation = `scrollLeft ${marqueeTravelTime}s linear infinite`;

    marquee.addEventListener('mouseover', (e) => {
        marquee.style['animation-play-state'] = 'paused';
    })

    marquee.addEventListener('mouseout', (e) => {
        marquee.style['animation-play-state'] = 'running';
    })
</script>


<!-- Initialize Swiper -->
<script>
    function myFunction(cnt) {

       
        

        mixpanel.track("Copy SMS Script", {
            "PageName": lastPathSegment.replace(".php", ""),
            "collateral": "Copy SMS Script",
            "ProjectName":project_name,
            "$user_id": "<?php echo $_COOKIE['username']; ?>",
            "collateralevent": "Copy SMS Script",
        });

        var copyText = document.getElementById("myInput" + cnt);
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");

        var tooltip = document.getElementById("myTooltip" + cnt);
        tooltip.innerHTML = "Copied: "
    }

    function outFunc(cnt) {
        var tooltip = document.getElementById("myTooltip" + cnt);
        tooltip.innerHTML = "Copy to clipboard";
    }
</script>
<script type="text/javascript">



    $(document).ready(function () {
        var href = document.location.href;
        var lastPathSegment = href.substr(href.lastIndexOf('/') + 1);
        console.log(lastPathSegment);
        if (lastPathSegment == 'project_collateral.php') {

            $("#homescreen p").attr('style', 'color:#fff');
            $("#collaterals p").attr('style', 'color:#b9a479');
            $("#projectalloted p").attr('style', 'color:#fff');
            $("#generateleads p").attr('style', 'color:#fff');
            $("#units_available p").attr('style', 'color:#fff');


            $("#homescreen_white").show();
            $("#homescreen_red").hide();

            $("#collaterals_white").hide();
            $("#collaterals_red").show();

            $("#projectalloted_white").show();
            $("#projectalloted_red").hide();

            $("#generateleads_white").show();
            $("#generateleads_red").hide();

            $("#units_available_white").show();
            $("#units_available_red").hide();
        }



        // Gets the video src from the data-src on each button

        var $videoSrc;
        $('.video-btn').click(function () {
            $videoSrc = $(this).data("src");
        });




        // when the modal is opened autoplay it  
        $('#myModal').on('shown.bs.modal', function (e) {

            // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
            $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
        })



        // stop playing the youtube video when I close the modal
        $('#myModal').on('hide.bs.modal', function (e) {
            // a poor man's stop video
            $("#video").attr('src', $videoSrc);
        })






        // document ready  
    });



</script>

<!-- Initialize Swiper -->

<script>



    var swiper1 = new Swiper('.swiper1', {

        nextButton: '.swiper-button-next',

        prevButton: '.swiper-button-prev',

        paginationClickable: true,

        slidesPerView: 3,

        spaceBetween: 50,

        loop: true,

        breakpoints: {

            768: {

                slidesPerView: 3,

                spaceBetween: 30

            },

            640: {

                slidesPerView: 1,

                spaceBetween: 10

            }

        }

    });



    var swiper2 = new Swiper('.swiper2', {

        pagination: '.swiper-pagination2',

        paginationClickable: true,



        //   navigation: {

        //       nextEl: '.swparw99',

        //       prevEl: '.swparw9',

        //     },



        slidesPerView: 2,

        spaceBetween: 50,

        loop: true,



        breakpoints: {

            768: {

                slidesPerView: 2,

                spaceBetween: 30

            },

            640: {

                slidesPerView: 1,

                spaceBetween: 10

            }

        }

    });



</script>



<script type="text/javascript">

    let Collateral = '<?php echo $ProjectCollateral ?>';

    $(document).on("click", '.whatsapp', function () {

      
      

         

        mixpanel.track("Share WhatsApp Text", {
            "PageName": lastPathSegment.replace(".php", ""),
            "collateral": "Share WhatsApp Text",
            "ProjectName":project_name,
            "$user_id": "<?php echo $_COOKIE['username']; ?>",
            "collateralevent": "Share WhatsApp Text",
        });
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            var sText = $(this).data('msg');
            var sUrl = "Link to share";
            var sMsg = encodeURIComponent(sText);
            var whatsapp_url = "whatsapp://send?text=" + sMsg;
            window.location.href = whatsapp_url;
        }
        else {
            alert("Whatsapp client not available.");
        }
    });
    $(document).on("click", '.whatsapp-video', function () {
        
       
          

        mixpanel.track("Share WhatsApp Video", {
            "PageName": lastPathSegment.replace(".php", ""),
            "collateral": "Share WhatsApp Video",
            "ProjectName":project_name,
            "$user_id": "<?php echo $_COOKIE['username']; ?>",
            "collateralevent": "Share WhatsApp Video",
        });
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            var sText = $(this).data('msg').replace("/embed", "");
            sText = sText.replace("https://www.youtube.com", "https://youtu.be/");
            //var sUrl = "Link to share";
            var sMsg = encodeURIComponent(sText);
            var whatsapp_url = "whatsapp://send?text=" + sMsg;
            window.location.href = whatsapp_url;
        }
        else {
            alert("Whatsapp client not available.");
        }
    });

    $('.gal14').click(function () {

        var galdemo = $('#exampleModal1');

        galdemo.find('input[name=source]').val('Price Popup');

        galdemo.find('strong').html('Please enter the details');

        galdemo.modal();

        $('#exampleModal1').on('hidden.bs.modal', function () {

            $(this).find('.has-error').removeClass('has-error');

            priceValidate.resetForm();

        });

    });

</script>

<script type="text/javascript">

    $(document).ready(function () {
        if (navigator.onLine) {
            console.log("You are online!");
            $('#AddProfile').show();
        }else{
            console.log("You are offline!");
            $('#AddProfile').hide();
        }

        // $('#lightgallery5').lightGallery();

        //download: true

    });

</script>


<script>

    $(document).on('click', '#OpenGallery', function () {
        var id = $(this).data('id');
        var html = '';
        var type = id.split(' ').join('_');

        
        
          

        mixpanel.track(id + "open", {
            "PageName": lastPathSegment.replace(".php", ""),
            "collateral": id + "open",
            "ProjectName":project_name,
            "$user_id": "<?php echo $_COOKIE['username']; ?>",
            "collateralevent": id + "open",
        });
        if (type == 'Creatives') {
            $.each(Collateral, function (arr, i) {

                if (i.collateral_type == 'Creatives') {

                    var pathnames = i.pathnames;
                    var cnt = 0;
                    var path = pathnames.split(',');

                    html += '<div class="demo-gallery" name="galdemo" id="galdemo">';
                    html += '<ul id="lightgalleryCreatives" class="list-unstyled row">';
                    $.each(path, function (ImageArr, image) {

                        var ImageData = image.split('|');

                        html += '<li class="col-xs-4 col-sm-4 col-lg-2" data-responsive="<?php echo APIURL; ?>' + ImageData[0] + ' 375, <?php echo APIURL; ?>' + ImageData[0] + ' 480, <?php echo APIURL; ?>' + ImageData[0] + ' 800" data-src="<?php echo APIURL; ?>' + ImageData[0] + '">';
                        html += '<a href="">';
                        html += '  <img class="img-responsive" src="<?php echo APIURL; ?>' + ImageData[0] + '">';
                        html += '</a>';
                        html += '</li>';



                    })
                    html += '</ul>';
                    html += '</div>';

                }
            })

            $("#GalleryLabel").html(id);
            $("#AppendImages").html(html);

            $('#lightgalleryCreatives').lightGallery({
    thumbnail: false
});
        }
        else {
            html += ' <ul class="nav nav-pills">';
            $.each(Collateral, function (arr, i) {

                if (i.collateral_type == 'Exterior') {
                    html += '     <li class="active constructionleft"><a data-toggle="tab" href="#external">Exterior</a></li>';
                }
                if (i.collateral_type == 'Interiors') {
                    html += '     <li><a data-toggle="tab" href="#internal">Interior</a></li>';
                }
                if (i.collateral_type == 'Amenities') {
                    html += '     <li><a data-toggle="tab" href="#amenities">Amenities</a></li>';
                }
            })



            html += ' </ul>';
            html += ' <div class="tab-content">';



            $.each(Collateral, function (arr, i) {


                if (i.collateral_type == 'Exterior') {
                    var pathnames = i.pathnames;
                    var cnt = 0;
                    var path = pathnames.split(',');

                    html += '  <div id="external" class="tab-pane active">';

                    html += '<div class="demo-gallery" name="galdemo" id="galdemo">';
                    html += '<ul id="lightgalleryExterior" class="list-unstyled row">';
                    $.each(path, function (ImageArr, image) {

                        var ImageData = image.split('|');

                        console.log('<?php echo APIURL; ?>');
                        html += '<li class="col-xs-4 col-sm-4 col-lg-2" data-responsive="<?php echo APIURL; ?>' + ImageData[0] + ' 375, <?php echo APIURL; ?>' + ImageData[0] + ' 480, <?php echo APIURL; ?>' + ImageData[0] + ' 800" data-src="<?php echo APIURL; ?>' + ImageData[0] + '">';
                        html += '<a href="">';
                        html += '  <img class="img-responsive" src="<?php echo APIURL; ?>' + ImageData[0] + '">';
                        html += '</a>';
                        html += '</li>';

                    })
                    html += '</ul>';
                    html += '</div>';
                    html += '</div>';

                }

                if (i.collateral_type == 'Interiors') {
                    var pathnames = i.pathnames;
                    var cnt = 0;
                    var path = pathnames.split(',');

                    html += '  <div id="internal" class="tab-pane">';
                    console.log(i.collateral_type)
                    html += '<div class="demo-gallery" name="galdemo" id="galdemo">';
                    html += '<ul id="lightgalleryInteriors" class="list-unstyled row">';
                    $.each(path, function (ImageArr, image) {

                        var ImageData = image.split('|');

                        console.log('<?php echo APIURL; ?>');
                        html += '<li class="col-xs-4 col-sm-4 col-lg-2" data-responsive="<?php echo APIURL; ?>' + ImageData[0] + ' 375, <?php echo APIURL; ?>' + ImageData[0] + ' 480, <?php echo APIURL; ?>' + ImageData[0] + ' 800" data-src="<?php echo APIURL; ?>' + ImageData[0] + '">';
                        html += '<a href="">';
                        html += '  <img class="img-responsive" src="<?php echo APIURL; ?>' + ImageData[0] + '">';
                        html += '</a>';
                        html += '</li>';



                    })
                    html += '</ul>';
                    html += '</div>';
                    html += '</div>';

                }

                if (i.collateral_type == 'Amenities') {
                    var pathnames = i.pathnames;
                    var cnt = 0;
                    var path = pathnames.split(',');

                    html += '  <div id="amenities" class="tab-pane">';
                    console.log(i.collateral_type)
                    html += '<div class="demo-gallery" name="galdemo" id="galdemo">';
                    html += '<ul id="lightgalleryAmenities" class="list-unstyled row">';
                    $.each(path, function (ImageArr, image) {

                        var ImageData = image.split('|');

                        console.log('<?php echo APIURL; ?>');
                        html += '<li class="col-xs-4 col-sm-4 col-lg-2" data-responsive="<?php echo APIURL; ?>' + ImageData[0] + ' 375, <?php echo APIURL; ?>' + ImageData[0] + ' 480, <?php echo APIURL; ?>' + ImageData[0] + ' 800" data-src="<?php echo APIURL; ?>' + ImageData[0] + '">';
                        html += '<a href="">';
                        html += '  <img class="img-responsive" src="<?php echo APIURL; ?>' + ImageData[0] + '">';
                        html += '</a>';
                        html += '</li>';

                    })
                    html += '</ul>';
                    html += '</div>';
                    html += '</div>';

                }
                else {

                }
            })


            html += '    </div>';
            $("#GalleryLabel").html(id);
            $("#AppendImages").html(html);
            //console.log('#lightgallery'+type);
            //$('#lightgallery'+type).lightGallery();
            $('#lightgalleryExterior').lightGallery({
    thumbnail: false
});
            $('#lightgalleryAmenities').lightGallery({
    thumbnail: false
});
            $('#lightgalleryInteriors').lightGallery({
    thumbnail: false
});
        }
    })

    $(document).on('click', '#OpenVideo', function () {

        var id = $(this).data('id');

        var html = '';

        var type = id.split(' ').join('_')

        $.each(Collateral, function (arr, i) {



            if (i.collateral_type == id) {





                var msg_body = i.MsgBody;
                console.log(i);
                var cnt = 0;

                var link = msg_body.split('()');



                html += '<div class="demo-gallery" name="galdemo" id="galdemo">';

                html += '<ul id="lightgallery' + type + '" class="list-unstyled row">';

                $.each(link, function (ImageArr, video) {



                    var VideoData = video.split('|');





                    html += '<li class="col-xs-4 col-sm-4 col-lg-2" data-responsive="' + VideoData[0] + ' 375, ' + VideoData[0] + ' 480, ' + VideoData[0] + ' 800" data-src="' + VideoData[0] + '">';

                    html += '<a href="">';

                    html += '  <iframe src="' + VideoData[0] + '" height="auto" width="300" title="Iframe Example"></iframe>';

                    html += '</a>';
                    html += '<button type="button" data-msg="' + VideoData[0] + '" class="btn btn-default whatsapp-video" style="">';
                    html += '<span class="tooltiptext"><i class="fa-brands fa-whatsapp"></i></span>';

                    html += '</button>';

                    // html += '<a  class="btn btn-default facebook-video" href="https://www.facebook.com/sharer.php?u='+VideoData[0]+'&t=TEst" target="_blank"><span class="tooltiptext"><i class="fa-brands fa-facebook"  aria-hidden="true"></i></span></i></a>';

                    html += '</li>';

                })

                html += '</ul>';

                html += '</div>';



            }

        })



        $("#video_gallery").html(html);


        //$('#lightgallery'+type).lightGallery();

    })

    $(document).on('click', '#SmsScript', function () {


        var html = ''
        var cnt = 0;
        var name = '';
        var mobile = '';
        var email = '';
        var rera_no = '';

        if ($('#CdcProfile :selected').data('name') !== undefined) {
            name = $('#CdcProfile :selected').data('name');
        }

        if ($('#CdcProfile :selected').data('mobile') !== undefined) {
            mobile = $('#CdcProfile :selected').data('mobile');
        }

        if ($('#CdcProfile :selected').data('email') !== undefined) {
            email = $('#CdcProfile :selected').data('email');
        }

        if ($('#CdcProfile :selected').data('rera-no') !== undefined) {
            rera_no = $('#CdcProfile :selected').data('rera-no');
        }

        var id = $(this).data('id');
        
         

        mixpanel.track(id + " Open Modal", {
            "PageName": lastPathSegment.replace(".php", ""),
            "collateral": id + "Open Modal",
            "ProjectName":project_name,
            "$user_id": "<?php echo $_COOKIE['username']; ?>",
            "collateralevent": id + " Open Modal",
        });
        

        $.each(Collateral, function (arr, i) {

            if (i.collateral_type == id) {





                var msg = i.MsgBody;



                var MsgBody = msg.split('()');



                $.each(MsgBody, function (arr_msg, i_msg) {

                    cnt++;
                    var msg_body = i_msg.split('|');

                    var placeholders = msg_body[0].match(/\{(.*?)\}/g);

                    console.log(placeholders);
                    $.each(placeholders, function (arr, placeholder) {


                        var phText = placeholder.substring(1, placeholder.length - 1);

                        if (placeholder == '{name}') {
                            if (name != '') {
                                msg_body[0] = msg_body[0].replace(placeholder, name);
                            } else {
                                msg_body[0] = msg_body[0].replace(placeholder, '<?php echo $_COOKIE['name']; ?>');
                            }

                        }

                        if (placeholder == '{email}') {
                            if (email != '') {
                                msg_body[0] = msg_body[0].replace(placeholder, email);
                            } else {
                                msg_body[0] = msg_body[0].replace(placeholder, '<?php echo $_COOKIE['username']; ?>');
                            }

                        }

                        if (placeholder == '{rerano}') {
                            if (rera_no != '') {
                                msg_body[0] = msg_body[0].replace(placeholder, rera_no);
                            } else {
                                msg_body[0] = msg_body[0].replace(placeholder, '<?php echo $ChannelPartner->rerano ; ?>');
                            }

                        }

                        if (placeholder == '{mobile}') {
                            if (mobile != '') {
                                msg_body[0] = msg_body[0].replace(placeholder, mobile);
                            } else {
                                msg_body[0] = msg_body[0].replace(placeholder, '<?php echo $ChannelPartner->mobile; ?>');
                            }

                        }


                    })

                    html += '<textarea id="myInput' + cnt + '">';
                    html += msg_body[0];
                    html += '  </textarea>';
                    if (id == 'WhatsApp') {
                        html += '<div class="tooltip">';
                        html += '<button type="button" data-msg="' + msg_body[0] + '" class="btn btn-default whatsapp" style="">';
                        html += '<span class="tooltiptext"><i class="fa-brands fa-whatsapp"></i></span>';

                        html += '</button>';
                        html += '<button type="button" class="btn btn-default" onclick="myFunction(' + cnt + ')" style="">';
                        html += '<span class="tooltiptext" id="myTooltip' + cnt + '"><i class="fa-regular fa-copy"></i></span>';


                        html += '</button></div>';
                    }
                    else {
                        html += '<div class="tooltip">';
                        html += '<button type="button" class="btn btn-default" onclick="myFunction(' + cnt + ')" style="">';
                        html += '<span class="tooltiptext" id="myTooltip' + cnt + '"><i class="fa-regular fa-copy"></i></span>';

                        html += '</button></div>';
                    }
                    // onmouseout="outFunc('+cnt+')"



                })

            }



        });

        $("#SMSModalLabel").html(id)

        $("#SMS_Script").html(html);



    })


    $(document).on('click', '#download_brochure', function () {

        AddDataToAudit('Brochure','Download brochure');
        
        mixpanel.track("Download Brohcure", {
            "PageName": lastPathSegment.replace(".php", ""),
            "collateral": "Project Collateral",
            "ProjectName":project_name,
            "$user_id": "<?php echo $_COOKIE['username']; ?>",
            "collateralevent": "Download Brohcure",
        });
    })

    function AddDataToAudit(collateral,collateral_event) {
        var fd = new FormData();
        var project_id = '<?php echo $_GET['project_id'] ?>';
        fd.append('token', '<?php echo $_COOKIE['token'] ?>');
        fd.append('project_id', project_id);
        fd.append('collateral', collateral);
        fd.append('collateral_event', collateral_event);

        $.ajax({
            url: '<?php echo APIURL; ?>api/AddDataToAudit',
            data: fd,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {

                console.log(data);


            }

    });
        
    }


$(document).on('click', '#lg-download', function () {
    mixpanel.track("Download Gallery Image", {
        "PageName": lastPathSegment.replace(".php", ""),
        "collateral": "Project Collateral",
        "ProjectName":project_name,
        "$user_id": "<?php echo $_COOKIE['username']; ?>",
        "collateralevent": "Download Gallery Image",
    }); 
})




    $(document).on('click', '#Emailer', function () {

      
        mixpanel.track("<?php echo $_COOKIE['username']; ?>", {
            "PageName": lastPathSegment.replace(".php", ""),
            "collateral": "Emailer",
            "ProjectName": project_name,
            "collateralevent": "Emailer OpenModal",
        });

        mixpanel.track("Emailer OpenModal", {
            "PageName": lastPathSegment.replace(".php", ""),
            "collateral": "Project Details Page",
            "ProjectName":project_name,
            "$user_id": "<?php echo $_COOKIE['username']; ?>",
            "collateralevent": "Emailer OpenModal",
        });


        var html = ''

        var cnt = 0;

        var id = $(this).data('id');

        var name = '';

        var mobile = '';

        var email = '';

        var rera_no = '';

        var logo_path = '';

        if ($('#CdcProfile :selected').data('name') !== undefined) {
            name = $('#CdcProfile :selected').data('name');
        }

        if ($('#CdcProfile :selected').data('mobile') !== undefined) {
            mobile = $('#CdcProfile :selected').data('mobile');
        }

        if ($('#CdcProfile :selected').data('email') !== undefined) {
            email = $('#CdcProfile :selected').data('email');
        }

        if ($('#CdcProfile :selected').data('rera-no') !== undefined) {
            rera_no = $('#CdcProfile :selected').data('rera-no');
        }

        if ($('#CdcProfile :selected').data('logo-path') !== undefined) {
            logo_path = '<?php echo APIURL; ?>' + $('#CdcProfile :selected').data('logo-path');
        }

        $.each(Collateral, function (arr, i) {



            if (i.collateral_type == id) {

                cnt++;



                var pathnames = i.pathnames;





                var path = pathnames.split(',');



                $.each(path, function (arr_img, i_image) {

                    var image = i_image.split('|');

                    let dataHtml = '';





                    //html += '<iframe src="https://houseofhiranandani-kandivali.info/Hohadmin/public/'+image[0]+'" style="border:none;" title="Iframe Example"></iframe>';

                    $.get("Hohadmin/public/" + image[0], function (data) {



                        var placeholders = data.match(/\{(.*?)\}/g);


                        $.each(placeholders, function (arr, placeholder) {

                            $("#EmailerBody").html('');

                            //Placeholder - $Name$

                            var phText = placeholder.substring(1, placeholder.length - 1);

                            //phText = Name
                            //console.log(placeholder);

                            if (placeholder == '{name}') {
                                if (name != '') {
                                    data = data.replace(placeholder, name);
                                } else {
                                    data = data.replace(placeholder, '<?php echo $_COOKIE['name']; ?>');
                                }

                            }

                            if (placeholder == '{email_id}') {
                                if (email != '') {
                                    data = data.replace(placeholder, email);
                                } else {
                                    data = data.replace(placeholder, '<?php echo $_COOKIE['username']; ?>');
                                }

                            }

                            if (placeholder == '{rerano}') {
                                if (rera_no != '') {
                                    data = data.replace(placeholder, rera_no);
                                } else {
                                    data = data.replace(placeholder, '<?php echo $ChannelPartner->rerano ; ?>');
                                }

                            }

                            if (placeholder == '{mobile}') {
                                if (mobile != '') {
                                    data = data.replace(placeholder, mobile);
                                } else {
                                    data = data.replace(placeholder, '<?php echo $ChannelPartner->mobile; ?>');
                                }

                            }

                            if (placeholder == '{company_logo}') {
                                if (logo_path != '') {
                                    data = data.replace(placeholder, logo_path);
                                    console.log(logo_path);
                                } else {

                                    console.log('<?php echo  $APIURL.$ChannelPartner->company_logo; ?>');
                                    data = data.replace(placeholder, '<?php echo  APIURL.$ChannelPartner->company_logo; ?>');
                                }

                            }

                        })


                        html += '<div id="EmailerSpan">' + data + '</div>';

                        html += '<div id="canvas"></div>';

                        html += '<div class="col-12 emailerbt"><button data-id="' + image[1] + '" id="email_me" data-id>Email Me</button></div><span id="emailerMesg"></span>';

                        $("#EmailerBody").html(html);

                    });



                })

            }



        });





        //$("#EmailerBody").append(buttonhtml);





    })

    $(document).on('click', "#btn-Convert-Html2Image", function () {



        const EmailerBody = document.getElementById("EmailerSpan");

        var id = $(this).data('id');

        html2canvas(EmailerBody).then((canvas) => {

            $("#canvas").append(canvas);

            const base64image = canvas.toDataURL("image/png");

            var anchor = document.createElement('a');

            anchor.setAttribute('href', base64image);

            anchor.setAttribute('download', 'Emailer.png');

            anchor.click();

            anchor.remove();



        })



    })





    $(document).on('click', '#email_me', function () {

        $("#loading").show();
        

      

        mixpanel.track("Emailer SendEmail", {
            "PageName": lastPathSegment.replace(".php", ""),
            "collateral": "Project Collateral",
            "ProjectName":project_name,
            "$user_id": "<?php echo $_COOKIE['username']; ?>",
            "collateralevent": "Emailer SendEmail",
        });



        var fd = new FormData();

        fd.append('token', '<?php echo $_COOKIE['token'] ?>');

        fd.append('id', $(this).data('id'));



        $.ajax({

            url: '<?php echo APIURL; ?>api/SendEmailer',

            data: fd,

            processData: false,

            contentType: false,

            type: 'POST',

            success: function (data) {

                console.log(data.msg );

                $('#emailerMesg').html('<span class="alert alert-success">' + data.msg + '</span>');
                
                setTimeout(function () {
                    $("#EmailerModal").modal("hide");
                    $("#loading").hide();
                 }, 1500);
               
                //$('#CompanyProfile').modal('hide');

            }

        });





    })





    GetProjectDetails();
    GetCDCProfile();





    function GetProjectDetails() {

        var fd = new FormData();

        var project_id = '<?php echo $_GET['project_id'] ?>';
        var token = '<?php echo $_COOKIE['token'] ?>';

        // fd.append('token', '<?php echo $_COOKIE['token'] ?>');

        // fd.append('project_id', '<?php echo $_GET['project_id'] ?>');

        $.ajax({

            url: '<?php echo APIURL; ?>api/GetProjectDetails?token='+token+'&project_id='+project_id,

            //data: fd,

            processData: false,

            contentType: false,

            type: 'GET',

            success: function (data) {


                Collateral = data.ProjectCollateral;



            }

        });

    }


    function GetCDCProfile() {

        var token = '<?php echo $_COOKIE['token'] ?>';

        //var fd = new FormData();


        // fd.append('token', token);

        // fd.append('username', '<?php echo $_COOKIE['username'] ?>');
        var profile_id = '';
        var username = '<?php echo $_COOKIE['username'] ?>';

        $.ajax({

            url: '<?php echo APIURL; ?>api/GetCDCProfile?token='+token+'&profile_id='+profile_id+'&username='+username,

            //data: fd,
            processData: false,
            contentType: false,
            type: 'GET',
            success: function (data) {
                var html = '';

                //html += ' <li class="nav-item col-4" role="presentation">';

                html += '   <option  data-profile-name="Default" data-name="<?php echo $_COOKIE['name']; ?>" data-mobile="<?php echo $ChannelPartner->mobile ; ?>" data-email="<?php echo $_COOKIE['username']; ?>" data-rera-no="<?php echo $ChannelPartner->rerano; ?>" data-logo-path="<?php echo $ChannelPartner->company_logo; ?>">Default</option>';
                if (navigator.onLine) {
                    html += '   <option  value="create_profile">Create Profile</option>';
                }
                // html += '    </li>';

                if (data.ProfileCDCData.length > 0) {
                    $.each(data.ProfileCDCData, function (att, i) {

                        //html += ' <li class="nav-item col-4" role="presentation">';
                        html += '   <option  data-profile-name="' + i.profile_name + '" data-name="' + i.name + '" data-mobile="' + i.mobile + '" data-email="' + i.email + '" data-rera-no="' + i.rera_no + '" data-logo-path="' + i.logo_path + '">' + i.profile_name + '</option>';
                        //html += '    </li>';

                    })
                }

                $(".select2").html(html);

            }

        })

    }


    $(document).on('change', "#CdcProfile", function () {

        if ($(this).val() == 'create_profile') {
            $("#CdcProfileForm")[0].reset();
            $('#CDCModal').modal('show');

        }

    })

    $(document).on('click', '#AddProfile', function (e) {

        

        

        mixpanel.track("CdcProfile create", {
            "PageName": lastPathSegment.replace(".php", ""),
            "collateral": "Project Collateral",
            "ProjectName":project_name,
            "$user_id": "<?php echo $_COOKIE['username']; ?>",
            "collateralevent": "CdcProfile create",
        });


        //var FormData = new FormData($('#AddLead')[0];

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
                    $('#CDCModal').modal('hide');

                    GetCDCProfile();

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