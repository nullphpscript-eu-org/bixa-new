<div class="main-content">
   <div class="page-content">
       <div class="container-fluid">
           <!-- Page Title -->
           <div class="row">
               <div class="col-12">
                   <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                       <h4 class="mb-sm-0 font-size-18"><?= $content ? 'Edit HTML Content: '.$content->name : 'Add New HTML Content' ?></h4>
                       <a href="<?= base_url('admin/html')?>" class="btn btn-secondary waves-effect waves-light">
                           <i data-feather="arrow-left" class="font-size-16 align-middle me-2"></i> Back to List
                       </a>
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

           <!-- Content -->
           <div class="row">
               <div class="col-12">
                   <div class="card">
                       <div class="card-body">
                           <?= form_open('', ['id' => 'htmlForm']) ?>
                               <div class="mb-3">
                                   <div class="col-lg-12">
                                       <label for="name" class="form-label">Content Name</label>
                                       <input type="text" 
                                              id="name"
                                              name="name" 
                                              class="form-control" 
                                              required
                                              value="<?= $content ? htmlspecialchars($content->name) : '' ?>"
                                              placeholder="Enter content name">
                                   </div>
                               </div>

                               <div class="mb-3">
                                   <div class="col-lg-12">
                                       <div class="editor-container">
                                           <!-- Editor Toolbar -->
                                           <div class="editor-toolbar d-flex justify-content-between p-2 bg-light border-bottom">
                                               <div>
                                                   <button type="button" class="btn btn-primary btn-sm" id="previewBtn">
                                                       <i data-feather="eye" class="icon-xs me-1"></i> Toggle Preview
                                                   </button>
                                                   <span class="text-muted ms-2 small">Press Ctrl+Space to show code suggestions</span>
                                               </div>
                                               <div>
                                                   <button type="submit" name="submit" value="1" class="btn btn-success btn-sm">
                                                       <i data-feather="save" class="icon-xs me-1"></i> Save Changes
                                                   </button>
                                               </div>
                                           </div>

                                           <!-- Editor Area -->
                                           <div class="row g-0">
                                               <div class="col-md-12" id="editorPane">
                                                   <textarea id="htmlEditor" name="content" 
                                                             class="form-control"><?= $content ? $content->content : '' ?></textarea>
                                                   <div id="aceEditor" style="height: 600px;"></div>
                                               </div>
                                               <div class="col-md-6" id="previewPane" style="display:none;">
                                                   <div id="preview" class="preview-container"></div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           <?= form_close() ?>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>

<!-- Required CSS -->
<style>
.editor-container {
   border: 1px solid #e5e7eb;
   border-radius: 4px;
   overflow: hidden;
}

.editor-toolbar {
   padding: 10px;
   background: #f8f9fa;
   border-bottom: 1px solid #e5e7eb;
}

.preview-container {
   height: 600px;
   overflow: hidden;
   background: #fff;
   border-left: 1px solid #e5e7eb;
   position: relative;
}

.preview-container iframe {
   width: 100%;
   height: 100%;
   border: 0;
   overflow: hidden;
}

#previewPane {
   position: relative;
   z-index: 1;
   overflow: hidden;
}

#aceEditor { 
    margin: 0;
    position: relative;
    resize: vertical;
    min-height: 600px;
    font-size: 14px;
}
</style>

<!-- Required JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.2/ace.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.2/ext-language_tools.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.2/theme-monokai.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.2/mode-html.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const textArea = document.getElementById('htmlEditor');
    textArea.style.display = 'none';

    // Khởi tạo Ace Editor
    ace.require("ace/ext/language_tools");
    const editor = ace.edit("aceEditor");
    editor.session.setMode("ace/mode/html");
    editor.setTheme("ace/theme/monokai");
    editor.setValue(textArea.value, -1);

    // Cấu hình Ace Editor
    editor.setOptions({
        enableBasicAutocompletion: true,
        enableSnippets: true,
        enableLiveAutocompletion: true,
        showPrintMargin: false,
        highlightActiveLine: true,
        displayIndentGuides: true,
        fontSize: "14px",
        wrap: true,
        useWorker: false
    });

    // Xử lý preview
    const previewBtn = document.getElementById('previewBtn');
    const editorPane = document.getElementById('editorPane');
    const previewPane = document.getElementById('previewPane');
    const preview = document.getElementById('preview');

    function updatePreview() {
        if (previewPane.style.display !== 'none') {
            const content = editor.getValue();
            const iframe = document.createElement('iframe');
            
            preview.innerHTML = '';
            preview.appendChild(iframe);

            const doc = iframe.contentDocument || iframe.contentWindow.document;
            doc.open();
            doc.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <base href="<?= base_url() ?>">
                    <link href="assets/<?= $this->base->get_template() ?>/css/bootstrap.min.css" rel="stylesheet">
                    <link href="assets/<?= $this->base->get_template() ?>/css/app.min.css" rel="stylesheet">
                    <script src="assets/<?= $this->base->get_template() ?>/libs/jquery/jquery.min.js"><\/script>
                    <script src="assets/<?= $this->base->get_template() ?>/libs/bootstrap/js/bootstrap.bundle.min.js"><\/script>
                    <script src="assets/<?= $this->base->get_template() ?>/libs/feather-icons/feather.min.js"><\/script>
                    <style>
                        html, body {
                            height: 100%;
                            margin: 0;
                            padding: 0;
                            overflow-x: hidden;
                        }
                        body {
                            max-width: 100%;
                            overflow-x: hidden;
                            position: relative;
                        }
                        .container, 
                        .container-fluid {
                            max-width: 100%;
                            padding-left: 15px;
                            padding-right: 15px;
                            overflow-x: hidden;
                        }
                        * { pointer-events: auto !important; }
                        
                        nav {
                            position: relative !important;
                            width: 100% !important;
                            max-width: 100% !important;
                            left: 0 !important;
                            right: 0 !important;
                        }
                    </style>
                </head>
                <body>
                    <div class="preview-wrapper">
                        ${content}
                    </div>
                    <script>
                        if (typeof feather !== 'undefined') {
                            feather.replace();
                        }
                        
                        document.addEventListener('DOMContentLoaded', function() {
                            const wrapper = document.querySelector('.preview-wrapper');
                            if(wrapper) {
                                wrapper.style.maxWidth = '100%';
                                wrapper.style.overflowX = 'hidden';
                            }
                        });
                    <\/script>
                </body>
                </html>
            `);
            doc.close();
        }
    }

    previewBtn.addEventListener('click', function() {
        if (previewPane.style.display === 'none') {
            previewPane.style.display = 'block';
            editorPane.className = 'col-md-6';
            updatePreview();
            editor.resize();
        } else {
            previewPane.style.display = 'none';
            editorPane.className = 'col-md-12';
            editor.resize();
        }
    });

    // Cập nhật preview khi thay đổi nội dung
    editor.session.on('change', debounce(updatePreview, 500));

    // Xử lý form submission
    document.getElementById('htmlForm').onsubmit = function() {
        textArea.value = editor.getValue();
    };

    // Hàm debounce
    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    // Khởi tạo feather icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }

    // Thêm phím tắt
    editor.commands.addCommand({
        name: 'saveCommand',
        bindKey: {win: 'Ctrl-S', mac: 'Command-S'},
        exec: function() {
            document.getElementById('htmlForm').submit();
        }
    });
});
</script>