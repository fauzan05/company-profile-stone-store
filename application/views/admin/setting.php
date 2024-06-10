<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('_partials/admin/header.php') ?>
<script src="<?= base_url('assets/js/jquery-3.7.1.slim.min.js') ?>"></script>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('_partials/admin/navbar.php') ?>
			<?php $this->load->view('_partials/admin/sidebar.php') ?>
			<!-- Main Content -->
			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>Pengaturan Aplikasi</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
							<div class="breadcrumb-item active"><a href="#">Pengaturan</a></div>
							<div class="breadcrumb-item">Pengaturan Aplikasi</div>
						</div>
					</div>

					<div class="section-body">
						<h2 class="section-title">Semua Pengaturan Aplikasi</h2>
						<p class="section-lead">
							Anda dapat mengatur semua pengaturan disini
						</p>
						<?php if ($this->session->flashdata('message')) : ?>
						<div class="alert alert-<?= $this->session->flashdata('alert_color') ?>" role="alert">
							<?php echo $this->session->flashdata('message'); ?>
						</div>
						<?php endif; ?>
						<div id="output-status"></div>
						<div class="row">
							<div class="col-md-4">
								<div class="card">
									<div class="card-header">
										<h4>Lompat Ke</h4>
									</div>
									<div class="card-body">
										<ul class="nav nav-pills flex-column">
											<li class="nav-item"><a href="<?= $domain_url ?>admin/settings"
													class="nav-link active">Aplikasi</a></li>
											<li class="nav-item"><a href="<?= $domain_url ?>admin/settings/profile" class="nav-link">Profil</a></li>
											<li class="nav-item"><a href="<?= $domain_url ?>admin/settings/password"
													class="nav-link">Password</a></li>
											<li class="nav-item"><a href="<?= $domain_url ?>admin/settings/social-media"
													class="nav-link">Sosial Media</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-8">
								<form id="setting-form" action="<?= $domain_url ?>admin/settings" method="post"
									enctype="multipart/form-data">
									<div class="card" id="settings-card">
										<div class="card-header">
											<h4>Pengaturan Aplikasi</h4>
										</div>
										<div class="card-body">
											<p class="text-muted">Pengaturan utama seperti nama perusahaan, alamat,
												email, dan lainnya.</p>
											<div class="form-group row align-items-center">
												<label for="site-title"
													class="form-control-label col-sm-3 text-md-right">Nama
													Perusahaan</label>
												<div class="col-sm-6 col-md-9">
													<input type="text" name="company_name" class="form-control"
														id="site-title"
														value="<?= !empty($settings->company_name) ? $settings->company_name : '' ?>">
												</div>
											</div>
											<div class="form-group row align-items-center">
												<label class="form-control-label col-sm-3 text-md-right">
													Logo Perusahaan</label>
												<div class="col-sm-6 col-md-9">
													<div class="custom-file">
														<input type="file" name="site_logo" class="custom-file-input"
															id="site-logo" accept="image/png, image/jpeg, image/jpg">
														<label class="custom-file-label">Choose File</label>
													</div>
													<div class="form-text text-muted">Batas maksimum gambar adalah 1MB |
														Gambar yang diizinkan adalah jpg, jpeg, dan png.</div>
													<div class="col-sm-6 col-md-9 custom-control custom-checkbox mt-3">
														<input type="checkbox" name="show_logo"
															class="custom-control-input" tabindex="3" id="show-logo" value="<?= !empty($settings->is_show_logo) ? $settings->is_show_logo : true ?>" <?php if ((boolean)$settings->is_show_logo): ?> checked <?php endif; ?>>
														<label class="custom-control-label" for="show-logo">Tampilkan
															logo perusahaan</label>
													</div>
												</div>
											</div>
											<div class="form-group row align-items-center">
												<label for="site-address"
													class="form-control-label col-sm-3 text-md-right">Alamat</label>
												<div class="col-sm-6 col-md-9">
													<textarea class="form-control" name="address"
														id="site-address"><?= !empty($settings->address) ? $settings->address : '' ?></textarea>
												</div>
											</div>
											<div class="form-group row align-items-center">
												<label for="site-email"
													class="form-control-label col-sm-3 text-md-right">Email</label>
												<div class="col-sm-6 col-md-9">
													<input type="email" name="email" class="form-control"
														id="site-email"
														value="<?= !empty($settings->email) ? $settings->email : '' ?>">
												</div>
											</div>
											<div class="form-group row align-items-center">
												<label for="site-map"
													class="form-control-label col-sm-3 text-md-right">Google Maps Link</label>
												<div class="col-sm-6 col-md-9">
													<input type="text" name="google_map_link" class="form-control"
														id="site-map"
														value="<?= !empty($settings->google_map_link) ? $settings->google_map_link : '' ?>">
												</div>
											</div>
											<div class="form-group row align-items-center">
												<label for="site-phone"
													class="form-control-label col-sm-3 text-md-right">Nomor
													Telepon</label>
												<div class="col-sm-6 col-md-9">
													<input type="text" name="phone_number" class="form-control"
														id="site-phone"
														value="<?= !empty($settings->phone_number) ? $settings->phone_number : '' ?>">
												</div>
											</div>
										</div>
										<div class="card-footer bg-whitesmoke text-md-right ">
											<button class="btn btn-primary w-100" id="save-btn">Simpan</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</section>
			</div>
			<?php $this->load->view('_partials/admin/footer.php') ?>
			<?php $this->load->view('_partials/admin/js_import.php') ?>

		</div>
	</div>
</body>

</html>
