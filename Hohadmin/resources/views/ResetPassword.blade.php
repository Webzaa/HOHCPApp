<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reset Password</title>
	<meta name="description" content="Reset Password Email Template.">
</head>
    <style>
    
    
        @import 'https://static.stayjapan.com/assets/dashboard/application-33c1a06b7784b53cd746d479718b6295c0fcefebb696e78dcee7c68efc92fada.css';


.horizontal-container {
  margin: 0 auto;
  width: 100%;
}
label {
    color: #fff;
}
p {
    color: #fff;
}
  @media(min-width: 768px) {
    width: 500px;
  }
  
 
  /* Create circle */
  @mixin drawCircle {
    background-color: white;
    border-radius: 50%; 
    border: 2px solid #ccc;
    color: #ccc;
    display: block;
    height: 20px;
    line-height: 18px;
    margin: 0 auto;
    text-align: center;
    width: 20px;
  }

  /* Create line */
  @mixin drawLine {
    background-color: #e5e5e5;
    content: '';
    height: 3px;
    left: -50%;
    transform: translateX(50%);
    position: absolute;
    top: 9px;
    width: 100%;
    z-index: -1;
  }

    /* Custom progress bar */
  .progress-bar-container {
    position: relative;

    .custom-progress-bar {
      counter-reset: step; /* Initial step: 0 */
      padding-left: 0;
    }

    .custom-progress-bar li {
      float: left;
      font-size: 12px;
      list-style: none;
      position: relative;
      text-align: center;
      text-transform: uppercase;
      width: 50%;

      
    }

    .custom-progress-line {
      height: 3px;
      position: absolute;
      content: '';
      top: 9px;
      left: 0;
      width: auto;
      background-color: red;
    }
  }
 
  //
  // Horizontal form
  //
  .horizontal-form-box {
    background-color: #fff;
    border: 1px solid #e5e5e5;
    height: 466px;
    padding: 30px;
    
    .horizontal-info-container {   
      img {
        height: 75px;
        margin-bottom: 20px; 
      }

      .horizontal-heading {
        color: #000;
        font-size: 22px; 
        font-weight: bold; 
        text-transform: capitalize;
      }

      .horizontal-subtitle {
        letter-spacing: 1px;
        margin-bottom: 20px;
        text-align: left;
      }
    }
  
    .horizontal-form {
      label,
      button {
        text-transform: capitalize;
      }

      label {
        color: #000;
        font-weight: normal;
      }
    }
  }
}
    </style>
    
    <body style="background-color: #811f49;">
    	
	

<section id="resetpassword">
<div class="container" style="margin-top: 40px;">
  <div class="row">
    <div class="col-lg-6 col-xs-12 col-lg-offset-3">
      <div class="horizontal-container">
        <div class="progress-bar-container">
          <div class="custom-progress-line" style="width: 25%;"></div>
          <ul class="custom-progress-bar clearfix">
            <!--<li class="active">Reset password</li>-->
            <li class="finish-line"></li>
          </ul>
        </div>
        <div class="horizontal-form-box">
          <div class="horizontal-info-container text-center">
            <img src="https://houseofhiranandaniegattur.com/img/hohlogo.png" />
            <p class="horizontal-heading">Reset your password</p>
            <p class="horizontal-subtitle">Your password needs to be at least 8 characters.</p>
            @if($errors->any())
        	<ul>
        		@foreach($errors->all() as $error)
        			<li style="color:red;">{{$error}}</li>
        		@endforeach
        	</ul>
        	@endif
          </div>
          <form class="horizontal-form" method="POST">
              @csrf
            <div class="o3-form-group">
              <label for="new_password">New password</label>
              <input type="password" name="password" class="o3-form-control o3-input-lg" id="new_password">
              <input type="hidden" name="id" value="{{ $user[0]['id'] }}" />
            </div>
            <div class="o3-form-group">
              <label for="confirm_password">Confirm new password</label>
              <input type="password" name="confirmPassword" class="o3-form-control o3-input-lg" id="confirm_password">
            </div>
            <button type="submit" class="o3-btn o3-btn-primary o3-btn-block">Set new password</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
</body>
</html>