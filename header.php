<html lang="en">
<?php

session_start();
include 'constant.php';
include_once 'functions.php';


//echo'<pre>';print_r($_COOKIE);exit;
if(isset($_COOKIE['token']) && $_COOKIE['token'] != ''){
    

    $url = APIURL.'api/loginCheck';
    $data = '{"token":"'.$_COOKIE['token'].'","email":"'.$_COOKIE['username'].'"}';
    $result = APICALL($url,$data);

    //echo'<pre>';print_r($_COOKIE);exit;
    if($result->success == 'true')
    {      
        setcookie('status', $result->ChannelPartner[0]->is_active, time() + (86400 * 30), "/");
    }
    else{
        header('Location: index.php');
        $msg = 'Your logged out of device.';
    }

}else{
  header('Location: index.php');
  $msg = 'Your logged out of device.';
}


?>

<head>
    

 <!-- PushAlert -->
<script type="text/javascript">
        (function(d, t) {
                var g = d.createElement(t),
                s = d.getElementsByTagName(t)[0];
                g.src = "https://cdn.pushalert.co/integrate_f319f995b27857e21fe589fa5b48bd5e.js";
                s.parentNode.insertBefore(g, s);
        }(document, "script"));
</script>

  <script>
    (pushalertbyiw = window.pushalertbyiw || []).push(['onSuccess', callbackOnSuccess]);

    function callbackOnSuccess(result) {
      console.log(result.subscriber_id); //will output the user's subscriberId
      console.log(result.alreadySubscribed); // False means user just Subscribed


      var fd = new FormData();

      fd.append('token', '<?php echo $_COOKIE['token'] ?>');
      fd.append('email', '<?php echo $_COOKIE['username'] ?>');
      fd.append('sub_id', result.subscriber_id);


      $.ajax({

        url: '<?php echo APIURL; ?>api/UpdateDeviceID',
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (data) {
          console.log(data);

        }

      });
    }
  </script>

  <script>
    (pushalertbyiw = window.pushalertbyiw || []).push(['onFailure', callbackOnFailure]);

    function callbackOnFailure(result) {
      console.log(result.status); //-1 - blocked, 0 - canceled or 1 - unsubscribed
      PushAlertCo.triggerMe(true);
      //YOUR CODE
    }
  </script>
  <!-- End PushAlert -->

  <script type="text/javascript">


    var href = document.location.href;
    var lastPathSegment = href.substr(href.lastIndexOf('/') + 1);

    (function (f, b) {
      if (!b.__SV) {
        var e, g, i, h; window.mixpanel = b; b._i = []; b.init = function (e, f, c) {
          function g(a, d) { var b = d.split("."); 2 == b.length && (a = a[b[0]], d = b[1]); a[d] = function () { a.push([d].concat(Array.prototype.slice.call(arguments, 0))) } } var a = b; "undefined" !== typeof c ? a = b[c] = [] : c = "mixpanel"; a.people = a.people || []; a.toString = function (a) { var d = "mixpanel"; "mixpanel" !== c && (d += "." + c); a || (d += " (stub)"); return d }; a.people.toString = function () { return a.toString(1) + ".people (stub)" }; i = "disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking start_batch_senders people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
          for (h = 0; h < i.length; h++)g(a, i[h]); var j = "set set_once union unset remove delete".split(" "); a.get_group = function () { function b(c) { d[c] = function () { call2_args = arguments; call2 = [c].concat(Array.prototype.slice.call(call2_args, 0)); a.push([e, call2]) } } for (var d = {}, e = ["get_group"].concat(Array.prototype.slice.call(arguments, 0)), c = 0; c < j.length; c++)b(j[c]); return d }; b._i.push([e, f, c])
        }; b.__SV = 1.2; e = f.createElement("script"); e.type = "text/javascript"; e.async = !0; e.src = "undefined" !== typeof MIXPANEL_CUSTOM_LIB_URL ?
          MIXPANEL_CUSTOM_LIB_URL : "file:" === f.location.protocol && "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//) ? "https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js" : "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js"; g = f.getElementsByTagName("script")[0]; g.parentNode.insertBefore(e, g)
      }
    })(document, window.mixpanel || []);


    mixpanel.init("8450cbc21317d354e68ceab40f0cbaf5", { debug: true });
   

    //mixpanel.identify("13793");

    mixpanel.people.set({ "name": "<?php echo $_COOKIE['name']; ?>",
                "email": "<?php echo $_COOKIE['username']; ?>" });
    mixpanel.identify("<?php echo $_COOKIE['username']; ?>");
    mixpanel.track(lastPathSegment.replace(".php", ""));
  </script>


  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-XRYLGYTFWG"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'G-XRYLGYTFWG');
  </script>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

  <title>HOH Mobile App</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="./css/stylenewest.css">

  <link rel="stylesheet" href="./css/responsive.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

  <link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">


  <link rel="preconnect" href="https://fonts.googleapis.com">

  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">

  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script>
    $(document).on('click', '.dropup', function () {
      $('.dropdown-menu').show();
    })
    $(document).on('click', '.open', function () {
      $('.dropdown-menu').hide();
    })
  </script>

  <!-- Hotjar Tracking Code for https://cpapp.houseofhiranandani.com/ -->
  <script>
      (function (h, o, t, j, a, r) {
        h.hj = h.hj || function () { (h.hj.q = h.hj.q || []).push(arguments) };
        h._hjSettings = { hjid: 3319567, hjsv: 6 };
        a = o.getElementsByTagName('head')[0];
        r = o.createElement('script'); r.async = 1;
        r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
        a.appendChild(r);
      })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
  </script>

  <script type="text/javascript">
    window._mfq = window._mfq || [];
    (function () {
      var mf = document.createElement("script");
      mf.type = "text/javascript"; mf.defer = true;
      mf.src = "//cdn.mouseflow.com/projects/50d2a29a-9cd1-4542-95a9-fcbc687c27c6.js";
      document.getElementsByTagName("head")[0].appendChild(mf);
    })();
  </script>

  <script type="text/javascript">
    (function (c, l, a, r, i, t, y) {
      c[a] = c[a] || function () { (c[a].q = c[a].q || []).push(arguments) };
      t = l.createElement(r); t.async = 1; t.src = "https://www.clarity.ms/tag/" + i;
      y = l.getElementsByTagName(r)[0]; y.parentNode.insertBefore(t, y);
    })(window, document, "clarity", "script", "fd2le02ady");
  </script>
