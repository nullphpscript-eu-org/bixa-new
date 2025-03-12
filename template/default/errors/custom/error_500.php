<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
    <title><?= $this->base->text('err_500', 'title') ?> - <?= $this->base->get_hostname() ?></title>
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
                        <h1 class="display-1 fw-semibold">5<span class="text-primary mx-2">0</span>0</h1>
                        <h4 class="text-uppercase mb-3">Website Under Maintenance</h4>
                        <p class="text-muted fs-5 mb-4">
                            We are currently performing system upgrades and maintenance.<br>
                            Join our Telegram group to stay updated on the maintenance progress.
                        </p>
                        <div class="mt-5 text-center">
                            <a class="btn btn-info waves-effect waves-light btn-lg" href="https://t.me/your_group_link">
                                <i data-feather="send" class="me-2 align-middle"></i>Join Telegram Group
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
    // Initialize feather icons
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
    </script>
</body>
</html>