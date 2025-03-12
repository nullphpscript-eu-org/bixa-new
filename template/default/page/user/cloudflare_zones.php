<!-- Cloudflare Domains -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Cloudflare Domains</h4>
                        <div class="page-title-right">
                            <a href="<?= base_url('cloudflare/settings') ?>" class="btn btn-primary btn-sm">
                                <i class="bx bx-cog me-1"></i> Settings
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php if($this->session->flashdata('msg')): ?>
                <?php $msg = json_decode($this->session->flashdata('msg'), true); ?>
                <div class="alert alert-<?= $msg[0] ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
                    <?= $msg[1] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Domain List -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if(!empty($zones) && isset($zones->result)): ?>
                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th>Domain Name</th>
                                                <th>Status</th>
                                                <th>SSL/TLS</th>
                                                <th>Plan</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($zones->result as $zone): ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-xs me-3">
                                                            <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                                <?= strtoupper(substr($zone->name, 0, 1)); ?>
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <h5 class="font-size-14 mb-1"><?= $zone->name; ?></h5>
                                                            <small class="text-muted"><?= $zone->name_servers[0] ?? ''; ?></small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php if($zone->status == 'active'): ?>
                                                        <span class="badge bg-success">Active</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-warning"><?= ucfirst($zone->status); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info"><?= $zone->ssl->status ?? 'Unknown'; ?></span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary"><?= ucfirst($zone->plan->name ?? 'Free'); ?></span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li>
                                                                <a class="dropdown-item" href="<?= base_url('manage_dns/'.$zone->name) ?>">
                                                                    <i class="bx bx-server font-size-16 align-middle me-1"></i> 
                                                                    Manage DNS
                                                                </a>
                                                            </li>
                                                            <?php if(!empty($zone->name_servers)): ?>
                                                            <li>
                                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#nsModal<?= $zone->id ?>">
                                                                    <i class="bx bx-info-circle font-size-16 align-middle me-1"></i>
                                                                    View Nameservers
                                                                </a>
                                                            </li>
                                                            <?php endif; ?>
                                                            <li>
                                                                <a class="dropdown-item" href="https://dash.cloudflare.com/<?= $zone->account->id ?>/<?= $zone->name ?>" target="_blank">
                                                                    <i class="bx bx-external-link font-size-16 align-middle me-1"></i>
                                                                    Open in Cloudflare
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <!-- Nameservers Modal -->
                                                    <?php if(!empty($zone->name_servers)): ?>
                                                    <div class="modal fade" id="nsModal<?= $zone->id ?>" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Nameservers for <?= $zone->name ?></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php foreach($zone->name_servers as $ns): ?>
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" class="form-control" value="<?= $ns ?>" readonly>
                                                                        <button class="btn btn-outline-secondary" type="button" onclick="navigator.clipboard.writeText('<?= $ns ?>')">
                                                                            <i class="bx bx-copy"></i>
                                                                        </button>
                                                                    </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="text-center p-5">
                                    <div class="avatar-lg mx-auto mb-4">
                                        <div class="avatar-title rounded-circle bg-primary bg-soft">
                                            <i class="bx bx-globe font-size-24"></i>
                                        </div>
                                    </div>
                                    <h5>No Domains Found</h5>
                                    <p class="text-muted">Add your first domain to Cloudflare to get started.</p>
                                    <a href="https://dash.cloudflare.com/?to=/:account/add-site" target="_blank" class="btn btn-primary">
                                        <i class="bx bx-plus me-1"></i>
                                        Add Domain to Cloudflare
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>