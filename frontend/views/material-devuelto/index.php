<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MaterialDevueltoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Material Devueltos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-devuelto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Material Devuelto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'matID',
            'materialNombre',
            'dev_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
