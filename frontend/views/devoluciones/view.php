<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Devoluciones */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Devoluciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="devoluciones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        
       
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'alumnoNoControl',
            'alumnoNombre',
            'recibeNombre',
            'observaciones:ntext',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider'=>$dataProvider,
        // 'filterModel'=> $searchModel,
        'layout'=>'{items}{pager}',
        'pjax'=>true,
        'columns'=>[
            //   ['class'=>'yii\grid\SerialColumn'],
            'matID',
            'materialNombre',
        ],


    ]);?>
    



</div>
