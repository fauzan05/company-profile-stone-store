<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('_partials/app/header.php') ?>
<body>
    <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->


        <!-- Topbar Start -->
        <div class="container-fluid bg-dark px-5 d-none d-lg-block">
            <div class="row gx-0 align-items-center" style="height: 45px;">
                <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                    <div class="d-flex flex-wrap">
                        <a href="#" class="text-light me-4"><i class="fas fa-map-marker-alt text-light me-2"></i>Find A Location</a>
                        <a href="#" class="text-light me-4"><i class="fas fa-phone-alt text-light me-2"></i><?= $settings->phone_number ?></a>
                        <a href="#" class="text-light me-0"><i class="fas fa-envelope text-light me-2"></i><?= $settings->email ?></a>
                    </div>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="d-flex align-items-center justify-content-end">
                        <?php if(!empty($social_medias)):
                            foreach($social_medias as $social_media):
                        ?>
                        <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-<?= $social_media->type ?>"></i></a>

                        <?php 
                        endforeach;
                        endif;
                        ?>
                        <!-- <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-0"><i class="fab fa-linkedin-in"></i></a> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
        <?php $this->load->view('_partials/app/navbar.php') ?>
        
           <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(<?= base_url('assets/img/categories/' . $image_filename) ?>) !important;">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s"><?= $unslug ?></h1>
                <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item text-light">Menampilkan</li>
                    <li class="breadcrumb-item text-light">Semua</li>
                    <li class="breadcrumb-item text-light">Produk</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->
        </div>
        <!-- Navbar & Hero End -->


        <!-- Services Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="sub-style">
                        <h4 class="sub-title px-3 mb-0">Produk <?= $unslug ?></h4>
                    </div>
                    <!-- <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat deleniti amet at atque sequi quibusdam cumque itaque repudiandae temporibus, eius nam mollitia voluptas maxime veniam necessitatibus saepe in ab? Repellat!</p> -->
                </div>
                <div class="row g-4 justify-content-center">
                    <?php if(!empty($products)):
                        foreach($products as $product): ?>
                    <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" >
                        <div class="service-item rounded">
                           <div class="service-img rounded-top">
                                <img src="<?= base_url('assets/img/products/' . $product->filename) ?>" class="img-fluid rounded-top w-100" alt="">
                           </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <div class="service-content-inner">
                                    <h5 class="mb-4"><?= $product->name ?></h5>
                                    <p class="mb-4"><?= $product->description ?></p>
                                    <p class="mb-1">Warna : <?= $product->color ?></p>
                                    <p class="mb-1">Ukuran : <?= $product->sizes ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
        <!-- Services End -->
        <?php $this->load->view('_partials/app/footer.php') ?>
</body>

</html>