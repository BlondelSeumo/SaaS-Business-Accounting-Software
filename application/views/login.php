<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url($settings->favicon) ?>">
    
    <?php $settings = get_settings(); ?>
    <title><?php echo html_escape($settings->site_name); ?> - <?php echo trans('login') ?></title>
  
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap.min.css">
    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap-extend.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/admin_style.css?var=2.0&time=<?=time();?>">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/simple-line-icons.css">
    <link href="<?php echo base_url() ?>assets/admin/css/sweet-alert.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Alata&display=swap', 'Quicksand:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style type="text/css">
      body{
        font-family: Alata, 'sans-serif';
      }
    </style>

    <script type="text/javascript">
       var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
       var token_name = '<?php echo $this->security->get_csrf_token_name();?>'
    </script>
    
</head>

<body class="hold-transition login-page">

<div class="auth-box">

  <div class="login-box">

    <div class="login-logo" data-aos="fade-up" data-aos-duration="300">
      <?php if (!empty($settings->logo)): ?>
        <a href="<?php echo base_url() ?>"><img width="50%" class="circles" src="<?php echo base_url($settings->logo) ?>"></a><br>
      <?php endif ?>
    </div>

    <div class="mb-4 mt-4">
        <div class="success text-success"></div><div class="error text-danger" style="display: none;"></div><div class="warning text-warning"></div>
    </div>
    
    <!-- /.login-logo -->
    <div id="login-area" class="login-box-body" data-aos="fade-up" data-aos-duration="400">
      <p class="login-box-msg"><?php echo trans('sign-in') ?></p>
      <form id="login-form" method="post" action="<?php echo base_url('auth/log'); ?>">

        <div class="form-group has-feedback">
          <input type="text" name="user_name" class="form-control log" placeholder="<?php echo trans('username-or-email') ?>">
          <span class="ion ion-email form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control log" placeholder="<?php echo trans('password') ?>">
          <span class="ion ion-locked form-control-feedback"></span>
          <a class="pull-right forgot_pass" href="#"><?php echo trans('forgot-password') ?></a>
        </div>

        <div class="row">
          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-info btn-block signin_btn"><?php echo trans('sign-in') ?></button> 
            <a class="create" href="<?php echo base_url('register'); ?>"><?php echo trans('create-account') ?></a>
          </div> 
        </div>
      </form>
      <!-- /.social-auth-links -->

      <div class="margin-top-30 text-center">
      </div>

    </div>
    <!-- /.login-box-body -->


    <!-- forgot area -->
    <div id="forgot-area" class="login-box-body" style="display: none;">
      <p class="login-box-msg"><?php echo trans('recover-password') ?></p>

      <form id="lost-form" method="post" action="<?php echo base_url('auth/forgot_password'); ?>">

        <div class="form-group has-feedback">
          <input type="email" name="email" class="form-control log" placeholder="<?php echo trans('enter-your-email') ?>">
          <span class="ion ion-email form-control-feedback"></span>
          <a class="pull-right back_login" href="#"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
        </div>

        <div class="row">
          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-info btn-block margin-top-10 signin_btn"><?php echo trans('submit') ?></button> 
          </div> 
        </div>
      </form>
      <!-- /.social-auth-links -->

      <div class="margin-top-30 text-center">
      </div>

    </div>
  </div>


</div>
<!-- /.login-box -->

  <?php include'include/js_msg_list.php'; get_update_logs(); ?>
  <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script> 
  <!-- popper -->
  <script src="<?php echo base_url() ?>assets/admin/js/popper.min.js"></script>
  <!-- Bootstrap 4.0-->
  <script src="<?php echo base_url() ?>assets/admin/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>assets/admin/js/admin.js"></script>
  <script src="<?php echo base_url()?>assets/admin/js/sweet-alert.min.js"></script>

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  
  <script type="text/javascript">
    $(document).ready(function(){

      var loader_btn = '<div class="spinners"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';
      
      var msg_error = $('.msg_error').val();
      var msg_sorry = $('.msg_sorry').val();
      var msg_success = $('.msg_success').val();
      var msg_signin = $('.msg_signin').val();
      var msg_signing_in = $('.msg_signing_in').val();
      var msg_try = $('.msg_try').val();

      var msg_not_active = $('.msg_not_active').val();
      var msg_account_suspend = $('.msg_account_suspend_msg').val();
      var msg_wrong_access = $('.msg_wrong_access').val();
      var msg_email_not_verified = $('.msg_email_not_verified').val();
      var msg_pass_sent_email = $('.msg_pass_sent_email').val();
      var msg_pass_reset_succ = $('.msg_pass_reset_succ').val();
      var msg_not_valid_user = $('.msg_not_valid_user').val();

      
      $(document).on('submit', "#login-form", function() {

        $(".signin_btn").html('<span class="spinner-btn-sm"></span> '+msg_signing_in);
        $(".signin_btn").prop('disabled', true);

        $.post($('#login-form').attr('action'), $('#login-form').serialize(), function(json){
            if (json.st == 1) {
                window.location = json.url;
            }else if (json.st == 0) {
                $(".signin_btn").prop('disabled', false);
                $(".signin_btn").html(msg_signin);
                $(".error").show().html('<i class="icon-exclamation"></i> '+msg_wrong_access);
                $('#login_pass').val('');
            }else if (json.st == 2) {
                $(".signin_btn").prop('disabled', false);
                $(".signin_btn").html(msg_signin);
                $(".error").show().html('<i class="icon-exclamation"></i> '+msg_not_active);
            }else if (json.st == 3) {
                $(".signin_btn").prop('disabled', false);
                $(".signin_btn").html(msg_signin);
                $(".error").show().html('<i class="icon-exclamation"></i> '+msg_account_suspend);
            }else if (json.st == 4) {
                $(".signin_btn").prop('disabled', false);
                $(".signin_btn").html(msg_signin);
                $(".error").show().html('<i class="icon-exclamation"></i> '+msg_email_not_verified);
            }

        },'json');
        return false;
      });

      //recover password form
      $(document).on('submit', "#lost-form", function() {
          $.post($('#lost-form').attr('action'), $('#lost-form').serialize(), function(json){
              
              if ( json.st == 1 ){
                  swal({
                    title: msg_pass_reset_succ,
                    text: msg_pass_sent_email,
                    type: "success",
                    showConfirmButton: true
                  }, function(){
                    window.location = json.url;
                  });
              } else {
                swal({
                  title: msg_sorry,
                  text: msg_not_valid_user,
                  type: "error",
                  confirmButtonText: msg_try
                });
              }
          },'json');
          return false;
      });


      $(document).on('click', ".forgot_pass", function() {
          $('#login-area').slideUp();
          $('#forgot-area').slideDown();
      });

      $(document).on('click', ".back_login", function() {
          $('#login-area').slideDown();
          $('#forgot-area').slideUp();
      });


    });
  </script>
</body>
</html>
