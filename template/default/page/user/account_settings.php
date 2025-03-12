<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"><?= $this->base->text($title, 'title') ?></h4>
                    </div>
                </div>
            </div>
<?php 
if($this->session->flashdata('msg')): 
    $msg = json_decode($this->session->flashdata('msg'), true);
    $this->session->unset_userdata('msg');
?>
    <div class="alert alert-<?= $msg[0] ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
        <?= $msg[1] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
            <div class="row">
                <!-- Left Column -->
                <div class="col-xl-6">
                    <!-- General Settings -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="card-title mb-0"><?= $this->base->text('general', 'heading') ?></h4>
                        </div>
                        <div class="card-body">
                            <?= form_open('account/settings/'.$id) ?>
                                <div class="mb-3">
                                    <label class="form-label"><?= $this->base->text('account_label', 'label') ?></label>
                                    <input type="text" name="label" class="form-control" 
                                           value="<?= $data['account_label'] ?>"
                                           placeholder="<?= $this->base->text('account_label', 'label') ?>">
                                </div>
                                <input type="submit" name="update_label" class="btn btn-primary waves-effect waves-light" 
                                       value="<?= $this->base->text('change', 'button') ?>">
                            </form>
                        </div>
                    </div>

                    <!-- Security Settings -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0"><?= $this->base->text('security', 'heading') ?></h4>
                        </div>
                        <div class="card-body">
                            <?= form_open('account/settings/'.$id) ?>
                                <div class="mb-3">
                                    <label class="form-label"><?= $this->base->text('new_password', 'label') ?></label>
                                    <input type="password" name="password" class="form-control" 
                                           placeholder="<?= $this->base->text('new_password', 'label') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><?= $this->base->text('old_password', 'label') ?></label>
                                    <input type="password" name="old_password" class="form-control" 
                                           placeholder="<?= $this->base->text('old_password', 'label') ?>">
                                </div>
                                <input type="submit" name="update_password" class="btn btn-primary waves-effect waves-light" 
                                       value="<?= $this->base->text('change', 'button') ?>">
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-xl-6">
                    <!-- Deactivation Card -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0"><?= $this->base->text('deactivation', 'heading') ?></h4>
                        </div>
                        <div class="card-body">
                            <?= form_open('account/settings/'.$id) ?>
                                <div class="alert alert-danger mb-3">
                                    <?= $this->base->text('account_warning', 'paragraph') ?>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><?= $this->base->text('reason', 'label') ?></label>
                                    <textarea name="reason" class="form-control" rows="4"
                                              placeholder="Please specify the reason you want to deactivate hosting, with at least 5 words."></textarea>
                                </div>
                                <input type="submit" name="deactivate" class="btn btn-danger waves-effect waves-light" 
                                       value="<?= $this->base->text('deactivate', 'button') ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>