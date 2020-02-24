<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MaterialDevuelto */

$this->title = 'Create Material Devuelto';
$this->params['breadcrumbs'][] = ['label' => 'Material Devueltos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-devuelto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
