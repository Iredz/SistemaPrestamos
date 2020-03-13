<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Bajas;
use frontend\models\BajasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BajasController implements the CRUD actions for Bajas model.
 */
class BajasController extends Controller
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
     * Lists all Bajas models.
     * @return mixed
     */
    public function actionIndex()


    {
        if(Yii::$app->user->can('modificarBajas'))
        {
        $searchModel = new BajasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        }
    }

    /**
     * Displays a single Bajas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('modificarBajas'))
        {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);

        }
    }

    /**
     * Creates a new Bajas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('modificarBajas'))
        {
        $model = new Bajas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bajaID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);

        }
    }

    /**
     * Updates an existing Bajas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('modificarBajas'))
        {

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bajaID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

        }
    }

    /**
     * Deletes an existing Bajas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('modificarBajas'))
        {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);

        }
    }

    /**
     * Finds the Bajas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bajas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    { 
        if(Yii::$app->user->can('modificarBajas'))
        {
            if (($model = Bajas::findOne($id)) !== null) {
                return $model;
            }

        }

        throw new NotFoundHttpException('Favor de Iniciar Sesión');
    }
}
