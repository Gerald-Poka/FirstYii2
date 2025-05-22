<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Management';
$this->params['breadcrumbs'][] = $this->title;

// Register the CSS file
$this->registerCssFile('@web/css/admin/user_index.css');
// Register Bootstrap Icons instead of Font Awesome
$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css');
// Register Bootstrap JS for tooltips to work
$this->registerJsFile('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', [
    'depends' => [\yii\web\JqueryAsset::class],
    'integrity' => 'sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz',
    'crossorigin' => 'anonymous'
]);
// Register SweetAlert2
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sweetalert2@11', [
    'position' => \yii\web\View::POS_HEAD,
]);
?>

<div class="user-index container-fluid py-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-primary"><?= Html::encode($this->title) ?></h1>
                <div class="dashboard-actions">
                    <?= Html::a('<i class="bi bi-plus-lg"></i> Add New User', ['create'], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
            <p class="text-muted mb-0">Manage your system users</p>
        </div>
        
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6 col-lg-4 mb-3 mb-md-0">
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" id="user-search" placeholder="Search users..." class="form-control">
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-funnel"></i> Filters
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                            <li><a class="dropdown-item" href="#">Active Users</a></li>
                            <li><a class="dropdown-item" href="#">Admin Users</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Reset Filters</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <?php Pjax::begin(['id' => 'user-grid-pjax']); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => ['class' => 'table table-hover table-striped'],
                'summary' => '<div class="fs-6 text-muted mb-3">Showing <span class="fw-bold">{begin}-{end}</span> of <span class="fw-bold">{totalCount}</span> users</div>',
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'headerOptions' => ['class' => 'column-id'],
                        'contentOptions' => ['class' => 'column-id align-middle'],
                        'header' => '#',
                    ],
                    [
                        'attribute' => 'username',
                        'format' => 'raw',
                        'header' => 'Name',
                        'headerOptions' => ['class' => 'column-username'],
                        'contentOptions' => ['class' => 'column-username align-middle'],
                        'value' => function ($model) {
                            $avatarUrl = Yii::getAlias('@web/images/avatars/') . $model->avatar;
                            
                            if (empty($model->avatar)) {
                                $avatarUrl = Yii::getAlias('@web/images/default-avatar.png');
                            }
                            
                            // SVG fallback for when images don't load
                            $svgFallback = 'data:image/svg+xml;charset=utf-8,' . rawurlencode('
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="#cccccc">
                                    <circle cx="32" cy="32" r="32" fill="#f0f0f0"/>
                                    <circle cx="32" cy="26" r="12"/>
                                    <path d="M18 49.3C18 42 24.3 36 32 36s14 6 14 13.3v0.7H18v-0.7z"/>
                                </svg>
                            ');
                        
                            return '
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="' . $avatarUrl . '" class="rounded-circle" width="40" height="40" alt="Avatar" onerror="this.src=\'' . $svgFallback . '\'">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">' . Html::encode($model->username) . '</h6>
                                        <div class="small text-muted">' . Html::encode($model->firstname . ' ' . $model->lastname) . '</div>
                                    </div>
                                </div>
                            ';
                        },
                    ],
                    [
                        'attribute' => 'email',
                        'format' => 'raw', 
                        'headerOptions' => ['class' => 'column-email'],
                        'contentOptions' => ['class' => 'column-email align-middle'],
                        'value' => function ($model) {
                            return '<span class="d-inline-flex align-items-center"><i class="bi bi-envelope me-2 text-muted"></i>' . Html::encode($model->email) . '</span>';
                        },
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete}',
                        'headerOptions' => ['class' => 'column-actions text-center'],
                        'contentOptions' => ['class' => 'column-actions text-center align-middle'],
                        'header' => 'Actions',
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::a('<i class="bi bi-eye"></i>', $url, [
                                    'class' => 'btn btn-sm btn-outline-primary me-1',
                                    'title' => 'View Details',
                                    'data-bs-toggle' => 'tooltip',
                                ]);
                            },
                            'update' => function ($url, $model, $key) {
                                return Html::a('<i class="bi bi-pencil"></i>', $url, [
                                    'class' => 'btn btn-sm btn-outline-warning me-1',
                                    'title' => 'Edit User',
                                    'data-bs-toggle' => 'tooltip',
                                ]);
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('<i class="bi bi-trash"></i>', ['delete', 'id' => $model->id], [
                                    'class' => 'btn btn-sm btn-outline-danger delete-confirm',
                                    'title' => 'Delete User',
                                    'data-bs-toggle' => 'tooltip',
                                    'data-username' => $model->username,
                                ]);
                            },
                        ],
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>

<?php
// Replace the existing delete confirmation script with this:

$script = <<<JS
$(document).ready(function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Add confirmation to delete links
    $(document).on('click', '.delete-confirm', function(e) {
        e.preventDefault(); // Prevent default link behavior
        
        var deleteLink = $(this);
        var username = deleteLink.data('username');
        
        // Hide any tooltips
        var tooltip = bootstrap.Tooltip.getInstance(this);
        if (tooltip) {
            tooltip.hide();
        }
        
        // First SweetAlert - Confirm deletion
        Swal.fire({
            title: 'Confirm Deletion',
            html: 'Are you sure you want to delete user <strong>' + username + '</strong>?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef476f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, proceed',
            cancelButtonText: 'Cancel',
            focusCancel: true,
            customClass: {
                container: 'swal-wider',
                popup: 'swal-user-delete'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Instead of deleting, show the "contact super admin" message
                Swal.fire({
                    title: 'Action Not Permitted',
                    html: 'User <strong>' + username + '</strong> cannot be deleted.<br><br>Please contact the super administrator to request user deletion.',
                    icon: 'info',
                    confirmButtonColor: '#0192af',
                    confirmButtonText: 'Understood',
                    customClass: {
                        container: 'swal-wider',
                        popup: 'swal-user-info'
                    }
                });
            }
        });
    });
    
    // Simple client-side search
    $('#user-search').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#user-grid-pjax table tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
JS;

$this->registerJs($script);
?>
