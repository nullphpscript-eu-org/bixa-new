<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xxl-3 col-lg-4 col-md-5">
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-5 text-center">
                                <a href="<?= base_url() ?>" class="d-block auth-logo">
                        <img src="<?= $this->base->get_slogo() ?>" alt="" height="50">
                                </a>
                            </div>
                            <center><?php display_ad('sidebar'); ?></center>
                            <div class="auth-content mt-3">
                                <div class="text-center">
                                            <h5 class="mb-0"><?= $this->base->text('welcome', 'heading') ?></h5>
                                            <p class="text-muted mt-2"><?= $this->base->text('welcome_sub', 'heading')?> <?= $this->base->get_hostname() ?> </p>
                                        </div>

                                <?= form_open('login', ['class' => 'mt-4 pt-2']) ?>
                                    <div class="mb-3">
                                        <label class="form-label"><?= $this->base->text('email_address', 'label') ?></label>
                                        <input type="email" name="email" class="form-control" placeholder="<?= $this->base->text('email_address', 'label') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <label class="form-label"><?= $this->base->text('password', 'label') ?></label>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="">
                                                    <a href="<?= base_url(); ?>forget" class="text-muted"><?= $this->base->text('i_forget_password', 'heading') ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" id="password" 
                                                   placeholder="<?= $this->base->text('password', 'label') ?>" 
                                                   name="password" 
                                                   aria-label="Password" 
                                                   aria-describedby="password-addon">
                                            <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon">
                                                <i class="mdi mdi-eye-outline"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <div class="form-check">
                                                <input type="checkbox" name="checkbox" value="1" class="form-check-input" id="remember-check">
                                                <label class="form-check-label" for="remember-check">
                                                    <?= $this->base->text('remember_me_device', 'heading') ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if ($this->grc->is_active()) : ?>
                                        <div class="mb-3">
                                            <?php if ($this->grc->get_type() == "google") : ?>
                                                <div class="g-recaptcha" data-sitekey="<?= $this->grc->get_site_key(); ?>"></div>
                                                <script src='https://www.google.com/recaptcha/api.js' async defer></script>
                                            <?php elseif ($this->grc->get_type() == "crypto") : ?>
                                                <script src='https://verifypow.com/lib/captcha.js' async></script>
                                                <div class='CRLT-captcha' data-hashes='256' data-key='<?= $this->grc->get_site_key(); ?>'>
                                                    <em>Loading PoW Captcha...<br>If it doesn't load, please disable AdBlocker!</em>
                                                </div>
                                            <?php elseif ($this->grc->get_type() == "human") : ?>
                                                <div id='captcha' class='h-captcha' data-sitekey="<?= $this->grc->get_site_key(); ?>"></div>
                                                <script src='https://hcaptcha.com/1/api.js' async defer></script>
                                            <?php elseif ($this->grc->get_type() == "turnstile") : ?>
                                                <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
                                                <div class="cf-turnstile" data-sitekey="<?= $this->grc->get_site_key(); ?>" data-callback="javascriptCallback"></div>
                                            <?php endif ?>
                                        </div>
                                    <?php endif ?>

                                    <div class="mb-3">
                                        <input type="submit" class="btn btn-primary w-100 waves-effect waves-light" name="login" value="<?= $this->base->text('signin', 'button') ?>">
                                    </div>
                                </form>

                             <!-- Social login buttons -->
<div class="mt-4">
    <div class="mt-4 text-center">
        <div class="signin-other-title">
            <h5 class="font-size-14 mb-3 text-muted fw-medium"><?= $this->base->text('social_login', 'paragraph') ?></h5>
        </div>
    </div>
    <?php if($this->oauth->is_active('github')): ?>
        <div class="mb-2">
            <a href="https://github.com/login/oauth/authorize?client_id=<?= $this->oauth->get_client('github') ?>&scope=user,email" 
               class="btn btn-dark w-100">
                <i data-feather="github" class="icon-sm align-middle me-2"></i>
                <?= $this->base->text('github', 'button') ?>
            </a>
        </div>
    <?php endif; ?>

    <?php if($this->oauth->is_active('google')): ?>
        <div class="mb-2">
            <a href="https://accounts.google.com/o/oauth2/v2/auth?client_id=<?= $this->oauth->get_client('google') ?>&scope=email profile&response_type=code&redirect_uri=<?= base_url('c/google_oauth') ?>"
               class="btn btn-danger w-100">
                <i data-feather="chrome" class="icon-sm align-middle me-2"></i>
                <?= $this->base->text('google', 'button') ?>
            </a>
        </div>
    <?php endif; ?>

    <?php if($this->oauth->is_active('facebook')): ?>
        <div class="mb-2">
            <a href="https://www.facebook.com/v12.0/dialog/oauth?client_id=<?= $this->oauth->get_client('facebook') ?>&scope=email,public_profile&redirect_uri=<?= base_url('c/facebook_oauth') ?>"
               class="btn btn-primary w-100">
                <i data-feather="facebook" class="icon-sm align-middle me-2"></i>
                <?= $this->base->text('facebook', 'button') ?>
            </a>
        </div>
    <?php endif; ?>
  <?php if($this->oauth->is_active('discord')): ?>
    <div class="mb-2">
        <a href="https://discord.com/api/oauth2/authorize?client_id=<?= $this->oauth->get_client('discord') ?>&redirect_uri=<?= urlencode(base_url('c/discord_oauth')) ?>&response_type=code&scope=identify%20email"
           class="btn btn-secondary w-100">
            <i data-feather="message-circle" class="icon-sm align-middle me-2"></i>
            <?= $this->base->text('discord', 'button') ?>
        </a>
    </div>
<?php endif; ?>

<?php if($this->oauth->is_active('microsoft')): ?>
    <div class="mb-2">
        <a href="https://login.microsoftonline.com/common/oauth2/v2.0/authorize?client_id=<?= $this->oauth->get_client('microsoft') ?>&redirect_uri=<?= urlencode(base_url('c/microsoft_oauth')) ?>&response_type=code&scope=User.Read%20email%20offline_access"
           class="btn btn-info w-100">
            <i data-feather="grid" class="icon-sm align-middle me-2"></i>
            <?= $this->base->text('microsoft', 'button') ?>
        </a>
    </div>
<?php endif; ?>
</div>

<!-- Add divider if any OAuth provider is active -->
<?php if($this->oauth->is_active('github') || $this->oauth->is_active('google') || $this->oauth->is_active('discord') || $this->oauth->is_active('microsoft') || $this->oauth->is_active('facebook')): ?>
    
<?php endif; ?>

                                <div class="mt-5 text-center">
                                    <p class="text-muted mb-0">
                                        <?= $this->base->text('dont_have_account', 'heading') ?> 
                                        <a href="<?= base_url(); ?>register" class="text-primary fw-semibold">
                                            <?= $this->base->text('register', 'button') ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <center><?php display_ad('sidebar'); ?></center>
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
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('password-addon').addEventListener('click', function() {
    var passwordInput = document.getElementById('password');
    var icon = this.querySelector('i');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('mdi-eye-outline');
        icon.classList.add('mdi-eye-off-outline');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('mdi-eye-off-outline');
        icon.classList.add('mdi-eye-outline');
    }
});
</script>