
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Sign In | Project Monitoring Dashboard</title>
  <!-- Favicon-->
  <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts 
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">-->
    <link rel="stylesheet" href="https://opms.estpl.net:8445/assets/css/fontawesome-all.min.css"/>

    <!-- Bootstrap Core Css -->

    <link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet"/>

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url();?>assets/plugins/node-waves/waves.css" rel="shortcut icon" />

    <!-- Animation Css -->
    <link href="<?php echo base_url();?>assets/plugins/animate-css/animate.css" rel="stylesheet" />



    <!-- Custom Css -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet"/>
    <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet"/>
    <style type="text/css">
      html, body {
    width: 100%;
    height: 100%;
}
body.login-body {
    background-image: url(https://www.ocac.in/admin/uploads/logo_banner/banner_1775169422.jpg);
    background-repeat: no-repeat;
    background-size: cover;
}
.login-body:before {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: #0000007d;
}
.login-body .log-box {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}
.login-body .login-box2 {
    overflow: hidden;
    max-width: 500px;
    width: 100%;
    background: #fff;
    clear: both;
    border-radius: 10px;
    -webkit-box-shadow: 0px 8px 14px 0px rgb(0 0 0 / 30%);
    box-shadow: 0px 8px 14px 0px rgb(0 0 0 / 30%);
    margin: auto;
    padding: 10px;
    z-index: 9;
}
.bg-ocac {
    background: #006CB7;
    color: #fff;
}
    </style>
  </head>

  <body class="login-body">
    <div class="log-box">
     <div class="login-box2">
      <div class="logo">
       <a href=""><img class="img-responsive" style="margin:auto;" src="<?php echo base_url();?>assets/images/ocac_logo.png"/>

       </br>
     </a>
   </div>
   <form action="Home/user_login_process" name="Home" method="post" accept-charset="utf-8">
    <div class="msg">
      
      <div class="error" style="color:#FF0000;margin-top:0px">
        <?php echo $this->session->flashdata('message'); ?>
        </div>
      Sign in to start your session
    </div>
    <div class="input-group">
      <span class="input-group-addon">
        <i class="fas fa-user"></i>
      </span>
      <div class="form-line">
        <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
      </div>
    </div>
    <div class="input-group">
      <span class="input-group-addon">
        <i class="fas fa-lock"></i>
      </span>
      <div class="form-line"> 
        <input type="password" class="form-control" name="password" placeholder="Password" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 pull-right">
        <button class="btn btn-block bg-ocac waves-effect" type="submit">SIGN IN</button>
      </div>
    </div>
  </form>

</div>
</div>
<!-- Jquery Core Js -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/node-waves/waves.js"></script>

<!-- Validation Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/jquery.validate.js"></script>

<!-- Custom Js -->
<script src="<?php echo base_url();?>assets/js/admin.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/examples/sign-in.js"></script>

</body>

</html>
