<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-circle bg-warning-subtle text-warning font-size-18">
                                            <i data-feather="users"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Registered Clients</h5>
                                    <p class="text-muted mb-0">
                                        <?= $this->user->get_count('active') + $this->user->get_count('inactive') ?> in total
                                    </p>
                                </div>
                            </div>
                            <div class="mt-3" id="clients-chart"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-18">
                                            <i data-feather="server"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Hosting Accounts</h5>
                                    <p class="text-muted mb-0">
                                        <?= $this->account->get_count('active') + $this->account->get_count('suspended') + $this->account->get_count('deactivated') ?> in total
                                    </p>
                                </div>
                            </div>
                            <div class="mt-3" id="accounts-chart"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-circle bg-info-subtle text-info font-size-18">
                                            <i data-feather="message-square"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Support Tickets</h5>
                                    <p class="text-muted mb-0"><?= $ci_tickets ?> in total</p>
                                </div>
                            </div>
                            <div class="mt-3" id="tickets-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tools Section -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Tools</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- About Bixa -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-circle bg-warning-subtle text-warning font-size-18">
                                            <i data-feather="info"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">About Bixa</h5>
                                    <a href="<?= base_url() ?>about" class="text-muted" target="_blank">View here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Check Updates -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-18">
                                            <i data-feather="upload"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Check Updates</h5>
                                    <a href="<?= base_url() ?>update" class="text-muted" target="_blank">Check here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Documentation -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-circle bg-info-subtle text-info font-size-18">
                                            <i data-feather="book"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Documentation</h5>
                                    <a href="<?= base_url() ?>documentation" class="text-muted" target="_blank">Setup Guide</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Need Help -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-circle bg-success-subtle text-success font-size-18">
                                            <i data-feather="help-circle"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Need Help?</h5>
                                    <a href="https://github.com/bixadotapp/bixa/issues" class="text-muted" target="_blank">Open an issue in Github</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contribute -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-circle bg-purple-subtle text-purple font-size-18">
                                            <i data-feather="git-pull-request"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Contribute</h5>
                                    <a href="https://github.com/bixadotapp/bixa/#help" class="text-muted" target="_blank">Check here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Like bixa -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-circle bg-danger-subtle text-danger font-size-18">
                                            <i data-feather="heart"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Like Bixa?</h5>
                                    <a href="<?= base_url() ?>donate" class="text-muted" target="_blank">Donate here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Terms of Service -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-circle bg-cyan-subtle text-cyan font-size-18">
                                            <i data-feather="file-text"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Terms of Service</h5>
                                    <a href="<?= base_url() ?>tos" class="text-muted" target="_blank">View here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- License -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-circle bg-teal-subtle text-teal font-size-18">
                                            <i data-feather="file"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">License</h5>
                                    <a href="<?= base_url() ?>license" class="text-muted" target="_blank">View here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Chart Configurations -->
<script>
// Chart configurations remain the same but updated with Minia colors
var chartColors = {
    primary: '#5156be',
    warning: '#ffbf53', 
    info: '#299cdb',
    danger: '#ef6767',
    success: '#2ab57d'
};

var options = {
    // ... Rest of the chart options remain the same
    colors: [chartColors.success, chartColors.danger],
    // ... Add additional styling for Minia theme
};
// ... Other chart configurations
</script>

<!-- Initialize feather icons -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
});
</script>