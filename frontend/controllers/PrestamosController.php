<?php

namespace frontend\controllers;


use Yii;
use frontend\models\Prestamos;
use frontend\models\PrestamosSearch;
use frontend\models\Materiales;
use frontend\models\MaterialesSearch;
use frontend\models\Model;
use yii\data\SqlDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use kartik\mpdf\Pdf;

/**
 * PrestamosController implements the CRUD actions for Prestamos model.
 */
class PrestamosController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Prestamos models.
     * @return mixed
     */

    
    public function actionIndex()
    {

        if(Yii::$app->user->can('modificarPrestamos'))
        {

            $searchModel = new PrestamosSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        throw new NotFoundHttpException('Favor de Iniciar Sesión');
    }

    /**
     * Displays a single Prestamos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        if(Yii::$app->user->can('modificarPrestamos'))
        {

            $model = $this->findModel($id);
            $modelsMateriales= $model->materiales;

            $searchModel = new MaterialesSearch();
            $searchModel->prest_id= $model ->id;
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('view', [
                //'model' => $this->findModel($id),
                'model' => $model,
                
                'modelsMateriales'=>$modelsMateriales,
                'searchModel' =>$searchModel,
                'dataProvider' => $dataProvider,

                
            ]);
        }

        throw new NotFoundHttpException('Favor de Iniciar Sesión');
    }

    /**
     * Creates a new Prestamos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if(Yii::$app->user->can('modificarPrestamos'))
        {

            $model = new Prestamos();
            $modelsMateriales = [new Materiales];
    
            if ($model->load(Yii::$app->request->post()) && $model->save())
            {
                /*
                 * Se hace uso del  modelo "Model.php" , para el manejo
                 * múltiple de elementos
                */
                $modelsMateriales = Model::createMultiple(Materiales::classname());
                Model::loadMultiple($modelsMateriales, Yii::$app->request->post());
    
            
                // validar los modelos
                $valid = $model->validate();
                $valid = Model::validateMultiple($modelsMateriales) && $valid;
                
                if ($valid) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $model->save(false)) {
                            foreach ($modelsMateriales as $modelMateriales) {
                                $modelMateriales->prest_id = $model->id;
                                if (! ($flag = $modelMateriales->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                        if ($flag) {
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                
                }
               
            }
    
            return $this->render('create', [
                'model' => $model,
                'modelsMateriales' => (empty($modelsMateriales)) ? [new Materiales] : $modelsMateriales
            ]);
        }

        throw new NotFoundHttpException('Favor de Iniciar Sesión');
    }

    /**
     * Updates an existing Prestamos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        if(Yii::$app->user->can('modificarPrestamos'))
        {

            $model = $this->findModel($id);
    
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
    
            return $this->render('update', [
                'model' => $model,
            ]);
        }

        throw new NotFoundHttpException('Favor de Iniciar Sesión');
    }

    /**
     * Deletes an existing Prestamos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        if(Yii::$app->user->can('modificarPrestamos'))
        {

            $this->findModel($id)->delete();
    
            return $this->redirect(['index']);
        }

        throw new NotFoundHttpException('Favor de Iniciar Sesión');
    }

    /**
     * Finds the Prestamos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Prestamos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prestamos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Favor de Iniciar Sesión');
    }

    public function actionDatos(){
        

        /*    -------------------     PRIMER TABLA   -------------------    */
        $sql = 'SELECT
                alumnos.alumnoCarreraNombre as "Carrera",
                COUNT(*) as Visitas
            FROM prestamos
            LEFT JOIN alumnos ON prestamos.noControlAlumno = alumnos.noControl
            GROUP BY Carrera';

        $sqlProvider = new SqlDataProvider([
            'sql'=>$sql,
            
            'sort'=>[
                'defaultOrder'=> ['Visitas'=>SORT_DESC],
               'attributes'=>['Carrera','Visitas']
            
            ],   
        ]);

            /*-------------------   SEGUNDA TABLA   ------------------- */
        $sql2 = 'SELECT materialNombre as "Nombre del material",
                 COUNT(*) as "Veces Prestado"
            FROM materiales
            GROUP BY materialNombre';

        $sqlProvider2 = new SqlDataProvider([
            'sql'=>$sql2,
            'sort'=>[
                'defaultOrder'=> ['Veces Prestado'=>SORT_DESC],
               'attributes'=>[' Nombre del Material','Veces Prestado']
            ],
        ]);


            /*-------------------   TERCERA TABLA   ------------------- */
            $sql3 = 'SELECT materias.materiaNombre as "Nombre de Materia",
                    COUNT(*) as "Visitas"
                FROM prestamos
                LEFT JOIN materias ON prestamos.materiaID = materias.materiaID
                GROUP BY materias.materiaNombre';

            $sqlProvider3 = new SqlDataProvider([
                'sql'=>$sql3,
                'sort'=>[
                    'defaultOrder'=>['Visitas'=>SORT_DESC],
                    'attributes'=>['Nombre de Materia','Visitas']
                ],  
               
            ]);


             /*-------------------   CUARTA TABLA   ------------------- */
                $sql4 = 'SELECT docentes.docenteNombre as "Nombre del docente",
                COUNT(*) as "Visitas"
            FROM prestamos
            LEFT JOIN docentes ON prestamos.docenteID = docentes.docenteID
            GROUP BY docentes.docenteNombre';

            $sqlProvider4 = new SqlDataProvider([
                'sql'=>$sql4,
                'sort'=>[
                    'defaultOrder'=>['Visitas'=>SORT_DESC],
                    'attributes'=>['Nombre del docente','Visitas']
                ],
                
            ]);       
            
            return $this->render('datos',[
                'sqlProvider'=> $sqlProvider,
                'sqlProvider2'=>$sqlProvider2,
                'sqlProvider3'=>$sqlProvider3,
                'sqlProvider4'=>$sqlProvider4,
        
               ]); 
        
    }

        public function actionGraficas(){

    
          
            $query1 = Prestamos::find()
            ->select('alumnos.alumnoCarreraNombre as Carrera')
            ->addSelect('count(*) as data')
            ->innerJoin('alumnos','alumnos.noControl = prestamos.noControlAlumno')
            ->groupBy('Carrera')
            ->createCommand();


            

            $query2 = Materiales::find()
            ->select('materialNombre')
            ->addSelect('count(*) as data')
            ->groupBy('materialNombre')
            ->createCommand();

            $query3 = Prestamos::find()
            ->select('materias.materiaNombre as Materias')
            ->addSelect('count(*) as data')
            ->innerJoin('materias','materias.materiaID = prestamos.materiaID')
            ->groupBy('Materias')
            ->createCommand();

            $query4 = Prestamos::find()
            ->select('docentes.docenteNombre as Docentes')
            ->addSelect('count(*) as data')
            ->innerJoin('docentes','docentes.docenteID = prestamos.docenteID')
            ->groupBy('Docentes')
            ->createCommand();
           

          
          
            return $this->render('graficas',[
                'query1'=>$query1,
                'query2'=>$query2,
                'query3'=>$query3,
                'query4'=>$query4,
            ]);

        }

        public function actionDatosPdf(){
            /*    -------------------     PRIMER TABLA   -------------------    */
        $sql = 'SELECT
        alumnos.alumnoCarreraNombre as "Carrera",
        COUNT(*) as Visitas
    FROM prestamos
    LEFT JOIN alumnos ON prestamos.noControlAlumno = alumnos.noControl
    GROUP BY Carrera';

$sqlProvider = new SqlDataProvider([
    'sql'=>$sql,
    'sort'=>[
        'defaultOrder'=> ['Visitas'=>SORT_DESC],
       'attributes'=>['Carrera','Visitas']
    
    ],   
]);

    /*-------------------   SEGUNDA TABLA   ------------------- */
$sql2 = 'SELECT materialNombre as "Nombre del material",
         COUNT(*) as "Veces Prestado"
    FROM materiales
    GROUP BY materialNombre';

$sqlProvider2 = new SqlDataProvider([
    'sql'=>$sql2,
    'sort'=>[
        'defaultOrder'=> ['Veces Prestado'=>SORT_DESC],
       'attributes'=>[' Nombre del Material','Veces Prestado']
    ],
]);


    /*-------------------   TERCERA TABLA   ------------------- */
    $sql3 = 'SELECT materias.materiaNombre as "Nombre de Materia",
            COUNT(*) as "Visitas"
        FROM prestamos
        LEFT JOIN materias ON prestamos.materiaID = materias.materiaID
        GROUP BY materias.materiaNombre';

    $sqlProvider3 = new SqlDataProvider([
        'sql'=>$sql3,
        'sort'=>[
            'defaultOrder'=>['Visitas'=>SORT_DESC],
            'attributes'=>['Nombre de Materia','Visitas']
        ],  
       
    ]);


     /*-------------------   CUARTA TABLA   ------------------- */
        $sql4 = 'SELECT docentes.docenteNombre as "Nombre del docente",
        COUNT(*) as "Visitas"
    FROM prestamos
    LEFT JOIN docentes ON prestamos.docenteID = docentes.docenteID
    GROUP BY docentes.docenteNombre';

    $sqlProvider4 = new SqlDataProvider([
        'sql'=>$sql4,
        'sort'=>[
            'defaultOrder'=>['Visitas'=>SORT_DESC],
            'attributes'=>['Nombre del docente','Visitas']
        ],
        
    ]);

    Yii::$app->response->format= Response::FORMAT_HTML;
    $content = $this->renderpartial('datospdf',[
        'sqlProvider'=> $sqlProvider,
        'sqlProvider2'=>$sqlProvider2,
        'sqlProvider3'=>$sqlProvider3,
        'sqlProvider4'=>$sqlProvider4,

       ]); 
    /*------------------  SECCION EXPORTACION PDF      ------------------*/

    $pdf = new Pdf([
        'mode'=> Pdf::MODE_BLANK,
        'destination'=>Pdf::DEST_BROWSER,
        'content'=>$content,
        'methods'=>[
            'SetTitle' => 'Datos Tabulados PDF',
            'SetHeader' => ['Reporte fin de ciclo escolar'],
            'SetFooter' => ['|Página {PAGENO}|'],
          
            
        ]

    ]);

    return $pdf->render();

        }

}
