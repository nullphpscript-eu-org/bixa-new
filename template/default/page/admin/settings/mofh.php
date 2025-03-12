<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">MOFH Settings</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?= form_open('api/settings/mofh') ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control mb-2" value="<?= $this->mofh->get_username() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Password</label>
                                    <input type="text" name="password" class="form-control mb-2" value="<?= $this->mofh->get_password() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">cPanel URL</label>
                                    <input type="text" name="cpanel" class="form-control mb-2" value="<?= $this->mofh->get_cpanel() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Nameserver 1</label>
                                    <input type="text" name="ns_1" class="form-control mb-2" value="<?= $this->mofh->get_ns_1() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Nameserver 2</label>
                                    <input type="text" name="ns_2" class="form-control mb-2" value="<?= $this->mofh->get_ns_2() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Package</label>
                                    <input type="text" name="package" class="form-control mb-2" value="<?= $this->mofh->get_package() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Shared IP</label>
                                    <input type="text" name="ip" class="form-control mb-2" value="<?= gethostbyname($_SERVER['HTTP_HOST']); ?>" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Callback URL</label>
                                    <input type="text" name="callback" class="form-control mb-2" value="<?= base_url() ?>c/mofh" readonly>
                                </div>
                                <div class="col-sm-12">
                                    <input type="submit" name="update_mofh" value="Update Settings" class="btn btn-primary waves-effect waves-light me-2">
                                    <a href="?test_mofh=true" class="btn btn-success waves-effect waves-light">Test Connection</a>
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

