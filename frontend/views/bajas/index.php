<?php

use yii\helpers\Html;
USE kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BajasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bajas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bajas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Procesar Baja de Material', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout'=>'{items}{pager}',
        'pjax'=>true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'bajaID',
            'matID',
            'descrMat',
            'razon:ntext',
            'bajaFecha',

            ['class' => 'yii\grid\ActionColumn','template'=>'{view}'],
        ],
    ]); ?>


</div>
