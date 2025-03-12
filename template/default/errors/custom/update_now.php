<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Update System - <?= $this->base->get_hostname() ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/images/favicon.ico">

        <!-- CSS files -->
        <link href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/css/preloader.min.css" type="text/css" />
        <link href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    </head>

    <body data-layout="horizontal">

        <!-- Begin page -->
        <div id="layout-wrapper">

            

         
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">System Update</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">System</a></li>
                                            <li class="breadcrumb-item active">Update</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <!-- Left Sidebar -->
                            <div class="col-xl-3 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start mb-4">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/images/update-icon.png" alt="" class="avatar-sm rounded-circle">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="font-size-16">Current Version</h5>
                                                <p class="text-muted"><?= get_version() ?></p>
                                            </div>
                                        </div>
                                        
                                        <div class="border-bottom pb-3">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div>
                                                        <p class="text-muted mb-2">Status</p>
                                                        <?php if($version > get_version()): ?>
                                                            <h5 class="font-size-15 text-warning">Update Available</h5>
                                                        <?php else: ?>
                                                            <h5 class="font-size-15 text-success">Up to date</h5>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div>
                                                        <p class="text-muted mb-2">Latest Version</p>
                                                        <h5 class="font-size-15"><?= $version ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- System Info -->
                                        <div class="mt-3">
                                            <p class="text-muted mb-2">System Information</p>
                                            <div class="table-responsive">
                                                <table class="table table-sm table-nowrap mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">PHP Version</th>
                                                            <td><?= phpversion() ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">MySQL Version</th>
                                                            <td><?= mysqli_get_client_version() ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Server</th>
                                                            <td><?= $_SERVER['SERVER_SOFTWARE'] ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Main Update Content -->
                            <div class="col-xl-9 col-lg-8">
                                <?php if($version > get_version()): ?>
                                    <!-- Update Available -->
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <div class="avatar-xl mx-auto mb-4">
                                                    <div class="avatar-title bg-warning-subtle rounded-circle display-1">
                                                        <i data-feather="arrow-up-circle" class="text-warning"></i>
                                                    </div>
                                                </div>
                                                <h4 class="mb-3">A New Update is Available!</h4>
                                                <p class="text-muted mb-4">
                                                    Version <?= $version ?> is now available. Your current version is <?= get_version() ?>.<br/>
                                                    Please back up your database and files before updating.
                                                </p>

                                                <div class="row justify-content-center">
                                                    <div class="col-xl-10">
                                                        <div class="alert alert-warning" role="alert">
                                                            <i data-feather="alert-triangle" class="me-2"></i>
                                                            Before updating, please make sure to backup your database and files to avoid any data loss.
                                                        </div>

                                                     <div class="row mt-4">
    <div class="col-md-6">
        <div class="d-flex align-items-center mb-3">
            <div class="flex-shrink-0 me-3">
                <div class="avatar-xs">
                    <div class="avatar-title bg-light text-primary rounded">
                        <i data-feather="database"></i>
                    </div>
                </div>
            </div>
            <div class="flex-grow-1">
                <h5 class="font-size-15 mb-1">Database Backup</h5>
                <p class="text-muted mb-0">Export your database</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="d-flex align-items-center mb-3">
            <div class="flex-shrink-0 me-3">
                <div class="avatar-xs">
                    <div class="avatar-title bg-light text-primary rounded">
                        <i data-feather="folder"></i>
                    </div>
                </div>
            </div>
            <div class="flex-grow-1">
                <h5 class="font-size-15 mb-1">Files Backup</h5>
                <p class="text-muted mb-0">Backup important files</p>
            </div>
        </div>
    </div>
</div>
                                                        <div class="mt-4">
                                                            <a href="?update=true" class="btn btn-primary waves-effect waves-light btn-lg w-100">
                                                                <i data-feather="download" class="icon-sm me-1"></i>
                                                                Update to Version <?= $version ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <!-- Up to Date -->
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <div class="avatar-xl mx-auto mb-4">
                                                    <div class="avatar-title bg-success-subtle text-success display-1 rounded-circle">
                                                        <i data-feather="check-circle"></i>
                                                    </div>
                                                </div>
                                                <h4 class="mb-3">Your System is Up to Date!</h4>
                                                <p class="text-muted mb-4">
                                                    You are currently running version <?= get_version() ?>, which is the latest version available.
                                                </p>

                                                <div class="row justify-content-center">
                                                    <div class="col-xl-10">
                                                        <div class="alert alert-success" role="alert">
                                                            <i data-feather="check" class="me-2"></i>
                                                            All system components are up to date and functioning properly.
                                                        </div>

                                                        <div class="mt-4">
                                                            <a href="<?= base_url() ?>admin/dashboard" class="btn btn-primary waves-effect waves-light btn-lg">
                                                                <i data-feather="arrow-left" class="icon-sm me-1"></i>
                                                                Back to Dashboard
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © <?= $this->base->text('company', 'paragraph') ?>.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                            <?= $this->base->text('made', 'paragraph') ?> <?= $this->base->text('company', 'paragraph') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- JAVASCRIPT -->
        <script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/libs/jquery/jquery.min.js"></script>
        <script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/libs/simplebar/simplebar.min.js"></script>
        <script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/libs/node-waves/waves.min.js"></script>
        <script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/libs/feather-icons/feather.min.js"></script>
        <script>
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        </script>
        <script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/libs/pace-js/pace.min.js"></script>
        <script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/js/app.js"></script>
    </body>
</html>