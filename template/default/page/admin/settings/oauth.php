<!-- Start main content wrapper -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">OAuth Settings</h4>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- OAuth Tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#github" role="tab">GitHub</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#google" role="tab">Google</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#facebook" role="tab">Facebook</a>
                                </li>
                              <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#discord" role="tab">Discord</a>
</li>
<li class="nav-item">  
    <a class="nav-link" data-bs-toggle="tab" href="#microsoft" role="tab">Microsoft</a>
</li>
                            </ul>

                            <div class="tab-content p-3">
                                <!-- GitHub Settings -->
                                <div class="tab-pane active" id="github" role="tabpanel">
                                    <?= form_open('api/settings/oauth') ?>
                                        <input type="hidden" name="service" value="github">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="form-label">Client ID</label>
                                                <input type="text" name="client" class="form-control mb-2" value="<?= $this->oauth->get_client('github') ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Client Secret</label>
                                                <input type="text" name="secret" class="form-control mb-2" value="<?= $this->oauth->get_secret('github') ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Callback URL</label>
                                                <input type="text" class="form-control mb-2" value="<?= base_url('c/github_oauth') ?>" readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-control mb-2">
                                                    <option value="1" <?= $this->oauth->get_status('github') === 'active' ? 'selected' : '' ?>>Active</option>
                                                    <option value="0" <?= $this->oauth->get_status('github') !== 'active' ? 'selected' : '' ?>>Inactive</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="submit" name="update_oauth" value="Update Settings" class="btn btn-primary waves-effect waves-light">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Google Settings -->
                                <div class="tab-pane" id="google" role="tabpanel">
                                    <?= form_open('api/settings/oauth') ?>
                                        <input type="hidden" name="service" value="google">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="form-label">Client ID</label>
                                                <input type="text" name="client" class="form-control mb-2" value="<?= $this->oauth->get_client('google') ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Client Secret</label>
                                                <input type="text" name="secret" class="form-control mb-2" value="<?= $this->oauth->get_secret('google') ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Callback URL</label>
                                                <input type="text" class="form-control mb-2" value="<?= base_url('c/google_oauth') ?>" readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-control mb-2">
                                                    <option value="1" <?= $this->oauth->get_status('google') === 'active' ? 'selected' : '' ?>>Active</option>
                                                    <option value="0" <?= $this->oauth->get_status('google') !== 'active' ? 'selected' : '' ?>>Inactive</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="submit" name="update_oauth" value="Update Settings" class="btn btn-primary waves-effect waves-light">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Facebook Settings -->
                                <div class="tab-pane" id="facebook" role="tabpanel">
                                    <?= form_open('api/settings/oauth') ?>
                                        <input type="hidden" name="service" value="facebook">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="form-label">App ID</label>
                                                <input type="text" name="client" class="form-control mb-2" value="<?= $this->oauth->get_client('facebook') ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">App Secret</label>
                                                <input type="text" name="secret" class="form-control mb-2" value="<?= $this->oauth->get_secret('facebook') ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Callback URL</label>
                                                <input type="text" class="form-control mb-2" value="<?= base_url('c/facebook_oauth') ?>" readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-control mb-2">
                                                    <option value="1" <?= $this->oauth->get_status('facebook') === 'active' ? 'selected' : '' ?>>Active</option>
                                                    <option value="0" <?= $this->oauth->get_status('facebook') !== 'active' ? 'selected' : '' ?>>Inactive</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="submit" name="update_oauth" value="Update Settings" class="btn btn-primary waves-effect waves-light">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                  <div class="tab-pane" id="discord" role="tabpanel">
    <?= form_open('api/settings/oauth') ?>
        <input type="hidden" name="service" value="discord">
        <div class="row">
            <div class="col-sm-6">
                <label class="form-label">Client ID</label>
                <input type="text" name="client" class="form-control mb-2" value="<?= $this->oauth->get_client('discord') ?>">
            </div>
            <div class="col-sm-6">
                <label class="form-label">Client Secret</label>
                <input type="text" name="secret" class="form-control mb-2" value="<?= $this->oauth->get_secret('discord') ?>">
            </div>
            <div class="col-sm-6">
                <label class="form-label">Callback URL</label>
                <input type="text" class="form-control mb-2" value="<?= base_url('c/discord_oauth') ?>" readonly>
            </div>
            <div class="col-sm-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-control mb-2">
                    <option value="1" <?= $this->oauth->get_status('discord') === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="0" <?= $this->oauth->get_status('discord') !== 'active' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
            <div class="col-sm-12">
                <input type="submit" name="update_oauth" value="Update Settings" class="btn btn-primary waves-effect waves-light">
            </div>
        </div>
    </form>
</div>

<div class="tab-pane" id="microsoft" role="tabpanel">
    <?= form_open('api/settings/oauth') ?>
        <input type="hidden" name="service" value="microsoft"> 
        <div class="row">
            <div class="col-sm-6">
                <label class="form-label">Client ID</label>
                <input type="text" name="client" class="form-control mb-2" value="<?= $this->oauth->get_client('microsoft') ?>">
            </div>
            <div class="col-sm-6">
                <label class="form-label">Client Secret</label>
                <input type="text" name="secret" class="form-control mb-2" value="<?= $this->oauth->get_secret('microsoft') ?>">
            </div>
            <div class="col-sm-6">
                <label class="form-label">Callback URL</label>
                <input type="text" class="form-control mb-2" value="<?= base_url('c/microsoft_oauth') ?>" readonly>
            </div>
            <div class="col-sm-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-control mb-2">
                    <option value="1" <?= $this->oauth->get_status('microsoft') === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="0" <?= $this->oauth->get_status('microsoft') !== 'active' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
            <div class="col-sm-12">
                <input type="submit" name="update_oauth" value="Update Settings" class="btn btn-primary waves-effect waves-light">
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
    </div>
</div>
<!-- end main content wrapper -->