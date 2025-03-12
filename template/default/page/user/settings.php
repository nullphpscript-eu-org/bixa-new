<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
        <center><?php display_ad('header'); ?></center>
            <!-- Page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"><?= $this->base->text($title, 'title') ?></h4>
                    </div>
                </div>
            </div>

            <!-- Name Settings -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="card-title mb-0">Personal Information</h4>
                                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="editProfile()">
                                <i data-feather="edit-2" class="me-1" width="15px" height="15px"></i> Edit Profile
                                </button>
                            </div>
                            <div id="viewProfile" style="display: block;">
                                <div class="row">
                                    <div class="col-lg-3 col-md-4">
                                        <div class="text-center mb-4">
                                            <img src="<?= $this->user->get_avatar() ?>" alt="user-image" class="rounded-circle avatar-xl img-thumbnail">
                                            <div class="mt-3">
                                                <p class="text-muted mb-1">
                                                    Profile picture managed by <a href="https://gravatar.com" target="_blank">Gravatar</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                        <div class="table-responsive">
                                            <table class="table table-nowrap mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row" style="width: 30%;">Full Name:</th>
                                                        <td><?= $this->user->get_name() ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Email:</th>
                                                        <td><?= $this->user->get_email() ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Joined Date:</th>
                                                        <td><?= date('d-m-Y', $info['user_date']) ?></td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div id="editProfile" style="display: none;">  
                                <?= form_open('settings', ['class' => 'needs-validation']) ?>
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label"><?= $this->base->text('your_name', 'label') ?></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control" 
                                                value="<?= $this->user->get_name() ?>" 
                                                placeholder="<?= $this->base->text('your_name', 'label') ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <p class="form-control-plaintext"><?= $this->user->get_email() ?></p>
                                            <small class="text-muted">Email cannot be changed. Profile picture is managed through <a href="https://gravatar.com" target="_blank">Gravatar</a>.</small>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-sm-9">
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="submit" name="update_name" class="btn btn-primary waves-effect waves-light" value="change">
                                                <i data-feather="save" class="me-1" width="15px" height="15px"></i> Save Changes  
                                                </button>
                                                <button type="button" name="" class="btn btn-secondary waves-effect waves-light" onclick="viewProfile()">
                                                <i data-feather="x" class="me-1" width="15px" height="15px"></i> Cancel  
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
                <!-- Security Settings -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">                       
                            <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="card-title mb-0">Change Password</h4>
                                </div>

                                    <?= form_open('settings', ['class' => 'needs-validation']) ?>
                                        <?php if ($this->oauth->is_active('github')): ?>
                                            <a href="?enable_oauth=true" class="btn btn-dark w-100 mb-3">
                                                <i data-feather="github" class="me-1"></i>
                                                <?= $this->base->text('github_signin', 'button') ?>
                                            </a>
                                        <?php endif ?>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label"><?= $this->base->text('new_password', 'label') ?></label>
                                            <div class="col-sm-9">
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="<?= $this->base->text('new_password', 'label') ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label"><?= $this->base->text('confirm_password', 'label') ?></label>
                                            <div class="col-sm-9"> 
                                                <input type="password" name="password1" class="form-control"
                                                    placeholder="<?= $this->base->text('confirm_password', 'label') ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label"><?= $this->base->text('old_password', 'label') ?></label>
                                            <div class="col-sm-9">
                                                <input type="password" name="old_password" class="form-control" 
                                                    placeholder="<?= $this->base->text('old_password', 'label') ?>">
                                            </div>
                                        </div>
                                        <button type="submit" name="update_password" class="btn btn-primary waves-effect waves-light" value="Change">
                                            <i data-feather="key" class="me-1" width="15px" height="15px"></i>Change Password
                                        </button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <center><?php display_ad('footer'); ?></center>
        </div>
</div>
<script>
    function editProfile() {
    const editProfile = document.getElementById('editProfile');
    const viewProfile = document.getElementById('viewProfile');
    
    if(editProfile.style.display !== 'none') {
        editProfile.style.display = 'none';
        viewProfile.style.display = 'block';
    } else {
        editProfile.style.display = 'block';
        viewProfile.style.display = 'none';
    }
}

function viewProfile() {
    const editProfile = document.getElementById('editProfile');
    const viewProfile = document.getElementById('viewProfile');
    
    if(editProfile.style.display !== 'none') {
        editProfile.style.display = 'none';
        viewProfile.style.display = 'block';
    } else {
        editProfile.style.display = 'block';
        viewProfile.style.display = 'none';
    }
}
</script>
