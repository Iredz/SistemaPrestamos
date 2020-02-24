<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Docentes */

$this->title = 'Actualizar Docente: ' . $model->docenteNombre;
$this->params['breadcrumbs'][] = ['label' => 'Listado de Docentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->docenteID, 'url' => ['view', 'id' => $model->docenteID]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="docentes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
