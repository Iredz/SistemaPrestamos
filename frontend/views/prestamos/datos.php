<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\grid\GridView;
use practically\chartjs\Chart;
use frontend\models\Prestamos;
use frontend\models\Materiales;




$this->title= 'Sección Reporte de Préstamos';
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][]=$this->title;
\yii\web\YiiAsset::register($this);

?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

<!--    PRIMERA TABLA   -->
<div>&emsp;</div><div>&emsp;</div>
<h2 style="text-align: center;">Número de alumnos por carrera que visitaron el laboratorio</h2>
<div>&emsp;</div>

<?php 
echo GridView::widget([
    'dataProvider'=>$sqlProvider,
    'layout'=>'{items}{pager}',
    'bordered'=>true,
    'striped'=>true,
    'responsive'=> false,
    'resizableColumns'=>true,
    'pjax'=>true,
    'pjaxSettings'=>[
        'neverTimeout'=>true, 
    ],
]);
?>

<!--    SEGUNDA TABLA   -->

<div>&emsp;</div><div>&emsp;</div>
<h2 style="text-align: center;">Número de veces que fue prestado el material didáctico</h2>
<div>&emsp;</div>

<?php
echo GridView::widget([
    'dataProvider'=>$sqlProvider2,
    'layout'=>'{items}{pager}',
    'bordered'=>true,
    'striped'=>true,
    'responsive'=> false,
    'resizableColumns'=>true,
    'pjax'=>true,
    'pjaxSettings'=>[
        'neverTimeout'=>true,
    ],
]);

?>

<!--    TERCERA TABLA   -->

<div>&emsp;</div><div>&emsp;</div>
<h2 style="text-align: center;">Número de visitas al laboratorio por materia</h2>
<div>&emsp;</div>

<?= GridView::widget([
    'dataProvider'=>$sqlProvider3,
    'layout'=>'{items}{pager}',
    'bordered'=>true,
    'striped'=>true,
    'responsive'=> false,
    'resizableColumns'=>true,
    'pjax'=>true,
    'pjaxSettings'=>[
        'neverTimeout'=>true,
    ],
]);?>

<!--    CUARTA TABLA   -->

<div>&emsp;</div><div>&emsp;</div>
<h2 style="text-align: center;">Número de visitas al laboratorio por docente</h2>
<div>&emsp;</div>

<?= GridView::widget([
    'dataProvider'=>$sqlProvider4,
    'layout'=>'{items}{pager}',
    'bordered'=>true,
    'striped'=>true,
    'responsive'=> true,
    'resizableColumns'=>true,
    'pjax'=>true,
    'pjaxSettings'=>[
        'neverTimeout'=>true,
    ],
]);?>


