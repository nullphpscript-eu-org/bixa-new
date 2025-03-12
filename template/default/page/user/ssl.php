<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"><?= $this->base->text($title, 'title') ?></h4>
                        <div class="page-title-right">
                            <a href="<?= base_url() ?>u/create_ssl" class="btn btn-primary waves-effect waves-light">
                                <i data-feather="plus" class="me-1"></i><?= $this->base->text('create', 'button') ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SSL Certificates Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0"><?= $this->base->text('your_certificates', 'heading') ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="5%"><?= $this->base->text('id', 'table') ?></th>
                                            <th width="65%"><?= $this->base->text('domain', 'table') ?></th>
                                            <th width="10%"><?= $this->base->text('method', 'table') ?></th>
                                            <th width="10%"><?= $this->base->text('provider', 'table') ?></th>
                                            <th width="10%"><?= $this->base->text('status', 'table') ?></th>
                                            <th width="10%" class="text-center"><?= $this->base->text('action', 'table') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($list) > 0): ?>
                                            <?php foreach ($list as $item): ?>
                                                <tr>
                                                    <td><?php echo $count = $count ?? 1 ?></td>
                                                    <td><?= $item['domain'] ?></td>
                                                    <td>DNS</td>
                                                    <td><?= $item['type'] ?></td>
                                                    <td>
                                                        <?php if ($item['status'] == 'processing' || $item['status'] == 'pending'): ?>
                                                            <span class="badge badge-soft-warning">
                                                                <i data-feather="clock" class="me-1"></i>
                                                                <?= $this->base->text($item['status'], 'table') ?>
                                                            </span>
                                                            <?php $btn = ['loader', 'btn-warning'] ?>
                                                        <?php elseif ($item['status'] == 'active' || $item['status'] == 'ready'): ?>
                                                            <span class="badge badge-soft-success">
                                                                <i data-feather="check-circle" class="me-1"></i>
                                                                <?= $this->base->text($item['status'], 'table') ?>
                                                            </span>
                                                            <?php $btn = ['shield', 'btn-success'] ?>
                                                        <?php elseif ($item['status'] == 'cancelled' or $item['status'] == 'expired'): ?>
                                                            <span class="badge badge-soft-danger">
                                                                <i data-feather="x-circle" class="me-1"></i>
                                                                <?= $this->base->text($item['status'], 'table') ?>
                                                            </span>
                                                            <?php $btn = ['lock', 'btn-danger'] ?>
                                                        <?php endif ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="<?= base_url() . 'ssl/view/' . $item['key'] ?>" 
                                                           class="btn btn-sm waves-effect waves-light <?= $btn[1] ?>">
                                                            <i data-feather="<?= $btn[0] ?>" class="me-1"></i>
                                                            <?= $this->base->text('manage', 'button') ?>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $count += 1; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    <div class="py-4 text-muted">
                                                        <i data-feather="inbox" class="icon-dual icon-xl"></i>
                                                        <p class="mt-3"><?= $this->base->text('nothing_to_show', 'paragraph') ?></p>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="mt-3">
                                <span class="badge bg-info">
                                    <?= count($list) ?> <?= $this->base->text('ssl_certificates', 'heading') ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Initialize feather icons -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
});
</script>