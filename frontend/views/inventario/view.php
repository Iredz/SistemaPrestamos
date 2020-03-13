<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Inventario */

$this->title = $model->descrMat;

$this->params['breadcrumbs'][] = ['label' => 'Listado de Inventario', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="inventario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->matID], ['class' => 'btn btn-primary']) ?>
      
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'matID',
            'descrMat',
            'marca',
            'modelo',
            'serie',
            'noInventario',
            'estatus',
        ],
    ]) ?>

</div>
