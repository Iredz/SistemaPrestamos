<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Carreras */

$this->title = 'Update Carreras: ' . $model->carreraID;
$this->params['breadcrumbs'][] = ['label' => 'Carreras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->carreraID, 'url' => ['view', 'id' => $model->carreraID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="carreras-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
