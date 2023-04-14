<!doctype html>
<?php  include 'header.php'; ?>
<?php

session_start();
include 'constant.php';

    //print_r($_COOKIE);exit;

    if(!isset($_COOKIE['name']) && $_COOKIE['name'] == ''){
        header('Location: index.php');
    }


    $collateral_array  = array('Emailer','SMS Script','Brouchure','WhatsApp','Videos','Gallery','Plans');





    $curl = curl_init();



    curl_setopt_array($curl, array(

      CURLOPT_URL => APIURL.'api/GetProjectDetails',

      CURLOPT_RETURNTRANSFER => true,

      CURLOPT_ENCODING => '',

      CURLOPT_MAXREDIRS => 10,

      CURLOPT_TIMEOUT => 0,

      CURLOPT_FOLLOWLOCATION => true,

      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

      CURLOPT_CUSTOMREQUEST => 'POST',

      CURLOPT_POSTFIELDS =>'{"token":"'.$_COOKIE['token'].'","project_id":"'.$_POST['project_id'].'"}',

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

    $Project = $result->Project[0];

    $ProjectCollateral = $result->ProjectCollateral;

    //echo '<pre>'; print_r($result);exit;

    $brouchure = '';

    $main_banner = '';

    foreach ($ProjectCollateral as $key => $value) {

        if($value->collateral_type == 'Brouchure'){

            $path = explode('|', $value->pathnames);

            $brouchure = APIURL.''.$path[0];

        }

    }



    if($Project->hero_image_path != ''){

        $main_banner = APIURL.''.$Project->hero_image_path;

    }



?>

<!-- <html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HOH Mobile App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./css/style1.css">

    <link rel="stylesheet" href="./css/responsive1.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

</head> -->

<head>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="css/lightgallery.css" />

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

</head>





<style>

    body {

        background-color: #fff;

        background-image: none;

    }
     ul#lightgallery {

    margin: 0;

  }
    
    .carousel-control-next-icon {
    padding: 20px;
    background-color: #000;
}

.carousel-control-prev-icon {
    padding: 20px;
    background-color: #000;
}

#third-main span {
    padding: 0px 10px;
}

    section#footerpage20\ sticky-bottom {

    background-color: #7b1846;

    color: #fff;

    border-radius: 30px 30px 0px 0px;

    position: fixed;

    width: 100%;

    bottom: 0px;

    height: 75px;

    z-index: 999;

}

    li.nav-item {

    width: auto;

}

.abouttitle {

    padding: 0px 10px;

    font-family: 'Montserrat';

    font-size: 20px;

    padding-top: 20px;

    font-weight: bold;

    color: #941f53;

}



#aboutus {

    /*padding-bottom: 40px;*/

}



.aboutcontent p {

    padding: 10px 10px;

    text-align: justify;

    /*letter-spacing: 1px;*/

    letter-spacing: 1px;

    font-family: 'Open Sans', sans-serif;

}



.aboutinnertitle {

    font-family: 'Montserrat';

    font-weight: 600;

}

.nav-pills .nav-link, .nav-pills .show>.nav-link {

    color: #000;

    background-color: #fff;

    margin: 0 auto;

    font-size: 14px;



    width: 90%;

    border: 2px solid #941f53;

    margin-right: 13px;

}



.config {

    margin: 30px 0px;

    padding: 30px;

    box-shadow: 0 0 10px 5px rgb(0 0 0 / 10%);

    background-color: #fff;

    color: #941f53;

    }

.configuration img

{

        position: relative;

        left: 0%;

}



}

.configuration

{

    padding: 50px 50px 0px;

    position: relative;

    z-index: 1;

    background-color: transparent;

    top: -130px;

    text-align: center;



}

.configuration img

{

    position: relative;

    right: 10%;

}

.config p

{

    color: #000;

    font-size: 18px;

    /*font-family: cambria;*/

}

.config h4

{

    /*font-family: cambria, 'MyCambria', serif;*/

font-family: 'Roboto', sans-serif;

}



