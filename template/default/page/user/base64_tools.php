<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Base64 Encode/Decode</h4>
                            
                            <div class="row">
                                <!-- Encode Section -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Input Text</label>
                                        <textarea id="encode-input" class="form-control" rows="8" placeholder="Enter text to encode..."></textarea>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <button onclick="encodeText()" class="btn btn-primary me-2">
                                            <i data-feather="lock" class="icon-xs me-1"></i> Encode
                                        </button>
                                        <button onclick="copyText('encode-output')" class="btn btn-secondary">
                                            <i data-feather="copy" class="icon-xs me-1"></i> Copy
                                        </button>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Encoded Output</label>
                                        <textarea id="encode-output" class="form-control font-monospace" rows="8" readonly></textarea>
                                    </div>
                                </div>

                                <!-- Decode Section -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Base64 Input</label>
                                        <textarea id="decode-input" class="form-control font-monospace" rows="8" placeholder="Enter base64 to decode..."></textarea>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <button onclick="decodeText()" class="btn btn-primary me-2">
                                            <i data-feather="unlock" class="icon-xs me-1"></i> Decode
                                        </button>
                                        <button onclick="copyText('decode-output')" class="btn btn-secondary">
                                            <i data-feather="copy" class="icon-xs me-1"></i> Copy
                                        </button>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Decoded Output</label>
                                        <textarea id="decode-output" class="form-control" rows="8" readonly></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function encodeText() {
    const input = document.getElementById('encode-input').value;
    try {
        const encoded = btoa(unescape(encodeURIComponent(input)));
        document.getElementById('encode-output').value = encoded;
    } catch(e) {
        alert('Error encoding text: ' + e.message);
    }
}

function decodeText() {
    const input = document.getElementById('decode-input').value;
    try {
        const decoded = decodeURIComponent(escape(atob(input)));
        document.getElementById('decode-output').value = decoded;
    } catch(e) {
        alert('Error decoding text: Invalid base64 string');
    }
}

function copyText(elementId) {
    const element = document.getElementById(elementId);
    element.select();
    document.execCommand('copy');
    
    // Optional: Show feedback
    const originalBg = element.style.backgroundColor;
    element.style.backgroundColor = '#e8f0fe';
    setTimeout(() => {
        element.style.backgroundColor = originalBg;
    }, 200);
}

// Clear outputs when inputs change
document.getElementById('encode-input').addEventListener('input', function() {
    document.getElementById('encode-output').value = '';
});

document.getElementById('decode-input').addEventListener('input', function() {
    document.getElementById('decode-output').value = '';
});
</script>