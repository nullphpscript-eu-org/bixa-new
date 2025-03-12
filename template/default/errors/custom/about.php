<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
    <title>About Bixa - <?= $this->base->get_hostname() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/img/fav.png">
    <link href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/css/app.min.css" rel="stylesheet" type="text/css" />
</head>

<body data-layout="horizontal" data-topbar="dark" class="pace-done">
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-12">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5 text-center">
                                    <a href="<?= base_url() ?>" class="d-block auth-logo">
                                        <img src="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/images/logo-sm.svg" alt="Bixa" height="50" class="auth-logo-dark">
                                    </a>
                                </div>
                                
                                <div class="auth-content my-auto text-center">
                                    <div class="avatar-xl mx-auto mb-4">
                                        <div class="avatar-title bg-light text-primary display-4 rounded-circle">
                                            <i class="bx bxs-cloud"></i>
                                        </div>
                                    </div>
                                    <h4 class="mb-4">Welcome to Bixa Hosting Management System</h4>
                                    <div class="row justify-content-center mb-4">
                                        <div class="col-xl-8">
                                            <div class="text-muted">
                                                <p>Bixa is a powerful hosting management system that brings together everything you need to manage your web hosting business effectively.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-4">
                                            <div class="card border">
                                                <div class="card-body text-center">
                                                    <div class="avatar-sm mx-auto mb-3">
                                                        <span class="avatar-title rounded-circle bg-primary text-white">
                                                            <i class="mdi mdi-server fs-20"></i>
                                                        </span>
                                                    </div>
                                                    <h6>MyOwnFreeHost Integration</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card border">
                                                <div class="card-body text-center">
                                                    <div class="avatar-sm mx-auto mb-3">
                                                        <span class="avatar-title rounded-circle bg-success text-white">
                                                            <i class="mdi mdi-shield-check fs-20"></i>
                                                        </span>
                                                    </div>
                                                    <h6>SSL Management</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card border">
                                                <div class="card-body text-center">
                                                    <div class="avatar-sm mx-auto mb-3">
                                                        <span class="avatar-title rounded-circle bg-info text-white">
                                                            <i class="mdi mdi-ticket fs-20"></i>
                                                        </span>
                                                    </div>
                                                    <h6>Support System</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <p class="text-muted mb-0">Version: <span class="fw-semibold">v<?= get_version() ?> <?= get_tag() ?></span></p>
                                    </div>

                                </div>

                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">© <?= date('Y') ?> Bixa. Crafted with <i class="mdi mdi-heart text-danger"></i> by BixaCloud</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/libs/feather-icons/feather.min.js"></script>
    <script src="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/js/app.js"></script>
</body>

</html>