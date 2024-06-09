 <hr> 
  <!-- Footer Start -->
  <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
  	<div class="container py-5">
  		<div class="row g-5">
  			<div class="col-md-6 col-lg-6 col-xl-4">
  				<div class="footer-item d-flex flex-column">
  					<h4 class="mb-4">
  						<?php if((boolean)$settings->is_show_logo): ?>
  						<img class="w-10" src="<?= base_url('assets/img/systems/' . $settings->logo_filename) ?>"
  							alt="Logo">
  						<?php endif; ?>
  						<?= empty($settings->company_name) ? 'Untitled' :  $settings->company_name ?>
  					</h4>
  					<p>Kami menjual berbagai produk batu alam dengan kualitas terbaik namun dengan harga yang terjangkau. Jika ada pertanyaan silahkan hubungi akun kami via media sosial, email, atau whatsapp.
  					</p>
  					<div class="d-flex align-items-center">
						<?php 
							if (!empty($social_medias)) :
								foreach($social_medias as $social_media):
						?>
  						<a class="btn-square btn btn-primary text-white rounded-circle mx-1" href="<?= $social_media->link ?>"><i
  								class="fab fa-<?= $social_media->type ?>"></i></a>
						<?php
						endforeach;
						endif;
						?>
  					</div>
  				</div>
  			</div>
  			<div class="col-md-6 col-lg-6 col-xl-4">
  				<div class="footer-item d-flex flex-column">
  					<h4 class="mb-4 text-white">Quick Links</h4>
  					<a href="<?= $domain_url ?>"><i class="fas fa-angle-right me-2"></i> Home</a>
  					<a href="<?= $domain_url . 'products'?>"><i class="fas fa-angle-right me-2"></i> Product</a>
  					<!-- <a href="<?= $domain_url . 'applications'?>"><i class="fas fa-angle-right me-2"></i> Application</a> -->
  					<a href="<?= $domain_url . 'about-us'?>"><i class="fas fa-angle-right me-2"></i> About Us</a>
  				</div>
  			</div>
  			<div class="col-md-6 col-lg-6 col-xl-4">
  				<div class="footer-item d-flex flex-column">
  					<h4 class="mb-4 text-white">Contact Info</h4>
  					<a href=""><i class="fa fa-map-marker-alt me-2"></i><?= empty($settings->address) ? 'No address' :  $settings->address ?></a>
  					<a href="mailto:<?= $settings->email ?>"><i class="fas fa-envelope me-2"></i><?= empty($settings->email) ? 'No email' :  $settings->email ?></a>
  					<a href=""><i class="fas fa-phone me-2"></i><?= empty($settings->phone_number) ? 'No phone' :  $settings->phone_number ?></a>
  				</div>
  			</div>
  		</div>
  	</div>
  </div>
  <!-- Footer End -->

  <!-- Copyright Start -->
  <div class="container-fluid copyright py-4">
  	<div class="container">
  		<div class="row g-4 align-items-center">
  			<div class="col-md-6 text-center text-md-start mb-md-0">
  				<span class="text-white"><a href="#"><i class="fas fa-copyright text-light me-2"></i><?= empty($settings->company_name) ? 'Untitled' :  $settings->company_name ?>
			</a>, All right reserved.</span>
  			</div>
  			<div class="col-md-6 text-center text-md-end text-white">
  				<!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
  				<!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
  				<!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
  				Designed By <a class="border-bottom" href="https://www.instagram.com/__fauzan114/">Fzn</a>
  			</div>
  		</div>
  	</div>
  </div>
  <!-- Copyright End -->

  <!-- Back to Top -->
  <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>
  <a target="_blank"  href="https://wa.me/<?= $settings->phone_number ?>" id="whatsapp-button" class="btn btn-primary btn-lg-whatsapp whatsapp-button-rounded"><i
  		class="fa-2x fa-brands fa-whatsapp"></i></a>
		 

  <!-- JavaScript Libraries -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->
  <script src="<?= base_url('assets/app/modules/jquery.min.js') ?>"></script> 
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> -->

  <script src="<?= base_url('assets/app/modules/bootstrap5/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/app/lib/wow/wow.min.js') ?>"></script>
  <script src="<?= base_url('assets/app/lib/easing/easing.min.js') ?>"></script>
  <script src="<?= base_url('assets/app/lib/waypoints/waypoints.min.js') ?>"></script>
  <script src="<?= base_url('assets/app/lib/owlcarousel/owl.carousel.min.js') ?>"></script>


  <!-- Template Javascript -->
  <script src="<?= base_url('assets/app/js/main.js') ?>"></script>
