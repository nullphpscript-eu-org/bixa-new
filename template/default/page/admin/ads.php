<!-- Main Content -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Manage Ads</h4>
                        <div class="page-title-right">
                            <a href="<?= base_url('admin/edit_ad') ?>" class="btn btn-primary waves-effect waves-light">
                                <i class="bx bx-plus font-size-16 align-middle me-2"></i> Add New Ad
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Placement</th>
                                            <th>Code to Insert</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($ads)): ?>
                                            <?php foreach($ads as $ad): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($ad['ad_name']) ?></td>
                                                    <td><code><?= htmlspecialchars($ad['ad_placement']) ?></code></td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!-- PHP Code -->
                                                            <code class="me-2">&lt;?php display_ad('<?= $ad['ad_placement'] ?>'); ?&gt;</code>
                                                            
                                                            <!-- Copy Button -->
                                                            <button type="button" 
                                                                    class="btn btn-sm btn-light copy-code" 
                                                                    data-code="<?= htmlspecialchars("<?php display_ad('".$ad['ad_placement']."'); ?>") ?>"
                                                                    title="Copy code">
                                                                <i class="bx bx-copy"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-<?= $ad['ad_status'] == 'active' ? 'success' : 'warning' ?>">
                                                            <?= ucfirst($ad['ad_status']) ?>
                                                        </span>
                                                    </td>
                                                    <td><?= date('Y-m-d', $ad['ad_created']) ?></td>
                                                    <td class="text-end">
                                                        <div class="btn-group">
                                                            <!-- Preview Button -->
                                                            <button type="button" 
                                                                    class="btn btn-info btn-sm preview-ad" 
                                                                    data-bs-toggle="modal" 
                                                                    data-bs-target="#previewModal"
                                                                    data-content="<?= htmlspecialchars($ad['ad_content']) ?>"
                                                                    title="Preview">
                                                                <i class="bx bx-show"></i>
                                                            </button>
                                                            
                                                            <!-- Edit Button -->
                                                            <a href="<?= base_url('admin/edit_ad/'.$ad['ad_id']) ?>" 
                                                               class="btn btn-primary btn-sm"
                                                               title="Edit">
                                                                <i class="bx bx-edit"></i>
                                                            </a>
                                                            
                                                            <!-- Delete Button -->
                                                            <a href="<?= base_url('admin/delete_ad/'.$ad['ad_id']) ?>"
                                                               class="btn btn-danger btn-sm"
                                                               onclick="return confirm('Are you sure you want to delete this ad?')"
                                                               title="Delete">
                                                                <i class="bx bx-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center">No ads found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ad Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="border p-3 rounded preview-content"></div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for copy functionality and preview -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Copy code functionality
    document.querySelectorAll('.copy-code').forEach(button => {
        button.addEventListener('click', function() {
            const code = this.getAttribute('data-code');
            navigator.clipboard.writeText(code).then(() => {
                // Change button icon temporarily
                const icon = this.querySelector('i');
                icon.className = 'bx bx-check';
                setTimeout(() => {
                    icon.className = 'bx bx-copy';
                }, 1000);
                
                // Show toast or alert
                Toastify({
                    text: "Code copied to clipboard!",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    }
                }).showToast();
            });
        });
    });
    
    // Preview functionality
    document.querySelectorAll('.preview-ad').forEach(button => {
        button.addEventListener('click', function() {
            const content = this.getAttribute('data-content');
            document.querySelector('.preview-content').innerHTML = content;
        });
    });
});
</script>