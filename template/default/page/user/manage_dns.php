<!-- Main Content -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
        <center><?php display_ad('header'); ?></center>
            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Manage DNS Records</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?= base_url('cloudflare/zones') ?>">Domains</a></li>
                                <li class="breadcrumb-item active"><?= htmlspecialchars($domain) ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            
            <!-- DNS Records Card -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h5 class="card-title flex-grow-1">DNS Records</h5>
                        <div class="flex-shrink-0">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRecordModal">
                                <i class="bx bx-plus align-middle me-1"></i> Add Record
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap table-hover">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Content</th>
                                    <th>TTL</th>
                                    <th>Proxy Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                          <tbody>
    <?php if(!empty($records)): ?>
        <?php foreach($records as $record): ?>
            <tr>
                <td>
                    <span class="badge badge-soft-primary">
                        <?= $record->type ?>
                    </span>
                </td>
                <td>
                    <code class="font-size-13">
                        <?php 
                        // Rút gọn tên nếu quá dài
                        $name = str_replace('.'.$domain, '', $record->name);
                        echo strlen($name) > 20 ? substr($name, 0, 20).'...' : $name;
                        ?>
                    </code>
                </td>
                <td>
                    <code class="font-size-13">
                        <?php 
                        if($record->type === 'CNAME' || $record->type === 'MX' || $record->type === 'NS') {
                            // Rút gọn domain
                            echo strlen($record->content) > 30 ? substr($record->content, 0, 30).'...' : $record->content;
                        } else if($record->type === 'TXT') {
                            // Rút gọn nội dung TXT
                            echo strlen($record->content) > 40 ? substr($record->content, 0, 40).'...' : $record->content;
                        } else {
                            // Hiển thị đầy đủ cho A và AAAA records
                            echo $record->content;
                        }
                        ?>
                    </code>
                    <?php if($record->type === 'MX'): ?>
                        <span class="badge bg-light text-dark">Priority: <?= $record->priority ?></span>
                    <?php endif; ?>
                </td>
                <td><?= ($record->ttl == 1) ? 'Auto' : $record->ttl.'s' ?></td>
                <td>
                    <?php if($record->proxied): ?>
                        <span class="badge bg-success">Proxied</span>
                    <?php else: ?>
                        <span class="badge bg-secondary">DNS Only</span>
                    <?php endif; ?>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-warning btn-sm" 
                            onclick='editRecord(<?= json_encode($record) ?>)'
                            data-bs-toggle="tooltip" 
                            title="Click to view full content">
                        <i class="bx bx-edit"></i>
                    </button>
                    <form method="post" class="d-inline-block" 
                          onsubmit="return confirm('Are you sure you want to delete this record?')">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                        <input type="hidden" name="delete_record" value="1">
                        <input type="hidden" name="record_id" value="<?= $record->id ?>">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bx bx-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6" class="text-center">
                <div class="p-4">
                    <p class="text-muted mb-0">No DNS records found</p>
                </div>
            </td>
        </tr>
    <?php endif; ?>
</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Record Modal -->
<div class="modal fade" id="addRecordModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" id="addRecordForm">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                <input type="hidden" name="add_record" value="1">

                <div class="modal-header">
                    <h5 class="modal-title">Add DNS Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Record Type & Name -->
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label class="form-label">Record Type</label>
                            <select name="type" id="add_type" class="form-select" 
                                    onchange="updateRecordForm(this.value)" required>
                                <option value="A">A (IPv4)</option>
                                <option value="AAAA">AAAA (IPv6)</option>
                                <option value="CNAME">CNAME</option>
                                <option value="MX">MX</option>
                                <option value="TXT">TXT</option>
                            </select>
                        </div>
                        <div class="col-lg-8">
                            <label class="form-label">Name</label>
                            <div class="input-group">
                                <input type="text" name="name" class="form-control" 
                                       placeholder="@ for root domain" required>
                                <span class="input-group-text">.<?= $domain ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Content & TTL -->
                    <div class="row mb-3">
                        <div class="col-lg-8" id="content-container">
                            <!-- This will be dynamically replaced based on record type -->
                            <div class="mb-3">
                                <label class="form-label" id="content-label">IPv4 Address</label>
                                <div class="position-relative">
                                    <input type="text" name="content" id="add_content" 
                                           class="form-control" required 
                                           autocomplete="off"
                                           placeholder="Enter IP address">
                                    <div id="ipSuggestions" 
                                         class="position-absolute w-100 mt-1 shadow-sm d-none" 
                                         style="max-height: 200px; overflow-y: auto; z-index: 1050;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label">TTL</label>
                            <select name="ttl" class="form-select">
                                <option value="1">Auto</option>
                                <option value="300">5 minutes</option>
                                <option value="1800">30 minutes</option>
                                <option value="3600">1 hour</option>
                                <option value="86400">1 day</option>
                            </select>
                        </div>
                    </div>

                    <!-- Extra Fields -->
                    <div id="extra-fields"></div>

                    <!-- Proxy Toggle -->
                    <div class="mb-3 form-check form-switch" id="proxy-field">
                        <input class="form-check-input" type="checkbox" name="proxied" id="add_proxied" value="1">
                        <label class="form-check-label">Proxy through Cloudflare</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Record</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Record Modal -->
<div class="modal fade" id="editRecordModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                <input type="hidden" name="update_record" value="1">
                <input type="hidden" name="record_id" id="edit_record_id">

                <div class="modal-header">
                    <h5 class="modal-title">Edit DNS Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Record Type & Name -->  
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label class="form-label">Record Type</label>
                            <input type="text" id="edit_type" class="form-control" readonly>
                            <input type="hidden" name="type" id="edit_type_hidden">
                        </div>
                        <div class="col-lg-8">
                            <label class="form-label">Name</label>
                            <div class="input-group">
                                <input type="text" name="name" id="edit_name" class="form-control" required>
                                <span class="input-group-text">.<?= $domain ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Content & TTL -->
                    <div class="row mb-3">
                        <div class="col-lg-8">
                            <label class="form-label" id="edit_content_label">Content</label>
                            <div class="position-relative">
                                <input type="text" name="content" id="edit_content" class="form-control" required>
                                <div id="edit_ipSuggestions" class="position-absolute w-100 mt-1 shadow-sm d-none"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label">TTL</label>
                            <select name="ttl" id="edit_ttl" class="form-select">
                                <option value="1">Auto</option>
                                <option value="300">5 minutes</option>
                                <option value="1800">30 minutes</option>
                                <option value="3600">1 hour</option>
                                <option value="86400">1 day</option>
                            </select>
                        </div>
                    </div>

                    <!-- Extra Fields -->
                    <div id="edit_extra_fields"></div>

                    <!-- Proxy Toggle -->
                    <div class="form-check form-switch" id="edit_proxy_field">
                        <input class="form-check-input" type="checkbox" name="proxied" id="edit_proxied" value="1">
                        <label class="form-check-label">Proxy through Cloudflare</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
        <center><?php display_ad('footer'); ?></center>
    </div>
</div>

<?php $this->load->view($this->base->get_template().'/page/includes/user/dns_record_script.php', [
    'domain' => $domain,
    'server_ips' => $server_ips
]); ?>