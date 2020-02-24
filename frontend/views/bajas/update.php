<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bajas */

$this->title = 'Update Bajas: ' . $model->bajaID;
$this->params['breadcrumbs'][] = ['label' => 'Bajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bajaID, 'url' => ['view', 'id' => $model->bajaID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bajas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
