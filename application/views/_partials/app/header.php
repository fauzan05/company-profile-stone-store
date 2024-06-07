<head>
	<meta charset="utf-8">
    <?php if((boolean)$this->Setting_model->getAllSettings()[0]->is_show_logo): ?>
	<link rel="icon" type="svg/x-icon"
		href="<?= base_url('assets/img/systems/' .  $this->Setting_model->getAllSettings()[0]->logo_filename) ?>">
	<?php endif; ?>
	<title><?= isset($meta['title']) ? $meta['title'] : 'Untitled'?></title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="" name="keywords">
	<meta content="" name="description">

	<!-- Google Web Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Playfair+Display:wght@400;500;600&display=swap"
		rel="stylesheet">

	<!-- Icon Font Stylesheet -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
		integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

	<!-- Libraries Stylesheet -->
	<link href="<?= base_url('assets/app/lib/animate/animate.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/app/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">


	<!-- Customized Bootstrap Stylesheet -->
	<link href="<?= base_url('assets/app/css/bootstrap.min.css') ?>" rel="stylesheet">

	<!-- Template Stylesheet -->
	<link href="<?= base_url('assets/app/css/style.css') ?>" rel="stylesheet">
</head>
