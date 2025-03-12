<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Row -->
            <div class="row">
                <div class="col-12">
                  <!-- Card Add Domain -->
<div class="card mb-3">
    <div class="card-header">
        <h4 class="card-title mb-0">Add Extension</h4>
    </div>
    <div class="card-body">
        <form action="<?= base_url('domain/list') ?>" method="GET">
            <div class="row align-items-center">
                <div class="col">
                    <input type="text" name="domain" class="form-control" placeholder="Domain name...">
                </div>
                <div class="col-auto">
                    <input type="hidden" name="add_domain" value="true">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>

                    <!-- Card Domain List -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Total Extensions</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th width="90%">Domain</th>
                                            <th width="5%" class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($list)>0): ?>
                                            <?php $count = 1 ?>
                                            <?php foreach ($list as $item): ?>
                                                <tr>
                                                    <td><?= $count ?></td>
                                                    <td><?= $item['domain_name'] ?></td>
                                                    <td class="text-end">
                                                        <a href="?rm_domain=true&domain=<?= $item['domain_name'] ?>" 
                                                           class="btn btn-danger btn-sm">Delete</a>
                                                    </td>
                                                </tr>
                                                <?php $count += 1 ?>
                                            <?php endforeach ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="3" class="text-center">Nothing found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span class="text-muted"><?= count($list) ?> Domains</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>