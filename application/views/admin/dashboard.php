<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('_partials/admin/header.php') ?>
<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
	<?php $this->load->view('_partials/admin/navbar.php') ?>
	<?php $this->load->view('_partials/admin/sidebar.php') ?>
	
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Produk</h4>
                  </div>
                  <div class="card-body">
                    <?= $total_product ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Kategori</h4>
                  </div>
                  <div class="card-body">
                    <?= $total_category ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Aplikasi</h4>
                  </div>
                  <div class="card-body">
                    <?= $total_app ?>
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

  <!-- General JS Scripts -->
  <script src="<?= base_url('assets/modules/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/modules/popper.js') ?>"></script>
  <script src="<?= base_url('assets/modules/tooltip.js') ?>"></script>
  <script src="<?= base_url('assets/modules/bootstrap/js/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('assets/modules/nicescroll/jquery.nicescroll.min.js') ?>"></script>
  <script src="<?= base_url('assets/modules/moment.min.js') ?>"></script>
  <script src="<?= base_url('"assets/js/stisla.js') ?>"></script>

  <!-- JS Libraies -->
  <script src="<?= base_url('assets/modules/simple-weather/jquery.simpleWeather.min.js') ?>"></script>
  <script src="<?= base_url('assets/modules/chart.min.js') ?>"></script>
  <script src="<?= base_url('assets/modules/jqvmap/dist/jquery.vmap.min.js') ?>"></script>
  <script src="<?= base_url('assets/modules/jqvmap/dist/maps/jquery.vmap.world.js') ?>"></script>
  <script src="<?= base_url('assets/modules/summernote/summernote-bs4.js') ?>"></script>
  <script src="<?= base_url('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') ?>"></script>

  <!-- Page Specific JS File -->
  <script src="<?= base_url('assets/js/page/index-0.js') ?>"></script>

  <!-- Template JS File -->
  <script src="<?= base_url('assets/js/scripts.js') ?>"></script>
  <script src="<?= base_url('assets/js/custom.js') ?>"></script>
</body>

</html>
