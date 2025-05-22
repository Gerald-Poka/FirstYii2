<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Job Categories';
$this->params['breadcrumbs'][] = $this->title;

// Register CSS
$this->registerCssFile('@web/css/admin/jobs.css');
?>

<div class="job-categories-index container-fluid py-4">
    <!-- Floating Add Button with Animation -->
    <div class="floating-action-btn mb-3">
        <?= Html::a('<i class="bi bi-plus-lg me-2"></i> Add New Category', ['create'], [
            'class' => 'btn btn-success btn-lg shadow pulse-animation'
        ]) ?>
    </div>

    <div class="card shadow mb-4 rounded-card">
        <div class="card-header py-3">
            <div>
                <h1 class="h3 mb-0 text-white d-flex align-items-center">
                    <i class="bi bi-folder-fill fs-3 me-2"></i>
                    <span><?= Html::encode($this->title) ?></span>
                </h1>
                <p class="text-white-50 mb-0 mt-2">Manage your job categories and classifications</p>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <?php Pjax::begin(['id' => 'categories-grid-pjax']); ?>
                
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'tableOptions' => ['class' => 'table table-striped table-hover category-table'],
                    'summary' => '<div class="summary-info mb-3">Showing <b>{begin}-{end}</b> of <b>{totalCount}</b> categories</div>',
                    'columns' => [
                        [
                            'attribute' => 'name',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return '<div class="d-flex align-items-center">
                                    <div class="category-icon me-3">
                                        <i class="bi bi-tag-fill"></i>
                                    </div>
                                    <div class="fw-bold">' . Html::encode($model->name) . '</div>
                                </div>';
                            },
                            'contentOptions' => ['class' => 'align-middle'],
                        ],
                        [
                            'attribute' => 'description',
                            'format' => 'ntext',
                            'contentOptions' => ['class' => 'align-middle text-wrap', 'style' => 'max-width: 350px;'],
                        ],
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'contentOptions' => ['class' => 'align-middle text-center'],
                            'value' => function ($model) {
                                $label = $model->status ? 'Active' : 'Inactive';
                                $class = $model->status ? 'bg-success' : 'bg-secondary';
                                $icon = $model->status ? 'bi-check-circle-fill' : 'bi-dash-circle-fill';
                                return '<div class="status-badge">
                                    <span class="badge ' . $class . ' px-3 py-2">
                                        <i class="bi ' . $icon . ' me-1"></i>' . $label . '
                                    </span>
                                </div>';
                            },
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {delete}',
                            'contentOptions' => ['class' => 'text-center align-middle action-column'],
                            'buttons' => [
                                'update' => function ($url, $model, $key) {
                                    return Html::a('<i class="bi bi-pencil-fill"></i>', $url, [
                                        'class' => 'btn btn-sm btn-outline-primary me-1 action-btn',
                                        'title' => 'Edit',
                                        'data-bs-toggle' => 'tooltip',
                                    ]);
                                },
                                'delete' => function ($url, $model, $key) {
                                    return Html::a('<i class="bi bi-trash-fill"></i>', $url, [
                                        'class' => 'btn btn-sm btn-outline-danger delete-category action-btn',
                                        'title' => 'Delete',
                                        'data-bs-toggle' => 'tooltip',
                                        'data-category-name' => $model->name,
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
// Add SweetAlert2 & custom styling
$css = <<<CSS
/* Enhanced styles for job categories */
.floating-action-btn {
    text-align: right;
}

.rounded-card {
    border-radius: 1rem;
    overflow: hidden;
}

.card-header {
    background: linear-gradient(135deg, #0192af, #017792) !important;
    padding: 1.8rem !important;
}

.category-table {
    --bs-table-striped-bg: rgba(1, 146, 175, 0.04);
    border-collapse: separate;
    border-spacing: 0;
    margin-top: 0.5rem;
}

.category-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: linear-gradient(135deg, #0192af, #017792);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.action-btn {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin: 0 3px;
    transition: all 0.2s;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.btn-outline-primary {
    border-color: #0192af;
    color: #0192af;
}

.btn-outline-primary:hover {
    background-color: #0192af;
    color: white;
}

.btn-outline-danger:hover {
    background-color: #ef476f;
    border-color: #ef476f;
    color: white;
}

.status-badge .badge {
    font-weight: 500;
    font-size: 0.85rem;
}

.summary-info {
    color: #64748b;
    font-weight: 500;
}

/* Pulsing animation for the add button */
.pulse-animation {
    box-shadow: 0 0 0 rgba(6, 214, 160, 0.4);
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(6, 214, 160, 0.4);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(6, 214, 160, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(6, 214, 160, 0);
    }
}

/* Making sure action column is properly displayed */
.action-column {
    min-width: 110px;
}

.grid-view th {
    white-space: nowrap;
    background: #f8fafc;
    padding: 1rem 0.75rem;
    font-weight: 600;
    color: #334155;
}
CSS;

$this->registerCss($css);

// Add SweetAlert2 for deletion confirmation
$script = <<<JS
$(document).ready(function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Add confirmation to delete links
    $(document).on('click', '.delete-category', function(e) {
        e.preventDefault();
        
        var deleteLink = $(this);
        var categoryName = deleteLink.data('category-name');
        var deleteUrl = deleteLink.attr('href');
        
        // Hide any tooltips
        var tooltip = bootstrap.Tooltip.getInstance(this);
        if (tooltip) {
            tooltip.hide();
        }
        
        // Show SweetAlert confirmation
        Swal.fire({
            title: 'Confirm Deletion',
            html: 'Are you sure you want to delete category <strong>' + categoryName + '</strong>?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef476f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="bi bi-trash me-1"></i> Yes, delete it!',
            cancelButtonText: '<i class="bi bi-x-circle me-1"></i> Cancel',
            focusCancel: true,
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: true
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