.overview-title {

    text-align: center;

}

.view-more

{

    padding: 8px;

    border: 2px solid #941f53;

    border-radius: 30px 30px;

    text-align: center;

    margin-top: 20px;

    background-color: #941f53;

    color: #fff;

}





.configuration {

    padding: 0px 20px;

} 

.view-more a

{

    font-size: 18px;

    color: #941f53;

    text-decoration: none;

    font-family: 'Roboto', sans-serif;

    /*font-family: cambria, 'MyCambria', serif;*/

}

.nav-pills .nav-link.active, .nav-pills .show>.nav-link {

    color: #941f53;

    background-color: #941f53;

    font-weight: 600;

    color: #fff;

}

.horizontal-nav {
    z-index: 99;
    position: fixed;
    bottom: 5px !important;
    width: 15%;
    right: 7px;
    height: 3.5em;
    /*background-color: #7b1846;*/
}

.menuwrapper {

    position:relative;

    margin:0 auto;

    overflow:hidden;

      padding:5px;

    height:80px;

}

section#eagleridge-carousel {
    margin-bottom: 50px;
}

.list {

    position:absolute;

    left:0px;

    top:0px;

    min-width:1200px;

    margin-left:12px;

    margin-top:0px;

}



.list li{

    display:table-cell;

    position:relative;

    text-align:center;

    cursor:grab;

    cursor:-webkit-grab;

    color:#efefef;

    vertical-align:middle;

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



.scroller-right{

  float:right;

}



.scroller-left {

  float:left;

}


.carousel-wrap {
    margin: 35px auto;
    padding: 0 5%;
    width: 100%;
    position: relative;
}
.owl-carousel .item {
    position: relative;
    z-index: 100; 
    -webkit-backface-visibility: hidden; 
}
.owl-nav i {
    font-size: 40px;
    color: #941f53;
}
.owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev {
    background: #fff;
    color: inherit;
    border: none;
    padding: 0!important;
    font: inherit;
    width: 30px;
    height: 40px;
    position: absolute;
    top: 0%;
}
.owl-nav .owl-prev {
    left: 0px;
    position: absolute;
}
.owl-nav .owl-next {
    right: 0px;
    position: absolute;
}


</style>

<form id="generateleads" action="generateleads.php" method="POST">

    <input type="hidden" name="project_id" id="project_id">    

</form>

<body>

    <section id="third-main">

        <div class="container">

            <div class="row d-flex justify-content-between">

                <div class="col-lg-6 col-9"><a href="homescreen.php"><img src="img/lessthanarrow-new.png" class="singlearrow"></a><span>Projects Alloted</span></div>

                <div class="col-lg-6 col-3"> <button type="button btn" class="pagesixhelp" data-bs-toggle="modal" data-bs-target="#myModal">Help</button> </div>

            </div>

        </div>

    </section>



    <!-- eagleridge main start -->

    <section id="eagleride">

        <div class="eagleride-inner">

            <div class="container">

                <div class="row">

                    <div class="col-6">

                        <div class="eagleride-head"><?php echo $Project->project_name; ?></div>

                    </div>

                    <div class="col-6">

                        <div class="eagleride-download">

                            <a id="my_download" href="<?php echo $brouchure; ?>" download="<?php echo $Project->project_name; ?>_brochure" style="display:none;"></a>

                            <!-- <button onClick="download_file()" class="download-btn">Download Brochure <i

                                    class="fa-solid fa-angle-down"></i></button> -->

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <hr>

    <!-- eagleridge main end -->









    <section id="eagleridge-serene">

        <div class="eagleridge-sereneinner">

            <div class="container">

                <div class="col-12" style="overflow: hidden;">

                    <img src="<?php echo $main_banner; ?>" style="height: 300px;">

                </div>



            </div>

        </div>

    </section>

    <!-- eagle serene start -->



      <section id="aboutus">

        <div class="aboutus-inner">

             <div class="container">

                <div class="col-12 aboutcontent">
                     <h6 class="text-center aboutinnertitle"><?php echo $Project->city_name; ?></h6>

                    <p>
                        <?php echo $Project->about_project; ?>


                   </p>

                </div>

                                <div class="eagleridge-cont">

                    <!--                 <h3 class="text-center">RERA NO:MahaRERA Registration No. P51800031613 RERA WEBSITE</h3>

                                    <br>

                                    <h5 class="text-center">2 BHK - 701.49 SQ.FT, 2 BHK - 738.20 SQ.FT, 3 BHK - 1024.19 SQ.FT STARTING PRICE:2.46 Cr Onwards</h5> -->

                <!--     <h2><?php echo $Project->carpet_area; ?></h2>

                    <p><?php echo $Project->project_name; echo $Project->city_name; ?></p>

                    <p><?php echo $Project->rera_certificate_no; ?></p>

                    <h4><?php echo $Project->carpet_area; ?></h4> -->

                </div>

             </div>

        </div>

    </section>



    <section id="overview">

    <!-- <img src="https://houseofhiranandani-kandivali.info/img/01.png" alt="service icon" class="hidden-xs icons1 serviceicon20"> -->

    <div class="overview-title">

        <h3 class="text-center abouttitle">UNIT & DETAILS</h3>

    </div>

    <div class="configuration col-lg-9 col-lg-offset-3">

        <div class="config col-lg-4">

            <h4>Unit</h4>

            <p><?php echo $Project->configuration; ?></p>

            <hr>

            <h4>Carpet Area</h4>

            <p><?php echo $Project->carpet_area; ?></p>

           

        </div>

        

        <!-- <img src="https://houseofhiranandani-kandivali.info/img/element.png" style="text-align: center;"> -->

    </div>

    <!-- <img src="img/04.png" alt="service icon" class="hidden-xs icons1 serviceicon21"> -->

 </section>



    <section id="aboutus">

        <div class="aboutus-inner">

             <div class="container">

                <!--  <h3 class="text-center abouttitle">LOCATION MAP</h3>

                 <br>

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3767.7511589843557!2d72.83199711407948!3d19.20606805286393!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b7f61d7b6fb1%3A0x5a913118bef2b56f!2sHouse%20of%20Hiranandani%20-%20Castalia!5e0!3m2!1sen!2sin!4v1668664869694!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->

            </div>

       </div>

   </section>










    <!-- eagleridge locatioon start -->

    <section id="eagleridge-carousel">

        <div id="eagleridge-location-inner">

            <div class="container">

                <div class="scroller scroller-left"><i class="fa-solid fa-angle-left"></i></div>

                <div class="scroller scroller-right"><i class="fa-solid fa-angle-right"></i></div>

                <!-- <div class="menuwrapper">

                    <ul class="nav nav-pills mb-3 mt-3 list" id="pills-tab" role="tablist">

                        <?php

                        $cnt1 = 0; 

                            foreach ($ProjectCollateral as $key1 => $value1) {

                                 

                                if (!in_array($value1->collateral_type, $collateral_array)){

                                // if($value1->collateral_type != 'Brouchure'){

                                    $cnt1++;

                                    $class1 = '';

                                    if($cnt1 == 1){

                                        $class1 = 'active';

                                    }

                                    echo '<li class="nav-item " role="presentation">

                                    <button class="nav-link '.$class1.'" id="'.str_replace(' ', '_', $value1->collateral_type).'" data-bs-toggle="pill"

                                    data-bs-target="#pills-'.str_replace(' ', '_', $value1->collateral_type).'" type="button" role="tab" aria-controls="pills-'.str_replace(' ', '_', $value1->collateral_type).'"

                                    aria-selected="false">'.$value1->collateral_type.'</button>

                                    </li>';

                                }

                            } 

                        ?>

                      

                    </ul>

                </div> -->

                <div id="elevationowl" class="owl-carousel nav nav-pills" role="tablist">
                                <?php
                        $cnt1 = 0; 
                            foreach ($ProjectCollateral as $key1 => $value1) {
                                if (!in_array($value1->collateral_type, $collateral_array)){
                                // if($value1->collateral_type != 'Brouchure'){
                                    $cnt1++;
                                    $class1 = '';
                                    if($cnt1 == 1){
                                        $class1 = 'active';
                                    }
                                    echo '<div class="item nav-item " role="presentation">
                                    <button class="nav-link '.$class1.'" id="'.str_replace(' ', '_', $value1->collateral_type).'" data-bs-toggle="pill" data-bs-target="#pills-'.str_replace(' ', '_', $value1->collateral_type).'" type="button" role="tab" aria-controls="pills-'.str_replace(' ', '_', $value1->collateral_type).'" aria-selected="false">'.$value1->collateral_type.'</button>
                                    </div>';

                                }

                            } 

                        ?>
                                <!-- <div class="item">
                                    <button class="nav-link active" id="Amenities" data-bs-toggle="pill" data-bs-target="#pills-Amenities" type="button" role="tab" aria-controls="pills-Amenities" aria-selected="true">Amenities</button>
                                </div> -->
                                
                            </div>

                <div class="tab-content" id="pills-tabContent">



                     <?php 

                     $cnt = 0;

                        foreach ($ProjectCollateral as $key => $Collateral) {

                           

                              if (!in_array($Collateral->collateral_type, $collateral_array)){

                             // if($Collateral->collateral_type != 'Brouchure'){

                                 $cnt++;

                                $class= '';

                                if($cnt == 1){

                                    $class = 'active';

                                }

                                    echo '<div class="tab-pane fade show '.$class.'" id="pills-'.str_replace(' ', '_', $Collateral->collateral_type).'" role="tabpanel"              aria-labelledby="pills-'.str_replace(' ', '_', $Collateral->collateral_type).'-tab" tabindex="0">

                                <div class="col-12 tab-content-main">';
                                echo '<div class="demo-gallery" name="galdemo" id="galdemo">';
              echo '<ul id="lightgallery'.str_replace(" ","_",$Collateral->collateral_type).'" class="list-unstyled row">';




                                $pathnames = explode(',',$Collateral->pathnames);                                

                                    // echo ' <div id="carousel'.str_replace(' ', '_', $Collateral->collateral_type).'Indicators" class="carousel slide" data-bs-ride="true">

                                        

                                    //     <div class="carousel-inner">';

                                        $cnt3 = 0;

                                        foreach($pathnames as $path){

                                            $cnt3++;

                                            $class3='';

                                            if($cnt3 == 1){

                                                $class3 = 'active';

                                            }

                                        $image = explode('|',$path); 

                                        
                                        echo '<li class="col-xs-4 col-sm-4 col-lg-2" data-responsive="'.APIURL.''.$image[0].' 375, '.APIURL.''.$image[0].' 480, '.APIURL.''.$image[0].' 800" data-src="'.APIURL.''.$image[0].'">';
                if($cnt3 == 1){
                    echo '<a href="">';
              
                    echo '  <img src="'.APIURL.''.$image[0].'" class="d-block w-100" alt="...">';
                    echo '</a>';
                }
              
              echo '</li>';
                                        // echo '<div class="carousel-item '.$class3.'">

                                        //         <img src="'.APIURL.''.$image[0].'" class="d-block w-100" alt="...">

                                        //     </div>';                                       

                                        

                                         }

                                          echo '</ul>';
                                            echo '</div>';  

                                   

                                echo'</div>

                             </div>';      

                                

                            }


                        }

                    ?>

                 

                </div>



                <!-- <button type="button" class="btn col-12 gallery-btn mt-5">SHOW GALLERY</button> -->

            </div>

        </div>

    </section>
<br>
<br>
<br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script src="js/lightgallery-all.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script type="text/javascript">
        $('#elevationowl').owlCarousel({
            loop: false,
            margin: 0,
            nav: true,
            center: true,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            autoplay: false,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        })
    </script>

    <script type="text/javascript">
    $(document).on('click', '#my_download', function () {
        $('#loading').show(); 

        setTimeout(function () {
            $('#loading').hide(); 
        }, 2500);

        mixpanel.track("Download Brohcure", {
            "PageName": lastPathSegment.replace(".php", ""),
            "collateral": "Project Details",
            "ProjectName":project_name,
            "$user_id": "<?php echo $_COOKIE['username']; ?>",
            "collateralevent": "Download Brohcure",
        });   

  })
let Collateral = [];

GetProjectDetails();

var project_name = '<?php echo $Project->project_name; ?>';

mixpanel.track("Project Details Page", {
    "PageName": lastPathSegment.replace(".php", ""),
    "collateral": "Project Details Page",
    "ProjectName":project_name,
    "$user_id": "<?php echo $_COOKIE['username']; ?>",
    "collateralevent": "Project Details Page",
}); 

$(document).on('click', '#lg-download', function () {
    mixpanel.track("Download Gallery Image", {
        "PageName": lastPathSegment.replace(".php", ""),
        "collateral": "Project Details Page",
        "ProjectName":project_name,
        "$user_id": "<?php echo $_COOKIE['username']; ?>",
        "collateralevent": "Download Gallery Image",
    }); 
})


  



  function GetProjectDetails() {

    var fd = new FormData();

    fd.append('token', '<?php echo $_COOKIE['token'] ?>');

    fd.append('project_id', '<?php echo $_POST['project_id'] ?>');

   $.ajax({

      url: '<?php echo APIURL; ?>api/GetProjectDetails',

      data: fd,

      processData: false,

      contentType: false,

      type: 'POST',

      success: function (data) {


        Collateral = data.ProjectCollateral;
        $.each(Collateral,function(arr, i){
            var id= i.collateral_type
            var type = id.split(' ').join('_');

            $('#lightgallery'+type).lightGallery({
    thumbnail: false
});
            

        })

      }

    });

  }  


         $('#loading').hide(); 

        var href = document.location.href;
        var lastPathSegment = href.substr(href.lastIndexOf('/') + 1);

        if(lastPathSegment == 'project_details.php'){

            $("#homescreen p").attr('style','color:#fff');
            $("#collaterals p").attr('style','color:#fff');
            $("#projectalloted p").attr('style','color:#b9a479');
            $("#generateleads p").attr('style','color:#fff');
            $("#units_available p").attr('style','color:#fff');

            
            $("#homescreen_white").show();
            $("#homescreen_red").hide();

            $("#collaterals_white").show();
            $("#collaterals_red").hide();

            $("#projectalloted_white").hide();
            $("#projectalloted_red").show();

            $("#generateleads_white").show();
            $("#generateleads_red").hide();

            $("#units_available_white").show();
            $("#units_available_red").hide();
        }

        var hidWidth;

var scrollBarWidths = 40;



var widthOfList = function(){

  var itemsWidth = 0;

  $('.list li').each(function(){

    var itemWidth = $(this).outerWidth();

    itemsWidth+=itemWidth;

  });

  return itemsWidth;

};



var widthOfHidden = function(){

  return (($('.menuwrapper').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;

};



var getLeftPosi = function(){

  return $('.list').position().left;

};



var reAdjust = function(){

  if (($('.menuwrapper').outerWidth()) < widthOfList()) {

    $('.scroller-right').show();

  }

  else {

    $('.scroller-right').hide();

  }

  

  if (getLeftPosi()<0) {

    $('.scroller-left').show();

  }

  else {

    $('.item').animate({left:"-="+getLeftPosi()+"px"},'slow');

    $('.scroller-left').hide();

  }

}



reAdjust();



$(window).on('resize',function(e){  

    reAdjust();

});



$('.scroller-right').click(function() {

  

  $('.scroller-left').fadeIn('slow');

  $('.scroller-right').fadeOut('slow');

  

  $('.list').animate({left:"+="+widthOfHidden()+"px"},'slow',function(){



  });

});



$('.scroller-left').click(function() {

  

    $('.scroller-right').fadeIn('slow');

    $('.scroller-left').fadeOut('slow');

  

    $('.list').animate({left:"-="+getLeftPosi()+"px"},'slow',function(){

    

    });

});    

    </script>

<script type="text/javascript">
    /*
* VirtualScroll from drojdjou
* https://github.com/drojdjou/bartekdrozdz.com/blob/master/static/src/framework/VirtualScroll.js
*/

var VirtualScroll = (function (document) {
    var vs = {};

    var numListeners, listeners = [], initialized = false;

    var touchStartX, touchStartY;

    // [ These settings can be customized with the options() function below ]
    // Mutiply the touch action by two making the scroll a bit faster than finger movement
    var touchMult = 2;
    // Firefox on Windows needs a boost, since scrolling is very slow
    var firefoxMult = 15;
    // How many pixels to move with each key press
    var keyStep = 10;
    // General multiplier for all mousehweel including FF
    var mouseMult = 1;

    var bodyTouchAction;

    var hasWheelEvent = 'onwheel' in document;
    var hasMouseWheelEvent = 'onmousewheel' in document;
    var hasTouch = 'ontouchstart' in document;
    var hasTouchWin = navigator.msMaxTouchPoints && navigator.msMaxTouchPoints > 1;
    var hasPointer = !!window.navigator.msPointerEnabled;
    var hasKeyDown = 'onkeydown' in document;

    var isFirefox = navigator.userAgent.indexOf('Firefox') > -1;

    var event = {
        y: 0,
        x: 0,
        deltaX: 0,
        deltaY: 0,
        originalEvent: null
    };

    vs.on = function (f) {
        if (!initialized) initListeners();
        listeners.push(f);
        numListeners = listeners.length;
    }

    vs.options = function (opt) {
        keyStep = opt.keyStep || 120;
        firefoxMult = opt.firefoxMult || 15;
        touchMult = opt.touchMult || 2;
        mouseMult = opt.mouseMult || 1;
    }

    vs.off = function (f) {
        listeners.splice(f, 1);
        numListeners = listeners.length;
        if (numListeners <= 0) destroyListeners();
    }

    var notify = function (e) {
        event.x += event.deltaX;
        event.y += event.deltaY;
        event.originalEvent = e;

        for (var i = 0; i < numListeners; i++) {
            listeners[i](event);
        }
    }

    var onWheel = function (e) {
        // In Chrome and in Firefox (at least the new one)
        event.deltaX = e.wheelDeltaX || e.deltaX * -1;
        event.deltaY = e.wheelDeltaY || e.deltaY * -1;

        // for our purpose deltamode = 1 means user is on a wheel mouse, not touch pad 
        // real meaning: https://developer.mozilla.org/en-US/docs/Web/API/WheelEvent#Delta_modes
        if (isFirefox && e.deltaMode == 1) {
            event.deltaX *= firefoxMult;
            event.deltaY *= firefoxMult;
        }

        event.deltaX *= mouseMult;
        event.deltaY *= mouseMult;

        notify(e);
    }

    var onMouseWheel = function (e) {
        // In Safari, IE and in Chrome if 'wheel' isn't defined
        event.deltaX = (e.wheelDeltaX) ? e.wheelDeltaX : 0;
        event.deltaY = (e.wheelDeltaY) ? e.wheelDeltaY : e.wheelDelta;

        notify(e);
    }

    var onTouchStart = function (e) {
        var t = (e.targetTouches) ? e.targetTouches[0] : e;
        touchStartX = t.pageX;
        touchStartY = t.pageY;
    }

    var onTouchMove = function (e) {
        // e.preventDefault(); // < This needs to be managed externally
        var t = (e.targetTouches) ? e.targetTouches[0] : e;

        event.deltaX = (t.pageX - touchStartX) * touchMult;
        event.deltaY = (t.pageY - touchStartY) * touchMult;

        touchStartX = t.pageX;
        touchStartY = t.pageY;

        notify(e);
    }

    var onKeyDown = function (e) {
        // 37 left arrow, 38 up arrow, 39 right arrow, 40 down arrow
        event.deltaX = event.deltaY = 0;
        switch (e.keyCode) {
            case 37:
                event.deltaX = -keyStep;
                break;
            case 39:
                event.deltaX = keyStep;
                break;
            case 38:
                event.deltaY = keyStep;
                break;
            case 40:
                event.deltaY = -keyStep;
                break;
        }

        notify(e);
    }

    var initListeners = function () {
        // if (hasWheelEvent) document.addEventListener("wheel", onWheel);
        // if (hasMouseWheelEvent) document.addEventListener("mousewheel", onMouseWheel);

        if (hasTouch) {
            document.addEventListener("touchstart", onTouchStart);
            document.addEventListener("touchmove", onTouchMove);
        }

        if (hasPointer && hasTouchWin) {
            bodyTouchAction = document.body.style.msTouchAction;
            document.body.style.msTouchAction = "none";
            document.addEventListener("MSPointerDown", onTouchStart, true);
            document.addEventListener("MSPointerMove", onTouchMove, true);
        }

        if (hasKeyDown) document.addEventListener("keydown", onKeyDown);

        initialized = true;
    }

    var destroyListeners = function () {
        if (hasWheelEvent) document.removeEventListener("wheel", onWheel);
        if (hasMouseWheelEvent) document.removeEventListener("mousewheel", onMouseWheel);

        if (hasTouch) {
            document.removeEventListener("touchstart", onTouchStart);
            document.removeEventListener("touchmove", onTouchMove);
        }

        if (hasPointer && hasTouchWin) {
            document.body.style.msTouchAction = bodyTouchAction;
            document.removeEventListener("MSPointerDown", onTouchStart, true);
            document.removeEventListener("MSPointerMove", onTouchMove, true);
        }

        if (hasKeyDown) document.removeEventListener("keydown", onKeyDown);

        initialized = false;
    }

    return vs;
})(document);

/*
* End VirtualScroll
*/


var scrollSection = document.getElementById('pills-tab');
var contentWrapper = scrollSection.querySelector('.nav-item');
var currentX = 0, targetX = 0, ease = 0.1;

const setTargetX = (value) => {
    targetX += value * 1.25;
    targetX = Math.max((scrollSection.getBoundingClientRect().width - window.innerWidth) * -1, targetX);
    targetX = Math.min(0, targetX); 
}

// A bit faster for touch
VirtualScroll.options({
    touchMult: 3,
});
    
VirtualScroll.on((e) => {
    setTargetX(e.deltaX || e.deltaY);
})

function mousemove(e) {
    setTargetX(e.movementX * 1.25);
}

function mousedown(e) {
    scrollSection.addEventListener('mousemove', mousemove);
    // document.addEventListener('mouseup', mouseup);
    contentWrapper.style.transformOrigin = (currentX * -1) + e.clientX + 'px';
    contentWrapper.classList.add('drag');
}

function mouseup() {
        scrollSection.removeEventListener('mousemove', mousemove);
        contentWrapper.classList.remove('drag');
}

scrollSection.addEventListener('mousedown', mousedown);
    
    
const raf = () => {
    requestAnimationFrame(raf);
    currentX += Math.round(((targetX - currentX) * ease) * 1000) / 1000;
    var t = `translateX(${currentX}px)`;
    var s = scrollSection.style;
    s["transform"] = t;
    s["webkitTransform"] = t;
    s["mozTransform"] = t;
    s["msTransform"] = t;
}
raf();
</script>


    <script>

        function download_file() {

            document.getElementById("my_download").click()

        }



        $(document).on('click',"#GenerateLead",function(){

            var id = $(this).data('id'); 

            $("#project_id").val(id);

            $("#generateleads").submit();

        

        })

    </script>


</body>



</html>

