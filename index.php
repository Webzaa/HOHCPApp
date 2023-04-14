<!doctype html>
<html lang="en">

<head>
<?php
    include_once 'functions.php';
    include 'constant.php';
  
    
    session_start();
    $msg = '';
    
    if(isset($_COOKIE['token']) && $_COOKIE['token'] != '' && isset($_COOKIE['username']) && $_COOKIE['username'] != ''){
    

        $url = APIURL.'api/loginCheck';
        $data = '{"token":"'.$_COOKIE['token'].'","email":"'.$_COOKIE['username'].'"}';
        

        $result = APICALL($url,$data);
        //echo'<pre>';print_r($result);exit;
        if($result->success == 'true')
        {
            header('Location: homescreen.php');
        }
        else{
         //header('Location: index.php');
            $msg = 'Your logged out of device.';
        }

    }

    //print_r($_SESSION);exit;

  
    // Function to get the client IP address
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
  
    $ip_address = get_client_ip();
    

    if (!empty($_POST['username']) && !empty($_POST['password'])) {


        $username = $_POST['username'];
        $password = $_POST['password'];
        $latitude = $_POST['lat'];
        $longitude = $_POST['long'];

    
        $url = APIURL.'api/login';
        $data = '{"email":"'.$username.'","password": "'.$password.'","ip_address": "'.$ip_address.'","latitude": "'.$latitude.'","longitude": "'.$longitude.'"}';        

        $result = APICALL($url,$data);


        //echo'<pre>';print_r($result);exit;


       if ($result->msg == 'You have Login Successfully'){

          

          $_SESSION['valid'] = true;
          $_SESSION['token'] = $result->success->token->name;  
          $_SESSION['status'] = $result->status;
          $_SESSION['name'] = $result->user->name;
          $_SESSION['username'] = $result->user->email;

          setcookie('valid', true, time() + (86400 * 30), "/");
          setcookie('token', $result->success->token->name, time() + (86400 * 30), "/");
          setcookie('status', $result->status, time() + (86400 * 30), "/");
          setcookie('name', $result->user->name, time() + (86400 * 30), "/");
          setcookie('username', $result->user->email, time() + (86400 * 30), "/");          

          header('Location: homescreen.php');

       }else {

          $msg = $result->msg;

       }

    }
    elseif(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['name'])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rerano = $_POST['rerano'];   
        $mobile = $_POST['mobile'];  

        $url = APIURL.'api/Register';

        //print_r($_POST);exit;

        $data = '{"email":"'.$email.'","name": "'.$name.'","rerano": "'.$rerano.'","mobile": "'.$mobile.'","password": "'.$password.'"}';
        //print_r($data);exit;

        $result = APICALL($url,$data);


        if (isset($result->success)){
           

          $_SESSION['valid'] = true;
          $_SESSION['token'] = $result->success->token->name;
          $_SESSION['timeout'] = time();
          $_SESSION['name'] = $result->user->name;
          $_SESSION['username'] = $result->user->email;


          setcookie('valid', true, time() + (86400 * 30), "/");
          setcookie('token', $result->success->token->name, time() + (86400 * 30), "/");
          setcookie('status', $result->status, time() + (86400 * 30), "/");
          setcookie('name', $result->user->name, time() + (86400 * 30), "/");
          setcookie('username', $result->user->email, time() + (86400 * 30), "/");
          

          header('Location: homescreen.php');

       }else {

          $msg = 'User Already exists.';

       } 

    }

?>

    

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>HOH Mobile App</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="./css/stylenewest.css">

<link rel="stylesheet" href="./css/responsive.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

<link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">

<link rel="manifest" href="manifest.json">

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">



