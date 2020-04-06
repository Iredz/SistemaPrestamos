<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        //['label' => 'Inicio', 'url' => ['/site/index']],
    ];

    if(Yii::$app->user->can('privilegios-admin')){
        
        
        $menuItems[] = [
            'label'=>Yii::t('app', 'Gestionar altas'),
            'items'=>[
                [
                    'label' => 'Alumnos',
                     'url' => ['/alumnos/index']
                ],

                '<li class="divider"></li>',
                [
                    'label' => 'Docentes', 
                    'url' => ['/docentes/index']
                ],
                '<li class="divider"></li>',
                [
                    'label' => 'Carreras',
                    'url' => ['/carreras/index']
                ],
                '<li class="divider"></li>',
                [
                    'label' => 'Materias',
                    'url' => ['/materias/index']
                ],
                '<li class="divider"></li>',
                [
                    'label' => 'Empleados',
                    'url' => ['/empleados/index']
                ],
                
                
            ],
            
        ];
        
        $menuItems[] = [
            'label'=>Yii::t('app', 'Gestionar Inventario'),
            'items'=>[
                [
                    'label' => 'Altas',
                     'url' => ['/inventario/index']
                ],

                '<li class="divider"></li>',
                [
                    'label' => 'Bajas', 
                    'url' => ['/bajas/index']
                ],
                
            ],
            
        ];

        $menuItems[] = [
            'label'=>Yii::t('app', 'Gestionar Prestamos'),
            'items'=>[
                [
                    'label' => 'Prestamo',
                     'url' => ['/prestamos/index']
                ],

                '<li class="divider"></li>',
                [
                    'label' => 'Devolución', 
                    'url' => ['/devoluciones/index']
                ],
            ],
            
        ];  

        $menuItems[]=[
            'label'=>Yii::t('app', 'Gestionar Reportes'),
            'items'=>[
                [
                    'label' => 'Datos tabulados', 
                    'url' => ['/prestamos/datos']
                ],

                '<li class="divider"></li>',
                [
                    'label' => 'Gráficas', 
                    'url' => ['/prestamos/graficas']
                ],

            ],
        ];

    }
    if(Yii::$app->user->can('privilegios-empleado')){

        $menuItems[] = [
            'label'=>Yii::t('app', 'Gestionar altas'),
            'items'=>[
                [
                    'label' => 'Alumnos',
                     'url' => ['/alumnos/index']
                ],

                '<li class="divider"></li>',
                [
                    'label' => 'Docentes', 
                    'url' => ['/docentes/index']
                ],
                '<li class="divider"></li>',
                [
                    'label' => 'Materias',
                    'url' => ['/materias/index']
                ],  
                
            ],
            
        ];
        $menuItems[] = [
            'label'=>Yii::t('app', 'Gestionar Prestamos'),
            'items'=>[
                [
                    'label' => 'Prestamo',
                     'url' => ['/prestamos/index']
                ],

                '<li class="divider"></li>',
                [
                    'label' => 'Devolución', 
                    'url' => ['/devoluciones/index']
                ],
                
            ],
            
        ];  


    }
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Registrarse', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels'=>false,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
