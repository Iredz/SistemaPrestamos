<?php

namespace frontend\controllers;

use frontend\models\Materias;
use Yii;
use frontend\models\Prestamos;
use frontend\models\PrestamosSearch;
use frontend\models\Materiales;
use frontend\models\MaterialesSearch;
use frontend\models\Model;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\db\Query;
use yii\db\ActiveQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

    public function actionReporte(){
        
        
            

        /*    -------------------     PRIMER TABLA   -------------------    */
        $sql = 'SELECT
                alumnos.alumnoCarreraNombre as "Carrera",
                COUNT(*) as Visitas
            FROM prestamos
            LEFT JOIN alumnos ON prestamos.noControlAlumno = alumnos.noControl
            GROUP BY Carrera
        ';

        $sqlProvider = new SqlDataProvider([
            'sql'=>$sql,
            'sort'=>[
                'defaultOrder'=> ['Visitas'=>SORT_DESC],
               'attributes'=>['Carrera','Visitas']
            
            ],   
        ]);

            /*-------------------   SEGUNDA TABLA   ------------------- */
        $sql2 = 'SELECT materialNombre as "Nombre de Material",
                 COUNT(*) as "Veces Prestado"
            FROM materiales
            GROUP BY materialNombre
          
        ';

        $sqlProvider2 = new SqlDataProvider([
            'sql'=>$sql2,
            'sort'=>[
                'defaultOrder'=> ['Veces Prestado'=>SORT_DESC],
               'attributes'=>[' Nombre de Material','Veces Prestado']
            ],
        ]);


            /*-------------------   TERCERA TABLA   ------------------- */
            $sql3 = 'SELECT materias.materiaNombre as "Nombre de Materia",
                    COUNT(*) as "Visitas"
                FROM prestamos
                LEFT JOIN materias ON prestamos.materiaID = materias.materiaID
                GROUP BY materias.materiaNombre

            ';

            $sqlProvider3 = new SqlDataProvider([
                'sql'=>$sql3,
                'sort'=>[
                    'defaultOrder'=>['Visitas'=>SORT_DESC],
                    'attributes'=>['Nombre de Materia','Visitas']
                ],
               
            ]);

            /*-------------     PROBANDO GRAPHS    ------------------------*/
            

            
        /*-----------------   RENDERIZA TABLAS EN EL ARCHIVO VIEW PRESTAMOS/REPORTE      ---------------- */
        return $this->render('reporte',[
            'sqlProvider'=> $sqlProvider,
            'sqlProvider2'=>$sqlProvider2,
            'sqlProvider3'=>$sqlProvider3,
            
            'dataProvider'=>$dataProvider,
              
        
        
        ]);

            }
}
