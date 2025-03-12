<!-- Start main content wrapper -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">SMTP Settings</h4>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?= form_open('api/settings/smtp') ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-label">Service Type</label>
                                    <select class="form-control mb-2" name="type">
                                        <option selected="true">SMTP</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Hostname</label>
                                    <input type="text" name="hostname" class="form-control mb-2" value="<?= $this->smtp->get_hostname() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control mb-2" value="<?= $this->smtp->get_username() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Password</label>
                                    <input type="text" name="password" class="form-control mb-2" value="<?= $this->smtp->get_password() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">From Email</label>
                                    <input type="text" name="from" class="form-control mb-2" value="<?= $this->smtp->get_from() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">From Name</label>
                                    <input type="text" name="name" class="form-control mb-2" value="<?= $this->smtp->get_name() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">SMTP Port</label>
                                    <input type="number" name="port" class="form-control mb-2" value="<?= $this->smtp->get_port() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">SMTP Encryption</label>
                                    <select class="form-control mb-2" name="encryption">
                                        <option value="ssl" <?= $this->smtp->get_encryption() === 'ssl' ? 'selected' : '' ?>>SSL</option>
                                        <option value="tls" <?= $this->smtp->get_encryption() === 'tls' ? 'selected' : '' ?>>TLS</option>
                                        <option value="none" <?= $this->smtp->get_encryption() === 'none' ? 'selected' : '' ?>>None</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">SMTP Status</label>
                                    <select class="form-control mb-2" name="status">
                                        <option value="1" <?= $this->smtp->get_status() === 'active' ? 'selected' : '' ?>>Active</option>
                                        <option value="0" <?= $this->smtp->get_status() !== 'active' ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <input type="submit" name="update_smtp" value="Change" class="btn btn-primary waves-effect waves-light">
                                    <a href="?test_mail=true" class="btn btn-success waves-effect waves-light">Test Connection</a>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end main content wrapper -->