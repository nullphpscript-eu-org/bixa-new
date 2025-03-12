<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img src="<?= $this->user->get_user_avatar($info['user_key']) ?>" class="rounded img-fluid">
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted">ID:</label>
                                            <div><?= char8($info['user_id'].':'.$info['user_date'].':'.$info['user_key']) ?></div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted">Name:</label>
                                            <div><?= $info['user_name'] ?></div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted">Email:</label>
                                            <div><?= $info['user_email'] ?></div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted">Secret Key:</label>
                                            <div><?= $info['user_key'] ?></div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted">Login Agent:</label>
                                            <div>
                                                <?php if ($this->user->get_oauth($info['user_key'])): ?>
                                                    Oauth
                                                <?php else: ?>
                                                    Built-in
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted">Status:</label>
                                            <div>
                                                <?php if ($info['user_status'] == 'inactive'): ?>
                                                    <span class="badge bg-warning">inactive</span>
                                                <?php elseif ($info['user_status'] == 'active'): ?>
                                                    <span class="badge bg-success">active</span>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted">Registered:</label>
                                            <div><?= date('d-m-Y', $info['user_date']) ?></div>
                                        </div>
                                        <div class="col-12">
                                            <?php if($info['user_status'] !== 'active'): ?>
                                                <a href="?active=true" class="btn btn-success">Activate</a>
                                            <?php endif ?>
                                            <a href="?login=true" class="btn btn-primary">Login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>