<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Docentes */

$this->title = 'Agregar Docentes';
$this->params['breadcrumbs'][] = ['label' => 'Listado de Docentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docentes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
