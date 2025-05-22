<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Job Listings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Register CSS
$this->registerCssFile('@web/css/admin/jobs.css');
?>

<div class="jobs-view container-fluid py-4">
    <div class="mb-3 text-end">
        <?= Html::a('<i class="bi bi-arrow-left me-1"></i> Back to Jobs', ['index'], ['class' => 'btn btn-light me-2']) ?>
        <?= Html::a('<i class="bi bi-pencil-fill me-1"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary me-2']) ?>
        <?= Html::a('<i class="bi bi-trash-fill me-1"></i> Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this job?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    
    <div class="card shadow mb-4 rounded-card">
        <div class="card-header py-3">
            <div>
                <h1 class="h3 mb-0 text-white d-flex align-items-center">
                    <i class="bi bi-briefcase fs-3 me-2"></i>
                    <span><?= Html::encode($this->title) ?></span>
                </h1>
                <p class="text-white-50 mb-0 mt-2">Job listing details</p>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <?= DetailView::widget([
                        'model' => $model,
                        'options' => ['class' => 'table table-striped table-hover detail-view'],
                        'attributes' => [
                            'id',
                            'title',
                            'description:ntext',
                            'requirements:ntext',
                            'responsibilities:ntext',
                            'company_name',
                            'location',
                            'salary_range',
                            [
                                'attribute' => 'job_type',
                                'value' => function($model) {
                                    return $model->job_type;
                                }
                            ],
                            [
                                'attribute' => 'status',
                                'format' => 'raw',
                                'value' => function($model) {
                                    $statuses = [
                                        0 => '<span class="badge bg-secondary">Draft</span>',
                                        1 => '<span class="badge bg-success">Published</span>',
                                        2 => '<span class="badge bg-warning">Closed</span>',
                                    ];
                                    return $statuses[$model->status] ?? 'Unknown';
                                }
                            ],
                            'created_at:datetime',
                            'updated_at:datetime',
                            'expiry_date:date',
                        ],
                    ]) ?>
                </div>
                
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-tag-fill me-2"></i> Categories</h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($model->categories)): ?>
                                <?php foreach ($model->categories as $category): ?>
                                    <span class="badge bg-info mb-1 me-1 p-2"><?= Html::encode($category->name) ?></span>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted mb-0">No categories assigned</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-tools me-2"></i> Skills</h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($model->skills)): ?>
                                <?php foreach ($model->skills as $skill): ?>
                                    <span class="badge bg-secondary mb-1 me-1 p-2"><?= Html::encode($skill->name) ?></span>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted mb-0">No skills required</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$css = <<<CSS
/* Additional view-specific styles */
.detail-view th {
    width: 30%;
    background-color: #f8f9fa;
}

.card-header {
    background: linear-gradient(135deg, #0192af, #017792) !important;
}

.badge {
    font-weight: 500;
}
CSS;

$this->registerCss($css);
?>