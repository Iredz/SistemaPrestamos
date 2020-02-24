<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use frontend\models\Docentes;
use frontend\models\Alumnos;
use frontend\models\Empleados;

/* @var $this yii\web\View */
/* @var $model frontend\models\Devoluciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="devoluciones-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

   

    <?=$form->field($model, 'alumnoNoControl')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Alumnos::find()->all(),'noControl','noControl'),
        'language' => 'es',
        'options' => ['placeholder' => ' No. CONTROL ...','id'=>'noCon'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'alumnoNombre')->textInput(['maxlength' => true]) ?>

    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="glyphicon glyphicon-th-list"></i> Material a devolver</h4></div>
            <div class="panel-body">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 4, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
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
                                // necessary for update action.
                                if (! $modelMaterialDevuelto->isNewRecord) {
                                    echo Html::activeHiddenInput($modelMaterialDevuelto, "[{$i}]id");
                                }
                                ?>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <?= $form->field($modelMaterialDevuelto, "[{$i}]matID")->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($modelMaterialDevuelto, "[{$i}]materialNombre")->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div><!-- .row -->

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php DynamicFormWidget::end(); ?>
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
        $('#devoluciones-alumnonombre').attr('value',data.alumnoNombre);
   });
   
});

JS;
$this->registerJS($script);
?>