<script type="text/javascript">
(function(f,b){if(!b.__SV){var e,g,i,h;window.mixpanel=b;b._i=[];b.init=function(e,f,c){function g(a,d){var b=d.split(".");2==b.length&&(a=a[b[0]],d=b[1]);a[d]=function(){a.push([d].concat(Array.prototype.slice.call(arguments,0)))}}var a=b;"undefined"!==typeof c?a=b[c]=[]:c="mixpanel";a.people=a.people||[];a.toString=function(a){var d="mixpanel";"mixpanel"!==c&&(d+="."+c);a||(d+=" (stub)");return d};a.people.toString=function(){return a.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking start_batch_senders people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
for(h=0;h<i.length;h++)g(a,i[h]);var j="set set_once union unset remove delete".split(" ");a.get_group=function(){function b(c){d[c]=function(){call2_args=arguments;call2=[c].concat(Array.prototype.slice.call(call2_args,0));a.push([e,call2])}}for(var d={},e=["get_group"].concat(Array.prototype.slice.call(arguments,0)),c=0;c<j.length;c++)b(j[c]);return d};b._i.push([e,f,c])};b.__SV=1.2;e=f.createElement("script");e.type="text/javascript";e.async=!0;e.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?
MIXPANEL_CUSTOM_LIB_URL:"file:"===f.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";g=f.getElementsByTagName("script")[0];g.parentNode.insertBefore(e,g)}})(document,window.mixpanel||[]);

// Enabling the debug mode flag is useful during implementation,
// but it's recommended you remove it for production
mixpanel.init('8450cbc21317d354e68ceab40f0cbaf5', {debug: true}); 
mixpanel.track('Login Page');
</script>





<!-- microsoft clarity -->
<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "fd2le02ady");
</script>

</head>

<style type="text/css">

    @import "compass/css3";

@import url(https://fonts.googleapis.com/css?family=Belleza);

body {
    background: url('https://subtlepatterns.com/patterns/dark_wall.png');
}

form.form-signin.mt-5 {
    padding: 20px;
}

#popup {
 padding: 10px;
    position: absolute;
    bottom: 1000px;
    width: 200px;
    height: 90px;
    left: 22%;
    background-color: #941f53;
    /* background-image: linear-gradient(to bottom, #941f53 0%, #941f53 50%, #941f53 51%, #941f53 100%); */
    51%, #fd4703 100%): ;
    /* border: 2px solid #00234c; */
    -webkit-border-radius: 5px;
    z-index: 9999;
    text-align: center;
    
}


.error {
    border-color: red;
}

#popup h4 {
  color: white;
  text-shadow: 0px -2px 0px #00234c;
  font-size: 18px;
  font-family: Belleza;
  margin-top: 0;
  margin-bottom: 0;
}
#popup p {
  color: white;
  text-shadow: 0px -2px 0px #00234c;
  font-size: 12px;
  font-weight: bold;
  font-family: Helvetica, Arial, sans-serif;
}


.popup-close-icon {
  position: absolute;
  width: 0px;
  right: 20px;
  top: 0px;
  font-size: 24px;
  font-weight: bolder;
  color: white;
  text-shadow: 0px -1px 1px #00234c;
  cursor: pointer;
}

.bottom-bar {
  position: absolute;
  bottom: 8%;
  left: 8px;
}

    button.pagetwohelp{

        left: 78%;

    }

    #SignUp .button {

    margin-top: 10%;

}

button#registerbtn {

    background-color: #941f53;

    color: #fff;

    border: 1px solid #fff;

    width: 100%;

    border-radius: 0px;

}
.loader4 {
    width: 104px;
    height: 45px;
    /* display: flex; */
    padding: 0px;
    position: absolute;
    top: 50%;
    text-align: center;
    margin: 0 auto;
    /* top: 0; */
    bottom: 0;
    right: 0;
    left: 0;
}

.arrow {
  position: absolute;
  width: 2.1rem;
  height: 0.48rem;
  margin: 0 auto;
    text-align: center;
    right: 49%;
    opacity: 0;
    z-index: 99999;
  opacity: 0;
  transform: scale(0.3);
  animation: move-arrow 3s ease-out infinite;
}
.arrow:first-child {
  animation: move-arrow 3s ease-out 1s infinite;
}
.arrow:nth-child(2) {
  animation: move-arrow 3s ease-out 2s infinite;
}
.arrow:before,
.arrow:after {
  content: "";
  position: absolute;
  top: 0;
  height: 100%;
  width: 50%;
  background: #941f53;
}
.arrow:before {
  left: 0;
  transform: skewY(30deg);
}
.arrow:after {
  right: 0;
  width: 50%;
  transform: skewY(-30deg);
}
@keyframes move-arrow {
  25% {
    opacity: 1;
  }
  33.3% {
    opacity: 1;
    transform: translateY(2.28rem);
  }
  66.6% {
    opacity: 1;
    transform: translateY(3.12rem);
  }
  100% {
    opacity: 0;
    transform: translateY(4.8rem) scale(0.5);
  }
}


</style>
<div id="loading" >
<div class="container">
    <div class="row">
      <div class="col-sm-6 text-center">
        <div class="loader4"><img src="img/loader.gif"></div>
      </div>
    </div>
