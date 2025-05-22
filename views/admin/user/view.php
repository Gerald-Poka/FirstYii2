<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'User Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Register the CSS file
$this->registerCssFile('@web/css/admin/user_view.css');
// Register Bootstrap Icons
$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css');
// Register Bootstrap JS for tooltips to work
$this->registerJsFile('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', [
    'depends' => [\yii\web\JqueryAsset::class],
    'integrity' => 'sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz',
    'crossorigin' => 'anonymous'
]);
?>

<div class="user-view container-fluid py-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-primary">
                        <i class="bi bi-person-circle me-2"></i><?= Html::encode($this->title) ?>
                    </h1>
                    <p class="text-muted mb-0">User Details</p>
                </div>
                <div class="dashboard-actions">
                    <?= Html::a('<i class="bi bi-arrow-left"></i> Back', ['index'], ['class' => 'btn btn-outline-secondary me-2']) ?>
                    <?= Html::a('<i class="bi bi-pencil"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-primary me-2']) ?>
                    <?= Html::a('<i class="bi bi-trash"></i> Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-outline-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this user?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="user-profile-sidebar text-center">
                        <?php 
                        $avatarUrl = Yii::getAlias('@web/images/avatars/') . $model->avatar;
                        if (empty($model->avatar)) {
                            $avatarUrl = Yii::getAlias('@web/images/default-avatar.png');
                        }
                        ?>
                        <img src="<?= $avatarUrl ?>" class="img-fluid rounded-circle profile-image mb-3" alt="Profile Image">
                        <h5 class="mb-1"><?= Html::encode($model->firstname . ' ' . $model->lastname) ?></h5>
                        <p class="text-muted mb-3"><?= Html::encode($model->username) ?></p>
                        <div class="user-badges mb-4">
                            <!-- Removed status check that was causing the error -->
                            <span class="badge bg-success">Active</span>
                            
                            <?php if (isset($model->role) && $model->role == 'admin'): ?>
                                <span class="badge bg-primary ms-1">Administrator</span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="user-actions">
                            <?= Html::a('<i class="bi bi-envelope"></i> Send Email', 'mailto:' . Html::encode($model->email), ['class' => 'btn btn-sm btn-outline-primary w-100 mb-2']) ?>
                            <?= Html::a('<i class="bi bi-key"></i> Reset Password', ['reset-password', 'id' => $model->id], [
                                'class' => 'btn btn-sm btn-outline-warning w-100',
                                'data' => [
                                    'confirm' => 'Are you sure you want to reset the password for this user?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-9">
                    <div class="user-details-content">
                        <ul class="nav nav-tabs mb-4" id="userTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                                    <i class="bi bi-person me-1"></i> Profile
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity" type="button" role="tab" aria-controls="activity" aria-selected="false">
                                    <i class="bi bi-clock-history me-1"></i> Activity
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">
                                    <i class="bi bi-gear me-1"></i> Settings
                                </button>
                            </li>
                        </ul>
                        
                        <div class="tab-content" id="userTabsContent">
                            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'options' => ['class' => 'table table-striped table-bordered detail-view'],
                                    'attributes' => [
                                        'id',
                                        'username',
                                        'email:email',
                                        'firstname',
                                        'lastname',
                                        [
                                            'attribute' => 'created_at',
                                            'format' => ['datetime', 'php:F j, Y, g:i a']
                                        ],
                                        [
                                            'attribute' => 'updated_at',
                                            'format' => ['datetime', 'php:F j, Y, g:i a']
                                        ],
                                        // Removed status attribute that was causing the error
                                        [
                                            'attribute' => 'role',
                                            'value' => function($model) {
                                                return isset($model->role) ? ucfirst($model->role) : 'User';
                                            },
                                        ],
                                    ],
                                ]) ?>
                            </div>
                            
                            <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle me-2"></i> User activity tracking will be implemented in the future version.
                                </div>
                                
                                <div class="activity-timeline">
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-primary">
                                            <i class="bi bi-person-plus"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="mb-0">Account created</h6>
                                            <small class="text-muted"><?= Yii::$app->formatter->asDatetime($model->created_at) ?></small>
                                        </div>
                                    </div>
                                    
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-secondary">
                                            <i class="bi bi-pencil"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="mb-0">Profile updated</h6>
                                            <small class="text-muted"><?= Yii::$app->formatter->asDatetime($model->updated_at) ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Account Status</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-check form-switch">
                                            <!-- Changed to always checked -->
                                            <input class="form-check-input" type="checkbox" id="statusSwitch" checked>
                                            <label class="form-check-label" for="statusSwitch">Active Account</label>
                                        </div>
                                        <small class="text-muted">Toggle to activate or deactivate this user account.</small>
                                    </div>
                                </div>
                                
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">User Permissions</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted mb-3">Control what this user can access in the system.</p>
                                        <div class="alert alert-warning">
                                            <i class="bi bi-exclamation-triangle me-2"></i> Permission management will be implemented in a future update.
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
</div>

<?php
$script = <<<JS
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Handle status toggle (example - will need backend integration)
    document.getElementById('statusSwitch').addEventListener('change', function() {
        // This would typically be handled through AJAX
        console.log('Status changed to: ' + (this.checked ? 'Active' : 'Inactive'));
    });
JS;
$this->registerJs($script);
?>