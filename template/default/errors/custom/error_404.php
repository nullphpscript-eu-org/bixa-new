<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
    <title><?= $this->base->text('err_404', 'title') ?> - <?= $this->base->get_hostname() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/images/favicon.ico">

    <!-- CSS -->
    <link href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/css/app.min.css" rel="stylesheet" type="text/css" />
</head>

<body data-layout-mode="<?= get_cookie('theme') ?? 'light' ?>">
    <div class="my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h1 class="display-1 fw-semibold">4<span class="text-primary mx-2">0</span>4</h1>
                                                    <h4 class="text-uppercase">Sorry, page not found</h4>

                       <div class="mt-5 text-center">
    <a class="btn btn-primary waves-effect waves-light btn-lg" href="<?= base_url() ?>">
        <i data-feather="home" class="me-2 align-middle"></i>Back to Home
    </a>
</div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10 col-xl-8">
                    <div>
                        <img src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/images/error-img.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT --> 
<script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/libs/jquery/jquery.min.js"></script>
<script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/libs/metismenu/metisMenu.min.js"></script>
<script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/libs/feather-icons/feather.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
});
</script>
</body>
</html>