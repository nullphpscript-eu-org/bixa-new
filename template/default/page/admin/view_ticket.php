<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">View Ticket</h4>
                    </div>
                </div>
            </div>

            <!-- Info Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="text-muted d-block mb-2">Status:</label>
                                    <?php if ($ticket['ticket_status'] == 'open'): ?>
                                        <span class="badge bg-warning">
                                            <i data-feather="clock" class="font-size-12 align-middle me-1"></i><?= $ticket['ticket_status'] ?>
                                        </span>
                                    <?php elseif ($ticket['ticket_status'] == 'support' OR $ticket['ticket_status'] == 'customer'): ?>
                                        <span class="badge bg-success">
                                            <i data-feather="check-circle" class="font-size-12 align-middle me-1"></i><?= $ticket['ticket_status'] ?>
                                        </span>
                                    <?php elseif ($ticket['ticket_status'] == 'closed'): ?>
                                        <span class="badge bg-danger">
                                            <i data-feather="x-circle" class="font-size-12 align-middle me-1"></i><?= $ticket['ticket_status'] ?>
                                        </span>
                                    <?php endif ?>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="text-muted">Opened by:</label>
                                    <div class="fw-medium"><?= $this->ticket->get_user_name($ticket['ticket_for']) ?></div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="text-muted">Opened at:</label>
                                    <div class="fw-medium"><?= date('d-m-Y', $ticket['ticket_time']) ?></div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="text-muted">Last Reply:</label>
                                    <div class="fw-medium">
                                        <?php if(count($replies)>0): ?>
                                            <?= date('d-m-Y', $replies[count($replies)-1]['reply_time']); ?>
                                        <?php else: ?>
                                            NEVER
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="text-muted">User Email:</label>
                                    <div class="fw-medium"><?= $this->ticket->get_user_email($ticket['ticket_for']) ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex align-items-center">
                                <span class="text-muted">Subject:</span>
                                <span class="ms-auto fw-medium"><?= $ticket['ticket_subject'] ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Original Message -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <img src="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/images/user.png" 
                                         class="avatar-xs rounded-circle me-2">
                                    <span class="fw-medium"><?= $this->ticket->get_user_name($ticket['ticket_for']) ?></span>
                                </div>
                                <div class="flex-shrink-0">
                                    <?= date('d-m-Y', $ticket['ticket_time']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="ticket-content">
                                <?= $ticket['ticket_content'] ?>
                            </div>
                        </div>
                    </div>

                    <!-- Replies -->
                    <?php if (count($replies) > 0): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <?php foreach ($replies as $reply): ?>
                                    <?php 
                                        if ($reply['reply_by'] !== $this->admin->get_key()): 
                                            $reply_name = $this->ticket->get_user_name($reply['reply_by']);
                                            $ico = base_url().'assets/'. $this->base->get_template(). '/images/user.png';
                                        else:
                                            $reply_name = $this->ticket->get_admin_name($reply['reply_by']);
                                            $ico = base_url().'assets/'. $this->base->get_template(). '/images/logo-sm.svg';
                                        endif 
                                    ?>
                                    <div class="card border mb-3">
                                        <div class="card-header bg-transparent">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <img src="<?= $ico ?>" class="avatar-xs rounded-circle me-2">
                                                    <span class="fw-medium"><?= $reply_name ?></span>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <?= date('d-m-Y', $reply['reply_time']) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="ticket-content">
                                                <?= $reply['reply_content'] ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <div class="text-muted">
                                        Showing <?= isset($mcount) ? $mcount : 0 ?> to <?= isset($count) ? $count : 0 ?> 
                                        of <?= $this->ticket->list_count_reply($id) ?> entries
                                    </div>
                                    <ul class="pagination pagination-rounded mb-0">
                                        <?php $page = $this->input->get('page') ?? 0 ?>
                                        <li class="page-item <?= ($page < 1) ? 'disabled' : '' ?>">
                                            <a class="page-link" <?= ($page > 0) ? 'href="'.base_url().'admin/ticket/view/'.$id.'?page='.($page-1).'"' : '' ?>>
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>
                                        <li class="page-item <?= ($count >= $this->ticket->list_count_reply($id)) ? 'disabled' : '' ?>">
                                            <a class="page-link" <?= ($count < $this->ticket->list_count_reply($id)) ? 'href="'.base_url().'admin/ticket/view/'.$id.'?page='.($page+1).'"' : '' ?>>
                                                <i class="mdi mdi-chevron-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="card mb-3">
                            <div class="card-body text-center text-muted">
                                No reply found.
                            </div>
                        </div>
                    <?php endif ?>

                    <!-- Reply Form -->
                    <?php if ($ticket['ticket_status'] == 'closed'): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="alert alert-danger mb-0">
                                    The ticket has been closed. Click <a href="<?= base_url().'admin/ticket/view/'.$ticket['ticket_key'].'?open=true' ?>" 
                                    class="alert-link">here</a> to re-open.
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Make a reply</h4>
                            </div>
                            <div class="card-body">
                                <?= form_open('admin/ticket/view/'.$ticket['ticket_key']) ?>
                                    <div class="mb-3">
                                        <textarea id="editor" class="form-control" name="content" rows="3"></textarea>
                                    </div>
                                    <?php if($this->grc->is_active()):?>
                                        <div class="mb-3">
                                            <?php if($this->grc->get_type() == "google"):?>
                                                <div class="g-recaptcha" data-sitekey="<?= $this->grc->get_site_key();?>"></div>
                                                <script src='https://www.google.com/recaptcha/api.js' async defer ></script>
                                            <?php elseif($this->grc->get_type() == "crypto"): ?>
                                                <script src='https://verifypow.com/lib/captcha.js' async></script>
                                                <div class='CRLT-captcha' data-hashes='256' data-key='<?= $this->grc->get_site_key();?>'>
                                                    <em>Loading PoW Captcha...<br>If it doesn't load, please disable AdBlocker!</em>
                                                </div>
                                            <?php elseif($this->grc->get_type() == "human"): ?>
                                                <div id='captcha' class='h-captcha' data-sitekey="<?= $this->grc->get_site_key();?>"></div>
                                                <script src='https://hcaptcha.com/1/api.js' async defer></script>
                                            <?php elseif ($this->grc->get_type() == "turnstile") : ?>
                                                <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
                                                <div class="cf-turnstile" data-sitekey="<?= $this->grc->get_site_key(); ?>" data-callback="javascriptCallback"></div>
                                            <?php endif ?>
                                        </div>
                                    <?php endif ?>
                                    <div>
    <button type="submit" name="reply" value="Add reply" class="btn btn-primary waves-effect waves-light d-inline-flex align-items-center me-2">
        <i data-feather="send" class="me-1"></i>
        <span>Add reply</span>
    </button>
    <button type="button" onclick="window.location.href='<?= base_url().'admin/ticket/view/'.$ticket['ticket_key'].'?close=true' ?>'" class="btn btn-danger waves-effect waves-light d-inline-flex align-items-center">
        <i data-feather="x-circle" class="me-1"></i>
        <span>Close Ticket</span>
    </button>
</div>
                                </form>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
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