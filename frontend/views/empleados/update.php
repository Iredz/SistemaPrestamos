<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Empleados */

$this->title = 'Update Empleados: ' . $model->empleadoID;
$this->params['breadcrumbs'][] = ['label' => 'Empleados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->empleadoID, 'url' => ['view', 'id' => $model->empleadoID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="empleados-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
