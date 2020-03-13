<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Docentes;
use frontend\models\DocentesSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DocentesController implements the CRUD actions for Docentes model.
 */
class DocentesController extends Controller
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
     * Lists all Docentes models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('modificarDocentes'))
        {

            $searchModel = new DocentesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Docentes model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Docentes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('modificarDocentes'))
        {

            $model = new Docentes();
    
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->docenteID]);
            }
    
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Docentes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('modificarDocentes'))
        {
            
            $model = $this->findModel($id);
    
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->docenteID]);
            }
    
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Docentes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('modificarDocentes'))
        {
            
            $this->findModel($id)->delete();
    
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Docentes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Docentes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if(Yii::$app->user->can('modificarDocentes'))
        {
            
            if (($model = Docentes::findOne($id)) !== null) {
                return $model;
            }
        }

        throw new NotFoundHttpException('Favor de Iniciar sesión');
    }


}
