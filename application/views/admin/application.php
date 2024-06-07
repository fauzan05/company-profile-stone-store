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
						<h1>Aplikasi</h1>
						<div class="section-header-button">
							<button href="features-post-create.html" class="btn btn-primary" data-toggle="modal"
								data-target="#addApplicationModal">Tambah Aplikasi Baru</button>
						</div>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
							<div class="breadcrumb-item"><a href="#">Aplikasi</a></div>
							<div class="breadcrumb-item">Semua aplikasi</div>
						</div>
					</div>
					<div class="section-body">
						<h2 class="section-title"><i class="fas fa-solid fa-list"></i> &nbsp; Aplikasi</h2>
						<p class="section-lead">
							Anda dapat memanage semua aplikasi, seperti edit, hapus dan lainnya.
						</p>
						<?php if ($this->session->flashdata('message')) : ?>
						<div class="alert alert-<?= $this->session->flashdata('alert_color') ?>" role="alert">
							<?php echo $this->session->flashdata('message'); ?>
						</div>
						<?php endif; ?>
						<div class="row">
							<div class="col-12">
								<div class="card mb-0">
									<div class="card-body">
										<ul class="nav nav-pills">
											<li class="nav-item">
												<a class="nav-link active" href="#">Semua <span
														class="badge badge-white"><?= $total ?></span></a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="row mt-4">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h4>Semua Aplikasi</h4>
									</div>
									<div class="card-body">
										<div class="float-left">
											<select class="form-control selectric">
												<option selected disabled>Urutkan</option>
												<option>Terbaru</option>
												<option>Terlama</option>
											</select>
										</div>
										<div class="float-right">
											<form>
												<div class="input-group">
													<input type="text" class="form-control" placeholder="Cari">
													<div class="input-group-append">
														<button class="btn btn-primary"><i
																class="fas fa-search"></i></button>
													</div>
												</div>
											</form>
										</div>
										<div class="clearfix mb-3"></div>
										<div class="table-responsive">
											<table class="table table-striped">
												<tr>
													<th>No</th>
													<th>Judul</th>
													<th>Deskripsi</th>
													<th>Gambar</th>
													<th>Diubah</th>
													<th>Aksi</th>
												</tr>
												<?php
												if (!empty($applications)) :
													foreach ($applications as $key => $application) : ?>
												<tr>
													<td>
														<p><?= $key + 1 ?></p>
													</td>
													<td>
														<p><?= $application->title ?></p>
													</td>
													<td>
														<p><?= $application->description ?></p>
													</td>
													<td>
														<?php foreach ($application->images as $image) : ?>
														<img class="my-1" alt="image"
															src="<?= base_url('assets/img/apps/' . $image->filename) ?>"
															width="80" data-toggle="title" title="">
														<?php endforeach; ?>
													</td>
													<td><?= $application->updated_at ?></td>
													<?php
															$imagesJson = htmlspecialchars(json_encode($application->images), ENT_QUOTES, 'UTF-8');
															?>
													<td>
														<div class="d-flex align-items-center justify-content-between">
															<i class="m-1 fa-solid fa-trash-can text-danger cursor-pointer"
																data-id="<?= $application->id ?>" data-toggle="modal"
																data-target="#deleteAppConfirmSingle"></i>
															<i class="m-1 fa-solid fa-pen-to-square cursor-pointer"
																data-id="<?= $application->id ?>"
																data-title="<?= $application->title ?>"
																data-desc="<?= $application->description ?>"
																data-img="<?= $imagesJson ?>" data-toggle="modal"
																data-target="#editAppModal"></i>
														</div>
													</td>
												</tr>
												<?php
													endforeach;
												endif; ?>
											</table>
										</div>
										<div class="float-right">
											<nav>
												<ul class="pagination">
													<li class="page-item <?= $current_page > 1 ? '' : 'disabled' ?>">
														<a class="page-link"
															href="<?= $domain_url ?>admin/applications?page=<? $current_page - 1 ?>"
															aria-label="Previous">
															<span aria-hidden="true">&laquo;</span>
															<span class="sr-only">Previous</span>
														</a>
													</li>
													<?php
													$count_page = $total / $limit;
													$count_page = ceil($count_page);
													for ($i = 1; $i <= $count_page; $i++) :
													?>
													<li class="page-item <?= $current_page == $i ? 'active' : '' ?>">
														<a class="page-link"
															href="<?= $domain_url ?>admin/applications?page=<?= $i ?>"><?= $i ?></a>
													</li>
													<?php endfor; ?>
													<li
														class="page-item <?= $current_page >= $count_page ? 'disabled' : '' ?>">
														<a class=" page-link"
															href="<?= $domain_url ?>admin/applications?page=<?= $current_page + 1 ?>"
															aria-label="Next">
															<span aria-hidden="true">&raquo;</span>
															<span class="sr-only">Next</span>
														</a>
													</li>
												</ul>
											</nav>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<?php $this->load->view('_partials/admin/footer.php') ?>
		</div>
	</div>
	<!-- add application modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="addApplicationModal">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Aplikasi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= $domain_url ?>admin/applications" method="post" enctype="multipart/form-data">
					<div class="modal-body d-flex flex-column align-items-start justify-content-center">
						<div class="row d-flex align-items-center justify-content-around w-100 mb-3">
							<div class="form-group row mb-4 col-5">
								<div class="col-sm-12 col-md-7">
									<div class="image-preview">
										<label for="image-upload" class="cursor-pointer" id="image-label">Pilih Gambar
											&nbsp; <i class="fa-solid fa-image"></i></label>
										<input type="file" name="image-upload[]" id="image-upload"
											accept="image/png, image/jpeg, image/jpg" onchange="previewImage()" required
											multiple />
									</div>
								</div>
							</div>
							<div id="image-preview"
								class="col-5 border rounded d-flex flex-column align-items-center justify-content-center">
								<label class="col-12 col-md-3 col-lg-3 text-center p-0">Pratinjau</label>
								<p class="text-danger d-none" id="category-image-alert"></p>
							</div>
						</div>
						<div class="d-flex flex-row align-items-start justify-content-around row w-100 mt-3">
							<div class="col-5 mb-3">
								<label for="app-title" class="form-label">Judul Aplikasi</label>
								<input class="form-control" name="app_title" type="text" placeholder="Judul Aplikasi"
									aria-label="default input example" id="app-title"
									value="<?= set_value('app_title') ?>" required>
								<p class="text-danger d-none" id="app-title-alert"></p>
							</div>
							<div class="mb-3 col-7">
								<label for="app-desc" class="form-label">Deskripsi</label>
								<textarea class="form-control" name="app_desc" id="app-desc"
									value="<?= set_value('app_desc') ?>" rows="3" required></textarea>
								<p class="text-danger d-none" id="app-desc-alert"></p>
							</div>
						</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
						<button type="submit" class="btn btn-primary" id="add-button">
							Buat Aplikasi
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- edit application modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="editAppModal">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Ubah Aplikasi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" enctype="multipart/form-data">
					<div class="modal-body d-flex flex-column align-items-start justify-content-center">
						<div class="row d-flex align-items-center justify-content-around w-100 mb-3">
							<div class="form-group row mb-4 col-5">
								<div class="col-sm-12 col-md-7">
									<div class="image-preview">
										<label for="image-upload" class="cursor-pointer" id="image-label">Pilih Gambar
											&nbsp; <i class="fa-solid fa-image"></i></label>
										<input type="file" name="image-upload-edit[]" id="image-upload-edit"
											accept="image/png, image/jpeg, image/jpg" onchange="previewImageEdit()"
											multiple />
									</div>
								</div>
							</div>
							<div id="image-preview-edit"
								class="col-5 border rounded d-flex flex-column align-items-center justify-content-center">
								<label class="col-12 col-md-3 col-lg-3 text-center p-0">Pratinjau</label>
								<figure>
								</figure>
							</div>
						</div>
						<div class="d-flex flex-row align-items-start justify-content-around row w-100">
							<div class="col-5 mb-3">
								<label for="app_title_edit" class="form-label">Judul Aplikasi</label>
								<input class="form-control" name="app_title" type="text" placeholder="Judul Aplikasi"
									aria-label="default input example" id="app_title_edit"
									value="<?= set_value('app_title') ?>" required>
								<p class="text-danger d-none" id="app-title-alert"></p>
							</div>
							<div class="mb-3 col-7">
								<label for="app_desc_edit" class="form-label">Deskripsi</label>
								<textarea class="form-control" name="app_desc" id="app_desc_edit"
									value="<?= set_value('app_desc') ?>" rows="3" required></textarea>
								<p class="text-danger d-none" id="app-desc-alert"></p>
							</div>
						</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
						<button type="submit" class="btn btn-primary" id="edit-button">
							Ubah Aplikasi
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- delete application modal single -->
	<div class="modal fade" tabindex="-1" role="dialog" id="deleteAppConfirmSingle">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Konfirmasi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Apakah anda yakin ingin menghapus aplikasi ini?</p>
				</div>
				<div class="modal-footer bg-whitesmoke br">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
					<a class="btn btn-primary text-light" id="deleteButtonSingle">
						Hapus
					</a>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('_partials/admin/js_import.php') ?>

</body>

</html>
