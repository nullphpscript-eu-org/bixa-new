<!-- Main Content -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Email Templates</h4>
                        
                        <!-- Type Selector -->
                        <div class="btn-group">
                            <a href="<?= base_url('email/templates?type=user') ?>" class="btn btn<?= $active !== 'admin' ? '' : '-outline' ?>-primary">
                                User Templates
                            </a>
                            <a href="<?= base_url('email/templates?type=admin') ?>" class="btn btn<?= $active === 'admin' ? '' : '-outline' ?>-primary">
                                Admin Templates
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Email Templates Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0"><?= $active === 'admin' ? 'Admin' : 'User' ?> Email Templates</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th width="45%">Subject</th>
                                            <th width="25%">Used For</th>
                                            <th width="20%">Trigger</th>
                                            <th width="5%" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $count = 1;
                                        $filtered_list = array_filter($list, function($item) use ($active) {
                                            return $item['email_for'] === ($active === 'admin' ? 'admin' : 'user');
                                        });
                                        
                                        if (count($filtered_list) > 0): 
                                            foreach ($filtered_list as $item): 
                                        ?>
                                            <tr>
                                                <td><?php echo $count ?></td>
                                                <td><?= $item['email_subject'] ?></td>
                                                <td>
                                                    <?php if($item['email_for'] == 'admin'): ?>
                                                        <span class="badge bg-info">Admin</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-primary">User</span>
                                                    <?php endif; ?>
                                                    
                                                    <?php
                                                    $usedFor = '';
                                                    switch($item['email_id']) {
                                                        case 'new_user':
                                                            $usedFor = 'New User Registration';
                                                            break;
                                                        case 'forget_password':
                                                            $usedFor = 'Password Reset';
                                                            break;
                                                        case 'new_ticket':
                                                            $usedFor = 'New Ticket'; 
                                                            break;
                                                        case 'reply_ticket':
                                                            $usedFor = 'Ticket Reply';
                                                            break;
                                                        case 'account_created':
                                                            $usedFor = 'Account Creation';
                                                            break;
                                                        case 'account_suspended':
                                                            $usedFor = 'Account Suspension';
                                                            break;    
                                                        case 'account_reactivated':
                                                            $usedFor = 'Account Reactivation';
                                                            break;
                                                        case 'delete_account':
                                                            $usedFor = 'Account Deletion';
                                                            break;
                                                        default:
                                                            $usedFor = ucwords(str_replace('_', ' ', $item['email_id']));
                                                    }
                                                    ?>
                                                    <div class="small text-muted mt-1"><?= $usedFor ?></div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary">
                                                        <?= strtoupper($item['email_id']) ?>
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?= base_url().'email/edit/'.$item['email_id'].'?type='.$item['email_for'] ?>" 
                                                       class="btn btn-primary btn-sm waves-effect waves-light">
                                                        <i data-feather="edit" class="font-size-16"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php 
                                                $count++;
                                            endforeach;
                                        else: 
                                        ?>
                                            <tr>
                                                <td colspan="5" class="text-center">Nothing to show</td>
                                            </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-muted">
                                <i data-feather="mail" class="font-size-16 align-middle me-2"></i>
                                <?= count($filtered_list) ?> <?= $active === 'admin' ? 'Admin' : 'User' ?> Email Templates
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize Feather Icons
document.addEventListener('DOMContentLoaded', function() {
    feather.replace();
});
</script>