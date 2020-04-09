<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\data\SqlDataProvider;
use frontend\models\Prestamos;
use frontend\controllers\PrestamosController;
use frontend\models\Materiales;
use yii\web\YiiAsset;
use yii\db\Command;
use yii\db\Connection;
use yii\web\Application;



$this->title= 'Sección Reporte de Préstamos';
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][]=$this->title;
YiiAsset::register($this);

?>
<?=
Html::a('Exportar a PDF', ['/prestamos/datos-pdf'], [
    'class'=>'btn btn-success', 
    'target'=>'_blank', 
    'data-toggle'=>'tooltip', 
    'title'=>'Abrirá un PDF generado en otra ventana'
]);

?>



<!--    PRIMERA TABLA   -->
<div>&emsp;</div>
<h2 style="text-align: center;">Número de alumnos por carrera que visitaron el laboratorio</h2>


<?= 
 GridView::widget([
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

<div>&emsp;</div>
<h2 style="text-align: center;">Número de veces que fue prestado el material didáctico</h2>

<?=
GridView::widget([
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

<div>&emsp;</div>
<h2 style="text-align: center;">Número de visitas al laboratorio por materia</h2>


<?= 
GridView::widget([
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
]);

?>

<!--    CUARTA TABLA   -->

<div>&emsp;</div>
<h2 style="text-align: center;">Número de visitas al laboratorio por docente</h2>


<?= 
GridView::widget([
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
]);


echo Html::a('Borrar Datos', ['prestamos/borrar-tablas'], 
    [
        'class'=>'btn btn-danger',
        'data-confirm'=>'Está seguro de borrar los datos?'
    ]);


?>


