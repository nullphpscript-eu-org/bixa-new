<!-- Main Content -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"><?= $ad ? 'Edit Ad' : 'Add New Ad' ?></h4>
                    </div>
                </div>
            </div>
            
            <?php if($this->session->flashdata('msg')): ?>
                <?php $msg = json_decode($this->session->flashdata('msg'), true); ?>
                <div class="alert alert-<?= $msg[0] ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
                    <?= $msg[1] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0"><?= $ad ? 'Edit Advertisement' : 'Create New Advertisement' ?></h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <!-- CSRF Token -->
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" 
                                       value="<?= $this->security->get_csrf_hash() ?>">
                                
                                <div class="mb-3">
                                    <label class="form-label">Ad Name</label>
                                    <input type="text" name="name" class="form-control" 
                                           value="<?= set_value('name', $ad ? htmlspecialchars($ad['ad_name']) : '') ?>" required>
                                    <?= form_error('name', '<div class="text-danger small">', '</div>') ?>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Placement</label>
                                    <input type="text" name="placement" class="form-control" 
                                           value="<?= set_value('placement', $ad ? htmlspecialchars($ad['ad_placement']) : '') ?>" required
                                           placeholder="e.g. header, sidebar, footer">
                                    <?= form_error('placement', '<div class="text-danger small">', '</div>') ?>
                                    <small class="text-muted">
                                        This is the identifier used to place the ad in your template.
                                        Use this in your view: <code>&lt;?php echo get_ad('placement_name'); ?&gt;</code>
                                    </small>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Ad Content</label>
                                    <textarea id="editor" name="content" class="form-control" rows="8" required><?= set_value('content', $ad ? html_entity_decode($ad['ad_content']) : '') ?></textarea>
                                    <?= form_error('content', '<div class="text-danger small">', '</div>') ?>
                                    <small class="text-muted">
                                        You can use HTML, JavaScript and CSS here. Rich content editor is provided for convenience.
                                    </small>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" name="status" class="form-check-input" 
                                               <?= set_checkbox('status', '1', (!$ad || $ad['ad_status'] == 'active')) ?>>
                                        <label class="form-check-label">Active</label>
                                    </div>
                                </div>
                                
                                <div class="text-end">
                                    <a href="<?= base_url('admin/ads') ?>" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" name="submit" value="1" class="btn btn-primary">
                                        <?= $ad ? 'Update Ad' : 'Create Ad' ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- Include TinyMCE -->
<script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/libs/tinymce/tinymce.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    tinymce.init({
        selector: '#editor',
        height: 400,
        menubar: true,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'preview', 'help', 'wordcount',
            'codesample'
        ],
        toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | link codesample code preview | help',
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
        paste_data_images: true,
        paste_as_text: false,
        valid_elements: '*[*]', // Allow all elements and attributes for ads
        extended_valid_elements: 'script[*],style[*]', // Specifically allow script and style tags
        valid_children: '+body[style|script]', // Allow script and style tags in body
        verify_html: false, // Don't verify HTML since we need to allow all tags for ads
        cleanup: false,
        allow_script_urls: true,
        allow_html_in_named_anchor: true,
        convert_urls: false, // Don't convert URLs to prevent issues with scripts
        remove_script_host: false,
        codesample_languages: [
            { text: 'HTML/XML', value: 'markup' },
            { text: 'JavaScript', value: 'javascript' },
            { text: 'CSS', value: 'css' }
        ]
    });
});
</script>