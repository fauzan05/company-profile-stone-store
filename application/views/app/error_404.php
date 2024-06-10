<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('_partials/app/header.php') ?>

<body>
	<!-- Spinner Start -->
	<!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
	<!-- Spinner End -->


	<!-- Topbar Start -->
	<div class="container-fluid bg-dark px-5 d-none d-lg-block">
		<div class="row gx-0 align-items-center" style="height: 45px;">
			<div class="col-lg-8 text-center text-lg-start mb-lg-0">
				<div class="d-flex flex-wrap">
				<a href="<?= $settings->google_map_link ?>" class="text-light me-4"><i class="fas fa-map-marker-alt text-light me-2"></i>Google Maps</a>
					<a href="#" class="text-light me-4"><i
							class="fas fa-phone-alt text-light me-2"></i><?= $settings->phone_number ?></a>
					<a href="#" class="text-light me-0"><i
							class="fas fa-envelope text-light me-2"></i><?= $settings->email ?></a>
				</div>
			</div>
			<div class="col-lg-4 text-center text-lg-end">
				<div class="d-flex align-items-center justify-content-end">
					<?php if(!empty($social_medias)):
                            foreach($social_medias as $social_media):
                        ?>
					<a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i
							class="fab fa-<?= $social_media->type ?>"></i></a>

					<?php 
                        endforeach;
                        endif;
                        ?>
					<!-- <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-0"><i class="fab fa-linkedin-in"></i></a> -->
				</div>
			</div>
		</div>
	</div>
	<!-- Topbar End -->

	<!-- Navbar & Hero Start -->
	<div class="container-fluid position-relative p-0">
		<?php $this->load->view('_partials/app/navbar.php') ?>

		<!-- Header Start -->
		<div class="container-fluid bg-breadcrumb"
			style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(<?= base_url('assets/img/systems/batu-carausel-1.jpeg') ?>) !important;">
			<div class="container text-center py-5" style="max-width: 900px;">
				<h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">404 Not Found</h1>
			</div>
		</div>
		<!-- Header End -->
	</div>
	<!-- Navbar & Hero End -->
	
	  <!-- 404 Start -->
	  <div class="container-fluid py-5">
            <div class="container py-5 text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                        <i class="bi bi-exclamation-triangle display-1 text-secondary"></i>
                        <h1 class="display-1">404</h1>
                        <h1 class="mb-4">Page Not Found</h1>
                        <p class="mb-4">We’re sorry, the page you have looked for does not exist in our website! Maybe go to our home page or try to use a search?</p>
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="<?= $domain_url ?>">Go Back To Home</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- 404 End -->

	

	<?php $this->load->view('_partials/app/footer.php') ?>
</body>

</html>
