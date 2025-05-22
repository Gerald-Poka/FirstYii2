<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create Job Category';
$this->params['breadcrumbs'][] = ['label' => 'Job Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="job-categories-create container-fluid py-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h1 class="h3 mb-0 text-primary">
                <i class="bi bi-folder-plus me-2"></i> <?= Html::encode($this->title) ?>
            </h1>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'status')->checkbox(['value' => 1]) ?>

                    <div class="form-group text-center mt-4">
                        <?= Html::submitButton('<i class="bi bi-check-lg me-2"></i> Save', ['class' => 'btn btn-success px-4']) ?>
                        <?= Html::a('<i class="bi bi-x-lg me-2"></i> Cancel', ['index'], ['class' => 'btn btn-secondary px-4 ms-2']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>