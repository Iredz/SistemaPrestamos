<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Materias */

$this->title = 'Update Materias: ' . $model->materiaID;
$this->params['breadcrumbs'][] = ['label' => 'Materias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->materiaID, 'url' => ['view', 'id' => $model->materiaID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="materias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
