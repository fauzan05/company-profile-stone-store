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
        
            <!-- Carousel Start -->
            <div class="header-carousel owl-carousel">
                <div class="header-carousel-item">
                    <img src="<?= base_url('assets/img/systems/batu-carausel-1.jpeg') ?>" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="carousel-caption-content p-3">
                            <!-- <h5 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Kualitas Batu Pilihan</h5> -->
                            <h1 class="display-1 text-capitalize text-white mb-4">Spesialis Suplayer Batu Alam Kebumen</h1>
                            <!-- <p class="mb-5 fs-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,  -->
                            </p>
                            <a class="btn btn-primary rounded-pill text-white py-3 px-5" href="#">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="header-carousel-item">
                    <img src="<?= base_url('assets/img/systems/batu-carausel-2.jpeg') ?>" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="carousel-caption-content p-3">
                            <!-- <h5 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Kualitas Batu Pilihan</h5> -->
                            <h1 class="display-1 text-capitalize text-white mb-4">Spesialis Suplayer Batu Alam Kebumen</h1>
                            <!-- <p class="mb-5 fs-5 animated slideInDown">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,  -->
                            </p>
                            <a class="btn btn-primary rounded-pill text-white py-3 px-5" href="#">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="header-carousel-item">
                    <img src="<?= base_url('assets/img/systems/batu-carausel-3.jpeg') ?>" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="carousel-caption-content p-3">
                            <!-- <h5 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Kualitas Batu Pilihan</h5> -->
                            <h1 class="display-1 text-capitalize text-white mb-4">Spesialis Suplayer Batu Alam Kebumen</h1>
                            <!-- <p class="mb-5 fs-5 animated slideInDown">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,  -->
                            </p>
                            <a class="btn btn-primary rounded-pill text-white py-3 px-5" href="#">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="header-carousel-item">
                    <img src="<?= base_url('assets/img/systems/batu-carausel-4.jpeg') ?>" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="carousel-caption-content p-3">
                            <!-- <h5 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Kualitas Batu Pilihan</h5> -->
                            <h1 class="display-1 text-capitalize text-white mb-4">Spesialis Suplayer Batu Alam Kebumen</h1>
                            <!-- <p class="mb-5 fs-5 animated slideInDown">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,  -->
                            </p>
                            <a class="btn btn-primary rounded-pill text-white py-3 px-5" href="#">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carousel End -->
        </div>
        <!-- Navbar & Hero End -->


        <!-- Services Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="sub-style">
                        <h4 class="sub-title px-3 mb-0">Produk Kami</h4>
                    </div>
                    <h1 class="display-3 mb-4">Kami menyajikan produk batu yang berkualitas</h1>
                    <!-- <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat deleniti amet at atque sequi quibusdam cumque itaque repudiandae temporibus, eius nam mollitia voluptas maxime veniam necessitatibus saepe in ab? Repellat!</p> -->
                </div>
                <div class="row g-4 justify-content-center">
                    <?php if(!empty($categories)):
                        foreach($categories as $category): ?>
                    <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" >
                        <div class="service-item rounded">
                           <div class="service-img rounded-top">
                                <img src="<?= base_url('assets/img/categories/' . $category->image_filename) ?>" class="img-fluid rounded-top w-100" alt="">
                           </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <div class="service-content-inner">
                                    <h5 class="mb-4"><?= $category->name ?></h5>
                                    <p class="mb-4"><?= $category->description ?></p>
                                    <a href="<?= $domain_url . 'products/' . $category->slug ?>" class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    endforeach;
                    endif;
                    ?>
                    <div class="col-12 text-center wow fadeInUp" >
                        <a class="btn btn-primary rounded-pill text-white py-3 px-5" href="/stone-store/products">Products More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Services End -->


        <!-- About Start -->
        <div class="container-fluid about bg-light py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-5 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="about-img pb-5 ps-5">
                            <img src="<?= base_url('assets/img/systems/batu-about-us.jpeg') ?>" class="img-fluid rounded w-100" style="object-fit: cover;" alt="Image">
                        </div>
                    </div>
                    <div class="col-lg-7 wow fadeInRight" data-wow-delay="0.4s">
                        <div class="section-title text-start mb-5">
                            <h4 class="sub-title pe-3 mb-0">About Us</h4>
                            <h1 class="display-3 mb-4">Kami siap menyediakan batu dengan kualitas terbaik</h1>
                            <h5>Welcome to <b><?= empty($this->Setting_model->getAllSettings()[0]->company_name) ? 'Untitled' : strtoupper($this->Setting_model->getAllSettings()[0]->company_name) ?></b> </h5>
                            <p class="mb-4">Merupakan Suplayer batu alam yang berada di Kebumen, Jawa Tengah. Batu random, batu setapak (Kebumen), batuan taman. Batuan pendukung lainnya yang kita produksi seperti batu curi dan batu kulitan.</p>
                            <div class="mb-4">
                                <p class="text-secondary"><i class="fa fa-check text-primary me-2"></i> Harga Murah</p>
                                <p class="text-secondary"><i class="fa fa-check text-primary me-2"></i> Amanah</p>
                                <p class="text-secondary"><i class="fa fa-check text-primary me-2"></i> Bisa Pesan Banyak</p>
                            </div>
                            <a href="#" class="btn btn-primary rounded-pill text-white py-3 px-5">Discover More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Book Appointment Start -->
        <div class="container-fluid appointment py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2">
                        <div class="section-title text-start">
                            <h4 class=" pe-3 mb-0">Solusi kebutuhan batu properti bagi anda</h4>
                            <h1 class="display-4 mb-4">Kualitas terbaik dan harga yang terjangkau</h1>
                            <p class="mb-4">The solution to your property stone needs is the best quality and affordable price!</p>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.4s">
                        <div class="appointment-form rounded p-5">
                            <p class="fs-4 text-uppercase text-primary">Get In Touch</p>
                            <h1 class="display-5 mb-4">Pesan Sekarang!</h1>
                            <form>
                                <div class="row gy-3 gx-4">
                                    <div class="col-xl-6">
                                        <input type="text" class="form-control py-3 border-primary bg-transparent" placeholder="Nama">
                                    </div>
                                    <div class="col-xl-6">
                                        <input type="email" class="form-control py-3 border-primary bg-transparent" placeholder="Email">
                                    </div>
                                    <div class="col-xl-6">
                                        <input type="phone" class="form-control py-3 border-primary bg-transparent" placeholder="No. HP">
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control border-primary bg-transparent" name="text" id="area-text" cols="30" rows="5" placeholder="Tulis Pesan"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary text-white w-100 py-3 px-5">Hubungi Sekarang &nbsp;<i class="fas fa-brands fa-whatsapp"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('_partials/app/footer.php') ?>
</body>

</html>