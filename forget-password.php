<!doctype html>
<html lang="en">
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOH Mobile App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
    <link rel="manifest" href="manifest.json">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>
  <?php

include 'constant.php';
$msg = '';
if (!empty($_POST['email'])) {

  $curl = curl_init();
  $email = $_POST['email'];

  curl_setopt_array($curl, array(
    CURLOPT_URL => APIURL.'api/forgot-password',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{"email":"'.$email.'"}',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json'
    ),
  ));

          $response = curl_exec($curl);
          curl_close($curl);
          $result = json_decode($response);

    if($result->success){
      $msg = '<div class="alert alert-success" role="alert" style="text-align:  center  ;">
                    '.$result->msg.'
                </div>';
                header( "refresh:3;url=index.php" );
    }
    else{
          $msg = '<div class="alert alert-danger" role="alert" style="text-align:  center  ;">
                    '.$result->msg.'
                </div>';
    }

}

?>


  <style type="text/css">
   
    .forgetpass {
    position: relative;
    top: 0px;
        padding: 0;
    margin: 0;
}
#login {
    background-image: url('https://webzaa.in/hohCPApp/img/mobbgnew1-900.png');
    background-repeat: no-repeat;
    width: 100%;
    height: 100vh;
    background-size: 100% 100%;
}
.form-gap {
    /* position: absolute; */
    padding-bottom: 50%;
}
   .btn-primary:hover {
    color: #fff;
    background-color: #cc3578;
    border-color: #c43173;
}
#email::placeholder {
    color: #000 !important;
}
  </style>

  <body>
    
<section id="login">
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
           
            
             <div class="form-gap"></div>

    <div class="col-md-12 col-xs-12 forgetpass">
            <div class="panel panel-default">
              <div class="panel-body">
                <?php echo $msg; ?>
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">
    
                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
    
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="email" placeholder="Enter Your Registered Email Id" class="form-control"  type="email" required style="  color:  #000 !important;">
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit" style="color: #fff;
    background-color: #cc3578;
    border-color: #c43173;">
                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </form>
    
                  </div>
                </div>
              </div>
          
  </div>
</div>

        </div>
    </div>
</div>
</section>


  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
