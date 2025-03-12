<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
    <title><?= $this->base->text('err_503', 'title') ?> - <?= $this->base->get_hostname() ?></title>
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
                        <h1 class="display-1 fw-semibold">5<span class="text-primary mx-2">0</span>3</h1>
                        <h4 class="text-uppercase"><?= $this->base->text('oops_note', 'paragraph') ?></h4>
                        <p class="text-muted"><?= $this->base->text('err_503_note', 'paragraph') ?></p>
                        <div class="mt-5 text-center">
                            <a class="btn btn-primary waves-effect waves-light" href="<?= base_url() ?>">Back to Home</a>
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
</body>
</html>