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
						<h1>Produk</h1>
						<div class="section-header-button">
							<button href="features-post-create.html" class="btn btn-primary" data-toggle="modal"
								data-target="#addProductModal">Tambah Produk Baru</button>
						</div>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
							<div class="breadcrumb-item"><a href="#">Produk</a></div>
							<div class="breadcrumb-item">Semua Produk</div>
						</div>
					</div>
					<div class="section-body">
						<h2 class="section-title"><i class="fas fa-gem"></i> &nbsp; Produk</h2>
						<p class="section-lead">
							Anda dapat memanage semua produk, seperti edit, hapus dan lainnya.
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
										<h4>Semua Produk</h4>
									</div>
									<div class="card-body">
										<div class="clearfix mb-3"></div>
										<div class="table-responsive mb-4">
											<table class="table table-striped">
												<tr>
													<th>No</th>
													<th>Nama Produk</th>
													<th>Kategori Produk</th>
													<th>Daftar Ukuran</th>
													<th>Deskripsi</th>
													<th>Gambar</th>
													<th>Warna</th>
													<th>Diperbarui</th>
													<th>Aksi</th>
												</tr>
												<?php
												if (!empty($products) && !empty($categories)) :
													foreach ($products as $key => $product) :
												?>
												<tr>
													<td>
														<p><?= $key + 1 ?></p>
													</td>
													<td>
														<p><?= $product->product_name ?></p>
													</td>
													<td>
														<div><?= $product->category_name ?></div>
													</td>
													<td>
														<div class="product-sizes my-1"><?= $product->sizes ?></div>
													</td>
													<td>
														<?= $product->product_desc ?>
													</td>
													<td>
														<img alt="image"
															src="<?= base_url('assets/img/products/' . $product->product_image) ?>"
															width="80" data-toggle="title" title="">
													</td>
													<td>
														<?= $product->color ?>
													</td>
													<td><?= $product->product_updated_at ?></td>
													<td class="">
														<div class="action-container">
															<i class="fa-solid fa-trash-can text-danger cursor-pointer"
																data-id="<?= $product->product_id ?>"
																data-toggle="modal"
																data-target="#deleteProductConfirmSingle"></i>
															<i class="mx-3 fa-solid fa-pen-to-square cursor-pointer"
																data-id="<?= $product->product_id ?>"
																data-name="<?= $product->product_name ?>"
																data-category-id="<?= $product->category_id ?>"
																data-desc="<?= $product->product_desc ?>"
																data-img="<?= $product->product_image ?>"
																data-color="<?= $product->color ?>"
																data-sizes="<?= $product->sizes ?>" data-toggle="modal"
																data-target="#editProductModal"></i>
														</div>
													</td>
												</tr>
												<?php
													endforeach;
												endif;
												?>
											</table>
										</div>
										<div class="float-right">
											<nav>
												<ul class="pagination">
													<li class="page-item <?= $current_page > 1 ? '' : 'disabled' ?>">
														<a class="page-link"
															href="<?= $domain_url ?>admin/products?page=<? $current_page - 1 ?>"
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
															href="<?= $domain_url ?>admin/products?page=<?= $i ?>"><?= $i ?></a>
													</li>
													<?php endfor; ?>
													<li
														class="page-item <?= $current_page >= $count_page ? 'disabled' : '' ?>">
														<a class=" page-link"
															href="<?= $domain_url ?>admin/products?page=<?= $current_page + 1 ?>"
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
	<!-- add product modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="addProductModal">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Produk</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
					<div class="alert alert-danger d-none" id="error-add" role="alert">
					</div>
					<div class="modal-body d-flex flex-column align-items-start justify-content-center">
						<div class="row d-flex align-items-center justify-content-center w-100 mb-3">
							<div
								class="form-group mb-4 col-lg-5 col-md-7 col-sm-12 d-flex flex-column align-items-center justify-content-center">
								<div class="image-preview">
									<label for="image-upload" class="cursor-pointer" id="image-label">Pilih Gambar
										&nbsp; <i class="fa-solid fa-image"></i></label>
									<input type="file" name="image-upload" id="image-upload" class="product-required"
										accept="image/png, image/jpeg, image/jpg" onchange="previewImage()" required="" />
								</div>
							</div>
							<div id="image-preview"
								class="col-lg-5 col-md-7 col-sm-12 d-flex flex-column align-items-center justify-content-center">
								<label class="col-12 col-md-3 col-lg-3 text-center p-0">Pratinjau</label>
								<p class="text-danger d-none product-required-alert">Pilih salah satu gambar</p>
							</div>
						</div>
						<div class="d-flex flex-row align-items-start justify-content-around row w-100">
							<div class="col-5 mb-3">
								<label for="product_name" class="form-label">Nama Produk</label>
								<input class="form-control product-required" name="product_name" type="text" placeholder="Nama Produk"
									aria-label="default input example" id="product_name"
									value="<?= set_value('product_name') ?>" required="">
								<p class="text-danger d-none product-required-alert">Kolom harus diisi</p>
							</div>
							<div class="col-5 mb-3">
								<label for="product_color" class="form-label">Warna Produk</label>
								<input class="form-control product-required" name="product_color" type="text" placeholder="Warna Produk"
									aria-label="default input example" id="product_color"
									value="<?= set_value('product_color') ?>" required="">
								<p class="text-danger d-none product-required-alert">Kolom harus diisi</p>
							</div>
							<div class="col-5 mb-3">
								<label for="product_category" class="form-label">Kategori Produk</label>
								<select class="form-control selectric product-required" name="category_id" id="product_category"
									required="">
									<option selected disabled value="">Pilih kategori</option>
									<?php if (!empty($categories)) : ?>
									<?php foreach ($categories as $key => $category) : ?>
									<option value="<?= $category->id ?>"><?= $category->name ?></option>
									<?php endforeach; ?>
									<?php endif; ?>
								</select>
								<p class="text-danger d-none product-required-alert">Kolom harus diisi</p>
							</div>
							<div class="mb-3 col-5">
								<label for="product_desc" class="form-label">Deskripsi</label>
								<textarea class="form-control product-required" name="product_desc" id="product_desc"
									value="<?= set_value('product_desc') ?>" rows="3" required=""></textarea>
								<p class="text-danger d-none product-required-alert">Kolom harus diisi</p>
							</div>
							<div class="col-10 mb-3">
								<label for="ckeditor" class="form-label">Daftar Ukuran</label>
								<div id="ckeditor"></div>
								<textarea type="text" id="ckeditor-input" name="sizes" hidden id="sizes"></textarea>
								<p>Ukuran bisa dikosongkan</p>
							</div>
						</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
						<button type="button" class="btn btn-primary" id="add-product-button">
							Buat Produk
						</button>
					</div>
			</div>
		</div>
	</div>
	<!-- edit product modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="editProductModal">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Ubah Produk</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" enctype="multipart/form-data">
					<div class="modal-body d-flex flex-column align-items-start justify-content-center">
						<div class="row d-flex align-items-center justify-content-center w-100 mb-3">
							<div
								class="form-group mb-4 col-lg-5 col-md-7 col-sm-12 d-flex flex-column align-items-center justify-content-center">
								<div class="image-preview">
									<label for="image-upload-edit" class="cursor-pointer" id="image-label">Pilih Gambar
										&nbsp; <i class="fa-solid fa-image"></i></label>
									<input type="file" name="image-upload-edit" id="image-upload-edit"
										accept="image/png, image/jpeg, image/jpg" onchange="previewImageEdit()" />
								</div>
							</div>
							<div id="image-preview-edit"
								class="col-lg-5 col-md-7 col-sm-12 d-flex flex-column align-items-center justify-content-center">
								<label class="col-12 col-md-3 col-lg-3 text-center p-0">Pratinjau</label>
								<div>
									<img id="img" alt="">
								</div>
							</div>
						</div>
						<div class="d-flex flex-row align-items-start justify-content-around row w-100">
							<div class="col-5 mb-3">
								<label for="product_name_edit" class="form-label">Nama Produk</label>
								<input class="form-control" name="product_name" type="text" placeholder="Nama Produk"
									aria-label="default input example" id="product_name_edit"
									value="<?= set_value('product_name') ?>" required>
								<p class="text-danger d-none" id="product-name-alert"></p>
							</div>
							<div class="col-5 mb-3">
								<label for="product_color_edit" class="form-label">Warna Produk</label>
								<input class="form-control" name="product_color" type="text" placeholder="Warna Produk"
									aria-label="default input example" id="product_color_edit"
									value="<?= set_value('product_color') ?>" required>
								<p class="text-danger d-none" id="product-color-alert"></p>
							</div>
							<div class="col-lg-5 mb-3 col-sm-10 col-md-10">
								<label for="product_category_edit" class="form-label">Kategori Produk</label>
								<select class="form-control selectric" name="category_id" id="product_category_edit"
									required>
									<option disabled>Pilih kategori</option>
									<?php if (!empty($categories)) : ?>
									<?php foreach ($categories as $key => $category) : ?>
									<option id="category-<?= $category->id ?>" value="<?= $category->id ?>">
										<?= $category->name ?></option>
									<?php endforeach; ?>
									<?php endif; ?>
								</select>
							</div>
							<div class="mb-3 col-lg-5 col-sm-10 col-md-10">
								<label for="product_desc_edit" class="form-label">Deskripsi</label>
								<textarea class="form-control" name="product_desc" id="product_desc_edit"
									value="<?= set_value('product_desc') ?>" rows="3" required></textarea>
								<p class="text-danger d-none" id="product-desc-alert"></p>
							</div>
							<div class="col-10 mb-3">
								<label for="ckeditor" class="form-label">Daftar Ukuran</label>
								<div id="ckeditor-edit"></div>
								<textarea type="text" id="ckeditor-input-edit" name="sizes" hidden></textarea>
								<p>Ukuran bisa dikosongkan</p>
							</div>
						</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
						<button type="submit" class="btn btn-primary" id="edit-button">
							Ubah Produk
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- delete product modal single -->
	<div class="modal fade" tabindex="-1" role="dialog" id="deleteProductConfirmSingle">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Konfirmasi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Apakah anda yakin ingin menghapus produk ini?</p>
				</div>
				<div class="modal-footer bg-whitesmoke br">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
					<a class="btn btn-primary text-light" id="deleteProductButtonSingle">
						Hapus
					</a>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('_partials/admin/js_import.php') ?>
	<script src="<?= base_url('assets/admin/modules/ckeditor5/build/ckeditor.js') ?>"></script>
	<script>
	// digunakan agar modal selalu aktif tanpa harus ditekan terlebih dahulu
	// window.onload = function() {
	// 	var myModal = new bootstrap.Modal(document.getElementById('addProductModal'));
	// 	myModal.show();
	// };
	$(function(){
		let domainUrl = '<?= $domain_url ?>';
		ClassicEditor
			.create(document.querySelector('#ckeditor'), {

			}).then(editor => {
				let MyEditor = editor;
				editor.model.document.on('change:data', () => {
					let body_content = editor.getData()
					$("#ckeditor-input").val(body_content)
				});
				// editor.setData(contentBody)
			}).catch(error => {
				console.error(error);
			});

		function check_required(p = '') {
			$('.' + p).each((i, obj) => {
				console.log($(obj).val())
			});
		}

		$('#add-product-button').click(function () {
			// Membuat objek FormData
			let formData = new FormData();
			
			// Menambahkan data lain ke FormData
			formData.append('product_name', $('#product_name').val());
			formData.append('category_id', $('#product_category').val());
			formData.append('sizes', $('#ckeditor-input').val());
			formData.append('product_color', $('#product_color').val());
			formData.append('product_desc', $('#product_desc').val());
			
			// Menambahkan file gambar ke FormData
			let imageFile = $('#image-upload')[0].files[0]; // Gantilah 'product_image' dengan ID input file Anda
			if (imageFile) {
				formData.append('image-upload', imageFile);
			}

			// Validasi input
			let products_inputs = $('.product-required');
			let products_inputs_alert = $('.product-required-alert');

			let isValid = true;
			products_inputs.each((i, obj) => {
				if ($(obj).val() == null || $(obj).val() === "") {
					$(products_inputs_alert[i]).removeClass("d-none");
					isValid = false;
				} else {
					$(products_inputs_alert[i]).addClass("d-none");
				}
			});

			if (isValid) {
				$.ajax({
					url: domainUrl + 'admin/products', // Update this to the correct PHP script URL
					type: 'POST',
					data: formData,
					processData: false, // Prevent jQuery from automatically transforming the data into a query string
					contentType: false, // Prevent jQuery from setting the Content-Type header
					dataType: 'json',
					success: function (response) {
						let result = Boolean(response);
						if (result) {
							$('#error-add').addClass('d-none');
							window.location.reload(true);
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						// Handle error response
						$('#error-add').removeClass('d-none');
						$('#error-add').html(errorThrown);
					}
				});
			}
});



	});	
	</script>
</body>

</html>
