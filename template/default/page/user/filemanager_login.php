<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
    <title><?= $this->base->text('filemanager_login', 'title') ?>(<?= $username ?>) - <?= $this->base->get_hostname() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex" />
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/images/favicon.ico">

    <!-- CSS -->
    <link href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/css/app.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg" data-layout-mode="<?= get_cookie('theme') ?? 'light' ?>">
    <div class="auth-page">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="text-center">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="avatar-lg mx-auto">
                                    <div class="avatar-title rounded-circle bg-light">
                                        <i data-feather="folder" class="icon-dual-primary icon-lg"></i>
                                    </div>
                                </div>
                                
                                <div class="mt-4 pt-2">
                                    <h4><?= $this->base->text('login_to_filemanager', 'heading') ?></h4>
                                    <p class="text-muted font-size-15 mb-4">
                                        <?= $this->base->text('filemanager_login', 'paragraph') ?>
                                    </p>

                                    <div class="d-grid">
                                        <button type="button" id="redirect-btn" class="btn btn-primary waves-effect waves-light">
                                            <i class="bx bx-right-arrow-alt font-size-16 align-middle me-2"></i>
                                            <?= $this->base->text('redirect_now', 'button') ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }

        var config = {
            't': 'ftp',
            'c': {
                'v': 1,
                'p': '<?= $password ?>',
                'i': '<?= $dir ?>'
            }
        };
        
        var encodedConfig = btoa(JSON.stringify(config));
        var fileManagerUrl = 'https://filemanager.ai/new/#/c/ftpupload.net/<?= $username ?>/' + encodedConfig;

        document.getElementById('redirect-btn').addEventListener('click', function() {
            window.location.href = fileManagerUrl;
        });

        // Auto redirect after a short delay
        setTimeout(function() {
            window.location.href = fileManagerUrl;
        }, 1000);
    });
    </script>
</body>
</html>