<!DOCTYPE html>
<html class="no-js" lang="en" dir="<?php echo text_dir(); ?>">
    <?php $settings = get_settings(); ?>
    <head>
        <meta charset="utf-8">
        <title><?php echo html_escape($settings->site_name) ?> - <?php echo html_escape($settings->site_title) ?></title>
        <meta charset="utf-8">
        <meta name="author" content="<?php echo html_escape($settings->site_name) ?>">
        <meta name="description" content="<?php echo html_escape($settings->description) ?>">
        <meta name="keywords" content="<?php echo html_escape($settings->keywords) ?>">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="theme-color" content="#056EB9" />
        <meta name="msapplication-navbutton-color" content="#056EB9" />
        <meta name="apple-mobile-web-app-status-bar-style" content="#056EB9" />

        <link rel="icon" href="<?php echo base_url($settings->favicon) ?>">
        <link rel="apple-touch-icon" href="img/apple-touch-icon.html">
        <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.html">
        <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.html">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap.min.css">
        <?php if (text_dir() == 'rtl'): ?>
            <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/custom-rtl.css">
            <link rel="stylesheet" href="<?php echo base_url()?>assets/admin/css/bootstrap-rtl.min.css" crossorigin="anonymous">
        <?php endif ?>

        <!-- styles ================================================== -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/cristal.min.css?var=1.9&time=<?=time();?>" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/style.min.css?var=1.9&time=<?=time();?>" type="text/css">

        <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/font-awesome.min.css">
        <link href="<?php echo base_url() ?>assets/admin/css/toast.css" rel="stylesheet" />
        <link href="<?php echo base_url() ?>assets/admin/css/sweet-alert.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/simple-line-icons.css">
        <link href="<?php echo base_url() ?>assets/front/css/select2.min.css" rel="stylesheet" />
        <link href="<?php echo base_url() ?>assets/front/css/aos.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Alata&display=swap', 'Quicksand:300,400,700&display=swap" rel="stylesheet">
        
        <script type="text/javascript">
           var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
           var token_name = '<?php echo $this->security->get_csrf_token_name();?>'
        </script>

        <script type="text/javascript">
            var _html = document.documentElement,
                isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));
            _html.className = _html.className.replace("no-js","js");
            _html.classList.add( isTouch ? "touch" : "no-touch");
        </script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/front/js/device.min.js"></script>

        <!-- google analytics -->
        <?php if (!empty($settings->google_analytics)): ?>
            <?php echo base64_decode($settings->google_analytics); ?>
        <?php endif ?>

        <?php if ($settings->enable_captcha == 1 && $settings->captcha_site_key != ''): ?>
            <script src='https://www.google.com/recaptcha/api.js'></script>
        <?php endif; ?>

    </head>

    <body>
        <div>
           
            <!-- start header -->
            <?php if (isset($page_title) && $page_title != 'Register'): ?>
                <header id="top-bar" class="top-bar top-bar--dark" data-nav-anchor="true">
                    <div class="top-barinner">
                        <div class="container-fluid">
                            <div class="row align-items-center no-gutters">

                                <a class="top-barlogo site-logo" href="<?php echo base_url() ?>">
                                    <img class="img-fluid" src="<?php echo base_url($settings->logo) ?>" width="159" height="45" alt="demo" />
                                </a>

                                <a id="top-bar__navigation-toggler" class="top-barnavigation-toggler" href="javascript:void(0);">
                                    <span></span>
                                </a>

                                <div class="top-barcollapse">
                                    <nav id="top-bar__navigation" class="top-barnavigation" role="navigation">
                                        <ul>
                                            <li>
                                                <a class="nav-link <?php if(isset($page_title) && $page_title == 'Home'){echo "active";} ?>" href="<?php echo base_url() ?>"><?php echo trans('home') ?></a>
                                            </li>

                                            <li>
                                                <a class="nav-link <?php if(isset($page_title) && $page_title == 'Features'){echo "active";} ?>" href="<?php echo base_url('features') ?>"><?php echo trans('features') ?></a>
                                            </li>

                                            <li>
                                                <a class="nav-link <?php if(isset($page_title) && $page_title == 'Pricing'){echo "active";} ?>" href="<?php echo base_url('pricing') ?>"><?php echo trans('pricing') ?></a>
                                            </li>
                                           
                                            <?php if ($settings->enable_blog == 1): ?>
                                            <li>
                                                <a class="nav-link <?php if(isset($page_title) && $page_title == 'Blog Posts'){echo "active";} ?>" href="<?php echo base_url('blog') ?>"><?php echo trans('blogs') ?></a>
                                            </li>
                                            <?php endif ?>

                                            <?php if ($settings->enable_faq == 1): ?>
                                            <li>
                                                <a class="nav-link <?php if(isset($page_title) && $page_title == 'Faqs'){echo "active";} ?>" href="<?php echo base_url('faqs') ?>"><?php echo trans('faqs') ?></a>
                                            </li>
                                            <?php endif ?>

                                            <li>
                                                <a class="nav-link <?php if(isset($page_title) && $page_title == 'Contact'){echo "active";} ?>" href="<?php echo base_url('contact') ?>"><?php echo trans('contact') ?> </a>
                                            </li>

                                            <?php if (!empty(get_pages())): ?>
                                                <li class="has-submenu">
                                                    <a class="nav-link" href="javascript:void(0);"><?php echo trans('pages') ?></a>

                                                    <ul class="submenu">
                                                        <?php foreach (get_pages() as $page): ?>
                                                            <li><a href="<?php echo base_url('page/'.$page->slug) ?>"><?php echo html_escape($page->title) ?></a></li>
                                                        <?php endforeach ?>
                                                    </ul>
                                                </li>
                                            <?php endif ?>

                                            <?php if (settings()->enable_multilingual == 1): ?>
                                                <li class="has-submenu">
                                                    <a class="nav-link" href="javascript:void(0);"><?php echo lang_short_form(); ?></a>
                                                    <ul class="submenu">
                                                        <?php foreach (get_language() as $lang): ?>
                                                            <li><a href="<?php echo base_url('home/switch_lang/'.$lang->slug) ?>"><?php echo html_escape($lang->name) ?></a></li>
                                                        <?php endforeach ?>
                                                    </ul>
                                                </li>
                                            <?php endif ?>

                                        </ul>
                                    </nav>

                                    <div id="top-baraction" class="top-baraction">
                                        <div class="d-xl-flex flex-xl-row flex-xl-wrap align-items-xl-center">
                                            <div class="top-barauth-btns">
                                                <?php if (is_admin()): ?>
                                                    <a class="btn btn-light-primary btn-sm" href="<?php echo base_url('auth/logout') ?>"><i class="fa fa-sign-out"></i> <?php echo trans('logout') ?></a>

                                                    <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('dashboard') ?></a>
                                                <?php elseif(is_user()): ?>
                                                    <a class="btn btn-light-primary btn-sm" href="<?php echo base_url('auth/logout') ?>"><i class="fa fa-sign-out"></i> <?php echo trans('logout') ?></a>

                                                     <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/dashboard/business') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('dashboard') ?></a>
                                                <?php else: ?>
                                                    <a class="btn btn-light-primary btn-sm" href="<?php echo base_url('login') ?>"><?php echo trans('sign-in') ?></a>
                                                    <a class="btn btn-primary btn-sm" href="<?php echo base_url('register') ?>"><?php echo trans('create-account') ?></a>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </header>
            <?php endif ?>
            <!-- end header -->
            <div class="spacer py-8"></div>
            <!-- start main -->
            <main role="main">