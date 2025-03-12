<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xxl-3 col-lg-4 col-md-5">
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-5 text-center">
                                <a href="<?= base_url() ?>" class="d-block auth-logo">
                                    <img src="<?= $this->base->get_slogo() ?>" height="50">
                                </a>
                            </div>
                            <div class="auth-content mt-2">
                                <div class="text-center">
                                    <h5 class="mb-0">Forgot Password</h5>
                                    <p class="text-muted mt-2">Enter your email address and we'll send you password reset instructions.</p>
                                </div>

                                <?= form_open('admin/forget', ['class' => 'mt-4 pt-2']) ?>
                                    <div class="mb-3">
                                        <label class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter email">
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" class="btn btn-primary w-100 waves-effect waves-light" name="forget" value="Send Reset Link">
                                    </div>
                                </form>

                                <div class="mt-5 text-center">
                                    <p class="text-muted mb-0">
                                        Remember it? <a href="<?= base_url();?>admin/login" class="text-primary fw-semibold">Back to login</a>
                                    </p>
                                </div>
                            </div>
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> <?= $this->base->text('made', 'paragraph') ?> <?= $this->base->get_hostname() ?></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Background Column with Slider -->
            <div class="col-xxl-9 col-lg-8 col-md-7">
               <div class="auth-bg pt-md-5 p-4 d-flex">
    <div class="bg-overlay bg-primary"></div>
    <ul class="bg-bubbles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <!-- end bubble effect -->
    <div class="row justify-content-center align-items-center">
        <div class="col-xl-7">
            <div class="p-0 p-sm-4 px-xl-0">
                <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <!-- end carouselIndicators -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="testi-contain text-white">
                                <i class="bx bxs-quote-alt-left text-success display-6"></i>
                                <h4 class="mt-4 fw-medium lh-base text-white">"Switching to this free hosting service was a game-changer for my small business. The uptime is incredible, and the control panel is so user-friendly. I especially love that I got all these features without spending a dime!"</h4>
                                <div class="mt-4 pt-3 pb-5">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0">
                                            <img src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/images/users/avatar-1.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                        </div>
                                        <div class="flex-grow-1 ms-3 mb-4">
                                            <h5 class="font-size-18 text-white">Michael Chen</h5>
                                            <p class="mb-0 text-white-50">Small Business Owner</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="testi-contain text-white">
                                <i class="bx bxs-quote-alt-left text-success display-6"></i>
                                <h4 class="mt-4 fw-medium lh-base text-white">"As a student learning web development, this platform is perfect. The free SSL certificates, one-click installations, and reliable customer support have made hosting my projects stress-free."</h4>
                                <div class="mt-4 pt-3 pb-5">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0">
                                            <img src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/images/users/avatar-2.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                        </div>
                                        <div class="flex-grow-1 ms-3 mb-4">
                                            <h5 class="font-size-18 text-white">Sarah Rodriguez</h5>
                                            <p class="mb-0 text-white-50">Web Development Student</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="testi-contain text-white">
                                <i class="bx bxs-quote-alt-left text-success display-6"></i>
                                <h4 class="mt-4 fw-medium lh-base text-white">"I've tried many free hosting services, but this one stands out. The generous storage space, MySQL databases, and PHP support gave me everything I needed to launch my portfolio website."</h4>
                                <div class="mt-4 pt-3 pb-5">
                                    <div class="d-flex align-items-start">
                                        <img src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/images/users/avatar-3.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                        <div class="flex-1 ms-3 mb-4">
                                            <h5 class="font-size-18 text-white">David Thompson</h5>
                                            <p class="mb-0 text-white-50">Freelance Developer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end carousel-inner -->
                </div>
                <!-- end review carousel -->
            </div>
        </div>
    </div>
</div>