<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('_partials/header.php') ?>

<div class="container-fluid d-flex align-items-center justify-content-center g-0 m-0" style="height: 100dvh;">
	<div class="col-6 border image-section-login">
		<h1 class="p-5">Anda login sebagai admin</h1>
		<img class="w-100" src="<?= base_url('assets/img/stone.jpg') ?>" alt="">
	</div>
	<form id="loginForm" class="col-6 d-flex flex-column align-items-center justify-content-center">
		<h2 class="primary-underline mb-5">Login Admin</h2>
		<!-- <div class="alert alert-danger fw-normal" role="alert">
                A simple success alert—check it out!
              </div> -->
		<div class="mb-3 mt-3 w-75">
			<input type="email" name="email" class="form-control mb-2" id="email" placeholder="Email">
			<span class="text-danger fw-light">Email tidak boleh kosong</span>
		</div>
		<div class="input-group mb-2 w-75">
			<input type="password" name="password" class="form-control password-input" id="newPassword"
				placeholder="Kata Sandi Baru">
			<button class="btn btn-outline-secondary show-password-button" type="button"
				id="showPasswordButton"></button>
		</div>
		<span class="text-danger fw-light">Password tidak boleh kosong</span>
		<button class="btn btn-danger w-75 my-4" type="submit">Masuk</button>
		<p class="fw-normal mt-2">Lupa Password? <a href="" class="text-danger">Reset Password</a></p>
	</form>
</div>
<?php $this->load->view('_partials/footer.php') ?>
<script src="<?=  base_url('assets/js/jquery-3.7.1.slim.min.js') ?>"></script>
<script>
	$(document).ready(function () {
		$("#loginForm").submit(function (event) {
			event.preventDefault();
			fetch('http://localhost/stone-store/login', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json'
					},
					body: formData
				}).then(response => response.json())
                .then(data => {
                    console.log(data.meta)
                }).catch(error => {
                    console.error('Error: ', error)
                })
		})
		let loginForm = $("#loginForm").get(0)
		let formData = new FormData(loginForm)

	})

</script>
</body>

</html>
