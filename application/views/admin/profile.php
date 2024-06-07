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
											<li class="nav-item"><a href="http://localhost/stone-store/settings"
													class="nav-link">Aplikasi</a></li>
											<li class="nav-item"><a href="http://localhost/stone-store/settings/profile"
													class="nav-link active">Profil</a></li>
											<li class="nav-item"><a
													href="http://localhost/stone-store/settings/password"
													class="nav-link">Password</a></li>
											<li class="nav-item"><a
													href="http://localhost/stone-store/settings/social-media"
													class="nav-link">Sosial Media</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-8">
								<form id="setting-form" action="/stone-store/settings/profile" method="post">
									<div class="card" id="settings-card">
										<div class="card-header">
											<h4>Pengaturan Profil Pengguna</h4>
										</div>
										<div class="card-body">
											<p class="text-muted">Pengaturan profil pengguna seperti nama, username,
												email, dan lainnya.</p>
											<div class="form-group row align-items-center">
												<label for="first-name"
													class="form-control-label col-sm-3 text-md-right">Nama
													Depan</label>
												<div class="col-sm-6 col-md-9">
													<input type="text" name="first_name" class="form-control"
														id="first-name"
														value="<?= !empty($current_user->first_name) ? $current_user->first_name : '' ?>">
												</div>
											</div>
											<div class="form-group row align-items-center">
												<label for="last-name"
													class="form-control-label col-sm-3 text-md-right">Nama
													Belakang</label>
												<div class="col-sm-6 col-md-9">
													<input type="text" name="last_name" class="form-control"
														id="last-name"
														value="<?= !empty($current_user->last_name) ? $current_user->last_name : '' ?>">
												</div>
											</div>
											<div class="form-group row align-items-center">
												<label for="username"
													class="form-control-label col-sm-3 text-md-right">Username</label>
												<div class="col-sm-6 col-md-9">
													<input type="text" name="username" class="form-control"
														id="username"
														value="<?= !empty($current_user->username) ? $current_user->username : '' ?>">
												</div>
											</div>
											<div class="form-group row align-items-center">
												<label for="site-email"
													class="form-control-label col-sm-3 text-md-right">Email</label>
												<div class="col-sm-6 col-md-9">
													<input type="email" name="email" class="form-control"
														id="site-email"
														value="<?= !empty($current_user->email) ? $current_user->email : '' ?>">
												</div>
											</div>
											<div class="form-group row align-items-center">
												<label for="site-phone"
													class="form-control-label col-sm-3 text-md-right">Nomor
													Telepon</label>
												<div class="col-sm-6 col-md-9">
													<input type="text" name="phone_number" class="form-control"
														id="site-phone"
														value="<?= !empty($current_user->phone_number) ? $current_user->phone_number : '' ?>">
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
			<?php $this->load->view('_partials/admin/js_import.php') ?>

		</div>
	</div>
</body>

</html>
