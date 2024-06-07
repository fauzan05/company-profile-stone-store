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
						<h2 class="section-title">Semua Pengaturan Password</h2>
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
											<li class="nav-item"><a href="http://localhost/stone-store/settings"
													class="nav-link">Aplikasi</a></li>
											<li class="nav-item"><a href="http://localhost/stone-store/settings/profile"
													class="nav-link">Profil</a></li>
											<li class="nav-item"><a
													href="http://localhost/stone-store/settings/password"
													class="nav-link active">Password</a></li>
											<li class="nav-item"><a
													href="http://localhost/stone-store/settings/social-media"
													class="nav-link">Sosial Media</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-8">
								<form id="setting-form" action="/stone-store/settings/password" method="post">
									<div class="card" id="settings-card">
										<div class="card-header">
											<h4>Pengaturan Password Pengguna</h4>
										</div>
										<div class="card-body">
											<p class="text-muted">Pengaturan password pengguna untuk menggantinya dengan
												password baru.</p>
											<div class="form-group row align-items-center">
												<label for="old-password"
													class="form-control-label col-sm-3 text-md-right">Password
													Lama</label>
												<div class="col-sm-6 col-md-9">
													<input type="password" name="old_password" class="form-control"
														id="old-password" value="">
													<?php echo form_error('old_password', '<div class="error text-danger">', '</div>'); ?>
												</div>
											</div>
											<div class="form-group row align-items-center">
												<label for="new-password"
													class="form-control-label col-sm-3 text-md-right">Password
													Baru</label>
												<div class="col-sm-6 col-md-9">
													<input type="password" name="new_password" class="form-control"
														id="new-password" value="">
													<?php echo form_error('new_password', '<div class="error text-danger">', '</div>'); ?>
												</div>
											</div>
											<div class="form-group row align-items-center">
												<label for="new-password"
													class="form-control-label col-sm-3 text-md-right">Konfirmasi
													Password Baru</label>
												<div class="col-sm-6 col-md-9">
													<input type="password" name="new_password_confirm"
														class="form-control" id="new-password" value="">
													<?php echo form_error('new_password_confirm', '<div class="error text-danger">', '</div>'); ?>
												</div>
											</div>
										</div>
										<div class="card-footer bg-whitesmoke text-md-right ">
											<button class="btn btn-primary w-100" id="save-btn">Ubah Password</button>
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
