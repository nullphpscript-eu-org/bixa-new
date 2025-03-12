<!-- Start main content wrapper -->
<div class="main-content">

    <div class="page-content">

        <div class="container-fluid">

            <!-- Statistics Cards Row -->
            <center><?php display_ad('header'); ?></center>
            <div class="row">

                <div class="col-xl-4">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex align-items-start">

                                <div class="flex-grow-1">

                                    <h5 class="card-title mb-3">FREE ACCOUNTS</h5>

                                    <h2 class="mb-2"><?= $account_count ?></h2>

                                    <a href="<?= base_url() ?>u/accounts" class="text-primary d-inline-block">

                                        View accounts

                                        <i class="mdi mdi-chevron-right"></i>

                                    </a>

                                </div>

                                <div class="flex-shrink-0">

                                    <div class="avatar-sm rounded-circle bg-primary">

                                        <span class="avatar-title">

                                            <i data-feather="hard-drive" class="font-size-24"></i>

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="col-xl-4">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex align-items-start">

                                <div class="flex-grow-1">

                                    <h5 class="card-title mb-3">SSL CERTIFICATES</h5>

                                    <h2 class="mb-2"><?= $ssl_count ?></h2>

                                    <a href="<?= base_url() ?>u/ssl" class="text-primary d-inline-block">

                                        View SSL

                                        <i class="mdi mdi-chevron-right"></i>

                                    </a>

                                </div>

                                <div class="flex-shrink-0">

                                    <div class="avatar-sm rounded-circle bg-success">

                                        <span class="avatar-title">

                                            <i data-feather="shield" class="font-size-24"></i>

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="col-xl-4">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex align-items-start">

                                <div class="flex-grow-1">

                                    <h5 class="card-title mb-3">SUPPORT TICKETS</h5>

                                    <h2 class="mb-2"><?= $ticket_count ?></h2>

                                    <a href="<?= base_url() ?>u/tickets" class="text-primary d-inline-block">

                                        View tickets

                                        <i class="mdi mdi-chevron-right"></i>

                                    </a>

                                </div>

                                <div class="flex-shrink-0">

                                    <div class="avatar-sm rounded-circle bg-info">

                                        <span class="avatar-title">

                                            <i data-feather="life-buoy" class="font-size-24"></i>

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Content Row -->

            <div class="row">

                <!-- Account List Card -->

                <div class="col-lg-8">

                    <div class="card">

                        <div class="card-body">

                            <h4 class="card-title mb-4">Account List</h4>

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

                                        <?php if (count($accounts) > 0) : ?>

                                            <?php foreach ($accounts as $key => $item) : ?>

                                            <tr>

                                                <td><?= $key + 1 ?></td>

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

                                            <?php endforeach; ?>

                                        <?php else : ?>

                                            <tr>

                                                <td colspan="5" class="text-center"><?= $this->base->text('nothing_to_show', 'paragraph') ?></td>

                                            </tr>

                                        <?php endif ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>



                <!-- Announcements Card -->

                <div class="col-lg-4">

                    <div class="card">

                        <div class="card-body">

                            <h4 class="card-title mb-4">Announcements</h4>

                            <div class="announcement-list">

                                <?php foreach ($announcements as $announcement): ?>

                                <div class="announcement-item mb-3">

                                    <p class="text-muted mb-2"><?= $announcement['message'] ?></p>

                                </div>

                                <?php endforeach; ?>

                            </div>

                        </div>

                    </div>

                </div>

                
                <center><?php display_ad('footer'); ?></center>
            </div>

        </div>

    </div>

</div>

<!-- end main content wrapper -->