<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Periodos */

$this->title = 'Update Periodos: ' . $model->periodoID;
$this->params['breadcrumbs'][] = ['label' => 'Periodos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->periodoID, 'url' => ['view', 'id' => $model->periodoID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="periodos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