</head>

<style type="text/css">

body{
    font-family: "Roboto", sans-serif !important;
}

  li.list-item {
    list-style-type: none;
  }

  a.dropdown-toggle {
    text-decoration: none;
    color: #fff;
  }

  i.fa.fa-phone.fa-2x {
    font-size: 15px;
    color: #771744;
  }

  span.contact-text.phone {
    padding: 0px 10px;
    color: #771744;
  }

  span.contact-text.phone a {
    text-decoration: none;
    color: #000;
    font-size: 10px;
    font-family: 'Montserrat' !important;
  }

  li.side-item {
    text-align: justify;
    list-style: none;
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
    z-index: 9999;
  }

  @keyframes loader4 {
    from {
      transform: rotate(0deg);
    }

    to {
      transform: rotate(360deg);
    }
  }

  @-webkit-keyframes loader4 {
    from {
      -webkit-transform: rotate(0deg);
    }

    to {
      -webkit-transform: rotate(360deg);
    }
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

  .horizontal-nav #nav-toggle-btn {
    position: absolute;
    width: 3.5em;
    top: 0;
    bottom: 30px;
    /*font-size: 12px;*/
    font-family: 'Montserrat' !important;
    color: #fff;
    text-decoration: none;
    right: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .horizontal-nav #nav-toggle-btn:hover {
    background-color: #7b1846;
  }

  i.fas.fa-angle-up {
    font-size: 13px;
    border: 1px solid #fff;
    padding: 2px;
  }

  h6.menutext {
    position: absolute;
    bottom: 5px;
    font-size: 11px;
    text-align: center;
    right: 23px;
    font-family: "Roboto";
    font-weight: 600;
  }

  /* sidenav */
  #sidenav {
    /* size factor, 2 for double of sidebar */
    /* side nav width */
    /* increase/decrease to size the close btn */
    font-size: 0.9em;
    z-index: 100;
    position: fixed;
    right: 0;
    top: 0;
    color: #fff;
    height: 100%;
    width: 15em;
    background-color: #7b1846;
    overflow-x: hidden;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    transform: translateX(15em);
    transition: transform 0.5s;
    /* dropdown style */
  }

  .newfont {
    margin: 0px 25px;
  }

  #sidenav a {
    color: #fff;
    text-decoration: none;
    font-size: 16px;
  }

  #sidenav a:hover {
    color: white;
    text-decoration: none;
  }

  #sidenav .closebtn {
    flex: 0 0 1.2em;
    font-size: 2.2em;
    width: 1.5em;
    height: 1.2em;
    display: flex;
    justify-content: center;
    align-items: center;
    -webkit-tap-highlight-color: transparent;
    /* to remove the blinking of tap on mobile */
  }

  #sidenav .side-nav-items {
    overflow-y: auto;
    width: 100%;
    font-size: 1.3em;
    padding: 1em 0.5em 1em 1em;
  }

  #sidenav .side-nav-items .side-item {
    margin-top: 1.3em;
    padding-bottom: 20px;
    border-bottom: 1px solid #fff;
    /* border-top: 1px solid #fff;
   /*border-top: 1px solid #fff;*/
  }

  #sidenav .side-nav-items .side-item:first-child {
    margin-top: 0;
  }

  #sidenav.show {
    transform: translateX(0);
  }

  #sidenav .dropdown {
    color: #fff;
  }

  #sidenav .dropdown>a::after {
    content: "^";
    display: inline-block;
    font-size: 0.7em;
    transform: translate(0.5em, -0.25em) rotateZ(180deg);
  }

  #sidenav .dropdown .dropdown-items {
    padding: 0.3em 0 0.3em 0.5em;
    max-height: 0;
    overflow-x: hidden;
    overflow-y: scroll;
    transition: all 0.7s;
  }

  #sidenav .dropdown .dropdown-items .dropdown-item {
    padding-top: 0.3em;
  }

  #sidenav .dropdown .dropdown-items .dropdown-item::before {
    content: " ";
  }

  #sidenav .dropdown:hover {
    /* remove if want to work the dropdown on click*/
  }

  #sidenav .dropdown:hover .dropdown-items {
    max-height: 6em;
  }

  /* changing scrollbar on desktop */
  @media only screen and (min-width: 30rem) {
    #sidenav .side-nav-items::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px black;
      border-radius: 10px;
      background-color: #7b1846;
    }

    #sidenav .side-nav-items::-webkit-scrollbar {
      width: 0.4em;
      background-color: #7b1846;
    }

    #sidenav .side-nav-items::-webkit-scrollbar-thumb {
      border-radius: 10px;
      -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
      background-color: #555;
    }

    .dropdown-items::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px black;
      border-radius: 10px;
      background-color: #7b1846;
    }

    .dropdown-items::-webkit-scrollbar {
      width: 0.4em;
      background-color: #757575;
    }

    .dropdown-items::-webkit-scrollbar-thumb {
      border-radius: 10px;
      -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
      background-color: #7b1846;
    }
  }
