<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Support Tickets</h4>
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Pending Support Tickets</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th width="65%">Subject</th>
                                            <th width="10%" class="text-center">Date</th>
                                            <th width="10%" class="text-center">Client</th>
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
                                                    <td><?php echo $count = $count ?? $mcount ?></td>
                                                    <td><?= $item['ticket_subject'] ?></td>
                                                    <td class="text-center"><?= date('d-m-Y', $item['ticket_time']) ?></td>
                                                    <td class="text-center"><?= $this->ticket->get_user_name($item['ticket_for']) ?></td>
                                                    <td>
                                                        <?php if ($item['ticket_status'] == 'open') : ?>
                                                            <span class="badge bg-warning">
                                                                <i data-feather="clock" class="font-size-12 align-middle me-1"></i><?= $item['ticket_status'] ?>
                                                            </span>
                                                            <?php $btn = ['clock', 'btn-warning'] ?>
                                                        <?php elseif ($item['ticket_status'] == 'support' or $item['ticket_status'] == 'customer') : ?>
                                                            <span class="badge bg-success">
                                                                <i data-feather="mail" class="font-size-12 align-middle me-1"></i><?= $item['ticket_status'] ?>
                                                            </span>
                                                            <?php $btn = ['mail', 'btn-success'] ?>
                                                        <?php elseif ($item['ticket_status'] == 'closed') : ?>
                                                            <span class="badge bg-danger">
                                                                <i data-feather="lock" class="font-size-12 align-middle me-1"></i><?= $item['ticket_status'] ?>
                                                            </span>
                                                            <?php $btn = ['lock', 'btn-danger'] ?>
                                                        <?php endif ?>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="<?= base_url() . 'admin/ticket/view/' . $item['ticket_key'] ?>" 
                                                           class="btn <?= $btn[1] ?> btn-sm waves-effect waves-light">
                                                            <i data-feather="<?= $btn[0] ?>" class="font-size-12 align-middle me-1"></i>Manage
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $count += 1; ?>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="6" class="text-center">Nothing to show</td>
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
                                                            endif; ?> of <?= $this->ticket->list_count() ?> entries
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="d-flex justify-content-end">
                                        <?php $page = $this->input->get('page') ?? 0 ?>
                                        <ul class="pagination pagination-rounded mb-0">
                                            <li class="page-item <?php if ($page < 1) : ?>disabled<?php endif ?>">
                                                <a class="page-link" <?php if ($page > 0) : ?>href="<?= base_url() ?>admin/ticket/list?page=<?= $page - 1 ?>"<?php endif ?>>
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </a>
                                            </li>
                                            <li class="page-item <?php if (($page + 1) * $this->base->rpp() >= $this->ticket->list_count()) : ?>disabled<?php endif ?>">
                                                <a class="page-link" <?php if (($page + 1) * $this->base->rpp() < $this->ticket->list_count()) : ?>href="<?= base_url() ?>admin/ticket/list?page=<?= $page + 1 ?>"<?php endif ?>>
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