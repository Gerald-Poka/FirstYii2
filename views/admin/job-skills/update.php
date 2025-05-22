<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Update Skill: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Skills & Requirements', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid py-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-edit me-2"></i> <?= Html::encode($this->title) ?>
            </h1>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

                    <div class="form-group mt-4">
                        <?= Html::submitButton('<i class="fas fa-save me-1"></i> Update Skill', ['class' => 'btn btn-success']) ?>
                        <?= Html::a('<i class="fas fa-times me-1"></i> Cancel', ['index'], ['class' => 'btn btn-secondary ms-2']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>