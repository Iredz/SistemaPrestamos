<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Materias;
use frontend\models\MateriasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MateriasController implements the CRUD actions for Materias model.
 */
class MateriasController extends Controller
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
     * Lists all Materias models.
     * @return mixed
     */
    public function actionIndex()
    {

        if(Yii::$app->user->can('modificarMaterias'))
        {
        $searchModel = new MateriasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

          return $this->render('index', [
              'searchModel' => $searchModel,
              'dataProvider' => $dataProvider,
          ]);
        }
        throw new NotFoundHttpException('Favor de Iniciar Sesión');
    }

    /**
     * Displays a single Materias model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        if(Yii::$app->user->can('modificarMaterias'))
        {

            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }   
        throw new NotFoundHttpException('Favor de Iniciar Sesión');
        
    }

    /**
     * Creates a new Materias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if(Yii::$app->user->can('modificarMaterias'))
        {

            $model = new Materias();
    
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->materiaID]);
            }
    
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        throw new NotFoundHttpException('Favor de Iniciar Sesión');
    }

    /**
     * Updates an existing Materias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        if(Yii::$app->user->can('modificarMaterias'))
        {

            $model = $this->findModel($id);
    
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->materiaID]);
            }
    
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        throw new NotFoundHttpException('Favor de Iniciar Sesión');
        
    }

    /**
     * Deletes an existing Materias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        if(Yii::$app->user->can('modificarMaterias'))
        {

            $this->findModel($id)->delete();
    
            return $this->redirect(['index']);
        }
        throw new NotFoundHttpException('Favor de Iniciar Sesión');
    }

    /**
     * Finds the Materias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Materias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {

        if(Yii::$app->user->can('modificarMaterias'))
        {

            if (($model = Materias::findOne($id)) !== null) {
                return $model;
            }
        }

        throw new NotFoundHttpException('Favor de Iniciar Sesión');
    }
}
