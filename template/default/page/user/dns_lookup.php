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

            <!-- Form Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?= $this->base->text($title, 'title') ?></h4>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url() ?>dns/lookup" method="GET">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="domain" class="form-control" 
                                               placeholder="<?= $this->base->text('domain_name', 'label') ?>"
                                               value="<?php if ($this->input->get('domain')): echo(strtolower($this->input->get('domain'))); endif ?>" 
                                               required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <select name="type" class="form-select">
                                            <option>A</option>
                                            <option>AAAA</option>
                                            <option>CNAME</option>
                                            <option>TXT</option>
                                            <option>MX</option>
                                            <option>NS</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" name="lookup" class="btn btn-primary waves-effect waves-light">
                                            <i data-feather="search" class="me-2"></i><?= $this->base->text('lookup', 'button') ?>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Results Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?= $this->base->text('search_result', 'heading') ?></h4>
                        </div>
                        <?php if ($this->input->get('domain')): ?>
                            <?php @$dns = dns_get_record($this->input->get('domain'), $type[$this->input->get('type')]); ?>
                            <?php if ($dns): ?>
                                <div class="table-responsive">
                                    <table class="table table-hover table-nowrap mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <?php foreach ($fields[$this->input->get('type')] as $value): ?>
                                                    <th><?= $value ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($dns as $key => $record): ?>
                                                <tr>
                                                    <?php foreach ($fields[$this->input->get('type')] as $field => $value): ?>
                                                        <td><?= $dns[$key][$field] ?></td>
                                                    <?php endforeach ?>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="card-body">
                                    <div class="alert alert-danger mb-0" role="alert">
                                        <i data-feather="alert-circle" class="me-2"></i>
                                        <?= $this->base->text('cant_lookup', 'error') ?>
                                    </div>
                                </div>
                            <?php endif ?>
                        <?php else: ?>
                            <div class="card-body">
                                <div class="alert alert-info mb-0" role="alert">
                                    <i data-feather="info" class="me-2"></i>
                                    <?= $this->base->text('search_note', 'paragraph') ?>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>