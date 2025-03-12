<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
    <meta charset="utf-8" />
    <title>License Agreement - <?= $this->base->get_hostname() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/img/fav.png">
    <link href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/css/app.min.css" rel="stylesheet" type="text/css" />
</head>

<body data-layout="horizontal" data-topbar="dark">
    <div class="authentication-bg min-vh-100">
        <div class="container">
            <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                <div class="row justify-content-center my-auto">
                    <div class="col-lg-10">
                        <!-- Logo -->
                        <div class="text-center mb-4">
                            <a href="<?= base_url() ?>" class="d-block auth-logo">
                                        <img src="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/images/logo-sm.svg" alt="Bixa" height="50" class="auth-logo-dark">
                            </a>
                        </div>

                        <div class="card">
                            <div class="card-body p-4">
                                <div class="text-center mb-3">
                                    <h4 class="text-primary">License Agreement</h4>
                                </div>

                                <div class="custom-border-position">
                                    <div class="alert alert-info mb-4" role="alert">
                                        <p class="mb-0">Please read this license agreement carefully before using Bixa Hosting Management System.</p>
                                    </div>

                                    <div class="license-content" style="height: 400px; overflow-y: auto; padding: 15px;">
                                        <h5>1. Definitions</h5>
                                        <p>"Bixa" refers to the hosting management system software.</p>
                                        <p>"License" means the terms and conditions for use, reproduction, and distribution as defined in this document.</p>
                                        <p>"Licensor" refers to BixaCloud, the copyright owner authorizing use under this License.</p>
                                        <p>"You" refers to an individual or entity exercising permissions granted by this License.</p>

                                        <h5 class="mt-4">2. Grant of License</h5>
                                        <p>Subject to the terms of this agreement, BixaCloud grants you a non-exclusive, non-transferable license to use Bixa for your hosting business operations.</p>

                                        <h5 class="mt-4">3. Permitted Uses</h5>
                                        <ul>
                                            <li>Install and use Bixa for managing hosting accounts</li>
                                            <li>Create backups of the software for your own use</li>
                                            <li>Modify the software for your own use</li>
                                        </ul>

                                        <h5 class="mt-4">4. Restrictions</h5>
                                        <ul>
                                            <li>You may not distribute or sell copies of Bixa</li>
                                            <li>You may not remove or alter any copyright notices</li>
                                            <li>You may not use Bixa for any illegal purposes</li>
                                        </ul>

                                        <h5 class="mt-4">5. Ownership</h5>
                                        <p>Bixa is owned and copyrighted by BixaCloud. This license gives you limited rights to use the software. All rights not expressly granted are reserved by BixaCloud.</p>

                                        <h5 class="mt-4">6. Support and Updates</h5>
                                        <p>This license includes access to updates and technical support as provided through the official channels.</p>

                                        <h5 class="mt-4">7. Termination</h5>
                                        <p>This license is effective until terminated. Your rights under this license will terminate automatically without notice if you fail to comply with any term(s) of this license.</p>

                                        <h5 class="mt-4">8. Disclaimer of Warranty</h5>
                                        <p>BIXA IS PROVIDED "AS IS" WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESS OR IMPLIED. THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE SOFTWARE IS WITH YOU.</p>

                                        <h5 class="mt-4">9. Limitation of Liability</h5>
                                        <p>IN NO EVENT SHALL BIXACLOUD BE LIABLE FOR ANY DAMAGES ARISING OUT OF THE USE OR INABILITY TO USE BIXA.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <p class="mb-0">© <?= date('Y') ?> Bixa. Crafted with <i class="mdi mdi-heart text-danger"></i> by BixaCloud</p>
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
    <script src="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/js/app.js"></script>
</body>

</html>