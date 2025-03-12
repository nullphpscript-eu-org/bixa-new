<!-- Main Content -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Cloudflare Settings</h4>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            <?php if($this->session->flashdata('msg')): ?>
                <?php $msg = json_decode($this->session->flashdata('msg'), true); ?>
                <div class="alert alert-<?= $msg[0] ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
                    <?= $msg[1] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Settings Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Configure Cloudflare API</h4>
                            <p class="card-title-desc">Enter your Cloudflare API credentials to manage your domains</p>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?= base_url('cloudflare/settings') ?>">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <input type="hidden" name="update_api" value="1">
                                
                                <div class="mb-3">
                                    <label class="form-label">Cloudflare Email</label>
                                    <input type="email" 
                                           name="cf_email" 
                                           class="form-control" 
                                           value="<?= isset($cf_api['email']) ? $cf_api['email'] : '' ?>" 
                                           required>
                                    <div class="form-text">Enter the email address associated with your Cloudflare account</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">API Key</label>
                                    <input type="password" 
                                           name="cf_key" 
                                           class="form-control" 
                                           value="<?= isset($cf_api['key']) ? '••••••••' : '' ?>" 
                                           required>
                                    <div class="form-text">Your Global API key from Cloudflare</div>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Save Settings</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instructions Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">How to Get Your API Key</h4>
                        </div>
                        <div class="card-body">
                            <ol class="mb-4">
                                <li>Log in to your Cloudflare dashboard at <a href="https://dash.cloudflare.com" target="_blank">https://dash.cloudflare.com</a></li>
                                <li>Click on your profile icon in the top right corner</li>
                                <li>Click on "My Profile"</li>
                                <li>Click on "API Tokens" in the left sidebar</li>
                                <li>Under "API Keys", find your Global API Key</li>
                                <li>Click "View" and enter your Cloudflare password if prompted</li>
                                <li>Copy the displayed API Key</li>
                            </ol>

                            <div class="alert alert-info">
                                <div class="d-flex">
                                    <i data-feather="info" class="me-2 align-self-center"></i>
                                    <div>
                                        <h5 class="alert-heading">Important Notes:</h5>
                                        <ul class="mb-0">
                                            <li>Keep your API key secure and never share it with anyone</li>
                                            <li>The API key provides full access to your Cloudflare account</li>
                                            <li>If your key is compromised, immediately revoke it and generate a new one</li>
                                        </ul>
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
// Initialize feather icons
if (typeof feather !== 'undefined') {
    feather.replace();
}
</script>