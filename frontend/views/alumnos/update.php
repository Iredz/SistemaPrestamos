<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Alumnos */

$this->title = 'Actualizar Alumno: ' . $model->alumnoNombre;
$this->params['breadcrumbs'][] = ['label' => 'Listado de Alumnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->noControl, 'url' => ['view', 'id' => $model->noControl]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="alumnos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
