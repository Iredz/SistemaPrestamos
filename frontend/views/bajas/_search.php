<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BajasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bajas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bajaID') ?>

    <?= $form->field($model, 'matID') ?>

    <?= $form->field($model, 'descrMat') ?>

    <?= $form->field($model, 'razon') ?>

    <?= $form->field($model, 'bajaFecha') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
