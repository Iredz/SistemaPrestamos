<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\InventarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventario';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Inventario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>function($model){
            if($model->estatus == 'P')
            {
                return['class'=>'danger'];
            }else if($model->estatus == 'D')
            {
                return['class'=>'success'];
            }else if($model->estatus == 'B'){
                return['class'=>'warning'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'matID',
            'descrMat',
            'marca',
            'modelo',
            'serie',
            'noInventario',
            //'estatus',

            ['class' => 'yii\grid\ActionColumn','template'=>'{view}'],
        ],
    ]); ?>


</div>
