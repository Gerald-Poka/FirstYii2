<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Job Listings';
$this->params['breadcrumbs'][] = $this->title;

// Register CSS
$this->registerCssFile('@web/css/admin/jobs.css');
?>

<div class="jobs-index container-fluid py-4">
    <div class="mb-3 text-end">
        <?= Html::a('<i class="bi bi-plus-lg"></i> Post New Job', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <div>
                <h1 class="h3 mb-0 text-primary">
                    <i class="bi bi-briefcase me-2"></i><?= Html::encode($this->title) ?>
                </h1>
                <p class="text-muted mb-0">Manage your job postings</p>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <?php Pjax::begin(['id' => 'jobs-grid-pjax']); ?>
                
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table table-striped table-hover'],
                    'summary' => '<div class="summary-info">Showing <b>{begin}-{end}</b> of <b>{totalCount}</b> jobs</div>',
                    'columns' => [
                        [
                            'attribute' => 'title',
                            'format' => 'raw',
                            'value' => function ($model) {
                                $statusClass = '';
                                $statusLabel = '';
                                
                                switch ($model->status) {
                                    case 0: 
                                        $statusClass = 'bg-secondary';
                                        $statusLabel = 'Draft';
                                        break;
                                    case 1:
                                        $statusClass = 'bg-success';
                                        $statusLabel = 'Published';
                                        break;
                                    case 2:
                                        $statusClass = 'bg-warning';
                                        $statusLabel = 'Closed';
                                        break;
                                }
                                
                                return '
                                    <div class="d-flex align-items-center">
                                        <div class="job-icon me-3">
                                            <i class="bi bi-briefcase"></i>
                                        </div>
                                        <div class="job-info">
                                            <h6 class="mb-0">' . Html::encode($model->title) . '</h6>
                                            <div class="mt-1">
                                                <span class="badge ' . $statusClass . ' me-2">' . $statusLabel . '</span>
                                                <small class="text-muted">' . Html::encode($model->location) . '</small>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            },
                        ],
                        [
                            'attribute' => 'job_type',
                            'filter' => [
                                'Full-time' => 'Full-time',
                                'Part-time' => 'Part-time',
                                'Contract' => 'Contract',
                                'Internship' => 'Internship',
                            ],
                            'contentOptions' => ['class' => 'align-middle'],
                        ],
                        [
                            'attribute' => 'created_at',
                            'format' => 'datetime',
                            'contentOptions' => ['class' => 'align-middle'],
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {update} {delete}',
                            'contentOptions' => ['class' => 'text-center align-middle'],
                            'buttons' => [
                                'view' => function ($url, $model, $key) {
                                    return Html::a('<i class="bi bi-eye"></i>', $url, [
                                        'class' => 'btn btn-sm btn-outline-primary me-1',
                                        'title' => 'View',
                                        'data-bs-toggle' => 'tooltip',
                                    ]);
                                },
                                'update' => function ($url, $model, $key) {
                                    return Html::a('<i class="bi bi-pencil"></i>', $url, [
                                        'class' => 'btn btn-sm btn-outline-warning me-1',
                                        'title' => 'Edit',
                                        'data-bs-toggle' => 'tooltip',
                                    ]);
                                },
                                'delete' => function ($url, $model, $key) {
                                    return Html::a('<i class="bi bi-trash"></i>', $url, [
                                        'class' => 'btn btn-sm btn-outline-danger delete-job',
                                        'title' => 'Delete',
                                        'data-bs-toggle' => 'tooltip',
                                        'data-job-title' => $model->title,
                                        'data-pjax' => '0',
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
</div>

<?php
// Add SweetAlert2 for job deletion confirmation
$script = <<<JS
$(document).ready(function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Add confirmation to delete links
    $(document).on('click', '.delete-job', function(e) {
        e.preventDefault();
        
        var deleteLink = $(this);
        var jobTitle = deleteLink.data('job-title');
        var deleteUrl = deleteLink.attr('href');
        
        // Hide any tooltips
        var tooltip = bootstrap.Tooltip.getInstance(this);
        if (tooltip) {
            tooltip.hide();
        }
        
        // Show SweetAlert confirmation
        Swal.fire({
            title: 'Confirm Deletion',
            html: 'Are you sure you want to delete job <strong>' + jobTitle + '</strong>?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef476f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            focusCancel: true,
            customClass: {
                container: 'swal-wider',
                popup: 'swal-job-delete'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Create a form for POST submission
                var form = $('<form>', {
                    'method': 'POST',
                    'action': deleteUrl
                });
                
                // Add CSRF token
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var csrfParam = $('meta[name="csrf-param"]').attr('content');
                
                if (csrfParam && csrfToken) {
                    form.append($('<input>', {
                        'type': 'hidden',
                        'name': csrfParam,
                        'value': csrfToken
                    }));
                }
                
                // Submit form
                $('body').append(form);
                form.submit();
            }
        });
    });
});
JS;
$this->registerJs($script);
?>