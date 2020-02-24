<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MaterialDevuelto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="material-devuelto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'matID')->textInput() ?>

    <?= $form->field($model, 'materialNombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dev_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
