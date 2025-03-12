<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
        <center><?php display_ad('header'); ?></center>
            <!-- Page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"><?= $this->base->text($title, 'title') ?></h4>
                        <div class="page-title-right">
                            <a href="<?= base_url() ?>u/create_ticket" class="btn btn-primary waves-effect waves-light">
                                <i data-feather="plus" class="me-1 align-middle"></i>
                                <?= $this->base->text('create', 'button') ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?= $this->base->text('your_tickets', 'heading') ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="5%"><?= $this->base->text('id', 'table') ?></th>
                                            <th width="75%"><?= $this->base->text('subject', 'table') ?></th>
                                            <th width="10%" class="text-center"><?= $this->base->text('date', 'table') ?></th>
                                            <th width="10%"><?= $this->base->text('status', 'table') ?></th>
                                            <th width="10%" class="text-center"><?= $this->base->text('action', 'table') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($list) > 0) : ?>
                                            <?php foreach ($list as $item) : ?>
                                                <tr>
                                                    <td><?php echo $count = $count ?? 1 ?></td>
                                                    <td><?= $item['ticket_subject'] ?></td>
                                                    <td class="text-center"><?= date('d-m-Y', $item['ticket_time']) ?></td>
                                                    <td>
                                                        <?php if ($item['ticket_status'] == 'open') : ?>
                                                            <span class="badge badge-soft-warning">
                                                                <i data-feather="clock" class="me-1"></i>
                                                                <?= $this->base->text($item['ticket_status'], 'table') ?>
                                                                <?php $btn = ['eye', 'btn-warning'] ?>
                                                            </span>
                                                        <?php elseif ($item['ticket_status'] == 'support' or $item['ticket_status'] == 'customer') : ?>
                                                            <span class="badge badge-soft-success">
                                                                <i data-feather="mail" class="me-1"></i>
                                                                <?= $this->base->text($item['ticket_status'], 'table') ?>
                                                                <?php $btn = ['message-square', 'btn-success'] ?>
                                                            </span>
                                                        <?php elseif ($item['ticket_status'] == 'closed') : ?>
                                                            <span class="badge badge-soft-danger">
                                                                <i data-feather="lock" class="me-1"></i>
                                                                <?= $this->base->text($item['ticket_status'], 'table') ?>
                                                                <?php $btn = ['lock', 'btn-danger'] ?>
                                                            </span>
                                                        <?php endif ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="<?= base_url() . 'ticket/view/' . $item['ticket_key'] ?>" 
                                                           class="btn btn-sm waves-effect waves-light <?= $btn[1] ?>">
                                                            <i data-feather="<?= $btn[0] ?>" class="me-1 align-middle"></i>
                                                            <?= $this->base->text('manage', 'button') ?>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $count += 1; ?>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <?= $this->base->text('nothing_to_show', 'paragraph') ?>
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="mt-3">
                                <span class="badge bg-info">
                                    <?= count($list) ?> <?= $this->base->text('support_tickets', 'heading') ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <center><?php display_ad('footer'); ?></center>
        </div>
    </div>
</div>