</style>

<div id="loading">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 text-center">
        <div class="loader4"><img src="img/loader.gif"></div>
      </div>
    </div>
  </div>
</div>


<section id="footerpage20 sticky-bottom">

  <div class="container">

    <div class="row footer2-main">

      <div class="col-lg-2 col-md-2 col-sm-2 col-2 headermain">

        <div class="pagetwohome">
          <a class="homescreen" id="homescreen" href="homescreen.php">
            <img src="img/menu/white/Home.png" id="homescreen_white">
            <img src="img/menu/red/Home.png" id="homescreen_red" style="display:none;">

            <p>Home</p>
          </a>

        </div>

      </div>

      <div class="col-lg-2 col-md-2 col-sm-2 col-2 headermain">

        <div class="pagetwohome">
          <?php 
                        if($_COOKIE['status'] == '1'){ 
                            echo  '<a class="homescreen" id="collaterals" href="collaterals.php">';                            
                            }
                            else{
                                echo  '<a class="homescreen" data-bs-toggle="modal" data-bs-target="#InactiveModal">';
                            }


                        ?>
          <img src="img/menu/white/Marketing-kit.png" id="collaterals_white">
          <img src="img/menu/red/Marketing-kit.png" id="collaterals_red" style="display:none;">

          <p>Marketing Kit</p>
          </a>

        </div>

      </div>

      <div class="col-lg-2 col-md-2 col-sm-2 col-2 headermain">

        <div class="pagetwohome">
          <a class="homescreen" id="projectalloted" href="projectalloted.php">
            <img src="img/menu/white/Projects.png" id="projectalloted_white">
            <img src="img/menu/red/Projects.png" id="projectalloted_red" style="display:none;">

            <p>Projects</p>
          </a>
        </div>

      </div>

      <div class="col-lg-2 col-md-2 col-sm-2 col-2 headermain">

        <div class="pagetwohome">
          <?php 
                        if($_COOKIE['status'] == '1'){ 
                            echo  '<a class="homescreen" id="generateleads" href="generateleads.php">';                            
                            }
                            else{
                                echo  '<a class="homescreen" data-bs-toggle="modal" data-bs-target="#InactiveModal">';
                            }


                        ?>

          <img src="img/menu/white/Add-leads.png" id="generateleads_white">
          <img src="img/menu/red/Add-leads.png" id="generateleads_red" style="display:none;">

          <p>Leads</p>
          </a>

        </div>

      </div>

      <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-3">

                    <div class="pagetwohome">
                         <a class="homescreen" id="units_available" href="units_available.php">
                            <img src="img/menu/white/Inventory-check.png" id="units_available_white">
                            <img src="img/menu/red/Inventory-check.png" id="units_available_red" style="display:none;">

                            <p>Inventory Check</p>
                        </a>

                    </div>

                </div> -->

      <div class="col-lg-2 col-md-2 col-sm-2 col-2 headermain">


        <nav class="horizontal-nav">
          <a href="#" id="nav-toggle-btn">
            <i class="fas fa-angle-up"></i>
          </a>
          <h6 class="menutext">More</h6>
        </nav>

        <div id="sidenav">
          <a href="javascript:void(0)" class="closebtn">&times;</a>
          <ul class="side-nav-items">
            <li class="side-item"><a href="profile.php"><i class="fa-regular fa-user "></i>&nbsp;&nbsp;Update
                Profile</a></li>
            <li class="side-item"><a href="logout.php" id="logout"><i
                  class="fa-solid fa-power-off newfont"></i>Logout</a></li>
            <!--<li class="side-item"><a href="#">Contact</a></li>-->

          </ul>
        </div>


      </div>

    </div>


  </div>

  </div>

