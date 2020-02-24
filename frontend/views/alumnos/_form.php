<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use frontend\models\Carreras;

/* @var $this yii\web\View */
/* @var $model frontend\models\Alumnos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alumnos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'noControl')->textInput() ?>

    <?= $form->field($model, 'alumnoNombre')->textInput(['maxlength' => true]) ?>


    <?=$form->field($model, 'alumnoCarreraNombre')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Carreras::find()->all(),'carreraNombre','carreraNombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'ELIGA CARRERA ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
