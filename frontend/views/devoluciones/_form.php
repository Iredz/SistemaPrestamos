<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use frontend\models\Inventario;
use frontend\models\Alumnos;
use frontend\models\Empleados;

/* @var $this yii\web\View */
/* @var $model frontend\models\Devoluciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="devoluciones-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'alumnoNoControl')->textInput(['maxlength' => true,
        'onchange'=>'
                $.get("index.php?r=alumnos/get-nombre-alumno&noControl="+$(this).val(),function (data){
                        
                        var data = $.parseJSON(data);
                        if (data !== null) {
                        

                        console.log(data.alumnoNombre);
                        $("#devoluciones-alumnonombre").val(data.alumnoNombre);
                        }else {
                            alert("Alumno no registrado");
                        }
                    });'
        ]) ?>

    <?= $form->field($model, 'alumnoNombre')->textInput(['maxlength' => true]) ?>

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
                    'model' => $modelsMaterialDevuelto[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'matID',
                        'materialNombre',

                    ],
                ]); ?>
                <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($modelsMaterialDevuelto as $i => $modelMaterialDevuelto): ?>
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
                            if (! $modelMaterialDevuelto->isNewRecord) {
                                echo Html::activeHiddenInput($modelMaterialDevuelto, "[{$i}]id");
                            }
                            ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($modelMaterialDevuelto, "[{$i}]matID")->textInput(['maxlength' => true]);?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($modelMaterialDevuelto, "[{$i}]materialNombre")->textInput(['maxlength' => true]);?>
                                </div>
                            </div><!-- .row -->
                            <?php endforeach; ?>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
                    </div>
                </div>
            </div>

            </div>

            <?=$form->field($model, 'recibeNombre')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Empleados::find()->all(),'empleadoNombre','empleadoNombre'),
                'language' => 'es',
                'options' => ['placeholder' => 'ELIGA QUIEN RECIBE EL MATERIAL ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>


    <?= $form->field($model, 'observaciones')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Gaurdar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<?php

$script0 = <<< JS

$("#materialdevuelto-0-matid").on('change',function(){
        $.get("index.php?r=inventario/get-nombre-material&matID="+$(this).val(),function (data){
            var data = $.parseJSON(data);
            console.log(data);
            if (data == null){
                alert("Material Inexistente");
            }else{
                if (data.estatus == 'B'){
                    alert("Material ya está dado de baja");
                }else if (data.estatus == 'D'){
                    alert("Material no prestado");
                }else{
                    $("#materialdevuelto-0-materialnombre").val(data.descrMat);
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
    
    $("#materialdevuelto-0-matid").on('change',function(){
        $.get("index.php?r=inventario/get-nombre-material&matID="+$(this).val(),function (data){
            var data = $.parseJSON(data);
            

            console.log(data);
            if (data == null){
                alert("Material Inexistente");
            }else{
                if (data.estatus == 'B'){
                    alert("Material dado de baja");
                }else if (data.estatus == 'D'){
                    alert("Material no prestado");
                }
                    else{
                    $("#materialdevuelto-0-materialnombre").val(data.descrMat);
                }
            }
        
      
       
     
        });

    });

    
    

    $("#materialdevuelto-1-matid").on('change',function(){
        $.get("index.php?r=inventario/get-nombre-material&matID="+$(this).val(),function (data){
            var data = $.parseJSON(data);
            

            console.log(data);
            if (data == null){
                alert("Material Inexistente");
            }else{
                if (data.estatus == 'B'){
                    alert("Material dado de baja");
                }else if (data.estatus == 'D'){
                    alert("Material no prestado");
                }else{
                    $("#materialdevuelto-1-materialnombre").val(data.descrMat);

                }
            }

        
      
       
     
        });

    });

    $("#materialdevuelto-2-matid").on('change',function(){
        $.get("index.php?r=inventario/get-nombre-material&matID="+$(this).val(),function (data){
            var data = $.parseJSON(data);
            

            console.log(data);
            if (data == null){
                alert("Material Inexistente");
            }else{
                if (data.estatus == 'B'){
                    alert("Material dado de baja");
                }else if (data.estatus == 'D'){
                    alert("Material no prestado");
                }else{
                    $("#materialdevuelto-2-materialnombre").val(data.descrMat);

                }
            }

        
      
       
     
        });

    });

    

    $("#materialdevuelto-3-matid").on('change',function(){
        $.get("index.php?r=inventario/get-nombre-material&matID="+$(this).val(),function (data){
            var data = $.parseJSON(data);
            

            console.log(data);
            if (data == null){
                alert("Material Inexistente");
            }else{
                if (data.estatus == 'B'){
                    alert("Material dado de baja");
                }else if (data.estatus == 'D'){
                    alert("Material no prestado");
                }else{
                    $("#materialdevuelto-3-materialnombre").val(data.descrMat);

                }
            }

        
      
       
     
        });

    });

   
    $("#materialdevuelto-4-matid").on('change',function(){
        $.get("index.php?r=inventario/get-nombre-material&matID="+$(this).val(),function (data){
            var data = $.parseJSON(data);
            

            console.log(data);
            if (data == null){
                alert("Material Inexistente");
            }else{
                if  (data.estatus == 'B'){
                    alert("Material dado de baja");
                }else if (data.estatus == 'D'){
                    alert("Material no prestado");
                }else{
                    $("#materialdevuelto-4-materialnombre").val(data.descrMat);

                }
            }

        
      
       
     
        });

    });

    


    $("#materialdevuelto-5-matid").on('change',function(){
        $.get("index.php?r=inventario/get-nombre-material&matID="+$(this).val(),function (data){
            var data = $.parseJSON(data);
            

            console.log(data);
            if (data == null){
                alert("Material Inexistente");
            }else{
                if (data.estatus == 'B'){
                    alert("Material dado de baja");
                }else if (data.estatus == 'D'){
                    alert("Material no prestado");
                }else{
                    $("#materialdevuelto-5-materialnombre").val(data.descrMat);

                }
            }

        
      
       
     
        });

    });

    

    $("#materialdevuelto-6-matid").on('change',function(){
        $.get("index.php?r=inventario/get-nombre-material&matID="+$(this).val(),function (data){
            var data = $.parseJSON(data);
            

            console.log(data);
            if (data == null){
                alert("Material Inexistente");
            }else{
                if  (data.estatus == 'B'){
                    alert("Material dado de baja");
                }else if (data.estatus == 'D'){
                    alert("Material no prestado");
                }else{
                    $("#materialdevuelto-6-materialnombre").val(data.descrMat);

                }
            }

        
      
       
     
        });

    });

   

    $("#materialdevuelto-7-matid").on('change',function(){
        $.get("index.php?r=inventario/get-nombre-material&matID="+$(this).val(),function (data){
            var data = $.parseJSON(data);
            

            console.log(data);
            if (data == null){
                alert("Material Inexistente");
            }else{
                if (data.estatus == 'B'){
                    alert("Material dado de baja");
                }else if (data.estatus == 'D'){
                    alert("Material no prestado");
                }else{
                    $("#materialdevuelto-7-materialnombre").val(data.descrMat);

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