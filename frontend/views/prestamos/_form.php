<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
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

    

    <?=$form->field($model, 'noControlAlumno')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Alumnos::find()->all(),'noControl','noControl'),
        'language' => 'es',
        'options' => ['placeholder' => ' No. CONTROL ...','id'=>'noCon'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
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
    (ArrayHelper::map(Periodos::find()->all(),'periodoNombre','periodoNombre'),['prompt'=>'ELIGA PERIODO'])?>

<?= $form->field($model, 'fecha')->widget(DatePicker::class, [
        'language' => 'es',
        'dateFormat' => 'yyyy-MM-dd',
    ]		) ?>


    <div class="row">

<div class="panel panel-default">
    <div class="panel-heading"><h4><i class="glyphicon glyphicon-th-list"></i>Material Didáctico</h4></div>
    <div class="panel-body">
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 8, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
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
                        // necessary for update action.
                        if (! $modelMateriales->isNewRecord) {
                            echo Html::activeHiddenInput($modelMateriales, "[{$i}]id");
                        }
                        ?>

                        <div class="row">
                            <div class="col-sm-6">
                            
                                <?= $form->field($modelMateriales, "[{$i}]matID")->textInput(['maxlength' => true])?>
                                
                              
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelMateriales, "[{$i}]materialNombre")->textInput(['maxlength' => true]) ?>
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
$script = <<< JS
    $('#noCon').change(function(){
    var noControl = $(this).val();
   
    $.get('index.php?r=alumnos/get-nombre-alumno',{ noControl : noControl },function(data) {
        var data= $.parseJSON(data);
       
        // Al ingresar un numero de control en el campo "No. Control", el campo "Nombre de Alumno"
        //  se le atribuye el nombre del alumno correspondiente a ese numero de control
        $('#prestamos-nombrealumno').attr('value',data.alumnoNombre);
   });
   
});


$("#materiales-0-matid").change(function() {
       
    let materialid = $("#materiales-0-matid").val();
    if(materialid.length != "") {
        $.post("http://localhost/sistemaprestamos/frontend/controllers/material.php", { materialID: materialid }, function(data) {
            let name = JSON.parse(data);
            console.log(name.descrMat);
            $("#materiales-0-materialnombre").attr('value', name.descrMat);
        });

        
    } 
       

   });

   $("#materiales-1-matid").focusout(function() {
       
       let nuevo = $("#materiales-1-matid").val();
       if(nuevo.length != "") {
           $.post("http://localhost/sistemaprestamos/frontend/controllers/material.php", { materialID: nuevo }, function(data) {
               let name = JSON.parse(data);
               console.log(name.descrMat);
               $("#materiales-1-materialnombre").attr('value', name.descrMat);
           });
   
           
       } 
          
   
      });

 /* var inputs = document.getElementsByClassName("form-group");
   for(let i = 0; i < inputs.length; i++){
       if(i == 1 || i == 8) {
           inputs[i].style.display = "none";
       }
   } */

JS;
$this->registerJS($script);
?>





