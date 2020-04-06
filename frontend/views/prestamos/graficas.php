<?php

use practically\chartjs\Chart;
use frontend\assets\ChartAsset;

ChartAsset::register($this);

$this->title= 'Gráficas reporte final de ciclo escolar';
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][]=$this->title;
?>


<div>&emsp;</div><div>&emsp;</div>


<?php

/*  
    Se obtienen las variables de la funcion actionGraficas
*/
echo Chart::widget([
    'type' => Chart::TYPE_BAR,
    'datasets' => [
        [
          'query'=>$query1,
            'labelAttribute'=> 'Carrera'
            ]
        ],
        'clientOptions' => [
            'scales' => [
                'yAxes' => [
                    [
                        'ticks' => [
                            'min'=>0,
                        ]
                    ]
                ],
                'xAxes' => [
                    [
                        'ticks' => [
                             'autoSkip'=>false,
                             'maxRotation'=>90,
                             
                        ]
                    ]
                ]
            ],
            'title' => [
                'display' => true,
                'text' => 'Número de visitas de alumnos por carrera',
                'fontSize'=>20,
            ],
            'legend' => [
                'display' => false,
               
            ],
           
        ]

    
]);
?>

<div>&emsp;</div><div>&emsp;</div>
<div>&emsp;</div><div>&emsp;</div>


<?php

echo Chart::widget([
    'type' => Chart::TYPE_BAR,
    'datasets' => [
        [
          'query'=>$query2,
            'labelAttribute'=> 'materialNombre'
            ]
        ],
        'clientOptions' => [
            'scales' => [
                'yAxes' => [
                    [
                        'ticks' => [
                            'min'=>0,
                        ]
                    ]
                ],
                'xAxes' => [
                    [
                        'ticks' => [
                             'autoSkip'=>false,
                             'maxRotation'=>90,
                             
                        ]
                    ]
                ]
            ],
            'title' => [
                'display' => true,
                'text' => 'Material prestado',
                'fontSize'=>20,
            ],
            'legend' => [
                'display' => false,
               
            ],
           
        ]

    
]);
?>

<div>&emsp;</div><div>&emsp;</div>
<div>&emsp;</div><div>&emsp;</div>

<?php


    echo Chart::widget([
        'type' => Chart::TYPE_BAR,
        'datasets' => [
            [
              'query'=>$query3,
                'labelAttribute'=> 'Materias'
                ]
            ],
            'clientOptions' => [
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'min'=>0,
                            ]
                        ]
                    ],
                    'xAxes' => [
                        [
                            'ticks' => [
                                 'autoSkip'=>false,
                                 'maxRotation'=>90,
                                 
                            ]
                        ]
                    ]
                ],
                'title' => [
                    'display' => true,
                    'text' => 'Número de visitas por materia',
                    'fontSize'=>20,
                ],
                'legend' => [
                    'display' => false,
                   
                ],
               
            ]
    
        
    ]);


?>

<div>&emsp;</div><div>&emsp;</div>
<div>&emsp;</div><div>&emsp;</div>

<?php


    echo Chart::widget([
        'type' => Chart::TYPE_BAR,
        'datasets' => [
            [
              'query'=>$query4,
                'labelAttribute'=> 'Docentes'
                ]
            ],
            'clientOptions' => [
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'min'=>0,
                            ]
                        ]
                    ],
                    'xAxes' => [
                        [
                            'ticks' => [
                                 'autoSkip'=>false,
                                 'maxRotation'=>90,
                                 
                            ]
                        ]
                    ]
                ],
                'title' => [
                    'display' => true,
                    'text' => 'Número de visitas por docente',
                    'fontSize'=>20,
                ],
                'legend' => [
                    'display' => false,
                   
                ],
               
            ]
    
        
    ]);


?>
