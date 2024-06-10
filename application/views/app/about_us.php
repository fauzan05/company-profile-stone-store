<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('_partials/app/header.php') ?>

<body>
	<!-- Spinner Start -->
	<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
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
				<h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">About Us</h1>
			</div>
		</div>
		<!-- Header End -->
	</div>
	<!-- Navbar & Hero End -->


	<!-- About Start -->
	<div class="container-fluid about bg-light py-5">
		<div class="container py-5">
			<div class="row g-5 align-items-center">
				<div class="col-lg-5 wow fadeInLeft" data-wow-delay="0.2s">
					<div class="about-img pb-5 ps-5">
						<img src="<?= base_url('assets/img/systems/batu-about-us.jpeg') ?>"
							class="img-fluid rounded w-100" style="object-fit: cover;" alt="Image">
					</div>
				</div>
				<div class="col-lg-7 wow fadeInRight" data-wow-delay="0.4s">
					<div class="section-title text-start mb-5">
						<h4 class="sub-title pe-3 mb-0">About Us</h4>
						<h1 class="display-3 mb-4">Kami siap menyediakan batu dengan kualitas terbaik</h1>
						<h5>Welcome to
							<b><?= empty($this->Setting_model->getAllSettings()[0]->company_name) ? 'Untitled' : strtoupper($this->Setting_model->getAllSettings()[0]->company_name) ?></b>
						</h5>
						<p class="mb-4">Merupakan Suplayer batu alam yang berada di Kebumen, Jawa Tengah. Batu random,
							batu setapak (Kebumen), batuan taman. Batuan pendukung lainnya yang kita produksi seperti
							batu curi dan batu kulitan.</p>
						<div class="mb-4">
							<p class="text-secondary"><i class="fa fa-check text-primary me-2"></i> Harga Murah</p>
							<p class="text-secondary"><i class="fa fa-check text-primary me-2"></i> Amanah</p>
							<p class="text-secondary"><i class="fa fa-check text-primary me-2"></i> Bisa Pesan Banyak
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- About End -->
                        <hr>
	<!-- Visi & Misi Start -->
	<div class="container-fluid about bg-light py-5 border">
		<div class="container py-2 ">
			<div class="row g-5 align-items-center d-flex justify-content-center">
                <div class="col-lg-5 wow fadeInDown">
                    <h2 class="text-center">Vision</h2>
                    <div class="border rounded">
                       <ul class="p-5">
                        <li>
                        To becoma a trustworthy natural stone supplier by prioritizing customer happiness
                        </li>
                       </ul>
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInDown">
                    <h2 class="text-center">Mission</h2>
                    <div class="border rounded">
                        <ul class="p-5">
                            <li>
                            Provide satisfaction to consumers by providing good service and quality stone
                            </li>
                        </ul>
                    </div>
                </div>
			</div>
		</div>
	</div>
	<!-- Visi & Misi End -->

	<?php $this->load->view('_partials/app/footer.php') ?>
</body>

</html>
