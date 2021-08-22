<!DOCTYPE html>
<?php $settings = get_settings(); ?>

<html lang="en" dir="<?php echo($settings->dir); ?>">
<head>
  
  <?php $user = get_logged_user($this->session->userdata('id')); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="<?php echo base_url($settings->favicon) ?>">

  <title><?php echo html_escape($settings->site_name); ?> &bull; <?php if(isset($this->business->name)){echo html_escape($this->business->name).' &bull;';} ?> <?php if(isset($page_title)){echo html_escape($page_title);}else{echo "Dashboard";} ?></title>
  
  <!-- Bootstrap 4.0-->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap.min.css">
  <!-- Bootstrap 4.0-->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap-extend.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/font-awesome.min.css">
  <link href="<?php echo base_url() ?>assets/admin/css/toast.css" rel="stylesheet" />
  <link href="<?php echo base_url() ?>assets/admin/css/bootstrap-tagsinput.css" rel="stylesheet" />
  <link href="<?php echo base_url() ?>assets/admin/css/sweet-alert.css" rel="stylesheet" />
  <link href="<?php echo base_url() ?>assets/admin/css/animate.min.css" rel="stylesheet" />
  <!-- DataTables -->
  <link href="<?php echo base_url() ?>assets/admin/js/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/admin_style.css?var=<?php echo settings()->version ?>&time=<?=time();?>">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/skins/theme_<?php echo settings()->theme ?>.css">   

  <?php if (text_dir() == 'rtl'): ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/custom-rtl.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/admin/css/bootstrap-rtl.min.css" crossorigin="anonymous">
  <?php endif ?>
  
  
  <link href="<?php echo base_url() ?>assets/admin/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/admin/css/icons.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/simple-line-icons.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/font/flaticon.css">
  <link href="<?php echo base_url() ?>assets/admin/css/bootstrap-switch.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/admin/css/select2.min.css" rel="stylesheet" />
  <link href="<?php echo base_url() ?>assets/admin/css/themify.min.css" rel="stylesheet" />
  <link href="<?php echo base_url() ?>assets/admin/css/bootstrap4-toggle.min.css" rel="stylesheet" />
  <link href="<?php echo base_url() ?>assets/admin/css/summernote.css" rel="stylesheet" />


  <style type="text/css">
    .radio input[type="radio"],
    .radio-inline input[type="radio"],
    .checkbox input[type="checkbox"],
    .checkbox-inline input[type="checkbox"] {
      margin-right: -20px !important;
    }

    <?php if (auth('role') == 'viewer'): ?>
      a.on-default {
          display: none;
      }
      .add_btn{
        display: none;
      }
      .btn {
          display: none;
      }
      .hide_viewer{
        display: none;
      }
    <?php endif ?>
  </style>
  
  <!-- Color picker plugins css -->
  <link href="<?php echo base_url() ?>assets/admin/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">

  <script type="text/javascript">
   var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
   var token_name = '<?php echo $this->security->get_csrf_token_name();?>'
 </script>


</head>

<body class="hold-transition skin-blue-light sidebar-mini">

  <!-- Preloader -->
    <div class="preloader">
      <div class="container text-center"><div class="spinner-llg"></div></div>
    </div>
  <!-- Preloader -->

  <!-- Site wrapper -->
  <div class="wrapper">

    <?php if (isset($page_title) && $page_title != 'Online Payment'): ?>
    <header class="main-header">
      <?php if (is_admin()): ?>
        <a target="_blank" href="<?php echo base_url() ?>" class="switch_businesss logo text-center">
          <span class="logo-lg">
            <img width="130px" src="<?php echo base_url($settings->logo) ?>" alt="<?php echo html_escape($settings->site_name); ?>"> 
          </span>
        </a>
      <?php else: ?>
        
        <a href="#" class="switch_business logo text-centers">
          <span class="logo-lg">
            <img width="40px" src="<?php echo base_url($settings->favicon) ?>" alt="<?php echo html_escape($settings->site_name); ?>"> 
            <span><?php echo html_escape($this->business->name); ?> </span>
          </span> 
          <span class="buss-arrow pull-right"><i class="icon-arrow-right"></i></span>
        </a>

        <div class="business_switch_panel animate-ltr" style="display: none;">
          <div class="buss_switch_panel_header">
            <img width="30px" src="<?php echo base_url($settings->favicon) ?>" alt="<?php echo html_escape($settings->site_name); ?>"> 
            <span class="acc">Your <?php echo html_escape($settings->site_name); ?> <?php echo trans('accounts') ?></span>
            <span class="business_close pull-<?php echo($settings->dir == 'rtl') ? 'left' : 'right'; ?>">×</span>
          </div>

          <div class="buss_switch_panel_body">
            <ul class="switcher_business_menu pb-20">
                <?php foreach (get_my_business() as $mybuss): ?>
                  <li class="business_menu_item <?php if($this->business->uid == $mybuss->uid){echo "default";} ?>">
                    <a class="business_menu_item_link" href="<?php echo base_url('admin/profile/switch_business/'.$mybuss->uid) ?>">
                      <span class="business-menu_item_label">
                        <?php echo $mybuss->name ?>
                        <?php if ($this->business->uid == $mybuss->uid): ?>
                          <span class="is_default pull-right"><i class="flaticon-checked text-success"></i></span>
                        <?php endif ?>
                      </span>
                    </a>
                  </li>
                <?php endforeach ?>
            </ul>

            <div class="seperater"></div>

            <?php if (auth('role') == 'user' || auth('role') == 'subadmin'): ?>
              <a class="new_business_link" href="<?php echo base_url('admin/business') ?>"><i class="icon-briefcase"></i> <span><?php echo trans('manage-business') ?></span></a>

              <a class="new_business_link" href="<?php echo base_url('admin/role_management') ?>"><i class="icon-people"></i> <span><?php echo trans('manage-users') ?></span></a>

              <a class="new_business_link" href="<?php echo base_url('admin/business/invoice_customize') ?>"><i class="fa fa-paint-brush"></i> <span><?php echo trans('invoice-customization') ?></span></a>
            <?php endif; ?>

            <a class="new_business_link" href="<?php echo base_url('admin/profile') ?>"><i class="flaticon-user-1"></i> <span><?php echo trans('manage-profile') ?></span></a>

            <a class="new_business_link" href="<?php echo base_url('auth/logout') ?>"><i class="icon-logout"></i> <span><?php echo trans('sign-out') ?></span></a>
          </div>

          <div class="buss_switch_panel_footer">
            
          </div>
        </div>
      <?php endif; ?>

      <nav class="navbar navbar-static-top hidden-md">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span> 
        </a>
      </nav>

    </header>
    <?php endif; ?>


