<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Carreras;
use frontend\models\CarrerasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CarrerasController implements the CRUD actions for Carreras model.
 */
class CarrerasController extends Controller
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
     * Lists all Carreras models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('modificarCarreras'))
        {
            $searchModel = new CarrerasSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

        }
    }

    /**
     * Displays a single Carreras model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('modificarCarreras'))
        {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);

        }
    }

    /**
     * Creates a new Carreras model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if(Yii::$app->user->can('modificarCarreras'))
        {
            $model = new Carreras();
    
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->carreraID]);
            }
    
            return $this->render('create', [
                'model' => $model,
            ]);

        }
    }

    /**
     * Updates an existing Carreras model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        if(Yii::$app->user->can('modificarCarreras'))
        {

            $model = $this->findModel($id);
    
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->carreraID]);
            }
    
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Carreras model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        if(Yii::$app->user->can('modificarCarreras'))
        {

            $this->findModel($id)->delete();
    
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Carreras model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Carreras the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {

        if(Yii::$app->user->can('modificarCarreras'))
        {

            if (($model = Carreras::findOne($id)) !== null) {
                return $model;
            }
        }

        throw new NotFoundHttpException('Favor de Iniciar Sesión');
    }
}
