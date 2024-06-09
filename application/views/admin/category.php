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
						<h1>Kategori</h1>
						<div class="section-header-button">
							<button href="features-post-create.html" class="btn btn-primary" data-toggle="modal"
								data-target="#addCategoryModal">Tambah Kategori Baru</button>
						</div>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
							<div class="breadcrumb-item"><a href="#">Kategori</a></div>
							<div class="breadcrumb-item">Semua kategori</div>
						</div>
					</div>
					<div class="section-body">
						<h2 class="section-title"><i class="fas fa-solid fa-list"></i> &nbsp; Kategori</h2>
						<p class="section-lead">
							Anda dapat memanage semua kategori, seperti edit, hapus dan lainnya.
						</p>
						<?php if ($this->session->flashdata('message')): ?>
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
										<h4>Semua Kategori</h4>
									</div>
									<div class="card-body">
										<div class="clearfix mb-3"></div>
										<div class="table-responsive">
											<table class="table table-striped">
												<tr>
													<th>No</th>
													<th>Nama</th>
													<th>Deskripsi</th>
													<th>Gambar</th>
													<th>Dibuat</th>
													<th>Aksi</th>
												</tr>
												<?php foreach($categories as $key => $category): ?>
												<tr>
													<td>
													<p><?= $key + 1 ?></p>
													</td>
													<td>
														<p><?= $category->name ?></p>
													</td>
													<td>
														<p><?= $category->description ?></p>
													</td>
													<td>
															<img alt="image"
																src="<?= base_url('assets/img/categories/' . $category->image_filename) ?>"
																width="80" data-toggle="title" title="">
													</td>
													<td><?= $category->created_at ?></td>
													<td>
														<div class="action-container">
														<i class="fa-solid fa-trash-can text-danger cursor-pointer" data-id="<?= $category->id ?>" data-toggle="modal"
														data-target="#deleteConfirmSingle"></i>
														<i class="fa-solid fa-pen-to-square cursor-pointer mx-3"
															data-id="<?= $category->id ?>"
															data-name="<?= $category->name ?>"
															data-desc="<?= $category->description ?>"
															data-img="<?= $category->image_filename ?>"
															data-toggle="modal" data-target="#editCategoryModal"></i>
														</div>
													</td>
												</tr>
												<?php endforeach; ?>
											</table>
											<span>**Menghapus kategori berarti akan menghapus semua produk yang berkaitan dengan kategori tersebut</span>
										</div>
										<div class="float-right">
											<nav>
												<ul class="pagination">
													<li class="page-item <?= $current_page > 1 ? '' : 'disabled' ?>">
														<a class="page-link"
															href="<?= $domain_url ?>admin/categories?page=<? $current_page - 1 ?>"
															aria-label="Previous">
															<span aria-hidden="true">&laquo;</span>
															<span class="sr-only">Previous</span>
														</a>
													</li>
													<?php
														$count_page = $total / $limit;
														$count_page = ceil($count_page);
														for($i=1; $i <= $count_page; $i++):
													?>
													<li class="page-item <?= $current_page == $i ? 'active' : '' ?>">
														<a class="page-link"
															href="<?= $domain_url ?>admin/categories?page=<?= $i ?>"><?= $i ?></a>
													</li>
													<?php endfor;?>
													<li class="page-item <?= $current_page >= $count_page ? 'disabled' : '' ?>">
														<a class=" page-link" href="<?= $domain_url ?>admin/categories?page=<?= $current_page+1 ?>" aria-label="Next">
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
	<!-- add category modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="addCategoryModal">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Kategori</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= $domain_url ?>admin/categories" method="post" enctype="multipart/form-data">
					<?php if ($this->session->flashdata('add_category_error')): ?>
					<div class="alert alert-danger">
						<?php echo $this->session->flashdata('add_category_error'); ?>
					</div>
					<?php endif; ?>
					<div class="modal-body d-flex flex-column align-items-start justify-content-center">
						<div class="row d-flex align-items-center justify-content-around w-100 mb-3">
							<div class="form-group row mb-4 col-5">
								<div class="col-sm-12 col-md-7">
									<div class="image-preview">
										<label for="image-upload" class="cursor-pointer" id="image-label">Pilih Gambar
											&nbsp; <i class="fa-solid fa-image"></i></label>
										<input type="file" name="image-upload" id="image-upload"
											accept="image/png, image/jpeg, image/jpg" onchange="previewImage()"
											required />
									</div>
								</div>
							</div>
							<div id="image-preview"
								class="col-5 border rounded d-flex flex-column align-items-center justify-content-center">
								<label class="col-12 col-md-3 col-lg-3 text-center p-0">Pratinjau</label>
								<p class="text-danger d-none" id="category-image-alert"></p>
							</div>
						</div>
						<div class="d-flex flex-row align-items-start justify-content-around row w-100">
							<div class="col-5 mb-3">
								<label for="category_name" class="form-label">Nama Kategori</label>
								<input class="form-control" name="category_name" type="text" placeholder="Nama Kategori"
									aria-label="default input example" id="category_name"
									value="<?= set_value('category_name') ?>" required>
									<p class="text-danger d-none" id="category-name-alert"></p>
							</div>
							<div class="mb-3 col-7">
								<label for="category_description" class="form-label">Deskripsi</label>
								<textarea class="form-control" name="category_description" id="category_description"
									value="<?= set_value('category_description') ?>" rows="3" required></textarea>
									<p class="text-danger d-none" id="category-description-alert"></p>
							</div>
						</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
						<button type="submit" class="btn btn-primary" id="add-button">
							Buat Kategori
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- edit category modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="editCategoryModal">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Ubah Kategori</h5>
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
										<input type="file" name="image-upload-edit" id="image-upload-edit"
											accept="image/png, image/jpeg, image/jpg" onchange="previewImageEdit()" />
									</div>
								</div>
							</div>
							<div id="image-preview-edit"
								class="col-5 border rounded d-flex flex-column align-items-center justify-content-center">
								<label class="col-12 col-md-3 col-lg-3 text-center p-0">Pratinjau</label>
								<figure>
									<img id="img" alt="">
								</figure>
							</div>
						</div>
						<div class="d-flex flex-row align-items-start justify-content-around row w-100">
							<div class="col-5 mb-3">
								<label for="category_name" class="form-label">Nama Kategori</label>
								<input class="form-control" name="category_name" type="text" placeholder="Nama Kategori"
									aria-label="default input example" id="category_name_edit"
									value="<?= set_value('category_name') ?>" required>
								<p class="text-danger d-none" id="category-name-alert"></p>
							</div>
							<div class="mb-3 col-7">
								<label for="category_description" class="form-label">Deskripsi</label>
								<textarea class="form-control" name="category_description" id="category_description_edit"
									value="<?= set_value('category_description') ?>" rows="3" required></textarea>
								<p class="text-danger d-none" id="category-description-alert"></p>
							</div>
						</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
						<button type="submit" class="btn btn-primary" id="edit-button">
							Ubah Kategori
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- delete category modal single -->
	<div class="modal fade" tabindex="-1" role="dialog" id="deleteConfirmSingle">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Konfirmasi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Apakah anda yakin ingin menghapus kategori ini?</p>
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
	<!-- delete category modal selected -->
	<div class="modal fade" tabindex="-1" role="dialog" id="deleteConfirmSelected">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Konfirmasi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Apakah anda yakin ingin menghapus kategori yang dipilih?</p>
				</div>
				<div class="modal-footer bg-whitesmoke br">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
					<a class="btn btn-primary text-light" id="deleteButtonSelected">
						Hapus
					</a>
				</div>
			</div>
		</div>
	</div>

	<?php $this->load->view('_partials/admin/js_import.php') ?>

</body>

</html>
