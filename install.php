<?php
if (isset($_GET['step']) and $_GET['step'] == 1 and isset($_POST['submit'])) {
    $base_url_value = $_POST['base_url'];
    $cookie_prefix = $_POST['cookie_prefix'];
    $csrf = $_POST['csrf'];
    if (strpos($cookie_prefix, '_') !== strlen($cookie_prefix) - 1) {
        $cookie_prefix = $cookie_prefix . '_';
    }
    if ($csrf == 0) {
        $csrf_value = 'FALSE';
    } else {
        $csrf_value = 'TRUE';
    }
    $file = file_get_contents('https://raw.githubusercontent.com/bixacloud/bixa/dev/app/config/config.php');
    $data = str_replace('BASE_URL_VALUE', $base_url_value, $file);
    $data = str_replace('COOKIE_PREFIX_VALUE', $cookie_prefix, $data);
    $data = str_replace('CSRF_PROTECTION_MODE', $csrf_value, $data);
    $res = file_put_contents(__DIR__ . '/app/config/config.php', $data);
    $_SESSION['msg'] = json_encode(['success', 'Basic settings changed successfully.']);
    header('location: ' . $base_url . 'install.php?step=2');
} elseif (isset($_GET['step']) and $_GET['step'] == 2 and isset($_POST['submit'])) {
    $hostname = $_POST['hostname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $database = $_POST['database'];

    try {
        
        $mysqli = new mysqli($hostname, $username, $password);
        if ($mysqli->connect_error) {
            throw new Exception("Could not connect to MySQL: " . $mysqli->connect_error);
        }

        if (!$mysqli->set_charset("utf8mb4")) {
            throw new Exception("Error setting UTF-8 charset: " . $mysqli->error);
        }

        $sql = "CREATE DATABASE IF NOT EXISTS `" . $mysqli->real_escape_string($database) . "`
                CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        if (!$mysqli->query($sql)) {
            throw new Exception("Could not create database: " . $mysqli->error);
        }

        if (!$mysqli->select_db($database)) {
            throw new Exception("Could not select database: " . $mysqli->error);
        }

        $sql_file = __DIR__ . '/database.sql';
        if (!file_exists($sql_file)) {
            throw new Exception("SQL file not found: database.sql");
        }

        $sql_content = file_get_contents($sql_file);
        if ($sql_content === false) {
            throw new Exception("Could not read SQL file");
        }

        $queries = array();
        $current_query = '';

        foreach (explode("\n", $sql_content) as $line) {
            $line = trim($line);
            
            if (empty($line) || strpos($line, '--') === 0 || strpos($line, '#') === 0) {
                continue; 
            }

            $current_query .= $line . ' ';
            
            if (substr($line, -1) === ';') {
                $queries[] = $current_query;
                $current_query = '';
            }
        }

        $mysqli->begin_transaction();

        try {
            foreach ($queries as $sql) {
                if (!empty(trim($sql))) {
                    if (!$mysqli->query($sql)) {
                        throw new Exception("Error executing SQL: " . $mysqli->error);
                    }
                }
            }

            $file = file_get_contents('https://raw.githubusercontent.com/bixacloud/bixa/dev/app/config/database.php');
            $data = str_replace(
                ['DB_HOSTNAME', 'DB_USERNAME', 'DB_PASSWORD', 'DB_NAME'],
                [$hostname, $username, $password, $database], 
                $file
            );

            if (!is_dir(__DIR__ . '/app/config')) {
                mkdir(__DIR__ . '/app/config', 0755, true);
            }
            file_put_contents(__DIR__ . '/app/config/database.php', $data);

            if (!is_dir(__DIR__ . '/app/logs')) {
                mkdir(__DIR__ . '/app/logs', 0755, true);
            }

            $json = json_encode([
                'installed' => true,
                'time' => date('d-m-Y h:i:s A'),
                'version' => '1.0.0',
                'db_version' => '1.0'
            ]);
            file_put_contents(__DIR__ . '/app/logs/install.json', $json);

            $mysqli->commit();

            $temp_files = [
                __DIR__ . '/database.sql',
                __DIR__ . '/index.html'
            ];

            foreach ($temp_files as $file) {
                if (file_exists($file)) {
                    if (@unlink($file)) {
                        error_log("Deleted temporary file: " . $file);
                    } else {
                        error_log("Failed to delete file: " . $file);
                    }
                }
            }

            if (!isset($_SESSION['install_cleanup'])) {
                $_SESSION['install_cleanup'] = true;
                $_SESSION['msg'] = json_encode(['success', 'Database configured successfully.']);
                header('location: ' . $base_url . 'install.php?step=3');
                exit;
            }

        } catch (Exception $e) {
            $mysqli->rollback();
            throw $e;
        }

    } catch (Exception $e) {
        $_SESSION['msg'] = json_encode(['danger', $e->getMessage()]);
        header('location: ' . $base_url . 'install.php?step=2');
        exit;
    } finally {
        if (isset($mysqli)) {
            $mysqli->close();
        }
    }
} elseif (isset($_GET['step']) and $_GET['step'] == 3) {
    if (isset($_SESSION['install_cleanup'])) {
        @unlink(__FILE__);
        unset($_SESSION['install_cleanup']);
    }
}
?>
<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/default/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/default/css/icons.min.css">
    <link rel="stylesheet" href="assets/default/css/app.min.css">
    <link rel="shortcut icon" href="assets/default/images/favicon.ico">
</head>

<body data-sidebar="dark">
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <div class="navbar-brand-box">
                        <a href="#" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="assets/default/images/logo.svg" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/default/images/logo-dark.png" alt="" height="17">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" 
                            id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                </div>
            </div>
        </header>

        <div class="vertical-menu">
            <div data-simplebar class="h-100">
                <div id="sidebar-menu">
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Installation Steps</li>
                        <li <?= !isset($_GET['step']) ? 'class="mm-active"' : '' ?>>
                            <a href="install.php" class="waves-effect <?= !isset($_GET['step']) ? 'active' : '' ?>">
                                <i class="bx bx-home-circle"></i>
                                <span>Welcome</span>
                            </a>
                        </li>
                        <li <?= (isset($_GET['step']) && $_GET['step'] == 1) ? 'class="mm-active"' : '' ?>>
                            <a href="<?= !isset($_GET['step']) ? 'install.php?step=1' : '#' ?>" class="waves-effect <?= (isset($_GET['step']) && $_GET['step'] == 1) ? 'active' : '' ?>">
                                <i class="bx bx-cog"></i>
                                <span>Basic Settings</span>
                            </a>
                        </li>
                        <li <?= (isset($_GET['step']) && $_GET['step'] == 2) ? 'class="mm-active"' : '' ?>>
                            <a href="<?= (isset($_GET['step']) && $_GET['step'] == 1) ? 'install.php?step=2' : '#' ?>" class="waves-effect <?= (isset($_GET['step']) && $_GET['step'] == 2) ? 'active' : '' ?>">
                                <i class="bx bx-data"></i>
                                <span>Database Settings</span>
                            </a>
                        </li>
                        <li <?= (isset($_GET['step']) && $_GET['step'] == 3) ? 'class="mm-active"' : '' ?>>
                            <a href="<?= (isset($_GET['step']) && $_GET['step'] == 2) ? 'install.php?step=3' : '#' ?>" class="waves-effect <?= (isset($_GET['step']) && $_GET['step'] == 3) ? 'active' : '' ?>">
                                <i class="bx bx-check-circle"></i>
                                <span>Completion</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18"><?= $title ?></h4>
                            </div>
                        </div>
                    </div>

                    <?php if(isset($_SESSION['msg'])): ?>
                        <?php $msg = json_decode($_SESSION['msg'], true); ?>
                        <div class="alert alert-<?= $msg[0] ?> alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-<?= $msg[0] === 'success' ? 'check-circle' : 'alert-circle' ?> me-2"></i>
                            <?= $msg[1] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['msg']); ?>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <?php if (isset($_GET['step']) && $_GET['step'] == 1): ?>
                                    <form action="install.php?step=1" method="POST" class="card-body">
                                        <h4 class="card-title mb-4">Basic Settings</h4>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Website URL</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bx bx-globe"></i></span>
                                                        <input required type="text" name="base_url" class="form-control" 
                                                               value="<?= $base_url ?>" placeholder="https://your.domain">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Cookie Prefix</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bx bx-cookie"></i></span>
                                                        <input required type="text" name="cookie_prefix" class="form-control" 
                                                               value="bixa_" placeholder="bixa_">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Enable CSRF Protection</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bx bx-shield"></i></span>
                                                        <select class="form-select" name="csrf">
                                                            <option value="1" selected>Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-wrap gap-2">
                                            <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
                                                Next Step <i class="bx bx-right-arrow-alt ms-1"></i>
                                            </button>
                                        </div>
                                    </form>

                                <?php elseif (isset($_GET['step']) && $_GET['step'] == 2): ?>
                                    <form action="install.php?step=2" method="POST" class="card-body">
                                        <h4 class="card-title mb-4">Database Settings</h4>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Hostname</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bx bx-server"></i></span>
                                                        <input required type="text" name="hostname" class="form-control" 
                                                               value="localhost" placeholder="localhost">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Database Name</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bx bx-data"></i></span>
                                                        <input required type="text" name="database" class="form-control" 
                                                               placeholder="bixa">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Username</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bx bx-user"></i></span>
                                                        <input required type="text" name="username" class="form-control" 
                                                               placeholder="root">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Password</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bx bx-lock"></i></span>
                                                        <input type="password" name="password" class="form-control" 
                                                               placeholder="Enter password">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-wrap gap-2">
                                            <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
                                                Next Step <i class="bx bx-right-arrow-alt ms-1"></i>
                                            </button>
                                        </div>
                                    </form>

                                <?php elseif (isset($_GET['step']) && $_GET['step'] == 3): ?>
                                    <div class="card-body text-center">
                                        <div class="mb-4">
                                            <i class="bx bx-check-circle text-success" style="font-size: 3rem;"></i>
                                        </div>
                                        <h4 class="card-title mb-4">Installation Complete!</h4>
                                        <p class="card-text text-muted mb-4">
                                            BIXA has been installed successfully! Click below to proceed to the admin 
                                            registration page. The install.php file will be automatically deleted please delete database.sql for security.
                                        </p>
                                        <a href="admin/register" class="btn btn-success waves-effect waves-light">
                                            Complete Setup <i class="bx bx-check-double ms-1"></i>
                                        </a>
                                    </div>

                                <?php else: ?>
                                    <div class="card-body text-center">
                                        <div class="mb-4">
                                            <i class="bx bx-package text-primary" style="font-size: 3rem;"></i>
                                        </div>
                                        <h4 class="card-title mb-4">Welcome to BIXA Installation</h4>
                                        <p class="card-text text-muted mb-4">
                                            BIXA is a hosting account and support management system designed for 
                                            MyOwnFreeHost and GoGetSSL API integration. Let's get you started with 
                                            the installation process.
                                        </p>
                                        <div class="row justify-content-center mb-4">
                                            <div class="col-lg-8">
                                                <div class="alert alert-info">
                                                    <h5 class="alert-heading"><i class="bx bx-info-circle me-2"></i>System Requirements</h5>
                                                    <p class="mb-2">Please ensure your system meets the following requirements:</p>
                                                    <ul class="list-unstyled mb-0">
                                                        <li><i class="bx bx-check me-2"></i>PHP version 8.1 or higher</li>
                                                        <li><i class="bx bx-check me-2"></i>MySQL version 5.7 or higher</li>
                                                        <li><i class="bx bx-check me-2"></i>PHP Extensions: mysqli, curl, json</li>
                                                        <li><i class="bx bx-check me-2"></i>Write permissions for app/config and app/logs directories</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="install.php?step=1" class="btn btn-primary waves-effect waves-light">
                                            Begin Installation <i class="bx bx-right-arrow-alt ms-1"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <?= date('Y') ?> © BIXA
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Powered by Bixa cloud
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/default/libs/jquery/jquery.min.js"></script>
    <script src="assets/default/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/default/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/default/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/default/libs/node-waves/waves.min.js"></script>
    <script src="assets/default/js/app.js"></script>
</body>
</html>