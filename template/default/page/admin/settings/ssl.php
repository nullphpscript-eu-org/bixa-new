<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Tiêu đề trang -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">SSL Settings</h4>
                    </div>
                </div>
            </div>

            <!-- SSL Provider Settings -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?= form_open('api/settings/ssl') ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-label">SSL Type</label>
                                    <select class="form-control mb-2" name="type">
                                        <option value="1" selected="true">GoGetSSL</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control mb-2" value="<?= $this->ssl->get_username() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Password</label>
                                    <input type="text" name="password" class="form-control mb-2" value="<?= $this->ssl->get_password() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Status</label>
                                    <select class="form-control mb-2" name="status">
                                        <option value="1" <?= $this->ssl->get_status() === 'active' ? 'selected' : '' ?>>Active</option>
                                        <option value="0" <?= $this->ssl->get_status() !== 'active' ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <input type="submit" name="update_ssl" value="Change" class="btn btn-primary waves-effect waves-light mb-4">
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ACME SSL Settings -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?= form_open('api/settings/ssl') ?>                            
                            <div class="row">
                                <div class="hr-text text-success">Let's Encrypt</div>
                                <div class="col-sm-12">
                                    <label class="form-label">Directory URL</label>
                                    <input type="text" name="letsencrypt" class="form-control mb-2" value="<?= $this->acme->get_letsencrypt() ?>">
                                </div>

                                <div class="hr-text text-success">ZeroSSL</div>
                                <?php
                                    $zerossl = $this->acme->get_zerossl();
                                    if ($zerossl == 'not-set') {
                                        $zerossl = [
                                            'url' => '',
                                            'eab_kid' => '',
                                            'eab_hmac_key' => ''
                                        ];
                                    }
                                ?>
                                <div class="col-sm-6">
                                    <label class="form-label">Directory URL</label>
                                    <input type="text" name="zerossl_url" class="form-control mb-2" value="<?= $zerossl['url'] ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">EAB Key ID</label>
                                    <input type="text" name="zerossl_kid" class="form-control mb-2" value="<?= $zerossl['eab_kid'] ?>">
                                </div>
                                <div class="col-sm-12">
                                    <label class="form-label">EAB HMAC Key</label>
                                    <input type="text" name="zerossl_hmac" class="form-control mb-2" value="<?= $zerossl['eab_hmac_key'] ?>">
                                </div>

                                <div class="hr-text text-success">Google Trust</div>
                                <?php
                                    $googletrust = $this->acme->get_googletrust();
                                    if ($googletrust == 'not-set') {
                                        $googletrust = [
                                            'url' => '',
                                            'eab_kid' => '',
                                            'eab_hmac_key' => ''
                                        ];
                                    }
                                ?>
                                <div class="col-sm-6">
                                    <label class="form-label">Directory URL</label>
                                    <input type="text" name="googletrust_url" class="form-control mb-2" value="<?= $googletrust['url'] ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">EAB Key ID</label>
                                    <input type="text" name="googletrust_kid" class="form-control mb-2" value="<?= $googletrust['eab_kid'] ?>">
                                </div>
                                <div class="col-sm-12">
                                    <label class="form-label">EAB HMAC Key</label>
                                    <input type="text" name="googletrust_hmac" class="form-control mb-2" value="<?= $googletrust['eab_hmac_key'] ?>">
                                </div>

                                <div class="hr-text text-success">ACME</div>
                                <?php
                                    $dnsSettings = $this->acme->get_dns();
                                ?>
                                <div class="col-sm-6">
                                    <label class="form-label">DNS over HTTPS</label>
                                    <select class="form-control mb-2" name="dns_doh">
                                        <option value="active" <?= $dnsSettings['doh'] === 'active' ? 'selected' : '' ?>>Active</option>
                                        <option value="inative" <?= $dnsSettings['doh'] !== 'active' ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                    <p>Use DNS over HTTPS to avoid problems if you are using free hosting.</p>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">DNS Resolver</label>
                                    <input type="text" name="dns_resolver" class="form-control mb-2" value="<?= $dnsSettings['resolver'] ?>">
                                    <p>DNS over HTTPS uses different hostname.</p>
                                    <p>Google Public DNS:</p>
                                    <ul>
                                        <li>Normal DNS: 8.8.8.8</li>
                                        <li>DNS over HTTPS: dns.google</li>
                                    </ul>
                                </div>
                                <div class="col-sm-12">
                                    <label class="form-label">Status</label>
                                    <select class="form-control mb-2" name="status">
                                        <option value="1" <?= $this->acme->get_status() === 'active' ? 'selected' : '' ?>>Active</option>
                                        <option value="0" <?= $this->acme->get_status() !== 'active' ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <input type="submit" name="update_acme" value="Change" class="btn btn-primary waves-effect waves-light">
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