</div>
</div>
<body id="index-body" style="overflow: hidden;">




     <!-- section one strart -->

    <section id="AndriodImage" style="display: none;">

        <video class="img-fluid hidden-lg" autoplay="" loop="" muted="" playsinline="" style="width: 100%;">

            <source src="img/videochrome.mp4" type="video/mp4">

        </video>          

    </section>

    <!-- section one end -->

     <!-- section one strart -->

    <section id="IOSImage" style="display: none;">

         <video class="img-fluid hidden-lg" autoplay="" loop="" muted="" playsinline="" style="width: 100%;">

            <source src="img/IOSVideo.mp4" type="video/mp4">

        </video> 

    </section>

    <!-- section one end -->
    <!-- section one strart -->

    <section id="main">

        <div class="container">

            <div class="row">

                
            </div>

        </div>

    </section>

    <!-- section one end -->



    <section id="login" style="display: none;">

        <div class="container">

            <div class="row">

                <div class="col-lg-10 col-md-10 offset-lg-1 offset-md-1">

                    <h4 class="head"> Login </h4>

                    <form class="form-signin mt-5" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

                        <div class="mb-3 col-lg-4 col-md-10 offset-lg-4 offset-md-1">

                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email ID" name="username">
                            <input type="hidden" name="lat" id="lat">
                            <input type="hidden" name="long" id="long">

                        </div>

                        <div class="mb-3 col-lg-4 col-md-10 offset-lg-4 offset-md-1 mt-4">

                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">

                        </div>

                        <div class="button col-lg-10 col-md-10 offset-md-1">

                            <button type="submit" class="btn btn-primary login btn-lg btn-block">LOGIN</button> <br>

                            

                        </div>

                        <div class="mb-3 col-lg-4 col-md-8 offset-lg-4 offset-md-2 mt-4">

                            <a href="forget-password.php" style="color: #fff; text-decoration: none;"><span

                                    class="text-right"

                                    style="border-bottom: 1px solid #fff; color: #fff; float: right;;">Forgot

                                    Password</span></a>

                        </div>

                        <br>

                        <br>

                        <div class="mb-3 col-lg-4 col-md-10 offset-lg-4 offset-md-1 mt-4">

                            <button type="button" class="btn btn-primary Signin btn-lg btn-block" id="signupbtn">Not a Registered User?  <u>Register Now</u></button>

                        </div>

                        <?php if($msg != ''){ ?>

                        <div class="mb-3 col-lg-4 col-md-8 offset-lg-4 offset-md-2 mt-4">

                            <span style="color: #edd55d;"><?php echo $msg; ?></span>

                        </div>

                        <?php } ?>

                        

                    </form>



                </div>

            </div>

        </div>

    </section>

    <section id="SignUp" style="display: none;">

        <div class="container">

            <div class="row">

                <div class="col-lg-12 mt-5">

                    <h4 class="head"> Sign Up </h4>

                    <form class="mt-5" id="register" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

                        <div class="mb-3 col-lg-4 col-md-10 offset-lg-4 offset-md-1">

                            <input type="text" class="form-control" id="fname" aria-describedby="mobhelp" placeholder="Name*" name="name">

                        </div>

                        <div class="mb-3 col-lg-4 col-md-10 offset-lg-4 offset-md-1">

                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email ID*" name="email">

                        </div>

                        <div class="mb-3 col-lg-4 col-md-10 offset-lg-4 offset-md-1">

                            <input type="text" class="form-control" id="rerano"  aria-describedby="reraHelp" placeholder="Rera No*" name="rerano">

                        </div>

                        <div class="mb-3 col-lg-4 col-md-10 offset-lg-4 offset-md-1">

                            <input type="number" class="form-control" id="mobile"  aria-describedby="reraHelp" placeholder="Mobile*" name="mobile">

                        </div>

                        <div class="mb-3 col-lg-4 col-md-10 offset-lg-4 offset-md-1">

                            <input type="password" class="form-control" id="password" placeholder="Password*" name="password">

                        </div>

                        <div class="mb-3 col-lg-4 col-md-10 offset-lg-4 offset-md-1">

                            <input type="password" class="form-control" id="cnfpassword" placeholder="Confirm Password*" name="cnfpassword">

                        </div>



                        <div class="button  col-lg-10 col-md-10 offset-md-1 text-center">

                            <button type="button" class="btn btn-primary newbutton Signin btn-lg btn-block" id="registerbtn">SIGN UP</button> <br> <br>

                            <h6 style="color: #fff; text-align: center;">Already have an account</h6>

                            <button type="button" class="btn btn-primary login btn-lg btn-block" id="newloginbtn">LOGIN</button>

                        </div>

                     



                    </form>



                </div>

            </div>

        </div>


    </section>

    
   
     
 

    <footer>
        <div id="popup" style="display:none;">
        <div class="popup-close-icon">&times;</div>
        <h4>Add Our App?</h4>
        <p>Tap below to add an icon to your home screen for quick access!</p>
    </div>

        <div class="container">
