<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use frontend\models\Inventario;
use frontend\models\Docentes;
use frontend\models\Alumnos;
use frontend\models\Materias;
use frontend\models\Empleados;
use frontend\models\Periodos;

/* @var $this yii\web\View */
/* @var $model frontend\models\Prestamos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prestamos-form">


    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>




    <?= $form->field($model, 'noControlAlumno')->textInput(['maxlength' => true,
        'onchange'=>'

                
                    $.get("index.php?r=alumnos/get-nombre-alumno&noControl="+$(this).val(),function (data){
                        
                        var data = $.parseJSON(data);
                        if (data !== null) {
                        

                        console.log(data.alumnoNombre);
                        $("#prestamos-nombrealumno").val(data.alumnoNombre);
                        }else {
                            alert("Alumno no registrado");
                        }
                    });

        ']);

    ?>



    <?= $form->field($model, 'nombreAlumno')->textInput(['maxlength' => true]) ?>



    <?=$form->field($model, 'materiaID')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Materias::find()->all(),'materiaID','materiaNombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'ELIGA MATERIA ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>



    <?=$form->field($model, 'docenteID')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Docentes::find()->all(),'docenteID','docenteNombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'ELIGA DOCENTE ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>



    <?= $form->field($model, 'periodo')->dropDownList
    (ArrayHelper::map(Periodos::find()->all(),'periodoNombre','periodoNombre'),
        ['prompt'=>'ELIGA PERIODO'])
    ?>

    <?= $form->field($model, 'fecha')->widget(DatePicker::class, [
        'language' => 'es',
        'dateFormat' => 'yyyy-MM-dd',
        ]) 
    ?>


   <div class="rows">
   
   <div class="panel panel-default">
    <div class="panel-heading"><h4><i class="glyphicon glyphicon-th-list"></i>Material Didáctico</h4></div>
    <div class="panel-body">
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // requerido: solo carácteres alfanuméricos mas "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // requerido: clase selector css
            'widgetItem' => '.item', // requerido: clase css
            'limit' => 8, // Numero maximo de veces que un elemento puede ser clonado (predeterminado 999)
            'min' => 1, // 0 o 1 (predeterminado 1)
            'insertButton' => '.add-item', // clase css
            'deleteButton' => '.remove-item', // clase css
            'model' => $modelsMateriales[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'matID',
                'materialNombre',

            ],
        ]); ?>

        <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsMateriales as $i => $modelMateriales): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Material</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                        // necesario para la acción de actualización.
                        if (! $modelMateriales->isNewRecord) {
                            echo Html::activeHiddenInput($modelMateriales, "[{$i}]id");
                        }
                        ?>

                        <div class="row">
                            <div class="col-sm-6">
                            
                                <?= $form->field($modelMateriales, "[{$i}]matID")->textInput(['maxlength' => true]);?>
                                
                              
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelMateriales, "[{$i}]materialNombre")->textInput(['maxlength' => true]);?>
                            </div>
                        </div><!-- .row -->

            <?php endforeach; ?>
        </div>
        <?php DynamicFormWidget::end(); ?>
    </div>
</div>

   </div>

    <?= $form->field($model, 'observaciones')->textarea(['rows' => 6]) ?>

    <?=$form->field($model, 'entregaNombre')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Empleados::find()->all(),'empleadoNombre','empleadoNombre'),
        'language' => 'es',
        'options' => ['placeholder' => 'ELIGA QUIEN ENTREGA EL MATERIAL ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php

$script0 = <<< JS

$("#materiales-0-matid").on('change',function(){
        $.get("index.php?r=inventario/get-nombre-material&matID="+$(this).val(),function (data){
            var data = $.parseJSON(data);
            console.log(data);
            if (data == null){
                alert("Material Inexistente");
            }else{
                if (data.estatus == 'P'){
                    alert("Material en prestamo");
                }else if (data.estatus == 'B'){
                    alert("Material dado de baja");
                }else{
                    $("#materiales-0-materialnombre").val(data.descrMat);
                }
            }
                  
     
        });

    });


JS;
$this->registerJS($script0);
?>


<?php


$script1 = <<< JS


$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    console.log("beforeInsert")
  
});

$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    console.log("afterInsert")
    
    $("#materiales-0-matid").on('change',function(){
        $.get("index.php?r=inventario/get-nombre-material&matID="+$(this).val(),function (data){
            var data = $.parseJSON(data);
            

            console.log(data);
            if (data == null){
                alert("Material Inexistente");
            }else{
                if (data.estatus == 'P'){
                    alert("Material en prestamo");
                }else if (data.estatus == 'B'){
                    alert("Material dado de baja");
                }else{
                    $("#materiales-0-materialnombre").val(data.descrMat);
                }
            }
        
      
       
     
        });

    });

    
    

    $("#materiales-1-matid").on('change',function(){
        $.get("index.php?r=inventario/get-nombre-material&matID="+$(this).val(),function (data){
            var data = $.parseJSON(data);
            

            console.log(data);
            if (data == null){
                alert("Material Inexistente");
            }else{
                if (data.estatus == 'P'){
                    alert("Material en prestamo");
                }else if (data.estatus == 'B'){
                    alert("Material dado de baja");
                }else{
                    $("#materiales-1-materialnombre").val(data.descrMat);

                }
            }

        
      
       
     
        });

    });

    $("#materiales-2-matid").on('change',function(){
        $.get("index.php?r=inventario/get-nombre-material&matID="+$(this).val(),function (data){
            var data = $.parseJSON(data);
            

            console.log(data);
            if (data == null){
                alert("Material Inexistente");
            }else{
                if (data.estatus == 'P'){
                    alert("Material en prestamo");
                }else if (data.estatus == 'B'){
                    alert("Material dado de baja");
                }else{
                    $("#materiales-2-materialnombre").val(data.descrMat);

                }
            }

        
      
       
     
        });

    });

    

    $("#materiales-3-matid").on('change',function(){
        $.get("index.php?r=inventario/get-nombre-material&matID="+$(this).val(),function (data){
            var data = $.parseJSON(data);
            

            console.log(data);
            if (data == null){
                alert("Material Inexistente");
            }else{
                if (data.estatus == 'P'){
                    alert("Material en prestamo");
                }else if (data.estatus == 'B'){
                    alert("Material dado de baja");
                }else{
                    $("#materiales-3-materialnombre").val(data.descrMat);

                }
            }

        
      
       
     
        });

    });

   
    $("#materiales-4-matid").on('change',function(){
        $.get("index.php?r=inventario/get-nombre-material&matID="+$(this).val(),function (data){
            var data = $.parseJSON(data);
            

            console.log(data);
            if (data == null){
                alert("Material Inexistente");
            }else{
                if (data.estatus == 'P'){
                    alert("Material en prestamo");
                }else if (data.estatus == 'B'){
                    alert("Material dado de baja");
                }else{
                    $("#materiales-4-materialnombre").val(data.descrMat);

                }
            }

        
      
       
     
        });

    });

    


    $("#materiales-5-matid").on('change',function(){
        $.get("index.php?r=inventario/get-nombre-material&matID="+$(this).val(),function (data){
            var data = $.parseJSON(data);
            

            console.log(data);
            if (data == null){
                alert("Material Inexistente");
            }else{
                if (data.estatus == 'P'){
                    alert("Material en prestamo");
                }else if (data.estatus == 'B'){
                    alert("Material dado de baja");
                }else{
                    $("#materiales-5-materialnombre").val(data.descrMat);

                }
            }

        
      
       
     
        });

    });

    

    $("#materiales-6-matid").on('change',function(){
        $.get("index.php?r=inventario/get-nombre-material&matID="+$(this).val(),function (data){
            var data = $.parseJSON(data);
            

            console.log(data);
            if (data == null){
                alert("Material Inexistente");
            }else{
                if (data.estatus == 'P'){
                    alert("Material en prestamo");
                }else if (data.estatus == 'B'){
                    alert("Material dado de baja");
                }else{
                    $("#materiales-6-materialnombre").val(data.descrMat);

                }
            }

        
      
       
     
        });

    });

   

    $("#materiales-7-matid").on('change',function(){
        $.get("index.php?r=inventario/get-nombre-material&matID="+$(this).val(),function (data){
            var data = $.parseJSON(data);
            

            console.log(data);
            if (data == null){
                alert("Material Inexistente");
            }else{
                if (data.estatus == 'P'){
                    alert("Material en prestamo");
                }else if (data.estatus == 'B'){
                    alert("Material dado de baja");
                }else{
                    $("#materiales-7-materialnombre").val(data.descrMat);

                }
            }

        
      
       
     
        });

    });

    



});
    
    


$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (! confirm("¿Eliminar campos?")) {
        return false;
    }
    return true;
});


$(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("Deleted!");
});

$(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Límite de campos alcanzado");

    
});


JS;
$this->registerJS($script1);


?>
