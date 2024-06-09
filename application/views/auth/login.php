<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('_partials/auth/header.php') ?>

<body>
	<div id="app">
		<section class="section">
			<div class="container mt-5">
				<div class="row">
					<div
						class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
						<div class="login-brand">
							<img src="<?= (boolean)$this->Setting_model->getAllSettings()[0]->is_show_logo ? base_url('assets/img/systems/' .  $this->Setting_model->getAllSettings()[0]->logo_filename) : base_url('assets/img/systems/gemstone-logo.svg') ?>" alt="logo" width="100"
								class="shadow-light rounded-circle">
						</div>

						<div class="card card-primary">
							<div class="card-header">
								<h4>Masuk Admin</h4>
							</div>
							<?php
							$message = $this->session->flashdata('message_login_error');
							if (isset($message)) {
								echo '<div class="alert alert-danger">' . $message . '</div>';
								$this->session->unset_userdata('message_login_error');
							}
							?>
							<div class="card-body">
								<form method="POST" action="#" class="needs-validation" novalidate="">
									<div class="form-group">
										<label for="email">Email</label>
										<input id="email" type="email" class="form-control" name="email" tabindex="1"
											required autofocus>
										<div class="invalid-feedback">
											Tolong isi form email
										</div>
									</div>
									<div class="form-group">
										<div class="d-block">
											<label for="password" class="control-label">Password</label>
											<!-- <div class="float-right">
												<a href="#" class="text-small">
													Lupa Kata Sandi?
												</a>
											</div> -->
										</div>
										<input id="password" type="password" class="form-control" name="password"
											tabindex="2" required>
										<div class="invalid-feedback">
											Tolong isi form kata sandi
										</div>
									</div>

									<div class="form-group">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="remember_me" class="custom-control-input"
												tabindex="3" id="remember-me">
											<label class="custom-control-label" for="remember-me">Ingat Saya</label>
										</div>
									</div>

									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
											Masuk
										</button>
									</div>
								</form>
							</div>
						</div>
						<?php $this->load->view('_partials/auth/footer.php') ?>
					</div>
				</div>
			</div>
		</section>
	</div>

	<!-- Template JS File -->
	<script src="<?= base_url('assets/js/scripts.js') ?>"></script>
	<script src="<?= base_url('assets/js/custom.js') ?>"></script>
</body>

</html>
