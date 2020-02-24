<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Inventario */

$this->title = 'Actualizar Inventario: ' . $model->descrMat;
$this->params['breadcrumbs'][] = ['label' => 'Listado de Inventarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->matID, 'url' => ['view', 'id' => $model->matID]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="inventario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