</section>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Contact Us</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <ul class="contact-list">
          <li class="list-item"><i class="fa fa-phone fa-2x"><span class="contact-text phone"><a
                  href="tel: 9619429509" title="Give me a call"> 9619429509 </a></span></i>
          </li>
          <!-- <li class="list-item"><i class="fa fa-phone fa-2x"><span class="contact-text phone"><a
                  href="tel:1-212-555-5555" title="Give me a call">Banglore Contact Number (212) 555-2368</a></span></i>
          </li>
          <li class="list-item"><i class="fa fa-phone fa-2x"><span class="contact-text phone"><a
                  href="tel:1-212-555-5555" title="Give me a call">Delhi Contact Number (212) 555-2368</a></span></i>
          </li> -->
        </ul>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  $(document).on('click', '#logout', function () {
    $("#loading").show();
  })
  function removeScrollBarPushing() {
    const offsetY = document.documentElement.scrollTop;
    let i = 0;
    const time = setInterval(function () {
      if (i++ < 2) {
        clearInterval(time);
      }
      document.documentElement.scrollTop = offsetY;
    }, 1);
  }

  // open sidenav
  document.getElementById('nav-toggle-btn').addEventListener('click', function () {
    document.getElementById('sidenav').classList.add('show');
    removeScrollBarPushing();
  });
  // close sidenav
  document.querySelector('#sidenav .closebtn').addEventListener('click', function () {
    document.getElementById('sidenav').classList.remove('show');
  });


</script>