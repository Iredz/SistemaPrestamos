<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bajas */

$this->title = $model->bajaID;
$this->params['breadcrumbs'][] = ['label' => 'Bajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="bajas-view">

    <h1><?= Html::encode($this->title) ?></h1>

  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bajaID',
            'matID',
            'descrMat',
            'razon:ntext',
            [
                'attribute' => 'bajaFecha',
                'label' => 'Fecha dado de baja',
                'value' => time(),
                'language'=> 'es',
                'format' => 'date'
            ],
        ],
    ]) ?>

</div>
