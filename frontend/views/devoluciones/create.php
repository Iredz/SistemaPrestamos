<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Devoluciones */

$this->title = 'Create Devoluciones';
$this->params['breadcrumbs'][] = ['label' => 'Devoluciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="devoluciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsMaterialDevuelto'=>$modelsMaterialDevuelto,
    ]) ?>

</div>
