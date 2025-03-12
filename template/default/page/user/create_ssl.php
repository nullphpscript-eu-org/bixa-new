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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?= form_open('ssl/create') ?>
                                <div class="row">
                                    <?php if ($acme_active): ?>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label"><?= $this->base->text('ssl_type', 'title') ?></label>
                                                <select class="form-select" name="type">
                                                    <?php if ($this->acme->get_letsencrypt() != 'not-set' && $this->acme->get_letsencrypt() != ''): ?>
                                                        <option value="letsencrypt" selected>Let's Encrypt</option>
                                                    <?php endif; ?>
                                                    
                                                    <?php if ($this->ssl->is_active()): ?>
                                                        <option value="gogetssl">GoGetSSL</option>
                                                    <?php endif; ?>

                                                    <?php 
                                                    $zerossl = $this->acme->get_zerossl();
                                                    if ($zerossl != 'not-set' && $zerossl['url'] != '' && $zerossl['eab_kid'] != '' && $zerossl['eab_hmac_key'] != ''): 
                                                    ?>
                                                        <option value="zerossl">ZeroSSL</option>
                                                    <?php endif; ?>

                                                    <?php 
                                                    $googletrust = $this->acme->get_googletrust();
                                                    if ($googletrust != 'not-set' && $googletrust['url'] != '' && $googletrust['eab_kid'] != '' && $googletrust['eab_hmac_key'] != ''): 
                                                    ?>
                                                        <option value="googletrust">Google Trust Services</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                    <?php else: ?>
                                        <input type="hidden" value="gogetssl" name="type">
                                        <div class="col-sm-12">
                                    <?php endif; ?>
                                        <div class="mb-3">
                                            <label class="form-label"><?= $this->base->text('domain_name', 'label') ?></label>
                                            <input type="text" class="form-control" name="domain" 
                                                   placeholder="<?= $this->base->text('domain_name', 'label') ?>"/>
                                        </div>
                                    </div>

                                    <?php if($this->grc->is_active()): ?>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <?php if($this->grc->get_type() == "google"): ?>
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
                                                    <div class="cf-turnstile" data-sitekey="<?= $this->grc->get_site_key();?>" data-callback="javascriptCallback"></div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    <?php endif ?>

                                    <div class="col-12">
                                        <button id="createButton" type="submit" name="create" value="<?= $this->base->text('request', 'button') ?>" 
                                                class="btn btn-primary waves-effect waves-light">
                                            <span id="spinner" class="spinner-border spinner-border-sm me-1" role="status" style="display:none"></span>
                                            <span id="buttonText"><?= $this->base->text('request', 'button') ?></span>
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

<script>
function showLoading() {
    var spinner = document.getElementById('spinner');
    var buttonText = document.getElementById('buttonText');
    var submitButton = document.getElementById('createButton');

    spinner.style.display = 'inline-block';
    buttonText.textContent = 'Processing...';
    submitButton.classList.add('disabled');
}
</script>