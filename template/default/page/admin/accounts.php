<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Hosting Accounts</h4>
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Active Accounts</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="15%">Username</th>
                                            <th width="75%">Label</th>
                                            <th width="10%">Status</th>
                                            <th width="10%" class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($list) > 0) : ?>
                                            <?php
                                            if ($this->input->get('page')) :
                                                $mcount = $this->base->rpp() * $this->input->get('page') + 1;
                                            else :
                                                $mcount = 1;
                                            endif;
                                            ?>
                                            <?php foreach ($list as $item) : ?>
                                                <tr>
                                                    <td><?= $item['account_username'] ?></td>
                                                    <td><?= $item['account_label'] ?></td>
                                                    <td>
                                                        <?php if ($item['account_status'] == 'pending' or $item['account_status'] == 'deactivating' or $item['account_status'] == 'reactivating') : ?>
                                                            <span class="badge bg-warning">
                                                                <i data-feather="loader" class="font-size-12 align-middle me-1"></i><?= $item['account_status'] ?>
                                                            </span>
                                                            <?php $btn = ['settings', 'btn-warning'] ?>
                                                        <?php elseif ($item['account_status'] == 'active') : ?>
                                                            <span class="badge bg-success">
                                                                <i data-feather="globe" class="font-size-12 align-middle me-1"></i><?= $item['account_status'] ?>
                                                            </span>
                                                            <?php $btn = ['globe', 'btn-success'] ?>
                                                        <?php elseif ($item['account_status'] == 'deactivated' or $item['account_status'] == 'suspended') : ?>
                                                            <span class="badge bg-danger">
                                                                <i data-feather="lock" class="font-size-12 align-middle me-1"></i><?= $item['account_status'] ?>
                                                            </span>
                                                            <?php $btn = ['lock', 'btn-danger'] ?>
                                                        <?php endif ?>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="<?= base_url() . 'admin/account/view/' . $item['account_username'] ?>" 
                                                           class="btn <?= $btn[1] ?> btn-sm waves-effect waves-light">
                                                            <i data-feather="<?= $btn[0] ?>" class="font-size-12 align-middle me-1"></i>Manage
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $count += 1; ?>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="4" class="text-center">Nothing to show</td>
                                            </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="row mt-3">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info mb-3 mb-md-0">
                                        Showing <?php if (isset($mcount)) : echo $mcount;
                                                else : echo 0;
                                                endif; ?> to <?php if (isset($count)) : echo $count - 1;
                                                            else : echo 0;
                                                            endif; ?> of <?= $this->account->list_count() ?> entries
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="d-flex justify-content-end">
                                        <?php $page = $this->input->get('page') ?? 0 ?>
                                        <ul class="pagination pagination-rounded mb-0">
                                            <li class="page-item <?php if ($page < 1) : ?>disabled<?php endif ?>">
                                                <a class="page-link" <?php if ($page > 0) : ?>href="<?= base_url() ?>admin/account/list?page=<?= $page - 1 ?>"<?php endif ?>>
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </a>
                                            </li>
                                            <li class="page-item <?php if (($page + 1) * $this->base->rpp() >= $this->account->list_count()) : ?>disabled<?php endif ?>">
                                                <a class="page-link" <?php if (($page + 1) * $this->base->rpp() < $this->account->list_count()) : ?>href="<?= base_url() ?>admin/account/list?page=<?= $page + 1 ?>"<?php endif ?>>
                                                    <i class="mdi mdi-chevron-right"></i>
                                                </a>
                                            </li>
                                        </ul>
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