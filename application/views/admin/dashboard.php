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

  <?php $this->load->view('_partials/admin/js_import.php') ?>

</body>

</html>
