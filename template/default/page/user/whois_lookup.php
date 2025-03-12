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

            <!-- Form Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?= $this->base->text($title, 'title') ?></h4>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url() ?>whois/lookup" method="GET">
                                <div class="mb-3">
                                    <input type="text" name="domain" class="form-control form-control-lg" 
                                           placeholder="<?= $this->base->text('domain_name', 'label') ?>"
                                           value="<?php if ($this->input->get('domain')): echo(strtolower($this->input->get('domain'))); endif ?>" 
                                           required>
                                </div>
                                <button type="submit" name="lookup" class="btn btn-primary waves-effect waves-light">
                                    <i data-feather="search" class="me-2"></i><?= $this->base->text('lookup', 'button') ?>
                                </button>
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
                            <?php if (validateDomain($this->input->get('domain'))): ?>
                                <pre class="card-body bg-light mb-0" style="max-height: 500px; overflow: auto;">
                                    <?= trim(lookUpDomain($this->input->get('domain'))) ?>
                                </pre>
                            <?php else: ?>
                                <div class="card-body">
                                    <div class="alert alert-danger mb-0">
                                        <i data-feather="alert-circle" class="me-2"></i>
                                        <?= $this->base->text('invalid_domain', 'error') ?>
                                    </div>
                                </div>
                            <?php endif ?>
                        <?php else: ?>
                            <div class="card-body">
                                <div class="alert alert-info mb-0">
                                    <i data-feather="info" class="me-2"></i>
                                    <?= $this->base->text('search_note', 'paragraph') ?>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <center><?php display_ad('footer'); ?></center>
        </div>
    </div>
</div>