<!-- Start main content wrapper -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Site Settings</h4>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?= form_open('admin/site') ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-label">Host Name</label>
                                    <input type="text" name="hostname" class="form-control mb-2" value="<?= $this->base->get_hostname() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Logo URL</label>
                                    <input type="text" name="slogo" class="form-control mb-2" value="<?= $this->base->get_slogo() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Favicon URL</label>
                                    <input type="text" name="favicon" class="form-control mb-2" value="<?= $this->base->get_favicon() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Alert Email</label>
                                    <input type="text" name="email" class="form-control mb-2" value="<?= $this->base->get_email() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Forum URL</label>
                                    <input type="text" name="fourm" class="form-control mb-2" value="<?= $this->base->get_fourm() ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Host Status</label>
                                    <select class="form-control mb-2" name="status">
                                        <option value="1" <?= $this->base->get_status() === 'active' ? 'selected' : '' ?>>Active</option>
                                        <option value="0" <?= $this->base->get_status() !== 'active' ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Template Dir</label>
                                    <select class="form-control mb-2" name="template">
                                        <?php foreach (get_templates() as $dir) : ?>
                                            <option value="<?= $dir['dir'] ?>" <?= $dir['dir'] == $this->base->get_template() ? 'selected' : '' ?>>
                                                <?= $dir['name'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Records Per Page</label>
                                    <input type="number" name="rpp" class="form-control mb-2" value="<?= $this->base->rpp() ?>">
                                </div>
                                <div class="col-sm-12">
                                    <input type="submit" name="update_host" value="Update Settings" class="btn btn-primary waves-effect waves-light">
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