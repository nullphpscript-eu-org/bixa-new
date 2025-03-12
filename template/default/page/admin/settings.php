<!-- Start main content wrapper -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Settings</h4>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="row">
                <div class="col-12">
                    <!-- General Settings Card -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="card-title">General Settings</h4>
                        </div>
                        <div class="card-body">
                            <?= form_open('admin/settings') ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="form-label">Your Name</label>
                                    <input type="text" name="name" class="form-control mb-3" value="<?= $this->admin->get_name() ?>">
                                    <div>
                                        <input type="submit" name="update_name" value="Update Settings" class="btn btn-primary waves-effect waves-light">
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>

                    <!-- Security Settings Card -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="card-title">Security Settings</h4>
                        </div>
                        <div class="card-body">
                            <?= form_open('admin/settings') ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="form-label">New Password</label>
                                    <input type="password" name="password" class="form-control mb-3" placeholder="Enter new password">
                                    
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password1" class="form-control mb-3" placeholder="Confirm new password">
                                    
                                    <label class="form-label">Old Password</label>
                                    <input type="password" name="old_password" class="form-control mb-3" placeholder="Enter current password">
                                    
                                    <div>
                                        <input type="submit" name="update_password" value="Update Settings" class="btn btn-primary waves-effect waves-light">
                                    </div>
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