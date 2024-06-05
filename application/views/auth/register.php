<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('_partials/header.php') ?>
<div class="container-fluid d-flex align-items-center justify-content-center g-0 m-0" style="height: 100dvh;">
	<div class="col-lg-6 border image-section-login">
		<h1 class="p-5">Registrasi Admin</h1>
		<img class="w-100" src="<?= base_url('assets/img/stone.jpg') ?>" alt="">
	</div>
	<form action="" method="post" class="col-lg-6 d-flex flex-column align-items-center justify-content-center">
		<h2 class="red-underline mb-5">Registrasi</h2>
		<div class="alert alert-danger fw-normal <?= $error ? "" : "d-none" ?>" role="alert">
			<?= $error ?>
		</div>
		<div class="mb-3 col-10 mt-3 d-flex align-items-center justify-content-center w-100">
			<div class="d-flex flex-column align-items-start justify-content-center mx-4">
				<input type="text" name="first_name" class="form-control" placeholder="Nama Depan">
				<span class="text-danger fw-light"><?= form_error('first_name') ?></span>
			</div>
			<div class="d-flex flex-column align-items-start justify-content-center mx-4">
				<input type="text" name="last_name" class="form-control" placeholder="Nama Belakang">
				<span class="text-danger fw-light"><?= form_error('last_name') ?></span>
			</div>
		</div>
		<div class="mb-3 col-10 mt-3 d-flex align-items-center justify-content-center w-100">
			<div class="d-flex flex-column align-items-start justify-content-center mx-4">
				<input type="email" name="email" class="form-control" placeholder="Email">
				<span class="text-danger fw-light"><?= form_error('email') ?></span>
			</div>
			<div class="d-flex flex-column align-items-start justify-content-center mx-4">
				<input type="text" name="phone_number" class="form-control" placeholder="No. HP">
				<span class="text-danger fw-light"><?= form_error('phone_number') ?></span>
			</div>
		</div>
		<div class="mb-3 col-10 mt-3 d-flex align-items-center justify-content-center w-100">
			<div class="d-flex flex-column align-items-start justify-content-center mx-4">
				<input type="password" name="password" class="form-control password" placeholder="Password">
				<span class="text-danger fw-light"><?= form_error('password') ?></span>
			</div>
			<div class="d-flex flex-column align-items-start justify-content-center mx-4">
				<input type="password" name="password_confirmation" class="form-control password"
					placeholder="Konfirmasi Password">
				<span class="text-danger fw-light"><?= form_error('password_confirmation') ?></span>
			</div>
		</div>
		<div class="mb-3 col-10 mt-3 d-flex align-items-center justify-content-center w-100">
			<div class="d-flex flex-column align-items-start justify-content-center mx-4">
				<input type="text" name="username" class="form-control" placeholder="Username">
				<span class="text-danger fw-light"><?= form_error('username') ?></span>
			</div>
		</div>
		<button class="btn btn-danger col-8 mt-3" type="submit">Registrasi</button>
		<p class="fw-normal mt-5">Sudah punya akun? <a href="" class="text-danger">Masuk</a></p>
	</form>
</div>
<?php $this->load->view('_partials/footer.php') ?>
</body>

</html>
