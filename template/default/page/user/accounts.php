<!-- Start main content wrapper -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page title -->
             <center><?php display_ad('header'); ?></center>
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"><?= $this->base->text($title, 'title') ?></h4>
                        <?php if (count($list) < 3) : ?>
                        <div class="page-title-right">
                            <a href="<?= base_url() ?>u/create_account" class="btn btn-primary waves-effect waves-light">
                                <i data-feather="plus" class="font-size-16 align-middle me-2"></i> <?= $this->base->text('create', 'button') ?>
                            </a>
                        </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th><?= $this->base->text('username', 'label') ?></th>
                                            <th><?= $this->base->text('label', 'label') ?></th>
                                            <th><?= $this->base->text('status', 'label') ?></th>
                                            <th class="text-end"><?= $this->base->text('action', 'label') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($list) > 0) : ?>
                                            <?php foreach ($list as $item) : ?>
                                            <tr>
                                                <td><?php echo $count = $count ?? 1 ?></td>
                                                <td><?= $item['account_username'] ?></td>
                                                <td><?= $item['account_label'] ?></td>
                                                <td>
                                                    <?php if ($item['account_status'] == 'pending' or $item['account_status'] == 'deactivating' or $item['account_status'] == 'reactivating') : ?>
                                                        <span class="badge bg-warning">
                                                            <i data-feather="loader" class="font-size-14 align-middle me-1"></i>
                                                            <?= $this->base->text($item['account_status'], 'table') ?>
                                                        </span>
                                                    <?php elseif ($item['account_status'] == 'active') : ?>
                                                        <span class="badge bg-success">
                                                            <i data-feather="check-circle" class="font-size-14 align-middle me-1"></i>
                                                            <?= $this->base->text($item['account_status'], 'table') ?>
                                                        </span>
                                                    <?php else : ?>
                                                        <span class="badge bg-danger">
                                                            <i data-feather="x-circle" class="font-size-14 align-middle me-1"></i>
                                                            <?= $this->base->text($item['account_status'], 'table') ?>
                                                        </span>
                                                    <?php endif ?>
                                                </td>
                                                <td class="text-end">
                                                    <a href="<?= base_url() . 'account/view/' . $item['account_username'] ?>" 
                                                       class="btn btn-sm waves-effect waves-light
                                                       <?php 
                                                       if ($item['account_status'] == 'active') echo 'btn-success';
                                                       elseif ($item['account_status'] == 'pending' || $item['account_status'] == 'deactivating' || $item['account_status'] == 'reactivating') echo 'btn-warning';
                                                       else echo 'btn-danger';
                                                       ?>">
                                                        <i data-feather="settings" class="font-size-14 align-middle me-1"></i>
                                                        <?= $this->base->text('manage', 'button') ?>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php $count += 1; ?>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="5" class="text-center"><?= $this->base->text('nothing_to_show', 'paragraph') ?></td>
                                            </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <?php if (count($list) > 0) : ?>
                            <div class="mt-3">
                                <span class="badge bg-info"><?= count($list) ?> / 3 <?= $this->base->text('free_accounts', 'heading') ?></span>
                            </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <center><?php display_ad('footer'); ?></center>
        </div>
    </div>
</div>
<!-- end main content wrapper -->