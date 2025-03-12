<div class="container-xl">
    <div class="page-header d-print-none">
        <h2 class="page-title py-3">Captcha Settings</h2>
    </div>
    <div class="card">
        <div class="card-body">
            <?= form_open('api/settings') ?>
            <div class="row">
                <div class="col-sm-6">
                    <label class="form-label">Captcha Type</label>
                    <select class="form-control mb-2" name="type">
                        <option value="google" <?= $this->grc->get_type() === 'google' ? 'selected' : '' ?>>Google reCAPTCHA</option>
                        <option value="human" <?= $this->grc->get_type() === 'human' ? 'selected' : '' ?>>hCaptcha</option>
                        <option value="crypto" <?= $this->grc->get_type() === 'crypto' ? 'selected' : '' ?>>CryptoLoot</option>
                        <option value="turnstile" <?= $this->grc->get_type() === 'turnstile' ? 'selected' : '' ?>>Cloudflare Turnstile</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Site Key</label>
                    <input type="text" name="site_key" class="form-control mb-2" value="<?= $this->grc->get_site_key() ?>">
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Secret key</label>
                    <input type="text" name="secret_key" class="form-control mb-2" value="<?= $this->grc->get_secret_key() ?>">
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Status</label>
                    <select class="form-control mb-2" name="status">
                        <option value="1" <?= $this->grc->get_status() === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= $this->grc->get_status() !== 'active' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
                <div class="col-sm-12">
                    <input type="submit" name="update_grc" value="Change" class="btn btn-primary btn-pill">
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
