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

            <div class="row">
                <!-- Search Form -->
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?= $this->base->text($title, 'title') ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <input type="text" id="domain" class="form-control" 
                                           placeholder="<?= $this->base->text('domain_name', 'label') ?>"
                                           value="<?php if ($domain !== false): echo($domain); endif ?>">
                                </div>
                                <div class="col-lg-2">
                                    <a href="#" id="search" class="btn btn-primary w-100">
                                        <i data-feather="search" class="me-1"></i> <?= $this->base->text('search', 'button') ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Results -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?= $this->base->text('search_result', 'heading') ?></h4>
                        </div>

                        <?php if($domain == false): ?>
                            <div class="card-body">
                                <div class="alert alert-info mb-0">
                                    <i data-feather="info" class="me-2"></i>
                                    <?= $this->base->text('search_note', 'paragraph') ?>
                                </div>
                            </div>
                        <?php elseif ($data !== false): ?>
                            <div class="table-responsive">
                                <table class="table table-nowrap mb-0">
                                    <tbody>
                                        <tr>
                                            <td><?= $this->base->text('account', 'heading') ?></td>
                                            <td class="text-end"><?= $data[3] ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= $this->base->text('status', 'heading') ?></td>
                                            <td class="text-end"><?= $data[0] ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= $this->base->text('nameserver', 'heading') ?> 1</td>
                                            <td class="text-end">
                                                <?php if ($data[0] === 'ACTIVE'): ?>
                                                    <span class="badge rounded-pill bg-success">
                                                        <?= $this->base->text('ok', 'label') ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge rounded-pill bg-danger">
                                                        <?= $this->base->text('error', 'label') ?>
                                                    </span>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= $this->base->text('nameserver', 'heading') ?> 2</td>
                                            <td class="text-end">
                                                <?php if ($data[0] === 'ACTIVE'): ?>
                                                    <span class="badge rounded-pill bg-success">
                                                        <?= $this->base->text('ok', 'label') ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge rounded-pill bg-danger">
                                                        <?= $this->base->text('error', 'label') ?>
                                                    </span>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="card-body">
                                <div class="alert alert-danger mb-0">
                                    <i data-feather="alert-circle" class="me-2"></i>
                                    <?= $this->base->text('search_error', 'paragraph') ?>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <center><?php display_ad('header'); ?></center>
        </div>
    </div>
</div>

<script>
document.getElementById('domain').addEventListener('input', function() {
    document.getElementById('search').href = '<?= base_url() ?>domain/checker/' + this.value;
});
</script>