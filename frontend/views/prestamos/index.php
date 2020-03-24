<?php

use yii\helpers\Html;
use frontend\models\MaterialesSearch;
use yii\grid\GridView;





/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PrestamosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prestamos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Procesar Prestamo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
            'class' => 'yii\grid\SerialColumn'],
            

        


            [
                    'attribute' => 'id',
                    'label' => ''
            ],

            [
                    'attribute' => 'noControlAlumno',
                    'label' => 'No. control'
            ],

            'nombreAlumno',

            [
                'attribute'=>'materiaID',
                'label'=> 'Materia',
                'value' =>'materianom.materiaNombre',


            ],
            [
                    'attribute'=>'docenteID',
                    'label'=> 'Docente',
                    'value' =>'docentenom.docenteNombre',


            ],
            //'periodo',

            [
                'attribute'=>'fecha',
                'format'=>'date',

            ],

            //'observaciones:ntext',

            [
                    'attribute' => 'entregaNombre',
                    'label'=> 'Entregó'
            ],

            ['class' => 'yii\grid\ActionColumn','template' =>'{view}'],
        ],
    ]); ?>


</div>
