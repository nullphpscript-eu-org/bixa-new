<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">WordPress Password Hash Generator</h4>
                            
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="text" id="wp-password" class="form-control" placeholder="Enter password to hash">
                            </div>
                            
                            <button onclick="generateHash()" class="btn btn-primary mb-3">
                                Generate Hash
                            </button>
                            
                            <div class="mb-3">
                                <label class="form-label">Generated Hash</label>
                                <textarea id="wp-hash" class="form-control" rows="3" readonly></textarea>
                            </div>
                            
                            <button onclick="copyHash()" class="btn btn-secondary">
                                <i data-feather="copy" class="icon-xs me-1"></i> Copy Hash
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function generateHash() {
    const password = document.getElementById('wp-password').value;
    // Here you would make an AJAX call to generate the WordPress password hash
    // For demonstration, we'll just show a dummy hash
    document.getElementById('wp-hash').value = '$P$BnWWZfEDnm1uGX5gVj9dwLyXyVD0K1';
}

function copyHash() {
    const hashField = document.getElementById('wp-hash');
    hashField.select();
    document.execCommand('copy');
    alert('Hash copied to clipboard!');
}
</script>