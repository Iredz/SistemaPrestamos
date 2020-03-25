<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;
use miloschuman\highcharts\Highstock;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use frontend\models\Prestamos;
use frontend\models\Materiales;



/*
print"<pre>";


echo $JSON;

print"</pre>";
*/


$this->title= 'Reporte de Préstamos';
$this->params['breadcrumbs'][]=$this->title;

?>

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
]);?>

<!--    TERCERA TABLA   -->

<div>&emsp;</div><div>&emsp;</div>
<h2 style="text-align: center;">Número de visitas al laboratorio por materia</h2>
<div>&emsp;</div>

<?= GridView::widget([
    'dataProvider'=>$sqlProvider3,
    'layout'=>'{items}{pager}'
]);?>




