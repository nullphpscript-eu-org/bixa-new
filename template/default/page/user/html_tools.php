<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">HTML/CSS Beautifier & Minifier</h4>
                            
                            <div class="mb-3">
                                <label class="form-label">Input Code</label>
                                <textarea id="input-code" class="form-control" rows="10" placeholder="Paste your HTML or CSS code here..."></textarea>
                            </div>

                            <div class="mb-3">
                                <select id="code-type" class="form-select w-auto">
                                    <option value="html">HTML</option>
                                    <option value="css">CSS</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <button onclick="beautifyCode()" class="btn btn-primary me-2">
                                    <i data-feather="layout" class="icon-xs me-1"></i> Beautify
                                </button>
                                <button onclick="minifyCode()" class="btn btn-warning">
                                    <i data-feather="minimize-2" class="icon-xs me-1"></i> Minify
                                </button>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Output Code</label>
                                <textarea id="output-code" class="form-control" rows="10" readonly></textarea>
                            </div>

                            <button onclick="copyOutput()" class="btn btn-secondary">
                                <i data-feather="copy" class="icon-xs me-1"></i> Copy Output
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.14.7/beautify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.14.7/beautify-css.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.14.7/beautify-html.min.js"></script>

<script>
function beautifyCode() {
    const input = document.getElementById('input-code').value;
    const type = document.getElementById('code-type').value;
    let output = '';
    
    if(type === 'html') {
        output = html_beautify(input, {
            indent_size: 2,
            wrap_line_length: 80,
            preserve_newlines: true
        });
    } else {
        output = css_beautify(input, {
            indent_size: 2
        });
    }
    
    document.getElementById('output-code').value = output;
}

function minifyCode() {
    const input = document.getElementById('input-code').value;
    const type = document.getElementById('code-type').value;
    
    // Remove comments, whitespace and newlines
    let output = input
        .replace(/\/\*[\s\S]*?\*\/|\/\/.*/g, '')
        .replace(/\s+/g, ' ')
        .trim();
        
    if(type === 'html') {
        output = output
            .replace(/>\s+</g, '><')
            .replace(/\s+/g, ' ');
    }
    
    document.getElementById('output-code').value = output;
}

function copyOutput() {
    const output = document.getElementById('output-code');
    output.select();
    document.execCommand('copy');
    
    // Show toast or alert
    alert('Output copied to clipboard!');
}
</script>