<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">HTML Content Management</h4>
                        <a href="<?= base_url('admin/html/add')?>" class="btn btn-primary waves-effect waves-light">
                            <i data-feather="plus" class="me-1"></i> Add New
                        </a>
                    </div>
                </div>
            </div>

           

            <!-- Content List -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th class="text-center">Status</th>
                                            <th>Last Updated</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($contents)): ?>
                                            <?php foreach($contents as $item): ?>
                                            <tr>
                                                <td>
                                                    <h5 class="font-size-14 mb-1">
                                                        <?= htmlspecialchars($item->name) ?>
                                                    </h5>
                                                    <small class="text-muted">
                                                        <?= substr(strip_tags($item->content), 0, 100) ?>...
                                                    </small>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($item->is_active): ?>
                                                        <span class="badge bg-success">Active</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary">Inactive</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?= date('M d, Y h:i A', strtotime($item->updated_at)) ?>
                                                </td>
                                                <td class="text-end">
                                                    <!-- Edit Button -->
                                                    <a href="<?= base_url('admin/html/edit/'.$item->id) ?>" 
                                                       class="btn btn-primary btn-sm waves-effect waves-light me-1">
                                                        <i data-feather="edit-2" class="icon-xs me-1"></i>
                                                        Edit
                                                    </a>

                                                    <?php if(!$item->is_active): ?>
                                                        <!-- Set Active Button -->
                                                        <button type="button" 
                                                                class="btn btn-success btn-sm waves-effect waves-light me-1"
                                                                onclick="setActive(<?= $item->id ?>)">
                                                            <i data-feather="check-circle" class="icon-xs me-1"></i>
                                                            Set Active
                                                        </button>

                                                        <!-- Delete Button -->
                                                        <button type="button" 
                                                                class="btn btn-danger btn-sm waves-effect waves-light"
                                                                onclick="deleteContent(<?= $item->id ?>)">
                                                            <i data-feather="trash-2" class="icon-xs me-1"></i>
                                                            Delete
                                                        </button>
                                                    <?php else: ?>
                                                        <!-- Set Inactive Button -->
                                                        <button type="button" 
                                                                class="btn btn-warning btn-sm waves-effect waves-light"
                                                                onclick="setInactive(<?= $item->id ?>)">
                                                            <i data-feather="x-circle" class="icon-xs me-1"></i>
                                                            Set Inactive
                                                        </button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center py-4">
                                                    <div class="text-muted">No HTML content found</div>
                                                </td>
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

<!-- Add SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Initialize Feather Icons
if(typeof feather !== 'undefined') {
    feather.replace();
}

// Set Active Function
function setActive(id) {
    Swal.fire({
        title: 'Confirm Action',
        text: 'Are you sure you want to make this content active? This will deactivate the current active content.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, make it active'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= base_url('admin/html/set-active/') ?>' + id;
        }
    });
}

// Set Inactive Function
function setInactive(id) {
    Swal.fire({
        title: 'Confirm Action',
        text: 'Are you sure you want to deactivate this content? You will need to set another content as active.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, deactivate it'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= base_url('admin/html/set-inactive/') ?>' + id;
        }
    });
}

// Delete Function
function deleteContent(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= base_url('admin/html/delete/') ?>' + id;
        }
    });
}
</script>