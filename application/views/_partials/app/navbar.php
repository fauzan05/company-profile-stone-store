<?php 
$current_page = empty($_SERVER['PATH_INFO']) ? '/' : $_SERVER['PATH_INFO'];
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
	<a href="<?= $domain_url ?>" class="navbar-brand p-0">
		<h1 class="text-primary m-0">
        <?php if((boolean)$settings->is_show_logo): ?>
            <img src="<?= base_url('assets/img/systems/' . $settings->logo_filename) ?>" alt="Logo">
        <?php endif; ?>
        <?= empty($settings->company_name) ? 'Untitled' :  $settings->company_name ?>   
		</h1>
	</a>
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
		<span class="fa fa-bars"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarCollapse">
		<div class="navbar-nav ms-auto py-0">
			<a href="<?= $domain_url ?>" class="nav-item nav-link <?= $current_page == "/" ? 'active' : '' ?>">Home</a>
			<a href="<?= $domain_url ?>products" class="nav-item nav-link <?= $current_page == "/products" ? 'active' : '' ?>">Product</a>
			<!-- <a href="/stone-store/applications" class="nav-item nav-link <?= $current_page == "/applications" ? 'active' : '' ?>">Application</a> -->
			<a href="<?= $domain_url ?>about-us" class="nav-item nav-link <?= $current_page == "/about-us" ? 'active' : '' ?>">About Us</a>
		</div>
		<a href="#" class="btn btn-primary rounded-pill text-white py-2 px-4 flex-wrap flex-sm-shrink-0">Lihat
			Katalog</a>
	</div>
</nav>

