<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\db\Query;
use miloschuman\highcharts\Highstock;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;
use practically\chartjs\Chart;
use frontend\models\Prestamos;
use frontend\models\Materiales;




$this->title= 'Sección Reporte de Préstamos';
$this->params['breadcrumbs'][]=$this->title;

?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

<!--    PRIMERA TABLA   -->
<div>&emsp;</div><div>&emsp;</div>
<h2 style="text-align: center;">Número de alumnos por carrera que visitaron el laboratorio</h2>
<div>&emsp;</div>

<?= GridView::widget([
    'dataProvider'=>$sqlProvider,
    'layout'=>'{items}{pager}'
]);?>

<!--    SEGUNDA TABLA   -->

<div>&emsp;</div><div>&emsp;</div>
<h2 style="text-align: center;">Número de veces que fue prestado el material didáctico</h2>
<div>&emsp;</div>

<?= GridView::widget([
    'dataProvider'=>$sqlProvider2,
    'layout'=>'{items}{pager}'
]);

?>

<!--    TERCERA TABLA   -->

<div>&emsp;</div><div>&emsp;</div>
<h2 style="text-align: center;">Número de visitas al laboratorio por materia</h2>
<div>&emsp;</div>

<?= GridView::widget([
    'dataProvider'=>$sqlProvider3,
    'layout'=>'{items}{pager}'
]);?>

<!--    CUARTA TABLA   -->

<div>&emsp;</div><div>&emsp;</div>
<h2 style="text-align: center;">Número de visitas al laboratorio por docente</h2>
<div>&emsp;</div>

<?= GridView::widget([
    'dataProvider'=>$sqlProvider4,
    'layout'=>'{items}{pager}'
]);?>


