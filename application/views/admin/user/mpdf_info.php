<!DOCTYPE html>
<html lang="en">
<head>

<link rel="icon" href="<?php echo base_url($settings->favicon) ?>">
<title><?php echo html_escape($settings->site_name); ?> - <?php if(isset($page_title)){echo html_escape($page_title);}else{echo "Dashboard";} ?></title>
<!-- Bootstrap 4.0-->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap.min.css">
<!-- Bootstrap 4.0-->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap-extend.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/master_style.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/skins/_all-skins.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/font-awesome.min.css">
</head>

<body>

    <div class="content-wrappers">
        <section class="content p-0">
            <div class="containers">
                <div class="col-md-8 m-auto">
                    <div class="row mb-10">
                        <div class="col-md-12 text-center">
                            <div class="alert alert-warning mt-300">
                                <div class="col-md-12 text-center">
                                    <h2 class="text-error mb-0 text-info"><i class="fa fa-info-circle"></i> Attention</h2>
                                    <p class="mt-2">You haven't setup <b>MPDF</b> library in your project, please follow the below direction.</p>
                                    <p>
                                        <b>Download mpdf.zip file here: <a href="http://accufy.originlabsoft.com/files/downloads/mpdf.zip" class="label label-info"><i class="fa fa-cloud-download"></i> Download Library</a> and upload this zip file in your <strong>project root folder > application > “third_party” </strong> inside this folder and extract it.</b>
                                    </p><br>
                                </div>
                            </div>
                            <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-default m-auto"> <i class="flaticon-left-arrow" aria-hidden="true"></i><i class="fa fa-long-arrow-left"></i> <?php echo trans('back') ?> </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <footer></footer>
<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/admin/js/jquery3.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap.min.js"></script>
</body>
</html>