<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model frontend\models\Prestamos */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="prestamos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Está seguro de borrarlo?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

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
                    'value' => time(),
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

</div>
