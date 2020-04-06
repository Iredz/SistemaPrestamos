<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\DetailView;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $model frontend\models\Prestamos */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="prestamos-view">

    <h1><?= Html::encode($this->title) ?></h1>

 

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            [
                    'attribute' => 'id',
                    'label' => 'ID del Estudiante'
            ],

            'noControlAlumno',
            'nombreAlumno',

            [
                'attribute' => 'materiaID',
                'label'=> 'Materia',
                'value'=>$model->materianom->materiaNombre,

            ],
           [
                   'attribute' => 'docenteID',
                    'label'=> 'Docente',
                    'value'=>$model->docentenom->docenteNombre,

           ],
            'periodo',

            [
                    'attribute' => 'fecha',
                    'label' => 'Fecha',
                    'value' => $model->fecha,
                    'language'=> 'es',
                    'format' => 'date'
            ],
            'observaciones:ntext',

            [
                'attribute' => 'entregaNombre',
                'label'=> 'Entregó'
            ],

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
