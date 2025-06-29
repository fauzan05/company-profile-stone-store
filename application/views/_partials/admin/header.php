<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<?php if((boolean)$this->Setting_model->getAllSettings()[0]->is_show_logo): ?>
	<link rel="icon" type="svg/x-icon"
		href="<?= base_url('assets/img/systems/' .  $this->Setting_model->getAllSettings()[0]->logo_filename) ?>">
	<?php endif; ?>
	<title><?= isset($meta['title']) ? $meta['title'] : 'Stone Store'?></title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="<?= base_url('assets/admin/modules/bootstrap/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/admin/modules/fontawesome/css/all.min.css') ?>">

	<!-- CSS Libraries -->
	<link rel="stylesheet" href="<?= base_url('assets/admin/modules/jqvmap/dist/jqvmap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/admin/modules/weather-icon/css/weather-icons.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/admin/modules/weather-icon/css/weather-icons-wind.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/admin/modules/summernote/summernote-bs4.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/admin/modules/jquery-selectric/selectric.css') ?>">

	<!-- Template CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/admin/css/style.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/admin/css/custom.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/admin/css/components.css') ?>">
</head>
