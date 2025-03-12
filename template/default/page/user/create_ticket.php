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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0"><?= $this->base->text('create_ticket', 'heading') ?></h4>
                        </div>
                        <div class="card-body">
                            <?= form_open('ticket/create') ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label"><?= $this->base->text('subject', 'label') ?></label>
                                            <input type="text" name="subject" class="form-control" required
                                                   placeholder="<?= $this->base->text('subject', 'label') ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label"><?= $this->base->text('content', 'label') ?></label>
                                            <div id="ckeditor-classic">
                                                <textarea id="editor" name="content" class="form-control" 
                                 placeholder="<?= $this->base->text('content', 'label') ?>"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if($this->grc->is_active()):?>
                                        <div class="col-lg-12">
                                            <div class="mb-4">
                                                <?php if($this->grc->get_type() == "google"):?>
                                                    <div class="g-recaptcha" data-sitekey="<?= $this->grc->get_site_key();?>"></div>
                                                    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
                                                <?php elseif($this->grc->get_type() == "crypto"): ?>
                                                    <script src='https://verifypow.com/lib/captcha.js' async></script>
                                                    <div class='CRLT-captcha' data-hashes='256' data-key='<?= $this->grc->get_site_key();?>'>
                                                        <em>Loading PoW Captcha...<br>If it doesn't load, please disable AdBlocker!</em>
                                                    </div>
                                                <?php elseif($this->grc->get_type() == "human"): ?>
                                                    <div id='captcha' class='h-captcha' data-sitekey="<?= $this->grc->get_site_key();?>"></div>
                                                    <script src='https://hcaptcha.com/1/api.js' async defer></script>
                                                <?php elseif($this->grc->get_type() == "turnstile"): ?>
                                                    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
                                                    <div class="cf-turnstile" data-sitekey="<?= $this->grc->get_site_key();?>"></div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    <?php endif ?>

                                    <div class="col-lg-12">
    <button type="submit" name="create" value="<?= $this->base->text('create', 'button') ?>" class="btn btn-primary waves-effect waves-light d-inline-flex align-items-center">
        <i data-feather="plus" class="me-1"></i>
        <span><?= $this->base->text('create', 'button') ?></span>
    </button>
</div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <center><?php display_ad('footer'); ?></center>
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