<div class="arrow" style="display:none;"></div>
  <div class="arrow" style="display:none;"></div>
  <div class="arrow" style="display:none;"></div> 
            

            <div class="col-lg-12">

                <div class="footerinner" style="display:none;">

                    <p class="text-center">© 2022 House Of Hiranandani</p></div>

            </div>

        </div>

    </footer>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">

    function getLocation() {
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            console.log("Geo Location not supported by browser");
        }
    }
    //function that retrieves the position
    function showPosition(position) {
    
        var longitude = position.coords.longitude;
        var latitude = position.coords.latitude;
        

       $("#lat").val(latitude);
       $("#long").val(longitude);
       // console.log(longitude);
    }
    //request for location
    getLocation();

        $(document).on('click','.login',function(e){
            e.preventDefault();
            $("#loading").show();
            $(".form-signin").submit();
        })

       if (navigator.onLine) {
            console.log("You are online!");
        }else{
            console.log("You are offline!");
        }
        if (window.matchMedia('(display-mode: standalone)').matches) {  
            setTimeout(function () {
                $('#main').hide();
                $('#login').show();
            }, 2500);

            $('#AndriodImage').hide();
            $('#IOSImage').hide();
            $('#footerinner').hide();
            
            setTimeout(function () {
                $('#main').hide();
                $('#login').show();
             }, 2500);
          
        }
        else{
            $('#main').hide();
            $('#image').show();
            $('#login').hide();

            if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
                // $("#popup").show();
                // $(".arrow").show();
                $('#IOSImage').show();

                
            }
            else{
                $('#AndriodImage').show();
            }

        }


         $('#loading').hide(); 

        $(document).ready(function () {

             

              $('#signupbtn').click(function () {

                $('#login').hide();

                $('#SignUp').show();

            });

            $('#newloginbtn').click(function () {

                $('#SignUp').hide();

                $('#login').show();

            });

            $(document).on('click', '#registerbtn', function (e) {

                e.preventDefault();
                var valid = true;
                var pwd = $("#password").val();
                var cnfpassword = $("#cnfpassword").val();
                var fname = $("#fname").val();
                var email = $("#email").val();
                var mobile = $("#mobile").val();
                var rerano = $("#rerano").val();
                var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

                $("#fname").removeClass('error');
                $("#email").removeClass('error');
                $("#mobile").removeClass('error');
                $("#rerano").removeClass('error');
                $("#pwd").removeClass('error');

                
                console.log(testEmail.test(email));

                if(fname.trim() == ''){
                    $("#fname").addClass('error');
                    valid = false;
                }

                if(email.trim() == ''){
                    $("#email").addClass('error');
                    valid = false;
                }

                if (!testEmail.test(email)){
                    $("#email").addClass('error');
                    valid = false;
                }

                if(mobile.trim() == ''){
                    $("#mobile").addClass('error');
                    valid = false;
                }

                if(mobile.length!=10){
                    $("#mobile").addClass('error');
                    valid = false;
                }

                if(rerano.trim() == ''){
                    $("#rerano").addClass('error');
                    valid = false;
                }

                if(pwd != cnfpassword){
                    alert('Password not match !!!');
                    valid = false;
                }

                if(!valid){
                    return false;
                }

                $("#register").submit();



            })



            

        });

    </script>

    <script>

        if ("serviceWorker" in navigator) {
            window.addEventListener("load", function() {
                navigator.serviceWorker
                .register("/sw.js")
                .then(res => console.log("service worker registered"))
                .catch(err => console.log("service worker not registered", err))
            })
        }
       

$(function() {

    var is_safari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
    if (is_safari)  { 
        $('#popup').animate({'bottom': '10%'}, 1000).animate({'bottom': '10%'}, 75).animate({'bottom': '10%'}, 75);
        $('.popup-close-icon').on('click', function(){
            $('#popup').animate({'bottom': '1000px'}, 500, function() {
                $(this).remove();
                $('.arrow').remove();
            });
        });
    }
  
});


    </script>



</body>



</html>