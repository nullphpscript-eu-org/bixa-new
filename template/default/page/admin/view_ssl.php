<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">View SSL (<?php echo $data['type']; ?>)</h4>
                        <div class="page-title-right">
                            <?php if ($data['status'] == 'cancelled' OR $data['status'] == 'expired'): ?>
                                <a href="?delete=true" class="btn btn-danger waves-effect waves-light">
                                    <i data-feather="trash-2" class="me-1 align-middle"></i> Delete
                                </a>
                            <?php elseif ($data['type'] != 'GoGetSSL'): ?>
                                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i data-feather="trash-2" class="me-1 align-middle"></i> Delete
                                </button>
                            <?php elseif ($data['status'] !== 'cancelled' OR $data['status'] !== 'expired'): ?>
                                <a href="?cancel=true" class="btn btn-danger waves-effect waves-light">
                                    <i data-feather="x" class="me-1 align-middle"></i> Cancel
                                </a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="text-muted">Domain:</label>
                                    <div class="fw-medium"><?= $data['domain'] ?></div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="text-muted">Status:</label>
                                    <div>
                                        <?php if ($data['status'] == 'processing' || $data['status'] == 'pending'): ?>
                                            <span class="badge bg-warning">
                                                <i data-feather="clock" class="font-size-12 align-middle me-1"></i><?= $data['status'] ?>
                                            </span>
                                        <?php elseif ($data['status'] == 'active' || $data['status'] == 'ready'): ?>
                                            <span class="badge bg-success">
                                                <i data-feather="check-circle" class="font-size-12 align-middle me-1"></i><?= $data['status'] ?>
                                            </span>
                                        <?php elseif ($data['status'] == 'cancelled' OR $data['status'] == 'expired'): ?>
                                            <span class="badge bg-danger">
                                                <i data-feather="x-circle" class="font-size-12 align-middle me-1"></i><?= $data['status'] ?>
                                            </span>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="text-muted">Start Date:</label>
                                    <div class="fw-medium"><?= $data['begin_date'] ?? '-- -- ----' ?></div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="text-muted">End Date:</label>
                                    <div class="fw-medium"><?= $data['end_date'] ?? '-- -- ----' ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SSL Details Card -->
                    <div class="card">
                        <?php if ($data['status'] == 'pending' || $data['status'] == 'ready' || ($data['status'] == 'processing' && $data['type'] == 'GoGetSSL')): ?>
                            <?php $record = explode(' ', $data['approver_method']['dns']['record']) ?>
                            <div class="card-header">
                                <h4 class="card-title mb-0">Verify Ownership</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">CSR Code</label>
                                    <textarea class="form-control font-monospace" rows="8" readonly><?= $data['csr_code'] ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Record Name</label>
                                    <input type="text" class="form-control" value="<?= trim($record[0]) ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Record Type</label>
                                    <input type="text" class="form-control" value="<?= trim($record[1]) ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Record Content</label>
                                    <input type="text" class="form-control" value="<?= trim($record[2]) ?>" readonly>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">CSR Code</label>
                                    <textarea class="form-control font-monospace" rows="8" readonly><?= $data['csr_code'] ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">CRT Code</label>
                                    <textarea class="form-control font-monospace" rows="8" readonly><?= $data['crt_code'] ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">CA Code</label>
                                    <textarea class="form-control font-monospace" rows="8" readonly><?= $data['ca_code'] ?></textarea>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete SSL Certificate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Deleting the certificate here will remove the certificate from the list in the client area.</p>
                <ul class="mb-0">
                    <li>This will NOT remove the SSL certificate currently installed on your domain.</li>
                    <li>This will NOT make your website switch back to HTTP.</li>
                    <li>The certificate WILL remain valid until the expiration date.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                <a href="?delete=true" class="btn btn-danger waves-effect waves-light">Delete</a>
            </div>
        </div>
    </div>
</div>