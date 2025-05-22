<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Skills & Requirements';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid py-4">
    <div class="mb-3 text-end">
        <?= Html::a('<i class="fas fa-plus"></i> Add New Skill', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-tools me-2"></i> <?= Html::encode($this->title) ?>
            </h1>
            <p class="text-muted mb-0">Manage skills and requirements for job listings</p>
        </div>
        <div class="card-body">
            <?php Pjax::begin(); ?>
            
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'name',
                    [
                        'attribute' => 'description',
                        'format' => 'ntext',
                        'contentOptions' => ['class' => 'text-wrap'],
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update} {delete}',
                        'buttons' => [
                            'update' => function ($url) {
                                return Html::a('<i class="fas fa-edit"></i>', $url, [
                                    'class' => 'btn btn-sm btn-outline-primary',
                                    'title' => 'Update',
                                ]);
                            },
                            'delete' => function ($url) {
                                return Html::a('<i class="fas fa-trash"></i>', $url, [
                                    'class' => 'btn btn-sm btn-outline-danger',
                                    'title' => 'Delete',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this skill?',
                                        'method' => 'post',
                                    ],
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