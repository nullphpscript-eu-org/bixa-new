</div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->

        <!-- Footer -->
        <footer class="footer">
<?php if(isset($_SESSION['msg'])){ 
    $msg = json_decode($_SESSION['msg'], true); 
    $type = ($msg[0] == 0) ? 'error' : 'success';
    $message = $msg[1];
    $isLongMessage = strlen($message) > 100;
?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: '<?php echo $type ?>',
            html: '<?php echo addslashes($message) ?>',
            toast: true,
            position: 'top-end',
            showConfirmButton: <?php echo $isLongMessage ? 'true' : 'false' ?>,
            confirmButtonText: 'OK',
            timer: <?php echo $isLongMessage ? 'null' : '3000' ?>,
            width: 'auto', // Giảm width xuống
            customClass: {
                popup: <?php echo $isLongMessage ? "'error-toast'" : "'normal-toast'" ?>,
                confirmButton: 'toast-confirm-button'
            }
        });
    });
    </script>

    <style>
    .error-toast {
        font-size: 13px !important;
        padding: 15px 20px !important;
        white-space: pre-wrap !important; 
        word-wrap: break-word !important;
        background-color: #fef0f0 !important;
        color: #990000 !important;
    }
    .error-toast .swal2-html-container {
        margin: 5px 0 10px 0 !important; /* Thêm margin bottom để tách nội dung và nút */
        text-align: left !important;
    }
    .toast-confirm-button {
        margin-top: 5px !important;
        min-width: 60px !important;
    }
    </style>
<?php 
    unset($_SESSION['msg']); 
} ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright <script>document.write(new Date().getFullYear())</script> © <a href="<?= base_url()?>"><?= $this->base->get_hostname() ?></a>.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            <?= $this->base->text('made', 'paragraph') ?> <?= $this->base->get_hostname() ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

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
        <!-- pace js -->
        <script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/libs/pace-js/pace.min.js"></script>

        <!-- apexcharts -->
        <script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/libs/apexcharts/apexcharts.min.js"></script>

        <!-- Plugins js-->
        <script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
        <!-- dashboard init -->
        <script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/js/pages/dashboard.init.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/js/app.js"></script>
    </body>