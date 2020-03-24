<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use frontend\models\Inventario;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bajas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bajas-form">

    <?php $form = ActiveForm::begin(); ?>





    <?= $form->field($model, 'matID')->textInput(['maxlength' => true,
        'onchange'=>'

                
                     $.get("index.php?r=inventario/get-nombre-material&matID="+$(this).val(),function (data){
                        var data = $.parseJSON(data);
                        if (data !== null) {
                        

                        
                        $("#bajas-descrmat").val(data.descrMat);
                        }else {
                            alert("Material no registrado");
                        }
                    });

        '
        ]) ?>

    <?= $form->field($model, 'descrMat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'razon')->textarea(['rows' => 6]) ?>



    <?= $form->field($model, 'bajaFecha')->widget(DatePicker::class, [
        'language' => 'es',
        'dateFormat' => 'yyyy-MM-dd',
    ]		) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
    $('#idMAT').change(function(){
    var matID = $(this).val();
   
    $.get('index.php?r=inventario/get-nombre-material',{ matID : matID },function(data) {
        var data= $.parseJSON(data);
       
        // Al ingresar un numero de control en el campo "No. Control", el campo "Nombre de Alumno"
        //  se le atribuye el nombre del alumno correspondiente a ese numero de control
        $('#bajas-descrmat').attr('value',data.descrMat);
   });
   
});

JS;
$this->registerJS($script);
?>
