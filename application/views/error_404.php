<!DOCTYPE html>
<html>
<head><title> <?php echo trans('404-not-found') ?></title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/style.css"/>
  	<link rel="stylesheet" href="<?php echo base_url() ?>assets/front/font/flaticon.css">
</head>

<body>

	<div>     
		<div class="text-center">
			<img src="<?php echo base_url() ?>/assets/front/img/404.jpg">
			<h5><?php echo trans('404-msg') ?></h5><br>
			<a href="<?php echo base_url() ?>" class="btn btn-primary"> <i class="flaticon-left-arrow" aria-hidden="true"></i> <?php echo trans('back-to-home') ?> </a>
		</div>
	</div>

	<script src="<?php echo base_url() ?>assets/front/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url() ?>assets/front/js/bootstrap.min.js"></script>

</body>
</html>