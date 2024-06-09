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
						<h2 class="section-title">Semua Pengaturan Sosial Media</h2>
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
													class="nav-link">Password</a></li>
											<li class="nav-item"><a
													href="http://localhost/stone-store/settings/social-media"
													class="nav-link active">Sosial Media</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-8">
								<form id="setting-form" action="/stone-store/admin/settings/social-media" method="post">
									<div class="card" id="settings-card">
										<div class="card-header">
											<h4>Pengaturan Sosial Media</h4>
										</div>
										<div class="card-body">
											<p class="text-muted">Pengaturan sosial media untuk pemasaran dan branding.
											</p>
											<div class="form-group row align-items-center">
												<label for="link" class="form-control-label col-sm-3 text-md-right">Link
													Akun</label>
												<div class="col-sm-6 col-md-9">
													<input type="text" name="link" class="form-control" id="link"
														value="" required>
													<?php echo form_error('link', '<div class="error text-danger">', '</div>'); ?>
												</div>
											</div>
											<div class="form-group row align-items-center">
												<label for="old-password"
													class="form-control-label col-sm-3 text-md-right">Tipe Akun</label>
												<div class="float-left col-sm-6 col-md-9">
													<select class="form-control selectric" name="type" required>
														<option selected disabled>Pilih</option>
														<option value="instagram">Instagram</option>
														<option value="facebook">Facebook</option>
														<option value="x-twitter">Twitter</option>
														<option value="tiktok">TikTok</option>
														<option value="linkedin">LinkedIn</option>
													</select>
												</div>
												<?php echo form_error('type', '<div class="error text-danger">', '</div>'); ?>
											</div>
										</div>
										<div class="card-footer bg-whitesmoke text-md-right ">
											<button class="btn btn-primary w-100" id="save-btn">Tambah Sosial
												Media</button>
										</div>
									</div>
								</form>
								<div class="col-12 col-md-12 col-lg-12">
									<div class="card">
										<div class="card-header">
											<h4>Daftar Sosial Media</h4>
										</div>
										<div class="card-body p-0">
											<div class="table-responsive">
												<table class="table table-striped table-md">
													<tr>
														<th>No</th>
														<th>Tipe</th>
														<th>Link</th>
														<th>Aksi</th>
													</tr>
													<?php foreach($social_medias as $key => $social_media): ?>
													<tr>
														<td><?= $key + 1 ?></td>
														<td><?= $social_media->type ?></td>
														<td><a href="<?= $social_media->link ?>"
																class="btn btn-secondary">Link</a></td>
														<td>
															<div class="action-container">
															<i class="fa-solid fa-trash-can text-danger cursor-pointer"
																data-id="<?= $social_media->id ?>" data-toggle="modal"
																data-target="#deleteSocialMediaConfirmSingle"></i>
															<i class="mx-3 fa-solid fa-pen-to-square cursor-pointer"
																data-id="<?= $social_media->id ?>"
																data-type="<?= $social_media->type ?>"
																data-link="<?= $social_media->link ?>"
																data-target="#editSocialMediaModal"
																data-toggle="modal"></i>
															</div>
															
														</td>
													</tr>
													<?php endforeach; ?>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<?php $this->load->view('_partials/admin/footer.php') ?>
			<!-- edit social media -->
			<div class="modal fade" tabindex="-1" role="dialog" id="editSocialMediaModal">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Ubah Sosial Media</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="" method="post">
							<div class="card" id="settings-card">
								<div class="card-body col-10 mt-3">
									<div class="form-group row align-items-center">
										<label for="link" class="form-control-label col-sm-3 text-md-right">Link
											Akun</label>
										<div class="col-sm-6 col-md-9">
											<input type="text" name="link" class="form-control" id="link" value=""
												required>
										</div>
									</div>
									<div class="form-group row align-items-center">
										<label for="old-password" class="form-control-label col-sm-3 text-md-right">Tipe
											Akun</label>
										<div class="float-left col-sm-6 col-md-9">
											<select class="form-control selectric" name="type" required>
												<option selected disabled>Pilih</option>
												<option value="instagram">Instagram</option>
												<option value="facebook">Facebook</option>
												<option value="x-twitter">Twitter</option>
												<option value="tiktok">TikTok</option>
												<option value="linkedin">LinkedIn</option>
											</select>
										</div>
									</div>
								</div>
								<div class="card-footer bg-whitesmoke text-md-right ">
									<button class="btn btn-primary w-100" id="save-btn">Edit Sosial
										Media</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- delete social media modal single -->
			<div class="modal fade" tabindex="-1" role="dialog" id="deleteSocialMediaConfirmSingle">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Konfirmasi</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>Apakah anda yakin ingin menghapus sosial media ini?</p>
						</div>
						<div class="modal-footer bg-whitesmoke br">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
							<a class="btn btn-primary text-light" id="deleteSocialMediaButtonSingle">
								Hapus
							</a>
						</div>
					</div>
				</div>
			</div>
			<?php $this->load->view('_partials/admin/js_import.php') ?>

		</div>
	</div>
</body>

</html>
