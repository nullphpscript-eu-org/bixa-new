<!-- Main Content -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"><?= $this->base->text($title, 'title') ?></h4>
                    </div>
                </div>
            </div>

            <!-- Info Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0"><?= $this->base->text('information', 'heading') ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span><?= $this->base->text('status', 'table') ?>:</span>
                                        <span>
                                            <?php if ($ticket['ticket_status'] == 'open'): ?>
                                                <span class="badge bg-warning">
                                                    <?= $this->base->text($ticket['ticket_status'], 'table') ?>
                                                </span>
                                            <?php elseif ($ticket['ticket_status'] == 'support' OR $ticket['ticket_status'] == 'customer'): ?>
                                                <span class="badge bg-success">
                                                    <?= $this->base->text($ticket['ticket_status'], 'table') ?>
                                                </span>
                                            <?php elseif ($ticket['ticket_status'] == 'closed'): ?>
                                                <span class="badge bg-danger">
                                                    <?= $this->base->text($ticket['ticket_status'], 'table') ?>
                                                </span>
                                            <?php endif ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span><?= $this->base->text('open_by', 'table') ?>:</span>
                                        <span><?= $this->user->get_name() ?></span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span><?= $this->base->text('open_at', 'table') ?>:</span>
                                        <span><?= date('d-m-Y', $ticket['ticket_time']) ?></span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span><?= $this->base->text('last_reply', 'table') ?>:</span>
                                        <span>
                                            <?php if(count($replies)>0): ?>
                                                <?= date('d-m-Y', $replies[count($replies)-1]['reply_time']); ?>
                                            <?php else: ?>
                                                <?= $this->base->text('never', 'label') ?>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <span><?= $this->base->text('subject', 'table') ?>:</span>
                                <span class="fw-bold"><?= $ticket['ticket_subject'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Original Message -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="avatar-xs me-2">
                                    <img src="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/images/user.png" 
                                         class="rounded-circle img-fluid" alt="user">
                                </div>
                                <span><?= $this->user->get_name() ?></span>
                            </div>
                            <span class="text-muted"><?= date('d-m-Y', $ticket['ticket_time']) ?></span>
                        </div>
                        <div class="card-body">
                            <?= $ticket['ticket_content'] ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Replies -->
            <?php if (count($replies) > 0): ?>
                <?php
                if ($this->input->get('page')) :
                    $mcount = $this->base->rpp() * $this->input->get('page') + 1;
                else :
                    $mcount = 1;
                endif;
                $count = $mcount - 1;
                ?>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <?php foreach ($replies as $reply): ?>
                                    <?php if ($reply['reply_by'] == $this->user->get_key()): 
                                        $reply_name = $this->user->get_name();
                                        $ico = $this->user->get_avatar();
                                    else:
                                        $reply_name = $this->ticket->get_admin_name($reply['reply_by']);
                                        $ico = base_url().'assets/'.$this->base->get_template().'/img/fav.png';
                                    endif ?>
                                    <div class="card mb-3">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs me-2">
                                                    <img src="<?= $ico ?>" class="rounded-circle img-fluid" alt="user">
                                                </div>
                                                <span><?= $reply_name ?></span>
                                            </div>
                                            <span class="text-muted"><?= date('d-m-Y', $reply['reply_time']) ?></span>
                                        </div>
                                        <div class="card-body">
                                            <?= $reply['reply_content'] ?>
                                        </div>
                                    </div>
                                    <?php $count += 1; ?>
                                <?php endforeach ?>

                                <!-- Pagination -->
                                <div class="d-flex align-items-center justify-content-between mt-4">
                                    <div>
                                        Showing <?= $mcount ?? 0 ?> to <?= $count ?? 0 ?> of <?= $this->ticket->list_count_reply($id) ?> entries
                                    </div>
                                    <nav aria-label="Page navigation">
                                        <?php $page = $this->input->get('page') ?? 0 ?>
                                        <ul class="pagination mb-0">
                                            <li class="page-item <?php if ($page < 1) : ?>disabled<?php endif ?>">
                                                <a class="page-link" <?php if ($page > 0) : ?>href="<?= base_url() ?>ticket/view/<?= $id ?>?page=<?= $page - 1 ?>"<?php endif ?>>
                                                    <span>&laquo;</span>
                                                </a>
                                            </li>
                                            <li class="page-item <?php if ($count >= $this->ticket->list_count_reply($id)) : ?>disabled<?php endif ?>">
                                                <a class="page-link" <?php if ($count < $this->ticket->list_count_reply($id)) : ?>href="<?= base_url() ?>ticket/view/<?= $id ?>?page=<?= $page + 1 ?>"<?php endif ?>>
                                                    <span>&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <?= $this->base->text('no_reply_found', 'paragraph') ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>

            <!-- Reply Form -->
            <?php if ($ticket['ticket_status'] == 'closed'): ?>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card border-danger">
                            <div class="card-body">
                                <?= $this->base->text('ticket_closed', 'paragraph') ?> 
                                <a href="<?= base_url().'ticket/view/'.$ticket['ticket_key'].'?open=true' ?>">
                                    <?= $this->base->text('here', 'button') ?>
                                </a>
                                <?= $this->base->text('to_reopen', 'paragraph') ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0"><?= $this->base->text('make_a_reply', 'heading') ?></h4>
                            </div>
                            <div class="card-body">
                                <?= form_open('ticket/view/'.$ticket['ticket_key']) ?>
                                    <div class="mb-3">
                                        <textarea id="editor" class="form-control" name="content"></textarea>
                                    </div>

                                    <?php if($this->grc->is_active()):?>
                                        <div class="mb-3">
                                            <?php if($this->grc->get_type() == "google"):?>
                                                <div class="g-recaptcha" data-sitekey="<?= $this->grc->get_site_key();?>"></div>
                                                <script src='https://www.google.com/recaptcha/api.js' async defer></script>
                                            <?php elseif($this->grc->get_type() == "crypto"): ?>
                                                <script src='https://verifypow.com/lib/captcha.js' async></script>
                                                <div class='CRLT-captcha' data-hashes='256' data-key='<?= $this->grc->get_site_key();?>'>
                                                    <em>Loading PoW Captcha...</em>
                                                </div>
                                            <?php elseif($this->grc->get_type() == "human"): ?>
                                                <div id='captcha' class='h-captcha' data-sitekey="<?= $this->grc->get_site_key();?>"></div>
                                                <script src='https://hcaptcha.com/1/api.js' async defer></script>
                                            <?php elseif($this->grc->get_type() == "turnstile"): ?>
                                                <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
                                                <div class="cf-turnstile" data-sitekey="<?= $this->grc->get_site_key(); ?>"></div>
                                            <?php endif ?>
                                        </div>
                                    <?php endif ?>

                                    <div class="d-flex gap-2">
                                        <button type="submit" name="reply" value="Add reply" class="btn btn-primary waves-effect waves-light d-inline-flex align-items-center">
                                            <i data-feather="send" class="me-1"></i>
                                            <span><?= $this->base->text('add_reply', 'button') ?></span>
                                        </button>
                                        <button type="button" onclick="window.location.href='<?= base_url().'ticket/view/'.$ticket['ticket_key'].'?close=true' ?>'" class="btn btn-danger waves-effect waves-light d-inline-flex align-items-center">
                                            <i data-feather="x-circle" class="me-1"></i>
                                            <span><?= $this->base->text('close_ticket', 'button') ?></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>

        </div>
    </div>
</div>

<script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/libs/tinymce/tinymce.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    feather.replace();

    tinymce.init({
        selector: '#editor',
        height: 300,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 14px; }',
        setup: function(editor) {
            editor.on('change', function() {
                editor.save();
            });
        },
        skin: 'oxide',
        content_css: 'default',
        branding: false,
        promotion: false,
        auto_save: true,
        paste_data_images: true,
        paste_as_text: false,
        paste_word_valid_elements: "p,b,strong,i,em,h1,h2,h3,h4,h5,h6,ul,ol,li,a[href],span,code",
        valid_elements: "p,br,b,strong,i,em,ul,ol,li,a[href],span,code,pre",
        autolink_pattern: /^(https?:\/\/|www\.|(?:[a-zA-Z0-9._-])+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})/,
        link_assume_external_targets: true
    });
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Feather Icons
        feather.replace();

        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'save']
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
    });
</script>