  <!-- Footer Start -->
  <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
  	<div class="container py-5">
  		<div class="row g-5">
  			<div class="col-md-6 col-lg-6 col-xl-4">
  				<div class="footer-item d-flex flex-column">
  					<h4 class="text-white mb-4">
  						<?php if((boolean)$this->Setting_model->getAllSettings()[0]->is_show_logo): ?>
  						<img class="w-10" src="<?= base_url('assets/img/systems/' . $this->Setting_model->getAllSettings()[0]->logo_filename) ?>"
  							alt="Logo">
  						<?php endif; ?>
  						<?= empty($this->Setting_model->getAllSettings()[0]->company_name) ? 'Untitled' :  $this->Setting_model->getAllSettings()[0]->company_name ?>
  					</h4>
  					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus dolorem impedit eos autem
  						dolores laudantium quia, qui similique
  					</p>
  					<div class="d-flex align-items-center">
						<?php 
							if (!empty($social_medias)) :
								foreach($social_medias as $social_media):
						?>
  						<a class="btn-square btn btn-primary text-white rounded-circle mx-1" href=""><i
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
  					<a href=""><i class="fas fa-angle-right me-2"></i> Home</a>
  					<a href=""><i class="fas fa-angle-right me-2"></i> Product</a>
  					<a href=""><i class="fas fa-angle-right me-2"></i> Application</a>
  					<a href=""><i class="fas fa-angle-right me-2"></i> About Us</a>
  				</div>
  			</div>
  			<div class="col-md-6 col-lg-6 col-xl-4">
  				<div class="footer-item d-flex flex-column">
  					<h4 class="mb-4 text-white">Contact Info</h4>
  					<a href=""><i class="fa fa-map-marker-alt me-2"></i><?= empty($this->Setting_model->getAllSettings()[0]->address) ? 'No address' :  $this->Setting_model->getAllSettings()[0]->address ?></a>
  					<a href=""><i class="fas fa-envelope me-2"></i><?= empty($this->Setting_model->getAllSettings()[0]->email) ? 'No email' :  $this->Setting_model->getAllSettings()[0]->email ?></a>
  					<a href=""><i class="fas fa-phone me-2"></i><?= empty($this->Setting_model->getAllSettings()[0]->phone_number) ? 'No phone' :  $this->Setting_model->getAllSettings()[0]->phone_number ?></a>
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
  				<span class="text-white"><a href="#"><i class="fas fa-copyright text-light me-2"></i>  						<?= empty($this->Setting_model->getAllSettings()[0]->company_name) ? 'Untitled' :  $this->Setting_model->getAllSettings()[0]->company_name ?>
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
  <a href="#" class="btn btn-primary btn-lg-whatsapp whatsapp-button-rounded"><i
  		class="fa-2x fa-brands fa-whatsapp"></i></a>


  <!-- JavaScript Libraries -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/app/lib/wow/wow.min.js') ?>"></script>
  <script src="<?= base_url('assets/app/lib/easing/easing.min.js') ?>"></script>
  <script src="<?= base_url('assets/app/lib/waypoints/waypoints.min.js') ?>"></script>
  <script src="<?= base_url('assets/app/lib/owlcarousel/owl.carousel.min.js') ?>"></script>


  <!-- Template Javascript -->
  <script src="<?= base_url('assets/app/js/main.js') ?>"></script>
