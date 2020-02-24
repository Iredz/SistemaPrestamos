<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MaterialDevuelto */

$this->title = 'Update Material Devuelto: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Material Devueltos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="material-devuelto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
