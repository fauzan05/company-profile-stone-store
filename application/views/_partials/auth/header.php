<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <?php if((boolean)$settings->is_show_logo): ?>
	<link rel="icon" type="svg/x-icon"
		href="<?= base_url('assets/img/systems/' .  $settings->logo_filename) ?>">
	<?php endif; ?>
  <title>Login Admin</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/modules/bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/admin/modules/fontawesome/css/all.min.css') ?>">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/modules/jquery-selectric/selectric.css') ?>">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/admin/css/style.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/admin/css/components.css') ?>">
</head>